var $,
    player = {
        init : function () {
            "use strict";
            $('.player').each(function () {
                var audio            = $(this).find('audio').get(0),
                    button           = $(this).find('.playtoggle'),
                    loadingIndicator = $(this).find('.loading'),
                    loaded           = false,
                    manualSeek       = false,
                    parent           = this;

                if ((audio.buffered !== undefined) && (audio.buffered.length !== 0)) {
                    $(audio).on('progress', function () {
                        var loaded = parseInt(((audio.buffered.end(0) / audio.duration) * 100), 10);
                        loadingIndicator.css({width: loaded + '%'});
                    });
                } else {
                    loadingIndicator.remove();
                }

                $(audio).on('timeupdate', function () {
                    var ad          = parseInt(audio.duration, 10),
                        ct          = parseInt(audio.currentTime, 10),
                        pos         = (ct / ad) * 100,
                        rem         = ad - ct,
                        mins        = Math.floor(rem / 60, 10),
                        secs        = rem - mins * 60,
                        righttime   = mins + ':' + (secs > 9 ? secs : '0' + secs),
                        playedmins  = Math.floor(ct / 60, 10),
                        playedsecs  = ct - playedmins * 60,
                        lefttime    = playedmins + ':' + (playedsecs <= 9 ? '0' + playedsecs : playedsecs);

                    $(parent).find('.timeleft').text(lefttime + ' / ' + '-' + righttime);

                    if (!manualSeek) {
                        $(parent).find('.handle').css({left: pos + '%'});
                    }
                    if (!loaded) {
                        loaded = true;

                        $(parent).find('.gutter').slider({
                            value: 0,
                            step: 0.01,
                            orientation: "horizontal",
                            range: "min",
                            max: audio.duration,
                            animate: true,
                            slide: function () {
                                manualSeek = true;
                            },
                            stop: function (e, ui) {
                                manualSeek = false;
                                audio.currentTime = ui.value;
                            }
                        });
                    }
                }).on('play', function () {
                    button.addClass('playing');
                }).on('pause ended', function () {
                    button.removeClass('playing');
                });
                
                button.on('click', function () {
                    if (audio.paused) {
                        audio.play();
                    } else {
                        audio.pause();
                    }
                });
            });
        }
    };

$(document).foundation({
    topbar : {
        custom_back_text: false,
        is_hover: true
    }
});

player.init();