<?php

    require('carrega/twig.php');

    $erro = $_GET['erro'] ?? false;

    echo $twig->render('login.html', ['erro' => $erro,]);