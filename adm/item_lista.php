<?php
include "../includes/auth.php";
include "../includes/header.php";
?>

<body>
    <div class="wrap">
        <div class="header">
            <div class="linha">
                <header>
                    <h1>Lista de itens</h1>
                    <nav>
                        <ul>
                            <li><a href="emprestimos_lista.php">Empréstimos</a></li>
                            <li class="active"><a href="item_lista.php">Itens</a></li>
                            <li><a href="usuario_lista.php">Usuários</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        <div class="linha">
            <a href="item_cadastro.php">Cadastrar novo item</a>
        </div>

        <div class="linha">
            <p><br/><br/><b>Lista de itens</b></p>
            <article>
                <table border='1' style='border-collapse:collapse'>
                    <tr align="center">
                        <th>Código</th>
                        <th>Item</th>
                        <th>Descrição</th>
                        <th>Data cadastro</th>
                        <th>Status</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    <?php
                        require_once "../bd/banco_dados.php";
                        require_once "../bd/banco_dados_consulta.php";

                        //Delete item
                        if(isset($_GET['idItem'])){
                            $idItem = $_GET['idItem'];
                            $consulta = "DELETE FROM sistema_emprestimo.item WHERE matricula=$idItem";
                            $item_delete = new banco_dados_consulta($consulta);
                            $item_delete->iniciadb();
                            $item_delete->execute_bd();
                        }


                        $consulta = "SELECT I.idItem, I.item, I.descricao, I.data_cadastro, I.ativo
                        FROM sistema_emprestimo.item as I";
                        $item_consulta = new banco_dados_consulta($consulta);
                        $item_consulta->iniciadb();
                        $stmt = $item_consulta->consulta_tudo();                        
                        foreach ($stmt as $row) {
                                $status = $row['ativo'] == 1 ? 'Ativo':'Inativo';
                                echo "<tr  align='center'>
                                    <td>".$row['idItem']."</td>
                                    <td>".$row['item']."</td>
                                    <td>".$row['descricao']."</td>
                                    <td>".$row['data_cadastro']."</td>
                                    <td>".$status."</td>
                                    <td><a href='item_cadastro.php?idItem=".$row['idItem']."'> Editar </td>
                                    <td><a href='item_lista.php?idItem=".$row['idItem']."'> Excluir </td>
                                </tr>";
                        }
                    ?>
                </table>
            </article>


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