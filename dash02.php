<html lang="en">
        <head>
        <title>Dash 02</title>
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
            <style>
                   
            </style>
        </head>
        
        <body>
            <div class="mypanel"></div>
        
            <script>
            
            $.getJSON('http://dev2.irexnet.co.kr:8080/KISTI_Web/sensor/whole.do', function(data) {
            
                var lat = []; 
                var lng = [];
                var Co = [];  
                var Clr = [];
                var opc = [];
                for(var i = 0 ; i < data.length ; i++){
                    lat[i] = data[i].LAT;
                    lng[i] = data[i].LNG; 
                    Co[i] = parseFloat(data[i].CO)*50;  
                    if(Co[i] > 50){
                        Clr[i] = 'rgb(255, 65, 54)';
                    }
                    else if(Co[i] > 20 && Co[i] <= 50 ){ 
                        Clr[i] = 'rgb(44, 160, 101)';
                    }
                    else{
                        Clr[i] = 'rgb(93, 164, 214)';
                    }
                    opc[i] = .7;
                    console.log(Co[i]);
                }

                var trace1 = {
                x: lat,
                y: lng,
                mode: 'markers',
                marker: {
                   // color: ['rgb(93, 164, 214)', 'rgb(255, 144, 14)',  'rgb(44, 160, 101)', 'rgb(255, 65, 54)'],
                    //opacity: [1, 0.8, 0.6, 0.4],
                    opacity: opc,  
                    color: Clr,
                    size: Co
                }
                };

                var data = [trace1];

                var layout = {
                title: 'Marker Size and Color',
                showlegend: false,
                height: 600,
                width: 600
                };

                Plotly.newPlot('myDiv', data, layout);
           
 


         });
         function normalization(arr){
            var max = Math.max.apply(Math, arr);
            var min = Math.min.apply(Math, arr);
            var len = arr.length; 
            for(var i = 0 ; i < len ; i++){
                 arr[i] = (arr[i] - min)/(max - min);
            }
            return arr;
         } 
           
            
            </script>
            
            <div id="myDiv"><!-- Plotly chart will be drawn inside this DIV --></div>
            
    


        </body>
        </html>

     