<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Question View</title>
  </head>
  <body class="white">
    <div style="margin-left:242px">
      <?php
        echo form_open_multipart("Admin/createSubject"); 
      ?>
        <div class="teal">
        
        </div>
      <label for="nome">Nome</label>
      <input type="text" name="nome"/><br/>
      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao"/><br/>
      <label for="cor">Cor:</label>
      <input type="text" name="cor"/><br/>
      <div class="file-field input-field">
        <div class="btn">
          <span>Imagem</span>
          <input type="file" name="img" id="img"/><br/>
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text"/>
        </div>
    </div>
      <input class="btn waves-effect waves-light" value="Cadastrar" type="submit"/>
      <?php
        echo form_close();
      ?>
    </div>
  </body>
</html>
