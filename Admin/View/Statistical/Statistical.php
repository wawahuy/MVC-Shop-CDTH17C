<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 15px;background-color:white;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Doanh số bán hàng</h1>
    </div>
    <div class="row">
        <div class="col" style="background-color:lavender;margin:1px;"><h3>31.075.000đ</h3> <br> Tổng doanh thu
          <img src="{{YUH_URI_ROOT}}/Resource/img/money.png" width= 70 height = 70 style="position: relative; left: 15px; bottom:10px;" data-selected="true" data-label-id="0">
        </div>
        <div class="col" style="background-color:lavender;margin:1px;"><h3>2.314</h3> <br>Tổng đơn hàng
          <img src="{{YUH_URI_ROOT}}/Resource/img/receipt.png" width= 70 height = 70 style="position: relative; left: 25px; bottom:10px;" data-selected="true" data-label-id="0">
        </div> 
        <div class="col" style="background-color:lavender;margin:1px;"><h3>3.580</h3> <br>Tổng số đã mua
          <img src="{{YUH_URI_ROOT}}/Resource/img/ecommerce.png" width= 70 height = 70 style="position: relative; left: 15px; bottom:10px;" data-selected="true" data-label-id="0">
        </div> 
        <div class="col" style="background-color:lavender;margin:1px;"><h3>1.432</h3> <br>Khách hàng
          <img src="{{YUH_URI_ROOT}}/Resource/img/boy.png" width= 70 height = 70 style="position: relative; left: 45px; bottom:10px;" data-selected="true" data-label-id="0">
        </div>
    </div>

    <!-- bieu do doanh thu -->
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Qúy', 'Nam', 'Nữ'],
          ['Qúy 1',  1000,      400],
          ['Qúy 2',  1170,      460],
          ['Qúy 3',  660,       1120],
          ['Qúy 4',  1030,      540]
        ]);

        var options = {
          title: 'Doanh số bán hàng theo quý',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
       
    </script>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    
    <div></div>
    
</div>