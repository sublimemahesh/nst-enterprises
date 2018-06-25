$(document).ready(function () {
    var taxTotal = $('#tax-invoice-total').attr('total');
    var statutoryTotal = $('#statutory-sub-total').attr('total');
    var deliveryTotal = $('#delivery-sub-total').attr('total');
    var advance = $('#advance').attr('advance');
    
//    alert(parseFloat(statutoryTotal) + parseFloat(deliveryTotal));
var total = parseInt(taxTotal) + parseInt(statutoryTotal)+ parseInt(deliveryTotal);
var total1 = new Intl.NumberFormat().format(total);

var due = total - parseInt(advance);
var due1 = new Intl.NumberFormat().format(due);


$('#payable-amount').attr("amount", total);
$('#payable-amount').html(total1);

$('#due').attr("due", due);
$('#due').html(due1);

});


