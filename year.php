<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');
	
	$page_vars['body_class'] = 'archives';

	$year = (int) perch_get('year');
	if ($year<2005 || $year>date('Y')) {
		PerchUtil::redirect('/');
	}

	$page_vars['page_title'] = $year;

	PerchSystem::set_page('/'.$year);
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $year);

	perch_layout('default/above', $page_vars);

		$null = perch_content('Articles', true);

		perch_content_custom('Articles', array(
			'template'=>'articles/article_listing.html',
			'filter'=> array(
						array(
							'filter'=>'date',
							'match'=>'lte',
							'value'=>date('Y-m-d')
						),
			),
			'sort'=>'date',
			'sort-order'=>'DESC'
		)); 


		perch_content('About');

	perch_layout('default/below');
?>