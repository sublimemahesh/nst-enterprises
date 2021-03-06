$(document).ready(function () {
    
    $('#name').keyup(function (e) {
        var nameId = $('#name-id').val();
        if (e.which != 38) {
            if (e.which != 40) {
                if (e.which != 13) {
                    var keyword = $('#name').val();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/consignee-name.php',
                        dataType: "json",
                        data: {keyword: keyword, option: 'GETNAME'},
                        success: function (result) {

                            var html = '';
                            $.each(result, function (key) {
                                if (nameId !== this.id) {
                                    if (key === 0) {
                                        html += '<li id="c' + this.id + '" class="name selected">' + this.name + '</li>';
                                    } else {
                                        html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                    }
                                }
                            });
                            
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
    });
//    $('#name-list-append').on('mouseover', '.name', function () {
//        var consigneeId = this.id;
//        var consignee = $(this).text();
//        $('#name-id').val(consigneeId.replace("c", ""));
//        $('#name').val(consignee);
//    });

    $('#name').bind('keypress keydown keyup', function (e) {
        
        if (e.keyCode == 13) {
            e.preventDefault();
        }

        var li = $('#name .name');
        var liSelected;
        var next = '';
        if (e.which === 40) {
            if (liSelected) {
                liSelected.removeClass('selected');
                next = liSelected.next();
                if (next.length > 0) {
                    liSelected = next.addClass('selected');
                } else {
                    liSelected = li.eq(0).addClass('selected');
                }
            } else {
                liSelected = li.eq(0).addClass('selected');
            }
        } else if (e.which === 38) {
            if (liSelected) {
                liSelected.removeClass('selected');
                next = liSelected.prev();
                if (next.length > 0) {
                    liSelected = next.addClass('selected');
                } else {
                    liSelected = li.last().addClass('selected');
                }
            } else {
                liSelected = li.last().addClass('selected');
            }
        } else if (e.which === 13) {
            var selected = $('.selected').attr("id");
            var consigneename = $('.selected').text();
            var consigneeId = selected.replace("c", "");
            $('#name-id').val(consigneeId);
            $('#name').val(consigneename);
            $('#name-list-append').empty();
        }
    });
    
    $('#address').click(function () {
        var name = $('#name-id').val();
        $.ajax({
            type: 'POST',
            url: 'ajax/consignee-name.php',
            dataType: "json",
            data: {id: name, option: 'FINDNAME'},
            success: function (result) {
                if (result.id) {
                    $(".create-consignee").addClass("hidden");
                } else {
                    $(".create-consignee").removeClass("hidden");
                }

            }
        });
        $('#name').keyup(function (e) {
            $('#name-id').val('');
        });
    });
    $('#create-user').click(function () {
        var name = $('#name').val();
        window.location.replace('create-user.php?name=' + name);
    });



    $('#btn-consignee').click(function (e) {
        e.preventDefault();
        var name = $('#name-id').val();

        $.ajax({
            type: 'POST',
            url: 'ajax/consignee-name.php',
            dataType: "json",
            data: {id: name, option: 'FINDNAME'},
            success: function (result) {
                if (result.id) {
                    $(".create-consignee").addClass("hidden");
                    $("#form-consignee").submit();
                } else {
                    $(".create-consignee").removeClass("hidden");
                }

            }

        });
    });
});

$(window).load(function() {
    $('#name-id').val("");
});



