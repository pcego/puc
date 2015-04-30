<?php
require_once("./authSession.php");
include_once("./modelos/cabecalho_login.html");
require_once("./conf/confBD.php");

try {

    // se não foi passado 1 parâmetro via SESSION, desvia para a mensagem de erro
    // "previne" acesso direto à página	
    if (count($_GET['filtro']) == "") {
        include("./erroPesquisa.php");
        die();
    } else {
        // instancia objeto PDO, conectando no mysql
        $conexao = conn_mysql();

        //captura valores do vetor POST
        //utf8_encode para manter consistência da codificação utf8 nas páginas e no banco
        $nomeBusca = utf8_encode(htmlspecialchars($_GET['filtro']));

        // instrução SQL básica (sem restrição de nome)
        $SQLSelect = 'SELECT * FROM participantes ';

        //se existe um nome para busca... 
        if (strlen($nomeBusca) > 0) {

            $SQLSelect = $SQLSelect . 'WHERE 	nomeCompleto = ?'; //anexa a restrição à sentença SQL
        }

        //prepara a execução da sentença
        $operacao = $conexao->prepare($SQLSelect);

        //executa a sentença SQL com o valor passado por parâmetro
        $pesquisar = $operacao->execute(array($nomeBusca));

        //captura TODOS os resultados obtidos
        $resultados = $operacao->fetchAll();

        // fecha a conexão (os resultados já estão capturados)
        $conexao = null;

        // se há resultados, os escreve em uma tabela
        if (count($resultados) > 0) {

            foreach ($resultados as $contatosEncontrados) {  //para cada elemento do vetor de resultados...
                echo '<div class="container">';
                echo '<div class="well">';
                echo '<form role="form" method="post" action="./update.php" class="form-signin" enctype="multipart/form-data">';
                echo '<h2 class="form-signin-heading">Cadastro de Usuário</h2>';
                echo '<div class="form-group">';
                echo '<label for="InputNome">Nome Completo:</label>';
                echo "<input type=\"text\" class=\"form-control\" id=\"InputNome\" name=\"nomeCompleto\" placeholder=\"Nome completo\" value=\"" . utf8_decode($contatosEncontrados['nomeCompleto']) . "\" required autofocus>";
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="InputLogin">Login:</label>';
                echo "<input type=\"text\" class=\"form-control\" id=\"InputLogin\" name=\"nomeUsuario\" value=\"" . utf8_decode($contatosEncontrados['login']) . "\" required>";
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="InputSenha">Senha:</label>';
                echo '<input type="password" class="form-control" id="InputSenha" name="passwd" placeholder="Nova Senha (4 a 8 caracteres)" require>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="InputSenhaConf">Confirmação de Senha:</label>';
                echo '<input type="password" class="form-control" id="InputSenhaConf" name="passwd2" placeholder="Confirme a Nova Senha" require>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="InputEmail">Email:</label>';
                echo "<input type=\"text\" class=\"form-control\" id=\"InputLogin\" name=\"email\" value=\"" . utf8_decode($contatosEncontrados['email']) . "\" required>";
                echo '</div>';
                echo '<!-- Textarea -->';
                echo '<div class="control-group">';
                echo '<label class="control-label" for="descricao">Descrição:</label>';
                echo '<div class="controls">';
                echo "<input type=\"text\" class=\"form-control\" id=\"InputLogin\" name=\"descricao\" value=\"" . utf8_decode($contatosEncontrados['descricao']) . "\" required>";
                echo '</div>';
                echo '</div>';
                echo '<br>';
                echo '<div class="form-group">';
                echo '<label class="control-label" for="cidade">Cidade:</label>';
                echo '<select name="cidade" size="1">';
                echo '<option name value="1">Montes Claros</value>';
                echo '</select>';
                echo '</div>';
                echo '<br>';
                echo '<div class="form-group">';
                echo '<label class="control-label" for="estado">Estado:</label>';
                echo '<select name="cidade" size="1">';
                echo '<option name value="1">Minas Gerais</value>';
                echo '</select>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="fileName">Escolha um Arquivo: </label>';
                echo '<input type="file" name="fileName" id="fileName" placeholder="Escolha um arquivo">';
                echo '</div>';
                echo '<div class="control-group">';
                echo '<div class="controls">';
                echo '<button type="submit" class="btn btn-primary">Salvar</button>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div><!-- /.container -->';
            }
        } 
        else {
            echo '<div class="alert alert-info">';
            echo '<a href="#" class="alert-link">OOPS!! Falhou.</a>';
            echo '</div>';
        }
        //$resultados = null;		
        die();
    }
} catch (PDOException $e) {
    // caso ocorra uma exceção, a exibe na tela
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>
