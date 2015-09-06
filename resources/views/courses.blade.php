@extends('standard')
@section('standard')

  <body>
  <h1>Logged in: {{$name}}</h1>  <!--Tells user if logged in -->
  <h1>{{$message}}</h1> <!--Tells user a message if any -->
    <h1>Courses Available for {{$department_name}}</h1> <!--Tells the user which department -->
  <!--Displays the table and makes href links -->
 <table style="width:100%">
   <tr>
    <th>Course Number</th>
    <th>General Description</th>
  </tr>
  <tr>
    @foreach ($coursetable as $ctable)
         <tr>
             <td><a href="{{$url = action('TeachersController@teachers',[$ctable -> department_name, $ctable -> dept_num, $ctable -> coursenumber])}}"> {{$ctable -> sectionnumber}}</a></td>
             <td> {{$ctable -> Description}}</td>
         </tr>
  @endforeach
</table>
    <h1>Add Course!</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--The new course form -->
    {!! Form::open(['action' => ['CoursesController@store', $department_name, $department_number]]) !!}
    <div class ="form-group">
        {!! Form::label('description', 'Insert Description:')!!}  <!--Form for descrption -->
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
    <div class ="form-group">
        {!! Form::label('sectionnumber', 'Insert Course Number:')!!} <!--Form for entering course number -->
        {!! Form::text('sectionnumber', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Add Course', ['class' => 'btn btn-primary form-control']) !!} <!--Submit Button -->
    </div>
    {!! Form::close() !!}

  </body>
    @stop

