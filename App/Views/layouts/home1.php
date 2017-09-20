      <br/>
      <button type="button" class="btn btn-primary" id="btn_cad_vaz" data-toggle="modal" data-target="#exampleModal" >
        Cadastrar vazamento
       </button>
        
      <!-- janela modal-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhe o vazamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
</div>
      
      <div style="width: 100%; height: 850px;margin-top: 50px">
          <div id="map"></div>
      </div>
         
      
      
      <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
          
        });
      }
      
      
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };
      
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }
        
        function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPE_0srgytD-jZEv6S5R0xKiEDzYmqSxg&callback=initMap"
    async defer></script>