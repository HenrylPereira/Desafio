<?php
    $email = $_POST['email'];
    $senha   = $_POST['senha'];
    $senha_criptografada = md5($senha);
    $msg = "";
    $link = "../../index.php";
    if($email==""){
        $msg = "Preencha o campo email";
        $link = "../../index.php?mensagem=" . $msg;
    }else if($senha==""){
        $msg = "Preencha o campo senha.";
        $link = "../../index.php?mensagem=" . $msg;
    }else{
        include "../database/connection.php";

        $sql = "SELECT email, senha FROM usuarios WHERE email=:email
        AND senha=:senha";

        $stm_sql = $db_connection->prepare($sql);
        $stm_sql-> bindParam(':email', $email);
        $stm_sql->bindParam(":senha", $senha_criptografada);
        $stm_sql->execute();

        if($stm_sql->rowCount()==1){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha_criptografada;
            $_SESSION['idsessao'] = session_id();     
            $link = "../../app/main.php?folder=projects/&file=mainproject.php";
            $msg = "Bem Vindo!";
            
        }else{ 
            $msg = "Usuário ou senha incorretos.";
            $link = "../../index.php?mensagem=" . $msg;
        }

    }
    header("Location: " . $link . "&&mensagem=" . $msg)
?>


