$(document).ready(function () {
    var no_of_rows = $('#balance').find('tbody tr').length;
    var balance = 0;
    var prev_balance = 0;
    var status;
    var balance1;

    var i;
    for (i = 1; i <= no_of_rows; i++) {
        var due = $("#due_" + i).attr("due");
        var refund = $("#refund_" + i).attr("refund");
        var settle = $("#settle_" + i).attr("settle");

        if (i === 1) {
            if (due == 0) {
                balance = refund;
                balance1 = new Intl.NumberFormat().format(balance);
                $("#balance_" + i).attr("balance", balance);
                $("#balance_" + i).html('(' + balance1 + ')');
                $("#balance_" + i).attr("status", "refund");
            } else {
                balance = due - parseFloat(settle);
                balance1 = new Intl.NumberFormat().format(balance);
                $("#balance_" + i).attr("balance", balance);
                $("#balance_" + i).html(balance1);
                $("#balance_" + i).attr("status", "due");
            }
        } else {
            prev_balance = $("#balance_" + (i - 1)).attr("balance");
            status = $("#balance_" + (i - 1)).attr("status");

            if (due == 0) {
                if (status === 'refund') {
                    balance = parseFloat(prev_balance) + parseFloat(refund);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html('(' + balance1 + ')');
                    $("#balance_" + i).attr("status", "refund");
                } else if (status === 'due') {
                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                        balance = parseFloat(prev_balance) - parseFloat(refund);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");
                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                        balance = parseFloat(refund) - parseFloat(prev_balance);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");
                    }

                }



            } else {
                if (status === 'refund') {
                    if (parseFloat(prev_balance) > parseFloat(due)) {
                        balance = parseFloat(prev_balance) - parseFloat(due) - parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");
                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
                        balance = parseFloat(due) - parseFloat(prev_balance) - parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");
                    }
                } else if (status === 'due') {
                    balance = parseFloat(prev_balance) + parseFloat(due) - parseFloat(settle);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html(balance1);
                    $("#balance_" + i).attr("status", "due");

                }
            }
        }



    }


    $(".settle1").change(function () {
        var rowid = $(this).attr('rowid');
        var balance = $('#balance_' + rowid).attr('balance');
        var settle = $(this).val();
        var prev_settle = $(this).attr('settle');
        var balance1;


        if (prev_settle > settle) {
            var prev_rowid = parseInt(rowid) - 1;
            var prev_row_balance = $('#balance_' + prev_rowid).attr('balance');

            if (prev_row_balance === 0) {
                var due = $("#due_" + rowid).attr("due");
                var refund = $("#refund_" + rowid).attr("refund");


//                    if (refund == 0) {
//                        balance = refund;
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html('(' + balance1 + ')');
//                        $("#balance_" + i).attr("status", "refund");
//                    } else {
//                        balance = due - parseFloat(settle);
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html(balance1);
//                        $("#balance_" + i).attr("status", "due");
//                    }

            }

        }

        var amount = parseFloat(balance) - parseFloat(settle);
        var amount1 = new Intl.NumberFormat().format(amount);
        $('#balance_' + rowid).attr('balance', amount);
        $('#balance_' + rowid).html(amount1);

        var new_rowid = parseInt(rowid) + 1;

        var i;
        for (i = new_rowid; i <= no_of_rows; i++) {
            var due = $("#due_" + i).attr("due");
            var refund = $("#refund_" + i).attr("refund");

            prev_balance = $("#balance_" + (i - 1)).attr("balance");
            status = $("#balance_" + (i - 1)).attr("status");

            if (due == 0) {
                if (status === 'refund') {
                    balance = parseFloat(prev_balance) + parseFloat(refund);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html('(' + balance1 + ')');
                    $("#balance_" + i).attr("status", "refund");
                } else if (status === 'due') {
                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                        balance = parseFloat(prev_balance) - parseFloat(refund);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");
                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                        balance = parseFloat(refund) - parseFloat(prev_balance);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");
                    }

                }



            } else {
                if (status === 'refund') {
                    if (parseFloat(prev_balance) > parseFloat(due)) {
                        balance = parseFloat(prev_balance) - parseFloat(due);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance + ')');
                        $("#balance_" + i).attr("status", "refund");
                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
                        balance = parseFloat(due) - parseFloat(prev_balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance);
                        $("#balance_" + i).attr("status", "due");
                    }
                } else if (status === 'due') {
                    balance = parseFloat(prev_balance) + parseFloat(due);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html(balance);
                    $("#balance_" + i).attr("status", "due");

                }
            }




        }

    });

    $(".settle").change(function () {
        var rowid = $(this).attr('rowid');
        var balance = $('#balance_' + rowid).attr('balance');
        var settle = $(this).val();
        var prev_settle = $(this).attr('settle');
        var prev_rowid = parseInt(rowid) - 1;
        var new_rowid = parseInt(rowid) + 1;
        var due = $("#due_" + rowid).attr("due");
        var refund = $("#refund_" + rowid).attr("refund");
        var new_balance;
        var new_balance1;

        if (settle > prev_settle) {
            if (prev_rowid > 0) {


                if (parseFloat(balance) >= parseFloat(settle)) {
                    new_balance = parseFloat(balance) - parseFloat(settle);
                    new_balance1 = new Intl.NumberFormat().format(new_balance);
                    $('#balance_' + rowid).attr('balance', new_balance);
                    $('#balance_' + rowid).html(new_balance1);

                    if (new_balance === 0) {
                        $('#balance_' + rowid).attr('status', 'settle');
                    } else {
                        $('#balance_' + rowid).attr('status', 'due');
                    }

                    var i;
                    for (i = new_rowid; i <= no_of_rows; i++) {

                        var due = $("#due_" + i).attr("due");
                        var refund = $("#refund_" + i).attr("refund");

                        prev_balance = $("#balance_" + (i - 1)).attr("balance");
                        status = $("#balance_" + (i - 1)).attr("status");

                        if (due == 0) {
                            if (status === 'refund') {
                                balance = parseFloat(prev_balance) + parseFloat(refund);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");
                            } else if (status === 'due') {
                                if (parseFloat(prev_balance) > parseFloat(refund)) {
                                    balance = parseFloat(prev_balance) - parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                    balance = parseFloat(refund) - parseFloat(prev_balance);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }

                            } else if (status === 'settle') {
                                balance = parseFloat(refund);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");
                            }



                        } else {
                            if (status === 'refund') {
                                if (parseFloat(prev_balance) > parseFloat(due)) {
                                    balance = parseFloat(prev_balance) - parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                    balance = parseFloat(due) - parseFloat(prev_balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            } else if (status === 'due') {
                                balance = parseFloat(prev_balance) + parseFloat(due);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance);
                                $("#balance_" + i).attr("status", "due");

                            } else if (status === 'settle') {
                                balance = parseFloat(due);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance1);
                                $("#balance_" + i).attr("status", "due");
                            }
                        }




                    }

                } else {
                    new_balance = parseFloat(settle) - parseFloat(balance);

                    new_balance1 = new Intl.NumberFormat().format(new_balance);
                    $('#balance_' + rowid).attr('balance', new_balance);
                    $('#balance_' + rowid).html('(' + new_balance1 + ')');
                    $('#balance_' + rowid).attr('status', 'refund');
                }

                var i;
                for (i = new_rowid; i <= no_of_rows; i++) {

                    var due = $("#due_" + i).attr("due");
                    var refund = $("#refund_" + i).attr("refund");

                    prev_balance = $("#balance_" + (i - 1)).attr("balance");
                    status = $("#balance_" + (i - 1)).attr("status");

                    if (due == 0) {
                        if (status === 'refund') {
                            balance = parseFloat(prev_balance) + parseFloat(refund);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");
                        } else if (status === 'due') {
                            if (parseFloat(prev_balance) > parseFloat(refund)) {
                                balance = parseFloat(prev_balance) - parseFloat(refund);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance1);
                                $("#balance_" + i).attr("status", "due");
                            } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                balance = parseFloat(refund) - parseFloat(prev_balance);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");
                            }

                        } else if (status === 'settle') {
                            balance = parseFloat(refund);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");
                        }



                    } else {
                        if (status === 'refund') {
                            if (parseFloat(prev_balance) > parseFloat(due)) {
                                balance = parseFloat(prev_balance) - parseFloat(due);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance + ')');
                                $("#balance_" + i).attr("status", "refund");
                            } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                balance = parseFloat(due) - parseFloat(prev_balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance);
                                $("#balance_" + i).attr("status", "due");
                            }
                        } else if (status === 'due') {
                            balance = parseFloat(prev_balance) + parseFloat(due);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance);
                            $("#balance_" + i).attr("status", "due");

                        } else if (status === 'settle') {
                            balance = parseFloat(due);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");
                        }
                    }




                }

            } else {
                if (due === 0) {
                    new_balance = parseFloat(refund) + parseFloat(settle);

                    new_balance1 = new Intl.NumberFormat().format(new_balance);
                    $('#balance_' + rowid).attr('balance', new_balance);
                    $('#balance_' + rowid).html(new_balance1);

                    $('#balance_' + rowid).attr('status', 'refund');

                    var i;
                    for (i = new_rowid; i <= no_of_rows; i++) {
                        var due = $("#due_" + i).attr("due");
                        var refund = $("#refund_" + i).attr("refund");

                        prev_balance = $("#balance_" + (i - 1)).attr("balance");
                        status = $("#balance_" + (i - 1)).attr("status");

                        if (due == 0) {
                            if (status === 'refund') {
                                balance = parseFloat(prev_balance) + parseFloat(refund);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");
                            } else if (status === 'due') {
                                if (parseFloat(prev_balance) > parseFloat(refund)) {
                                    balance = parseFloat(prev_balance) - parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                    balance = parseFloat(refund) - parseFloat(prev_balance);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }

                            }



                        } else {
                            if (status === 'refund') {
                                if (parseFloat(prev_balance) > parseFloat(due)) {
                                    balance = parseFloat(prev_balance) - parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                    balance = parseFloat(due) - parseFloat(prev_balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            } else if (status === 'due') {
                                balance = parseFloat(prev_balance) + parseFloat(due);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance);
                                $("#balance_" + i).attr("status", "due");

                            }
                        }




                    }


                } else {
                    if (due >= settle) {
                        new_balance = parseFloat(due) - parseFloat(settle);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html(new_balance1);

                        if (new_balance === 0) {
                            $('#balance_' + rowid).attr('status', 'settle');
                        } else {
                            $('#balance_' + rowid).attr('status', 'due');
                        }

                        var i;
                        for (i = new_rowid; i <= no_of_rows; i++) {

                            var due = $("#due_" + i).attr("due");
                            var refund = $("#refund_" + i).attr("refund");

                            prev_balance = $("#balance_" + (i - 1)).attr("balance");
                            status = $("#balance_" + (i - 1)).attr("status");

                            if (due == 0) {
                                if (status === 'refund') {
                                    balance = parseFloat(prev_balance) + parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (status === 'due') {
                                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                                        balance = parseFloat(prev_balance) - parseFloat(refund);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance1);
                                        $("#balance_" + i).attr("status", "due");
                                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                        balance = parseFloat(refund) - parseFloat(prev_balance);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance1 + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    }

                                } else if (status === 'settle') {
                                    balance = parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }



                            } else {
                                if (status === 'refund') {
                                    if (parseFloat(prev_balance) > parseFloat(due)) {
                                        balance = parseFloat(prev_balance) - parseFloat(due);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                        balance = parseFloat(due) - parseFloat(prev_balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance);
                                        $("#balance_" + i).attr("status", "due");
                                    }
                                } else if (status === 'due') {
                                    balance = parseFloat(prev_balance) + parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");

                                } else if (status === 'settle') {
                                    balance = parseFloat(due);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            }




                        }
                    } else {
                        new_balance = parseFloat(settle) - parseFloat(due);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $('#balance_' + rowid).attr('status', 'refund');

                        var i;
                        for (i = new_rowid; i <= no_of_rows; i++) {

                            var due = $("#due_" + i).attr("due");
                            var refund = $("#refund_" + i).attr("refund");

                            prev_balance = $("#balance_" + (i - 1)).attr("balance");
                            status = $("#balance_" + (i - 1)).attr("status");

                            if (due == 0) {
                                if (status === 'refund') {
                                    balance = parseFloat(prev_balance) + parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (status === 'due') {
                                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                                        balance = parseFloat(prev_balance) - parseFloat(refund);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance1);
                                        $("#balance_" + i).attr("status", "due");
                                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                        balance = parseFloat(refund) - parseFloat(prev_balance);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance1 + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    }

                                } else if (status === 'settle') {
                                    balance = parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }



                            } else {
                                if (status === 'refund') {
                                    if (parseFloat(prev_balance) > parseFloat(due)) {
                                        balance = parseFloat(prev_balance) - parseFloat(due);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                        balance = parseFloat(due) - parseFloat(prev_balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance);
                                        $("#balance_" + i).attr("status", "due");
                                    }
                                } else if (status === 'due') {
                                    balance = parseFloat(prev_balance) + parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");

                                } else if (status === 'settle') {
                                    balance = parseFloat(due);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            }




                        }
                    }
                }
            }
        } else {

            if (prev_rowid > 0) {

                var p_balance = $('#balance_' + prev_rowid).attr('balance');
                var p_balance_status = $('#balance_' + prev_rowid).attr('status');


                if (p_balance_status === 'due') {
                    if (refund == 0) {
                        var total = parseFloat(p_balance) + parseFloat(due);
                        if (total > parseFloat(settle)) {
                            new_balance = total - parseFloat(settle);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "due");
                        } else if (total < parseFloat(settle)) {
                            new_balance = parseFloat(settle) - total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");
                        } else if (total == parseFloat(settle)) {
                            new_balance = parseFloat(settle) - total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "settle");
                        }

                    } else {
                        if (parseFloat(p_balance) > parseFloat(refund)) {
                            var total = parseFloat(p_balance) - parseFloat(refund);

                            if (total > parseFloat(settle)) {
                                new_balance = total - parseFloat(settle);
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "due");

                            } else if (total < parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $("#balance_" + rowid).attr("status", "refund");
                            } else if (total == parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "settle");
                            }

                        } else if (parseFloat(p_balance) < parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                        } else if (parseFloat(p_balance) == parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");
                        }

                    }

                } else if (p_balance_status === 'refund') {
                    if (refund == 0) {
                        if (parseFloat(p_balance) > parseFloat(due)) {
                            var total = parseFloat(p_balance) - parseFloat(due);
                            new_balance = total + parseFloat(settle);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                        } else if (parseFloat(p_balance) < parseFloat(due)) {
                            var total = parseFloat(due) - parseFloat(p_balance);


                            if (total > parseFloat(settle)) {
                                new_balance = total - parseFloat(settle);
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "due");

                            } else if (total < parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $("#balance_" + rowid).attr("status", "refund");
                            } else if (total == parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "settle");
                            }

                        } else if (parseFloat(p_balance) == parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");
                        }
                    } else {

                        var total = parseFloat(p_balance) + parseFloat(refund);
                        new_balance = total + parseFloat(settle);
                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $("#balance_" + rowid).attr("status", "refund");

                    }

                } else if (p_balance_status === 'settle') {
                    if (refund == 0) {
                        if (parseFloat(due) > parseFloat(settle)) {
                            new_balance = parseFloat(due) - parseFloat(settle);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "due");

                        } else if (parseFloat(due) < parseFloat(settle)) {
                            new_balance = parseFloat(settle) - parseFloat(due);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                        } else if (parseFloat(due) == parseFloat(settle)) {
                            new_balance = parseFloat(settle) - parseFloat(due);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "settle");
                        }

                    } else {
                        new_balance = parseFloat(refund) + parseFloat(settle);
                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $("#balance_" + rowid).attr("status", "refund");
                    }
                }
            } else {

                if (due === 0) {
                    new_balance = parseFloat(refund) + parseFloat(settle);

                    new_balance1 = new Intl.NumberFormat().format(new_balance);
                    $('#balance_' + rowid).attr('balance', new_balance);
                    $('#balance_' + rowid).html(new_balance1);

                    $('#balance_' + rowid).attr('status', 'refund');

                    var i;
                    for (i = new_rowid; i <= no_of_rows; i++) {
                        var due = $("#due_" + i).attr("due");
                        var refund = $("#refund_" + i).attr("refund");

                        prev_balance = $("#balance_" + (i - 1)).attr("balance");
                        status = $("#balance_" + (i - 1)).attr("status");

                        if (due == 0) {
                            if (status === 'refund') {
                                balance = parseFloat(prev_balance) + parseFloat(refund);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");
                            } else if (status === 'due') {
                                if (parseFloat(prev_balance) > parseFloat(refund)) {
                                    balance = parseFloat(prev_balance) - parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                    balance = parseFloat(refund) - parseFloat(prev_balance);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }

                            }



                        } else {
                            if (status === 'refund') {
                                if (parseFloat(prev_balance) > parseFloat(due)) {
                                    balance = parseFloat(prev_balance) - parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                    balance = parseFloat(due) - parseFloat(prev_balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            } else if (status === 'due') {
                                balance = parseFloat(prev_balance) + parseFloat(due);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance);
                                $("#balance_" + i).attr("status", "due");

                            }
                        }




                    }


                } else {
                    if (due >= settle) {
                        new_balance = parseFloat(due) - parseFloat(settle);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html(new_balance1);

                        if (new_balance === 0) {
                            $('#balance_' + rowid).attr('status', 'settle');
                        } else {
                            $('#balance_' + rowid).attr('status', 'due');
                        }

                        var i;
                        for (i = new_rowid; i <= no_of_rows; i++) {

                            var due = $("#due_" + i).attr("due");
                            var refund = $("#refund_" + i).attr("refund");

                            prev_balance = $("#balance_" + (i - 1)).attr("balance");
                            status = $("#balance_" + (i - 1)).attr("status");

                            if (due == 0) {
                                if (status === 'refund') {
                                    balance = parseFloat(prev_balance) + parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (status === 'due') {
                                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                                        balance = parseFloat(prev_balance) - parseFloat(refund);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance1);
                                        $("#balance_" + i).attr("status", "due");
                                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                        balance = parseFloat(refund) - parseFloat(prev_balance);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance1 + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    }

                                } else if (status === 'settle') {
                                    balance = parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }



                            } else {
                                if (status === 'refund') {
                                    if (parseFloat(prev_balance) > parseFloat(due)) {
                                        balance = parseFloat(prev_balance) - parseFloat(due);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                        balance = parseFloat(due) - parseFloat(prev_balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance);
                                        $("#balance_" + i).attr("status", "due");
                                    }
                                } else if (status === 'due') {
                                    balance = parseFloat(prev_balance) + parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");

                                } else if (status === 'settle') {
                                    balance = parseFloat(due);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            }




                        }
                    } else {
                        new_balance = parseFloat(settle) - parseFloat(due);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $('#balance_' + rowid).attr('status', 'refund');

                        var i;
                        for (i = new_rowid; i <= no_of_rows; i++) {

                            var due = $("#due_" + i).attr("due");
                            var refund = $("#refund_" + i).attr("refund");

                            prev_balance = $("#balance_" + (i - 1)).attr("balance");
                            status = $("#balance_" + (i - 1)).attr("status");

                            if (due == 0) {
                                if (status === 'refund') {
                                    balance = parseFloat(prev_balance) + parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                } else if (status === 'due') {
                                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                                        balance = parseFloat(prev_balance) - parseFloat(refund);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance1);
                                        $("#balance_" + i).attr("status", "due");
                                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                                        balance = parseFloat(refund) - parseFloat(prev_balance);
                                        balance1 = new Intl.NumberFormat().format(balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance1 + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    }

                                } else if (status === 'settle') {
                                    balance = parseFloat(refund);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html('(' + balance1 + ')');
                                    $("#balance_" + i).attr("status", "refund");
                                }



                            } else {
                                if (status === 'refund') {
                                    if (parseFloat(prev_balance) > parseFloat(due)) {
                                        balance = parseFloat(prev_balance) - parseFloat(due);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html('(' + balance + ')');
                                        $("#balance_" + i).attr("status", "refund");
                                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
                                        balance = parseFloat(due) - parseFloat(prev_balance);
                                        $("#balance_" + i).attr("balance", balance);
                                        $("#balance_" + i).html(balance);
                                        $("#balance_" + i).attr("status", "due");
                                    }
                                } else if (status === 'due') {
                                    balance = parseFloat(prev_balance) + parseFloat(due);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance);
                                    $("#balance_" + i).attr("status", "due");

                                } else if (status === 'settle') {
                                    balance = parseFloat(due);
                                    balance1 = new Intl.NumberFormat().format(balance);
                                    $("#balance_" + i).attr("balance", balance);
                                    $("#balance_" + i).html(balance1);
                                    $("#balance_" + i).attr("status", "due");
                                }
                            }




                        }
                    }
                }
            }
        }


    });

    $("#savebutton").click(function () {
        $('#balance').each(function () {
            $(this).find('tbody tr').each(function () {
                var invoiceid = $(this).attr('invoiceid');
                var settle = $('#settle_' + invoiceid).val();
                var balance = $('#balance_' + invoiceid).attr('balance');

                $.ajax({
                    type: 'POST',
                    url: 'ajax/job-report-by-consignee.php',
                    dataType: "json",
                    data: {
                        invoice: invoiceid,
                        settle: settle,
                        balance: balance,
                        option: 'UPDATEINVOICE'
                    },
                    success: function (result) {

                        swal({
                            title: "Success!",
                            text: "Your data was saved successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });


                    }
                });



            })
        });
    });

});


