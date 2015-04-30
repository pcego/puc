<?php
include_once("./modelos/cabecalho_login.html");
?>

<div class="container">

    <div>


        <form role="form" method="post" action="./cadastroNovoUsuario.php" class="form-signin" enctype="multipart/form-data">
            <h3 class="form-signin-heading">Yearbook<br> Cadastro de Usuário</h3>
            <div class="form-group">
                <label for="InputNome">Nome Completo:</label>
                <input type="text" class="form-control" id="InputNome" name="nomeCompleto" placeholder="Nome completo" required autofocus>
            </div>
            <div class="form-group">
                <label for="InputLogin">Login:</label>
                <input type="text" class="form-control" id="InputLogin" name="nomeUsuario" placeholder="Login desejado" required>
            </div>
            <div class="form-group">
                <label for="InputSenha">Senha:</label>
                <input type="password" class="form-control" id="InputSenha" name="passwd" placeholder="Senha (4 a 8 caracteres)">
            </div>
            <div class="form-group">
                <label for="InputSenhaConf">Confirmação de Senha:</label>
                <input type="password" class="form-control" id="InputSenhaConf" name="passwd2" placeholder="Confirme a senha">
            </div>
            <div class="form-group">
                <label for="InputEmail">Email:</label>
                <input type="text" class="form-control" id="InputEmail" name="email" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
                <label for="InputDescricao">Descrição:</label>
                <input type="text" class="form-control" id="InputDescricao" name="descricao" placeholder="Descrição" required autofocus>
            </div>
            <div class="form-group">     
                <label for="fileName">Escolha um arquivo: </label>
                <input type="file" name="fileName" id="fileName" placeholder="Escolha um arquivo">
            </div>
            <div class="form-group">
                <select name="cidade" size="1">
                    <option name value="1">Montes Claros</value>
                </select>
            </div>			 
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>



</div><!-- /.container -->

<?php
include_once("./modelos/rodape_bdsimples.html");
?>