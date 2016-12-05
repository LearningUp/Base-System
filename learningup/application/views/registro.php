<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Learning Up - Registrar</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/materialize/css/materialize.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/my/css/style.css');?>">
    </head>

    <body class="orange" style="min-height: 100vh;">
        <div class="valign-wrapper" style="min-height: 100vh;">
            <div class="valign container">
                <div class="row">
                    <div class="col s12 m10 offset-m1">
                        <div class="card">
                            <div class="card-content">
                                <?php echo form_open('LearningUp/cadastro');?>
                                <div class="row">
                                    <div class="col s12">
                                        <h1 class="center">Registrar</h1>
                                    </div>
                                </div>
                                <?php if(validation_errors() != false): ?>
                                <div class="row ">
                                    <div class="col s10 offset-s1 red lighten-1 errorWrapper">
                                        <h4 class="errorTitle">Erros: </h4>
                                        <ul class="errorList">
                                            <?php echo validation_errors(); ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="input-field col s12 m4">
                                        <input type="text" name="nome" id="nome" class="validate" aria-required="true" size="30" value="<?php echo set_value('nome'); ?>" />
                                        <label for="nome" data-error="Valor inválido.">Nome</label>
                                    </div>
                                    <div class="input-field col s12 m8">
                                        <input type="text" name="sobrenome" id="sobrenome" class="validate" aria-required="true" size="45" value="<?php echo set_value('sobrenome'); ?>" />
                                        <label for="sobrenome" data-error="Valor inválido.">Sobrenome</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m4">
                                        <label for="dt_nascimento">Data de Nascimento</label>
                                        <input type="date" class="datepicker validate" id="dt_nascimento" name="dt_nascimento" style="margin-top: -8px" aria-required="true" value="<?php echo set_value('dt_nascimento'); ?>" />
                                    </div>
                                    <div class="input-field col s12 m8">
                                        <select name="sexo" id="sexo" aria-required="true" class="validate">
                                            <option <?php echo set_value( 'sexo', 'Selecione')=="Selecione" ? "selected" : ""; ?> disabled>Selecione</option>
                                            <option value="masculino" <?php echo set_value( 'sexo')=="masculino" ? "selected" : ""; ?>>Masculino</option>
                                            <option value="feminino" <?php echo set_value( 'sexo')=="feminino" ? "selected" : ""; ?>>Feminino</option>
                                            <option value="nao_binario" <?php echo set_value( 'sexo')=="nao_binario" ? "selected" : ""; ?>>Não Binário</option>
                                        </select>
                                        <label for="sexo">Sexo</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="email" name="email" id="email" class="validate" aria-required="true" size="45" value="<?php echo set_value('email'); ?>" />
                                        <label data-error="E-mail inváilido" for="email">E-mail</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="senha">Senha</label>
                                        <input type="password" name="senha" id="senha" class="validate" value="<?php echo set_value('senha'); ?>" aria-required="true" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="senha_conf">Confirmação de Senha</label>
                                        <input type="password" name="senha_conf" id="senha_conf" value="<?php echo set_value('senha_conf'); ?>" class="validate" aria-required="true" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6">
                                        <input type="reset" class="waves-effect waves-light red btn-large" value="Limpar" />
                                    </div>
                                    <div class="col s6 right-align">
                                        <input type="submit" class="waves-effect waves-light blue btn-large" value="Cadastrar" />
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
        <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 50 // Creates a dropdown of 15 years to control year
            });

            $('select').material_select();
            $("select[required]").css({
                position: "absolute",
                display: "inline",
                height: 0,
                padding: 0,
                width: 0,
                margin: 0,
                top: "50%"
            });

        });
        </script>
    </body>

    </html>
