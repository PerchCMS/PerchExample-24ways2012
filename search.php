<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');
	
	$page_vars['body_class'] = 'archives';
	$page_vars['page_title'] = 'Search';

	PerchSystem::set_var('domain', $domain);

	perch_layout('default/above', $page_vars);

		perch_content_search(perch_get('q'), array(
			'template'=>'article_listing.html'
		)); 

		perch_content('About');

	perch_layout('default/below');
?>