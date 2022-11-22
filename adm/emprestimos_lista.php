<?php
include "../includes/auth.php";
include "../includes/header.php";
?>

<body>
    <div class="wrap">
        <div class="header">
            <div class="linha">
                <header>
                    <h1>Lista de empréstimos</h1>
                    <nav>
                        <ul>
                            <li class="active"><a href="emprestimos_lista.php">Empréstimos</a></li>
                            <li><a href="item_lista.php">Itens</a></li>
                            <li><a href="usuario_lista.php">Usuários</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        <div class="linha">
            <a href="emprestimos_cadastro.php">Cadastrar novo empréstimo</a>
        </div>

        <div class="linha">
            <p><br/><br/><b>Lista de empréstimos</b></p>
            <table border='1' style='border-collapse:collapse'>
                    <tr align="center">
                        <th>Código do empréstimo</th>
                        <th>Código do item</th>
                        <th>Item</th>
                        <th>Matrícula do usuário</th>
                        <th>Nome do usuário</th>
                        <th>Data do empréstimo</th>
                        <th>Data do combinada para devolução</th>
                        <th>Data de devolução</th>
                        <th>Status</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    <?php
                        require_once "../bd/banco_dados.php";
                        require_once "../bd/banco_dados_consulta.php";

                        //Delete item
                        if(isset($_GET['idEmprestimo'])){
                            $idEmprestimo = $_GET['idEmprestimo'];
                            $consulta = "DELETE FROM sistema_emprestimo.emprestimo WHERE idEmprestimo=$idEmprestimo";
                            $emprestimo_delete = new banco_dados_consulta($consulta);
                            $emprestimo_delete->iniciadb();
                            $emprestimo_delete->execute_bd();
                        }


                        $consulta = "SELECT E.idEmprestimo, E.idItem, E.matricula, E.data_emprestimo,
                        E.data_devolucao_combinada, E.data_devolucao_efetiva, E.ativo, I.item, U.nome, U.sobrenome
                        FROM sistema_emprestimo.emprestimo as E
                        JOIN sistema_emprestimo.item as I
                        ON E.idItem = I.idItem
                        JOIN sistema_emprestimo.usuario as U
                        ON E.matricula = U.matricula
                        ORDER BY E.ativo DESC";                        ;
                        $emprestimo_consulta = new banco_dados_consulta($consulta);
                        $emprestimo_consulta->iniciadb();
                        $stmt = $emprestimo_consulta->consulta_tudo();                        
                        foreach ($stmt as $row) {
                                $status = $row['ativo'] == 1 ? 'Ativo':'Inativo';
                                echo "<tr  align='center'>
                                    <td>".$row['idEmprestimo']."</td>
                                    <td>".$row['idItem']."</td>
                                    <td>".$row['item']."</td>
                                    <td>".$row['matricula']."</td>
                                    <td>".$row['nome']." ".$row['sobrenome']."</td>
                                    <td>".$row['data_emprestimo']."</td>
                                    <td>".$row['data_devolucao_combinada']."</td>
                                    <td>".$row['data_devolucao_efetiva']."</td>
                                    <td>".$status."</td>
                                    <td><a href='emprestimos_cadastro.php?idEmprestimo=".$row['idEmprestimo']."'> Editar </td>
                                    <td><a href='emprestimos_lista.php?idEmprestimo=".$row['idEmprestimo']."'> Excluir </td>
                                </tr>";
                        }
                    ?>
                </table>
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