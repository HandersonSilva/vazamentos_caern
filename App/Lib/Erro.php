<?php
namespace App\Lib;

use Exception;

class Erro 
{
    private $mensagem;
    private $code;

    public function __construct($objetoException = Exception::class){
        $this->code =    $objetoException-> getCode();
        $this->mensagem = $objetoException-> getMessage();

    }

    public function render(){
        $varMessage = $this->mensagem;
       
        if(file_exists(PATH."/App/Views/erros/".$this->code.".php")){
            require_once PATH."/App/Views/erros/".$this->code.".php";
        }else{
            require_once PATH."/App/Views/erros/500.php";
        }
    }
    
}