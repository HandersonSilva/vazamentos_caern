   
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
             }

            google.maps.event.addDomListener(window,'load',init);
      </script>
       <!--Estilo da div mapa-->
       <style>
             #mapa{
                 width:1110px;
                 height:500px;
                 border:solid black;
                 }
        </style>
       

     <br/>
        <div class="container" style="margin-left: 5px">
            <div class="row">
                    <div class="col-md-2">
                        <a href="#">Cadastra nava reclamção</a>
                    </div>
                    <div class="col-md-10">
                            <div id="mapa">
                            </div>
                    </div>
            </div>
        </div>
        <br/>
        