<?php
require_once("./authSession.php");
require_once("./conf/confBD.php");
include_once("./modelos/cabecalho_bdcompleto.html");
?>

<div class="container">

    <div>

        <?php
        echo "<br><br><br><br>";

        try {

            // se não foi passado 1 parâmetro via SESSION, desvia para a mensagem de erro
            // "previne" acesso direto à página	
            if (count($_SESSION['nomeCompleto']) == 0) {
                include("./erroPesquisa.php");
                die();
            } 
            else {
                // instancia objeto PDO, conectando no mysql
                $conexao = conn_mysql();

                //captura valores do vetor POST
                //utf8_encode para manter consistência da codificação utf8 nas páginas e no banco
                $nomeBusca = utf8_encode(htmlspecialchars($_SESSION['nomeCompleto']));


                //se existe um nome para busca... 
                if (strlen($nomeBusca) > 0) {

                    // instrução SQL básica (sem restrição de nome)
                    $SQLSelect = 'SELECT * FROM participantes ';

                    $SQLSelect = $SQLSelect . 'WHERE 	nomeCompleto = ?'; //anexa a restrição à sentença SQL
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
                        echo '<table class="table table-striped">';
                        echo '<thead><tr><th colspan="4">Participantes Encontrados</th></tr></thead>';
                        echo '<thead><tr><th>Nome</th><th>e-mail</th><th>Descrição</th><th>Foto</th></tr></thead>';
                        echo '<tbody>';
                        foreach ($resultados as $contatosEncontrados) {  //para cada elemento do vetor de resultados...
                            //em cada 'linha' do vetor de resultados existem elementos com os mesmos nomes dos campos recuperados do SGBD
                            echo "\n<tr><td>" . utf8_decode($contatosEncontrados['nomeCompleto']) . "</td>";
                            echo "<td>" . utf8_decode($contatosEncontrados['email']) . "</td>";
                            echo "<td>" . utf8_decode($contatosEncontrados['descricao']) . "</td>";
                            echo "<td> <figure>" . "<img src=\"" . utf8_decode($contatosEncontrados['arquivoFoto']) . "\" height=120 weight=80 ></figure>" . "</td></tr>";
                        }
                        echo '</table>';
                        echo '<div class="container">';
                        echo '<div>';
                        echo '<div class="btn btn-group">';
                        echo "<a href=\"./form_editar.php?filtro=". utf8_decode($_SESSION['nomeCompleto']) . "\">";
                        echo '<button type="submit" class="btn btn-default">Editar</button>';                        
                        echo '</div>'; 
                        echo '<div class="btn-group">';
                        echo "<a href=\"./apagar_perfil.php?filtro=". utf8_decode($_SESSION['nomeCompleto']) . "\">";
                        echo '<button type="submit" class="btn btn-danger">Apagar</button>';                        
                        echo '</div>';        
                        echo '</div>';
                        echo '<div>';
                        echo '</div>'; //<!-- /.container -->
                    }
                } else {
                    echo '<div class="alert alert-info">';
                    echo '<a href="#" class="alert-link">OOPS!! NENHUM RESULTADO ENCONTRADO.</a>';
                    echo '</div>';
                }
                $resultados = null;
                die();
            }
        } catch (PDOException $e) {
            // caso ocorra uma exceção, a exibe na tela
            echo "Erro!: " . $e->getMessage() . "<br>";
            die();
        }
        include_once("./modelos/rodape_bdcompleto.html");
        ?>
