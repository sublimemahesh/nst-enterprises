$(document).ready(function () {

    $.ajax({
        type: 'POST',
        url: 'ajax/report-of-job-summary.php',
        dataType: "json",
        data: {
            option: 'GETSTARTANDENDDATE'
        },
        success: function (result) {

            $("#from").val(result.start_date);
            $("#to").val(result.end_date);
            $.ajax({
                type: 'POST',
                url: 'ajax/report-of-job-summary.php',
                dataType: "json",
                data: {
                    from: result.start_date,
                    to: result.end_date,
                    option: 'GETJOBSBYSTARTANDENDDATE'
                },
                success: function (jobs) {
                    callLoader();
                    var html;
                    if (jobs) {
                        $.each(jobs, function (key, job) {

                            $.ajax({
                                type: 'POST',
                                url: 'ajax/report-of-job-summary.php',
                                dataType: "json",
                                data: {
                                    consignee: job.consignee,
                                    option: 'GETCONSIGNEE'
                                },
                                success: function (consignee) {

                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax/report-of-job-summary.php',
                                        dataType: "json",
                                        data: {
                                            consignment: job.consignment,
                                            option: 'GETCONSIGNMENT'
                                        },
                                        success: function (consignment) {

                                            $.ajax({
                                                type: 'POST',
                                                url: 'ajax/report-of-job-summary.php',
                                                dataType: "json",
                                                data: {
                                                    job: job.id,
                                                    option: 'GETJOBCOSTINGCARD'
                                                },
                                                success: function (jobcostingcard) {


                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'ajax/report-of-job-summary.php',
                                                        dataType: "json",
                                                        data: {
                                                            jobcostingcard: jobcostingcard.id,
                                                            option: 'GETINVOICE'
                                                        },
                                                        success: function (invoice) {
                                                            console.log(invoice);
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'ajax/report-of-job-summary.php',
                                                                dataType: "json",
                                                                data: {
                                                                    jobcostingcard: jobcostingcard.id,
                                                                    option: 'GETCOSTINGAMOUNT'
                                                                },
                                                                success: function (costingamount) {
                                                                    var grossprofit, gross, serviceincome, vat, nbt, invoiceamount, agency_fees, documentation;

                                                                    if (parseFloat(invoice.payable_amount) >= parseFloat(costingamount.grandtotal)) {
                                                                        gross = parseFloat(invoice.payable_amount) - parseFloat(costingamount.grandtotal);
                                                                        grossprofit = new Intl.NumberFormat().format(gross);
                                                                    } else {
                                                                        gross = parseFloat(costingamount.grandtotal) - parseFloat(invoice.payable_amount);
                                                                        grossprofit = '(' + new Intl.NumberFormat().format(gross) + ')';
                                                                    }



                                                                    

                                                                    if (invoice.payable_amount === undefined) {
                                                                        invoiceamount = 0;
                                                                    } else {
                                                                        invoiceamount = new Intl.NumberFormat().format(invoice.payable_amount);
                                                                    }
                                                                    if (isNaN(gross)) {
                                                                        grossprofit = 0;
                                                                    } else {
                                                                        grossprofit = grossprofit;
                                                                    }
                                                                    
                                                                    if (invoice.agency_fees === undefined) {
                                                                        agency_fees = 0;
                                                                    } else {
                                                                        agency_fees = invoice.agency_fees;
                                                                    }
                                                                    if (invoice.documentation === undefined) {
                                                                        documentation = 0;
                                                                    } else {
                                                                        documentation = invoice.documentation;
                                                                    }
                                                                    
                                                                    serviceincome = parseFloat(agency_fees) + parseFloat(documentation);
                                                                    vat = serviceincome * 15 / 100;
                                                                    nbt = serviceincome * 2 / 100;

                                                                    var i = parseInt(key) + 1

                                                                    html += '<tr>\n\
                                                                    <td>' + i + '</td>\n\
                                                                    <td>' + invoice.createdAt + '</td>\n\
                                                                    <td>' + jobcostingcard.invoiceNumber + '</td>\n\
                                                                    <td>' + job.reference_no + '</td>\n\
                                                                    <td>' + consignee.name + '</td>\n\
                                                                    <td>' + consignee.vatNumber + '</td>\n\
                                                                    <td>' + consignment.name + '</td>\n\
                                                                    <td class="text-right">' + invoiceamount + '</td>\n\
                                                                    <td class="text-right">' + new Intl.NumberFormat().format(costingamount.grandtotal) + '</td>\n\
                                                                    <td class="text-right">' + grossprofit + '</td>\n\
                                                                    <td class="text-right">' + serviceincome + '</td>\n\
                                                                    <td class="text-right">' + vat + '</td>\n\
                                                                    <td class="text-right">' + nbt + '</td>\n\
                                                                    </tr>';


                                                                    $("#balance tbody").empty();
                                                                    $("#balance tbody").append(html);
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        });
                    } else {
                        html = 'No any jobs in database';
                        $("#balance tbody").empty();
                        $("#balance tbody").append(html);
                    }
                }

            });
        }
    });

    $("#from").change(function () {
        $("#balance tbody").empty();
        var from = $("#from").val();
        var to = $("#to").val();
        callLoader();
        $.ajax({
            type: 'POST',
            url: 'ajax/report-of-job-summary.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETJOBSBYSTARTANDENDDATE'
            },
            success: function (jobs) {
                callLoader();
                var html;
                if (jobs) {
                    $.each(jobs, function (key, job) {

                        $.ajax({
                            type: 'POST',
                            url: 'ajax/report-of-job-summary.php',
                            dataType: "json",
                            data: {
                                consignee: job.consignee,
                                option: 'GETCONSIGNEE'
                            },
                            success: function (consignee) {

                                $.ajax({
                                    type: 'POST',
                                    url: 'ajax/report-of-job-summary.php',
                                    dataType: "json",
                                    data: {
                                        consignment: job.consignment,
                                        option: 'GETCONSIGNMENT'
                                    },
                                    success: function (consignment) {

                                        $.ajax({
                                            type: 'POST',
                                            url: 'ajax/report-of-job-summary.php',
                                            dataType: "json",
                                            data: {
                                                job: job.id,
                                                option: 'GETJOBCOSTINGCARD'
                                            },
                                            success: function (jobcostingcard) {


                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'ajax/report-of-job-summary.php',
                                                    dataType: "json",
                                                    data: {
                                                        jobcostingcard: jobcostingcard.id,
                                                        option: 'GETINVOICE'
                                                    },
                                                    success: function (invoice) {

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'ajax/report-of-job-summary.php',
                                                            dataType: "json",
                                                            data: {
                                                                jobcostingcard: jobcostingcard.id,
                                                                option: 'GETCOSTINGAMOUNT'
                                                            },
                                                            success: function (costingamount) {
                                                                var grossprofit;
                                                                var gross;
                                                                if (parseFloat(invoice.payable_amount) >= parseFloat(costingamount.grandtotal)) {
                                                                    gross = parseFloat(invoice.payable_amount) - parseFloat(costingamount.grandtotal);
                                                                    grossprofit = new Intl.NumberFormat().format(gross);
                                                                } else {
                                                                    gross = parseFloat(costingamount.grandtotal) - parseFloat(invoice.payable_amount);
                                                                    grossprofit = '(' + new Intl.NumberFormat().format(gross) + ')';
                                                                }

                                                                var i = parseInt(key) + 1

                                                                html += '<tr>\n\
                                                                    <td>' + i + '</td>\n\
                                                                    <td>' + invoice.createdAt + '</td>\n\
                                                                    <td>' + jobcostingcard.invoiceNumber + '</td>\n\
                                                                    <td>' + job.reference_no + '</td>\n\
                                                                    <td>' + consignee.name + '</td>\n\
                                                                    <td>' + consignee.vatNumber + '</td>\n\
                                                                    <td>' + consignment.name + '</td>\n\
                                                                    <td class="text-right">' + new Intl.NumberFormat().format(invoice.payable_amount) + '</td>\n\
                                                                    <td class="text-right">' + new Intl.NumberFormat().format(costingamount.grandtotal) + '</td>\n\
                                                                    <td class="text-right">' + grossprofit + '</td>\n\
                                                                    </tr>';
                                                                $("#balance tbody").empty();
                                                                $("#balance tbody").append(html);
                                                            }
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                } else {
                    html = 'No any jobs in database';
                    $("#balance tbody").empty();
                    $("#balance tbody").append(html);
                }
            }

        });
    });

    $("#to").change(function () {
        $("#balance tbody").empty();
        var from = $("#from").val();
        var to = $("#to").val();

        callLoader();
        $.ajax({
            type: 'POST',
            url: 'ajax/report-of-job-summary.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETJOBSBYSTARTANDENDDATE'
            },
            success: function (jobs) {
                callLoader();
                var html;
                if (jobs) {
                    $.each(jobs, function (key, job) {

                        $.ajax({
                            type: 'POST',
                            url: 'ajax/report-of-job-summary.php',
                            dataType: "json",
                            data: {
                                consignee: job.consignee,
                                option: 'GETCONSIGNEE'
                            },
                            success: function (consignee) {

                                $.ajax({
                                    type: 'POST',
                                    url: 'ajax/report-of-job-summary.php',
                                    dataType: "json",
                                    data: {
                                        consignment: job.consignment,
                                        option: 'GETCONSIGNMENT'
                                    },
                                    success: function (consignment) {

                                        $.ajax({
                                            type: 'POST',
                                            url: 'ajax/report-of-job-summary.php',
                                            dataType: "json",
                                            data: {
                                                job: job.id,
                                                option: 'GETJOBCOSTINGCARD'
                                            },
                                            success: function (jobcostingcard) {


                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'ajax/report-of-job-summary.php',
                                                    dataType: "json",
                                                    data: {
                                                        jobcostingcard: jobcostingcard.id,
                                                        option: 'GETINVOICE'
                                                    },
                                                    success: function (invoice) {

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'ajax/report-of-job-summary.php',
                                                            dataType: "json",
                                                            data: {
                                                                jobcostingcard: jobcostingcard.id,
                                                                option: 'GETCOSTINGAMOUNT'
                                                            },
                                                            success: function (costingamount) {
                                                                var grossprofit;
                                                                var gross;
                                                                if (parseFloat(invoice.payable_amount) >= parseFloat(costingamount.grandtotal)) {
                                                                    gross = parseFloat(invoice.payable_amount) - parseFloat(costingamount.grandtotal);
                                                                    grossprofit = new Intl.NumberFormat().format(gross);
                                                                } else {
                                                                    gross = parseFloat(costingamount.grandtotal) - parseFloat(invoice.payable_amount);
                                                                    grossprofit = '(' + new Intl.NumberFormat().format(gross) + ')';
                                                                }

                                                                var i = parseInt(key) + 1

                                                                html += '<tr>\n\
                                                                    <td>' + i + '</td>\n\
                                                                    <td>' + invoice.createdAt + '</td>\n\
                                                                    <td>' + jobcostingcard.invoiceNumber + '</td>\n\
                                                                    <td>' + job.reference_no + '</td>\n\
                                                                    <td>' + consignee.name + '</td>\n\
                                                                    <td>' + consignee.vatNumber + '</td>\n\
                                                                    <td>' + consignment.name + '</td>\n\
                                                                    <td class="text-right">' + new Intl.NumberFormat().format(invoice.payable_amount) + '</td>\n\
                                                                    <td class="text-right">' + new Intl.NumberFormat().format(costingamount.grandtotal) + '</td>\n\
                                                                    <td class="text-right">' + grossprofit + '</td>\n\
                                                                    </tr>';


                                                                $("#balance tbody").empty();
                                                                $("#balance tbody").append(html);
                                                            }
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                } else {
                    html = 'No any jobs in database';
                    $("#balance tbody").empty();
                    $("#balance tbody").append(html);
                }
            }

        });
    });

    $("#print-btn").click(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        window.location.replace("report-of-job-summary.php?from=" + from + "&to=" + to);
    });

    function callLoader() {
        $.loadingBlockShow({
            imgPath: 'plugins/loader/img/default.svg',
            style: {
                position: 'fixed',
                width: '100%',
                height: '100%',
                background: 'rgba(0, 0, 0, .6)',
                left: 0,
                top: 0,
                zIndex: 10000
            }
        });

        setTimeout($.loadingBlockHide, 5000);
    }
    ;

});


