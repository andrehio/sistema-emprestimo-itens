<?php
    include "../includes/auth.php";
    include "../includes/header.php";
    require_once "../bd/banco_dados.php";
    require_once "../bd/banco_dados_consulta.php";

    $matricula = "";
    $cpf = "";
    $nome = "";
    $sobrenome = "";
    $telefone = "";
    $email = "";
    $nivel = ["adm" => "", "user" => "checked"];
    $data_cadastro = date("Y-m-d");
    $ativo = ["on" => "checked", "off" => ""];

    if(isset($_GET['matricula'])){
        $matricula = $_GET['matricula'];
        $consulta = "SELECT U.matricula, U.cpf, U.nome, U.sobrenome, L.email, L.telefone,
        L.data_cadastro, L.nivel, U.ativo
        FROM sistema_emprestimo.usuario AS U
        JOIN sistema_emprestimo.login AS L
        ON U.matricula = L.matricula AND U.matricula = $matricula";
        $usuarios_formulario = new banco_dados_consulta($consulta);
        $usuarios_formulario->iniciadb();
        $stmt = $usuarios_formulario->consulta_tudo();

        $matricula = $stmt[0]['matricula'];
        $cpf = $stmt[0]['cpf'];
        $nome = $stmt[0]['nome'];
        $sobrenome = $stmt[0]['sobrenome'];
        $telefone = $stmt[0]['telefone'];
        $email = $stmt[0]['email'];
        if ($stmt[0]['nivel'] == "adm"){
            $nivel["adm"] = "checked";
            $nivel["user"] = "";
        }
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
                    <h1>Novo cadastro de usuário</h1>
                    <nav>
                        <ul>
                            <li><a href="usuario_lista.php">Voltar</a></li>
                            <li><a href="../index.php">Logout</a></li>
                        </ul>
                    </nav>
                </header>
            </div>
        </div>
        <div class="linha">
            <form class="novo_cadastro" name="novo_usuario" action="usuario_recebe.php" method="post">
                <div>
                    <h2>Novo usuário</h2>
                </div>
                <input type="hidden" id="matricula" name="matricula" value="<?php echo $matricula; ?>">

                <label for="cpf_novo">CPF:</label>
                <div>
                    <input type="text" id="cpf_novo" name="cpf_novo" placeholder="somente numeros" 
                    title="Digite o numero do CPF" required="" value="<?php echo $cpf; ?>">
                </div>
                <label for="primeiro_nome_novo">Primeiro nome:</label>
                <div>
                    <input type="text" id="primeiro_nome_novo" name="primeiro_nome_novo" placeholder="Nome" 
                    title="Digite o nome da pessoa" required="" value="<?php echo $nome; ?>">
                </div>
                <label for="sobrenome_novo">Sobrenome:</label>
                <div>
                    <input type="text" id="sobrenome_novo" name="sobrenome_novo" placeholder="Sobrenome"
                    title="Digite o nome da sobrenome da pessoa" required="" value="<?php echo $sobrenome; ?>">
                </div>
                <label for="telefone_novo">Telefone:</label>
                <div>
                    <input type="text" id="telefone_novo" name="telefone_novo" placeholder="DDD + numero telefone" 
                    title="Digite o numero do telefone" required="" value="<?php echo $telefone; ?>">
                </div>
                <label for="email_novo">Email:</label>
                <div>
                    <input type="email" id="email_novo" name="email_novo" placeholder="email@email.com" 
                    title="Digite o email" required="" value="<?php echo $email; ?>">
                </div>
                <label for="senha_novo">Senha: (caso deixe em branco, a senha será o email)</label>
                <div>
                    <input type="text" id="senha_novo" name="senha_novo" placeholder="minimo 6 dígitos" title="Digite uma senha">
                </div>
                <label>Nível:</label>
                <div class="radio">
                    <input type="radio" name="nivel_novo" value="adm" <?php echo $nivel["adm"]; ?>/>Admin
                    <input type="radio" name="nivel_novo" value="user" <?php echo $nivel["user"]; ?>/>Usuário
                </div>
                <label for="usuario_data_novo">Data de cadastro:</label>
                <div>
                    <input type="date" id="usuario_data_novo" name="usuario_data_novo" 
                    title="Selecione a data de cadastro" required="" value="<?php echo $data_cadastro; ?>">
                </div>
                <label for="usuario_status_novo">Status:</label>
                <div class="radio">
                    <input type="radio" name="usuario_status_novo" value="1" <?php echo $ativo["on"]; ?>/>Ativo
                    <input type="radio" name="usuario_status_novo" value="0" <?php echo $ativo["off"]; ?>/>Inativo
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