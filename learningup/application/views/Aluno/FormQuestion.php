<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Question View</title>
  </head>
  <body>
    <?php
      echo form_open("Aluno/createQuestion");
    ?>
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo"/><br/>
    <label for="texto">Texto:</label>
    <input type="text" name="texto"/><br/>
    <label for="texto">Fonte:</label>
    <input type="text" name="fonte"/><br/>
    <label for="texto">Tag:</label>
    <input type="text" name="tag"/><br/>
    <input type="submit"/>
    <?php
      echo form_close();
    ?>
  </body>
</html>
