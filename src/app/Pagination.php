<?php

namespace App;

use Landish\Pagination\ZurbFoundation;

class Pagination extends ZurbFoundation {

  protected $activePageWrapper = '<li class="current">%s</li>';

  protected $disabledPageWrapper = '<li class="disabled">%s</li>';
}
