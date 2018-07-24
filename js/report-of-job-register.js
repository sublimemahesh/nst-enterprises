$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: 'ajax/report-of-job-register.php',
        dataType: "json",
        data: {
            option: 'GETSTARTANDENDDATE'
        },
        success: function (result) {
            $("#from").val(result.start_date);
            $("#to").val(result.end_date);
            $.ajax({
                type: 'POST',
                url: 'ajax/report-of-job-register.php',
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
                                url: 'ajax/report-of-job-register.php',
                                dataType: "json",
                                data: {
                                    consignee: job.consignee,
                                    option: 'GETCONSIGNEE'
                                },
                                success: function (consignee) {

                                    $.ajax({
                                        type: 'POST',
                                        url: 'ajax/report-of-job-register.php',
                                        dataType: "json",
                                        data: {
                                            vesselorflight: job.vesselAndFlight,
                                            option: 'GETVESSELORFLIGHT'
                                        },
                                        success: function (vesselorflight) {

                                            $.ajax({
                                                type: 'POST',
                                                url: 'ajax/report-of-job-register.php',
                                                dataType: "json",
                                                data: {
                                                    job: job.id,
                                                    option: 'GETINVOICE'
                                                },
                                                success: function (invoice) {


                                                    html += '<tr>\n\
                                                    <td>' + job.id + '</td>\n\
                                                    <td>' + consignee.name + '</td>\n\
                                                    <td>' + job.description + '</td>\n\
                                                    <td>' + vesselorflight.name + '</td>\n\
                                                    <td>' + job.vesselAndFlightDate + '</td>\n\
                                                    <td>' + job.copyReceivedDate + '</td>\n\
                                                    <td>' + job.originalReceivedDate + '</td>\n\
                                                    <td>' + invoice.invoiceNumber + '</td>\n\
                                                    <td>' + job.cusdecDate + '</td>\n\
                                                    </tr>'


                                                    $("#balance tbody").empty();
                                                    $("#balance tbody").append(html);
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
        var from = $("#from").val();
        var to = $("#to").val();
        callLoader();
        $.ajax({
            type: 'POST',
            url: 'ajax/report-of-job-register.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETJOBSBYSTARTANDENDDATE'
            },
            success: function (jobs) {

                var html;
                if (jobs.length != 0) {
                    $.each(jobs, function (key, job) {

                        $.ajax({
                            type: 'POST',
                            url: 'ajax/report-of-job-register.php',
                            dataType: "json",
                            data: {
                                consignee: job.consignee,
                                option: 'GETCONSIGNEE'
                            },
                            success: function (consignee) {

                                $.ajax({
                                    type: 'POST',
                                    url: 'ajax/report-of-job-register.php',
                                    dataType: "json",
                                    data: {
                                        vesselorflight: job.vesselAndFlight,
                                        option: 'GETVESSELORFLIGHT'
                                    },
                                    success: function (vesselorflight) {

                                        $.ajax({
                                            type: 'POST',
                                            url: 'ajax/report-of-job-register.php',
                                            dataType: "json",
                                            data: {
                                                job: job.id,
                                                option: 'GETINVOICE'
                                            },
                                            success: function (invoice) {


                                                html += '<tr>\n\
                                                    <td>' + job.id + '</td>\n\
                                                    <td>' + consignee.name + '</td>\n\
                                                    <td>' + job.description + '</td>\n\
                                                    <td>' + vesselorflight.name + '</td>\n\
                                                    <td>' + job.vesselAndFlightDate + '</td>\n\
                                                    <td>' + job.copyReceivedDate + '</td>\n\
                                                    <td>' + job.originalReceivedDate + '</td>\n\
                                                    <td>' + invoice.invoiceNumber + '</td>\n\
                                                    <td>' + job.cusdecDate + '</td>\n\
                                                    </tr>'


                                                $("#balance tbody").empty();
                                                $("#balance tbody").append(html);
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                } else {
                    var html = 'No any jobs in database';
                    $("#balance tbody").empty();
                    $("#balance tbody").append(html);
                }
            }

        });
    });

    $("#to").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        callLoader();
        $.ajax({
            type: 'POST',
            url: 'ajax/report-of-job-register.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETJOBSBYSTARTANDENDDATE'
            },
            success: function (jobs) {

                var html;
                if (jobs.length != 0) {
                    $.each(jobs, function (key, job) {

                        $.ajax({
                            type: 'POST',
                            url: 'ajax/report-of-job-register.php',
                            dataType: "json",
                            data: {
                                consignee: job.consignee,
                                option: 'GETCONSIGNEE'
                            },
                            success: function (consignee) {

                                $.ajax({
                                    type: 'POST',
                                    url: 'ajax/report-of-job-register.php',
                                    dataType: "json",
                                    data: {
                                        vesselorflight: job.vesselAndFlight,
                                        option: 'GETVESSELORFLIGHT'
                                    },
                                    success: function (vesselorflight) {

                                        $.ajax({
                                            type: 'POST',
                                            url: 'ajax/report-of-job-register.php',
                                            dataType: "json",
                                            data: {
                                                job: job.id,
                                                option: 'GETINVOICE'
                                            },
                                            success: function (invoice) {


                                                html += '<tr>\n\
                                                    <td>' + job.id + '</td>\n\
                                                    <td>' + consignee.name + '</td>\n\
                                                    <td>' + job.description + '</td>\n\
                                                    <td>' + vesselorflight.name + '</td>\n\
                                                    <td>' + job.vesselAndFlightDate + '</td>\n\
                                                    <td>' + job.copyReceivedDate + '</td>\n\
                                                    <td>' + job.originalReceivedDate + '</td>\n\
                                                    <td>' + invoice.invoiceNumber + '</td>\n\
                                                    <td>' + job.cusdecDate + '</td>\n\
                                                    </tr>'


                                                $("#balance tbody").empty();
                                                $("#balance tbody").append(html);
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    });
                } else {
                    var html = 'No any jobs in database';
                    $("#balance tbody").empty();
                    $("#balance tbody").append(html);
                }
            }

        });
    });

    $("#print-btn").click(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        window.location.replace("report-of-job-register.php?from=" + from + "&to=" + to);
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
    };

});


