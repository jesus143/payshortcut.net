@extends('layouts.app')
@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script>
        $.get( "http://localhost/rocky/payshortcut.net/api/test", {}, function( data ) {
            alert( "Data Loaded: " + data.name );
        });

        $.get( "http://localhost/rocky/payshortcut.net/api/member/create/123")
        .done(function( data ) {
            alert( "Data Loaded: " + data );
        });
    </script>

    <div class="container">
        <div class="row">

            <div class="col-md-2 ">
                <div class="panel panel-default">
                    @include('pages/sidebar/menu')
                </div>
            </div>

            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Member Lists</div>
                    <div class="panel-body">
                        This is just a test
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



