<?php
// conectarea la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sonda";
$conn = new mysqli($servername, $username, $password, $dbname);

// verificarea conexiunii
if ($conn->connect_error) {
    die("Conexiunea la baza de date a esuat: " . $conn->connect_error);
}

// extragerea datelor din baza de date
$sql = "SELECT * FROM info";
$result = $conn->query($sql);

// initializarea array-urilor pentru datele fiecarei coloane
$tempA_data = array();
$tempS_data = array();
$umedA_data = array();
$umedS_data = array();
$v_b_data = array();

// parcurgerea rezultatelor interogarii si adaugarea datelor in array-uri
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($tempA_data, $row["tempA"]);
        array_push($tempS_data, $row["tempS"]);
        array_push($umedA_data, $row["umedA"]);
        array_push($umedS_data, $row["umedS"]);
        array_push($v_b_data, $row["v_b"]);
    }
}

// inchiderea conexiunii la baza de date
$conn->close();

// crearea graficelor folosind libraria Chart.js
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="60">
    <title>Grafice</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
<header>
    <nav>
        <h2>Monitoring</h2>
        <ul>

        </ul>
    </nav>
</header>

<div class="row">
    <div class="column">
        <canvas id="tempA"></canvas>
        <script>

            var ctx = document.getElementById('tempA').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(range(1, count($tempA_data))); ?>,
                    datasets: [{
                        label: 'Temperatura in aer',
                        data: <?php echo json_encode($tempA_data); ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <div class="column">
        <canvas id="tempS"></canvas>
        <script>
            var ctx = document.getElementById('tempS').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(range(1, count($tempS_data))); ?>,
                    datasets: [{
                        label: 'Temperatura in sol',
                        data: <?php echo json_encode($tempS_data); ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <div class="column">
        <canvas id="umedA"></canvas>

        <script>
            var ctx = document.getElementById('umedA').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(range(1, count($v_b_data))); ?>,
                    datasets: [{
                        label: 'Umiditatea in aer',
                        data: <?php echo json_encode($umedA_data); ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <div class="column">
        <canvas id="umedS"></canvas>

        <script>
            var ctx = document.getElementById('umedS').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(range(1, count($umedS_data))); ?>,
                    datasets: [{
                        label: 'Umiditate in sol  %',
                        data: <?php echo json_encode($umedS_data); ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
    <div class="column">
        <canvas id="v_b"></canvas>

        <script>
            var ctx = document.getElementById('v_b').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(range(1, count($v_b_data))); ?>,
                    datasets: [{
                        label: 'Voltajul bateriei',
                        data: <?php echo json_encode($v_b_data); ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</div>
<!-- grafic pentru temperatura ambientala -->


<!-- grafic pentru temperatura apei -->
<!-- grafic pentru umiditatea ambientala -->
<!-- grafic pentru umiditatea apei -->

<!-- grafic pentru viteza vantului -->

</body>
</html>

