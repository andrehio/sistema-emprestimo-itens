<?php
include "../includes/auth.php";
include "../includes/header.php";
?>

<body>
    <div class="wrap">
        <div class="header">
            <div class="linha">
                <header>
                    <h1>Lista de usuários</h1>
                    <nav>
                        <ul>
                            <li><a href="emprestimos_lista.php">Empréstimos</a></li>
                            <li><a href="item_lista.php">Itens</a></li>
                            <li class="active"><a href="usuario_lista.php">Usuários</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        <div class="linha">
            <a href="usuario_cadastro.php">Cadastrar novo usuário</a>
        </div>

        <div class="linha">
            <p><br/><br/><b>Lista de usuários</b></p>
            <article>
                <table border='1' style='border-collapse:collapse'>
                    <tr align="center">
                        <th>Matrícula</th>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Data cadastro</th>
                        <th>Nivel</th>
                        <th>Status</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    <?php
                        require_once "../bd/banco_dados.php";
                        require_once "../bd/banco_dados_consulta.php";

                        //Delete usuario
                        if(isset($_GET['matricula'])){
                            $matricula = $_GET['matricula'];
                            $consulta = "DELETE FROM sistema_emprestimo.login WHERE matricula=$matricula";
                            $usuarios_delete = new banco_dados_consulta($consulta);
                            $usuarios_delete->iniciadb();
                            $usuarios_delete->execute_bd();

                            $consulta = "DELETE FROM sistema_emprestimo.usuario WHERE matricula=$matricula";
                            $usuarios_delete->set_query($consulta);
                            $usuarios_delete->execute_bd();
                        }


                        $consulta = "SELECT U.matricula, U.cpf, U.nome, U.sobrenome, L.email, L.telefone,
                        L.data_cadastro, L.nivel, U.ativo
                        FROM sistema_emprestimo.usuario as U 
                        JOIN sistema_emprestimo.login as L
                        ON U.matricula = L.matricula";
                        $usuarios_consulta = new banco_dados_consulta($consulta);
                        $usuarios_consulta->iniciadb();
                        $stmt = $usuarios_consulta->consulta_tudo();                        
                        foreach ($stmt as $row) {
                                $status = $row['ativo'] == 1 ? 'Ativo':'Inativo';
                                echo "<tr  align='center'>
                                    <td>".$row['matricula']."</td>
                                    <td>".$row['cpf']."</td>
                                    <td>".$row['nome']."</td>
                                    <td>".$row['sobrenome']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['telefone']."</td>
                                    <td>".$row['data_cadastro']."</td>
                                    <td>".$row['nivel']."</td>
                                    <td>".$status."</td>
                                    <td><a href='usuario_cadastro.php?matricula=".$row['matricula']."'> Editar </td>
                                    <td><a href='usuario_lista.php?matricula=".$row['matricula']."'> Excluir </td>
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