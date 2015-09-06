@extends('standard')
@section('standard')
    <h1>Logged in: {{$name}}</h1> <!--Tells user who is logged in -->
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	
	<div class="jumbotron">
    <h1>Welcome To Class Doc Share!</h1>
        <p>View and Add files for your favourite schools</p>
        <!--Go to school page -->
     <p><a class="btn btn-primary btn-lg" href="{{action('SchoolController@school')}}" role="button">Begin Journey Here</a></p>
        <!-- Go to log in screen-->
	 <p><a class="btn btn-primary btn-lg" href="auth/login" role="button">Log In</a></p>
        <!--Go to register page -->
        <p><a class="btn btn-primary btn-lg" href="{{action('Auth\AuthController@getRegister')}}" role="button">SignUp</a></p>

        <!--Search form -->
        {!! Form::open(['action' => ['ContentController@altcontent']]) !!}
        <div class ="form-group">
            {!! Form::label('name', 'User-Look UP:')!!} <!--User look up field -->
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Find!', ['class' => 'btn btn-primary btn-lg']) !!} <!--Submit button -->
        </div>
        {!! Form::close() !!}


         </div>
	
	
  </body>
@stop