<?php
    ob_start();
    session_start();
    ob_clean();
    
    use App\Controllers\UsuarioController;
    $imagem_de_perfil = isset($_SESSION['img_usuario']) ? $_SESSION['img_usuario'] : "";
    $nome_usuario = isset($_SESSION['nome_usuario'])?$_SESSION['nome_usuario']:"";
    $url = UsuarioController::UrlAtual();
    $img_logo= null;
    if($url == 'http://'.APP_HOST.'vazamento' || $url == 'http://'.APP_HOST ||
            $url == 'http://'.APP_HOST.'home' || $url == 'http://'.APP_HOST.'index.php'):
        $img_logo = IMG_LOGO2;
    else:
        $img_logo = IMG_LOGO;
    endif;
    
 ?>
<script type="text/javascript" src="public/script_site.js"></script>
<nav class="navbar bg-dark navbar-dark my_navbar" id="my_navbar">
    
        <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>">
            <img src="<?=$img_logo?>"></a>
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
                <input type="hidden" name="login_ver" id="login_ver" value="<?php echo $nome_usuario;?>" required>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://<?php echo APP_HOST; ?>usuario/cadastro">Cadastro</a>
            </li>
            <li class="nav-item">
                <input type="hidden" id="val_logout" value="http://<?php echo APP_HOST; ?>usuario/logout">
            </li>
        </ul>
    
    </div>
     
   </nav>
            
            <?php if($imagem_de_perfil == ""){
                $imagem_de_perfil = "perfil.png";
            }?>
            <!--verifica se existe a session nome_usuario e se a url equivale a do usuario ou home e imprime o texto de bem vindo-->
            <?php if((isset($_SESSION['nome_usuario']) && $url == 'http://'.APP_HOST.'vazamento')
                  || (isset($_SESSION['nome_usuario']) && $url == 'http://'.APP_HOST)){
                    echo 
                       "<div class='dropdown text-right' style='margin-top:10px;margin-right:10px;width:auto;height:auto;'>".
                       "<img src='_fontes/imgs/$imagem_de_perfil' style='width:40px;height:40px;margin-right:5px;'  class='dropdown-toggle img-thumbnail' id='dropdownMenuButto' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' type='button'>"
                        ."<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                           <h6 class='dropdown-header'>".$nome_usuario."</h6>".
                          "<a class='dropdown-item' href='#'>Editar perfil</a>
                          <a class='dropdown-item' href='#'>Meus vazamentos</a>
                          <a class='dropdown-item' id='logout' href='#'>Sair</a>
                        </div>
                        
                        </div>";
            }?>

    
   
           