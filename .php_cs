<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['storage', 'bootstrap'])
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()->setFinder($finder);
