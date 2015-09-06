@extends('standard')
@section('standard')

  <body>
  <h1>Content Available</h1>
  <h1>Logged in: {{$name}}</h1> <!--Tells user if logged in or not-->
    <h1>{{$messagee}}</h1>  <!--Tells user of any messages from page actions -->

  <!--Displays table that was passed in from the controller -->
 <table style="width:100%">
   <tr>
    <th>File Name</th>
    <th>User Added</th>
    <th>Rating</th>
	<th>Content Link</th>
    <th>File ID Number</th>
  </tr>
     @foreach ($contentvar as $cvar)
         <tr>
             <td>{{$cvar -> contentname}}</td>
             <td>{{$cvar -> name}}</td>
             <td>{{$cvar -> NetRating}}</td>
             <td>{{$cvar -> contentlink}}</td>
             <td>{{$cvar -> filenumber}}</td>

         </tr>

     @endforeach
</table>
  <!--The Voting form -->
  {!! Form::open(['action' => ['ContentController@vote', $FileID]]) !!}
  <div class ="form-group">
      {!! Form::label('vote', 'Vote (between 0-10):')!!}  <!--The voting text field -->
      {!! Form::text('vote', null, ['class' => 'form-control']) !!}
  </div>
  <div class ="form-group">
      {!! Form::label('filenumber', 'File Number')!!}  <!--The file number text field -->
      {!! Form::text('filenumber', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
      {!! Form::submit('Submit Vote', ['class' => 'btn btn-primary form-control']) !!}<!--The submit button-->
  </div>
  {!! Form::close() !!}

          <!--The add file form -->
    <h1>Add File!</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    {!! Form::open(['action' => ['ContentController@store', $FileID]]) !!}
    <div class ="form-group">
        {!! Form::label('file', 'Insert File Name:')!!}  <!--The file name text field -->
        {!! Form::text('file', null, ['class' => 'form-control']) !!}
    </div>
    <div class ="form-group">
        {!! Form::label('contentlink', 'contentlink:')!!}  <!--The content link text field -->
        {!! Form::text('contentlink', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Add File', ['class' => 'btn btn-primary form-control']) !!}  <!--The submit button -->
    </div>
    {!! Form::close() !!}

  </body>
  @stop

