@extends('standard')
@section('standard')

    <body>
    <h1>Logged in: {{$name}}</h1> <!--Tells user if logged in or not -->
    <h1>Content Available</h1>
    <h1>{{$messagee}}</h1> <!--Tells user of any message from actions taken -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

        <table style="width:100%">
            <!-- Creates the content table, the table was passed in by controller -->
        <tr>
            <th>File Name</th>
            <th>User Added</th>
            <th>Rating</th>

            <th>Content Link</th>
        </tr>
        @foreach ($contentvar as $cvar)
            <tr>
                <td>{{$cvar -> contentname}}</td>
                <td>{{$cvar -> name}}</td>
                <td>{{$cvar -> NetRating}}</td>

                <td>{{$cvar -> contentlink}}</td>

                <td>
                     <!--This is a delete button -->
                    <p><a class="btn btn-primary btn-lg" href="{{action('ContentController@delete',[$cvar -> filenumber, $cvar -> name])}}" role="button">Delete</a></p>
                </td>
            </tr>

        @endforeach
    </table>
    <h4>Note: You can only delete your own files</h4>
    </body>
@stop

