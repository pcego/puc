<?php

require_once("./authSession.php");
require_once("./conf/confBD.php");

try {
    // se não foram passados 3 parâmetros na requisição, desvia para a mensagem de erro
    // "previne" acesso direto à página
    if ($_GET['filtro'] == '') {
        header("Location:./erroExclusao.php");
        die();
    }
    //se existem os parâmetros...
    else {
        //instancia objeto PDO, conectando-se ao mysql
        $conexao = conn_mysql();

        //captura valores do vetor POST
        //utf8_encode para manter consistência da codificação utf8 nas páginas e no banco
        $nomeUsuario = utf8_encode(htmlspecialchars($_GET['filtro']));
        //$nomeContato = utf8_encode(htmlspecialchars($_GET['contato']));

        // cria instrução SQL parametrizada
        $SQLDelete = 'DELETE FROM participantes WHERE nomeCompleto=?';

        //prepara a execução
        $operacao = $conexao->prepare($SQLDelete);

        //executa a sentença SQL com os parâmetros passados por um vetor
        $inserir = $operacao->execute(array($nomeUsuario)); //, $nomeContato

        // fecha a conexão ao banco
        $conexao = null;

        //verifica se o retorno da execução foi verdadeiro ou falso,
        //imprimindo mensagens ao cliente
        if ($inserir) {
            header("Location: ./logout.php");
        } else {
            echo "<h1>Erro na operação.</h1>\n";
            $arr = utf8_decode($operacao->errorInfo());  //mensagem de erro retornada pelo SGBD
            echo "<p>$arr[2]</p>";       //deve ser melhor tratado em um caso real
            echo "<p><a href=\"./pag_principal.php\">Retornar</a></p>\n";
        }
    }
} catch (PDOException $e) {
    // caso ocorra uma exceção, exibe na tela
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>