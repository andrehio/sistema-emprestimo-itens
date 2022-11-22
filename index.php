<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Sistema de Empréstimos - SE</title>
    <meta charset="utf-8" />
    <meta name="description" content="Lista de emprestimos do site" />
    <meta name="keywords" content="lista, emprestimo" />
    <meta name="author" content="André Hioki" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700" />
    <link rel="stylesheet" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="estilo.css" />
</head>

<body>
    <div class="wrap">
        <h1 style="text-align:center">SE - Sistema de Empréstimos</h1>
        <form class="login" name="login" action="login.php" method="post">
            <div>
                <h2>Tela de acesso</h2>
            </div>
            <div style="margin-top: 15px;">
                <label for="cpf">Login:</label>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" required="">
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="senha" required="">
            </div>
            <div>
                <input type="submit" value="Entrar">
            </div>
            <?php
                if(isset($_GET['erro'])){
                    if ($_GET['erro']==1){
                        echo "<p style='text-align:center;color:red'><b>Usuário e/ou senha incorreto(s).</b></p>";
                    }
                    elseif ($_GET['erro']==2) {
                        echo "<p style='text-align:center;color:red'><b>Você não tem permissão de adm.</b></p>";
                    }
                    else{
                        echo "<p style='text-align:center;color:red'><b>Seu acesso está inativado.</b></p>";
                    }
                    
                }
                if(isset($_GET['auth'])){
                    echo "<p style='text-align:center;color:red'><b>Por favor, realize o login.</b></p>";
                }

            ?>
        </form>
    </div>
    <div class="footer">
        <?php
            include "includes/footer.php"
        ?>
    </div>
</body>

</html>