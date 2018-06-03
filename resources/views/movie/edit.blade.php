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

	<h3>Edit Movie:</h3>

	<p><a href ="{{ App::make('url')->to('/') }}">Back</a></p>

	{!! Form::open(array('route' => array( 'edit-movie' ,$movie->movie_id) , 'name' =>'MovieForm')) !!}
	
	
	<p>{!! Form::label('name', 'Name:')!!}<br>{!! Form::text('name',$movie->name) !!}</p>
	<p>{!! Form::label('year', 'Year:')!!}<br>{!! Form::text('year',$movie->year) !!}</p>
	<p>{!! Form::label('category_id', 'Category:')!!} {!! Form::select('category_id', $categories, $movie->category_id) !!}</p>
	<p>{!! Form::label('description', 'Description:')!!}<br>{!! Form::textarea('description',$movie->description) !!}</p>
	
	<?php 
		
		$movie_tags = array();

		$i = 0;

		foreach ($movie->tags as $tag) {

			$movie_tags[$i] = $tag->tag->name;

			$i++;
		}

		//var_dump($movie_tags);

	?>
 	

 	<p>Tags:</p>

	@foreach ($tags as $tag)

		 
			<?php  $checked = false; ?>
			
			@if(in_array($tag->name, $movie_tags))

			<?php  $checked = true; ?>
			
			@endif

		

		{!!Form::checkbox('tags[]', $tag->tag_id,$checked,['id' => $tag->name])!!}{!! Form::label($tag->name, $tag->name)!!}


		
		
	@endforeach


	
	<p>{!! Form::submit('Submit') !!}</p>
	{!! Form::close() !!}


	</div>

</section>


@stop