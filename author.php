<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');
		
	$page_vars['body_class'] = 'author';
	$page_vars['content_class'] = 'vcard';

	$author = perch_content_custom('Authors', array(
		'template'=>'authors/author.html',
		'page'=>'/authors.php',
		'skip-template'=>true,
		'return-html'=>true,
		'filter'=> array(
					array(
						'filter'=>'slug',
						'value'=>perch_get('slug')
					),
					array(
						'filter'=>'active',
						'match'=>'lte',
						'value'=>date('Y-m-d')
						)
					)
	)); 

	if (!isset($author[0])) PerchUtil::redirect('/authors/');

	$page_vars['page_title'] = $author[0]['firstname'].' '.$author[0]['lastname'];

	perch_layout('default/above', $page_vars);

		echo $author['html'];

		perch_content_custom('Articles', array(
			'template'=>'articles/author_listing.html',
			'page'=>'/2*',
			'filter'=> array(
				array(
					'filter'=>'author',
					'value'=>perch_get('slug')
				),
				array(
					'filter'=>'date',
					'match'=>'lte',
					'value'=>date('Y-m-d')
				)
			),
			'sort'=>'date',
			'sort-order'=>'DESC'
		));


	perch_layout('default/below');
?>