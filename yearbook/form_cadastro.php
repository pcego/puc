<?php
include_once("./modelos/cabecalho_login.html");
?>

<div class="container">
    <div class="well">
        <form role="form" method="post" action="./cadastroNovoUsuario.php" class="form-signin" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Cadastro de Usuário</h2>
            <div class="form-group">				
                <label for="InputNome">Nome Completo:</label>
                <input type="text" class="form-control" id="InputNome" name="nomeCompleto" placeholder="Nome completo" required autofocus>              
            </div>
            <div class="form-group">
                <label for="InputLogin">Login:</label>
                <input type="text" class="form-control" id="InputLogin" name="nomeUsuario" placeholder="Login desejado" required="">
            </div>
            <div class="form-group">
                <label for="InputSenha">Senha:</label>
                <input type="password" class="form-control" id="InputSenha" name="passwd" placeholder="Senha (4 a 8 caracteres)" require>
            </div>
            <div class="form-group">
                <label for="InputSenhaConf">Confirmação de Senha:</label>
                <input type="password" class="form-control" id="InputSenhaConf" name="passwd2" placeholder="Confirme a senha" require>
            </div>
            <div class="form-group">
                <label for="InputEmail">Email:</label>
                <input type="text" class="form-control" id="InputEmail" name="email" placeholder="Email" required="">
            </div>
            <!-- Textarea -->
            <div class="control-group">
                <label class="control-label" for="descricao">Descrição:</label>
                <div class="controls">                     
                    <input type="text" class="form-control" id="InputDescricao" name="descricao" placeholder="Sobre Você" required=""> 
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="control-label" for="cidade">Cidade:</label>
                <select name="cidade" size="1">
                    <option name value="1">Montes Claros</value>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label class="control-label" for="estado">Estado:</label>
                <select name="cidade" size="1">
                    <option name value="1">Minas Gerais</value>
                </select>
            </div>
            <br>
            <br>
            <div class="form-group">     
                <label for="fileName">Escolha um Arquivo: </label>
                <input type="file" name="fileName" id="fileName" placeholder="Escolha um arquivo">
            </div>              
            <!-- Button (Double) -->
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>                    
                </div>
            </div>

        </form>       
    </div>

</div>  

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<?php
include_once("./modelos/rodape_bdsimples.html");
?>