<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;background-color:white;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Doanh số bán hàng</h1>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ["Element", "sold", { role: "style" } ],
            ["Q1", 894, "gold"],
            ["Q2", 1049, "gold"],
            ["Q3", 1930, "gold"],
            ["Q4", 2145, "color: gold"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            { calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation" },
            2]);

        var options = {
            title: "Thống kê bán hàng theo quý, năm 2019",
            width: 900,
            height: 400,
            bar: {groupWidth: "65%"},
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
        }
    </script>
    <div id="columnchart_values"  ></div>
    

    
</div>