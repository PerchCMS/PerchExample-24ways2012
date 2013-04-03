<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');

	$page_vars['body_class'] = 'authors';
	
	perch_layout('default/above', $page_vars);

		PerchSystem::set_page("categories");
		perch_content('Categories', true); 

	perch_layout('default/below');
?>