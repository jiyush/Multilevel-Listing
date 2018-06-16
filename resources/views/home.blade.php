@extends('layouts.newapp')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Category

                <a href="/add" class="btn btn-primary float-right" style="margin: 0 10px">Add Category</a>  

                <a href="/tree" class="btn btn-primary float-right" >View In Tree Form</a>
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

<script type="text/javascript">
$(document).ready(()=>{

    $('.del-confirm').click(function(){

        return confirm('Are You Sure You Want to Delete This record...!');
    });

});
    
</script>
@endsection
