
  
  //var loginFace = "";
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
            loginFace ='connected';
            /*window.onload = function(){
                document.getElementById('#btn_login_face').value = 'Continuar com o Facebook';
              }*/
              jQuery(function(){
                jQuery.ajax({
                    type:"POST",
                    url:"http://handersonsilva.com/vazamentos_caern/usuario/facebook",
                    data: {login:loginFace},
                    success:function(){
                        
                        //alert(data);
                            //redirecionar para outra pagina
                      //  window.location = "http://handersonsilva.com/vazamentos_caern/usuario/facebook";
                    }
               }); 
            });     
            
    }
     if (response.status === 'not_authorized' || response.status === 'unknown' ) {
             // The person is not logged into your app or we are unable to tell.
               //pegando o click do button
            window.onload = function(){
                jQuery(document).ready(function($){
                    $("#btn_login_face").click( function(){
                        loginFacebook();
                    });
                });
            }
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

};

//função login
function loginFacebook() {
    FB.login(function(response) {
        if (response.authResponse) {
            $(function(){
                $.ajax({
                type:"POST",
                url:"http://handersonsilva.com/vazamentos_caern/usuario/facebook",
                data: {login:loginFace},
                success:function(){
            
                   
                    
                },
                error: function (result) {
                    // Como requisitar $resposta e mostrar ela aqui
                }
            });      
        });
        }       
    });
 }
/* FB.Event.subscribe('auth.login', function () {
    loginFace = 'connected';
    $(function(){
            $.ajax({
            type:"POST",
            url:"http://handersonsilva.com/usuario/facebook",
            data: {login:loginFace},
            success:function(data){
        
               
                
            },
            error: function (result) {
                // Como requisitar $resposta e mostrar ela aqui
            }
        });      
    });
});*/
// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



 
