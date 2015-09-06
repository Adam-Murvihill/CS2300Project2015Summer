@extends('standard')
@section('standard')

  <body>
  <h1>Logged in: {{$name}}</h1> <!--Tells user who is logged in -->
  <h1>{{$message}}</h1> <!--Tells user any messages -->
    <h1>Departments Available for {{$school_name}} </h1>

  <!--Displays the table from department controller -->
 <table style="width:50%">
   <tr>
    <th>Department</th>
    <th>URL</th>
  </tr>
   @foreach ($departmenttable as $dep)
  <tr>
  <td><a href="{{action('CoursesController@courses', [$dep -> department_name, $dep -> department_number ])}}"> 
  {{$dep -> department_name}}</a></td>
    <td> {{$dep -> dept_url}}</td>
  </tr>

  @endforeach
 </table>
    <h1>Add Department!</h1>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Form for adding departments -->
     {!! Form::open(['action' => ['DepartmentController@store', $school_name]]) !!}
     <div class ="form-group">
         {!! Form::label('departmentname', 'Insert Department Name:')!!}  <!--Text field for department name -->
         {!! Form::text('departmentname', null, ['class' => 'form-control']) !!}
     </div>
     <div class ="form-group">
         {!! Form::label('departmentURL', 'Insert Department URL:')!!}  <!--Textfield for department url -->
         {!! Form::text('departmentURL', null, ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
         {!! Form::submit('Add Department', ['class' => 'btn btn-primary form-control']) !!} <!--Submit department -->
     </div>
     {!! Form::close() !!}


  </body>
     @stop
 

  
  
