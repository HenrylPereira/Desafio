<!DOCTYPE html>
<html lang="pt-br">
    <?php
      include "../../security/authentication";
      include "../../security/database/connection.php";

      $id = $_GET['id'];

      $sql = "SELECT * FROM projetos WHERE id=:id";
      $stm_sql = $db_connection->prepare($sql);
      $stm_sql->bindParam(':id', $id);
      $stm_sql->execute();

      $project = $stm_sql->fetch(PDO::FETCH_ASSOC);
      
    ?>
     <div class="row justify-content-md-center">
        <div class="col-4">
            <h2>Alteração de projetos</h2>
        </div>  
    </div>
    <div class="row justify-content-md-center">
        <div class="col-4">
            <form name="upduser" action="main.php?folder=projects/&file=upd.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="idemail">Nome do projeto:</label>
                <input type="text" class="form-control" type="nome" name="nome" value="<?php echo $project['nome'];?>">
            </div>
            <div class="form-group">
                <label for="idusuario">Data de início:</label>
                <input type="date" class="form-control" type="inicio" name="inicio" value="<?php echo $project['inicio'];?>">
            </div>
            <div class="form-group">
                <label for="idusuario">Data de término:</label>
                <input type="date" class="form-control" type="fim" name="fim" value="<?php echo $project['fim'];?>">
            </div>
        
            <button type="submit" class="btn btn-success">Enviar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
            </form>
        </div>
    </div>
    <br>
  </body>
</html>

