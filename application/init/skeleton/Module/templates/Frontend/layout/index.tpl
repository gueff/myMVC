<!doctype html>{* @see https://getbootstrap.com/docs/5.3/getting-started/introduction/ *}
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{$oDTRoutingAdditional->get_sTitle()}</title>

		<link rel="icon" href="/favicon.ico">

		{foreach key=sKey item=sItem from=$oDTRoutingAdditional->get_aStyle()}
		<link href="{$sItem}" rel="stylesheet" type="text/css">
		{/foreach}

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
