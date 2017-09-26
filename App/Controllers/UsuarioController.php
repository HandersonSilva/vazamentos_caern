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
            $usuarioD = new usuarioDAO();
            $login = isset($_POST['email_log']) ?$_POST['email_log'] :"";
            $senha = isset($_POST['email_log']) ?$_POST['senha_log'] :"";
            
            $validou = $usuarioD->retornaLogin($login, $senha);
            
            if(!empty($validou)){
                $_SESSION['email_usuario'] = $validou;
                echo $_SESSION['email_usuario'];
            }else{
                echo "Nenhum registro retornado";
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
    