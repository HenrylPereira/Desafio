<?php
  include "../../security/authentication";
  
  $nome     = $_POST['nome'];
  $inicio   = $_POST['inicio'];
  $fim     = $_POST['fim'];
  date_default_timezone_set('America/Sao_Paulo');
  $date = date('Y-m-d');
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
      
        include "../../security/database/connection.php";
        include "../security/authentication/validation.php";

        $sql = "INSERT INTO projetos (id, nome, inicio, fim) VALUES (:id, :nome, :inicio, :fim)";

        $stm_sql = $db_connection->prepare($sql);

        $id         = null;
      
        $stm_sql->bindParam(':id', $id);
        $stm_sql->bindParam(':nome', $nome);
        $stm_sql->bindParam(':inicio', $inicio);
        $stm_sql->bindParam(':fim', $fim);  

        $result = $stm_sql->execute();

        if($result){
          $msg = "Cadastro efetuado com sucesso!";
        }else{
          $msg = "Falha ao cadastrar!";
        }
  }
  header("Location:main.php?folder=projects/&file=mainproject.php&&mensagem=" . $msg)
?>

