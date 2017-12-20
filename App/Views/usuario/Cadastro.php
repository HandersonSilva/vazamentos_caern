 <?php
session_start();
$msg = isset($_SESSION['msg'])? $_SESSION['msg'] : "";
$sucesso = isset($_SESSION['sucesso'])? $_SESSION['sucesso'] : "";
 
 ?>
<script src="../public/script_site.js"></script>
<link rel="stylesheet" type="text/css" href="public/estilo_home.css"/>

   <div class="container" style="margin-top: 100px">
          
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="page-header">
                    <h2>Novo usuário</h2>          
                </div>
                <form action="http://<?php echo APP_HOST;?>usuario/Salvar" method="POST" enctype="multipart/form-data" id="form_user">
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                       
                        <input class="mdl-textfield__input user" type="text" id="nome_cad" name="nome_usuario" onload="configClickInput(nome_cad,icon_user)">
                        <label class="mdl-textfield__label" for="nome_cad"><i class="material-icons icon_user icon" >person</i>  *Nome de usuário</label>
                    </div>
              
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input email" type="email" id="email_cad" name="email_usuario">
                        <label class="mdl-textfield__label" for="nome_cad"><i class="material-icons icon_email icon">email</i>  *Email</label>
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input senha" type="password" id="senha_cad" name="senha_usuario">
                        <label class="mdl-textfield__label" for="nome_cad"><i class="material-icons icon_senha icon">vpn_key</i>  *Senha</label>
                    </div>
                     <div class="mdl-layout">
                         <label for="img_perfil">Imagem de perfil</label>
                         <input class="mdl-textfield__input" type="file" id="img_perfil" name="img_perfil">
                    </div>
                    <br>
                 
                    <button type="submit" id="btn_cad" class="btn btn-primary pull-right">Cadastrar</button>
  
 
</form>
                
                
              <br>
              <?php if(!empty($msg)){?>
               <?php echo'<div class="alert alert-danger" role="alert">'
                     .'<i class="material-icons">error</i>'
                    .$_SESSION['msg'];
                     unset($_SESSION['msg']);?>
                <?php echo'</div>';?>
              <?php }?>
              
               <?php if(!empty($sucesso)){?>
               <?php echo'<div class="alert alert-success  close " role="alert">'
                        .$_SESSION['sucesso'];
                     unset($_SESSION['sucesso']);?>
                <?php echo'</div>';?>
                    
              <?php }?>
                     
                     
              </div>
          
          <div class="col-md-4"></div>
          </div>
      </div>


