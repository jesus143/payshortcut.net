


<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Owner</th>
        <th>Status</th>
        <th>Ip Address</th>
        <th>Payment Type</th>
        <th>Merchant Order No</th>
        <th>Amt</th>
        <th>Trade No</th>
        <th>Details</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Owner</th>
        <th>Status</th>
        <th>Ip Address</th>
        <th>Payment Type</th>
        <th>Merchant Order No</th>
        <th>Amt</th>
        <th>Trade No</th>
        <th>Details</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach ($orders as $order)
        <tr>
            <td> {{$order->id}} </td>
            <td> {{App\Member::getNameById($order->member_id)}} </td>
            <td> {{$order->status}} </td>
            <td> {{App\Order::getIpAddress($order)}}</td>
            <td> {{App\Order::getPaymentMethod($order)}}  </td>
            <td> {{$order->merchant_order_no}} </td>
            <td> {{$order->merchant_order_no}} </td>
            <td> {{$order->amt}} </td>
            <td> <a href="{{route('order.show', $order->id)}}"> Details</a> </td>
        </tr>
    @endforeach
    </tbody>
</table>

