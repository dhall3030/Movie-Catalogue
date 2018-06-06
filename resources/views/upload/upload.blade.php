{{Form::open(['route' => 'upload-file', 'files' => true])}}

{{Form::label('user_file', 'Upload Image',['class' => 'control-label'])}}
{{Form::file('user_file')}}
{{Form::submit('Save', ['class' => 'btn btn-success'])}}

{{Form::close()}}