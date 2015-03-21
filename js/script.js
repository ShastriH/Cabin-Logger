/*
 Author: Shastri Harrinanan
 Version: 0.1.1.1
 Revision #003
 Date Revised: 20/01/2015
*/

function eventHandling() {
    $("#webDevAd").click(function () {
        window.location = "webdev.php";
    });
    $("#digitalMediaAd").click(function () {
        window.location = "media.php";
    });
    $("#programmingAd").click(function () {
        window.location = "programming.php";
    });
}

function boxMenuSlider() {
    $("#boxMenu").css({ "display": "block"});
    // Slide in and fade in with delay
    $("#programmingAd").animate({left: 0}, { duration: 1000, queue: false }).fadeTo(1000, 1);
    $("#digitalMediaAd").animate({left: 0}, { duration: 1250, queue: false }).delay(250).fadeTo(1000, 1);
    $("#webDevAd").animate({left: 0}, { duration: 1500, queue: false }).delay(500).fadeTo(1000, 1);
}

function toTop() {
    if ($("body").height() < $(window).height()) {
            $("#toTop").css({ "position": "absolute", "left": "-10000em"});
    }
    $(window).resize(function () {
        if ($("body").height() < $(window).height()) {
            $("#toTop").css({ "position": "absolute", "left": "-10000em"});
        } else {
            $("#toTop").css({ "position": "relative", "left": "0em"});
        }
    });
}

$(function () {
    eventHandling();
    boxMenuSlider();
    toTop();
    
    // Manually remove focus from a button when it is clicked
    $(".btn").mouseup(function(){
        $(this).blur();
    })
});