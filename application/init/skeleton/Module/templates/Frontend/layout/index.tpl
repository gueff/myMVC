<!doctype html>{* @see https://getbootstrap.com/docs/5.3/getting-started/introduction/ *}
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{$oDTRoutingAdditional->get_sTitle()}</title>
	<link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="icon" href="/favicon.ico">
	<link rel="manifest" href="/site.webmanifest">

	{foreach key=sKey item=sItem from=$oDTRoutingAdditional->get_aStyle()}<link href="{$sItem}" rel="stylesheet" type="text/css">
	{/foreach}

	<style>{literal}body {padding-top: 7rem;/* Move down content because of fixed navbar */}{/literal}</style>
</head>
<body>
	<a id="top"></a>

	{{module}\View\Index::init()->loadTemplateAsString($oDTRoutingAdditional->get_sMainmenu())}

	<main role="main">

		{{module}\View\Index::init()->loadTemplateAsString($oDTRoutingAdditional->get_sContent())}

	</main>

	{{module}\View\Index::init()->loadTemplateAsString($oDTRoutingAdditional->get_sFooter())}
	{{module}\View\Index::init()->loadTemplateAsString($oDTRoutingAdditional->get_sNoscript())}
	{{module}\View\Index::init()->loadTemplateAsString($oDTRoutingAdditional->get_sCookieConsent())}

	{foreach key=sKey item=sItem from=$oDTRoutingAdditional->get_aScript()}
		<script src="{$sItem}" type="text/javascript"></script>
	{/foreach}
	</body>
</html>
