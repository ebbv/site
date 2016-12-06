<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('storage')
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()->setFinder($finder);
