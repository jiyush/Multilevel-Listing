@extends('layouts.newapp')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Category

                <a href="/add" class="btn btn-primary float-right" style="margin: 0 10px">Add Category</a>  

                <button type="button" class="btn btn-primary float-right"
                 data-toggle="modal" data-target=".bd-example-modal-lg">
                View in Tree Form
                </button>
            </h3>
            
        </div>
        <div class="card-body">
            <table class="table">
            	<thead>
            		<tr>
            			<th>Category</th>
            			<th>parentId</th>
            			<th>Level</th>
            			<th colspan="2">Action</th>
            		</tr>
            	</thead>
            	<tbody>
            		@foreach($data as $d)
            		<tr> 
            			<td>{{ $d->category }} </td>
            			<td>{{ $d->parentId }} </td>
            			<td>{{ $d->level }} </td>
            			<td>
            				<a href="/edit/{{ $d->id }}" class="btn btn-primary">Edit</a>
            			</td>
            			<td>
            				<form action="/delete" method="post">
            					{{ @csrf_field() }}
            					<input type="hidden" name="id" value="{{ $d->id }}">
            					<button type="submit" class="btn btn-danger del-confirm" >Delete</button>
            				</form>
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="model-body">
            
            <div id="chart_div" style="width: 500px"></div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(()=>{

    $('.del-confirm').click(function(){

        return confirm('Are You Sure You Want to Delete This record...!');
    });

});
    
</script>
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
