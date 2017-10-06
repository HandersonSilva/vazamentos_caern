<?php
       
      use App\Controllers\UsuarioController;
      session_start(); 
      $url = UsuarioController::UrlAtual();
          
 ?>
<nav class="navbar navbar-dark bg-dark" id="my_navbar">
        <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>">
            <img src="_fontes/imgs/logo_vaz_caern.png" id="img_logo"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="http://<?php echo APP_HOST; ?>">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="menu_logar" href="http://<?php echo APP_HOST; ?>usuario/Login">Logar</a>
                <!--seta o value do campo com a sessao do usario logado-->
                <input type="hidden" name="login_ver" id="login_ver" value="<?php echo $_SESSION['nome_usuario'];?>" required>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://<?php echo APP_HOST; ?>usuario/logout">Logout</a>
            </li>
        </ul>
    
    </div>
    
   </nav>
<p class="text-right"><?php if(isset($_SESSION['nome_usuario']) && $url == 'http://'.APP_HOST.'vazamento'){
        echo "Bem vindo(a) ".$_SESSION["nome_usuario"];
    }?>
    </p>