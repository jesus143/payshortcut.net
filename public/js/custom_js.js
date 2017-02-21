

function refund_confirmation(order_id)
{
    if(confirm('Are you sure you want to refund this product?')) {
        $( "#refund_form_"+order_id ).submit();
    }
}
function delete_member_confirmation(member_id)
{
    if(confirm('Are you sure to delete this member?')) {
        $( "#member_form_"+member_id ).submit();
    }
}