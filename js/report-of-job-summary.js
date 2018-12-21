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
                    option: 'GETINVOICESBYSTARTANDENDDATE'
                },
                success: function (invoices) {

                    callLoader();
                    var html;
                    if (invoices) {
                        $.each(invoices, function (key, invoice) {

                            var grossprofit, gross, serviceincome, vat, nbt, invoiceamount, agency_fees, documentation, invoiceCreatedAt, invoiceNumber;

                            if (parseFloat(invoice.payableAmount) >= parseFloat(invoice.grandTotal)) {
                                gross = parseFloat(invoice.payableAmount) - parseFloat(invoice.grandTotal);
                                grossprofit = new Intl.NumberFormat().format(gross);
                            } else {
                                gross = parseFloat(invoice.grandTotal) - parseFloat(invoice.payableAmount);
                                grossprofit = '(' + new Intl.NumberFormat().format(gross) + ')';
                            }

                            if (invoice.payableAmount === undefined) {
                                invoiceamount = 0;
                            } else {
                                invoiceamount = new Intl.NumberFormat().format(invoice.payableAmount);
                            }
                            if (isNaN(gross)) {
                                grossprofit = 0;
                            } else {
                                grossprofit = grossprofit;
                            }

                            if (invoice.agencyFees === undefined || !invoice.agencyFees) {
                                agency_fees = 0;
                            } else {
                                agency_fees = invoice.agencyFees;
                            }
                            if (invoice.documentation === undefined || !invoice.documentation) {
                                documentation = 0;
                            } else {
                                documentation = invoice.documentation;
                            }

                            if (!invoice.invoiceCreatedAt) {
                                invoiceCreatedAt = '-';
                            } else {
                                invoiceCreatedAt = invoice.invoiceCreatedAt;
                            }
                            if (!invoice.invoiceNumber) {
                                invoiceNumber = '-';
                            } else {
                                invoiceNumber = invoice.invoiceNumber;
                            }

                            serviceincome = parseFloat(agency_fees) + parseFloat(documentation);
                            vat = serviceincome * 15 / 100;
                            nbt = serviceincome * 2 / 100;

                            var jobno = invoice.jobReferenceNo;

                            var i = parseInt(key) + 1

                            html += '<tr>\n\
                            <td>' + i + '</td>\n\
                            <td>' + invoiceCreatedAt + '</td>\n\
                            <td>' + invoiceNumber.substring(15, 19) + '</td>\n\
                            <td>' + jobno.substring(15, 19) + '</td>\n\
                            <td>' + invoice.consignee + '</td>\n\
                            <td>' + invoice.vatno + '</td>\n\
                            <td>' + invoice.consignment + '</td>\n\
                            <td class="text-right">' + invoiceamount + '</td>\n\
                            <td class="text-right">' + new Intl.NumberFormat().format(invoice.grandTotal) + '</td>\n\
                            <td class="text-right">' + grossprofit + '</td>\n\
                            <td class="text-right">' + serviceincome + '</td>\n\
                            <td class="text-right">' + vat + '</td>\n\
                            <td class="text-right">' + nbt + '</td>\n\
                            </tr>';


                            $("#balance tbody").empty();
                            $("#balance tbody").append(html);
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
                option: 'GETINVOICESBYSTARTANDENDDATE'
            },
            success: function (invoices) {
                callLoader();
                var html;
                if (invoices) {
                    $.each(invoices, function (key, invoice) {

                        var grossprofit, gross, serviceincome, vat, nbt, invoiceamount, agency_fees, documentation, invoiceCreatedAt, invoiceNumber;

                        if (parseFloat(invoice.payableAmount) >= parseFloat(invoice.grandTotal)) {
                            gross = parseFloat(invoice.payableAmount) - parseFloat(invoice.grandTotal);
                            grossprofit = new Intl.NumberFormat().format(gross);
                        } else {
                            gross = parseFloat(invoice.grandTotal) - parseFloat(invoice.payableAmount);
                            grossprofit = '(' + new Intl.NumberFormat().format(gross) + ')';
                        }

                        if (invoice.payableAmount === undefined) {
                            invoiceamount = 0;
                        } else {
                            invoiceamount = new Intl.NumberFormat().format(invoice.payableAmount);
                        }
                        if (isNaN(gross)) {
                            grossprofit = 0;
                        } else {
                            grossprofit = grossprofit;
                        }

                        if (invoice.agencyFees === undefined || !invoice.agencyFees) {
                            agency_fees = 0;
                        } else {
                            agency_fees = invoice.agencyFees;
                        }
                        if (invoice.documentation === undefined || !invoice.documentation) {
                            documentation = 0;
                        } else {
                            documentation = invoice.documentation;
                        }

                        if (!invoice.invoiceCreatedAt) {
                            invoiceCreatedAt = '-';
                        } else {
                            invoiceCreatedAt = invoice.invoiceCreatedAt;
                        }
                        if (!invoice.invoiceNumber) {
                            invoiceNumber = '-';
                        } else {
                            invoiceNumber = invoice.invoiceNumber;
                        }

                        serviceincome = parseFloat(agency_fees) + parseFloat(documentation);
                        vat = serviceincome * 15 / 100;
                        nbt = serviceincome * 2 / 100;
                        var jobno = invoice.jobReferenceNo;
                        var i = parseInt(key) + 1

                        html += '<tr>\n\
                            <td>' + i + '</td>\n\
                            <td>' + invoiceCreatedAt + '</td>\n\
                            <td>' + invoiceNumber.substring(15, 19) + '</td>\n\
                            <td>' + jobno.substring(15, 19) + '</td>\n\
                            <td>' + invoice.consignee + '</td>\n\
                            <td>' + invoice.vatno + '</td>\n\
                            <td>' + invoice.consignment + '</td>\n\
                            <td class="text-right">' + invoiceamount + '</td>\n\
                            <td class="text-right">' + new Intl.NumberFormat().format(invoice.grandTotal) + '</td>\n\
                            <td class="text-right">' + grossprofit + '</td>\n\
                            <td class="text-right">' + serviceincome + '</td>\n\
                            <td class="text-right">' + vat + '</td>\n\
                            <td class="text-right">' + nbt + '</td>\n\
                            </tr>';


                        $("#balance tbody").empty();
                        $("#balance tbody").append(html);
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
                option: 'GETINVOICESBYSTARTANDENDDATE'
            },
            success: function (invoices) {
                callLoader();
                var html;
                if (invoices) {
                    $.each(invoices, function (key, invoice) {

                        var grossprofit, gross, serviceincome, vat, nbt, invoiceamount, agency_fees, documentation, invoiceCreatedAt, invoiceNumber;

                        if (parseFloat(invoice.payableAmount) >= parseFloat(invoice.grandTotal)) {
                            gross = parseFloat(invoice.payableAmount) - parseFloat(invoice.grandTotal);
                            grossprofit = new Intl.NumberFormat().format(gross);
                        } else {
                            gross = parseFloat(invoice.grandTotal) - parseFloat(invoice.payableAmount);
                            grossprofit = '(' + new Intl.NumberFormat().format(gross) + ')';
                        }

                        if (invoice.payableAmount === undefined) {
                            invoiceamount = 0;
                        } else {
                            invoiceamount = new Intl.NumberFormat().format(invoice.payableAmount);
                        }
                        if (isNaN(gross)) {
                            grossprofit = 0;
                        } else {
                            grossprofit = grossprofit;
                        }

                        if (invoice.agencyFees === undefined || !invoice.agencyFees) {
                            agency_fees = 0;
                        } else {
                            agency_fees = invoice.agencyFees;
                        }
                        if (invoice.documentation === undefined || !invoice.documentation) {
                            documentation = 0;
                        } else {
                            documentation = invoice.documentation;
                        }

                        if (!invoice.invoiceCreatedAt) {
                            invoiceCreatedAt = '-';
                        } else {
                            invoiceCreatedAt = invoice.invoiceCreatedAt;
                        }
                        if (!invoice.invoiceNumber) {
                            invoiceNumber = '-';
                        } else {
                            invoiceNumber = invoice.invoiceNumber;
                        }

                        serviceincome = parseFloat(agency_fees) + parseFloat(documentation);
                        vat = serviceincome * 15 / 100;
                        nbt = serviceincome * 2 / 100;
                        var jobno = invoice.jobReferenceNo;
                        var i = parseInt(key) + 1

                        html += '<tr>\n\
                            <td>' + i + '</td>\n\
                            <td>' + invoiceCreatedAt + '</td>\n\
                            <td>' + invoiceNumber.substring(15, 19) + '</td>\n\
                            <td>' + jobno.substring(15, 19) + '</td>\n\
                            <td>' + invoice.consignee + '</td>\n\
                            <td>' + invoice.vatno + '</td>\n\
                            <td>' + invoice.consignment + '</td>\n\
                            <td class="text-right">' + invoiceamount + '</td>\n\
                            <td class="text-right">' + new Intl.NumberFormat().format(invoice.grandTotal) + '</td>\n\
                            <td class="text-right">' + grossprofit + '</td>\n\
                            <td class="text-right">' + serviceincome + '</td>\n\
                            <td class="text-right">' + vat + '</td>\n\
                            <td class="text-right">' + nbt + '</td>\n\
                            </tr>';


                        $("#balance tbody").empty();
                        $("#balance tbody").append(html);
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


