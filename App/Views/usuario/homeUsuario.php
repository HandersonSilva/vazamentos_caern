<?php
    use App\Controllers\VazamentoController;
    
    session_start();
    $cad_vaz = isset($_SESSION['sucesso_vaz'])?$_SESSION['sucesso_vaz']:"";
    
    //atribui a variavel no array $dados_vaz os dados de todos os vazamentos
    $dados_vaz =  VazamentoController::getVaz();   
?>
<div class="row" id="linha_principal">
   <div class="col-lg-3">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Digite um endereço">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button">Buscar</button>
      </span>
    </div><!-- /input-group -->
  </div>
    <div class="col-md-1"></div>
    <div class="col-md-8  text-center" id="text_info">
        <h4>Marque um ponto no mapa e cadastre os detalhes no formulário para que o vazamento possa ser resolvido o mais rápido possível</h4>
    </div>
    <div class="col-md-1"></div>
        
</div>


<div class="row">
              <div class="col-md-3" id="div_form">
                   <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <button class="btn btn-primary btn-md cad_vaz" id="cad_vaz" title="formularioCadastro" value="formulario de cadastro">Formulário de cadastro</button>
                                    <button class="btn btn-warning btn-md cad_vaz" id="fech_form" title="formularioCadastro" value="formulario de cadastro">Fechar formulário</button>
                                    <span class="glyphicon glyphicon-file">
                                </span></a>
                            </h4>
                        </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                           
                           <form action="http://<?php echo APP_HOST; ?>vazamento/cadastrar" id="form_dados" method="post">
                      <div class="form-group">
                          <textarea name="descricaoV" class="col-sm-12" cols="40%"  rows="3" id="descricao" placeholder="descrição"></textarea>
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
                      <!-- local aonde ficara os daddos passados pelo geocode-->
                      <input type="hidden" name="pais" id="pais" required>
                      <input type="hidden" name="uf" id="uf" required>
                      <input type="hidden" name="cidade" id="cidade" required>
                      <input type="hidden" name="rua" id="rua" required>
                      <input type="hidden" name="id_usuario_logado" id="id_usuario_logado" value="<?php echo $_SESSION['id_user'];?>" required >
                      
                      <button type="submit" class="btn btn-primary" id="btn_enviar_dados">Salvar</button>
                     
                  </form>
                            
                        </div>
                    </div>
                </div>
                 <div class="lista" style="width: auto; height: 400px;">
                    <ul class="list-group " >     
                <?php if(!empty($dados_vaz)){//se existir dados 
                    
                            echo '<strong><p>Histórico de vazamentos cadastrados</p></strong>'?>
                        
                    <?php foreach ($dados_vaz as $data){//percorre o array $dados_vaz 
                        $status = $data->status_vazamento;
                        //converte a data do sql para o format
                        $data_sql = $data->data_vazamento;
                        $data_campo = date("d/m/Y", strtotime($data_sql));
                         if($status == 1){
                            $status = " reclamação em aberto";
                         }else  if($status == 0){
                              $status = " reclamação fechada";
                         }
                        ?>
                        <li class="list-group-item"><?php echo '<strong>Postado por: </strong>'.'<font class="text-success">'.$data->nome_usuario.'</font>'.'<br>'.
                                    '<strong>Descrição: </strong>'.'<font class="text-success">'.$data->descricao_vazamento.'</font>'.'<br>'.
                                    '<strong>Data: </strong>'.'<font class="text-success">'.$data_campo.'</font>'.'<br>'.
                                    '<strong>Status :</strong> '.'<font class="text-success">'.$status.'</font>'?>
                                
                        </li>
               
                             
                    <?php }?>
                <?php }?>
                    </ul>
                </div>             
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
              <div id="map" style="border: 1px solid #000"></div>
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
                route:" ",
                administrative_area_level_2:"",
                administrative_area_level_1:" ",
                country:" "
                };

               // geocode();
                //função adicinar ponto ao clicar
                 function addPonto(pos,map,data){
                   
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
                    geocode(pos.lat(),pos.lng());
                   

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
                      console.log(lat);

                        // Make a request for a user with a given ID
                        axios.get('https://maps.googleapis.com/maps/api/geocode/json?',{
                                params:{
                                        latlng :lat+','+log,
                                        key:'AIzaSyA5PrO7WK1FaI_o1eU26Igcp1-9zKC3eX4'
                                }
                                })
                                .then(function (response) {
                                        // console.log(response);
                                         //console.log(response.data.results[0].formatted_address);
                                        var addressComponents =response.data.results[0].address_components;
                                       
                                        for(var i = 0; i<addressComponents.length;i++){
                                            if (addressComponents[i].types[0] == 'route') {
                                                dadosGeocode.route =addressComponents[i].long_name;
                                                document.getElementById("rua").value = dadosGeocode.route;
                                            }if (addressComponents[i].types[0] == 'administrative_area_level_2') {
                                                dadosGeocode.administrative_area_level_2 =addressComponents[i].long_name;
                                                document.getElementById("cidade").value =dadosGeocode.administrative_area_level_2;
                                            }if (addressComponents[i].types[0] == 'administrative_area_level_1') {
                                                dadosGeocode.administrative_area_level_1 =addressComponents[i].long_name;
                                                document.getElementById("uf").value =dadosGeocode.administrative_area_level_1;
                                            }if (addressComponents[i].types[0] == 'country') {
                                                dadosGeocode.country =addressComponents[i].long_name;
                                                document.getElementById("pais").value= dadosGeocode.country;
                                            }
                                        }
                                        console.log(dadosGeocode);
                                       
                                
                                }).catch(function (error) {
                                        console.log(error);
                                });

              }
           
             
             //Chamando a função inicial
            google.maps.event.addDomListener(window,'load',init);


            var segundos = 10;
            
             
                    $("#fech_form").hide();
                
                
                    $("button#cad_vaz").click( function(){
                        
                        $("button#cad_vaz").hide();
                        $("button#fech_form").show();
                        $(".lista").hide();
               
                        //setTimeout(function() {
                        //$(".lista").show();
                       // }, segundos * 1000);
                    });
                    
                    $("button#fech_form").click( function(){
                        
                        $("button#fech_form").hide();
                         $("button#cad_vaz").show();
                        $(".lista").show();
               
                        //setTimeout(function() {
                        //$(".lista").show();
                       // }, segundos * 1000);
                    });
                    
                    $("#btn_enviar_dados").click( function(){
                       
                        $(".lista").show();
                        
                        
                    });
                    
                    
                    
                    
</script>
