<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?php echo TITLE; ?></title>

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
   

    <style>
       html body{
      background-color: #80deea;
      margin: opx;
      
    }
    #img_logo{
        width:120px;
        height: 47px;
    }
    
    .cad_vaz{
        margin-left: 25px;
    }
    
    /*navbar*/
    .bg-dark {
        background-color: #2962ff!important;
    }
    #col_login{
     margin-top: 40px;
 }
    
    
    .form-control{
        background-color: #f5f5f5;
        height: 40px;
        align:center;
    }
    
    .lista_com{
        margin-top: 10px;
        padding: 5px;
        overflow-y: auto;
    }
    .lista_com_person{
       
        padding: 0px;
        background-color: transparent;
        border: 0px;
    }
    
    

#hr_com{
    border: 1px solid ;
}

   .navbar-dark .navbar-nav .nav-link {
    color: #fff;
}
.navbar-dark .navbar-nav .nav-link:hover {
    color: #80deea;
}

    #linha_principal{
      margin-top: 100px;
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
        border-radius: 5px;
        background-color: #eceff1;
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

      @media screen and (max-width: 767px){
    
        #linha_principal{

            margin-right: 10px;
        }
        

        #text_info{
     
            margin-left: 5px;
        }
      
        #div_form{
            padding: 5px;
            border: 0.5px solid ;
            border-color: #64b5f6;
        }
        .row{
            margin: 5px 5px 0px 5px;
            margin-bottom: 30px;
            width: 100%
        }
        #map {
            margin-top: auto;
            width: 95%;
            height: 500px;
        }
 
        .cad_vaz{
            margin-left: 0px;
        }
        
        #page-header{
            margin: auto;
        }
        .col-sm-12{
            margin: 1px;
        }
        div.col-md-9{
            padding-left: 3px;
            padding-right: 3px;
        }
        
        .lista{
            padding: 0px;
    }
             
}
    </style>
    
</head>
<body>