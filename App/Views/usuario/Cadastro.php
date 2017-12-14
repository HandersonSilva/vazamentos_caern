 <?php
session_start();
$msg = isset($_SESSION['msg'])? $_SESSION['msg'] : "";
$sucesso = isset($_SESSION['sucesso'])? $_SESSION['sucesso'] : "";
 
 ?>
<script src="../public/script_site.js"></script>
   <div class="container" style="margin-top: 100px">
          
          <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="page-header">
                <h2>Novo usuário</h2>          
              </div>
              <form action="http://<?php echo APP_HOST;?>usuario/Salvar" method="POST" enctype="multipart/form-data" id="form_user">
              <div class="form-group">
            <label for="exampleInputEmail1">Nome usuário*</label>
            <input type="text" class="form-control" id="nome_cad" name="nome_usuario" aria-describedby="nome_usuario" placeholder="usuário">
           
            </div>
              
            <div class="form-group">
            <label for="exampleInputEmail1">Email*</label>
            <input type="email" class="form-control" id="email_cad" name="email_usuario" aria-describedby="emailHelp" placeholder="Email">
           
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Senha*</label>
            <input type="password" class="form-control" id="senha_cad" name="senha_usuario" placeholder="Senha">
            </div>
                  
            <div class="form-group">
                <label for="img_perfil">Imagem de perfil</label>
               <input type="file" class="form-control" id="img_perfil" name="img_perfil" placeholder="Selecione imagem">
            </div>
  
              <button type="submit" id="btn_cad" class="btn btn-primary pull-right">Cadastrar</button>
  
 
</form>
              <br>
              <?php if(!empty($msg)){?>
               <?php echo'<div class="alert alert-danger" role="alert">'
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
          
          <div class="col-md-3"></div>
          </div>
      </div>


