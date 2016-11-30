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
        <div class="container-fluid adminMain" style="margin-left: 240px;">
            <!-- Exercicios & Simulados -->
            <?php if($option == "Exercicios" || $option == "Simulados"): ?>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Listas de <?php if ($option == "Exercicios"): ?>Exércicios<?php else: ?>Simulados<?php endif ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <?php if(isset($listas_exercicios) && !is_null($listas_exercicios)):?>
                    <table class="centered highlight responsive-table">
                        <thead>
                            <tr>
                                <th data-field="id">ID</th>
                                <th data-field="titulo">Título</th>
                                <th data-field="realizado">Realizado <i class="material-icons">&#xE8F4;</i></th>
                                <th data-field="gostei">Gostei <i class="material-icons">&#xE8DC;</i></th>
                                <th data-field="n_gostei">Não gostei <i class="material-icons">&#xE8DB;</i></th>
                                <th data-field="tempo_limite">Tempo Limite <i class="material-icons">&#xE425;</i></th>
                                <th data-field="n_gostei">Acessar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($listas_exercicios as $le):  ?>
                            <tr>
                                <td><?php echo $le['id']; ?></td>
                                <td><?php echo $le['titulo']; ?></td>
                                <td><?php echo (int)$le['realizado']; ?></td>
                                <td><?php echo (int)$le['gostei']; ?></td>
                                <td><?php echo (int)$le['n_gostei']; ?></td>
                                <td><?php echo (int)$le['tempo_limite']; ?></td>
                                <td><?php echo anchor("Aluno/".($option == "Exercicios" ? "RealizarListaExercicios/" : "ConfirmarSimulado/").$le['id'], "Acessar", array('class' => "btn waves-effect waves-blue")); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <?php endif; ?>
            <!-- END Exercicios & Simulados -->
            <!-- Aulas -->
            <?php if($option == "Aulas"): ?>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Aulas (Matérias)</h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                	<?php if(isset($materias) && !is_null($materias)): foreach ($materias as $mat): ?>
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
                	<?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <?php endif; ?>
            <!-- END Aulas -->
            <!-- MAterias -->
            <?php if($option == "Materia"): ?>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Aulas de <?php echo $materia['nome']; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <?php if(isset($conteudos) && !is_null($conteudos)): foreach ($conteudos as $cont): ?>
                    <div class="col m12 l6">
                        <div class="card teal darken-3" >
                            <div class="card-content white-text">
                                <h5 class="card-title"><?php echo $cont['nome']; ?></h5>
                                <p><?php echo $cont['descricao']; ?></p>
                            </div>
                            <div class="card-action">
                                <?php echo  anchor('Aluno/Conteudo/'.$cont['id'], 'Ver aulas!', array('class' => 'btn waves-effect waves-blue'));  ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <?php endif; ?>
            <!-- END MAterias -->
            <!-- Conteudo -->
            <?php if($option == "Conteudo"): ?>
            <div class="row">
                <div class="col s12">
                    <h1 class="center">Aulas de <?php echo $conteudo['nome']; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <?php if(isset($aulas) && !is_null($aulas)): foreach ($aulas as $aula): ?>
                    <div class="col m12 l6">
                        <div class="card teal darken-3" >
                            <div class="card-content white-text">
                                <h5 class="card-title"><?php echo $aula['nome']; ?></h5>
                                <p><?php echo $aula['descricao']; ?></p>
                            </div>
                            <div class="card-action">
                                <?php echo  anchor('Aluno/AssistindoAula/'.$aula['id'], 'Assistir!', array('class' => 'btn waves-effect waves-blue'));  ?>
                                <span class="white-text"> 55 minutos</span>
                                    <span class="badge ">
                                    <span class="chip"><?php echo (int)$aula['gostei']; ?> <i class="material-icons">&#xE8DC;</i></span> 
                                    <span class="chip"><?php echo (int)$aula['n_gostei']; ?> <i class="material-icons">&#xE8DB;</i></span> 
                                    <span class="chip"><?php echo (int)$aula['realizado']; ?>  <i class="material-icons">&#xE8F4;</i></span> 
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <?php endif; ?>
            <!-- END Conteudo -->
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
