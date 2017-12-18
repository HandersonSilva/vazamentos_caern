<?php 
    namespace App\Controllers;
    ob_start();
    session_start();
    ob_clean();
    use App\Models\usuarioDAO;
    use App\Models\Entidades\Usuario;
    use PHPMailer\PHPMailer\PHPMailer;
  
    class UsuarioController extends Controller
    {
        public function index(){
            $this->redirect("usuario/Cadastro");
        }
        public function Home(){
            $login_face = isset( $_SESSION['login_face'] ) ?  $_SESSION['login_face'] :"";
            if($login_face == 'connected'){
                $this->render("usuario/homeUsuario");
            }else{
                $this->redirect("usuario/login");
            }
           
        }

        public function Cadastro(){
            $this->render("usuario/Cadastro");
        }

        public function Login(){
            $this->render("usuario/Login");
        }
        public function redefinir() {
            $this->render("usuario/redefinirSenha");
        }
        
        public function newsenha() {
                $this->render("usuario/novaSenha");
            }
        public function facebook() {
           
                $login_face = isset($_POST['statusLogin']) ? $_POST['statusLogin']:"";
                $nameUserFace = isset($_POST['userName']) ? $_POST['userName']:"";
                $emailUserFace =isset($_POST['emailUser']) ? $_POST['emailUser']:"";
               
                if($login_face == 'connected'){
                    $_SESSION['login_face'] = $login_face;
                    $_SESSION["nome_usuario"]= $nameUserFace;
                    $_SESSION["email_usuario"]= $emailUserFace;
                    echo "Status da variavel session = ".$_SESSION['login_face']." | "."Login =  "."Usuario = ".$nameUserFace." | "."Email = ".$emailUserFace;
                   // $this->redirect("usuario/usuarioHome");
    
                   //Falta implementação da gravação dos dados do usuario com facebook
                   //...........................................
                }
                if($login_face =='not connected') {
                    unset($_SESSION['login_face']);
                
                   // $this->redirect("usuario/login");
                }
            
            
               
        }
        public function validaLogin(){
            
            $emailt = $_POST['email_log'];
            $senhat = $_POST['senha_log'];
            //echo $emailt."   ".$senhat;
            
             $usuario= new usuarioDAO();            
             
                if($emailt != NULL && $senhat != NULL){
                    $dadoLogin=$usuario ->validarusuario($emailt, $senhat);
                   // echo $dadoLogin;
                    if($dadoLogin != null){
                        $_SESSION["msg_login"] = "Dados validados";
                        $_SESSION['img_usuario'] = $dadoLogin->img_perfil;
                        $_SESSION["nome_usuario"]= $dadoLogin->nome_usuario;
                        $_SESSION["email_usuario"]= $dadoLogin->email_usuario;
                        $_SESSION['id_user'] = $dadoLogin->id_usuario;
                        
                        $this->redirect("usuario/login");
                        
                    }else{
                        $_SESSION["msg_erro_login"] = "Usuário não encontrado!!!";
                        $this->redirect("usuario/login");
                    }
            }
           
        }
        public function getHora($horaBanco) {
            date_default_timezone_set('America/Bahia');
            
            /*//$date = date('Y-m-d H:i');
            $hora_atual = date('H:i');
            $data_ant = date("2017-10-23");
            
            $dt = new \DateTime($data_atual);
            $da = new \DateTime($data_ant);
            
            $dias = $dt->diff($da);
            echo "Dias: {$dias->d}";*/
            $hora_atual = date("H:i");
            $dataForm = date("H:i:s", strtotime($horaBanco)); 
            $horaA = $dataForm;
             $horaB = $hora_atual;
            return $this->calculaTempo($horaA, $horaB);


            
        }
        //calcula o tempo de acordo com os paramentros passados e retorna a quantidade de minutos
        private function calculaTempo($hora_inicial, $hora_final) {
             $i = 1;
             $tempo_total;

             $tempos = array($hora_final, $hora_inicial);

             foreach($tempos as $tempo) {
              $segundos = 0;

              list($h, $m, $s) = explode(':', $tempo);

              $segundos += $h * 3600;
              $segundos += $m * 60;
              $segundos += $s;

              $tempo_total[$i] = $segundos;

              $i++;
           }
           $segundos = $tempo_total[1] - $tempo_total[2];

            $horas = floor($segundos / 3600);
            $segundos -= $horas * 3600;
            $minutos = str_pad((floor($segundos / 60)), 2, '0', STR_PAD_LEFT);
            $segundos -= $minutos * 60;
            $segundos = str_pad($segundos, 2, '0', STR_PAD_LEFT);

            return "$minutos";
        }
        
        public function Salvar(){
            $usuarioD = new usuarioDAO();
            $usuario = new Usuario();
            
            
            $usuario->setNome($_POST['nome_usuario']);
            $usuario->setEmail($_POST['email_usuario']);
            $usuario->setSenha($_POST['senha_usuario']);
            $upload = $this->getuploadImg();
            $usuario->setImg_perfil($upload);
           //verifica se a funcao verificaEmail() retornou algum email 
            $msg = null;
            if($usuarioD->verificaEmail($usuario->getEmail()) > 0){//retornou email
                $msg = "Email já cadastrado";
                $_SESSION["msg"] = $msg;
             
                $this->redirect("usuario/Cadastro");
            
            }else{//nao retornou nenhum email
                
                $usuarioD->usuarioInserir($usuario);
                $msg = "Usuário cadastrado com sucesso";
                $_SESSION["sucesso"] = $msg;
                $this->redirect("Usuario/cadastro");
                
            }
          
        }
        
        private function getuploadImg( ){
           
            $imagem = $_FILES['img_perfil']['name'];
            
            //pasta onde a imagem sera salva
            $_UP['pasta'] = "/opt/lampp/htdocs/vazamentos_caern/_fontes/imgs";
            
            //tamanho maximo do arquivo em bytes
            $_UP['tamanho'] = 1024*1024*100;
            
            //array com as extensoes permitidas
            $_UP['extensoes'] = array("png","jpg","jpeg","gif");
            
            //renomear
            $_UP['renomeia'] = false;
            
            //array de erros de uploads do php
            $_UP['erros'][0] = "Não houve erro";
            $_UP['erros'][1] = "O arquivo no upload é maior que o limite do php";
            $_UP['erros'][2] = "O arquivo ultrapassa o limite de tamanho especificado no HTML";
            $_UP['erros'][3] = "O upload do arquivo foi feito parcialmente";
            $_UP['erros'][4] = "Não foi feito upload do arquivo";
            
            if($_FILES['img_perfil']['erros'] != 0){
                die("Não foi possível fazer upload da imagem, erro<br>".$_UP['erros'][$_FILES['img_perfil']['error']]);
                exit();
            }
            
            //verifica a extensao do arquivo
            $extensao = strtolower(end(explode(".",$_FILES['img_perfil']['name'])));
            if(array_search($extensao, $_UP['extensoes']) === false){
               return null;

            }else{
                if($_UP['renomeia'] ==true){
                    $nome_final = time().".png";
                }else{
                    //mantem o nome original do arquivo
                    $nome_final = $_FILES['img_perfil']['name'];
                }
                //verificar se e possivel mover o arquivo para a pasta escolhida
                if(move_uploaded_file($_FILES['img_perfil']['tmp_name'], $_UP['pasta']."/".$nome_final)){
                    return $nome_final;
                }
            }
                    
            
        }
        
        public function logout() {
            
            unset($_SESSION["nome_usuario"]);
            unset($_SESSION["id_user"]);
            unset($_SESSION["email_usuario"]);
            unset($_SESSION['email_suceso']);
            
            $this->redirect("home");
            
        }
        
        public static function UrlAtual(){
                    $dominio= $_SERVER['HTTP_HOST'];
                    $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
                    return $url;
            }
            
        public function validaEmailRecup() {
                date_default_timezone_set('America/Bahia');
                $hora_atual = date('Y-m-d H:i');
                $usuarioDao = new usuarioDAO();
                
                $email = $_POST['email_recup'];
                $email_existe = $usuarioDao->comparaEmail($email);
                
                if(!empty($email_existe)){
                   $id_usuario = $email_existe->id_usuario;
                   $nome_usuario = $email_existe->nome_usuario;
                  
                   $token = uniqid();
                   $usuarioDao->salvarToken($token, $id_usuario,$hora_atual);
                   
                   //informacoes do email
                   $this->enviaLink($nome_usuario,$email,$token);
                    
                    
                }else{
                    echo 'Email nao cadastrado';
                }
                
            }
            
            private function enviaLink($nome,$para,$token) {
                $email_setup = "caernvazamentos@gmail.com";

                $mail = new PHPMailer();
                $mail->encodeHeader("utf8");
                // Configura para envio de e-mails usando SMTP
                $mail->isSMTP();
                // Servidor SMTP
                $mail->Host = 'smtp.gmail.com';
                // Usar autenticação SMTP
                $mail->SMTPAuth = true;
                // Usuário da conta
                $mail->Username = $email_setup;
                // Senha da conta
                $mail->Password = 'ca123ern';
                // Tipo de encriptação que será usado na conexão SMTP
                $mail->SMTPSecure = 'ssl';
                // Porta do servidor SMTP
                $mail->Port = 465;
                // Informa se vamos enviar mensagens usando HTML
                $mail->IsHTML(true);
                // Email do Remetente
                $mail->From = $email_setup;
                // Nome do Remetente
                $mail->FromName = 'Vazamentos-caern';
                // Endereço do e-mail do destinatário
                $mail->addAddress($para);
                // Assunto do e-mail
                $mail->Subject = 'Redefinição de senha!!!';
                // Mensagem que vai no corpo do e-mail
                
                $mail->Body = '<div style="background:url(../_fontes/imgs/fundo.jpg);color:black;padding:5px;"><h4>Olá '.$nome.'</h4><br>'.
                                'Clique no link, copie e cole o token gerado abaixo!!!<br><br>'.
                                '<a href=http://'.APP_HOST.'/usuario/newsenha>clique aqui para redefinir sua senha</a>'.
                                 '<br><br><p>Token: '.'<font style="color:#008aeb;">'.$token.'</font>'.'</p>'.'</div>';
                
                // Envia o e-mail e captura o sucesso ou erro
                if($mail->Send()):
                     $_SESSION["email_sucesso"] = "Enviamos um link para seu email";
                     $this->redirect("usuario/redefinir");
                else:
                    echo 'Erro ao enviar Email:' . $mail->ErrorInfo;
                endif;
                   
            }
            
            public function validaToken() {
                $usuarioDao = new usuarioDAO();
                
                //recupera a nova senha e token digitados no formulario de redefinição
                $nova_senha = $_POST["senha_nov"];
                $token = $_POST["token"];
                //recupera o tem
                //verifica se o token vindo pelo formulario existe no banco
                $verifica = $usuarioDao->verificaToken($token);
                $fk_usuario =  $verifica->fk_usuario;
                //hora que o token foi salvo no banco
                $hora_token = $verifica->tempo_token;
                //verifica se o token expirou
                 $tempo = $this->getHora($hora_token);
                if(!empty($verifica) && $tempo <= 2){//caso exista o token atualiza a senha
                    
                    $atualizar = $usuarioDao->atualizaSenhaUsuario($nova_senha, $fk_usuario);
                    if($atualizar > 0){
                        $_SESSION['senha_update'] = "Sucesso!!! senha atualizada";
                        $this->redirect("usuario/newsenha");
                    }else{
                        $_SESSION['error_senha_update'] = "Erro ao tentar atualizar senha!!!";
                        $this->redirect("usuario/newsenha");
                    }
                    
                }else{
                        $link = "http://".APP_HOST."usuario/redefinir";
                        $_SESSION['token_exp'] = "Esse token expirou, por favor repita o processo de redefinição "."<a href='$link'".">Clique aqui</a>";
                        $this->redirect("usuario/newsenha");
                        
                }
                
            }
            
    }
    