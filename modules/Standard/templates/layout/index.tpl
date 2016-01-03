<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{$sTitle}</title>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/myMVC/styles/myMVC.css">
  </head>

  <body>
	<a name="top"></a>
    <div class="container">
		{include file="layout/header.tpl"}
		
		{$sContent}

		{include file="layout/footer.tpl"}
    </div>  	
		
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/showdown/0.4.0/Showdown.min.js"></script>
	<script>
		{literal}
		$(document).ready(function() {
			
			if ($('.markdown').length)
			{
				var converter = new Showdown.converter();
				$('.markdown').html(converter.makeHtml($('.markdown').html()));
				$('.markdown img').addClass('img-responsive');
			}
		});
		{/literal}
	</script>

  </body>
</html>