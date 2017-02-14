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
                    <div class="panel-heading">Member Lists</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            </thead>
                            <tbody>

                            @foreach ($order as $field => $value)
                                <tr>
                                    <td>{{changeDashToSpaceUcLetter($field)}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <input type="submit" class="alert alert-info" value="Refund" />
                        <input type="submit" class="alert alert-danger" value="Delete" />
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection




