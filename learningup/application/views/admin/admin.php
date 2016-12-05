<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Administração</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/materialize/css/materialize.min.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/my/css/style.css');?>">
        <script type="text/javascript " src="<?php echo base_url( 'dist/jquery/jquery-3.0.0.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('dist/materialize/js/materialize.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('dist/list/js/list.js')?>"></script>
    </head>

    <body class="grey lighten-2">
        <nav class="hide-on-large-only grey">
            <div class="nav-wrapper">
                <b class="brand-logo center">LearningUp</b>
                <a href="#" id="side-menu-button" data-activates="side-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <ul id="side-menu" class="side-nav right fixed">
            <li class="grey user-sidebar-info">
                <img id="userImage" class="circle responsive-img user-img" src="http://www.hardcodex.net/learnup/img/user.png" />
                <b id=" userName " class="truncate user-name white-text ">{Username}</b>
            </li>
            <li class="<?php echo (isset($option) && $option == 'logs' ? 'active' : ''); ?>">
                <?php echo anchor('Admin/logs', 'Logs', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'usuarios' ? 'active' : ''); ?>">
                <?php echo anchor('Admin/users', 'Usuários', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'forum' ? 'active' : ''); ?>">
                <?php echo anchor( 'Admin/index', 'Fórum', array( 'class'=> 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'materias' ? 'active' : ''); ?>">
                <?php echo anchor('Admin/listSubjects', 'Matérias', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'conteudos' ? 'active' : ''); ?>">
                <?php echo anchor('Admin/index', 'Conteúdos', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'aulas' ? 'active' : ''); ?>">
                <?php echo anchor('Admin/index', 'Aulas', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'emblemas' ? 'active' : ''); ?>">
                <?php echo anchor('Admin/index', 'Emblemas', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="divider"></li>
            <li>
                <?php echo anchor('LearningUp/logout', 'Sair', array('class' => 'waves-effect waves-red')); ?>
            </li>
        </ul>
        <?php if(isset($option)): ?>
        <div class="container-fluid adminMain" style="margin-left: 240px; background: white;">
            <!-- LOG -->
            <!--<div class="row">
              <div class="col s12" style="margin-left:240px">
                <?php
                 /* if(isset($content)&&$options == 'materias'){
                    echo $content;
                  }*/
                ?>
              </div>-->
            <?php if($option == "logs"): ?>
            <div class="row">
                <div id="confirmacao" class="modal">
                    <div class="modal-content">
                        <h4>Confirmar exclusão de todos os logs?</h4>
                        <p>Você tem certeza que deseja fazer isso?</p>
                        <p>Não é possível reverter esse processo.</p>
                    </div>
                    <div class="modal-footer">
                        <a class="waves-effect waves-light btn modal-close modal-action ">Cancelar</a>
                        <?php echo anchor("Admin/apagarLogs/", '<i class="material-icons">delete</i> Todos os Logs',  array('class' => ' modal-close modal-action waves-effect waves-light red btn', 'style' => "margin-right: 10px")); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Logs</h1>
                </div>
            </div>
            <div class="row" style="padding: 10px">
                <div class="col s6">
                    <form action="<?php echo base_url(index_page().'/admin/logs/search'); ?>" method="get">
                        <div class="row">
                            <div class="input-field col s10">
                                <input id="search_bar" name="search_bar" type="text" class="validate" value="<?php if(isset( $_GET['search_bar'])) echo $_GET['search_bar']; ?>">
                                <label for="search_bar">Procurar</label>
                            </div>
                            <div class="col s2 input-field">
                                <button class="btn" type="submit"><i class="material-icons">search</i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col s6">
                    <a class="waves-effect waves-light btn-large modal-trigger red lighten-2 right" href="#confirmacao"><i class="material-icons">delete</i> Todos os Logs</a>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <table class="centered highlight">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mensagem</th>
                                <th>Horário</th>
                                <th>Usuário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($logs != null) foreach ($logs as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['mensagem']; ?>
                                </td>
                                <td>
                                    <?php echo $row['time']; ?>
                                </td>
                                <td>
                                    <?php echo $row['email']; ?>
                                </td>
                                <td>
                                    <?php echo anchor("Admin/apagarLog/".$row['id'].'/'.htmlspecialchars(uri_string()), '<i class="material-icons">delete</i>',  array('class' => 'waves-effect waves-light lighten-2 red btn')); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <script type="text/javascript">
            $(document).ready(function() {
                // the "href" attribute of

               .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });
            </script>
            <?php endif; ?>
            <!-- END LOG -->
            <!-- USERS -->
            <?php if($option == "users"): ?>
            <div class="row">
                <div id="confirmacao" class="modal">
                    <div class="modal-content">
                        <h4>Confirmar exclusão de todos os logs?</h4>
                        <p>Você tem certeza que deseja fazer isso?</p>
                        <p>Não é possível reverter esse processo.</p>
                    </div>
                    <div class="modal-footer">
                        <a class="waves-effect waves-light btn modal-close modal-action ">Cancelar</a>
                        <?php echo anchor("Admin/apagarLogs/", '<i class="material-icons">delete</i> Todos os Logs',  array('class' => ' modal-close modal-action waves-effect waves-light red btn', 'style' => "margin-right: 10px")); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Usuários</h1>
                </div>
            </div>
            <div class="row" style="padding: 10px">
                <div class="col s12">
                    <form action="<?php echo base_url(index_page().'/admin/users/search'); ?>" method="get">
                        <div class="row">
                            <div class="input-field col s10">
                                <input id="search_bar" name="search_bar" type="text" class="validate" value="
<?php if(isset( $_GET['search_bar'])) echo $_GET['search_bar']; ?>">
                                <label for="search_bar">Procurar</label>
                            </div>
                            <div class="col s2 input-field">
                                <button class="btn" type="submit"><i class="material-icons">search</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <table class="centered highlight">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>E-mail</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Sexo</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($users != null) foreach ($users as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['tipo']; ?>
                                </td>
                                <td>
                                    <?php echo $row['email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['nome']; ?>
                                </td>
                                <td>
                                    <?php echo $row['sobrenome']; ?>
                                </td>
                                <td>
                                    <?php echo $row['sexo']; ?>
                                </td>
                                <td>
                                    <?php echo anchor("Admin/users/view/".$row['id'], '<i class="material-icons">search</i>',  array('class' => 'waves-effect waves-light lighten-2 blue btn')); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <script type="text/javascript">
            $(document).ready(function() {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });
            </script>
            <?php endif; ?>
            <!-- END USERS -->
            <?php if($option == "userView"): ?>
            <?php echo form_open("admin/updateUser"); ?>
            <div class="row">
                <div id="confirmacao" class="modal">
                    <div class="modal-content">
                        <h4>Confirmar exclusão deste usuário?</h4>
                        <p>Você tem certeza que deseja excluir o usuário
                            <?php echo $user['email']; ?>?</p>
                        <p><b>Não é possível reverter esse processo.</b></p>
                    </div>
                    <div class="modal-footer">
                        <a class="waves-effect waves-light btn modal-close modal-action blue">Cancelar</a>
                        <?php echo anchor("Admin/apagarUser/".$user['id'], '<i class="material-icons">delete</i> Apagar',  array('class' => ' modal-close modal-action waves-effect waves-light red btn', 'style' => "margin-right: 10px")); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <h1>Usuário</h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <?php echo anchor("admin/users", '<i class="material-icons">chevron_left</i>',  array('class' => 'waves-effect waves-light lighten-2 blue btn')) ?>
                </div>
            </div>
            <div class="row">
                <form class="col s12">
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
                    <div class="row">
                        <div class="input-field col s1">
                            <input disabled id="id_t" name="id_t" type="text" class="validate" value="<?php echo $user['id']; ?>">
                            <input id="id" name="id" type="hidden" class="validate" value="<?php echo $user['id']; ?>">
                            <label for="id_t">ID</label>
                        </div>
                        <div class="input-field col s5">
                            <input disabled id="nome" name="nome" type="text" class="validate" value="<?php echo $user['nome']; ?>">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="input-field col s5">
                            <input disabled id="sobrenome" name="sobrenome" type="text" class="validate" value="<?php echo $user['sobrenome']; ?>">
                            <label for="sobrenome">Sobrenome</label>
                        </div>
                        <div class="input-field col s1">
                            <input disabled id="tipo" name="tipo" type="text" class="validate" value="<?php echo $user['tipo']; ?>">
                            <label for="tipo">Tipo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input disabled value="<?php echo $user['email']; ?>" id="email" name="email" type="email" class="validate">
                            <label for="email">E-mail</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input disabled id="senha" name="senha" type="password" class="validate" value="<?php echo $user['senha']; ?>">
                            <label for="senha">Senha</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4">
                            <label for="dt_nascimento">Data de Nascimento</label>
                            <input disabled type="date" class="datepicker validate" id="dt_nascimento" name="dt_nascimento" style="margin-top: -8px" aria-required="true" value="<?php echo $user['dt_nascimento'] ; ?>" />
                        </div>
                        <div class="input-field col s12 m8">
                            <select disabled name="sexo" id="sexo" aria-required="true" class="validate">
                                <option value="masculino" <?php echo $user[ 'sexo']=="masculino" ? "selected" : ""; ?>>Masculino</option>
                                <option value="feminino" <?php echo $user[ 'sexo']=="feminino" ? "selected" : ""; ?>>Feminino</option>
                                <option value="nao_binario" <?php echo $user[ 'sexo']=="nao_binario" ? "selected" : ""; ?>>Não Binário</option>
                            </select>
                            <label for="sexo">Sexo</label>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="row right">
                    <div class="col s6 offset-s6">
                        <a class="waves-effect waves-light btn modal-trigger red lighten-2" href="#confirmacao"><i class="material-icons">delete</i> Apagar</a>
                        <button type="button" onclick="toggleEditable();" class="waves-effect waves-light lighten-2 blue btn">Editar</button>
                        <button id='updatebtn' type="submit" disabled class="waves-effect waves-light lighten-2 blue btn">Salvar</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- End user view-->
            <!-- cadastar materia-->
            <script type="text/javascript">
            function toggleEditable() {
                $('#nome').prop('disabled', false);
                $('#sobrenome').prop('disabled', false);
                $('#tipo').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#senha').prop('disabled', false);
                $('#dt_nascimento').prop('disabled', false);
                $('#sexo').prop('disabled', false);
                $('#updatebtn').prop('disabled', false);
                $('select').material_select();
            }
            $(document).ready(function() {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
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
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <script type="text/javascript">
        $(document).ready(function() {
            // Activate the side menu
            $("#slide-out").sideNav('show');
        });
        </script>
    </body>

    </html>
