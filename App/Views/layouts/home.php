   
           <script>
            var map;
            var ponto;

            //funcao Map
             function init(){
                var param = {//setando os parametros do mapa
                        center:new google.maps.LatLng(-5.812838, -35.207891),
                        zoom:12,
                        mapTypeId:google.maps.MapTypeId.ROADMAP

                };
                //setando o mapa dentro da div mapa
                map = new google.maps.Map(document.getElementById("mapa"),param);

                //pegando a localização do usuario
                if(navigator.geolocation){
                        navigator.geolocation.getCurrentPosition(function(position){
                                localizacaoUser = new google.maps.LatLng(
                                        position.coords.latitude,
                                        position.coords.longitude
                                        );
                                //setando no mapa
                                map.setCenter(localizacaoUser);
                        })
                }
             }

             //Chamando a função inicial
            google.maps.event.addDomListener(window,'load',init);
      </script>
       <!--Estilo da div mapa-->
       <style>
             #mapa{
                 width:1040px;
                 height:500px;
                 border:solid black;
                 }
        </style>
       

     <br/>
        <div class="container" style="margin-left: 5px">
            <div class="row">
                    <div class="col-md-3">
                        <a href="#">Cadastra nova reclamção</a>
                        <form method="post" action="#">
                                Descricão:<input type="text" name="descricaoV" required>
                                <!--campos ocultos-->
                                <input type="hidden" name="latP" required>
                                <input type="hidden" name="logP" required>
                        </form>
                    </div>
                    <div class="col-md-9" >
                            <div id="mapa">
                            </div>
                    </div>
            </div>
        </div>
        <br/>
        