<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{$sTitle}</title>

		<link rel="icon" href="/favicon.ico">

		<link href="/myMVC/assets/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="/myMVC/assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="/myMVC/styles/myMVC.css" rel="stylesheet" type="text/css">
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

		<script src="/myMVC/assets/jquery/3.4.1/jquery-3.4.1.min.js" type="text/javascript"></script>
		<script src="/myMVC/assets/jquery-cookie/1.4.1/jquery.cookie.min.js" type="text/javascript"></script>
		<script src="/myMVC/assets/bootstrap-4.4.1-dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/myMVC/scripts/cookieConsent.min.js" type="text/javascript"></script>
	</body>
</html>
