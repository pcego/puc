<?php
require_once("./conf/confBD.php");

if (isset($_COOKIE['loginAgenda'])) {
    $nomeUser = $_COOKIE['loginAgenda'];
} 
else {
    $nomeUser = "";
}
?> 
<!-- Bootstrap core CSS --> 
<link href="dist/css/bootstrap.css" rel="stylesheet"> 

<!-- Custom CSS for the 'Thumbnail Gallery' Template --> 
<link href="dist/css/thumbnail-gallery.css" rel="stylesheet"> 

<!-- thumbnail --> 
<?php
try {
    // instancia objeto PDO, conectando no mysql 
    $conexao = conn_mysql();

    // instrução SQL básica (sem restrição de nome) 
    $SQLSelect = 'SELECT * FROM participantes LIMIT 30';

    //prepara a execução da sentença 
    $operacao = $conexao->prepare($SQLSelect);
    $pesquisar = $operacao->execute(array($nomeUser));

    //captura TODOS os resultados obtidos 
    $resultados = $operacao->fetchAll();

    // fecha a conexão (os resultados já estão capturados) 
    $conexao = null;

    // se há resultados, monta as fotos em thumbnail
    if (count($resultados) > 0) {

        echo "<div class=\"row\">";

        foreach ($resultados as $contatosEncontrados) {       //para cada elemento do vetor de resultados... 
            echo "<div class=\thumbnail\">";
            echo "<div class=\"col-lg-1 col-md-1 col-xs-2 thumbnail\">";
            echo "<a href=\"./pag_perfil_usuarios.php?filtro=" . utf8_decode($contatosEncontrados['nomeCompleto']) . "\">";
            echo "<figure>";
            echo "<img class=\"img-responsive\" src=\"" . utf8_decode($contatosEncontrados['arquivoFoto']) . "\">";
            echo '<figcaption>' . utf8_decode($contatosEncontrados['nomeCompleto']) . '</figcaption>';
            echo "</figure>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>"; //Row 
    } else {
        echo'<div class="starter-template">';
        echo"\n<h3 class=\sub-header\>Nenhum Participante Cadastrado.</h3>";
        echo'</div>'; //alert
    }
} catch (PDOException $e) {

    // caso ocorra uma exceção, exibe na tela 
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>      

<!-- JavaScript --> 
<script src="dist/js/jquery-1.10.2.js"></script> 
<script src="dist/js/bootstrap.js"></script> 
<script src="dist/js/holder.js"></script> 


