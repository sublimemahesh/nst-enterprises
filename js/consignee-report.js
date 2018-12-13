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
                    if (keyword == '') {
                        $('#name-list-append').empty();
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/job-consignee.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'GETNAME'},
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (key < 8) {
                                    if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                        html += '<li id="c' + this.id + '" class="name selected">' + this.name + '</li>';
                                    } else {
                                        html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                    }
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

            var consigneename = $('li.selected').text();
            $('#name').val(consigneename);

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
});
