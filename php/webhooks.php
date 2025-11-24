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

?>