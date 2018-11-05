import { MDCLinearProgress } from '@material/linear-progress';

let player = {
  init : function () {
    for (let i = 0, nodes = document.querySelectorAll('.js-player'), items = nodes.length; i < items; i++) {
      let audio = nodes[i].querySelector('audio');
      if (! audio.duration) {
        audio.addEventListener('durationchange', function () {
          player.time(this);
        }, false);
      } else {
        player.time(audio);
      }
    }
  },
  control : function (e) {
    if (e.target.tagName === 'BUTTON') {
      let audio = e.target.parentNode.parentNode.querySelector('audio');
      if (audio.paused) {
        audio.play();
      } else {
        audio.pause();
      }
      audio.addEventListener('timeupdate', function () {
        player.time(audio);
      }, false);
    }
  },
  time : function (audio) {
    let curtime   = parseInt(audio.currentTime, 10),
      duration    = parseInt(audio.duration, 10),
      remaining   = duration - curtime,
      mins        = Math.floor(remaining / 60, 10),
      secs        = remaining - mins * 60,
      righttime   = mins + ':' + (secs > 9 ? secs : '0' + secs),
      playedmins  = Math.floor(curtime / 60, 10),
      playedsecs  = curtime - playedmins * 60,
      lefttime    = playedmins + ':' + (playedsecs <= 9 ? '0' + playedsecs : playedsecs);

    new MDCLinearProgress(audio.nextElementSibling.querySelector('.mdc-linear-progress')).progress = curtime / duration;

    audio.previousElementSibling.textContent = lefttime + ' / ' + '-' + righttime;
  }
};

player.init();
document.getElementById('content').addEventListener('click', player.control, false);
