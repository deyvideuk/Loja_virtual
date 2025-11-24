<?php

    // cadastro
        if(isset($_GET['cadastro']) && ($_GET['cadastro'] == '409')){
            $html = '
                <div id="alert" class="alert alert-danger" style="display:flex;">
                    <p>Usuário já existe no sistema!</p>
                </div>
            ';
            echo $html;
        }

        if(isset($_GET['cadastro']) && ($_GET['cadastro'] == '200')){
            $html = '
                <div id="alert" class="alert alert-info" style="display:flex;">
                    <p>Cadastro efetuado com sucesso!</p>
                </div>
            ';
            echo $html;
        }
    // cadastro

    // login
    if(isset($_GET['login']) && ($_GET['login'] == '404')){
        $html = '
                <div id="alert" class="alert alert-danger" style="display:flex;">
                    <p>Email ou senha incorretas, você tem cadastro?!</p>
                </div>
            ';
            echo $html;
    }

    if(isset($_GET['login']) && ($_GET['login'] == '401')){
        $html = '
                <div id="alert" class="alert alert-danger" style="display:flex;">
                    <p>Email ou Senha incorretas!</p>
                </div>
            ';
            echo $html;
    }

    if(isset($_GET['login']) && ($_GET['login'] == '200')){
        $html = '
                <div id="alert" class="alert alert-info" style="display:flex;">
                    <p>Login efetuado com sucesso!</p>
                </div>
            ';
            echo $html;
    }
    // login

    // loggout
    if(isset($_GET['loggout']) && ($_GET['loggout']) == '200'){
        $html = '
                <div id="alert" class="alert alert-info" style="display:flex;">
                    <p>Sessão finalizada com sucesso!</p>
                </div>
            ';
            echo $html;
    }
    // loggout

    // cadastro Produtos
    if(isset($_GET['cadastroProduto']) && $_GET['cadastroProduto'] == '200'){
        $html = '
                <div id="alert" class="alert alert-info" style="display:flex;">
                    <p>Produto anunciado com sucesso!</p>
                </div>
            ';
            echo $html;
    }

    if(isset($_GET['cadastroProduto']) && $_GET['cadastroProduto'] == '409'){
        $html = '
                <div id="alert" class="alert alert-danger" style="display:flex;">
                    <p>Não foi possivel anunciar o produto!</p>
                </div>
            ';
            echo $html;
    }

    // cadastro Produtos

?>