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

		<div class="input-container">

			<p><a href ="{{ App::make('url')->to('/') }}">Back</a></p>

			{!! Form::open(array('route' => 'create-movie' ,'files' => true  , 'name' => 'MovieForm')) !!}
			
			<div class="input">
				{!! Form::label('name', 'Name:')!!}<br>{!! Form::text('name') !!}
			</div>
			
			<div class="input">
				{!! Form::label('year', 'Year:')!!}<br>{!! Form::text('year') !!}
			</div>
			
			<div class="input">
				{!! Form::label('category_id', 'Category:')!!} {!! Form::select('category_id', $categories) !!}
			</div>
			
			<div class="input">
				{!! Form::label('description', 'Description:')!!}<br>{!! Form::textarea('description') !!}
			</div>
			
			<div>
			<p>Tags:</p>

				<ul>
				@foreach ($tags as $tag)

					
					<li>
					{!!Form::checkbox('tags[]', $tag->tag_id,false,['id' => $tag->name])!!}{!! Form::label($tag->name, $tag->name)!!}
				    </li>


					
					
				@endforeach
				</ul>	
		    </div>


			{{Form::label('user_file', 'Upload Image',['class' => 'control-label'])}}
			{{Form::file('user_file[]',array('multiple'=>true))}}
			



			<div class="input">
			{!! Form::submit('Submit') !!}
		    </div>
			{!! Form::close() !!}

		</div>


	</div>

</section>


@stop