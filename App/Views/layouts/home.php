 
<div class="container">
    <div id="map" style="border: 2px solid #000"></div>
</div>
         
      <script>
            var map;


            //funcao Map
             function init(){
                var param = {//setando os parametros do mapa
                        center:new google.maps.LatLng(-5.812838, -35.207891),
                        zoom:12,
                        mapTypeId:google.maps.MapTypeId.ROADMAP

                };
                //setando o mapa dentro da div mapa
                map = new google.maps.Map(document.getElementById("map"),param);

              //codigo para trazer os dados do banco e setar no mapa
                <?php if($data == null){?>
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
                <?php }else{ ?>
                <?php foreach($data as $ponto){?>

                        <?php if($ponto->lat_ponto !="" && $ponto->log_ponto !="") {?>
                                var descricao ='<?=$ponto->descricao_vazamento?>';
                                var usuario = '<?=$ponto->nome_usuario?>';
                                var rua = '<?=$ponto->rua_ponto?>';
                                var cidade = '<?=$ponto->cidade_ponto?>';
                                var estado = '<?=$ponto->estado_ponto?>';
                                var data = '<?=$ponto->data_vazamento?>';
                                var status ='<?=$ponto->status_vazamento?>';
                                //verificar o status
                                if(status == 1){
                                        status = "Vazamento  em Aberto";
                                }else{
                                        status = "Vazamento Fechado";
                                }
                                var html = '<div style="witch:300px;">'+
                                        '<h4>Cadastrado por: '+usuario+'</h4>'+'<br/>'+
                                        '<h7>Data '+data+'</h7>'+'<br/>'+
                                        '<h7>Descrição: '+descricao+'</h7>'+'<br/>'+
                                        '<h7>Rua '+rua+'<br/>'+" Cidade "+cidade+'<br/>'+" UF "+estado+'</h7>'+'<br/>'+
                                        '<h6>Situação: '+status+'</h6>'+
                                        '</div>';
                                //setando o marcador 
                                var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(<?= $ponto->lat_ponto?>,<?= $ponto->log_ponto?>),
                                animation:google.maps.Animation.prototype,
                                icon:'_fontes/imgs/icon_vaz_caern2.png',
                                html: html
                           
                        
                    });
                   
                   
                    
                    //adicionando ao mapa
                    marker.setMap(map);

                     //criando o infowindow
                     var infoWindows = new google.maps.InfoWindow({
                        content:"Carregando...."
                    });
                      //Função informação no ponto
                    marker.addListener('click',function(){
                        infoWindows.setContent(this.html);//para mostrar a informação de cada ponto
                        infoWindows.open(map,this);
                    })
                <?php }else{$break;}?>

                <?php } ?>
                <?php } ?>
               


                //Pegando o clique no mapa
                google.maps.event.addDomListener(map,'click',function(event){
                        //remover todos os pontos
                        removePonto();
                        //adicionar um novo ponto ao mapa
                        addPonto(event.latLng, map);


                });
             }
             

             //Chamando a função inicial
            google.maps.event.addDomListener(window,'load',init);
    </script>