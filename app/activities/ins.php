<?php
  include "../../security/authentication";
  include "../security/authentication/validation.php";
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
    $msg = "Selecione um projeto, caso não tenha crie na aba 'Cadastrar Projeto'!";
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
       $sql = "INSERT INTO atividades (id, projetos_id, nome, inicio, fim, pronto) VALUES (:id, :projetos_id, :nome, :inicio, :fim, :pronto)";
        $stm_sql = $db_connection->prepare($sql);
        $id         = null;  
        $stm_sql->bindParam(':id', $id);
        $stm_sql->bindParam(':projetos_id', $projeto);
        $stm_sql->bindParam(':nome', $nome);
        $stm_sql->bindParam(':inicio', $inicio);
        $stm_sql->bindParam(':fim', $fim);
        $stm_sql->bindParam(':pronto', $pronto);   

        $result = $stm_sql->execute();

        if($result){
          $msg = "Cadastro efetuado com sucesso!";
        }else{
          $msg = "Falha ao cadastrar!";
        }
  }
header("Location:main.php?folder=activities/&file=mainactivities.php&&mensagem=" . $msg)
?>

