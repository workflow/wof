{* ### HTML5 Boilerplate in a big huge smarty template. Find the christmas hack. ### *}
{* ### @todo this would need to go into a separate layout for any larger application ### *}
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Wall of Facebook</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="boilerplate/css/style.css">
  <!-- end CSS-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="application/views/smarty_templates/boilerplate/js/libs/modernizr-2.0.6.min.js"></script>

</head>

<body>

  <div id="container">
    <header>

    </header>
	<div id="main" role="main">
		
		{if $xmas}<h1><a href="http://www.youtube.com/watch?v=GkHNNPM7pJA">Happy Digital Christmas!</a></h1>{else}<h1>Wall of Facebook</h1>{/if}
		{if $is_login}
			<h2>Don't worry, your data is as safe with us as our design is eloquent. </h2>
			<pre>-> Displaying basic wall feed data in an ugly table. This could easily be transformed into sthg more nifty like <a href="http://www.neosmart.de/social-media/facebook-wall" target="_blank">here</a>.</pre>
			<table>
				<thead>
					<tr>
						<th scope="col">From</th>
						<th scope="col">Category</th>
						<th scope="col">What be happenin'?</th>
					</tr>
				</thead>
				<tbody>
					{foreach $feed as $item}
						<tr>
							<td>{$item.from.name|escape}</td>
							<td>{$item.from.category|escape}</td>
							<td>{$item.message|escape|truncate:120}{$item.story|escape|truncate:120}</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		{else}
			<a href="{$login_url}" title="Please login first">Please login first!</a>
		{/if}

    </div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="boilerplate/js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="boilerplate/js/plugins.js"></script>
  <script defer src="boilerplate/js/script.js"></script>
  <!-- end scripts-->

	
  <!-- Change UA-XXXXX-X to be your site's ID 
  <script>
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script> -->


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  
</body>
</html>
