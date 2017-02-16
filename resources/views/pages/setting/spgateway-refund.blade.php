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

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif

                        <form action="{{route('setting.store')}}" method="post" >
                            {{csrf_field()}}
                            <div class="form-group" >

                                <label>Merchant Id</label>
                                <input type="text" name="marchant_id" class="form-control"  value="{{$settings['marchant_id']}}" /><br>

                                <label>Hash Key</label>
                                <input type="text" name="hash_key" class="form-control"  value="{{$settings['hash_key']}}" /><br>

                                <label>Hash IV</label>
                                <input type="text" name="hash_iv" class="form-control"  value="{{$settings['hash_iv']}}" /><br>

                                <label>Refund Testing</label>
                                <input type="radio" name="refund_sandbox"    value="yes" {{ $settings['refund_sandbox'] == 'yes' ? 'checked' : '' }}/><br>

                                <label>Refund Live</label>
                                <input type="radio" name="refund_sandbox"    value="no" {{ $settings['refund_sandbox'] == 'no' ? 'checked' : '' }}/><br>

                                <input type="submit" value="save" class="alert alert-success" />

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



