import { MDCCheckbox } from '@material/checkbox';
import { MDCIconToggle } from '@material/icon-toggle';
import { MDCMenu } from '@material/menu';
import { MDCRipple } from '@material/ripple';
import { MDCSelect } from '@material/select';
import { MDCTemporaryDrawer } from '@material/drawer';
import { MDCTextField } from '@material/textfield';
import { MDCTopAppBar } from '@material/top-app-bar';
require('./player');

new MDCTopAppBar(document.getElementById('js-top-app-bar'));

document.getElementById('nav-menu-btn').addEventListener('click', function () {
  new MDCTemporaryDrawer(document.getElementById('js-app-drawer')).open = true;
});

let menuButton = document.getElementById('account-menu-button'),
  logoutButton = document.getElementById('logout-button');

if (menuButton) {
  menuButton.addEventListener('click', function () {
    let menu = new MDCMenu(document.getElementById('account-menu'));
    menu.open = !menu.open;
  });
}

if (logoutButton) {
  logoutButton.addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('logout-form').submit();
  });
}

document.querySelectorAll('.mdc-button').forEach(function (element) {
  new MDCRipple(element);
});

document.querySelectorAll('.mdc-icon-toggle').forEach(function (element) {
  new MDCIconToggle(element);
});

document.querySelectorAll('.mdc-text-field').forEach(function (element) {
  new MDCTextField(element);
});

document.querySelectorAll('.mdc-checkbox').forEach(function (element) {
  new MDCCheckbox(element);
});

document.querySelectorAll('.mdc-select').forEach(function (element) {
  new MDCSelect(element);
});
