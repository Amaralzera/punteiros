<?php
    # verifica_login.php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('location:login.php?erro=2');
        die;
    }
