$(document).ready(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
    }
    $('#name').keyup(function (e) {
        var nameId = $('#name-id').val();
        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $('#name').val();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/job-consignee.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'GETNAME'},
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (key === 0) {
                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
//                                    html += '<li id="c' + this.id + '" class="name selected">' + this.name + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                }
                            });
                            $('#name-list-append').empty();
                            $('#name-list-append').append(html);
                        }
                    });
                }
            }
        }

    });
    $('#name-list-append').on('click', '.name', function () {

        var consigneeId = this.id;
        var consignee = $(this).text();
        $('#name-id').val(consigneeId.replace("c", ""));
        $('#name').val(consignee);
        $('#name-list-append').empty();

        $('#name').change(function () {
            $('#name-id').val("");
        });
    });
    $('#name-list-append').on('mouseover', '.name', function () {
        var consigneeId = this.id;
        var consignee = $(this).text();
        $('#name-id').val(consigneeId.replace("c", ""));
        $('#name').val(consignee);
        $('#name').change(function () {
            $('#name-id').val("");
        });
    });

    $('#name').keypress(function (e) {
        var $selected = $('li.selected'), $li = $('li.name');
        if (e.keyCode == 40) {
            var res = $selected.removeClass('selected').next().addClass('selected');
            if ($selected.next().length == 0) {
                $li.eq(0).addClass('selected');
            }
            if (res) {
//                var consigneeId = $('li.selected').attr('id');
                var consignee = $('li.selected').text();
//                $('#name-id').val(consigneeId.replace("c", ""));
                $('#name').val(consignee);
            }

        } else if (e.keyCode === 38) {
            var res = $selected.removeClass('selected').prev().addClass('selected');
            if ($selected.prev().length == 0) {
                $li.eq(-1).addClass('selected');
            }
            if (res) {
//                var consigneeId = $('li.selected').attr('id');
                var consignee = $('li.selected').text();
//                $('#name-id').val(consigneeId.replace("c", ""));
                $('#name').val(consignee);
            }

        } else if (e.which === 13) {
            e.preventDefault();
            var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
            var consigneeId = selected.replace("c", "");
            $('#name-id').val(consigneeId);
            $('#name').attr('attempt', 1);
//            $('#name').val(consigneename);
            $('#name-list-append').empty();

            $('#name').change(function (e) {
                $('#name').attr('attempt', 0);

            });
        }
    });
    $('#name').change(function () {
        if ($('#name').attr('attempt') != 1) {
            $('#name-id').val("");
        }

    });

    $('#consignment').keyup(function (e) {
        var nameId = $('#consignment-id').val();
        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $('#consignment').val();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/job-consignee.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'GETCONSIGNMENT'},
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (key === 0) {
                                    html += '<li id="c' + this.id + '" class="consignment">' + this.name + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="consignment">' + this.name + '</li>';
                                }
                            });
                            $('#consignment-list-append').empty();
                            $('#consignment-list-append').append(html);
                        }
                    });
                }
            }
        }
    });
    $('#consignment-list-append').on('click', '.consignment', function () {
        var consigneeId = this.id;
        var consignee = $(this).text();
        $('#consignment-id').val(consigneeId.replace("c", ""));
        $('#consignment').val(consignee);
        $('#consignment-list-append').empty();
        $('#consignment').change(function () {
            $('#consignment-id').val("");
        });
    });

    $('#consignment-list-append').on('mouseover', '.consignment', function () {
        var consigneeId = this.id;
        var consignee = $(this).text();
        $('#consignment-id').val(consigneeId.replace("c", ""));
        $('#consignment').val(consignee);
        $('#consignment').change(function () {
            $('#consignment-id').val("");
        });
    });
    $('#consignment').keypress(function (e) {

        var $selected = $('li.selected'), $li = $('li.consignment');
        if (e.keyCode == 40) {
            var res = $selected.removeClass('selected').next().addClass('selected');
            if ($selected.next().length == 0) {
                $li.eq(0).addClass('selected');
            }
            if (res) {
                var consignment = $('li.selected').text();
                $('#consignment').val(consignment);
                
            }
        } else if (e.keyCode === 38) {
            var res = $selected.removeClass('selected').prev().addClass('selected');
            if ($selected.prev().length == 0) {
                $li.eq(-1).addClass('selected');
            }
            if (res) {
                var consignment = $('li.selected').text();
                $('#consignment').val(consignment);
                
            }
        } else if (e.which === 13) {
            e.preventDefault();
            var selected = $('.selected').attr("id");
            $('#consignment').attr('attempt', 1);
            var consignmentId = selected.replace("c", "");
            $('#consignment-id').val(consignmentId);
            $('#consignment-list-append').empty();

            $('#consignment').change(function (e) {
                $('#consignment').attr('attempt', 0);

            });

        }
    });
    $('#consignment').change(function () {
        if ($('#consignment').attr('attempt') != 1) {
            $('#consignment-id').val("");
        }

    });

    $('#vesselAndFlight').keyup(function (e) {
        var vesselAndFlightId = $('#vesselAndFlight-id').val();
        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $('#vesselAndFlight').val();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/job-consignee.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'GETVESSELORFLIGHT'},
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (key === 0) {
                                    html += '<li id="c' + this.id + '" class="vesselAndFlight">' + this.name + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="vesselAndFlight">' + this.name + '</li>';
                                }
                            });
                            $('#vesselAndFlight-list-append').empty();
                            $('#vesselAndFlight-list-append').append(html);
                        }
                    });
                }
            }
        }
    });
    $('#vesselAndFlight-list-append').on('click', '.vesselAndFlight', function () {
        var vesselAndFlightId = this.id;
        var vesselAndFlight = $(this).text();
        $('#vesselAndFlight-id').val(vesselAndFlightId.replace("c", ""));
        $('#vesselAndFlight').val(vesselAndFlight);
        $('#vesselAndFlight-list-append').empty();

        $('#vesselAndFlight').change(function () {
            $('#vesselAndFlight-id').val("");
        });
    });
    $('#vesselAndFlight-list-append').on('mouseover', '.vesselAndFlight', function () {
        var vesselAndFlightId = this.id;
        var vesselAndFlight = $(this).text();
        $('#vesselAndFlight-id').val(vesselAndFlightId.replace("c", ""));
        $('#vesselAndFlight').val(vesselAndFlight);
        $('#vesselAndFlight').change(function () {
            $('#vesselAndFlight-id').val("");
        });
    });

    $('#vesselAndFlight').keypress(function (e) {

        var $selected = $('li.selected'), $li = $('li.vesselAndFlight');
        if (e.keyCode == 40) {
            var res = $selected.removeClass('selected').next().addClass('selected');
            if ($selected.next().length == 0) {
                $li.eq(0).addClass('selected');
            }
            if (res) {
                var vesselAndFlight = $('li.selected').text();
                $('#vesselAndFlight').val(vesselAndFlight);
                
            }
        } else if (e.keyCode === 38) {
            var res = $selected.removeClass('selected').prev().addClass('selected');
            if ($selected.prev().length == 0) {
                $li.eq(-1).addClass('selected');
            }
            if (res) {
                var vesselAndFlight = $('li.selected').text();
                $('#vesselAndFlight').val(vesselAndFlight);
                
            }
        } else if (e.which === 13) {
            e.preventDefault();
            var selected = $('.selected').attr("id");
            $('#vesselAndFlight').attr('attempt', 1);
            var vesselAndFlightId = selected.replace("c", "");
            $('#vesselAndFlight-id').val(vesselAndFlightId);
            $('#vesselAndFlight-list-append').empty();

            $('#vesselAndFlight').change(function (e) {
                $('#vesselAndFlight').attr('attempt', 0);

            });

        }
    });
    $('#vesselAndFlight').change(function () {
        if ($('#vesselAndFlight').attr('attempt') != 1) {
            $('#vesselAndFlight-id').val("");
        }

    });
});




