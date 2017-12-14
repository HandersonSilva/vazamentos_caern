<?php
  session_start();
  $email_enviado = isset($_SESSION["email_sucesso"]) ? $_SESSION["email_sucesso"] : "";
?>
<script src="../public/script_site.js"></script>
<link rel="stylesheet" type="text/css" href="public/estilo_home.css"/>
<div class="container" style="margin-top: 50px">
          <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6" id="col_login">
              <p>Enviaremos um link de recuperação para o email cadastrado</p>
              <form id="form_user" action="http://<?php echo APP_HOST;?>usuario/validaEmailRecup" method="post">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email*</label>
                    <input type="email" class="form-control" id="email_log" name="email_recup" aria-describedby="emailHelp" placeholder="Digite email cadastrado" value="<?php echo $email_usuario_log?>">

                    </div>
                    <button type="submit" id="btn_enviar_email" class="btn btn-primary pull-right">Enviar</button>
                    
               </form>
              
              <p id="msg" class="text-success"><?php echo $email_enviado;              
                     unset($_SESSION["email_sucesso"]);?></p>
                
              </div>
          
          <div class="col-md-3"></div>
          </div>
      </div>





