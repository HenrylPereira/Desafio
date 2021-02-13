<!DOCTYPE html>
<?php
include "../../security/authentication";
include "../../security/database/connection.php";

$sql = "SELECT id, nome FROM projetos";
$stm_sql = $db_connection->prepare($sql);
$stm_sql->execute();
$projects = $stm_sql->fetchAll(PDO::FETCH_ASSOC);
?>

<html lang="pt-br">
  <body>
    <div class="row justify-content-md-center">
      <div class="col-6">
        <h2>Cadastro de Atividades</h2>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-6">
        <form name="nome" action="main.php?folder=activities/&file=ins.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Nome da atividade:</label>
            <input type="name" class="form-control" id="idnome" name="nome">
          </div>
          <label for="projeto">Projeto:</label>
          <select name="projeto" class="form-control form-control-lg">
            <option value="">Selecione</option>
            <?php
            foreach ($projects as $project) {
              $selecionado = "";
              if ($project['id'] == $activity['projetos_id']) {
                $selecionado = "selected";
              }
            ?>
              <option value="<?php echo $project['id']; ?>" <?php echo $selecionado; ?>>
                <?php echo $project['nome']; ?>
              </option>
            <?php
            }
            ?>
          </select>
          <div class="form-group">
            <label for="datainicio">Data de início:</label>
            <input type="date" class="form-control" id="idinicio" name="inicio">
          </div>
          <div class="form-group">
            <label for="datafim">Data de término:</label>
            <input type="date" class="form-control" id="idfim" name="fim">
          </div>
          <div class="form-group">
            <label for="select">Está finalizado?</label>
            <select class="form-control" id="idfinalizado" name="finalizado">
              <option value="">Selecione:</option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Enviar</button>
          <button type="reset" class="btn btn-danger">Limpar</button>
        </form>
      </div>
    </div><br><br>

    <div class="row justify-content-md-center">
      <div class="col-6">
        <h3>Atividades Cadastradas</h3>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-6">
        <?php
        $sql = "SELECT * FROM atividades";
        $stm_sql = $db_connection->prepare($sql);
        $stm_sql->execute();
        $activities = $stm_sql->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID da Atividade</th>
              <th scope="col">ID do Projeto</th>
              <th scope="col">Nome:</th>
              <th scope="col">Data de Início</th>
              <th scope="col">Data de Término</th>
              <th scope="col">Status</th>
              <th scope="col">Alterar</th>
              <th scope="col">Deletar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($activities as $activity) {
              if ($activity['pronto'] == 1) {
                $pronto = "Finalizado";
              } else {
                $pronto = "Em desenvolvimento";
              }
            ?>
              <tr>
                <td><?php echo $activity['id']; ?></td>
                <td><?php echo $activity['projetos_id']; ?></td>
                <td><?php echo $activity['nome']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($activity['inicio'])); ?></td>
                <td><?php echo date("d/m/Y", strtotime($activity['fim'])); ?></td>
                <td><?php echo $pronto; ?></td>
                <td><a href="main.php?folder=activities/&file=frmupd.php&id=<?php echo $activity['id']; ?>"><img src="../assets/images/alterar.png" height="20px" width="20px"></a></td>
                <td><a href="main.php?folder=activities/&file=del.php&id=<?php echo $activity['id']; ?>" onclick="return valDel('categoria','<?php echo $activity['nome']; ?>')"><img src="../assets/images/excluir.png" height="20px" width="20px"></a></td>
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