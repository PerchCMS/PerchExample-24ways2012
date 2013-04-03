<?php 
	include('perch/runtime.php');
	include('inc/page_vars.php');
	
	$page_vars['body_class'] 	= 'article';
	$page_vars['content_class'] = 'comments';

	$page_vars['page_title'] = 'Vote on a comment';

	$type = perch_get('type');

	if ($type!='up') $type='down'; // normalise.

	$commentID = perch_get('commentID');


	PerchSystem::set_page('/comments/vote');
	PerchSystem::set_var('domain', $domain);
	PerchSystem::set_var('year', $page_vars['year']);

	perch_layout('default/above', $page_vars);

		PerchSystem::set_var('votetype', $type);
		PerchSystem::set_var('commentID', $commentID);
		perch_comment($commentID, array('template'=>'vote_preview.html'));

	perch_layout('default/below');
?>