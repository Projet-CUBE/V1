
    <?php

$data1 = '';

//database query to get data from the table
$select = getPdo()->prepare('SELECT  
                            MONTH( date_commentaire ) AS MOIS, 
                            COUNT( UUID_commentaire ) AS NOMBRE_COMMENTAIRE
                            FROM statistiques_commentaire
                            GROUP BY MOIS');
//execute query
$select->execute();

while ($row = $select->fetch()) {
    $data1 = $data1 . '"'. $row['NOMBRE_COMMENTAIRE'].'",';
}

$data1 = trim($data1,",");

// -----------------------------------------------------------------------------------------------------

$data2 = '';

//database query to get data from the table
$select2 = getPdo()->prepare('SELECT  
                            MONTH( date_compte ) AS MOIS, 
                            COUNT( id_compte ) AS NOMBRE_COMPTES
                            FROM statistiques_compte
                            GROUP BY MOIS');
//execute query
$select2->execute();

while ($row = $select2->fetch()) {
    $data2 = $data2 . '"'. $row['NOMBRE_COMPTES'].'",';
}

$data2 = trim($data2,",");

// -----------------------------------------------------------------------------------------------------

$data3 = '';

//database query to get data from the table
$select3 = getPdo()->prepare('SELECT  
                            MONTH( date_post ) AS MOIS, 
                            COUNT( UUID_post ) AS NOMBRE_POSTS
                            FROM statistiques_post
                            GROUP BY MOIS');
//execute query
$select3->execute();

while ($row = $select3->fetch()) {
    $data3 = $data3 . '"'. $row['NOMBRE_POSTS'].'",';
}

$data3 = trim($data3,",");

?>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
 
      <div class="container">      
              <canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

              <script>
                    var ctx = document.getElementById("chart").getContext('2d');
                  var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['JAN', 'FÉV', 'MAR', 'AVR', 'MAI', 'JUN', 'JUL', 'AOÛ', 'SEP', 'OCT', 'NOV', 'DÉC'],
                    datasets: 
                    [{
                        label: 'Commentaires par mois',
                        data: [<?php echo $data1; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(255,99,132)',
                        borderWidth: 3
                    },
                    {
                        label: 'Création de comptes par mois',
                        data: [<?php echo $data2; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(46,134,193)',
                        borderWidth: 3
                    },
                    {
                        label: 'Posts par mois',
                        data: [<?php echo $data3; ?>],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(29,131,72)',
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
