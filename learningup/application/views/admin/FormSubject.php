<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Question View</title>
  </head>
  <body>
    <?php
      echo form_open("Admin/createSubject");
    ?>
    <label for="nome">Nome</label>
    <input type="text" name="nome"/><br/>
    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao"/><br/>
    <label for="cor">Cor:</label>
    <input type="text" name="cor"/><br/>
    <label for="img">Image:</label>
    <input type="file" name="img"/><br/>
    <input type="submit"/>
    <?php
      echo form_close();
    ?>
  </body>
</html>