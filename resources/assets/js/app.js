import { MDCCheckbox } from '@material/checkbox';
import { MDCIconToggle } from '@material/icon-toggle';
import { MDCLinearProgress } from '@material/linear-progress';
import { MDCRipple } from '@material/ripple';
import { MDCSelect } from '@material/select';
import { MDCTemporaryDrawer } from '@material/drawer';
import { MDCTextField } from '@material/textfield';
import { MDCTopAppBar } from '@material/top-app-bar';

new MDCTopAppBar(document.querySelector('.mdc-top-app-bar'));

document.querySelector('.mdc-top-app-bar__navigation-icon').addEventListener('click', function (e) {
  e.preventDefault();
  new MDCTemporaryDrawer(document.querySelector('.mdc-drawer--temporary')).open = true;
});

for (let i = 0, nodes = document.querySelectorAll('.mdc-button'), items = nodes.length; i < items; i++) {
  MDCRipple.attachTo(nodes[i]);
}

for (let i = 0, nodes = document.querySelectorAll('.mdc-icon-toggle'), items = nodes.length; i < items; i++) {
  new MDCIconToggle(nodes[i]);
}

for (let i = 0, nodes = document.querySelectorAll('.mdc-text-field'), items = nodes.length; i < items; i++) {
  new MDCTextField(nodes[i]);
}

for (let i = 0, nodes = document.querySelectorAll('.mdc-checkbox'), items = nodes.length; i < items; i++) {
  new MDCCheckbox(nodes[i]);
}

for (let i = 0, nodes = document.querySelectorAll('.mdc-select'), items = nodes.length; i < items; i++) {
  new MDCSelect(nodes[i]);
}

let player = {
  init : function () {
    for (let i = 0, nodes = document.querySelectorAll('.player'), items = nodes.length; i < items; i++) {
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
