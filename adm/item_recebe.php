<?php
require_once "../bd/banco_dados.php";
require_once "../bd/banco_dados_consulta.php";
require_once "../bd/tratamento_var.php";

class recebe_item extends banco_dados{
    private $idItem;
    private $descricao;
    private $item;
    private $data_cadastro;
    private $ativo;
    private $is_sucesso;

    function __construct(){
        tratamento::limpa_variaveis();

        //Sistema_Emprestimo.item
        $this->item = $_POST["item_novo"];
        $this->descricao = $_POST["descricao_novo"];
        $this->data_cadastro = $_POST["data_item_novo"];
        $this->ativo = $_POST["item_status_novo"];
    }

    public function inserir(){
        try{
            //Insert em sistema_emprestimo.item
            $query = "INSERT INTO sistema_emprestimo.item(item, descricao, data_cadastro, ativo)
                  VALUES
                  ('$this->item', '$this->descricao', '$this->data_cadastro', '$this->ativo')";
            $item_inserir = new banco_dados_consulta($query);
            $item_inserir->set_con($this->con);
            $item_inserir->execute_bd();
            header("Location: item_lista.php");
        }
        catch(PDOException $e){
            echo 'Erro gerado '.$e->getMessage();
        }
    }

    public function atualizar(){
        try{
            $this->idItem = $_POST['idItem'];
            //Update em sistema_emprestimo.item
            $query = "UPDATE sistema_emprestimo.item
                  SET item='$this->item', descricao='$this->descricao', data_cadastro='$this->data_cadastro', ativo='$this->ativo'
                  WHERE idItem='$this->idItem'";
            $item_atualizar = new banco_dados_consulta($query);
            $item_atualizar->set_con($this->con);
            $item_atualizar->execute_bd();
            header("Location: item_lista.php");
        }
        catch(PDOException $e){
            echo 'Erro gerado '.$e->getMessage();
        }
    }
}


// MAIN
if (!isset($_POST) || empty($_POST)) {
    echo 'Nada foi postado.';
}
else{
    if(empty($_POST['idItem'])){
        //Insert
        $novo_item = new recebe_item();
        $novo_item->iniciadb();
        $novo_item->inserir(); 
    }
    else{
        //Update
        $editar_item = new recebe_item();
        $editar_item->iniciadb();
        $editar_item->atualizar();
    }
     
}

?>