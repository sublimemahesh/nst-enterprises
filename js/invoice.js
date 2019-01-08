$(document).ready(function () {
    $('.delivery-amount').keyup(function () {
        var amt = $(this).val();
        if (amt == '') {
            $(this).attr('amount', 0);
        } else {
            var amt1 = amt.split(",");

            var k, amt2 = '';
            for (k = 0; k < amt1.length; k++) {
                amt2 += amt1[k];
            }
            var amount = parseFloat(amt2);

            $(this).attr('amount', amount);
        }

    });

    $('.delivery-name').keyup(function () {

        var name = $(this).val();
        $(this).val(name);
    });
    /* ------Calculate statutory sub total------ */
    var tot = 0;
    var ramount;

    $('.table1').each(function () {
        $(this).find('.reimbursement-details').each(function () {
            ramount = parseFloat($(this).find('.reimbursement').attr('amount'));
            tot += ramount;

        })
    });

    var tot1 = new Intl.NumberFormat().format(tot);

    $('#statutory-sub-total').attr('total', tot);
    $('#statutory-sub-total').html(tot1);

    /* ------//Calculate statutory sub total------ */

    /* ------Calculate delivery sub total------ */
    var tot = 0;
    var ramount;


    $('.table1').each(function () {
        $(this).find('.delivery-details').each(function () {
            if ($(this).find('.delivery-amount').attr('amount')) {
                ramount = parseFloat($(this).find('.delivery-amount').attr('amount'));

                tot += ramount;
            }

        });
    });

    var tot1 = new Intl.NumberFormat().format(tot);

    $('#delivery-sub-total').attr('total', tot);
    $('#delivery-sub-total').html(tot1);

    /* ------//Calculate delivery sub total------ */

    /* ------Calculate payable amount & due / refund------ */

    var taxTotal = $('#tax-invoice-total').attr('total');
    var statutoryTotal = $('#statutory-sub-total').attr('total');
    var deliveryTotal = $('#delivery-sub-total').attr('total');
    var advance = $('#advance').attr('advance');
    if (taxTotal == "") {
        taxTotal = 0;
    }
    if (advance == "") {
        advance = 0;
    }



    var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
    var total1 = new Intl.NumberFormat().format(total);


    $('#payable-amount').attr("amount", total);
    $('#payable-amount').html(total1);

    if (total > parseFloat(advance)) {
        var due = total - parseFloat(advance);
        var due1 = new Intl.NumberFormat().format(due);

        $('#tr-due').removeClass("hidden");
        $('#tr-refund').addClass("hidden");
        $('#due').attr("due", due);
        $('#due').html(due1);
        $('#refund').attr("refund", 0);
        /* ------Due amount to word------ */
        var amount = convertNumberToWords(due);
        $('#amount-in-word').html(amount);
        /* ------//Due amount to word------ */

    } else {
        var refund = parseFloat(advance) - total;
        var refund1 = new Intl.NumberFormat().format(refund);

        $('#tr-refund').removeClass("hidden");
        $('#tr-due').addClass("hidden");
        $('#refund').attr("refund", refund);
        $('#refund').html('(' + refund1 + ')');
        $('#due').attr("due", 0);
        /* ------Refund amount to word------ */
        var amount = convertNumberToWords(refund);
        $('#amount-in-word').html(amount);
        /* ------//Refund amount to word------ */
    }

    /* ------//Calculate payable amount & due / refund------ */








//    $("#agency_fees").change(function () {
//        $("#documentation").change(function () {
//            var agencyfees = $('#agency_fees').val();
//            var documentation = $('#documentation').val();
//
//            var amount = parseFloat(agencyfees) + parseFloat(documentation);
//            var vat = amount * 15 / 100;
//            var vat1 = new Intl.NumberFormat().format(vat);
//            $("#vat").attr('vat', vat);
//            $("#vat").val(vat1);
//
//            var taxTotal = amount + vat;
//            var taxTotal1 = new Intl.NumberFormat().format(taxTotal);
//
//            $("#tax-invoice-total").attr('total', taxTotal);
//            $("#tax-invoice-total").html(taxTotal1);
//
//            var taxTotal = $('#tax-invoice-total').attr('total');
//            var statutoryTotal = $('#statutory-sub-total').attr('total');
//            var deliveryTotal = $('#delivery-sub-total').attr('total');
//            var advance = $('#advance').attr('advance');
//
//
//            var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
//            var total1 = new Intl.NumberFormat().format(total);
//
//            var due = total - parseFloat(advance);
//            var due1 = new Intl.NumberFormat().format(due);
//
//
//            $('#payable-amount').attr("amount", total);
//            $('#payable-amount').html(total1);
//
//            $('#due').attr("due", due);
//            $('#due').html(due1);
//        });
//    });

    /* ------Calculate vat, tax invoice total, payable amount & due when agency fees changed------ */

    $("#agency_fees").keyup(function () {
        var agencyfees = $('#agency_fees').val();
        var documentation = $('#documentation').val();

        if (agencyfees == "") {
            agencyfees = 0;
        }
        if (documentation == "") {
            documentation = 0;
        }

        //Calculate vat
        var amount = parseFloat(agencyfees) + parseFloat(documentation);
        var vat = amount * 15 / 100;
        var vat1 = new Intl.NumberFormat().format(vat);
        $("#vat").attr('vat', vat);
        $("#vat").val(vat1);

        //Calculate tax invoice total
        var taxTotal = amount + vat;
        var taxTotal1 = new Intl.NumberFormat().format(taxTotal);

        $("#tax-invoice-total").attr('total', taxTotal);
        $("#tax-invoice-total").html(taxTotal1);

        //Calculate payable amount & due

        var taxTotal = $('#tax-invoice-total').attr('total');
        var statutoryTotal = $('#statutory-sub-total').attr('total');
        var deliveryTotal = $('#delivery-sub-total').attr('total');
        var advance = $('#advance').attr('advance');

        if (advance == "") {
            advance = 0;
        }

        var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
        var total1 = new Intl.NumberFormat().format(total);

        $('#payable-amount').attr("amount", total);
        $('#payable-amount').html(total1);

        if (total > parseFloat(advance)) {
            var due = total - parseFloat(advance);
            var due1 = new Intl.NumberFormat().format(due);

            $('#tr-due').removeClass("hidden");
            $('#tr-refund').addClass("hidden");
            $('#due').attr("due", due);
            $('#due').html(due1);
            $('#refund').attr("refund", 0);
            /* ------Due amount to word------ */
            var amount = convertNumberToWords(due);
            $('#amount-in-word').html(amount);
            /* ------//Due amount to word------ */

        } else {
            var refund = parseFloat(advance) - total;
            var refund1 = new Intl.NumberFormat().format(refund);

            $('#tr-refund').removeClass("hidden");
            $('#tr-due').addClass("hidden");
            $('#refund').attr("refund", refund);
            $('#refund').html('(' + refund1 + ')');
            $('#due').attr("due", 0);
            /* ------Refund amount to word------ */
            var amount = convertNumberToWords(refund);
            $('#amount-in-word').html(amount);
            /* ------//Refund amount to word------ */
        }
    });

    /* ------//Calculate vat, tax invoice total, payable amount & due when agency fees changed------ */

    /* ------Calculate vat, tax invoice total, payable amount & due when documentation changed------ */

    $("#documentation").keyup(function () {
        var agencyfees = $('#agency_fees').val();
        var documentation = $('#documentation').val();

        if (agencyfees == "") {
            agencyfees = 0;
        }
        if (documentation == "") {
            documentation = 0;
        }

        //Calculate vat
        var amount = parseFloat(agencyfees) + parseFloat(documentation);
        var vat = amount * 15 / 100;
        var vat1 = new Intl.NumberFormat().format(vat);
        $("#vat").attr('vat', vat);
        $("#vat").val(vat1);

        //Calculate tax invoice total
        var taxTotal = amount + vat;
        var taxTotal1 = new Intl.NumberFormat().format(taxTotal);

        $("#tax-invoice-total").attr('total', taxTotal);
        $("#tax-invoice-total").html(taxTotal1);

        //Calculate payable amount & due
        var taxTotal = $('#tax-invoice-total').attr('total');
        var statutoryTotal = $('#statutory-sub-total').attr('total');
        var deliveryTotal = $('#delivery-sub-total').attr('total');
        var advance = $('#advance').attr('advance');

        if (advance == "") {
            advance = 0;
        }

        var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
        var total1 = new Intl.NumberFormat().format(total);

        $('#payable-amount').attr("amount", total);
        $('#payable-amount').html(total1);

        if (total > parseFloat(advance)) {
            var due = total - parseFloat(advance);
            var due1 = new Intl.NumberFormat().format(due);

            $('#tr-due').removeClass("hidden");
            $('#tr-refund').addClass("hidden");
            $('#due').attr("due", due);
            $('#due').html(due1);
            $('#refund').attr("refund", 0);
            /* ------Due amount to word------ */
            var amount = convertNumberToWords(due);
            $('#amount-in-word').html(amount);
            /* ------//Due amount to word------ */

        } else {
            var refund = parseFloat(advance) - total;
            var refund1 = new Intl.NumberFormat().format(refund);

            $('#tr-refund').removeClass("hidden");
            $('#tr-due').addClass("hidden");
            $('#refund').attr("refund", refund);
            $('#refund').html('(' + refund1 + ')');
            $('#due').attr("due", 0);
            /* ------Refund amount to word------ */
            var amount = convertNumberToWords(refund);
            $('#amount-in-word').html(amount);
            /* ------//Refund amount to word------ */
        }
    });
    /* ------//Calculate vat, tax invoice total, payable amount & due when documentation changed------ */

    /* ------Calculate statutory sub total, payable amount & due when statutory amount changed & update values in reimbursement-details table------ */

    $(".reimbursement").keyup(function () {
        var id = $(this).attr('rid');
        var amt = $(this).val();
        var amt1 = amt.split(",");

        var k, amt2 = '';
        for (k = 0; k < amt1.length; k++) {
            amt2 += amt1[k];
        }
        var amount = parseFloat(amt2);

        $('#id-' + id).attr('amount', amount);

        /* ------Calculate statutory sub total------ */
        var tot = 0;
        var ramount;


        $('.table1').each(function () {
            $(this).find('.reimbursement-details').each(function () {
                ramount = parseFloat($(this).find('.reimbursement').attr('amount'));
                tot += ramount;

            })
        });

        var tot1 = new Intl.NumberFormat().format(tot);

        $('#statutory-sub-total').attr('total', tot);
        $('#statutory-sub-total').html(tot1);
        /* ------//Calculate statutory sub total------ */

        /* ------Update values------ */
        $.ajax({
            type: 'POST',
            url: 'ajax/invoice.php',
            dataType: "json",
            data: {
                id: id,
                amount: amount,
                option: 'UPDATEREIMBURSEMENTDETAILS'
            },
            success: function (result) {

                //Calculate payable amount & due
                var statutoryTotal = $('#statutory-sub-total').attr('total');
                var deliveryTotal = $('#delivery-sub-total').attr('total');
                var taxTotal = $('#tax-invoice-total').attr('total');
                var advance = $('#advance').attr('advance');


                if (advance == "") {
                    advance = 0;
                }

                if (taxTotal == "") {
                    taxTotal = 0;
                }

                var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
                var total1 = new Intl.NumberFormat().format(total);


                $('#payable-amount').attr("amount", total);
                $('#payable-amount').html(total1);

                if (total > parseFloat(advance)) {
                    var due = total - parseFloat(advance);
                    var due1 = new Intl.NumberFormat().format(due);

                    $('#tr-due').removeClass("hidden");
                    $('#tr-refund').addClass("hidden");
                    $('#due').attr("due", due);
                    $('#due').html(due1);
                    $('#refund').attr("refund", 0);
                    /* ------Due amount to word------ */
                    var amount = convertNumberToWords(due);
                    $('#amount-in-word').html(amount);
                    /* ------//Due amount to word------ */

                } else {
                    var refund = parseFloat(advance) - total;
                    var refund1 = new Intl.NumberFormat().format(refund);

                    $('#tr-refund').removeClass("hidden");
                    $('#tr-due').addClass("hidden");
                    $('#refund').attr("refund", refund);
                    $('#refund').html('(' + refund1 + ')');
                    $('#due').attr("due", 0);
                    /* ------Refund amount to word------ */
                    var amount = convertNumberToWords(refund);
                    $('#amount-in-word').html(amount);
                    /* ------//Refund amount to word------ */
                }

            }
        });
        /* ------//Update values------ */
    });

    /* ------//Calculate statutory sub total, payable amount & due when statutory amount changed & update values in reimbursement-details table------ */

    /* ------Calculate delivery sub total, payable amount & due when delivery amount changed & update values in reimbursement-details table------ */

    $(".delivery-amount").keyup(function () {

        if ($(this).attr('did')) {
            var id = $(this).attr('did');
            var amt = $(this).val();

            if (amt == '') {
                $('#did-' + id).attr('amount', 0);
            } else {
                var amt1 = amt.split(",");
                var k, amt2 = '';
                for (k = 0; k < amt1.length; k++) {
                    amt2 += amt1[k];
                }
                var amount = parseFloat(amt2);
                $('#did-' + id).attr('amount', amount);
            }
        }
        /* ------Calculate delivery sub total------ */
        var tot = 0;
        var ramount;

        $('.table1').each(function () {

            $(this).find('.delivery-details').each(function () {
                if ($(this).find('.delivery-amount').attr('amount')) {
                    ramount = parseFloat($(this).find('.delivery-amount').attr('amount'));

                    tot += ramount;
                }
            });
        });

        var tot1 = new Intl.NumberFormat().format(tot);

        $('#delivery-sub-total').attr('total', tot);
        $('#delivery-sub-total').html(tot1);
        /* ------//Calculate delivery sub total------ */

        /* ------Update values------ */

        var statutoryTotal = $('#statutory-sub-total').attr('total');
        var deliveryTotal = $('#delivery-sub-total').attr('total');
        var taxTotal = $('#tax-invoice-total').attr('total');
        var advance = $('#advance').attr('advance');

        if (advance == "") {
            advance = 0;
        }

        if (taxTotal == "") {
            taxTotal = 0;
        }

        var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
        var total1 = new Intl.NumberFormat().format(total);

        $('#payable-amount').attr("amount", total);
        $('#payable-amount').html(total1);

        if (total > parseFloat(advance)) {
            var due = total - parseFloat(advance);
            var due1 = new Intl.NumberFormat().format(due);

            $('#tr-due').removeClass("hidden");
            $('#tr-refund').addClass("hidden");
            $('#due').attr("due", due);
            $('#due').html(due1);
            $('#refund').attr("refund", 0);
            /* ------Due amount to word------ */
            var amount = convertNumberToWords(due);
            $('#amount-in-word').html(amount);
            /* ------//Due amount to word------ */

        } else {
            var refund = parseFloat(advance) - total;
            var refund1 = new Intl.NumberFormat().format(refund);

            $('#tr-refund').removeClass("hidden");
            $('#tr-due').addClass("hidden");
            $('#refund').attr("refund", refund);
            $('#refund').html('(' + refund1 + ')');
            $('#due').attr("due", 0);
            /* ------Refund amount to word------ */
            var amount = convertNumberToWords(refund);
            $('#amount-in-word').html(amount);
            /* ------//Refund amount to word------ */
        }

//        $.ajax({
//            type: 'POST',
//            url: 'ajax/invoice.php',
//            dataType: "json",
//            data: {
//                id: id,
//                amount: amount,
//                option: 'UPDATEREIMBURSEMENTDETAILS'
//            },
//            success: function (result) {
//                var statutoryTotal = $('#statutory-sub-total').attr('total');
//                var deliveryTotal = $('#delivery-sub-total').attr('total');
//                var taxTotal = $('#tax-invoice-total').attr('total');
//                var advance = $('#advance').attr('advance');
//
//                if (advance == "") {
//                    advance = 0;
//                }
//
//                if (taxTotal == "") {
//                    taxTotal = 0;
//                }
//
//                var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
//                var total1 = new Intl.NumberFormat().format(total);
//
//                $('#payable-amount').attr("amount", total);
//                $('#payable-amount').html(total1);
//
//                if (total > parseFloat(advance)) {
//                    var due = total - parseFloat(advance);
//                    var due1 = new Intl.NumberFormat().format(due);
//
//                    $('#tr-due').removeClass("hidden");
//                    $('#tr-refund').addClass("hidden");
//                    $('#due').attr("due", due);
//                    $('#due').html(due1);
//                    $('#refund').attr("refund", 0);
//                    /* ------Due amount to word------ */
//                    var amount = convertNumberToWords(due);
//                    $('#amount-in-word').html(amount);
//                    /* ------//Due amount to word------ */
//
//                } else {
//                    var refund = parseFloat(advance) - total;
//                    var refund1 = new Intl.NumberFormat().format(refund);
//
//                    $('#tr-refund').removeClass("hidden");
//                    $('#tr-due').addClass("hidden");
//                    $('#refund').attr("refund", refund);
//                    $('#refund').html('(' + refund1 + ')');
//                    $('#due').attr("due", 0);
//                    /* ------Refund amount to word------ */
//                    var amount = convertNumberToWords(refund);
//                    $('#amount-in-word').html(amount);
//                    /* ------//Refund amount to word------ */
//                }
//            }
//        });
        /* ------//Update values------ */
    });

    /* ------//Calculate delivery sub total, payable amount & due when delivery amount changed & update values in reimbursement-details table------ */

    /* ------Calculate due when advance changed------ */

    $("#advance").keyup(function () {

        var payableAmount = $('#payable-amount').attr("amount");
        var advance = $('#advance').attr('advance');

        if (advance == "") {
            advance = 0;
        }

        if (parseFloat(payableAmount) > parseFloat(advance)) {
            var due = parseFloat(payableAmount) - parseFloat(advance);
            var due1 = new Intl.NumberFormat().format(due);

            $('#tr-refund').addClass("hidden");
            $('#refund').attr("refund", 0);
            $('#refund').html(0);
            $('#tr-due').removeClass("hidden");

            $('#due').attr("due", due);
            $('#due').html(due1);
            /* ------Due amount to word------ */
            var amount = convertNumberToWords(due);
            $('#amount-in-word').html(amount);
            /* ------//Due amount to word------ */

        } else {
            var refund = parseFloat(advance) - parseFloat(payableAmount);
            var refund1 = new Intl.NumberFormat().format(refund);

            $('#tr-due').addClass("hidden");
            $('#due').attr("due", 0);
            $('#due').html(0);
            $('#tr-refund').removeClass("hidden");

            $('#refund').attr("refund", refund);
            $('#refund').html('(' + refund1 + ')');
            /* ------Refund amount to word------ */
            var amount = convertNumberToWords(refund);
            $('#amount-in-word').html(amount);
            /* ------//Refund amount to word------ */
        }


        $('#advance').attr("advance", advance);
    });

    /* ------//Calculate due when advance changed------ */


    function convertNumberToWords(amount) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        return words_string;
    }
    setTimeout(function ()
    {
        var agencyfees = $('#agency_fees').val();
        var documentation = $('#documentation').val();

        if (agencyfees == "") {
            agencyfees = 0;
        }
        if (documentation == "") {
            documentation = 0;
        }

        //Calculate vat
        var amount = parseFloat(agencyfees) + parseFloat(documentation);
        var vat = amount * 15 / 100;
        var vat1 = new Intl.NumberFormat().format(vat);
        $("#vat").attr('vat', vat);
        $("#vat").val(vat1);

        //Calculate tax invoice total
        var taxTotal = amount + vat;
        var taxTotal1 = new Intl.NumberFormat().format(taxTotal);

        $("#tax-invoice-total").attr('total', taxTotal);
        $("#tax-invoice-total").html(taxTotal1);

        var total = parseFloat(taxTotal) + parseFloat(statutoryTotal) + parseFloat(deliveryTotal);
        var total1 = new Intl.NumberFormat().format(total);

        $('#payable-amount').attr("amount", total);
        $('#payable-amount').html(total1);

        var advance = $('#advance').attr('advance');


        if (total > parseFloat(advance)) {

            var due = total - parseFloat(advance);
            var due1 = new Intl.NumberFormat().format(due);

            $('#tr-due').removeClass("hidden");
            $('#tr-refund').addClass("hidden");
            $('#due').attr("due", due);
            $('#due').html(due1);
            $('#refund').attr("refund", 0);
            /* ------Due amount to word------ */
            var amount = convertNumberToWords(due);
            $('#amount-in-word').html(amount);
            /* ------//Due amount to word------ */

        } else {

            var refund = parseFloat(advance) - total;
            var refund1 = new Intl.NumberFormat().format(refund);

            $('#tr-refund').removeClass("hidden");
            $('#tr-due').addClass("hidden");
            $('#refund').attr("refund", refund);
            $('#refund').html('(' + refund1 + ')');
            $('#due').attr("due", 0);
            /* ------Refund amount to word------ */
            var amount = convertNumberToWords(refund);
            $('#amount-in-word').html(amount);
            /* ------//Refund amount to word------ */
        }
    },
            1000);

});


