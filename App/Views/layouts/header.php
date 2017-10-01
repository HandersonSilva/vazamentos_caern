<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?php echo TITLE; ?></title>

   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!--incluindo jquery a pagina-->
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
     <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <!-- Bootstrap CSS cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    
    <!--inclui arquivo css customizado a pagina-->
    <link rel="stylesheet" href="public/estilo_home.css">
    <script src="public/script_site.js"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPE_0srgytD-jZEv6S5R0xKiEDzYmqSxg"
    ></script>
    <!--framework axios-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <style>
    body{
      background-color: #80deea;
    }
    
    .form-control{
        background-color: #e8eaf6;
        align:center;
    }

    #linha_principal{

      margin-right: 80px; 
      margin-left: 0px;
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
    
    .footer {
    margin: 0px auto 0px auto;
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

         
}
    </style>
    
</head>
<body>