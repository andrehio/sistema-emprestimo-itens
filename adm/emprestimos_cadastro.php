<?php
include "../includes/auth.php";
include "../includes/header.php";
require_once "../bd/banco_dados.php";
require_once "../bd/banco_dados_consulta.php";

$idEmprestimo = "";
$idItem = "";
$matricula = "";
$data_emprestimo = date("Y-m-d");
$data_devolucao_combinada = "";
$data_devolucao_efetiva = "";
$ativo = ["on" => "checked", "off" => ""];

if(isset($_GET['idEmprestimo'])){
    $idEmprestimo = $_GET['idEmprestimo'];
    $consulta = "SELECT E.idEmprestimo, E.idItem, E.matricula, E.data_emprestimo,
     E.data_devolucao_combinada, E.data_devolucao_efetiva, E.ativo
    FROM sistema_emprestimo.emprestimo as E
    WHERE idEmprestimo = $idEmprestimo";
    $emprestimos_formulario = new banco_dados_consulta($consulta);
    $emprestimos_formulario->iniciadb();
    $stmt = $emprestimos_formulario->consulta_tudo();

    $idEmprestimo = $stmt[0]['idEmprestimo'];
    $idItem = $stmt[0]['idItem'];
    $matricula = $stmt[0]['matricula'];
    $data_emprestimo = $stmt[0]['data_emprestimo'];
    $data_devolucao_combinada = $stmt[0]['data_devolucao_combinada'];
    $data_devolucao_efetiva = $stmt[0]['data_devolucao_efetiva'];
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
                    <h1>Novo cadastro de empréstimos</h1>
                    <nav>
                        <ul>
                            <li><a href="emprestimos_lista.php">Voltar</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        <div class="linha">
            <form class="novo_cadastro" name="novo_emprestimo" action="emprestimo_recebe.php" method="post">
                <div>
                    <h2>Novo empréstimo</h2>
                </div>
                <input type="hidden" id="idEmprestimo" name="idEmprestimo" value="<?php echo $idEmprestimo; ?>">
                <label for="idItem">Código do item:</label>
                <div>
                    <input type="text" id="idItem" name="idItem" placeholder="Código do item"
                     title="Digite o código do item a ser emprestado" required="" value="<?php echo $idItem; ?>">
                </div>
                <label for="matricula">Matrícula do usuário:</label>
                <div>
                    <input type="number" id="matricula" name="matricula" placeholder="Número da matrícula" 
                    title="Digite o número da matrícula" required="" value="<?php echo $matricula; ?>">
                </div>
                <label for="data_emprestimo">Data do empréstimo:</label>
                <div>
                    <input type="date" id="data_emprestimo" name="data_emprestimo" 
                    title="Selecione a data de empréstimo" required="" value="<?php echo $data_emprestimo; ?>">
                </div>
                <label for="data_devolucao_combinada">Data do combinada para devolução:</label>
                <div>
                    <input type="date" id="data_devolucao_combinada" name="data_devolucao_combinada" 
                    title="Selecione a data de devolução" required="" value="<?php echo $data_devolucao_combinada; ?>">
                </div>
                <label for="data_devolucao_efetiva">Data de devolução: (deixar em branco se não foi devolvido)</label>
                <div>
                    <input type="date" id="data_devolucao_efetiva" name="data_devolucao_efetiva" 
                    title="Selecione a data que o item foi devolvido" value="<?php echo $data_devolucao_efetiva; ?>">
                </div>
                <label for="ativo">Status:</label>
                <div class="radio">
                    <input type="radio" name="ativo" value="1" <?php echo $ativo["on"]; ?>/>Ativo
                    <input type="radio" name="ativo" value="0" <?php echo $ativo["off"]; ?>/>Inativo
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