<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');

	$page_vars['body_class'] = 'article';

	$year 	 = $page_vars['year'];
	
	$year = (int) perch_get('year');
	if ($year<2005 || $year>date('Y')) {
		PerchUtil::redirect('/');
	}

	if ($year<date('Y')) {
		$page_vars['max_day'] = 25;
	}else{
		$page_vars['max_day'] = date('d');
	}

	PerchSystem::set_page('/'.$year);
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $year);

	$articles = perch_content_custom('Articles', array(
		'page'=> '/'.$year,
		'template'=>'articles/article.html',
		'filter'=> array(
			array(
					'filter'=>'slug',
					'value'=>perch_get('slug')
				),
			array(
					'filter'=>'date',
					'match'=>'lte',
					'value'=>date('Y-m-d')
				)
		),
		'skip-template'=>true,
		'return-html'=>true
	));

	if (PerchUtil::count($articles) && isset($articles[0])) {
		$article = $articles[0];
		$current_day = date('j', strtotime($article['date']));
		$page_title = $article['title'];
		$article_html = $articles['html'];
	}else{
		$article_html = '';
		PerchUtil::redirect('/'.$year.'/');
	}

	$page_vars['current_day'] 	= $current_day;
	$page_vars['page_title'] 	= $page_title;

	perch_layout('default/above', $page_vars);


 	// comments
 	if ($article_html) {
	 	$comments = perch_comments($articles[0]['_id'], array(
	 			'sort'=>'commentScore',
	 			'sort-order'=>'DESC'
	 		), true); 
	 	PerchSystem::set_var('comments', $comments);
	 	$form = perch_comments_form($articles[0]['_id'], $articles[0]['title'], false, true);

	 	$article_html = str_replace('<!-- replaced with comment count -->', perch_commments_count($articles[0]['_id'], true), $article_html);
	 	$article_html = str_replace('<!-- replaced with comments listing -->', $form, $article_html);
	}

 	// output
 	echo $article_html;

 	// Related
 	if (isset($articles[0]['category'])) {

 		perch_content_custom('Articles', array(
			'page'=> '/2*',
			'template'=>'articles/related.html',
			'count'=>10,
			'filter'=> array(
				array(
						'filter'=>'category',
						'value'=>$articles[0]['category']
					),
				array(
						'filter'=>'date',
						'match'=>'lte',
						'value'=>date('Y-m-d')
					),
				array(
						'filter'=>'slug',
						'match'=>'neq',
						'value'=>$articles[0]['slug']
					)
			) 
		));
 	}

	perch_layout('default/below');
?>