<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>LearningUp - Aluno</title>
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
        <ul id="side-menu" class="side-nav right fixed blue darken-3 white-text">
            <li class="blue darken-2">
                <b id=" userName " class="truncate user-name white-text "><?php echo $lista_exercicio['titulo']; ?></b>
            </li>
            <li class="divider"></li>
            <li class="center">
                Tempo restante: 5:00
            </li>
            <li class="divider"></li>
            <?php $i = 1; foreach ($outros_exercicios as $oe): ?>
            <li>
                <?php echo anchor('Aluno/RealizarExercicio/'.$oe['id']."/".$lista_exercicio['id'], "<b>".$i."</b> - ".$oe['titulo'], array('class' => 'waves-effect waves-blue white-text')); ?>
            </li>
            <?php ++$i; endforeach; unset($i); ?>
            <li class="divider"></li>
            <li>
                <?php echo anchor('Aluno/CancelarListaExercicios', 'Cancelar', array('class' => 'waves-effect waves-red white-text')); ?>
            </li>
        </ul>
        <?php if(isset($option)): ?>
        <div class="container-fluid adminMain" style="margin-left: 240px;">
            <?php if ($option == "BemVindo"): ?>
            <h3 class="center">Lista de Exércicios <?php echo $lista_exercicio['titulo']; ?></h3>
            <br>
            <ul>
                <li>Essa lista é composta por <b><?php echo (int)$qntExercicios; ?> exércicios</b>.</li>
                <li><b><?php echo (int)$lista_exercicio['gostei']; ?> gostaram</b> e <b><?php echo (int)$lista_exercicio['n_gostei']; ?> não gostaram</b>.</li>
                <li>Foi <b>realizada <?php echo (int)$lista_exercicio['realizado']; ?> vezes</b>.</li>
                <li>Tem <b>tempo limite de <?php echo $lista_exercicio['tempo_limite']; ?></b>.</li>
            </ul>
            <br>
            <p>Para iniciar clique no botão <b>Proximo</b> abaixo. Ou clique em <b>Cancelar</b> para poder selecionar outra lista.</p>
            <br>
            <?php echo anchor('Aluno/RealizarExercicio/'.$outros_exercicios[++$exercicio_atual]['id']."/".$lista_exercicio['id'], "Proximo >", array('class' => 'waves-effect waves-blue btn right')); ?>
            <?php echo anchor('Aluno/CancelarListaExercicios/', "Cancelar", array('class' => 'waves-effect waves-purple red btn left')); ?>
            <?php endif ?>
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
