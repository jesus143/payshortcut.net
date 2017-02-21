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
                    @endif

                    <div class="panel-heading">Member Lists</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            </thead>
                            <tbody>

                            @foreach ($member as $field => $value)
                                <tr>
                                    <td>{{changeDashToSpaceUcLetter($field)}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <form action="{{route('member.destroy', $member['id'])}}" method="post" id="member_form_{{$member['id']}}">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE" />
                            <input type="button" class="alert alert-danger" value="Delete"  onClick="delete_member_confirmation({{$member['id']}})" />
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection




