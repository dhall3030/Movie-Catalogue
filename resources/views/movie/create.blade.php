@extends('main-layout')




@section('content')


<section id="media_profile">

	<div class="container">

	@if(Session::has('flash_message'))
	    <div class="alert alert-success">
	        <p>{{ Session::get('flash_message') }}</p>
	    </div>
	@endif



	@if (count($errors) > 0)
		 <div class="alert alert-danger">
		    <ul>
		        @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
		        @endforeach
		    </ul>
		 </div>
	@endif

	<h3>Create Movie:</h3>

	<p><a href ="{{ App::make('url')->to('/') }}">Back</a></p>

	{!! Form::open(array('route' => 'create-movie' , 'name' => 'MovieForm')) !!}
	
	<p>{!! Form::label('name', 'Name:')!!}<br>{!! Form::text('name') !!}</p>
	<p>{!! Form::label('year', 'Year:')!!}<br>{!! Form::text('year') !!}</p>
	<p>{!! Form::label('category_id', 'Category:')!!} {!! Form::select('category_id', $categories) !!}</p>
	<p>{!! Form::label('description', 'Description:')!!}<br>{!! Form::textarea('description') !!}</p>
	
	
	<p>Tags:</p>
	@foreach ($tags as $tag)

		
		{!!Form::checkbox('tags[]', $tag->tag_id,false,['id' => $tag->name])!!}{!! Form::label($tag->name, $tag->name)!!}


		
		
	@endforeach


	
	<p>{!! Form::submit('Submit') !!}</p>
	{!! Form::close() !!}


	</div>

</section>


@stop