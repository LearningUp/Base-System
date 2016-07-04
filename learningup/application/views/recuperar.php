<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Learning Up - Login</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/materialize/css/materialize.min.css');?>">
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
                                        <h4 class="center">Login</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <label for="login">Login</label>
                                        <input type="text" name="login" id="login" class="validate" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <label for="senha">Senha</label>
                                        <input type="password" name="senha" id="senha" />
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url('dist/jquery/jquery-3.0.0.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('dist/materialize/js/materialize.js')?>"></script>
        <script type="text/javascript">
        </script>
    </body>

    </html>
