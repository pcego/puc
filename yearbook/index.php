<?php
require_once("./login.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">  

        <title>Atividade Pós Graduação - PUC Minas Virtual</title>

        <!-- Bootstrap core CSS -->
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="jumbotron.css" rel="stylesheet">

    </head>

    <body>
        <br>
        <br>
        <br>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand">Yearbook</a>
                </div>

                <div class="navbar-collapse collapse">

                    <form class="navbar-form navbar-right" role="form" method="post" action="./verificarLogin.php">

                        <input type="text" class="form-group" placeholder="Login" name="login" required autofocus>

                        <input type="password" class="form-group" placeholder="Senha" name="passwd">
                        <br>                                                 

                        <label class="navbar-brand">
                            <input type="checkbox"  name="lembrarLogin" value="loginAutomatico"> Manter Conectado
                        </label>
                        <br>
                        <div class="navbar-form navbar-right" >  
                            <button class="btn btn-success" type="submit">Entrar</button>
                        </div>
                    </form>

                </div><!--/.navbar-collapse -->
            </div>
        </div>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h2>Pós Graduação PUC Minas Virtual.</h2>
                <p>Bem-Vindo!! <br> Ao YearBook da Primeira Turma de Pós Graduação em Desenvolvimento Web.</p>
                <p><a class="btn btn-primary btn-lg" href="./form_cadastro.php" role="button">Cadastre-se</a></p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">        
                <h2>Participantes</h2>  
                <hr>
                <?php
                require_once("./thumb.php");
                ?>  
                <hr>
            </div>
        </div>            

        <hr>

        <div class="container">
            <footer>
                <p>&copy; Paulo César 2014</p>
            </footer>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
    </body>

</html>