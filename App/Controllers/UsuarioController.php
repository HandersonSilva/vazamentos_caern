<?php
    namespace App\Controllers;
    use App\Models\usuarioDAO;
    use App\Models\Entidades\Usuario;
    session_start();

    class UsuarioController extends Controller
    {
        public function index(){
            $this->redirect("usuario/Cadastro");
        }

        public function Cadastro(){
            $this->render("usuario/Cadastro");
        }

        public function Login(){
            $this->render("usuario/Login");
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
                        $_SESSION["nome_usuario"]= $dadoLogin->nome_usuario;
                        $_SESSION['id_user'] = $dadoLogin->id_usuario;
                        
                        $this->redirect("usuario/login");
                        
                    }else{
                        $_SESSION["msg_erro_login"] = "Usuário não encontrado!!!";
                        $this->redirect("usuario/login");
                    }
            }
           
        }

        public function sucesso(){      
            $this->render("usuario/sucesso");
        }

        public function Salvar(){
            $usuarioD = new usuarioDAO();
            $usuario = new Usuario();

            $usuario->setNome($_POST['nome_usuario']);
            $usuario->setEmail($_POST['email_usuario']);
            $usuario->setSenha($_POST['senha_usuario']);

           //verifica se a funcao verificaEmail() retornou algum email 
            $msg = null;
            if($usuarioD->verificaEmail($usuario->getEmail()) > 0){//retornou email
                $msg = "Email já cadastrado";
                $_SESSION["msg"] = $msg;
                $this->contagemRegressiva();
                $this->redirect("usuario/Cadastro");
            
            }else{//nao retornou nenhum email
                
                $usuarioD->usuarioInserir($usuario);
                $msg = "Usuário cadastrado com sucesso";
                $_SESSION["sucesso"] = $msg;
                $this->redirect("Usuario/cadastro");
            }
          
        }
        
        public function logout() {
            
            unset($_SESSION["nome_usuario"]);
            unset($_SESSION["id_user"]);
            $this->redirect("vazamento");
            
        }
        
        public static function UrlAtual(){
            $dominio= $_SERVER['HTTP_HOST'];
            $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
            return $url;
            }
    }
    