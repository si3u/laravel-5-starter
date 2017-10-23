$(function ()
{
    $("body").append("<div id='notify-container'></div>");
	/*
//    $("body").append("<audio id='notify-sound-success' src='/sounds/success.mp3'></audio>");
//    $("body").append("<audio id='notify-sound-warning' src='/sounds/warning.mp3'></audio>");
*/
});

/**
 * Global Success Helper
 * @param title
 * @param content
 * @param level
 */
function notify(title, content, level, timeout)
{
    $.notify({
        title: title,
        content: content,
        level: level ? level : 'success',
        icon: "fa fa-thumbs-o-up bounce animated",
        iconSmall: "fa fa-thumbs-o-up bounce animated",
        timeout: (timeout != undefined) ? timeout : 5000
    });
}

/**
 * Global Error Helper
 * @param title
 * @param content
 */
function notifyError(title, content, timeout)
{
    $.notify({
        title: title,
        content: content,
        level: 'danger',
        icon: "fa fa-thumbs-o-down shake animated",
        iconSmall: "fa fa-thumbs-o-down spin animated",
        timeout: (timeout != undefined) ? timeout : 8000
    });
}

/** PLUS BESOIN
 * AJOUT !!! (Modif dans /views/vendor/notify/notify.blade.php)
 * Global ADD Notify Helper
 * @param title
 * @param content
 * @param level
 * @param icon
 * @param iconSmall
 * @param timeout

function addNotify(title, content, level, icon, iconSmall, timeout)
{
    $.notify({
        title: title,
        content: content,
        level: level,
        icon: icon,
        iconSmall: iconSmall,
		timeout: timeout
    });
} */

var notifyCount = 0;
var notifyHeight = 0;

$.notify = function (settings)
{
    settings = $.extend({
        title: "",
        content: "",
        icon: undefined,
        iconSmall: undefined,
        level: 'info',
        timeout: undefined
    }, settings);

    // vars
    notifyCount = notifyCount + 1;
    var notifyId = "notify" + notifyCount;

 /*   // sound
    var soundFile = settings.level;
    if (settings.level == 'success') {
        soundFile = 'info';
    }
    if (settings.level == 'warning') {
        soundFile = 'danger';
    }
    document.getElementById('notify-sound-' + soundFile).play();
*/

    // play sound
	var tag_sound = document.getElementById('notify-sound-' + settings.level);
	if(tag_sound != undefined)
	{
		tag_sound.play();
	}

    // html markup
    var html = '<div id="' + notifyId + '"';
    html += 'class="notify animated fadeInRight fast alert-' + settings.level + '">';
    if (settings.icon == undefined) {
        html += '<div class="textfull"><h4>';
    } else {
        html += '<div class="icon-big"><i class="' + settings.icon + '"></i></div><div class="text"><h4>';
    }
    html += '<span>' + settings.title + '</span>'
    html += '<p>' + settings.content + '</p>';
    html += '</div><div>';
    if (settings.iconSmall) {
        html += '<i class="icon-small ' + settings.iconSmall + '"></i>';
    }
    html += '</h4></div></div>';

    // append html markup to container
    $("#notify-container").append(html);
   // if (notifyCount == 1 || $(".notify").size() <= 0) { // ERREUR AVEC Size()
    if (notifyCount == 1) {
        notifyHeight = $("#" + notifyId).height() + 40;
    } else {
        $("#" + notifyId).css("top", notifyHeight);

        // update all of their positions
        updateNotifyPositions(300);
    }

    // remove on timeout
    if (settings.timeout !== undefined && settings.timeout !== 0) {
        setTimeout(function ()
        {
            removeNotify($("#" + notifyId));
        }, settings.timeout);
    }

    // remove on click
    $("#notify" + notifyCount).bind('click', function ()
    {
        removeNotify($(this));
    });

    /**
     * Remove the notify and update the positions
     * @param ele
     */
    function removeNotify(ele)
    {
        // css3 animations
        ele.removeClass('fadeInRight').addClass('fadeOutRight');

        // after animation - remove and update other
        setTimeout(function ()
        {
            ele.remove();
            updateNotifyPositions(300)
        }, 400);
    }

    /**
     * Remove element
     * Update other notifies positions
     * @param ele
     */
    function updateNotifyPositions(delay)
    {
        $(".notify").each(function (index)
        {
            if (index == 0) {
                $(this).animate({top: 20}, delay);
                notifyHeight = $(this).height() + 40;
            } else {
                $(this).animate({top: notifyHeight}, delay + 50);
                notifyHeight += $(this).height() + 20;
            }
        });
    }
}