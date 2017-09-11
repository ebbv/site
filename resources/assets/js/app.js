import { MDCCheckbox } from '@material/checkbox/dist/mdc.checkbox';
import { MDCIconToggle } from '@material/icon-toggle/dist/mdc.iconToggle';
import { MDCLinearProgress } from '@material/linear-progress/dist/mdc.linearProgress';
import { MDCRipple } from '@material/ripple/dist/mdc.ripple';
import { MDCTemporaryDrawer } from '@material/drawer/dist/mdc.drawer';
import { MDCTextfield } from '@material/textfield/dist/mdc.textfield';
import { MDCToolbar } from '@material/toolbar/dist/mdc.toolbar';

new MDCToolbar(document.querySelector('.mdc-toolbar'));

document.querySelector('.mdc-toolbar__icon--menu').addEventListener('click', function (e) {
  e.preventDefault();
  new MDCTemporaryDrawer(document.querySelector('.mdc-temporary-drawer')).open = true;
});

for (let i = 0, node; node = document.querySelectorAll('.mdc-button')[i]; i++) {
  MDCRipple.attachTo(node);
}

for (let i = 0, node; node = document.querySelectorAll('.mdc-icon-toggle')[i]; i++) {
  new MDCIconToggle(node);
}

for (let i = 0, node; node = document.querySelectorAll('.mdc-textfield')[i]; i++) {
  new MDCTextfield(node);
}

for (let i = 0, node; node = document.querySelectorAll('.mdc-checkbox')[i]; i++) {
  new MDCCheckbox(node);
}

let player = {
  init : function () {
    for (let i = 0, node; node = document.querySelectorAll('.player')[i]; i++) {
      let audio = node.querySelector('audio');
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
    if (e.target.tagName === 'I') {
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
