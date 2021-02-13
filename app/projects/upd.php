<?php
  include "../../security/authentication";
  include "../../security/database/connection.php";

  $id       = $_POST['id']; 
  $nome    = $_POST['nome'];
  $inicio  = $_POST['inicio'];
  $fim    = $_POST['fim'];
  $msg = "";

  if($nome==""){
    $msg = "Preencha o campo nome.";
  }elseif($inicio=="" or $inicio < 2000 or $inicio > 2050){
    $msg = "Data de início inválida.";
  }elseif($fim=="" or $fim < 2000 or $fim > 2050){
    $msg = "Data de término inválida.";
  }elseif($inicio > $fim){
    $msg = "Data de início maior que a data de término!";
  }elseif($fim < $date){
    $msg = "Você não pode registar um projeto para uma data passada!";
  }else{

      $sql = "UPDATE projetos
                SET nome=:nome, inicio=:inicio, fim=:fim
                WHERE id=:id";
      $stm_sql = $db_connection->prepare($sql);
      $stm_sql->bindParam(':nome', $nome);
      $stm_sql->bindParam(':inicio', $inicio);
      $stm_sql->bindParam(':fim', $fim);
      $stm_sql->bindParam(':id', $id);
      $result = $stm_sql->execute();

      if($result){
        $msg = "Alteração efetuada com sucesso!";
      }else{
        $msg = "Falha ao alterar.";
      }
  }
  header("Location:main.php?folder=projects/&file=frmupd.php&&mensagem=" . $msg)
?>
