<?php
	/* Configuration vars for the page, passed through to the layout. */
	$page_vars = array();

	/* The current year */
	$page_vars['year'] = (int) date('Y');

	/* The year for the home page (and rss) */
	if (time()>=strtotime('2012-12-01 00:00:00')) {
		$page_vars['home_year'] = 2012;
	}else{
		$page_vars['home_year'] = 2011;	
	}

	if ($page_vars['year'] > $page_vars['home_year']) $page_vars['year'] = $page_vars['home_year'];

	/* Body and content classes for CSS hooks */
	$page_vars['body_class']    = 'home';
	$page_vars['content_class'] = false;

	/* Title of the page */
	$page_vars['page_title']    = perch_pages_title(true);

	/* Current day (during advent) and maximum day to show as active */
	$page_vars['current_day']   = false;

	if ($page_vars['year']<date('Y')) {
		$page_vars['max_day'] = 25;
	}else{
		$page_vars['max_day'] = date('d');
	}

?>