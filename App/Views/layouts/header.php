<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?php echo TITLE; ?></title>
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!--incluindo jquery a pagina-->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="      crossorigin="anonymous"></script>
     <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <!-- Bootstrap CSS cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- utilizando fontes do google fonts-->
    <link href='https://fonts.googleapis.com/css?family=Yantramanav' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Viga' rel='stylesheet'>
    <!--inclui arquivo css customizado a pagina-->
    <link rel="stylesheet" type="text/css" href="public/estilo_home.css"/>
    <script type="text/javascript" src="public/script_site.js"></script>
    
    
    
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPE_0srgytD-jZEv6S5R0xKiEDzYmqSxg"
    ></script>
    <!--framework axios-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="public/bootstrap-filestyle.min.js"> </script>

    <style>
       html body{
        background-color: #80deea;
      
      
    }
    #linha_login{
    margin-top: 8px;
 }
 
 .text_icon{
     padding-top: 5px;
 }
    #img_logo{
        width:120px;
        height: 50px;
    }
    
    /*navbar*/
    .bg-dark {
        background-color: #2962ff!important;
    }
    #col_login{
     margin-top: 40px;
 }
 
 .mdl-textfield {
    width: 400px;
    padding-top: 22px;
    padding-bottom:27px;
    margin-bottom: -10px;
    
 }
 
 .mdl-textfield__input{
     font-size: 15px;
 }
   
 .material-icons{
     font-size: 18px;
    
 } 
    
    .form-control{
        background-color: #f5f5f5;
        height: 40px;
        align:center;
    }
   
   .navbar-dark .navbar-nav .nav-link {
    color: #fff;
    }
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #80deea;
    }

    #linha_principal{
      margin-top: 50px;
      margin-right: 80px; 
      margin-left: 0px;
    }
    .lista{
        margin-top: 10px;
        padding: 5px;
        overflow-y: auto;
    }

    #col_end{
      padding-right: 15px;
    }
   
    #text_info{
      font-family: 'Andika';font-size: 22px;
      background-image: linear-gradient(to bottom, #90CAF9, #0D47A1);margin-right: 0px;
      opacity: 5; 
      color: #fff;
      margin: auto;
      border-radius: 10px;
      width: 100%;
    }
    #form_user{
        padding: 10px;
        border: 1px solid #78909c;
        border-radius: 10px;
        background-color: #eceff1;
    }
    .btn{
        border-radius: 80px 80px 80px 80px; 
    }
    
    
    .footer {
            margin-top: 20px; 
            bottom: 0px;
            padding: 0px 0 0 0;
            color: #fff;
            height: 50px;
            text-align: center;
            position: static;
            width: 100%;
            
}

        /* config botao flutuante*/
        .mdl-layout {
            align-items: center;
          justify-content: center;
        }
        .mdl-layout__content {
            padding: 24px;
            flex: none;
        }
        .mdl-button {
            margin-top: 10px;
          margin-bottom: 10px;
          margin-right: 10px;
        }
       
    </style>
    
</head>
<body>