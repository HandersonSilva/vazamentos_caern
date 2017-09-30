<?php 
    session_start();
    $cad_vaz = isset($_SESSION['sucesso_vaz'])?$_SESSION['sucesso_vaz']:"";
    
?>
<div class="row" style="margin-right: 80px; margin-left: 0px">
    <div class=" col-md-4 " >
        <form class="col-sm-12 form-inline">
  
            <div class="form-group mx-sm-3">
              <label for="inputEndereco" class="sr-only">Endereco</label>
              <input type="text" class="form-control" id="inputEndereco" placeholder="Digite um endereço ">
            </div>
            <button type="submit" id="btnBuscarMapa" class="btn btn-primary btn-sm">Buscar no mapa</button>
        </form>
    </div>
    <div class="col-md-8 col-sm-12 text-center" id="text_info" style="background-image: linear-gradient(to bottom, #90CAF9, #0D47A1);margin-right: 0px; 
    opacity: 5; color: #fff; border-radius: 10px;">
        <h4>Marque um ponto no mapa e cadastre os detalhes no formulário para que o vazamento possa ser resolvido o mais rápido possível</h4>
    </div>
    
        
</div>


<div class="row" >
              <div class="col-md-3" id="div_form">
                   <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><button class="btn btn-primary" id="cad_vaz">Cadastrar</button>
                                <span class="glyphicon glyphicon-file">
                                </span></a>
                            </h4>
                        </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                           
                           <form action="http://<?php echo APP_HOST; ?>vazamento/cadastrar" id="form_dados" method="post">
                      <div class="form-group">
                          <textarea name="descricaoV" cols="40"  rows="3" id="descricao" placeholder="descrição"></textarea>
                      </div>
                      
                      <div class="form-group">
                          <p>Data:</p>
                          <input type="date" class="form-control" name="data" id="data">
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
                      <!--stando dados do geocode-->
                      <input type="hidden" name="number" id="street_number" required>
                      <input type="hidden" name="rua" id="route" required>
                      <input type="hidden" name="cidade" id="administrative_area_level_2" required>
                      <input type="hidden" name="Estado" id="administrative_area_level_1" required>
                      <input type="hidden" name="pais" id="country" required>
                      
                      <button type="submit" class="btn btn-primary" id="btn_enviar_dados">Salvar</button>
                     
                  </form>
                            
                        </div>
                    </div>
                </div>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
                <p class="lista">Teste lista</p>
            </div>
               <br>
                <?php if(!empty($cad_vaz)){?>
                <?php echo'<div class="alert alert-success" role="alert">'
                    .$_SESSION['sucesso_vaz'];
                     unset($_SESSION['sucesso_vaz']);?>
                <?php echo'</div>';?>
                <?php }?>
              </div>    
          <div class="col-md-9 ">
              <div id="map" style="border: 2px solid #000"></div>
          </div>
                    
          </div>
           
<div class="row"><!--lista de vazamentos cadastrados-->
    <div class="col-md-3">
        
    </div>
</div>
          
          <br>
      
      
      <script>
        var map;
            var ponto = [];
            var dadosGeocode = {
                street_number:" ",
                route:" ",
                administrative_area_level_1:" ",
                administrative_area_level_2:" ",
                country:" "
                };

               // geocode();
                //função adicinar ponto ao clicar
                 function addPonto(pos,map,){
                   var lat = pos.lat();
                   var log=pos.lng();

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
                    geocode(lat,log);
                    
                   

                  //pegando os dados para informações
                    var descricao = document.getElementById("descricao").value;
                    var data = document.getElementById("data").value;
                    var radio = document.querySelector('input[name="intensidade"]:checked').value;
                    //setando o html
                    var html = '<div style="witch:300px;">'+
                                '<h5>Descrição: '+descricao+'</h5>'+
                                '<h5>Data: '+data+'</h5>'+
                                '<h3>Gravidade: '+radio+'</h3>'+
                                '</div>';
                    //criando o infowindow
                    var infoWindows = new google.maps.InfoWindow({
                        content:html
                    });
                      //Função informação no ponto
                    pontoMarker.addListener('click',function(){
                        infoWindows.open(map,pontoMarker);
                    })


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
                        addPonto(event.latLng, map, data);


                });
             }
              //testando o axio com o google geocode
              function geocode(lat,log){
                      
                        // Make a request for a user with a given ID
                        axios.get('https://maps.googleapis.com/maps/api/geocode/json?',{
                                params:{
                                        latlng :lat+","+log,
                                        key:'AIzaSyA5PrO7WK1FaI_o1eU26Igcp1-9zKC3eX4'
                                }
                                })
                                .then(function (response) {
                                        // console.log(response);
                                         //console.log(response.data.results[0].formatted_address);
                                        var addressComponents =response.data.results[0].address_components;
                                       
                                        for(var i = 0; i<addressComponents.length;i++){
                                            if(addressComponents[i].types[0] == 'street_number'){
                                                dadosGeocode.street_number=addressComponents[i].long_name;
                                                document.getElementById("street_number").value = dadosGeocode.street_number;
                                            }if (addressComponents[i].types[0] == 'route') {
                                                dadosGeocode.route =addressComponents[i].long_name;
                                                document.getElementById("route").value = dadosGeocode.route;
                                            }if (addressComponents[i].types[0] == 'administrative_area_level_1') {
                                                dadosGeocode.administrative_area_level_1 =addressComponents[i].long_name;
                                                document.getElementById("administrative_area_level_1").value = dadosGeocode.administrative_area_level_1;
                                            }if (addressComponents[i].types[0] == 'administrative_area_level_2') {
                                                dadosGeocode.administrative_area_level_2 =addressComponents[i].long_name;
                                                document.getElementById("administrative_area_level_2").value = dadosGeocode.administrative_area_level_2;
                                            }if (addressComponents[i].types[0] == 'country') {
                                                dadosGeocode.country =addressComponents[i].long_name;
                                                document.getElementById("country").value = dadosGeocode.country;
                                            }
                                        }
                                      
                                       
                                
                                }).catch(function (error) {
                                        console.log(error);
                                });

              }
           
             
             //Chamando a função inicial
            google.maps.event.addDomListener(window,'load',init);
           
                
                    $("#cad_vaz").click( function(){
                        
                        $(".lista").hide();
                        
                        
                        setTimeout(function() {
                        $(".lista").show();
                        }, 10000);
                    });
                    
                    
 

                
                
            
            
    </script>