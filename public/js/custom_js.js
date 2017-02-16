

function refund_confirmation(order_id)
{
    if(confirm('Are you sure you want to refund this product?')) {
        $( "#refund_form_"+order_id ).submit();
    }
}