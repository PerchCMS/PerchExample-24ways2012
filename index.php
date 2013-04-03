<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');
	
	$page_vars['body_class'] = 'home';
	
	PerchSystem::set_page('/'.$page_vars['home_year']);
	PerchSystem::set_var('domain', $domain);

	$page_vars['year'] = $page_vars['home_year'];

	$page_vars['page_title'] = 'web design and development articles and tutorials for advent';

	perch_layout('default/above', $page_vars);

		$null = perch_content('Articles', true);

		perch_content_custom('Articles', array(
			'page'=>'/'.$page_vars['year'],
			'template'=>'articles/home_listing.html',
			'filter'=> array(
						array(
							'filter'=>'date',
							'match'=>'lte',
							'value'=>date('Y-m-d')
						)
			),
			'sort'=>'date',
			'sort-order'=>'DESC'
		)); 


		perch_content('About');

	perch_layout('default/below');
?>