@extends('standard')
@section('standard')

    <body>
    <h1>Logged in: {{$name}}</h1> <!--Tells user if logged in or not -->
    <h1>{{$message}}</h1> <!--Tells user a message if applicable -->
    <h1>Content Types Available</h1>
    <!--kantfolder called from controller. This is displaying the stuff -->
    <table style="width:50%">
        <tr>
            <th>Type</th>
        </tr>
        @foreach ($kantfolder as $cftable)
            <tr>
                <td><a href="{{action('ContentController@content',[$cftable -> FileID])}}"> {{$cftable -> filename}}</a></td>
            </tr>

            @endforeach
    </table>
    <h1>Add Filetype!</h1>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Add new content type form-->
    {!! Form::open(['action' => ['ContentFolderController@store', $TID, $CID]]) !!}
    <div class ="form-group">
        {!! Form::label('filetype', 'Insert Filetype (For Example Tests):')!!}  <!--File type text field -->
        {!! Form::text('filetype', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Add Filetype', ['class' => 'btn btn-primary form-control']) !!}  <!--The submit button -->
    </div>
    {!! Form::close() !!}

    </body>
@stop