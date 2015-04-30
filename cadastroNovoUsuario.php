<?php

require_once("./conf/confBD.php");
include_once("./modelos/cabecalho_login.html");

//Iniciando verificação de upload de imagem
$permissoes = array("gif", "jpeg", "jpg", "png", "image/gif", "image/jpeg", "image/jpg", "image/png");  //strings de tipos e extensoes validas
$temp = explode(".", basename($_FILES["fileName"]["name"]));
$extensao = end($temp);

if ((in_array($extensao, $permissoes)) && (in_array($_FILES["fileName"]["type"], $permissoes)) && ($_FILES["fileName"]["size"] < 500000)) {

    if ($_FILES["fileName"]["error"] > 0) {
        echo "<h1>Erro no envio, código: " . $_FILES["fileName"]["error"] . "</h1>";
    } else {
        $dirUploads = "fotos/";
        $nomeUsuario = utf8_encode(htmlspecialchars($_POST['nomeUsuario'])) . "/";

        if (!file_exists($dirUploads)) {
            mkdir($dirUploads, 0500);
        }  //permissao de leitura e execucao

        $caminhoUpload = utf8_encode(htmlspecialchars($dirUploads . $nomeUsuario));

        if (!file_exists($caminhoUpload)) {
            mkdir($caminhoUpload, 0700);
        }  //permissoes de escrita, leitura e execucao

        $pathCompleto = $caminhoUpload . basename($_FILES["fileName"]["name"]);

        if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $pathCompleto)) {
            echo "<figure><img class=\"img-thumbnail\" src=\"$pathCompleto\" title=\"Upload do usuário\"></figure>";
        } else {
            echo '<div class="alert alert-danger">';
            echo '<a href="#" class="alert-link">IHHH!!! Problemas ao Armazenar Arquivo.</a>';
            echo '</div>';
        }
    }
}
//Finalizando Upload de imagem

try {
    // se não foram passados 4 parâmetros na requisição e não vier da página de cadastro
    //desvia para a mensagem de erro: 	// "previne" acesso direto à página
    $origem = basename($_SERVER['HTTP_REFERER']);

    if ((count($_POST) != 4) && ($origem != 'form_cadastro.php')) {
        header("Location:./acessoNegado.php");
        die();
    }
    //se existem os parâmetros...
    else {
        //instancia objeto PDO, conectando-se ao mysql
        $conexao = conn_mysql();

        //captura valores do vetor POST
        //utf8_encode para manter consistência da codificação utf8 nas páginas e no banco
        $nome = utf8_encode(htmlspecialchars($_POST['nomeCompleto']));
        $login = utf8_encode(htmlspecialchars($_POST['nomeUsuario']));
        $senha = utf8_encode(htmlspecialchars($_POST['passwd']));
        $senhaConf = utf8_encode(htmlspecialchars($_POST['passwd2']));
        $email = utf8_encode(htmlspecialchars($_POST['email']));
        $descricao = utf8_encode(htmlspecialchars($_POST['descricao']));
        $cidade = utf8_encode(htmlspecialchars($_POST['cidade']));

        if (($senha != $senhaConf) || (strlen($senha) < 4) || (strlen($senha) > 8)) {
            header("Location:./erroCadastro.php");
            die();
        }

        // cria instrução SQL parametrizada
        $SQLInsert = 'INSERT INTO participantes (login, senha, nomeCompleto, arquivoFoto, cidade, email, descricao) 
			  		  VALUES (?,MD5(?),?,?,?,?,?)';

        //prepara a execução
        $operacao = $conexao->prepare($SQLInsert);

        //executa a sentença SQL com os parâmetros passados por um vetor
        $inserir = $operacao->execute(array($login, $senha, $nome, $pathCompleto, $cidade, $email, $descricao));

        // fecha a conexão ao banco
        $conexao = null;

        //verifica se o retorno da execução foi verdadeiro ou falso,
        //imprimindo mensagens ao cliente
        if ($inserir) {
            echo "<h1>Cadastro efetuado com sucesso.</h1>\n";
            echo "<p class=\"lead\"><a href=\"./index.php\">Página Principal</a></p>\n";
        } else {
            echo "<h1>Erro na operação.</h1>\n";
            $arr = $operacao->errorInfo();  //mensagem de erro retornada pelo SGBD
            $erro = utf8_decode($arr[2]);
            echo "<p>$erro</p>";       //deve ser melhor tratado em um caso real
            echo "<p><a href=\"./form_cadastro.php\">Retornar</a></p>\n";
        }
    }
} catch (PDOException $e) {
    // caso ocorra uma exceção, exibe na tela
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}

include_once("./modelos/rodape_login.html");
?>
