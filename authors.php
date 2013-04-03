<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');
		
	$page_vars['body_class'] = 'authors';

	perch_layout('default/above', $page_vars);

		perch_content_custom('Authors', array(
			'template'=>'authors/author_listing.html',
			'filter'=>'active',
			'match'=>'lte',
			'value'=>date('Y-m-d'),
			'sort'=>'firstname',
			'sort-order'=>'ASC'
		)); 

	perch_layout('default/below');
?>