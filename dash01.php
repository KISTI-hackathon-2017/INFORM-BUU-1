<html lang="en">
        <head>
        <title>Dash 01</title>
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
            <style>
                   
            </style>
        </head>
        
        <body>
            <div class="mypanel"></div>
        
            <script>
            
            $.getJSON('http://dev2.irexnet.co.kr:8080/KISTI_Web/sensor/whole.do', function(data) {
                myJson = data;
                var text = '';
                var date = [];
                for(var i = 0;i<data.length;i++){
                    date[i] =  data[i].TIME; 
                    //date[i] = date[i].substr(0,10);
                    text += `${data[i].node_id} : 
                             ${date[i]} <br>
                              *****************************<br>`
                    
                } 
                
                var swapped;
                do {
                swapped = false;
                for (var i=0; i < date.length-1; i++) {
                    if (date[i] > date[i+1]) {
                        var temp = data[i];
                        data[i] = data[i+1];
                        data[i+1] = temp;
                        var temp2 = date[i];
                        date[i] = date[i+1];
                        date[i+1] = temp2;

                        swapped = true;
                    }
                }
            } while (swapped);
            //console.log(date);
     
         var time = [], so2 = [], hum = [], pres = [];
         for(var i = 0;i < data.length ; i++){
            time[i] = data[i].TIME;
            so2[i] = data[i].SO2;
            hum[i] = data[i].HUM;
            pres[i] = data[i].PRES 
        
         } 
         so2 = normalization(so2);
         hum = normalization(hum);
         pres = normalization(pres); 
        


            //alert(time);
                var trace1 = {
                x: time, 
                y: hum, 
                type: 'scatter'
                };
                var trace2 = {
                x: time, 
                y: so2, 
                type: 'scatter'
                };
                var trace3 = {
                x: time, 
                y: pres, 
                type: 'scatter'
                };
                var data = [trace1, trace2,trace3];
                Plotly.newPlot('myDiv', data);
           
         //$(".mypanel").html(text2);


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

     