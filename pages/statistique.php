
    <?php

$data1 = '';

//database query to get data from the table
$select = getPdo()->prepare('SELECT  
                            MONTH( inserted_date ) AS MOIS, 
                            COUNT( UUID_commentaire ) AS NOMBRE_COMMENTAIRE
                            FROM statistics_commentaire
                            GROUP BY MOIS');
//execute query
$select->execute();

while ($row = $select->fetch()) {
    $data1 = $data1 . '"'. $row['NOMBRE_COMMENTAIRE'].'",';
}

$data1 = trim($data1,",");

?>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
 
      <div class="container">	
      <h1>Commentaires par mois</h1>       
              <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

              <script>
                    var ctx = document.getElementById("chart").getContext('2d');
                  var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['JAN', 'FÉV', 'MAR', 'AVR', 'MAI', 'JUN', 'JUL', 'AOÛ', 'SEP', 'OCT', 'NOV', 'DÉC'],
                    datasets: 
                    [{
                        label: 'Data 1',
                        data: [<?php echo $data1; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },
                  ]
                },
             
                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                }
            });
              </script>
      </div>
