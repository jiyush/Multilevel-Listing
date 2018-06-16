@extends('layouts.newapp')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Category
                
            </h3>
            
        </div>
        <div class="card-body">
            <form method="post" action="/update" class="form-inline">

            	{{ @csrf_field() }}
			  <div class="form-group mb-2">
			    <input type="hidden" name="id" value="{{ $cat->id }}">
			    <input type="text"  class="form-control" placeholder="Enter Category" value="{{ $cat->category }}" name="category" id="category" >
			  </div>
			  <div class="col-auto my-1">
		      
		      <select class="custom-select mb-2" id="inlineFormCustomSelect" name="perentId">
		        <option selected disabled>Choose Category...</option>
		       @foreach($data as $d)
		       @if($cat->id == $d->id)

		       @else
		       <option value="{{ $d->id }}">{{ $d->category }}</option>
		       @endif
		       @endforeach
		      </select>
		    </div>
			  <button type="submit" class="btn btn-primary mb-2">Submit</button>
			</form>
        </div>
    </div>
</div>
@endsection
