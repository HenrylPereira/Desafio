<?php

  $id       = $_POST['id'];
  $nome     = $_POST['nome'];
  $projeto  = $_POST['projeto'];
  $inicio   = $_POST['inicio'];
  $fim      = $_POST['fim'];
  $pronto   = $_POST['finalizado'];
  date_default_timezone_set('America/Sao_Paulo');
  $date = date('Y-m-d');
  $msg = "";

  if($nome==""){
    $msg = "Preencha o campo nome!";
  }elseif($projeto==""){
    $msg = "Selecione um projeto!";
  }elseif($inicio=="" or $inicio < 2000 or $inicio > 2050){
    $msg = "Data de início inválida!";
  }elseif($fim=="" or $fim < 2000 or $fim > 2050){
    $msg = "Data de término inválida!";
  }elseif($inicio > $fim){
    $msg = "Data de início maior que a data de término!";
  }elseif($fim<$date and $pronto == "0"){
     $msg = "Você não pode registrar uma atividade incompleta para uma data passada!";
  }elseif($pronto==""){
     $msg = "Preencha o campo 'Está Finalizado?'";
  }else{
    include "../../security/database/connection.php";
    include "../security/authentication/validation.php";
    
    $sql = "UPDATE atividades
    SET nome=:nome, projetos_id=:projetos_id, inicio=:inicio, fim=:fim, pronto=:pronto
    WHERE id=:id";
      $stm_sql = $db_connection->prepare($sql);
      $stm_sql->bindParam(':nome', $nome);
      $stm_sql->bindParam(':projetos_id', $projeto);
      $stm_sql->bindParam(':inicio', $inicio);
      $stm_sql->bindParam(':fim', $fim);
      $stm_sql->bindParam(':pronto', $pronto);
      $stm_sql->bindParam(':id', $id);
      $result = $stm_sql->execute();
      if($result){
        $msg = "Alteração efetuada com sucesso!";
      }else{
        $msg = "$id, $projeto , $nome , $inicio, $fim, $pronto";
      }
  }
  header("Location:main.php?folder=activities/&file=mainactivities.php&&mensagem=" . $msg)
  ?>
