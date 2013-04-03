<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');

	header('Content-type: text/xml;');

	PerchSystem::set_page('/'.$page_vars['home_year']);
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('today', date('Y-m-d H:i:s'));

	perch_content_custom('Articles', array(
		'page'=>'/'.$page_vars['home_year'],
		'template'=>'articles/rss.html',
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
?>