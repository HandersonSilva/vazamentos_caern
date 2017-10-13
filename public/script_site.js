$(document).ready( function(){
    
    //lista de comentarios
     $("#btn_fechar_form").hide();
     
     $("#btn_abrir_form").click( function(){
         $(this).hide();
         $(".lista_com").hide();
         $("#btn_fechar_form").show();
         
     });
     $("#btn_fechar_form").click( function(){
         $(".lista_com").show();
         $("#btn_abrir_form").show();
         $("#btn_fechar_form").hide();
     });
     
     //validando formulario cadastro de vazamento
     $("#btn_enviar_dados").click( function(){
         var campo_vazio = false;
         var quebra = "\n";
         if($("#lat").val() == "" && $("#long").val() == ""){
             swal("Siga os seguintes passos: ", "Marque o ponto do vazamento no mapa"+quebra, "error");
             campo_vazio = true;
         }
         if($("#id_usuario_logado").val() == ""){
             swal("Siga os seguintes passos: ", "Para cadastrar um vazamento é necessário está logado "+quebra, "error");
             campo_vazio = true;
         }
         if($("#descricaoV").val() == ""){
             swal("Siga os seguintes passos: ", "Preencha o campo descrição "+quebra, "error");
             campo_vazio = true;
         }
         if($("#data").val() == ""){
             swal("Siga os seguintes passos: ", "Precisamos que digite uma data "+quebra, "error");
             campo_vazio = true;
         }
         if(campo_vazio){ return false;}
         
         
     });
     
    
    //validacao formulario de login
        $('#btn_login').click( function(){
            var campo_vazio = false;
            //verifica se os campos foram preenchidos
            if($('#email_log').val() == ''){
                $('#email_log').css({'border-color': '#A94442'});
                
                campo_vazio = true;

            }else{
                $('#email_log').css({'border-color': '#00FA9A'});
       }
             
            if($('#senha_log').val() == ''){
               $('#senha_log').css({'border-color': '#A94442'});
               
                campo_vazio = true;

            }else{
                $('#senha_log').css({'border-color': '#00FA9A'});
                         
            }                   

            if(campo_vazio){
                $("#msg").html("Preencha todos os campos");
                return false; 
            }
            
	});

 
 
    $('#btn_cad').click( function(){
        var campo_vazio = false;
        //verifica se os campos foram preenchidos
        if($('#nome_cad').val() == ''){
        $('#nome_cad').css({'border-color': '#A94442'});
        campo_vazio = true;

        }else{
        $('#nome_cad').css({'border-color': '#00FA9A'});
                                            }

        if($('#email_cad').val() == ''){
           $('#email_cad').css({'border-color': '#A94442'});
            campo_vazio = true;

        }else{
            $('#email_cad').css({'border-color': '#00FA9A'});
                                            }
                                            
            if($('#senha_cad').val() == ''){
           $('#senha_cad').css({'border-color': '#A94442'});
            campo_vazio = true;

        }else{
            $('#campo_senha').css({'border-color': '#00FA9A'});
                                            }                                 

        if(campo_vazio) return false;

					

	});
        
        
        
        
        
    
});
