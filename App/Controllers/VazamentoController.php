<?php
  namespace App\Controllers;
  use App\Models\LocalizacaoDAO;
  use App\Models\VazamentoDAO;
  use App\Models\Entidades\Usuario;
  use App\Models\Entidades\Localizacao;
  use App\Models\Entidades\Vazamento;
  use Exception;
  session_start();

   class VazamentoController extends Controller{
       
        public function index(){
       
           try{
            
                $data = $this->getVaz();
            
                $this->render("usuario/homeUsuario");
              
            
            
          }catch(PDOException $e){
            throw new Exception("Ops! Erro ao buscar dados no Banco",500);
          }
            
          
        }
        
        public static function getVaz() {
            $vazamentoD = new VazamentoDAO();
            $dados = $vazamentoD->vazamentoDados();
            
            if($dados != null){
                
                return $dados;
                      
            }
            
        }

        //pegando os dados via post e mandando para class vazamentoDAO para cadstrar no banco
        public function cadastrar(){    

               try{
                $localizacaoDAO = new LocalizacaoDAO();
                $vazamentoDAO= new VazamentoDAO();
                //setando as entidades necessarias
                $localizacao = new Localizacao();
                
                $log = $this->limita_caracteres($_POST['long'], 10, $quebra = true);
                $lat = $this->limita_caracteres($_POST['lat'], 9, $quebra = true);
                $rua=$_POST['rua'];
                $cidade=$_POST['cidade'];
                $estado=$_POST['uf'];
                $pais = $_POST['pais' ];


                $localizacao->setLat($lat);
                $localizacao->setLog($log);
                $localizacao->setRua($rua);
                $localizacao->setCidade($cidade);
                $localizacao->setEstado($estado);
    
                //Salvando o ponto no banco
                $localizacaoDAO->Inserir($localizacao);
            
                //retornando o id do ponto cadastrado
                $idLocalizacao = $localizacaoDAO->retornaID( $log, $lat);


                if($idLocalizacao > 0 ){
                    //setando vazamento
                    $vazamento = new Vazamento();
                    
                    $date = $_POST["data"];
                    $data_sql = date("y-d-m", strtotime($date));
                    
                    $id = $_POST["id_usuario_logado"];
                    $vazamento->setDescricao($_POST['descricaoV']);
                    $vazamento->setStatus(1);
                    $vazamento->setDate($data_sql);
                    $vazamento->setGravidade($_POST['intensidade']);
                    $vazamento->setTempo(0);
                    $vazamento->setFkPonto($idLocalizacao);
                    $vazamento->setFkUsuario($id);
                    //salvando objeto vazamento no banco
                    $row = $vazamentoDAO->Inserir($vazamento);
               }
                     if($row > 0){
                        $_SESSION["sucesso_vaz"] = "Vazamento cadastrado com sucesso";
                        
                        $this->redirect("vazamento");
                        
                     }

               }catch(PDOException $e){
                throw new Exception("Erro ao cadstrar o vazamento...",500);
               }
            
        }
        
     
        public function limita_caracteres($texto, $limite, $quebra = true){
            $tamanho = strlen($texto);
            if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
               $novo_texto = $texto;
            }else{ // Se o tamanho do texto for maior que o limite
               if($quebra == true){ // Verifica a opção de quebrar o texto
                  $novo_texto = trim(substr($texto, 0, $limite));
               }else{ // Se não, corta $texto na última palavra antes do limite
                  $ultimo_espaco = strrpos(substr($texto, 0, $limite)); // Localiza o útlimo espaço antes de $limite
                  $novo_texto = trim(substr($texto, 0, $ultimo_espaco)); // Corta o $texto até a posição localizada
               }
            }
            return $novo_texto; // Retorna o valor formatado
         }
         
         
       
     }

