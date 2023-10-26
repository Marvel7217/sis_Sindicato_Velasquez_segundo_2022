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
    min-width: 360px;
    max-width: 800px;
    margin: 1em auto;
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
<!--<script src="../../code/modules/series-label.js"></script>-->
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>
<!--<script src="../../code/modules/accessibility.js"></script>-->

<figure class="highcharts-figure">
    <div id="container"></div>
    <!--<p class="highcharts-description">
        Basic line chart showing trends in a dataset. This chart includes the
        <code>series-label</code> module, which adds a label to each line for
        enhanced readability.
    </p>-->
</figure>





		<script type="text/javascript">
Highcharts.chart('container', {

    /*title: {
        text: 'U.S Solar Employment Growth',
        align: 'left'
    },*/
     title: {
        text: 'REPORTES GRAFICOS DE MONTO',
        align: 'left'
    },


    /*subtitle: {
        text: 'By Job Category. Source: <a href="https://irecusa.org/programs/solar-jobs-census/" target="_blank">IREC</a>.',
        align: 'left'
    },*/
    subtitle: {
        text: 'Elaborado por Marcelo velasquez',
        align: 'left'
    },

    yAxis: {
       /*title: {
            text: 'Number of Employees'
        }*/
        title: {
            text: 'Monto'
        }
    },

    xAxis: {
        /*accessibility: {
            rangeDescription: 'Range: 2010 to 2020'
        }*/
        categories: [
            <?php
            $sql=$db->Prepare("SELECT * FROM viajes WHERE estado='A'");
            $rs=$db->GetAll($sql);
            foreach($rs as $k=>$fila)
            {
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

    /*plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2010
        }
    },*/

    series: [{
        /*name: 'Installation & Developers',*/
        name:'monto',
        /*data: [43934, 48656, 65165, 81827, 112143, 142383,
            171533, 165174, 155157, 161454, 154610]*/
            data: [
            <?php
            $sql=$db->Prepare("SELECT* FROM viajes WHERE estado='A' " );
            $rs=$db->GetAll($sql);
            foreach($rs as $k=>$fila)
            {
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
