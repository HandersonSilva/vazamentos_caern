<?php
 session_start();
 $senha_atulizada = isset($_SESSION['senha_update']) ? $_SESSION['senha_update'] : "";
 $token_exp = isset($_SESSION['token_exp']) ? $_SESSION['token_exp'] : "";
?>
<script src="../public/script_site.js"></script>
<link rel="stylesheet" type="text/css" href="public/estilo_home.css"/>
<div class="container" style="margin-top: 50px">
          <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6" id="col_login">
              <h3>Redefinir senha...</h3>
              <form id="form_user" action="http://<?php echo APP_HOST;?>usuario/validaToken" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nova senha*</label>
                        <input type="password" class="form-control" id="senha_nov" name="senha_nov" placeholder="Digite sua nova senha" value="">
                        <label id="erro_senha1"></label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Repetir senha*</label>
                        <input type="password" class="form-control" id="rep_senha_nov" name="rep_senha_nov" placeholder="Repita sua nova senha">
                        <label id="erro_senha2"></label>
                        <label id="erro_senhas"></label>
                    </div>
                  
                    <div class="form-group">
                            <label for="exampleInputPassword1">Token*</label>
                            <input type="text" class="form-control " id="token" name="token" placeholder="Cole aqui o código enviado por email">
                            <label id="erro_token"></label>
                    </div>
                     
                      
                   <div class="col-md-4 col-sm-12">
                          <button type="submit" id="btn_atualizar" class="btn btn-primary pull-right col-sm-12">Atualizar</button>
                   </div>   
               </form>
                <p id="msg" style="color: #d9534f"></p>
                <?php if(!empty($senha_atulizada)){
                        echo '<p class="text-success">'.$senha_atulizada.'</p>';
                        unset($_SESSION["senha_update"]);
                    }else{
                        echo '<p  class="text-danger"">'.$token_exp.'</p>';
                        unset($_SESSION["token_exp"]);
                    }
                ?>
              </div> 
          <div class="col-md-3"></div>
          </div>
      </div>





