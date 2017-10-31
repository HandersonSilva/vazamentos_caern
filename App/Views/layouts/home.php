<?php
  use App\Controllers\UsuarioController;
  use App\Controllers\HomeController;
  // limite de itens
   $limit = 10;
   // contador
  $count = 0;
  $usuario = UsuarioController::getComentarios();
  $feeds = HomeController::geraFeed();?>
<script type="text/javascript" src="public/script_site.js"></script>
<!--inclui arquivo css customizado a pagina-->
<link rel="stylesheet" type="text/css" href="public/estilo_home.css"/>

<div class="row">
    <div class="page-header" id="page-header">
        <h5 id="text-home" >Aqui você poderá visualizar os vazamentos já cadastrados por todos os usuários</h5>
    </div>
    <div class="col-md-9  col-sm-12" style="margin-top: 10px;">
        
        <div id="map" style="border: 2px solid #000"></div>
    </div>
    <div class="col-md-3" style="margin-top: 10px;" id="div_coment">
        <a href="http://<?=APP_HOST;?>vazamento"><button type="button" class="btn btn-primary btn-md  col-sm-12" id="btn_tela_hUsuario">Cadastrar um vazamento</button></a>
        <br><br>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <button class="btn btn-success btn-md col-sm-12" id="btn_abrir_form" title="formularioCadastro" value="formulario de cadastro">Deixe um comentário</button>
                            <button class="btn btn-success btn-md col-sm-12" id="btn_fechar_form" title="formularioCadastro" value="formulario de cadastro">Minimizar</button>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                           
                        <form action="http://<?php echo APP_HOST; ?>usuario/cadcom" id="form_dados" method="post">
                                <div class="form-group">
                                    <input class="form-control" name="nome_com" id="nome_com" type="text" placeholder="*Seu nome">
                                </div>
                                <div class="form-group">
                                    <textarea name="comentario" class="col-sm-12" cols="80%"  rows="3" id="comentario" placeholder="Comentário"></textarea>
                                </div>

                            <input type="hidden" name="lat" id="lat" required>
                            <input type="hidden" name="long" id="long" required>
                            <!-- local aonde ficara os daddos passados pelo geocode-->
                            <input type="hidden" name="pais" id="pais" required>
                            <input type="hidden" name="uf" id="uf" required>
                            <input type="hidden" name="cidade" id="cidade" required>
                            <input type="hidden" name="rua" id="rua" required>
                            <input type="hidden" name="id_usuario_logado" id="id_usuario_logado" value="<?php echo $_SESSION['id_user'];?>" required >
                      
                      <button type="submit" class="btn btn-primary" id="btn_enviar_coment">Enviar</button>
                     
                    </form>
                            
                        </div>
                    </div>
                </div>
                 <div class="lista_com" style="width: 100%; height: 400px;">
                     
                     <ul class="list-group">
                        <?php if(!empty($usuario)){//se existir dados 
                    
                            echo '<strong><p style="font-family:Viga;">Comentários</p></strong>'?>
                        
                            <?php foreach ($usuario as $comentarios){//percorre o array $dados_vaz ?>
                                <li class="lista_com_person">
                                     <?php echo "<strong>Nome:</strong>".'<font class="text_com">'.$comentarios->nome.'</font>'."<br>".
                                     "<strong>comentario: </strong>".'<font class="text_com">'.$comentarios->comentario.'</font>'."<hr id='hr_com'>";?>

                                </li>
                            <?php }?>
                      <?php }?>
                     </ul>
                     
                </div>             
            </div>
    </div>
    
</div>
<div class="row">
    
    
    <div class="col-md-8">
        <h4>Últimas notícias do RN</h4>
        <?php if(!empty($feeds)){
     foreach ($feeds->channel->item as $item ){
         // formata e imprime uma string
        printf('<a href="%s" title="%s" target="new" style="color:#0000FF;">%s</a><br>', $item->link, $item->title, $item->title,$item->picture);
        // incrementamos a variável $count
        $count++;
        // caso nosso contador seja igual ao limite paramos a iteração
        if($count == $limit) break;
     }
    }else{
        echo 'Não foi possível carregar o feed ';
    }?>
    </div>
    
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

                        <?php if($ponto->lat_ponto !="" && $ponto->log_ponto !="") {
                            $data_sql = $ponto->data_vazamento;
                            $data_formatada = date("d/m/Y", strtotime($data_sql));
                            
                            ?>
                                var descricao ='<?=$ponto->descricao_vazamento?>';
                                var usuario = '<?=$ponto->nome_usuario?>';
                                var rua = '<?=$ponto->rua_ponto?>';
                                var cidade = '<?=$ponto->cidade_ponto?>';
                                var estado = '<?=$ponto->estado_ponto?>';
                                var data = '<?=$data_formatada?>';
                                var status ='<?=$ponto->status_vazamento?>';
                                //verificar o status
                                var icone = "";
                                if(status == 1){
                                        status = "Vazamento  em Aberto";
                                        icone = "_fontes/imgs/icon_vaz_caern2.png";
                                }else{
                                        status = "Vazamento Fechado";
                                        icone = "_fontes/imgs/vaz_cadastrado.png";
                                }
                                var html = '<div style="witch:300px;">'+
                                        '<h4>Cadastrado por: '+usuario+'</h4>'+'<br/>'+
                                        '<h7>Data: '+data+'</h7>'+'<br/>'+
                                        '<h7>Descrição: '+descricao+'</h7>'+'<br/>'+
                                        '<h7>Rua: '+rua+'<br/>'+" Cidade: "+cidade+'<br/>'+" UF "+estado+'</h7>'+'<br/>'+
                                        '<h6>Situação: '+status+'</h6>'+
                                        '</div>';
                                //setando o marcador 
                                var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(<?= $ponto->lat_ponto?>,<?= $ponto->log_ponto?>),
                                animation:google.maps.Animation.prototype,
                                icon:icone,
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