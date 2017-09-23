<?php

    namespace App\Models;
    use App\Models\BaseDAO;
    use App\Models\Entidades\Usuario;

    class usuarioDAO {
        private $conPdo;

        public function __construct(){
            $this->conPdo = BaseDAO::getConnection();
        }

        public function usuarioInserir(Usuario $usuario){      
        try{
           
           //realizar insercao
            $nome = $usuario->getName();
            $email =$usuario->getEmail();
            $senha=$usuario->getSenha();
            $ins = $this->conPdo->prepare("INSERT INTO caern_usuario(nome_usuario,email_usuario,senha_usuario) VALUES(:nome,:email,:senha)");
            $ins->bindParam(':nome',$nome);
            $ins->bindParam(':email',$email);
            $ins->bindParam(':senha',$senha);

            if($ins->execute()){
                return $ins->rowCount();
            }
            $ins = null;//fechar a conexao*/
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        }

        public function retornaEmail($email){
            
            try{
               $email = "'".$email."'";
                 // listando os dados via PDO
	        	// preparamos uma instrução SQL
	        	$query = $this->conPdo->prepare(
                    "SELECT u.nome_usuario FROM caern_usuario u WHERE u.email_usuario = $email"
                );
              
               
	        	// executa a instrução SQL
	        	if($query->execute()){
                    

                       	// se retornar mais de um dado, exibe
		            	if($query->rowCount() > 0){
                            
                            return $query->rowCount();
			         }
		        }
                 $query = null;

            }catch(PDOException $e){
                echo $e->getMessage();
            }

        }

      
    }