
  @extends('standard')
@section('standard')
  
  <body>
  <h1>Logged in: {{$name}}</h1> <!--Tells user who is logged in -->
  <h1>{{$message}}</h1> <!--Tells user the message -->
    <h1>Teachers Available for the course in {{$department_name}}</h1>
  <!--Displays the table from teacher controller -->
 <table style="width:150%">
   <tr>
    <th>Name</th>
    <th>Email </th>
    <th>Rate my Professor URL</th>
  </tr>
  <tr>
     @foreach ($teachertable as $ttable)
         <tr>
             <td><a href="{{action('ContentFolderController@contentfolder', [$ttable -> TID, $ttable -> CID])}}">  {{$ttable -> name}}</a></td>
             <td> {{$ttable -> email}}</td>
             <td> {{$ttable -> RMPURL}}</td>
         </tr>

     @endforeach

</table>
    <h1>Add Teacher!</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!--Form for adding teacher -->
    {!! Form::open(['action' => ['TeachersController@store', $department_name, $department_number, $coursenumber]]) !!}
    <div class ="form-group">
        {!! Form::label('name', 'Full Name:')!!} <!--Text field for name -->
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <div class ="form-group">
        {!! Form::label('email', 'Insert Teacher email:')!!} <!--Text field for teacher email -->
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class ="form-group">
        {!! Form::label('rmpurl', 'Insert Teacher Rate My Professor URL:')!!} <!--Text field for rmp url -->
        {!! Form::text('rmpurl', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Add Teacher', ['class' => 'btn btn-primary form-control']) !!} <!--Submit button -->
    </div>
    {!! Form::close() !!}
  </body>
  
@stop
  
  
