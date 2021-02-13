<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta author="Henry Lopes Pereira">
    <title>Desafio</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/alert.css">
  </head>
  <body>
    <div>
      <?php if (isset($_GET['mensagem'])) { ?>
        <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <?php echo $_GET['mensagem']; ?>
        </div>
      <?php } ?>
    </div>
    <form class="box" action="security/authentication/login.php" method="post">
      <h1>Login</h1>
      <h4>Login: admin@admin</h4>
      <h4>Senha: admin</h4>
      <input type="text" id="idusuario" name="email" placeholder="Email">
      <input type="password" id="idsenha" name="senha" placeholder="Senha">
      <input type="submit" name="" value="Entrar">
    </form>
  </body>
</html>