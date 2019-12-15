<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{$sTitle}</title>

		<link rel="icon" href="/favicon.ico">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
		<link rel="stylesheet" href="/myMVC/styles/myMVC.css">
		<style>
			{literal}
			/* Move down content because we have a fixed navbar that is 3.5rem tall */
			body {
				padding-top: 3.5rem;
			}
			{/literal}
		</style>
	</head>

	<body>
		<a name="top"></a>

		{$sMainmenu}

		<main role="main">

			{$sContent}

		</main>

		{$sFooter}
		{$sNoscript}
		{$sCookieConsent}

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/myMVC/assets/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/popper.min.js" integrity="sha256-trs1NroMTXyZS9LeGSSGjIWW3EKTGqAbWaYR5iSVMyQ=" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js" integrity="sha256-jl1+DOsSs9uABTKppOJ2GF8kXoc3XQzBtFFyS0i9Xoo=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/myMVC/scripts/cookieConsent.js"></script>
		<script type="text/javascript">
			{literal}
			$(document).ready(function() {
				if ($('.markdown').length) {
					var converter = new Showdown.converter();
					$('.markdown').html(converter.makeHtml($('.markdown').html()));
					$('.markdown img').addClass('img-responsive');
				}
			});
			{/literal}
		</script>
	</body>
</html>
