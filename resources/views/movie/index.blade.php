@extends('main-layout')




@section('content')


<section>

	<div class="container">

	@if(Session::has('flash_message'))
	    <div class="alert alert-success">
	        <p>{{ Session::get('flash_message') }}</p>
	    </div>
	@endif


	<h3>Movies</h3>

	<p><a href ="{{ App::make('url')->to('/') }}/create-movie/">Add New Movie</a></p>

	<hr>
	
	@foreach ($movies as $movie)

	<p><strog>Name:</strog> {{$movie->name}} - <strong>Year:</strong> {{$movie->year}} - <a href ="{{ App::make('url')->to('/') }}/edit-movie/{{$movie->movie_id}}">Edit Movie</a>-<a href ="{{ App::make('url')->to('/') }}/delete-movie/{{$movie->movie_id}}">Delete Movie</a>  </p>
		
		
		
		<?php $primary_image = $movie->primaryImage();?> 

		@if (!is_null($primary_image)) 

		<img style="width: 100px;" src="{{ asset('storage/'.$primary_image['image_name'])}}"> 

		@endif

		<br>

		@foreach ($movie->tags as $tag)

		{{$tag->tag->name}},
		
		@endforeach

	<hr>
	
	@endforeach

	</div>

</section>


@stop