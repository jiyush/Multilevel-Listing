@extends('layouts.newapp')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Categories in tree

                <a href="/add" class="btn btn-primary float-right" style="margin: 0 10px">Add Category</a>  

                <a href="/" class="btn btn-primary float-right" >View In Table Form</a>
            </h3>
            
        </div>
            <div class="card-body">
              
              <div id="chart_div" style="width: 500px"></div>
              
            </div>
      </div>
    </div>
    

    <script type="text/javascript">

      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        $.get('/getTree', (responseData)=>{
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Category');
              data.addColumn('string', 'Parent');
              data.addColumn('string', 'ToolTip');
              responseData.unshift(["root", "",""]);

              data.addRows( responseData );

              // Create the chart.
              var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
              // Draw the chart, setting the allowHtml option to true for the tooltips.
              chart.draw(data, {allowHtml:true});
        })
      }
   </script>
@endsection
