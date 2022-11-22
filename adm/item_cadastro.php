<?php
include "../includes/auth.php";
include "../includes/header.php";
require_once "../bd/banco_dados.php";
require_once "../bd/banco_dados_consulta.php";

$idItem = "";
$item = "";
$descricao = "";
$data_cadastro = date("Y-m-d");
$ativo = ["on" => "checked", "off" => ""];

if(isset($_GET['idItem'])){
    $idItem = $_GET['idItem'];
    $consulta = "SELECT I.idItem, I.item, I.descricao, I.data_cadastro, I.ativo
    FROM sistema_emprestimo.item as I
    WHERE idItem = $idItem";
    $itens_formulario = new banco_dados_consulta($consulta);
    $itens_formulario->iniciadb();
    $stmt = $itens_formulario->consulta_tudo();

    $idItem = $stmt[0]['idItem'];
    $item = $stmt[0]['item'];
    $descricao = $stmt[0]['descricao'];
    $data_cadastro = $stmt[0]['data_cadastro'];
    if ($stmt[0]['ativo'] == "0"){
        $ativo["off"] = "checked";
        $ativo["on"] = "";
    }
}
?>

<body>
    <div class="wrap">
        <div class="header">
            <div class="linha">
                <header>
                    <h1>Lista de itens</h1>
                    <nav>
                        <ul>
                            <li><a href="item_lista.php">Voltar</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        <div class="linha">
            <form class="novo_cadastro" name="novo_item" action="item_recebe.php" method="post">
                <div>
                    <h2>Novo item</h2>
                </div>
                <input type="hidden" id="idItem" name="idItem" value="<?php echo $idItem; ?>">
                <label for="item_novo">Item:</label>
                <div>
                    <input type="text" id="item_novo" name="item_novo" placeholder="Nome do item" 
                    title="Digite o nome do item" required="" value="<?php echo $item; ?>">
                </div>
                <label for="descricao_novo">Descrição:</label>
                <div>
                    <input type="text" id="descricao_novo" name="descricao_novo" placeholder="Descrição do item" 
                    title="Digite a descrição do item" value="<?php echo $descricao; ?>">
                </div>
                <label for="data_item_novo">Data de cadastro:</label>
                <div>
                    <input type="date" id="data_item_novo" name="data_item_novo" 
                    title="Selecione a data de cadastro" value="<?php echo $data_cadastro; ?>">
                </div>
                <label for="item_status_novo">Status:</label>
                <div class="radio">
                    <input type="radio" name="item_status_novo" value="1" <?php echo $ativo["on"]; ?>/>Ativo
                    <input type="radio" name="item_status_novo" value="0" <?php echo $ativo["off"]; ?>/>Inativo
                </div>
                <div class="botao">
                    <input type="submit" name="salvar" value="Salvar">
                </div>

            </form>
        </div>
    </div>
    <div class="footer">
        <div class="linha">
            <?php
                include "../includes/footer.php"
            ?>
        </div>
    </div>
</body>

</html>