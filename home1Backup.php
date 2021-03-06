  
      <!-- janela modal-->
     <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhe o vazamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>-->
              <!--  <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="descrição">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" >
                        </div>
                        <div class="form-check">
                            <p><strong>Intensidade do vazamento</strong></p>
                            <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="fraco" id="exampleRadios1" value="option1" checked>
                            Fraco
                            </label>
                            
                            <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="medio" id="exampleRadios1" value="option2" >
                            Médio
                            </label>
                            
                            <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="severo" id="exampleRadios1" value="option3" >
                            Severo
                            </label>
                        </div>
                    </form>
                    
                </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar janela</button>
            <button type="button" class="btn btn-primary">Salvar dados</button>
        </div>
    </div>
  </div>
</div>-->
      
      <div class="row">
              <div class="col-md-3" id="div_form">
                  <form action="http://<?php echo APP_HOST; ?>vazamento/cadastrar" id="form_dados" method="post">
                      <div class="form-group">
                          <textarea name="descricaoV" cols="30" rows="3" placeholder="descrição"></textarea>
                      </div>
                      
                      <div class="form-group">
                          <p>Data:</p>
                          <input type="date" class="form-control" name="data">
                      </div>
                       <div class="form-group">
                           <p>Selecione imagem do vazamento</p>
                           <input class="form-control" type="file" placeholder="Selecione imagem" size="20">
                           
                      </div>
                      
                       <div class="form-group">
                           <p>Intensidade do vazamento</p>
                          <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="intensidade" id="inlineRadio1" value="leve" checked="checked">Leve
                            </label>
                          </div>
                           
                           <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="intensidade" id="inlineRadio1" value="medio" >Médio
                            </label>
                          </div>
                           
                           <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="intensidade" id="inlineRadio1" value="Grave" >Grave
                            </label>
                          </div>
                      </div>
                      <input type="hidden" name="lat" id="lat" required>
                      <input type="hidden" name="long" id="long" required>
                      
                      <button type="submit" class="btn btn-primary" id="btn_enviar_dados">Salvar</button>
                     
                  </form>
              </div>    
          <div class="col-md-9 ">
              <div id="map" style="border: 2px solid #000"></div>
          </div>
                    
          </div>  
          <br>
      
      
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
             //Chamando a função inicial
            google.maps.event.addDomListener(window,'load',init);
    </script>
    