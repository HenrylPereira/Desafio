
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta author="Henry Lopes Pereira">
    <title>Desafio</title>
    <script src="../assets/js/main.js"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link src="../assets/js/bootstrap.js">
    <link href="../assets/css/layout.css" rel="stylesheet">
  </head>
  <body>
      <?php 
       include "../security/database/connection.php";
       include "../security/authentication/validation.php";
      ?>
      <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Desafio Henry</a>
        <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
            <a class="nav-link" href="../security/authentication/logout.php">Sair</a>
          </li>
        </ul>
      </nav>
      <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php?folder=projects/&file=mainproject.php">
                        <span data-feather="file"></span>
                        Cadastrar Projetos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="main.php?folder=activities/&file=mainactivities.php">
                        <span data-feather="users"></span>
                        Cadastrar Atividades
                        </a>
                    </li>
                    </ul>
                </div>
            </nav>
      </div>
      <br>
      <br>
        <div class="row justify-content-md-center">
            <div class="col-2">   
                <?php
                if(isset($_GET['mensagem'])){   
                ?>
                  <div class="alert alert-primary" role="alert"> 
                <?php        
                    echo $_GET['mensagem'];
                ?>
                  </div> 
                  <?php
                    }
                ?> 
            </div>  
        </div>         
        <?php 
          if(isset($_GET['folder']) && isset($_GET['file'])){
            if (@!include $_GET['folder'].$_GET['file']){
              echo "404 not found";
            }
          }
                
        ?>   
   </body>
</html>
       


