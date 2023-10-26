<?php
session_start();
require_once("../../../../../conexion.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Highcharts Example</title>

		<style type="text/css">
.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
	</head>
	<body>
<script src="../../code/highcharts.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>
<!--<script src="../../code/modules/accessibility.js"></script>-->
<figure class="highcharts-figure">
    <div id="container"></div>
    <!--<p class="highcharts-description">
        A basic column chart comparing emissions by pollutant.
        Oil and gas extraction has the overall highest amount of
        emissions, followed by manufacturing industries and mining.
        The chart is making use of the axis crosshair feature, to highlight
        years as they are hovered over.
    </p>-->
</figure>



		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column' // Cambiamos el tipo de gráfico a 'column' para que sea de columnas
    },
    title: {
        text: 'REPORTES GRAFICOS DE MONTO',
        align: 'left'
    },
    subtitle: {
        text: 'Elaborado por Marcelo Velásquez',
        align: 'left'
    },
    yAxis: {
        title: {
            text: 'Monto'
        }
    },
    xAxis: {
        categories: [
            <?php
            $sql = $db->Prepare("SELECT * FROM viajes WHERE estado='A'");
            $rs = $db->GetAll($sql);
            foreach ($rs as $k => $fila) {
            ?>
                '<?php echo $fila["destino"]; ?>',
            <?php
            }
            ?>
        ]
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
    series: [{
        name: 'Monto',
        data: [
            <?php
            $sql = $db->Prepare("SELECT * FROM viajes WHERE estado='A'");
            $rs = $db->GetAll($sql);
            foreach ($rs as $k => $fila) {
            ?>
                <?php echo $fila["monto"]; ?>,
            <?php
            }
            ?>
        ]
    }],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }
});


		</script>
	</body>
</html>
