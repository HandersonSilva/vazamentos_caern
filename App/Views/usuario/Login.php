<?php
        session_start(); 
        $email_usuario_log = isset($_SESSION["email_usuario"])?$_SESSION["email_usuario"]:"";
        $usuario_logado = isset($_SESSION["nome_usuario"])?$_SESSION["nome_usuario"]:"";
        $msg = isset($_SESSION["msg_login"])?$_SESSION["msg_login"]:"";
 ?>
<script src="../public/script_site.js"></script>

<script src="../public/login_face.js"></script>
<link rel="stylesheet" type="text/css" href="public/estilo_home.css"/>
<div class="container" style="margin-top: 50px">
          <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6" id="col_login">
              <h3>Login do usuário</h3>
              <form id="form_user" action="http://<?php echo APP_HOST;?>usuario/validaLogin" method="post">
                <button type="button" style="  width: 100%; height: 50%;" id="btn_login_face" class="btn btn-primary" >Entre com o facebook</button>
                   
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email*</label>
                    <input type="email" class="form-control" id="email_log" name="email_log" aria-describedby="emailHelp" placeholder="Digite seu email" value="<?php echo $email_usuario_log?>">

                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Senha*</label>
                    <input type="password" class="form-control" id="senha_log" name="senha_log" placeholder="Digite sua senha">
                    </div>

                    <button type="submit" id="btn_login" class="btn btn-primary pull-right">Login</button>
                    <div class="row">
                        <div class="col-md-6"><a href="http://<?php echo APP_HOST; ?>usuario/Cadastro" ><label>Não possui conta?</label></a></div>
                        <div class=" col-md-6 text-right">
                            <a href="http://<?=APP_HOST;?>usuario/redefinir" ><label>Esqueci minha senha</label></a>
                    </div>
               </div> 
               </form>
              
              <p id="msg" style="color: #d9534f"></p>
                <?php if(!empty($usuario_logado)){?>
                  <?php echo '<p id="cronometro" >'.'</p>'?>
                  
                <?php }else{
                    echo $_SESSION["msg_erro_login"];
                    unset($_SESSION["msg_erro_login"]);
                }?>
              </div>
          
          <div class="col-md-3"></div>
          </div>
      </div>
<script>
  var contador = 5;
        function contar() {
            
            document.getElementById('cronometro').innerHTML = "Você será redirecionado em: "+contador;
            contador--;
        }
        function redirecionar() {
            contar();
            if (contador == 0) {
                
                document.location.href = 'http://<?php echo APP_HOST;?>vazamento';
            }
        }
        setInterval(redirecionar, 1000);


        
</script>


