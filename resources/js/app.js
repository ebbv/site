import { MDCCheckbox } from '@material/checkbox';
import { MDCDrawer } from '@material/drawer';
import { MDCIconButtonToggle } from '@material/icon-button';
import { MDCMenu } from '@material/menu';
import { MDCRipple } from '@material/ripple';
import { MDCSelect } from '@material/select';
import { MDCTextField } from '@material/textfield';
import { MDCTopAppBar } from '@material/top-app-bar';
require('./player');

new MDCTopAppBar(document.getElementById('js-top-app-bar'));

document.getElementById('nav-menu-btn').addEventListener('click', function () {
  new MDCDrawer(document.getElementById('js-app-drawer')).open = true;
});

let menuButton = document.getElementById('account-menu-button');

if (menuButton) {
  let accountMenu = menuButton.nextElementSibling;

  menuButton.addEventListener('click', function () {
    let menu = new MDCMenu(accountMenu);
    menu.open = !menu.open;
  });

  accountMenu.querySelector('#logout-button').addEventListener('click', function (e) {
    e.preventDefault();
    this.previousElementSibling.submit();
  });
}

document.querySelectorAll('.mdc-button').forEach(function (element) {
  new MDCRipple(element);
});

document.querySelectorAll('.mdc-icon-button').forEach(function (element) {
  new MDCIconButtonToggle(element);
});

document.querySelectorAll('.mdc-text-field').forEach(function (element) {
  new MDCTextField(element);
});

document.querySelectorAll('.mdc-checkbox').forEach(function (element) {
  new MDCCheckbox(element);
});

document.querySelectorAll('.mdc-select').forEach(function (element) {
  let select = new MDCSelect(element);

  select.listen('MDCSelect:change', () => {
    if (element.classList.contains('bulletin-select')) {
      location.href = select.value;
    }
  });
});
