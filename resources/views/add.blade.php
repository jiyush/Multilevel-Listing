@extends('layouts.newapp')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Add Category
                
            </h3>
            
        </div>
        <div class="card-body">
            <form method="post" action="/insert" class="form-inline">

            	{{ @csrf_field() }}
			  <div class="form-group mb-2">
			    
			    <input type="text"  class="form-control" placeholder="Enter Category" name="category" id="category" >
			  </div>
			  <div class="col-auto my-1">
		      
		      <select class="custom-select mb-2" id="inlineFormCustomSelect" name="parentId">
		        <option selected disabled>Choose Parent Category...</option>
		       @foreach($cat as $c)

		       <option value="{{ $c->id }}">{{ $c->category }}</option>
		       @endforeach
		      </select>
		    </div>
			  <button type="submit" class="btn btn-primary mb-2">Submit</button>
			</form>
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
        </div>
    </div>
</div>


@endsection
