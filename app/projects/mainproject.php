
<?php 
  include "../../security/database/connection.php";
  include "../../security/authentication";
  ?>
<html lang="pt-br">
  <div class="row justify-content-md-center">
    <div class="col-6">
      <h2>Cadastro de Projetos</h2>
    </div>
  </div>
    <div class="row justify-content-md-center">
      <div class="col-6">
          <form name="nome" action="main.php?folder=projects/&file=ins.php" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome do Projeto:</label>
                <input type="name" class="form-control" id="idnome" name="nome">
              </div>
              <div class="form-group">
                <label for="datainicio">Data de início:</label>
                <input type="date" class="form-control" id="idinicio" name="inicio">
              </div>
              <div class="form-group">
                <label for="datafim">Data de término::</label>
                <input type="date" class="form-control" id="idfim" name="fim">
              </div>
              
              <button type="submit" class="btn btn-success">Enviar</button>
              <button type="reset" class="btn btn-danger">Limpar</button>
          </form>
      </div>
    </div><br><br>
        
      <div class="row justify-content-md-center">  
        <div class="col-6">
            <h3>Projetos Cadastrados</h3>
        </div>
      </div>
       <div class="row justify-content-md-center">
          <div class="col-6">
          <?php
            $sql = "SELECT * FROM projetos";
            $stm_sql = $db_connection->prepare($sql);
            $stm_sql->execute();
            $projects = $stm_sql->fetchAll(PDO::FETCH_ASSOC);
          ?>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome Projeto</th>
                  <th scope="col">Data de Início</th>
                  <th scope="col">Data de Término</th>
                  <th scope="col">Andamento</th>
                  <th scope="col">Atrasado</th>
                  <th scope="col">Alterar</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
                <tbody>
                      <?php
                        foreach($projects as $project){
                          $pronto = 0;
                          $soma = 0;
                          $total = 0;
                          $auxiliar = 0;
                          $atrasado = "Não";
                          $projetos_id = $project['id'];
                          $sql = "SELECT * FROM atividades WHERE projetos_id=:projetos_id";
                          $stm_sql = $db_connection->prepare($sql);
                          $stm_sql->bindParam(':projetos_id', $projetos_id);
                          $stm_sql->execute();
                          $activities = $stm_sql->fetchAll(PDO::FETCH_ASSOC);
                          foreach($activities as $activity){
                            $total = $total + 1;
                            if ($activity['pronto'] == 1) {
                              $pronto = $pronto + 1;
                            }
                            $soma = $pronto * 100 / $total;
                          }
                          $sql = "SELECT * FROM atividades WHERE projetos_id=:projetos_id AND fim>:fim AND pronto=:pronto";
                          $stm_sql = $db_connection->prepare($sql);
                          $stm_sql->bindParam(':projetos_id', $projetos_id);
                          $stm_sql->bindParam(':fim', $project['fim']);
                          $stm_sql->bindParam(':pronto', $auxiliar);
                          $stm_sql->execute();
                          $finals = $stm_sql->fetchAll(PDO::FETCH_ASSOC);
                          foreach($finals as $final){
                            if ($final > 0) {
                              $atrasado = "Sim";
                            }else{
                              $atrasado = "Não";
                            }
                          }
                      ?>
                        <tr>
                          <td><?php echo $project['id']; ?></td>
                          <td><?php echo $project['nome'];?></td>
                          <td><?php echo date("d/m/Y", strtotime($project['inicio']));?></td>
                          <td><?php echo date("d/m/Y", strtotime($project['fim']));?></td>
                          <td><?php echo round($soma);?>%</td>
                          <td><?php echo $atrasado;?></td>
                          <td><a href="main.php?folder=projects/&file=frmupd.php&id=<?php echo $project['id']; ?>" ><img  src="../assets/images/alterar.png" height="20px" width="20px"></a></td>
                          <td><a href="main.php?folder=projects/&file=del.php&id=<?php echo $project['id']; ?>" onclick="return valDel('categoria','<?php echo $activity['nome'];?>')"><img src="../assets/images/excluir.png" height="20px" width="20px"></a></td>
                        </tr>
                      <?php
                        }
                      ?>
                    </tbody>
              </table>
            </div>
        </div>
    </body>
</html>

                            