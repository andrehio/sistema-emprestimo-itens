<?php

    //(Re)iniciar sessão
    session_start();

    //Se não foi criada uma sessão autenticada
    if(!isset($_SESSION['cpf'])){
        if ($_SESSION['nivel'] != 'adm'){
            header("Location: ../index.php?auth=1");
        }
    }
    

?>