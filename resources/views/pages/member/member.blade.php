@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 ">
                <div class="panel panel-default">
                    @include('pages/sidebar/menu')
                </div>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif


                    <div class="panel-heading">Member Lists</div>
                    <div class="panel-body">
                        @include("pages.member.member-table");
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



