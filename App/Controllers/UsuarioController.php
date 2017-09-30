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
                        $_SESSION["nome_usuario"]=$dadoLogin;
                        
                        
                    $this->redirect("Vazamento");
                        
                    }else{
                        echo "usuario nao encontrado!!!!.";
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
                
                $this->redirect("usuario/Cadastro");
            
            }else{//nao retornou nenhum email
                
                $usuarioD->usuarioInserir($usuario);
                $msg = "Usuário cadastrado com sucesso";
                $_SESSION["sucesso"] = $msg;
                $this->redirect("Usuario/cadastro");
            }
            

           
        }
    }
    