 // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;
	  var pos;

      function initMap() {
        map = new google.maps.Map(document.getElementById('div_mapa'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 16
        });
       // var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
             pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
     var marker_mp = new google.maps.Marker({
                            position: pos.geometry,
                            map: map,
                           
                            //title: puntos[i][0],
                            icon: 'images/me.png'
                            //icon: place.photos[0].getUrl({'maxWidth': 35, 'maxHeight': 35})
                        });
			
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pos,
		  rankby: 'distance',
          radius: 1500,
          keyword: 'une',
		  name: 'tigo'
        }, callback);
			
            marker_mp.setPosition(pos);
          // infoWindow.setPosition(pos);
		  // infoWindow.setContent('Estas aquí!');
            map.setCenter(pos);
			var infowindow = new google.maps.InfoWindow();
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
		  
	
			
		
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
	

      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
			//console.log(results[i]);
          }
        }
      }



      function createMarker(place) {
        var placeLoc = place.geometry.location;
       var marker = new google.maps.Marker({
                            position: place.geometry.location,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            //title: puntos[i][0],
                            icon: 'images/marker.png'
                            //icon: place.photos[0].getUrl({'maxWidth': 35, 'maxHeight': 35})
                        });

        google.maps.event.addListener(marker, 'click', function() {
		console.log(place);

if(place.photos==null){
var urlPhoto="images/Tigo-UNE.png";
}else{
var urlPhoto = place.photos[0].getUrl({'maxWidth': 300, 'maxHeight': 200});
}



          infowindow.setContent(place.name);
          infowindow.open(map, this);

		   infoWindowContent ='<table>'+
			   '<tr><td><strong>Punto de Atención Tigoune</strong><br><br>'+place.name +'<br>'+place.vicinity+'</td>'+
			   '<td><img src="' + urlPhoto + '" alt="" width="300" height="150"/></td></tr>'+
			   '<tr><td><img src="images/online.png" >Abierto 8am - 6pm</td><td><a id="link" href="#">Saber más<span class="icono icon-rightside"></span></a></td></tr>'+
			   
			   '</table>';

		
			   d = document.getElementById("div_info");
					d.innerHTML=infoWindowContent;

function info() {

if(place.photos==null){
var urlPhoto="images/Tigo-UNE.png";
}else{
var urlPhoto = place.photos[0].getUrl({'maxWidth': 300, 'maxHeight': 200});
}
			document.getElementById("puntos").style.display = "none";
			document.getElementById("detalle").style.display = "block";
				d = document.getElementById("img");
					d.innerHTML='<img src="'+urlPhoto+'"><div id="opciones">'+place.name+'<br>'+
					'<div id="cont_op"><table id="table_info"><tr><td><div class="opciones" id="chat"></div><br>Chat en linea</td>'+
					'<td><a href="https://www.google.com/maps/dir/?api=1&destination='+place.name+'&destination_place_id=' + place.place_id + '"><div class="opciones" id="llegar"></div><br>¿Cómo llegar?</a></td>'+
					'<td><div class="opciones" id="turno"></div><br>Pedir turno	</td></tr></table></div>'+
					'<table id="detalle_info">'+
					'<tr><td><span class="icono icon-coveragemap-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>'+place.vicinity+'<br>'+place.name+'</td></tr>'+
					'<tr><td><span class="icono icon-time-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>Horario de atención:<br>Lunes a Viernes<br>8:00 a.m a 6:00 p.m.<br>Sábados<br>8:00a.m a 1:00p.m.</td></tr>'+
					'<tr><td><span class="icono icon-store-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>¿Qué puedo hacer en este punto de pago?<br><ul><li>Compras</li><li>Pagos</li><li>Reclamaciones</li><li>Cambios de Chip</li><li>Cambios de planes</li><li>Activación de chip</li></ul></td></tr>'+
					'<tr><td><span class="icono icon-call-indigo"></span></td><td>(4) 5100000</td></tr>'+
					'<tr><td><span class="icono icon-hosting-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>www.tigo.com.co</td></tr>'+
					'</table>';

            var html = '';
            html += '<table>';
            html += '<tr>';
            html += '<td>';
            html += '<strong>' + place.name  + '</strong><br/>' + place.vicinity;
            html += '<hr/>Horario<hr/>';
            html += '</td>';
            html += '<td>';
            html += '<img src="' + urlPhoto + '" alt="" />';
            html += '</td>';
            html += '</tr>';
            html += '</table>';
            html += '<a href="javascript:regresar();">Regresar</a>';
            $('#info_content').html(html);
            $('#info_content').css('height', '280px');
        }

    $('#link').click(function(){
info();
});

    $('#nav').click(function(){
regresar();
});



        });


	
      }




		        function regresar() {
           document.getElementById("puntos").style.display = "block";
			document.getElementById("detalle").style.display = "none";
        }
	  
	

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }


$('#filtro').click(function() {
  alert( "First handler for .toggle() called." );
});

	  }
	  