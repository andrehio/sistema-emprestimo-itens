<?php
require_once "banco_dados.php";
class banco_dados_consulta extends banco_dados{

    public $con;
    private $consulta;
    private $coluna_busca;

    function __construct($consulta){
        $this->consulta = $consulta;
    }

    public function consulta_single_parameter(){
        $stmt = $this->con -> query($this->consulta);
        while ($row = $stmt->fetch()) {
            return $row[$this->coluna_busca];
        }
    }

    public function consulta_tudo(){
        $stmt = $this->con -> query($this->consulta)->fetchAll();
        return $stmt;
        
    }

    public function set_con($conn){
        $this->con = $conn;
    }

    public function set_coluna_busca($coluna_busca){
        $this->coluna_busca = $coluna_busca;
    }

    public function set_query($consulta){
        $this->consulta = $consulta;
    }

    public function execute_bd(){
        $stmt = $this->con -> prepare($this->consulta);
        $stmt->execute();
    }
}
?>