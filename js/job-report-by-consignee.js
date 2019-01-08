$(document).ready(function () {

    var no_of_rows = $('#balance').find('tbody tr').length;
    var balance = 0;
    var prev_balance = 0;
    var exist_balance = 0;
    var status;
    var balance1;
    var total;

    var i;
    for (i = 1; i <= no_of_rows; i++) {
        var due = $("#due_" + i).attr("due");
        var refund = $("#refund_" + i).attr("refund");
        var settle = $("#settle_" + i).attr("settle");
        var new_rowid = i + 1;

        if (i === 1) {
            if ($("#exist-balance").val() == '') {
                exist_balance = 0;
            } else {
                exist_balance = parseFloat($("#exist-balance").val());
            }


            if (exist_balance >= 0) {
                if (due == 0) {
                    if (parseFloat(refund) + parseFloat(settle) > exist_balance) {
                        balance = parseFloat(refund) + parseFloat(settle) - exist_balance;
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);
                    } else if (parseFloat(refund) + parseFloat(settle) < exist_balance) {
                        balance = exist_balance - (parseFloat(refund) + parseFloat(settle));
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");

                        calculateBalance(new_rowid);
                    } else if (parseFloat(refund) + parseFloat(settle) == exist_balance) {
                        balance = parseFloat(refund) + parseFloat(settle) - exist_balance;
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "settle");

                        calculateBalance(new_rowid);
                    }
                } else {

                    if (parseFloat(due) + exist_balance > parseFloat(settle)) {

                        balance = parseFloat(due) + exist_balance - parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);

                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");

                        calculateBalance(new_rowid);

                    } else if (parseFloat(due) + exist_balance < parseFloat(settle)) {
                        balance = parseFloat(settle) - (parseFloat(due) + exist_balance);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);

                    } else if (parseFloat(due) + exist_balance == parseFloat(settle)) {
                        balance = parseFloat(settle) - parseFloat(due) + exist_balance;
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "settle");

                        calculateBalance(new_rowid);
                    }
                }
            } else {


                if (due == 0) {

                    balance = parseFloat(refund) + parseFloat(settle) - exist_balance;
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html('(' + balance1 + ')');
                    $("#balance_" + i).attr("status", "refund");

                    calculateBalance(new_rowid);

                } else {

                    if (parseFloat(due) > (parseFloat(settle) - exist_balance)) {

                        balance = parseFloat(due) - (parseFloat(settle) - exist_balance);
                        balance1 = new Intl.NumberFormat().format(balance);

                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");

                        calculateBalance(new_rowid);

                    } else if (parseFloat(due) < (parseFloat(settle) - exist_balance)) {
                        balance = parseFloat(settle) - exist_balance - parseFloat(due);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);

                    } else if (parseFloat(due) == (parseFloat(settle) - exist_balance)) {
                        balance = parseFloat(settle) - exist_balance - parseFloat(due);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "settle");

                        calculateBalance(new_rowid);
                    }
                }

            }
        } else {
            prev_balance = $("#balance_" + (i - 1)).attr("balance");
            status = $("#balance_" + (i - 1)).attr("status");

            if (due == 0) {
                if (status === 'refund') {
                    balance = parseFloat(prev_balance) + parseFloat(refund) + parseFloat(settle);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html('(' + balance1 + ')');
                    $("#balance_" + i).attr("status", "refund");

                    calculateBalance(new_rowid);

                } else if (status === 'due') {
                    if (parseFloat(prev_balance) > parseFloat(refund)) {

                        total = parseFloat(prev_balance) - parseFloat(refund);

                        if (total > parseFloat(settle)) {
                            balance = total - parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $('#balance_' + i).attr('balance', balance);
                            $('#balance_' + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");

                            calculateBalance(new_rowid);

                        } else if (total < parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $('#balance_' + i).attr('balance', balance);
                            $('#balance_' + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (total == parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $('#balance_' + i).attr('balance', balance);
                            $('#balance_' + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);

                        }

                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                        balance = parseFloat(refund) - parseFloat(prev_balance) + parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);

                    } else if (parseFloat(prev_balance) == parseFloat(refund)) {
                        if (parseFloat(settle)) {
                            balance = parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else {
                            balance = 0;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }
                    }
                }

            } else {

                if (status === 'refund') {
                    if (parseFloat(prev_balance) > parseFloat(due)) {
                        balance = parseFloat(prev_balance) - parseFloat(due) + parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);

                    } else if (parseFloat(prev_balance) < parseFloat(due)) {

                        total = parseFloat(due) - parseFloat(prev_balance);

                        if (total > parseFloat(settle)) {
                            balance = total - parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");

                            calculateBalance(new_rowid);

                        } else if (total < parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (total == parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);

                        }
                    }
                } else if (status === 'due') {

                    total = parseFloat(prev_balance) + parseFloat(due);

                    if (total > parseFloat(settle)) {
                        balance = total - parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");

                        calculateBalance(new_rowid);
                    } else if (total < parseFloat(settle)) {
                        balance = parseFloat(settle) - total;
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);
                    } else if (total == parseFloat(settle)) {
                        balance = parseFloat(settle) - total;
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "settle");

                        calculateBalance(new_rowid);
                    }


                }
            }
        }


//        if (i === 1) {
//            if (due == 0) {
//                balance = parseFloat(refund) + parseFloat(settle);
//                balance1 = new Intl.NumberFormat().format(balance);
//                $("#balance_" + i).attr("balance", balance);
//                $("#balance_" + i).html('(' + balance1 + ')');
//                $("#balance_" + i).attr("status", "refund");
//
//                calculateBalance(new_rowid);
//            } else {
//
//                if (parseFloat(due) > parseFloat(settle)) {
//
//                    balance = parseFloat(due) - parseFloat(settle);
//                    balance1 = new Intl.NumberFormat().format(balance);
//
//                    $("#balance_" + i).attr("balance", balance);
//                    $("#balance_" + i).html(balance1);
//                    $("#balance_" + i).attr("status", "due");
//
//                    calculateBalance(new_rowid);
//
//                } else if (parseFloat(due) < parseFloat(settle)) {
//                    balance = parseFloat(settle) - parseFloat(due);
//                    balance1 = new Intl.NumberFormat().format(balance);
//                    $("#balance_" + i).attr("balance", balance);
//                    $("#balance_" + i).html('(' + balance1 + ')');
//                    $("#balance_" + i).attr("status", "refund");
//
//                    calculateBalance(new_rowid);
//
//                } else if (parseFloat(due) == parseFloat(settle)) {
//                    balance = parseFloat(settle) - parseFloat(due);
//                    balance1 = new Intl.NumberFormat().format(balance);
//                    $("#balance_" + i).attr("balance", balance);
//                    $("#balance_" + i).html(balance1);
//                    $("#balance_" + i).attr("status", "settle");
//
//                    calculateBalance(new_rowid);
//                }
//            }
//        } else {
//            prev_balance = $("#balance_" + (i - 1)).attr("balance");
//            status = $("#balance_" + (i - 1)).attr("status");
//
//            if (due == 0) {
//                if (status === 'refund') {
//                    balance = parseFloat(prev_balance) + parseFloat(refund) + parseFloat(settle);
//                    balance1 = new Intl.NumberFormat().format(balance);
//                    $("#balance_" + i).attr("balance", balance);
//                    $("#balance_" + i).html('(' + balance1 + ')');
//                    $("#balance_" + i).attr("status", "refund");
//
//                    calculateBalance(new_rowid);
//
//                } else if (status === 'due') {
//                    if (parseFloat(prev_balance) > parseFloat(refund)) {
//
//                        total = parseFloat(prev_balance) - parseFloat(refund);
//
//                        if (total > parseFloat(settle)) {
//                            balance = total - parseFloat(settle);
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $('#balance_' + i).attr('balance', balance);
//                            $('#balance_' + i).html(balance1);
//                            $("#balance_" + i).attr("status", "due");
//
//                            calculateBalance(new_rowid);
//
//                        } else if (total < parseFloat(settle)) {
//                            balance = parseFloat(settle) - total;
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $('#balance_' + i).attr('balance', balance);
//                            $('#balance_' + i).html('(' + balance1 + ')');
//                            $("#balance_" + i).attr("status", "refund");
//
//                            calculateBalance(new_rowid);
//
//                        } else if (total == parseFloat(settle)) {
//                            balance = parseFloat(settle) - total;
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $('#balance_' + i).attr('balance', balance);
//                            $('#balance_' + i).html(balance1);
//                            $("#balance_" + i).attr("status", "settle");
//
//                            calculateBalance(new_rowid);
//
//                        }
//
//                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
//                        balance = parseFloat(refund) - parseFloat(prev_balance) + parseFloat(settle);
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html('(' + balance1 + ')');
//                        $("#balance_" + i).attr("status", "refund");
//
//                        calculateBalance(new_rowid);
//
//                    } else if (parseFloat(prev_balance) == parseFloat(refund)) {
//                        if (parseFloat(settle)) {
//                            balance = parseFloat(settle);
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $("#balance_" + i).attr("balance", balance);
//                            $("#balance_" + i).html('(' + balance1 + ')');
//                            $("#balance_" + i).attr("status", "refund");
//
//                            calculateBalance(new_rowid);
//
//                        } else {
//                            balance = 0;
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $("#balance_" + i).attr("balance", balance);
//                            $("#balance_" + i).html(balance1);
//                            $("#balance_" + i).attr("status", "settle");
//
//                            calculateBalance(new_rowid);
//                        }
//                    }
//                }
//
//            } else {
//
//                if (status === 'refund') {
//                    if (parseFloat(prev_balance) > parseFloat(due)) {
//                        balance = parseFloat(prev_balance) - parseFloat(due) + parseFloat(settle);
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html('(' + balance1 + ')');
//                        $("#balance_" + i).attr("status", "refund");
//
//                        calculateBalance(new_rowid);
//
//                    } else if (parseFloat(prev_balance) < parseFloat(due)) {
//
//                        total = parseFloat(due) - parseFloat(prev_balance);
//
//                        if (total > parseFloat(settle)) {
//                            balance = total - parseFloat(settle);
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $("#balance_" + i).attr("balance", balance);
//                            $("#balance_" + i).html(balance1);
//                            $("#balance_" + i).attr("status", "due");
//
//                            calculateBalance(new_rowid);
//
//                        } else if (total < parseFloat(settle)) {
//                            balance = parseFloat(settle) - total;
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $("#balance_" + i).attr("balance", balance);
//                            $("#balance_" + i).html('(' + balance1 + ')');
//                            $("#balance_" + i).attr("status", "refund");
//
//                            calculateBalance(new_rowid);
//
//                        } else if (total == parseFloat(settle)) {
//                            balance = parseFloat(settle) - total;
//                            balance1 = new Intl.NumberFormat().format(balance);
//                            $("#balance_" + i).attr("balance", balance);
//                            $("#balance_" + i).html(balance1);
//                            $("#balance_" + i).attr("status", "settle");
//
//                            calculateBalance(new_rowid);
//
//                        }
//                    }
//                } else if (status === 'due') {
//
//                    total = parseFloat(prev_balance) + parseFloat(due);
//
//                    if (total > parseFloat(settle)) {
//                        balance = total - parseFloat(settle);
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html(balance1);
//                        $("#balance_" + i).attr("status", "due");
//
//                        calculateBalance(new_rowid);
//                    } else if (total < parseFloat(settle)) {
//                        balance = parseFloat(settle) - total;
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html('(' + balance1 + ')');
//                        $("#balance_" + i).attr("status", "refund");
//
//                        calculateBalance(new_rowid);
//                    } else if (total == parseFloat(settle)) {
//                        balance = parseFloat(settle) - total;
//                        balance1 = new Intl.NumberFormat().format(balance);
//                        $("#balance_" + i).attr("balance", balance);
//                        $("#balance_" + i).html(balance1);
//                        $("#balance_" + i).attr("status", "settle");
//
//                        calculateBalance(new_rowid);
//                    }
//
//
//                }
//            }
//        }
    }

    $(".settle").keyup(function () {
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
        var exist_balance = $("#exist-balance").val();
        $(this).attr("settle", settle);

        if (settle > prev_settle) {
            if (prev_rowid > 0) {

//                if (parseFloat(balance) >= parseFloat(settle)) {
//                    new_balance = parseFloat(balance) - parseFloat(settle);
//                    new_balance1 = new Intl.NumberFormat().format(new_balance);
//                    $('#balance_' + rowid).attr('balance', new_balance);
//                    $('#balance_' + rowid).html(new_balance1);
//
//                    if (new_balance === 0) {
//                        $('#balance_' + rowid).attr('status', 'settle');
//                    } else {
//                        $('#balance_' + rowid).attr('status', 'due');
//                    }
//
//                    calculateBalance(new_rowid);
//
//                } else {
//                    new_balance = parseFloat(settle) - parseFloat(balance);
//
//                    new_balance1 = new Intl.NumberFormat().format(new_balance);
//                    $('#balance_' + rowid).attr('balance', new_balance);
//                    $('#balance_' + rowid).html('(' + new_balance1 + ')');
//                    $('#balance_' + rowid).attr('status', 'refund');
//
//                    calculateBalance(new_rowid);
//                }


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

                            calculateBalance(new_rowid);



                        } else if (total < parseFloat(settle)) {
                            new_balance = parseFloat(settle) - total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (total == parseFloat(settle)) {

                            new_balance = parseFloat(settle) - total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "settle");

                            calculateBalance(new_rowid);
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

                                calculateBalance(new_rowid);


                            } else if (total < parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $("#balance_" + rowid).attr("status", "refund");

                                calculateBalance(new_rowid);

                            } else if (total == parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "settle");

                                calculateBalance(new_rowid);

                            }

                        } else if (parseFloat(p_balance) < parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);


                        } else if (parseFloat(p_balance) == parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);
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

                            calculateBalance(new_rowid);


                        } else if (parseFloat(p_balance) < parseFloat(due)) {
                            var total = parseFloat(due) - parseFloat(p_balance);


                            if (total > parseFloat(settle)) {
                                new_balance = total - parseFloat(settle);
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "due");

                                calculateBalance(new_rowid);

                            } else if (total < parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $("#balance_" + rowid).attr("status", "refund");

                                calculateBalance(new_rowid);
                            } else if (total == parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "settle");

                                calculateBalance(new_rowid);
                            }



                        } else if (parseFloat(p_balance) == parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);
                        }
                    } else {

                        var total = parseFloat(p_balance) + parseFloat(refund);
                        new_balance = total + parseFloat(settle);
                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $("#balance_" + rowid).attr("status", "refund");

                        calculateBalance(new_rowid);

                    }

                } else if (p_balance_status === 'settle') {
                    if (refund == 0) {
                        if (parseFloat(due) > parseFloat(settle)) {
                            new_balance = parseFloat(due) - parseFloat(settle);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "due");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) < parseFloat(settle)) {
                            new_balance = parseFloat(settle) - parseFloat(due);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) == parseFloat(settle)) {
                            new_balance = parseFloat(settle) - parseFloat(due);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }

                    } else {
                        new_balance = parseFloat(refund) + parseFloat(settle);
                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $("#balance_" + rowid).attr("status", "refund");

                        calculateBalance(new_rowid);
                    }
                }


            } else {
                if (exist_balance == '') {
                    if (due == 0) {
                        new_balance = parseFloat(refund) + parseFloat(settle);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html(new_balance1);

                        $('#balance_' + rowid).attr('status', 'refund');

                        calculateBalance(new_rowid);


                    } else {
                        if (parseFloat(due) >= parseFloat(settle)) {
                            new_balance = parseFloat(due) - parseFloat(settle);

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);

                            if (new_balance === 0) {
                                $('#balance_' + rowid).attr('status', 'settle');
                            } else {
                                $('#balance_' + rowid).attr('status', 'due');
                            }

                            calculateBalance(new_rowid);
                        } else {
                            new_balance = parseFloat(settle) - parseFloat(due);

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $('#balance_' + rowid).attr('status', 'refund');

                            calculateBalance(new_rowid);
                        }
                    }
                } else if (parseFloat(exist_balance) >= 0) {
                    if (due == 0) {

                        if ((parseFloat(refund) + parseFloat(settle)) >= parseFloat(exist_balance)) {
                            new_balance = parseFloat(refund) + parseFloat(settle) - parseFloat(exist_balance);

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);

                            if (new_balance === 0) {
                                $('#balance_' + rowid).html(new_balance1);
                                $('#balance_' + rowid).attr('status', 'settle');
                            } else {
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $('#balance_' + rowid).attr('status', 'refund');
                            }

                            calculateBalance(new_rowid);
                        } else if ((parseFloat(refund) + parseFloat(settle)) < parseFloat(exist_balance)) {
                            new_balance = parseFloat(exist_balance) - (parseFloat(refund) + parseFloat(settle));

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);

                            $('#balance_' + rowid).attr('status', 'due');

                            calculateBalance(new_rowid);
                        }
                    } else {
                        if ((parseFloat(due) + parseFloat(exist_balance)) >= parseFloat(settle)) {
                            new_balance = parseFloat(due) + parseFloat(exist_balance) - parseFloat(settle);

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);

                            if (new_balance === 0) {
                                $('#balance_' + rowid).attr('status', 'settle');
                            } else {
                                $('#balance_' + rowid).attr('status', 'due');
                            }

                            calculateBalance(new_rowid);
                        } else {
                            new_balance = parseFloat(settle) - (parseFloat(due) + parseFloat(exist_balance));

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $('#balance_' + rowid).attr('status', 'refund');

                            calculateBalance(new_rowid);
                        }
                    }

                } else if (parseFloat(exist_balance) < 0) {
                    // ex: exist_balance = -1000
                    if (due == 0) {
                        new_balance = parseFloat(refund) + parseFloat(settle) - parseFloat(exist_balance);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');

                        $('#balance_' + rowid).attr('status', 'refund');

                        calculateBalance(new_rowid);


                    } else {
                        if (parseFloat(due) >= (parseFloat(settle) - parseFloat(exist_balance))) {
                            new_balance = parseFloat(due) - (parseFloat(settle) - parseFloat(exist_balance));

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);

                            if (new_balance === 0) {
                                $('#balance_' + rowid).attr('status', 'settle');
                            } else {
                                $('#balance_' + rowid).attr('status', 'due');
                            }

                            calculateBalance(new_rowid);
                        } else {
                            new_balance = (parseFloat(settle) - parseFloat(exist_balance)) - parseFloat(due);

                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $('#balance_' + rowid).attr('status', 'refund');

                            calculateBalance(new_rowid);
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

                            calculateBalance(new_rowid);



                        } else if (total < parseFloat(settle)) {
                            new_balance = parseFloat(settle) - total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (total == parseFloat(settle)) {
                            new_balance = parseFloat(settle) - total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "settle");

                            calculateBalance(new_rowid);
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

                                calculateBalance(new_rowid);


                            } else if (total < parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $("#balance_" + rowid).attr("status", "refund");

                                calculateBalance(new_rowid);

                            } else if (total == parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "settle");

                                calculateBalance(new_rowid);

                            }

                        } else if (parseFloat(p_balance) < parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);


                        } else if (parseFloat(p_balance) == parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);
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

                            calculateBalance(new_rowid);


                        } else if (parseFloat(p_balance) < parseFloat(due)) {
                            var total = parseFloat(due) - parseFloat(p_balance);


                            if (total > parseFloat(settle)) {
                                new_balance = total - parseFloat(settle);
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "due");

                                calculateBalance(new_rowid);

                            } else if (total < parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html('(' + new_balance1 + ')');
                                $("#balance_" + rowid).attr("status", "refund");

                                calculateBalance(new_rowid);
                            } else if (total == parseFloat(settle)) {
                                new_balance = parseFloat(settle) - total;
                                new_balance1 = new Intl.NumberFormat().format(new_balance);
                                $('#balance_' + rowid).attr('balance', new_balance);
                                $('#balance_' + rowid).html(new_balance1);
                                $("#balance_" + rowid).attr("status", "settle");

                                calculateBalance(new_rowid);
                            }



                        } else if (parseFloat(p_balance) == parseFloat(refund)) {
                            var total = parseFloat(refund) - parseFloat(p_balance);
                            new_balance = parseFloat(settle) + total;
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);
                        }
                    } else {

                        var total = parseFloat(p_balance) + parseFloat(refund);
                        new_balance = total + parseFloat(settle);
                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $("#balance_" + rowid).attr("status", "refund");

                        calculateBalance(new_rowid);

                    }

                } else if (p_balance_status === 'settle') {
                    if (refund == 0) {
                        if (parseFloat(due) > parseFloat(settle)) {
                            new_balance = parseFloat(due) - parseFloat(settle);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "due");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) < parseFloat(settle)) {
                            new_balance = parseFloat(settle) - parseFloat(due);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html('(' + new_balance1 + ')');
                            $("#balance_" + rowid).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) == parseFloat(settle)) {
                            new_balance = parseFloat(settle) - parseFloat(due);
                            new_balance1 = new Intl.NumberFormat().format(new_balance);
                            $('#balance_' + rowid).attr('balance', new_balance);
                            $('#balance_' + rowid).html(new_balance1);
                            $("#balance_" + rowid).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }

                    } else {
                        new_balance = parseFloat(refund) + parseFloat(settle);
                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $("#balance_" + rowid).attr("status", "refund");

                        calculateBalance(new_rowid);
                    }
                }
            } else {

                if (due == 0) {
                    new_balance = parseFloat(refund) + parseFloat(settle);

                    new_balance1 = new Intl.NumberFormat().format(new_balance);
                    $('#balance_' + rowid).attr('balance', new_balance);
                    $('#balance_' + rowid).html(new_balance1);

                    $('#balance_' + rowid).attr('status', 'refund');

                    calculateBalance(new_rowid);


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

                        calculateBalance(new_rowid);
                    } else {
                        new_balance = parseFloat(settle) - parseFloat(due);

                        new_balance1 = new Intl.NumberFormat().format(new_balance);
                        $('#balance_' + rowid).attr('balance', new_balance);
                        $('#balance_' + rowid).html('(' + new_balance1 + ')');
                        $('#balance_' + rowid).attr('status', 'refund');

                        calculateBalance(new_rowid);
                    }
                }
            }
        }


    });


    $("#exist-balance").keyup(function () {
        var no_of_rows = $('#balance').find('tbody tr').length;
        var balance = 0;
        var prev_balance = 0;
        var exist_balance = 0;
        var status;
        var balance1;
        var total;

        var i;
        for (i = 1; i <= no_of_rows; i++) {
            var due = $("#due_" + i).attr("due");
            var refund = $("#refund_" + i).attr("refund");
            var settle = $("#settle_" + i).attr("settle");
            var new_rowid = i + 1;


            if (i === 1) {
                if ($(this).val() == '') {
                    exist_balance = 0;
                } else {
                    exist_balance = parseFloat($(this).val());
                }


                if (exist_balance >= 0) {
                    if (due == 0) {
                        if (parseFloat(refund) + parseFloat(settle) > exist_balance) {
                            balance = parseFloat(refund) + parseFloat(settle) - exist_balance;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);
                        } else if (parseFloat(refund) + parseFloat(settle) < exist_balance) {
                            balance = exist_balance - (parseFloat(refund) + parseFloat(settle));
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");

                            calculateBalance(new_rowid);
                        } else if (parseFloat(refund) + parseFloat(settle) == exist_balance) {
                            balance = parseFloat(refund) + parseFloat(settle) - exist_balance;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }
                    } else {

                        if (parseFloat(due) + exist_balance > parseFloat(settle)) {

                            balance = parseFloat(due) + exist_balance - parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);

                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) + exist_balance < parseFloat(settle)) {
                            balance = parseFloat(settle) - (parseFloat(due) + exist_balance);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) + exist_balance == parseFloat(settle)) {
                            balance = parseFloat(settle) - parseFloat(due) + exist_balance;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }
                    }
                } else {


                    if (due == 0) {

                        balance = parseFloat(refund) + parseFloat(settle) - exist_balance;
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);

                    } else {

                        if (parseFloat(due) > (parseFloat(settle) - exist_balance)) {

                            balance = parseFloat(due) - (parseFloat(settle) - exist_balance);
                            balance1 = new Intl.NumberFormat().format(balance);

                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) < (parseFloat(settle) - exist_balance)) {
                            balance = parseFloat(settle) - exist_balance - parseFloat(due);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(due) == (parseFloat(settle) - exist_balance)) {
                            balance = parseFloat(settle) - exist_balance - parseFloat(due);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }
                    }

                }
            } else {
                prev_balance = $("#balance_" + (i - 1)).attr("balance");
                status = $("#balance_" + (i - 1)).attr("status");

                if (due == 0) {
                    if (status === 'refund') {
                        balance = parseFloat(prev_balance) + parseFloat(refund) + parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");

                        calculateBalance(new_rowid);

                    } else if (status === 'due') {
                        if (parseFloat(prev_balance) > parseFloat(refund)) {

                            total = parseFloat(prev_balance) - parseFloat(refund);

                            if (total > parseFloat(settle)) {
                                balance = total - parseFloat(settle);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $('#balance_' + i).attr('balance', balance);
                                $('#balance_' + i).html(balance1);
                                $("#balance_" + i).attr("status", "due");

                                calculateBalance(new_rowid);

                            } else if (total < parseFloat(settle)) {
                                balance = parseFloat(settle) - total;
                                balance1 = new Intl.NumberFormat().format(balance);
                                $('#balance_' + i).attr('balance', balance);
                                $('#balance_' + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");

                                calculateBalance(new_rowid);

                            } else if (total == parseFloat(settle)) {
                                balance = parseFloat(settle) - total;
                                balance1 = new Intl.NumberFormat().format(balance);
                                $('#balance_' + i).attr('balance', balance);
                                $('#balance_' + i).html(balance1);
                                $("#balance_" + i).attr("status", "settle");

                                calculateBalance(new_rowid);

                            }

                        } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                            balance = parseFloat(refund) - parseFloat(prev_balance) + parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(prev_balance) == parseFloat(refund)) {
                            if (parseFloat(settle)) {
                                balance = parseFloat(settle);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");

                                calculateBalance(new_rowid);

                            } else {
                                balance = 0;
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance1);
                                $("#balance_" + i).attr("status", "settle");

                                calculateBalance(new_rowid);
                            }
                        }
                    }

                } else {

                    if (status === 'refund') {
                        if (parseFloat(prev_balance) > parseFloat(due)) {
                            balance = parseFloat(prev_balance) - parseFloat(due) + parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);

                        } else if (parseFloat(prev_balance) < parseFloat(due)) {

                            total = parseFloat(due) - parseFloat(prev_balance);

                            if (total > parseFloat(settle)) {
                                balance = total - parseFloat(settle);
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance1);
                                $("#balance_" + i).attr("status", "due");

                                calculateBalance(new_rowid);

                            } else if (total < parseFloat(settle)) {
                                balance = parseFloat(settle) - total;
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html('(' + balance1 + ')');
                                $("#balance_" + i).attr("status", "refund");

                                calculateBalance(new_rowid);

                            } else if (total == parseFloat(settle)) {
                                balance = parseFloat(settle) - total;
                                balance1 = new Intl.NumberFormat().format(balance);
                                $("#balance_" + i).attr("balance", balance);
                                $("#balance_" + i).html(balance1);
                                $("#balance_" + i).attr("status", "settle");

                                calculateBalance(new_rowid);

                            }
                        }
                    } else if (status === 'due') {

                        total = parseFloat(prev_balance) + parseFloat(due);

                        if (total > parseFloat(settle)) {
                            balance = total - parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");

                            calculateBalance(new_rowid);
                        } else if (total < parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");

                            calculateBalance(new_rowid);
                        } else if (total == parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");

                            calculateBalance(new_rowid);
                        }


                    }
                }
            }
        }


    });

    function calculateBalance(new_rowid) {
        var i;
        for (i = new_rowid; i <= no_of_rows; i++) {

            var due = $("#due_" + i).attr("due");
            var refund = $("#refund_" + i).attr("refund");
            var settle = $("#settle_" + i).attr("settle");
            var total;

            prev_balance = $("#balance_" + (i - 1)).attr("balance");
            status = $("#balance_" + (i - 1)).attr("status");

            if (due == 0) {
                if (status === 'refund') {
                    balance = parseFloat(prev_balance) + parseFloat(refund) + parseFloat(settle);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html('(' + balance1 + ')');
                    $("#balance_" + i).attr("status", "refund");
                } else if (status === 'due') {
                    if (parseFloat(prev_balance) > parseFloat(refund)) {
                        total = parseFloat(prev_balance) - parseFloat(refund);

                        if (total > parseFloat(settle)) {
                            balance = total - parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $('#balance_' + i).attr('balance', balance);
                            $('#balance_' + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");
                        } else if (total < parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $('#balance_' + i).attr('balance', balance);
                            $('#balance_' + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");
                        } else if (total == parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $('#balance_' + i).attr('balance', balance);
                            $('#balance_' + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");
                        }
                    } else if (parseFloat(prev_balance) < parseFloat(refund)) {
                        balance = parseFloat(refund) - parseFloat(prev_balance) + parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");
                    } else if (parseFloat(prev_balance) == parseFloat(refund)) {
                        if (parseFloat(settle)) {
                            balance = parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");
                        } else {
                            balance = 0;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");
                        }
                    }

                } else if (status === 'settle') {
                    balance = parseFloat(refund) + parseFloat(settle);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html('(' + balance1 + ')');
                    $("#balance_" + i).attr("status", "refund");
                }



            } else {
                if (status === 'refund') {
                    if (parseFloat(prev_balance) > parseFloat(due)) {
                        balance = parseFloat(prev_balance) - parseFloat(due) + parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");
                    } else if (parseFloat(prev_balance) < parseFloat(due)) {

                        total = parseFloat(due) - parseFloat(prev_balance);

                        if (total > parseFloat(settle)) {
                            balance = total - parseFloat(settle);
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "due");
                        } else if (total < parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html('(' + balance1 + ')');
                            $("#balance_" + i).attr("status", "refund");
                        } else if (total == parseFloat(settle)) {
                            balance = parseFloat(settle) - total;
                            balance1 = new Intl.NumberFormat().format(balance);
                            $("#balance_" + i).attr("balance", balance);
                            $("#balance_" + i).html(balance1);
                            $("#balance_" + i).attr("status", "settle");
                        }
                    }
                } else if (status === 'due') {
                    balance = parseFloat(prev_balance) + parseFloat(due) - parseFloat(settle);
                    balance1 = new Intl.NumberFormat().format(balance);
                    $("#balance_" + i).attr("balance", balance);
                    $("#balance_" + i).html(balance1);
                    $("#balance_" + i).attr("status", "due");

                } else if (status === 'settle') {

                    if (parseFloat(due) > parseFloat(settle)) {
                        balance = parseFloat(due) - parseFloat(settle);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "due");
                    } else if (parseFloat(due) < parseFloat(settle)) {
                        balance = parseFloat(settle) - parseFloat(due);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html('(' + balance1 + ')');
                        $("#balance_" + i).attr("status", "refund");
                    } else if (parseFloat(due) == parseFloat(settle)) {
                        balance = parseFloat(settle) - parseFloat(due);
                        balance1 = new Intl.NumberFormat().format(balance);
                        $("#balance_" + i).attr("balance", balance);
                        $("#balance_" + i).html(balance1);
                        $("#balance_" + i).attr("status", "settle");
                    }




                }
            }

        }
    }

    $("#savebutton").click(function () {
        var consignee = $('#consignee').val();
        var current_balance = $('#exist-balance').val();

        $.ajax({
            type: 'POST',
            url: 'ajax/job-report-by-consignee.php',
            dataType: "json",
            data: {
                consignee: consignee,
                balance: current_balance,
                option: 'UPDATECURRENTBALANCE'
            },
            success: function (result) {

                $('#balance').each(function () {
                    $(this).find('tbody tr').each(function () {
                        var invoiceid = $(this).attr('invoiceid');
                        var settle = $('.settle_' + invoiceid).val();
                        var balance = $('.balance_' + invoiceid).attr('balance');
                        var status = $('.balance_' + invoiceid).attr('status');
                        var receiptno = $('.receipt_' + invoiceid).val();


                        $.ajax({
                            type: 'POST',
                            url: 'ajax/job-report-by-consignee.php',
                            dataType: "json",
                            data: {
                                invoice: invoiceid,
                                settle: settle,
                                balance: balance,
                                status: status,
                                receiptno: receiptno,
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
            }
        });




    });
});


