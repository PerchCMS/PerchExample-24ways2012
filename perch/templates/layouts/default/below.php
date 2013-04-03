	</div><!-- content -->

    		<ul id="footer">
			<li><strong>24 ways</strong> is brought to you by <a href="http://grabaperch.com/?ref=24w01">Perch CMS</a>.</li>
			<li>Produced by <a href="http://allinthehead.com/">Drew McLellan</a>, <a href="http://suda.co.uk/">Brian Suda</a>, <a href="http://maban.co.uk/">Anna Debenham</a> and <a href="http://fullcreammilk.co.uk/">Owen Gregory</a>.</li>
			<li>Design delivered by <a href="http://madebyelephant.com/">Made by Elephant</a>.</li>
			<li>Possible only with the help and dedication of <a href="/authors/">our authors</a>.</li>
			<li>Hosting by <a href="http://www.memset.com/">Memset</a> <a href="http://www.memset.com/dedicated-servers/">Dedicated Servers</a>.</li>
			<li>Grab our <a href="http://feeds.feedburner.com/24ways">RSS feed</a> or follow us on <a href="http://twitter.com/24ways">Twitter</a> or <a href="http://www.facebook.com/24ways">Facebook</a>.</li>

		</ul><!-- footer -->
		<ul id="unnecessary">
			<li id="top"></li>
			<li id="right"></li>
			<li id="bottom"></li>
			<li id="left"></li>
		</ul><!-- unnecessary -->
	</div>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
    
    <?php if (PERCH_PRODUCTION_MODE==PERCH_PRODUCTION) { ?>
    <script src="/js/all.js" type="text/javascript"></script>
    <script src="http://stats.24ways.org/mint/?js" type="text/javascript"></script>
    <?php }else{ ?>
	<script src="/js/css_browser_selector.js" type="text/javascript"></script>
	<script src="/js/article.js" type="text/javascript"></script>
    <?php } ?>
</body>
</html>