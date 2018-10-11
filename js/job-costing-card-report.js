$(document).ready(function () {

    var jobcostingcard = $('#job-costing-card').attr('jobcostingcard');
    var grandtotal = 0;
    $.ajax({
        type: 'POST',
        data: {
            option: 'gettypes'
        },
        cache: false,
        url: 'ajax/report.php',
        success: function (types) {
            var count = types.length;
            types.forEach(myFunction)

            function myFunction(item, index) {

                $.ajax({
                    type: 'POST',
                    data: {
                        ritype: item,
                        jobcostingcard: jobcostingcard,
                        option: 'count'
                    },
                    cache: false,
                    url: 'ajax/report.php',
                    success: function (result) {
                        if (result) {
                            $.ajax({
                                type: 'POST',
                                data: {
                                    ritype: item,
                                    jobcostingcard: jobcostingcard,
                                    option: 'subtotal'
                                },
                                cache: false,
                                url: 'ajax/report.php',
                                success: function (total) {
                                    var num = new Intl.NumberFormat().format(total.subtotal);
                                    var html = '';
                                    html += '<td  rowspan="' + result.count + '" type="' + result.type + '" id="subtotal" class="text-right">' + num + '</td>';
                                    $("#table-" + item + " tbody tr:first-child").append(html);
                                    if (index == count - 1) {
                                        
                                        setTimeout(function () {
                                            window.print();
                                        }, 1000);
                                    }
                                }
                            });
                        }
                    }
                });
            }


        }

    });
//    

});





