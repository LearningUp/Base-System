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
        <ul id="side-menu" class="side-nav right fixed">
            <li class="grey user-sidebar-info">
                <img id="userImage" class="circle responsive-img user-img" src="http://www.placecage.com/300/300" />
                <b id=" userName " class="truncate user-name white-text "><?php echo $userdate->nome; ?></b>
            </li>
            <li class="<?php echo (isset($option) && $option == 'Aulas' ? 'active' : ''); ?>">
                <?php echo anchor('Aluno/Aulas', 'Aulas', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'Simulados' ? 'active' : ''); ?>">
                <?php echo anchor('Aluno/Simulados', 'Simulados', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'Exercicios' ? 'active' : ''); ?>">
                <?php echo anchor( 'Aluno/Exercicios', 'Exercicios', array( 'class'=> 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'Grupos' ? 'active' : ''); ?>">
                <?php echo anchor('Aluno/Grupos', 'Grupos', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="<?php echo (isset($option) && $option == 'Opcoes' ? 'active' : ''); ?>">
                <?php echo anchor('Aluno/Opcoes', 'Opções', array('class' => 'waves-effect waves-teal')); ?>
            </li>
            <li class="divider"></li>
            <li>
                <?php echo anchor('LearningUp/logout', 'Sair', array('class' => 'waves-effect waves-red')); ?>
            </li>
        </ul>
        <?php if(isset($option)): ?>
        <div class="container adminMain">
            <!-- Aulas -->
            <?php if($option == "Aulas"): ?>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Aulas (Matérias)</h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                	<?php foreach ($materias as $mat): ?>
					<div class="col m12 l6">
						<div class="card teal darken-3" >
							<div class="card-content white-text">
								<h5 class="card-title"><?php echo $mat['nome']; ?></h5>
								<p><?php echo $mat['descricao']; ?></p>
							</div>
							<div class="card-action">
								<?php echo  anchor('Aluno/Materia/'.$mat['id'], 'Ver aulas!', array('class' => 'btn waves-effect waves-blue'));  ?>
							</div>
						</div>
					</div>
                	<?php endforeach; ?>
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
            <!-- END Aulas -->
            <!-- MAterias -->
            <?php if($option == "Aulas"): ?>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Aulas de <?php echo $materia['nome']; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                	<?php foreach ($materias as $mat): ?>
					<div class="col m12 l6">
						<div class="card teal darken-3" >
							<div class="card-content white-text">
								<h5 class="card-title"><?php echo $mat['nome']; ?></h5>
								<p><?php echo $mat['descricao']; ?></p>
							</div>
							<div class="card-action">
								<?php echo  anchor('Aluno/Materia/'.$mat['id'], 'Ver aulas!', array('class' => 'btn waves-effect waves-blue'));  ?>
							</div>
						</div>
					</div>
                	<?php endforeach; ?>
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
            <!-- END MAterias -->
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
