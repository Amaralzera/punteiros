<?php

require('vendor/autoload.php');

$loader = new \Twig\Loader\FilesystemLoader('./template');

$twig = new \Twig\Environment($loader);