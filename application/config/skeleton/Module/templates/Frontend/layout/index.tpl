<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{$sTitle}</title>

		<link rel="icon" href="/favicon.ico">

		{$sStyle}

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

		{$sScript}
	</body>
</html>
