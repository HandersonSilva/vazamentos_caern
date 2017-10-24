   
           <script>
            var map;
            var ponto = [];

               // geocode();
                //função adicinar ponto ao clicar
                 function addPonto(pos,map){
                      
                    document.getElementById("lat").value = pos.lat();
                    document.getElementById("long").value = pos.lng();
                   
                    //criando o ponto ao clicar
                    var pontoMarker = new google.maps.Marker({
                            position:pos,
                            animation:google.maps.Animation.BOUNCE,
                            icon:'_fontes/imgs/icone.png'
                    });

                    //adicionando o ponto ao mapa
                    pontoMarker.setMap(map);
                    //adicionando o pontoMarker ao ponto
                    ponto.push(pontoMarker);

                 }    
                //remover pontos
            function removePonto(){
                for(var i = 0; i < ponto.length;i++){
                        ponto[i].setMap(null);
                }
            }

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

                //Pegando o clique no mapa
                google.maps.event.addDomListener(map,'click',function(event){
                        //remover todos os pontos
                        removePonto();
                        //adicionar um novo ponto ao mapa
                        addPonto(event.latLng, map);


                });
             }
              //testando o axio com o google geocode
              function geocode(){
                      

                        // Make a request for a user with a given ID
                        axios.get('https://maps.googleapis.com/maps/api/geocode/json?',{
                                params:{
                                        latlng :'-5.779011, -35.292898',
                                        key:'AIzaSyA5PrO7WK1FaI_o1eU26Igcp1-9zKC3eX4'
                                }
                                })
                                .then(function (response) {
                                        // console.log(response);
                                         console.log(response.data.results[0].formatted_address);
                                        var addressComponents =response.data.results[0].address_components;
                                       
                                        for(var i = 0; i<addressComponents.length;i++){
                                            console.log(addressComponents[i].types[0]);
                                            console.log(addressComponents[i].long_name);
                                        }
                                
                                }).catch(function (error) {
                                        console.log(error);
                                });

              }
           
              geocode();
             //Chamando a função inicial+++
           
      </script>

       <!--Estilo da div mapa-->
       <style>
             #mapa{
                 width:1010px;
                 height:480px;
                 border:solid black;
                 }
        </style>
       

     <br/>
        <div class="container" style="margin-left: 5px">
            <div class="row">
                    <div class="col-md-3">
                        <a href="#">Cadastra nova reclamção</a>
                        <form method="post" action="http://<?php echo APP_HOST; ?>vazamento/cadastrar">
                                Descricão:<input type="text" name="descricaoV" required>
                                <!--campos ocultos-->
                                <input type="hidden" name="lat" id="lat" required>
                                <input type="hidden" name="long" id="long" required>
                                <input type="submit" value="Cadastrar"/>
                        </form>
                    </div>
                    <div class="col-md-9" >
                            <div id="mapa">
                            </div>
                    </div>
            </div>
        </div>
        <br/>
        