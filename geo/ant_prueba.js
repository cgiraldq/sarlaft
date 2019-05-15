        var APIKEY = "AIzaSyAFT-k5jlBw-evAo4rpYih6oxIoJFny4Fk";
        var position;
        var point;
        var map;
        var coordenadas;
        var infoWindowContent;
		var label;
        var bounds = new google.maps.LatLngBounds();
		

        function iniciar() {
		
            navigator.geolocation.getCurrentPosition(mostrarActual, errores);

           var boton = document.getElementById('btnPuntos');
            boton.addEventListener('click', mostrarPunto, false);
				
        }


        function mostrarPunto() {
            var searchService = new google.maps.places.PlacesService(map);
			

            var request = {
                location: position,
                rankby: 'distance',
                radius: 50000,
                keyword: 'Tigo'
            };
            searchService.nearbySearch(request, respuestaConsultaPuntos);
			document.getElementById("info").style.display = "none";
			document.getElementById("nav").style.display = "block";
        }


        function respuestaConsultaPuntos(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                point = results[0];
				console.log(point);
                salida = '';
                salida += 'Nombre: ' + point.name + ' (' + point.vicinity + ')<br/>';
                $('#div_ubicacion_punto').html(salida);

                var marker = new google.maps.Marker({
                            position: point.geometry.location,
                            map: map,
                            animation: google.maps.Animation.DROP,
                            //title: puntos[i][0],
                            icon: 'images/tigoune-maps.png'
                            //icon: point.photos[0].getUrl({'maxWidth': 35, 'maxHeight': 35})
                        });
                bounds.extend(point.geometry.location);
                map.fitBounds(bounds);
                map.panToBounds(bounds);
				var urlPhoto = point.photos[0].getUrl({'maxWidth': 200, 'maxHeight': 150});

               infoWindowContent ='<table>'+
			   '<tr><td><strong>Punto de Atención Tigoune</strong><br><br>'+point.name +'<br>'+point.vicinity+'</td>'+
			   '<td><img src="' + urlPhoto + '" alt="" /></td></tr>'+
			   '<tr><td><img src="images/online.png">Abierto 8am - 6pm</td><td><a href="javascript:info();">Saber más<span class="icono icon-rightside"></span></a></td></tr>'+
			   
			   '</table>';
			   
			   
				/*'<div id="info_content">' +
                    '  <div id="div_left"><strong>Punto de Atención Tigoune</strong>' +
                    '   <!--<a href="https://www.google.com/maps/dir/?api=1&destination=TigoUne+-+Sede+Los+Balsos&destination_place_id=' + point.place_id + '"><img src="images/car.png" width="65" height="65" alt="" /></a>-->' +
                    ' <br>' + point.name  + '<br/>' + point.vicinity +
					'  </div>' +
                    '  <div id="div_right">' +
					'<img src="' + urlPhoto + '" alt="" />'+
                    '  <a href="javascript:info();"><img src="images/info.png" width="65" height="65" alt="" /></a>' +
                    '  </div>' +
                    '<a href="javascript:regresar();">Regresar</a></div>';*/
					
					label='<div id="info_marker">' +
						'Punto de atención'+
                    '</div>';

                var infoWindow = new google.maps.InfoWindow();

                google.maps.event.addListener(marker, 'click', (function(marker) {
					/*d = document.getElementById("div_info");
					d.innerHTML=infoWindowContent;*/
                                return function() {
                                    infoWindow.setContent(label);
                                    infoWindow.open(map, marker);
									d = document.getElementById("div_info");
					d.innerHTML=infoWindowContent;
                                    }
                            })(marker));
            }
        }


        function mostrarActual(coord) {

            coordenadas = coord;
            salida = '';
            salida += 'Latitud: '   + coordenadas.coords.latitude  + '<br/>';
            salida += 'Longitud: '  + coordenadas.coords.longitude + '<br/>';
            salida += 'Precisión: ' + coordenadas.coords.accuracy  + '<br/>';
            $('#div_ubicacion_actual').html(salida);

            position = new google.maps.LatLng(coordenadas.coords.latitude, coordenadas.coords.longitude);

            var mapOptions = {
                zoom: 18,
                center: position,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles:
                    [
                      {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      }
                    ]
            }

            map = new google.maps.Map(div_mapa, mapOptions);

            // Agregar marcado en el punto actual
            var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        animation: google.maps.Animation.DROP,
                        title: 'Estás aquí',
                        //icon: 'images/tigoune-maps.png'
                    });
            bounds.extend(position);
        }


        function errores(error) {
            $('#div_ubicacion_actual').html('Error: ' + error.code + ' - ' + error.message);
        }


        function info() {
            var urlPhoto = point.photos[0].getUrl({'maxWidth': 600, 'maxHeight': 400});
			document.getElementById("puntos").style.display = "none";
			document.getElementById("detalle").style.display = "block";
				d = document.getElementById("img");
					d.innerHTML='<img src="'+urlPhoto+'"><div id="opciones">'+point.name+'<br>'+
					'<div id="cont_op"><table id="table_info"><tr><td><div class="opciones" id="chat"><span class="icono icon-chat-cyan"><span class="path1"></span><span class="path2"></span></span></div><br>Chat en linea</td>'+
					'<td><a href="https://www.google.com/maps/dir/?api=1&destination='+point.name+'&destination_place_id=' + point.place_id + '"><div class="opciones" id="llegar"><span class="icono icon-savetoschool-cyan"><span class="path1"></span><span class="path2"></span></span></div><br>¿Cómo llegar?</a></td>'+
					'<td><div class="opciones" id="turno"><span class="icono icon-id-cyan"><span class="path1"></span><span class="path2"></span></span></div><br>Pedir turno	</td></tr></table>	 </div>		 </div>'+
					'<table id="detalle_info">'+
					'<tr><td><span class="icono icon-coveragemap-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>'+point.vicinity+'<br>'+point.name+'</td></tr>'+
					'<tr><td><span class="icono icon-time-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>Horario de atención:<br>Lunes a Viernes<br>8:00 a.m a 6:00 p.m.<br>Sábados<br>8:00a.m a 1:00p.m.</td></tr>'+
					'<tr><td><span class="icono icon-store-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>¿Qué puedo hacer en este punto de pago?<br><ul><li>Compras</li><li>Pagos</li><li>Reclamaciones</li><li>Cambios de Chip</li><li>Cambios de planes</li><li>Activación de chip</li></ul></td></tr>'+
					'<tr><td><span class="icono icon-call-indigo"></span></td><td>(4) 5100000</td></tr>'+
					'<tr><td><span class="icono icon-hosting-indigo"><span class="path1"></span><span class="path2"></span></span></td><td>www.tigo.com.co</td></tr>'+
					'</table>';

            var html = '';
            html += '<table>';
            html += '<tr>';
            html += '<td>';
            html += '<strong>' + point.name  + '</strong><br/>' + point.vicinity;
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


        function regresar() {
           document.getElementById("puntos").style.display = "block";
			document.getElementById("detalle").style.display = "none";
        }

        window.addEventListener('load', iniciar, false);
		//window.addEventListener('load', mostrarPunto, false);
		
		
		<html>
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="css/iconos/style-icons.css">
      <link rel="stylesheet" type="text/css" href="./css/style.css" media="screen" />
      <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFT-k5jlBw-evAo4rpYih6oxIoJFny4Fk&libraries=places"></script>-->
	  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFT-k5jlBw-evAo4rpYih6oxIoJFny4Fk&libraries=places&callback=initMap" async defer></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="./js/script.js"></script>

   </head>
   <body>
      <!--<h1>Puntos de Recarga</h1>-->
      <table id="info" border="1">
         <tr>
            <td>
               <strong>Ubicación actual</strong><br/><br/>
               <div id="div_ubicacion_actual"><img src="images/loading.gif" width="50" height="50"/></div>
            </td>
            <td>
               <button id="btnPuntos">Mostrar punto más cercano</button><br/><br/>
               <div id="div_ubicacion_punto"></div>
            </td>
         </tr>
      </table>
      <div id="nav">
         <a href="javascript:regresar();"><img src="images/back.png" width="60" height="60"></a>
      </div>
      <div id="filtro">
         FILTRO <span class="icono icon-filters"><span class="path1"></span><span class="path2"></span></span>
      </div>
      <br/> <br/>
      <div id="puntos">
         <div id="div_mapa"></div>
         <br>
         <div id="panel_info">
            <br/> 
            Hola, Estos son los <b>Puntos de Atención</b> más cercanos.
            <br>
            <span class="icon-downside"></span>
            <br/> 
            <hr>
            <div id="div_info">
            </div>
         </div>
      </div>
	  
	  <div id="detalle">
         <div id="img"></div>
		 
         <br>
         <div id="detalle_info">
          
            
         </div>
      </div>
   </body>
</html>
