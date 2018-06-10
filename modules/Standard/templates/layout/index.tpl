<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <title>{$sTitle}</title>

	<link rel="stylesheet" href="/myMVC/assets/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/myMVC/assets/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/myMVC/assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/myMVC/styles/myMVC.css">
  </head>

  <body>
	<a name="top"></a>
    <div class="container">
		{include file="layout/header.tpl"}
		
		{$sContent}

		{include file="layout/footer.tpl"}
    </div>  	
    
    <div id="myMVC_cookieConsent">
        This website uses cookies to provide you with the best possible service. 
        Further information can be found in our <a href="/data-protection-declaration/">data protection declaration</a>. 
        Click in the following checkbox to accept cookies. Then confirm by clicking on "Save".
        <input id="myMVC_cookieConsentCheckbox" type="checkbox" name="checked" value="0">&nbsp;<label for="myMVC_cookieConsentCheckbox">Yes, cookies may be stored.</label>
        <button class="btn btn-default">
            Save
        </button>
    </div>
    
	<!--[if lt IE 9]><script src="/myMVC/assets/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->	
	<script src="/myMVC/assets/jquery/3.3.1/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/myMVC/assets/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="/myMVC/assets/bootstrap-3.3.7-dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/myMVC/assets/showdown/0.4.0/Showdown.min.js"></script>
	<script>
		{literal}
		$(document).ready(function() {
			
            // markdown
			if ($('.markdown').length) {
				var converter = new Showdown.converter();
				$('.markdown').html(converter.makeHtml($('.markdown').html()));
				$('.markdown img').addClass('img-responsive');
			}
            
            // cookie consent
            if ('undefined' === typeof $.cookie('myMVC_cookieConsent')) {$('#myMVC_cookieConsent').fadeIn();}
            $('#myMVC_cookieConsent button').on('click', function(oEvent){
                if (true === $('#myMVC_cookieConsent input').is(':checked')) {
                    $.cookie('myMVC_cookieConsent', true, {expires: 365, path:"/"});  
                    $('#myMVC_cookieConsent').fadeOut();
                }       
            });            
		});
		{/literal}
	</script>
  </body>
</html>