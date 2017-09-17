<?php
    namespace App\Controllers;
    use App\Models\usuarioDAO;
    use App\Models\Entidades\Usuario;

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

        public function sucesso(){      
            $this->render("usuario/sucesso");
        }

        public function Salvar(){
            $usuario = new Usuario();
            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);

            $usuarioD = new usuarioDAO();
            $row = $usuarioD->usuarioInserir($usuario);

            if($row > 0){
             $this->redirect("usuario/sucesso");
            }else{
                $this->render("usuario/Cadastro");
            }

           
        }
    }
    