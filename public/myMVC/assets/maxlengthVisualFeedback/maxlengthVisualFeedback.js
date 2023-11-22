
/**
 * @param {object} oObject
 * @param {integer} iSectionA
 * @param {integer} iSectionB
 * @param {integer} iSectionC
 */ 
function maxlengthVisualFeedback(oObject, iSectionA, iSectionB, iSectionC) {
    
    var iSectionA = ('undefined' === typeof iSectionA) ? 50 : iSectionA;
    var iSectionB = ('undefined' === typeof iSectionB) ? 70 : iSectionB;
    var iSectionC = ('undefined' === typeof iSectionC) ? 100 : iSectionC;
    
    if (null === oObject.val()) {
        return false
    }
    
    $(oObject).on('blur', function() {
        $('.maxlengthVisualFeedbackBar').hide()
    });
    
    var iProgressBarId = oObject.next().attr('data-consumptionBar');
    
    if ('undefined' === typeof iProgressBarId) {
        var iTimestamp = Date.now();
        $('<div id="' + iTimestamp + '" data-consumptionBar="' + iTimestamp + '" class="maxlengthVisualFeedbackBar progress progress-striped active"><div class="progress-bar"><div class="progresstext"></div></div></div>').insertAfter(oObject);
        $('.maxlengthVisualFeedbackBar').hide();
        $(oObject).focus();
        return false
    }
    
    var iMaxlength = (('undefined' !== typeof oObject.attr('maxlength') ? oObject.attr('maxlength') : (('undefined' !== typeof oObject.attr('data-maxlength')) ? oObject.attr('data-maxlength') : false)));
    
    if (false === iMaxlength) {
        return false
    }
    
    var iPercent = (oObject.val().length * 100 / iMaxlength);
    (iPercent >= iSectionA) ? $('#' + iProgressBarId).show(): $('#' + iProgressBarId).hide();
    (iPercent >= iSectionA && iPercent < iSectionB) ? $('#' + iProgressBarId + ' .progress-bar').removeClass('progress-bar-warning progress-bar-danger').addClass('progress-bar-info'): false;
    (iPercent >= iSectionB && iPercent < iSectionC) ? $('#' + iProgressBarId + ' .progress-bar').removeClass('progress-bar-info progress-bar-danger').addClass('progress-bar-warning'): false;
    (iPercent >= iSectionC) ? $('#' + iProgressBarId + ' .progress-bar').removeClass('progress-bar-info progress-bar-warning').addClass('progress-bar-danger'): false;
    $('#' + iProgressBarId).css({'width': oObject.outerWidth()});
    (iPercent <= 100) ? $('#' + iProgressBarId + ' .progress-bar').css({width: iPercent + '%'}): false;
    $('#' + iProgressBarId + ' .progresstext').text(Math.round(iPercent) + '%');
    
    return true
}
