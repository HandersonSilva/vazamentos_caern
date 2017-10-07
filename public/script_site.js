$(document).ready( function(){
    
    
    
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

            if(campo_vazio) return false;

					

	});
        
        
    
});
