@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-2 ">
            <div class="panel panel-default">  
                <ul class="list-group">
                    <li class="list-group-item">Activities</li> 
                    <li class="list-group-item"><a href="#">Members</a></li> 
                    <li class="list-group-item">Orders</li> 
                </ul>
            </div>
        </div> 
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
