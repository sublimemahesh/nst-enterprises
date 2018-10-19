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
                            fill: true,
                            borderColor: 'rgba(0,0,255,0.8)',
                            backgroundColor: 'rgba(0,0,255,0.3)',
                            borderWidth: 3
                        },
                        {
                            label: 'Sum of Gross Profit',
                            data: grossprofit,
                            fill: true,
                            borderColor: 'rgba(255, 0, 0, 0.8)',
                            backgroundColor: 'rgba(255, 0, 0, 0.3)',
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