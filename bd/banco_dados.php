<?php

abstract class banco_dados{
    const SERVER = 'localhost';
    const BD = 'sistema_emprestimo';
    const SENHA = '';
    const USER = 'root';
    public $con;

    public function iniciadb(){
        try{
            $this->con = new PDO('mysql:host='.self::SERVER.';port=3307;dbname='.self::BD, self::USER, self::SENHA);
        }
        catch(PDOException $e){
            echo 'Erro gerado '.$e->getMessage();
        }
    }
    public function sucesso($is_sucesso, $local){
        if ($is_sucesso == TRUE){
            header($local);
        }
    }

}
?>