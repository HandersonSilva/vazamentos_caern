
    window.onload = function(){
        jQuery(document).ready(function($){
            $("#btn_login_face").click( function(){
                loginFacebook();
            });
        });
    }
  var loginFace = "";
  var idUserFace = "";
  var nameUseFace = "";
  var emailUserFace = "";
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // Logged into your app and Facebook.
      
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
            loginFace ='connected';	
            FB.api('/me', {fields:'name,email'} , function(response) {
                // Response tem tudo que você solicitou, inclusive o access_token.
                console.log(response);
                console.log('Successful login for: ' + response.name+"|"+response.email);
                nameUseFace = response.name;
                emailUserFace = response.email;
    
                setDataOK();
            });
           
         
              
            
    }
     if (response.status === 'not_authorized' || response.status === 'unknown' ) {
             // The person is not logged into your app or we are unable to tell.
             console.log("not connected");
             loginFace ='not connected';
             $(function(){
                $.ajax({
                    type:"POST",
                    url:"http://handersonsilva.com/vazamentos_caern/usuario/facebook",
                    data: {
                        statusLogin:loginFace,
                    },
                    success:function(response){
                        alert("Faça login com o face"+response);
                        //alert(data);
                            //redirecionar para outra pagina
                           // window.location = "http://handersonsilva.com/vazamentos_caern/usuario/login";
                    }
               }); 
            }); 
             
          
        //resolvendo problema de carregamento da pagina
         /* window.onload = function(){
            document.getElementById('#btn_login_face').value = 'Entre com o facebook';
          }*/
        } else{

            //resolvendo problema de carregamento da pagina
           /* window.onload = function(){
                document.getElementById('#btn_login_face').value = 'Entre com o facebook';
              }*/
          
        }
   
    
    
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
FB.init({
    appId      : '387714388328615',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
});



// Now that we've initialized the JavaScript SDK, we call 
// FB.getLoginStatus().  This function gets the state of the
// person visiting this page and can return one of three states to
// the callback you provide.  They can be:
//
// 1. Logged into your app ('connected')
// 2. Logged into Facebook, but not your app ('not_authorized')
// 3. Not logged into Facebook and can't tell if they are logged into
//    your app or not.
//
// These three cases are handled in the callback function.

FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});

FB.Event.subscribe('auth.login', function () {
    loginFace = 'connected';
   /* $(function(){
            $.ajax({
            type:"POST",
            url:"http://handersonsilva.com/vazamentos_caern/usuario/facebook",
            data: {
                statusLogin:loginFace,
                nameUser:  nameUseFace,
                emailUser: emailUserFace
            },
            success:function(data){
        
                alert("Conectado com o face"+data);
                window.location = "http://handersonsilva.com/vazamentos_caern/usuario/Home";
            },
            error: function (result) {
                // Como requisitar $resposta e mostrar ela aqui
            }
        });      
    });*/
});

};

//função login
function loginFacebook() {
    if(loginFace!='connected'){
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me', {fields:'name,email'} , function(response) {
                    // Response tem tudo que você solicitou, inclusive o access_token.
                    console.log(response);
                    console.log('Successful login for: ' + response.name+"|"+response.email);
                    nameUseFace = response.name;
                    emailUserFace = response.email;
        
                    setData();
                });
                
            }       
        },{
            scope: 'public_profile,email', 
            return_scopes: true
        });
    }
    if(loginFace == 'connected'){
        window.location = "http://handersonsilva.com/vazamentos_caern/usuario/Home";
    }else{
        alert(loginFace);
    }
    
 }
 function setData(){
    $(function(){
        $.ajax({
        type:"POST",
        url:"http://handersonsilva.com/vazamentos_caern/usuario/facebook",
        data: {
            statusLogin:loginFace,
            userName:  nameUseFace,
            emailUser: emailUserFace
        },
        success:function(data){
    
           alert("login com face sucesso!!"+data);
           window.location = "http://handersonsilva.com/vazamentos_caern/usuario/Home";
            
        },
        error: function (result) {
            // Como requisitar $resposta e mostrar ela aqui
        }
        });      
    });
 }
 function setDataOK(){
    $(function(){
        $.ajax({
        type:"POST",
        url:"http://handersonsilva.com/vazamentos_caern/usuario/facebook",
        data: {
            statusLogin:loginFace,
            userName:  nameUseFace,
            emailUser: emailUserFace
        },
        success:function(data){
    
           alert("Você Já está Logado "+data);
           
            
        },
        error: function (result) {
            // Como requisitar $resposta e mostrar ela aqui
        }
        });      
    });
    window.onload = function(){
        console.log("Connectedd");   
        jQuery(document).ready(function($){
            $( "#btn_login_face" ).text( " Continuar com o Facebook " );
        });
     }
 }
 
// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



 
