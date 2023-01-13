/**
 * vanilla js dom ready
 * @see http://stackoverflow.com/a/13456810/2487859
 */
window.readyHandlers = [];
window.ready = function ready(handler) {window.readyHandlers.push(handler); handleState();};
window.handleState = function handleState () {if (['interactive', 'complete'].indexOf(document.readyState) > -1) {while(window.readyHandlers.length > 0) {(window.readyHandlers.shift())();}}};
document.onreadystatechange = window.handleState;

function getOffset(oElement) {
    var rect = oElement.getBoundingClientRect(),
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}

document.getElementById("myMvcToolbar").addEventListener("click", function(oEvent){
    oEvent.stopPropagation();
});

function setExpand()
{
    document.getElementById("myMvcToolbar").classList.remove('myMvcToolbar_shrink');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_shrink');
    document.getElementById("myMvcToolbar").classList.add('myMvcToolbar_expand');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_expand');
}

function setShrink()
{
    document.getElementById("myMvcToolbar").classList.remove('myMvcToolbar_expand');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_expand');
    document.getElementById("myMvcToolbar").classList.add('myMvcToolbar_shrink');
    document.getElementById("myMvcToolbar_head").classList.remove('myMvcToolbar_shrink');
}

function toggleInOut()
{
    // Using an if statement to check the class
    if (document.getElementById("myMvcToolbar").classList.contains('myMvcToolbar_shrink')) {
        setExpand();
    } else {
        setShrink();
    }
}

document.getElementById("myMvcToolbar_toggle").addEventListener("click", function(){

    toggleInOut();
    var oCoords = getOffset(this);
    (parseInt(oCoords.left) < 800) ? oCoords.left = 0 : false;
    localStorage.setItem("myMvcToolbar_toggle", parseInt(oCoords.left));
});

window.addEventListener('click', function (evt) {
    for (var i = 1; i < 10; i++) {
        var oElement = document.getElementById('tab' + i);
        if (null !== oElement) {
            oElement.checked = false;
        }
    }
});