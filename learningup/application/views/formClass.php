<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Learning Up - Criar Aula</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/materialize/css/materialize.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/my/css/style.css');?>">
    </head>

    <body class="teal" style="min-height: 100vh;">
        <div class="valign-wrapper" style="min-height: 100vh;">
            <div class="valign container">
                <div class="row">
                    <div class="col s12 m8 offset-m2">
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12">
                                        <h1 class="center">Login</h1>
                                    </div>
                                </div>
                                <?php if(validation_errors() != false || isset($error)): ?>
                                <div class="row ">
                                    <div class="col s12 red lighten-1 errorWrapper">
                                        <h5 class="errorTitle">Erros: </h5>
                                        <ul class="errorList">
                                            <?php if(validation_errors() != false) echo validation_errors(); else echo "<li>$error</li>" ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php echo form_open('LearningUp/createClass');?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <label for="titulo">Titulo</label>
                                        <input type="text" name="titulo" id="titulo" class="validate" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <label for="senha">Descrição:</label>
                                        <input type="text" name="descricao" id="descricao" class="validate" />
                                        <a href="#">Esqueceu a senha?</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <label for="senha">Descrição:</label>
                                        <input type="text" name="descricao" id="descricao" class="validate" />
                                        <a href="#">Esqueceu a senha?</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6">
                                        <?php echo anchor('LearningUp/cadastro', 'Cadastrar-se', array('class' => 'waves-effect waves-light lighten-2 teal btn-large')); ?>
                                    </div>
                                    <div class="col s6 right-align">
                                        <button class="waves-effect waves-light blue btn-large">Logar</button>
                                    </div>
                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url('dist/jquery/jquery-3.0.0.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('dist/materialize/js/materialize.js')?>"></script>
    </body>

    </html>