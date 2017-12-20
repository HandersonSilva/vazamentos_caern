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
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="email" id="email_log" name="email_recup">
                        <label class="mdl-textfield__label" for="nome_cad">Digite o email cadastrado</label>
                    </div>
                    <button type="submit" id="btn_enviar_email" class="btn btn-primary pull-right">Enviar</button>
                    
                </form>
              
                <p id="msg" class="text-success">
                           <?php if(!empty($email_enviado)){?>
                             <?php echo '<div class="alert alert-info" role="alert">
                            <i class="material-icons text_icon">check_circle</i>
                            <span class="sr-only">Error:</span>'.$email_enviado.'
                            </div>';              
                            unset($_SESSION["email_sucesso"]);?>
                           <?php } ?>
              </p>
                          
              </div>
          
          <div class="col-md-3"></div>
          </div>
      </div>





