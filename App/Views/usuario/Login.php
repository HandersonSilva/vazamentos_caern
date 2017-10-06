 <?php
        session_start();
        
        $usuario_logado = isset($_SESSION["nome_usuario"])?$_SESSION["nome_usuario"]:"";
        $msg = isset($_SESSION["msg_login"])?$_SESSION["msg_login"]:"";
 ?>

<div class="container" style="margin-top: 100px">
          <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <form id="form_user" action="http://<?php echo APP_HOST;?>usuario/validaLogin" method="post">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email_log" aria-describedby="emailHelp" placeholder="Digite seu email">

                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="senha_log" placeholder="Digite sua senha">
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Login</button>
                    <a href="http://<?php echo APP_HOST; ?>usuario/Cadastro" ><label>Não possui conta?</label></a>
 
               </form>
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


