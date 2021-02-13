<?php
  include "../../security/authentication";

  $id = $_GET['id'];

  $sql = "DELETE FROM atividades WHERE id=:id";

  $stm_sql = $db_connection->prepare($sql);
  $stm_sql->bindParam(':id', $id);
  $result = $stm_sql->execute();

  if($result){
    $msg = "Atividade excluída com sucesso.";
  }else{
    $msg = "Erro ao excluir atividade.";
  }
  header("Location:main.php?folder=activities/&file=mainactivities.php&&mensagem=" . $msg)
?>

