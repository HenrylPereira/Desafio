<?php
  include "../../security/authentication";
  
  $id = $_GET['id'];

  $sql = "DELETE FROM projetos WHERE id=:id";

  $stm_sql = $db_connection->prepare($sql);
  $stm_sql->bindParam(':id', $id);
  $result = $stm_sql->execute();

  if($result){
    $msg = "Projeto excluído com sucesso.";
  }else{
    $msg = "Você não pode excluir esse projeto pois ainda está ligada a uma ou mais atividades!";
  }
  header("Location:main.php?folder=projects/&file=mainproject.php&&mensagem=" . $msg)
?>

