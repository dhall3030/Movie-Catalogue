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

		<div class="input-container">

			<p><a href ="{{ App::make('url')->to('/') }}">Back</a></p>

			{!! Form::open(array('route' => array( 'edit-movie' ,$movie->movie_id) ,'files' => true , 'name' =>'MovieForm')) !!}
			
			
			<div class="input">
				{!! Form::label('name', 'Name:')!!}<br>{!! Form::text('name',$movie->name) !!}
			</div>
			<div class="input">
				{!! Form::label('year', 'Year:')!!}<br>{!! Form::text('year',$movie->year) !!}
			</div>
			<div class="input">
				{!! Form::label('category_id', 'Category:')!!} {!! Form::select('category_id', $categories, $movie->category_id) !!}
			</div>
			<div class="input">
				{!! Form::label('description', 'Description:')!!}<br>{!! Form::textarea('description',$movie->description) !!}
			</div>
			
			<?php 
				
				// $movie_tags = array();

				// $i = 0;

				// foreach ($movie->tags as $tag) {

				// 	$movie_tags[$i] = $tag->tag->name;

				// 	$i++;
				// }

				//var_dump($movie_tags);

			?>
		 	
			<div>
		 	<p>Tags:</p>

			 	<ul>

				@foreach ($tags as $tag)

					 
						<?php  $checked = false; ?>
						
						@if(in_array($tag->name, $selectedTags))

						<?php  $checked = true; ?>
						
						@endif

					

					<li>{!!Form::checkbox('tags[]', $tag->tag_id,$checked,['id' => $tag->name])!!}{!! Form::label($tag->name, $tag->name)!!}</li>


					
					
				@endforeach
				</ul>
			</div>


			{{Form::label('user_file', 'Upload Image',['class' => 'control-label'])}}
			{{Form::file('user_file[]',array('multiple'=>true))}}

			<div class="input">
			<p>{!! Form::submit('Submit') !!}</p>
			{!! Form::close() !!}
			</div>
			
			

			<?php $primary_image = $movie->primaryImage();?> 	

			@if (!is_null($primary_image)) 


			<p>Primary image</p>

			<img src="{{ asset('storage/'.$primary_image['image_name'])}}"> 

			@endif
			
			<hr>
		
			@foreach ($movie->images as $image)

				<img src="{{ asset('storage/'.$image->image_name)}}">

				<p><a href="{{ App::make('url')->to('/') }}/set-primary-image/{{$image->image_id}}">{{(boolval($image->primary_image) ? 'primary' : 'Set to primary') }}</a></p>

				<p><a href="{{ App::make('url')->to('/') }}/delete-image/{{$image->image_id}}">Delete Image</a></p>

				<hr>

			@endforeach

						

		</div>


	</div>

</section>


@stop