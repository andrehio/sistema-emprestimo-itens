<?php

    //(Re)iniciar sessão
    session_start();
    unset($_SESSION['cpf']);
    unset($_SESSION['nivel']);

    header("Location: ../index.php");

?>