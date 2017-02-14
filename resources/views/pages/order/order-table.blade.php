

<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>id</th>
        <th>owner</th>
        <th>status</th>
        <th>merchant_order_no</th>
        <th>amt</th>
        <th>trade_no</th>
        {{--<th>token_value</th>--}}
        {{--<th>token_life</th>--}}
        <th>refund</th>
        <th>details</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>id</th>
        <th>owner</th>
        <th>status</th>
        <th>merchant_order_no</th>
        <th>amt</th>
        <th>trade_no</th>
        {{--<th>token_value</th>--}}
        {{--<th>token_life</th>--}}
        <th>refund</th>
        <th>details</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach ($orders as $order)
        <tr>
            <td> {{$order->id}} </td>
            <td> {{App\Member::getNameById($order->member_id)}} </td>
            <td> {{$order->status}} </td>
            <td> {{$order->merchant_order_no}} </td>
            <td> {{$order->merchant_order_no}} </td>
            <td> {{$order->amt}} </td>
            {{--<td> {{$order->token_value}} </td>--}}
            {{--<td> {{$order->token_life}} </td>--}}
            <td> <a href="#"> refund </a> </td>
            <td> <a href="{{route('order.show', $order->id)}}"> Details</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>

