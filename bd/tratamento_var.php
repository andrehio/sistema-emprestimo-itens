<?php
class tratamento{
    // Remove todas as tags HTML
    // Remove todos os espaços em branco do início e fim dos valores dos inputs
    public static function limpa_variaveis(){
        foreach ($_POST as $chave => $valor) {
            $$chave = trim(strip_tags($valor));
        }
    }
}
?>