<!DOCTYPE html>
<html lang="pt-br">
<?php
include "../../security/database/connection.php";
include "../../security/authentication";
$id = $_GET['id'];

$sql = "SELECT id, nome FROM projetos";
$stm_sql = $db_connection->prepare($sql);
$stm_sql->execute();
$projects = $stm_sql->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM atividades WHERE id=:id";
$stm_sql = $db_connection->prepare($sql);
$stm_sql->bindParam(':id', $id);
$stm_sql->execute();
$activities = $stm_sql->fetch(PDO::FETCH_ASSOC);
?>
<div class="row justify-content-md-center">
    <div class="col-4">
        <h2>Alteração de atividades</h2>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col-4">
        <form name="updcat" action="main.php?folder=activities/&file=upd.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="idemail">Nome da atividade:</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $activities['nome']; ?>">
            </div>
            <label for="projeto">Projeto:</label>
            <select name="projeto" class="form-control form-control-lg">
                <?php
                foreach ($projects as $project) {
                    $selecionado = "";
                    if ($project['id'] == $activities['projetos_id']) {
                        $selecionado = "selected";
                    }
                ?>
                    <option value="<?php echo $project['id']; ?>" <?php echo $selecionado; ?>>
                        <?php echo $project['nome']; ?>
                    </option>
                <?php
                }
                ?>
                <select>
                    <div class="form-group">
                        <label for="inicio">Data de início:</label>
                        <input type="date" class="form-control" name="inicio" value="<?php echo $activities['inicio']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fim">Data de término:</label>
                        <input type="date" class="form-control" name="fim" value="<?php echo $activities['fim']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="idusuario">Está Finalizado?</label>
                        <select name="finalizado" class="form-control form-control-lg">
                            <option value="<?php echo $activities['pronto']; ?>">
                                <?php
                                if ($activities['pronto'] == 0) {
                                    $auxpronto = "Não";
                                    $inverso = 1;
                                    echo $auxpronto;
                                } else {
                                    $auxpronto = "Sim";
                                    $inverso = 0;
                                    echo $auxpronto;
                                } ?>
                            </option>
                            <option value="<?php echo $inverso; ?>">
                                <?php
                                if ($inverso == 0) {
                                    echo "Não";
                                } else {
                                    echo "Sim";
                                }
                                ?>
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <button type="reset" class="btn btn-warning">Limpar</button>
        </form>
    </div>
</div>

</html>