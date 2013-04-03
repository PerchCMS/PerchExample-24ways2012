<?php 
	/* 
	Warning - this is the scariest page. BOO! See. 

	The flow is a bit odd, in order to be efficient:

		1. Fetch the article to a variable
		2. Output the top layout
		3. Fetch comments, and substitute them for a placeholder in the article HTML
		4. Output the article and comments to the page
		5. Output related articles
		6. Output the bottom layout

	We get the article first as we need to check it exists and is viewable, else we redirect the user away.

	The comments are nestled deep in the article template, so it's simplest to render the article with a placeholder for comments.
	Once we've got both the article and the comments, we replace the placeholder with the comments.

	*/

	include('perch/runtime.php');
	include('inc/page_vars.php');

	$page_vars['body_class'] = 'article';
	$year 	 = $page_vars['year'];


	// Check that the year being asked for is a valid 24ways year.	
	$year = (int) perch_get('year');
	if ($year<2005 || $year>date('Y')) {
		PerchUtil::redirect('/');
	}


	// If it's an archive year, show all 24 articles, otherwise limit to today's date
	if ($year<date('Y')) {
		$page_vars['max_day'] = 25;
	}else{
		$page_vars['max_day'] = date('d');
	}


	// Set the page to the given year, e.g. /2012
	PerchSystem::set_page('/'.$year);
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $year);


	// Fetch the article that matches the URL slug, and filter on today's date to make sure it should be live.
	// Catch the output into $articles - we don't want to write it to the page yet.
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


	// Check that we have the article, and set up some useful variables. Otherwise redirect to the year's archive listing.
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


	// Finally, call in the top layout.
	perch_layout('default/above', $page_vars);


 	// COMMENTS
 	// Load in any comments the article has. Then replace out some placeholders in the template with the comments and comment count.
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

 	// Finally output the article to the page.
 	echo $article_html;

 	// Get related articles (by category) for the sidebar
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

 	// Output the bottom layout
	perch_layout('default/below');
?>