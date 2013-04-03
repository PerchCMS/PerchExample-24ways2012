<?php
	$year 			= perch_layout_var('year', true);
	$content_class 	= perch_layout_var('content_class', true);
	$current_day 	= perch_layout_var('current_day', true);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>24 ways: <?php perch_layout_var('page_title'); ?></title>
    <meta name="description" content="The advent calendar for web geeks. Each day throughout December we publish a daily dose of web design and development goodness to bring you all a little Christmas cheer." />
    <link rel="stylesheet" href="/css/2011.css" media="screen" />
    <link rel="stylesheet" href="/css/print.css" media="print" />
    <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0" />
	<!--[if IE 8]><link rel="stylesheet" href="/css/ie8.css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="/css/ie7.css" media="screen" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" href="/css/ie6.css" media="screen" /><![endif]-->
    <link rel="alternate" type="application/rss+xml" title="rss" href="http://feeds.feedburner.com/24ways" />  
</head> 
<body class="<?php perch_layout_var('body_class'); ?>">
	<p id="jump"><a href="#content">Jump to content</a></p>
	<div id="year">
		<h3>Year</h3>
		<ul>
			<li class="pre pre2">1999</li>
			<li class="pre pre3">2000</li>
			<li class="pre pre4">2001</li>
			<li class="pre pre5">2002</li>
			<li class="pre pre6">2003</li>
			<li class="pre pre7">2004</li>
	        <li<?php if ($year==2005) echo ' class="current"'; ?>><a href="/2005/">2005</a></li>
	        <li<?php if ($year==2006) echo ' class="current"'; ?>><a href="/2006/">2006</a></li>
	        <li<?php if ($year==2007) echo ' class="current"'; ?>><a href="/2007/">2007</a></li>
	        <li<?php if ($year==2008) echo ' class="current"'; ?>><a href="/2008/">2008</a></li>
	        <li<?php if ($year==2009) echo ' class="current"'; ?>><a href="/2009/">2009</a></li>
	        <li<?php if ($year==2010) echo ' class="current"'; ?>><a href="/2010/">2010</a></li>
	        <li<?php if ($year==2011) echo ' class="current"'; ?>><a href="/2011/">2011</a></li>
	        <li<?php if ($year>=2012) echo ' class="current"'; ?>><a href="/">2012</a></li>
			<li>2013</li>
			<li>2014</li>
			<li>2015</li>
			<li>2016</li>
			<li>2017</li>
			<li>2018</li>
			<li>2019</li>
			<li>2020</li>
			<li>2021</li>
			<li>2022</li>
		</ul>
	</div><!-- year -->
	<div id="day">
		<h3>Day</h3>
		<ul>
			<?php
				$daydata = perch_content_custom('Articles', array(
						'skip-template'=>true,
						'page'=>'/'.$year,
						'sort'=>'date',
						'sort-order'=>'DESC',
						'filter'=>array(
							array(
								'filter'=>'date',
								'match'=>'lte',
								'value'=>date('Y-m-d')
								)
						)
					));
				$days = array();
				for($i=24; $i>0; $i--) $days[$i] = '';

				if (PerchUtil::count($daydata)) {
					foreach($daydata as $day) {
						$time = strtotime($day['date']);
						$days[(int)date('j', $time)] = '/'.date('Y', $time).'/'.$day['slug'].'/';
					}
				}

				foreach($days as $day=>$link) {
					$str_day = str_pad($day, 2, '0', STR_PAD_LEFT);

					if ($link) {
						if ($day == $current_day) {
							echo '<li class="current"><a href="'.$link.'">'.$str_day.'</a></li>';
						}else{
							echo '<li><a href="'.$link.'">'.$str_day.'</a></li>';
						}
						
					}else{
						echo '<li>'.$str_day.'</li>';
					}
				}

			?>
		</ul>
	</div><!-- day -->
	<div id="wrap">
		<h1><a href="/">24 ways <em>to impress your friends</em></a></h1>
		<ul id="navigation">
			<li id="nav-home"><a href="/">Home</a></li>
			<li id="nav-archives"><a href="/2011/">Archives</a></li>
			<li id="nav-authors"><a href="/authors/">Authors</a></li>
			<li id="nav-rss"><a href="http://feeds.feedburner.com/24ways">RSS</a></li>
			<li id="nav-twitter"><a href="http://twitter.com/24ways">Twitter</a></li>
			<li id="search">
				<form method="get" action="/search/">
				    <div>
				        <input type="text" name="q" class="text switcheroo" value="<?php
				        	if (perch_get('q')) {
				        		echo PerchUtil::html(perch_get('q'), true);
				        	}else{
				        		echo 'Search&hellip;';
				        	}
				        ?>" />
					    <input type="submit" class="submit" value="Go" />
					</div>
				</form>
			</li>
		</ul><!-- navigation -->
	
	<div id="content"<?php if ($content_class) echo ' class="'.$content_class.'"'; ?>>
