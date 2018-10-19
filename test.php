<?php
include_once(dirname(__FILE__) . '/class/include.php');
//date_default_timezone_set('Asia/Colombo');
//$year = date('Y');
//$lastmonth = $year - 1;
//dd($lastmonth);
//$invoice = Invoice::getInvoiceByToday($today);
?>

<html>
    <head>
        <style>

        </style>

    </head>
    <body>
        <canvas id="myChart" width="10" height="10"></canvas>
        <!--<input type="hidden" id="lastmonth" value="<?php echo $lastmonth; ?>" >-->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $.ajax({
                    type: 'POST',
                    url: 'ajax/invoice.php',
                    dataType: "json",
                    data: {option: 'GETCHARTDATA'},
                    success: function (results) {
                        var date = [];
                        var payableamount = [];
                        var grossprofit = [];
                        $.each(results, function (key, result) {
                            date.push(result.date);
                            payableamount.push(result.sum);
                            grossprofit.push(result.grossprofit);

                        });
                        var ctx = document.getElementById("myChart").getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: date,
                                datasets: [{
                                        label: 'Sum of Invoice Amount',
                                        data: payableamount,
                                        fill: false,
                                        borderColor: 'rgba(0,255,0,0.8)',
                                        borderWidth: 3
                                    },
                                    {
                                        label: 'Sum of Gross Profit',
                                        data: grossprofit,
                                        fill: false,
                                        borderColor: 'rgba(255, 0, 0, 0.8)',
                                        borderWidth: 3
                                    }]
                            },
                            options: {
                                tooltips: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                hover: {
                                    mode: 'nearest',
                                    intersect: true
                                },
                                scales: {
                                    yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                },
                            }
                        });
                    }
                });
            });

        </script>




        <script>

        </script>

    </body>
</html>