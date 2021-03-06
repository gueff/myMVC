/**
 * Cookie Consent Handling
 * @requires jquery
 */
$(document).ready(function() {

    // cookie consent
    if ('undefined' === typeof $.cookie('myMVC_cookieConsent')) {$('#myMVC_cookieConsent').fadeIn();}
    $('#myMVC_cookieConsent button').on('click', function(oEvent){
        if (true === $('#myMVC_cookieConsent input').is(':checked')) {
            $.cookie('myMVC_cookieConsent', true, {expires: 365, path:"/"});
            $('#myMVC_cookieConsent').fadeOut(function(){
                'slow',
                    location.reload();
            });
        }
    });
});
