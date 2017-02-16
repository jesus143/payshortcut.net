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
                        @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead>
                            </thead>
                            <tbody>
                            @foreach ($order as $field => $value)
                                <tr>

                                    @if(in_array($field, ['content_post']))

                                        <td> Payment Method</td>
                                        <td> {{App\Order::getPaymentMethod(['content_post'=>$value]) }} </td>
                                        <tr>
                                        <td> Ip Address </td>
                                        <td> {{App\Order::getIpAddress(['content_post'=>$value]) }} </td>
                                    @endif
                                    @if(!in_array($field, ['content_post', 'content_session'])) 
                                        <td>{{changeDashToSpaceUcLetter($field)}}</td>
                                        <td>{{$value}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @if($order['status'] != 'Refunded Successfully')
                            <form action="{{route('refund.execute')}}" method="post" name="refund" id="refund_form_{{$order['id']}}" >
                                {{csrf_field()}}
                                <input type="hidden" value="{{ $order['id'] }}" name="id" />
                                <input type="hidden" value="{{ $order['trade_no'] }}" name="trade_no" />
                                <input type="hidden" value="{{ $order['merchant_order_no'] }}" name="merchant_order_no" />
                                <input type="hidden" value="{{ $order['amt'] }}" name="amt" />
                                <input type="button" value="Refund" class="alert alert-danger" onClick="refund_confirmation({{$order['id']}})" />
                            </form>
                        @endif
                        {{--<input type="submit" class="alert alert-danger" value="Delete" />--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection