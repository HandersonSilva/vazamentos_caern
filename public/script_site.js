$(document).ready( function(){
           
            var url_atual = window.location.href;
            //verifica se ja esta logado
                $("#menu_logar").click( function(){
                    var log = document.getElementById("login_ver").value;
                    
                    if(log != ""){
                        
                        alert("Você já está logado\n Por favor faça logout para poder realizar o login");
                        document.getElementById("menu_logar").href = "";
                        document.location.href= url_atual;
                        
                    }

                });
               
    
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
         var texto_erro = "OPS!!! --- verifique: ";
         var msg_erro = "";
         var quebra = "\n";
         if($("#lat").val() == "" && $("#long").val() == ""){
             msg_erro += "-->Marque o ponto do vazamento no mapa";
             swal(texto_erro, msg_erro+quebra, "error");
             campo_vazio = true;
         }
         if($("#id_usuario_logado").val() == ""){
             msg_erro += "-->Para cadastrar um vazamento é necessário está logado ";
             swal(texto_erro, msg_erro+quebra, "error");
             campo_vazio = true;
         }
         if($("#descricaoV").val() == ""){
             msg_erro += "-->Preencha o campo descrição";
             swal(texto_erro, msg_erro+quebra, "error");
             campo_vazio = true;
         }
         if($("#data").val() == ""){
             msg_erro += "-->Precisamos que digite uma data ";
             swal(texto_erro, msg_erro+quebra, "error");
             campo_vazio = true;
         }
         if(campo_vazio){
             return false;
         }
             
         
         
         
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
        //confirma logout
        $("#logout").click( function(){
            //recupera o valor do campo val_logout
            var logout = $("#val_logout").val();
            swal({
                title: "Sair do sistema?",
                text: "Clique em ok para confirmar ou cancelar para abortar operação",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                   
                  document.location.href= logout;
                  
                } 
              });
        });
        
        //validando formulario para redefinicao de senha
        $("#btn_atualizar").click(  function(retorno){
           var nova_senha = $("#senha_nov").val();
           var nova_senha2 = $("#rep_senha_nov").val();
           var token = $("#token").val();
           var campo_vazio = false;
           if(nova_senha == ""){
               $("#erro_senha1").html("Erro: digite uma nova senha");
               $("#erro_senha1").css({"color" : "red"});
               campo_vazio = true;
               
               
           }
           if(nova_senha == "" &&  nova_senha2 == ""){
               $("#erro_senha1").html("Erro: digite uma nova senha");
               $("#erro_senha2").html("Erro: campo obrigatório");
               $("#erro_senha2").css({"color" : "red"});
               
               campo_vazio = true;
              
           }
           if(nova_senha != "" && nova_senha2 == ""){
               $("#erro_senha2").html("Erro:repita a senha acima");
               $("#erro_senha2").css({"color" : "red"});
               campo_vazio = true;
           }
         
           
            if(token == ""){
               $("#erro_token").html("Erro:forneça o token");
               $("#erro_token").css({"color" : "red"});
               campo_vazio = true;
           } 
               
            if( (nova_senha != "" && nova_senha2 != "") &&  nova_senha != nova_senha2){
               $("#erro_senha1").html("");
               $("#erro_senha2").html("");
               $("#erro_senhas").html("Erro: as senhas não correspondem");
               $("#erro_senhas").css({"color" : "red"});
               
               campo_vazio = true;
           }
           
           
           if(campo_vazio){ return false};
        });
        
     if(retorno == false){setTimeout(document.load(),3000);}
});
