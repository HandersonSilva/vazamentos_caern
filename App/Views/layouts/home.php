 
<div class="container">
    <div id="map" style="border: 2px solid #000"></div>
</div>
          
              
          
      
      <script>
            var map;
            var ponto = [];
           
                //função adicinar ponto ao clicar
                 function addPonto(pos,map){
                      
                    //document.getElementById("lat").value = pos.lat();
                    //document.getElementById("long").value = pos.lng();
                   
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

                  //pegando os dados para informações
                   /* var descricao = document.getElementById("descricao").value;
                    var data = document.getElementById("data").value;
                    var  radio1= document.getElementById("inlineRadio1").value;
                    //setando o html
                    var html = '<div style="witch:300px;">'+
                                '<h5>Descrição: '+descricao+'</h5>'+
                                '<h5>Data: '+data+'</h5>'+
                                '<h3>Gravidade: '+radio1+'</h3>'+
                                '</div>';
                    //criando o infowindow
                    var infoWindows = new google.maps.InfoWindow({
                        content:html
                    });
                      //Função informação no ponto
                    pontoMarker.addListener('click',function(){
                        infoWindows.open(map,pontoMarker);
                    })
                    */


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
                map = new google.maps.Map(document.getElementById("map"),param);

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
                //setando os pontos do banco ao mapa
                //pegando a variavel data/seatndos os pontos do banco  no mapa PHP com JavaScript 
                <?php foreach($data as $ponto){?>
                        <?php if($ponto->lat_ponto !="" && $ponto->log_ponto !="") {?>
                        //setando o marcador 
                        var Marker = new google.maps.Marker({
                            position: new google.maps.LatLng(<?= $ponto->lat_ponto?>,<?= $ponto->log_ponto?>),
                            animation:google.maps.Animation.prototype,
                            icon:'_fontes/imgs/icone.png'
                        
                    });
                    //adicionando ao mapa
                    Marker.setMap(map);
                <?php }else{$break;}?>

                <?php } ?>

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
                      

                      //pegando os dados da api geocode
                        axios.get('https://maps.googleapis.com/maps/api/geocode/json?',{
                                params:{
                                        latlng :'-5.779011, -35.292898',
                                        key:'AIzaSyA5PrO7WK1FaI_o1eU26Igcp1-9zKC3eX4'
                                }
                                })
                                .then(function (response) {
                                        // console.log(response);
                                         console.log(response.data.results[0].formatted_address);
                                         //pegando as variavel aonde esta os dados
                                        var addressComponents =response.data.results[0].address_components;
                                       //percorrendo a variavel
                                        for(var i = 0; i<addressComponents.length;i++){
                                            console.log(addressComponents[i].types[0]);
                                            console.log(addressComponents[i].long_name);
                                        }
                                
                                }).catch(function (error) {
                                        console.log(error);
                                });

              }
           //chamando afunção geocode 
              geocode();

             //Chamando a função inicial
            google.maps.event.addDomListener(window,'load',init);
    </script>