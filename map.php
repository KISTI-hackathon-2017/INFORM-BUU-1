<html lang="en">
        <head>
        <title>MAP Visualization</title>
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <style>
                    /* Always set the map height explicitly to define the size of the div
                     * element that contains the map. */
                    #map {
                      height: 100%;
                    }
                    /* Optional: Makes the sample page fill the window. */
                    html, body {
                      height: 100%;
                      margin: 0;
                      padding: 0;
                    }
                  </style>
        </head>
        
        <body>
            <div class="mypanel"></div>
        
            <script>
                 LAT = []; 
                 LNG = [];
                 var temp = [];
                 var myJson;
                 $.getJSON('http://dev2.irexnet.co.kr:8080/KISTI_Web/sensor/whole.do',initMap);

               /* function myfunc(data){
                  console.log(data);
                  myJson = data;
                }*/ 
               // console.log(myJson);

               
          /*  $.getJSON('http://dev2.irexnet.co.kr:8080/KISTI_Web/sensor/whole.do', function(data) {
                myJson = data;
                var text = '';
                 
                for(var i = 0;i<data.length;i++){
                    LAT[i] = data[i].LAT; 
                    LNG[i] = data[i].LNG; 
                    text += `LAT:${LAT[i]} <br>
                             LNG:${LNG[i]} <br>
                              *****************************<br>`
                    temp.push(LAT[i]);
                } 
                
                $(".mypanel").html(text);
            });*/
           

              function initMap(data) {
                /*var lat = document.getElementById('lat[]').value;
                 alert(lat.length);*/
            
                var myLatLng = {lat: 35.88574, lng: 128.555501};

                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 12,
                  center: myLatLng
                });
              
               // var mark = {lat: parseFloat(35.88574), lng: parseFloat(128.555501)};
               for(var i = 0 ; i < data.length ; i ++){  
                  var color = '';
                  console.log(parseFloat(data[i].CO));
                  if(parseFloat(data[i].CO) > 0.2 ){
                    color = 'red';
                  }else{
                    color = 'green';
                  }   
                  var marker = new google.maps.Marker({
                    position: {lat: parseFloat(data[i].LAT), lng: parseFloat(data[i].LNG)},
                    map: map,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: color,
                        fillOpacity: .6,
                        scale: 20,
                        strokeColor: 'white',
                        strokeWeight: 1.5
                    }
                   
                  });
                }
              }
            
            </script>
            
            <div id="map"></div>
            <script>

    </script>

           
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0i9tqYaxq6jsVTXBTn1eT8FJ6ubkg_Cw&callback=initMap">
    </script>



        </body>
        </html>

        <!-- 
            AIzaSyB0i9tqYaxq6jsVTXBTn1eT8FJ6ubkg_Cw  
          --> 