<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <?php
    session_start();
    include_once('connect.php');
    $name = $_SESSION['uname'];
    ?>
    <script>
    window.onload = function () {
        var dataPoints = []; // 현재 골격근량
        var dataPoints2 = []; // 현재 체중
        var dataPoints3 = []; // 현재 체중의 평균 골격근량
        var chart = new CanvasJS.Chart("chartContainer", {
			theme: "light1",
            animationEnabled: true,
            exportEnabled: true,
            title:{
                text: "나의 골격근량"
            },
            axisY: [
            {
                title: "골격근량(kg)",
                includeZero: false
            },
            {
                title: "체중(kg)",
                lineColor: "#C24642",
                includeZero: false
            }
            ],
            axisX:{
                title: "날짜",
                interval: 1
            },
            data: [{
                type: "spline",
                axisXIndex: 0,
                name: "골격근량",
                showInLegend: true,
                toolTipContent: "{y}",
                dataPoints: dataPoints,
                indexLabel: "{y}"
            },
            {
                type: "line",
                axisYIndex: 1,
                name: "체중",
                showInLegend: true,
                toolTipContent: "{y}",
                dataPoints: dataPoints2,
                indexLabel: "{y}"
            },
            {
                type: "spline",
                axisXIndex: 0,
                name: "평균",
                showInLegend: true,
                toolTipContent: "{y}",
                dataPoints: dataPoints3,
                indexLabel: "{y}"
            }
            ]
        });
        $.get("http://localhost:8080/projects/웹디웹프기말고사/muscle.csv", getDataPointsFromCSV);
        function getDataPointsFromCSV(csv) {
            var csvLines = points = [];
            csvLines = csv.split(/[\r?\n|\r|\n]+/);
            for (var i = 0; i < csvLines.length; i++) {
                if (csvLines[i].length > 0) {
                    points = csvLines[i].split(",");
                    dataPoints.push({
                        label: points[0],
                        y: parseFloat(points[2])
                    });
                    dataPoints2.push({
                        label: points[0],
                        y: parseFloat(points[1])
                    });
                    dataPoints3.push({
                        label: points[0],
                        y: parseFloat(points[3])
                    });
                }
            }
            chart.render();
        }
    }
    </script>
</head>
<body>
    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 










