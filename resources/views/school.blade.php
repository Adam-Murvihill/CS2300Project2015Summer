@extends('standard')
@section('standard')
  <body>
  <h1>Logged in: {{$name}}</h1> <!--Tells user who is logged in -->
  <h1>{{$message}}</h1> <!--Tells user the message -->
    <h1>Schools Available</h1>
  <!--Displays the table from the school table -->
 <table style="width:50%">
    <tr>
    <th>School</th>
    <th>URL</th>
  </tr>
   @foreach ($schooltable as $schooltabe)
  <tr>
  <td><a href="{{action('DepartmentController@department', [$schooltabe -> school_name])}}"> {{$schooltabe -> school_name}}</a></td>
    <td> {{$schooltabe -> school_url}}</td>
  </tr>

  @endforeach

</table>

    <h1>Add School!</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Add school form -->
{!! Form::open(['url' => 'school']) !!}
    <div class ="form-group">
        {!! Form::label('schoolname', 'Insert School Name:')!!} <!--Text field for school name -->
        {!! Form::text('schoolname', null, ['class' => 'form-control']) !!}
    </div>
    <div class ="form-group">
        {!! Form::label('schoolURL', 'Insert School URL:')!!} <!--text field for school url -->
        {!! Form::text('schoolURL', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Add School', ['class' => 'btn btn-primary form-control']) !!} <!--Submit button -->
    </div>
{!! Form::close() !!}
  </body>
@stop