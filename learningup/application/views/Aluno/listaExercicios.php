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
            <?php if(!is_null($outros_exercicios)){ $i = 1; foreach ($outros_exercicios as $oe): ?>
            <li class="<?php if($exercicio_atual == $i - 1) echo 'active'; ?>">
                <?php echo anchor('Aluno/RealizarExercicio/'.$oe['id']."/".$lista_exercicio['id'], "<b>".$i."</b> - ".$oe['titulo'].($resultados[$i-1] != NULL ? ($resultados[$i-1]['correto'] == 1 ? " - Acertou" : " - Errou" ) : ""), array('class' => 'waves-effect waves-blue white-text'));
                ?>
            </li>
            <?php ++$i; endforeach; unset($i); } ?>
            <li class="divider"></li>
            <li>
                <?php if (!isset($option) || $option != "Resultado"): ?>
                <?php echo anchor('Aluno/FinalizarListaExercicios', 'Finalizar', array('class' => 'waves-effect waves-blue white-text blue')); ?>
                <?php echo anchor('Aluno/CancelarListaExercicios', 'Cancelar', array('class' => 'waves-effect waves-red white-text red')); ?>                    
                <?php else: ?>
                <?php echo anchor('Aluno/Exercicios', 'Voltar', array('class' => 'waves-effect waves-blue white-text blue')); ?>
                <?php endif; ?>
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
            <?php endif; ?>
            <?php if ($option == "ConfirmarSimulado"): ?>
            <h3 class="center">Simulado - <?php echo $lista_exercicio['titulo']; ?></h3>
            <br>
            <ul>
                <li>Essa lista é composta por <b><?php echo (int)$qntExercicios; ?> exércicios</b>.</li>
                <li><b><?php echo (int)$lista_exercicio['gostei']; ?> gostaram</b> e <b><?php echo (int)$lista_exercicio['n_gostei']; ?> não gostaram</b>.</li>
                <li>Foi <b>realizada <?php echo (int)$lista_exercicio['realizado']; ?> vezes</b>.</li>
                <li>Tem <b>tempo limite de <?php echo $lista_exercicio['tempo_limite']; ?></b>.</li>
            </ul>
            <br>
            <p>Uma vez iniciado o simulado você não poderá parar!</p>
            <p>Para iniciar clique no botão <b>Proximo</b> abaixo. Ou clique em <b>Cancelar</b> para cancelar.</p>
            <br>
            <?php echo anchor('Aluno/RealizarExercicio/'.$outros_exercicios[++$exercicio_atual]['id']."/".$lista_exercicio['id'], "Proximo >", array('class' => 'waves-effect waves-blue btn right')); ?>
            <?php echo anchor('Aluno/CancelarListaExercicios/', "Cancelar", array('class' => 'waves-effect waves-purple red btn left')); ?>
            <?php endif; ?>
            <?php if ($option == "Exercicio"): ?>
            <h5><?php echo $exercicio_atual + 1; ?> - <?php echo $exercicio['titulo']; ?></h5>
            <p>(<?php echo $exercicio['fonte']; ?>) - <?php echo $exercicio['texto']; ?></p>
            <?php echo form_open("Aluno/ChecarResposta"); ?>
                <?php foreach ($exercicio['opcoes'] as $op): ?>
                    <p>
                        <input class="with-gap <?php if($resultados[$exercicio_atual]['correto'] == FALSE) echo 'errado'; else echo 'certo'; ?>" type="radio" name="resposta" id="resposta<?php echo $op['id']; ?>" value="<?php echo $op['id']; ?>" required <?php if(!is_null($resultados[$exercicio_atual])){ echo "disabled "; if($resultados[$exercicio_atual]['resposta'] == $op['id']) echo "checked ";} ?>>
                        <label for="resposta<?php echo $op['id']; ?>"><?php echo $op['texto'];?></label>
                    </p>
                <?php endforeach; ?>
                <button type="submit" class="btn right waves-blue waves-effect"><?php if($exercicio_atual + 1 < $qntExercicios) echo "Proximo"; else echo "Concluir"; ?></button>
            </form>
            <?php endif; ?>
            <?php if ($option == "Resultado"): ?>
                <h2>Resultado - <?php echo $lista_exercicio['titulo']; ?></h2>
                <table>
                    <thead> 
                        <tr>
                            <td>Resultado</td>
                            <td>Valor</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Acertos</td>
                            <td><?php echo $acertos; ?></td>
                        </tr>
                        <tr>
                            <td>Erros</td>
                            <td><?php echo $erros; ?></td>
                        </tr>
                        <tr>
                            <td>Em branco</td>
                            <td><?php echo $em_branco; ?></td>
                        </tr>
                        <tr>
                            <td>Nota</td>
                            <td><?php echo $nota; ?>%</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Acerto?</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($resultados); ++$i): ?>
                        <tr>
                            <td><?php echo $i + 1; ?></td>
                            <td><?php if(is_null($resultados[$i])) echo "-"; else echo $resultados[$i]['correto'] ? ":)" : "X"; ?></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
        <?php endif; ?>

        <script type="text/javascript">
        $(document).ready(function() {
            $("#slide-out").sideNav('show');
        });
        </script>
    </body>

    </html>
