<html>
    <head>
        <style>
            /*            .display_box_hover{
                            background-color:#901C51;
                            font-weight:bold;
                            cursor:pointer;
                            color:#FFF;     
                            display: block;
                        }
            
                        #cityresultscontainer
                        {
                            position:relative;}
            
            
                        #cityresults
                        {
                            display:none;
                            position:absolute;
                            z-index:1;
                            width:200px;
                            background-color:#FFF;
                            -webkit-border-bottom-left-radius:3px;-moz-border-radius-bottomleft:3px;border-bottom-left-radius:3px;
                            -webkit-border-bottom-right-radius:3px;-moz-border-radius-bottomright:3px;border-bottom-right-radius:3px;
                            border:1px solid #DDD;
                        }
            
                        #cityresults span{
                            width:192px;
                            float:left;
                            padding:4px;
                            font-weight:bold;
                        }
            
                        #cityresults ul
                        {
                            list-style-type:none;
                            padding: 0;
                        }
            
                        #cityresults li a{
                            width:192px;
                            float:left;
                            padding:4px;
                        }
                        #cityresults li a:hover{
                            text-decoration:none;
                            background-color:#901C51;
                            font-weight:bold;
                            cursor:pointer;
                            color:#FFF; 
                        }
            
                        #cityresults li:hover{
                            background-color:#901C51;
                            font-weight:bold;
                            cursor:pointer;
                            color:#FFF; 
                        }
            
            
            
                        #cityresults span:hover{
                            background-color:#901C51;
                            font-weight:bold;
                            cursor:pointer;
                            color:#FFF; 
                        }*/

            li{
                display:block;
                width:100px;
                height:20px;
                border:1px solid #ccc;
                margin-bottom:5px;
            }

            .hlight{
                background:yellow;
            }
        </style>

    </head>
    <body>
        <input type="text" name="name" id="name">
        <li class="hlight">111</li>
        <li>222</li>
        <li>333</liv>
        <li>444</li>
        <li>555</li>
        <li>666</li>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script>
//            $(document).ready(function () {
//                window.displayBoxIndex = -1;
//                $('#cityresults').on('click', 'li', function () {
//                    $('#city').val($(this).text());
//                    $('#cityresults').hide('');
//                    $('#citygeonameid').val($(this).parent().attr('data-id'));
//                    return false;
//                });
//                var Navigate = function (diff) {
//
//                    displayBoxIndex += diff;
//
//                    var oBoxCollection = $("#cityresults ul li");
//
//                    if (displayBoxIndex >= oBoxCollection.length) {
//                        displayBoxIndex = 0;
//                    }
//                    if (displayBoxIndex < 0) {
//                        displayBoxIndex = oBoxCollection.length - 1;
//                    }
//
//                    var cssClass = "display_box_hover";
//                    oBoxCollection.removeClass(cssClass).eq(displayBoxIndex).addClass(cssClass);
//
//                }
//                $(document).on('keypress keyup', function (e) {
//                    if (e.keyCode == 13 || e.keyCode == 32) {
//                        $('.display_box_hover').trigger('click');
//                        return false;
//                    }
//                    if (e.keyCode == 40) {
//                        //down arrow
//                        Navigate(1);
//                    }
//                    if (e.keyCode == 38) {
//                        //up arrow
//                        Navigate(-1);
//                    }
//                });
//            });


            $(document).ready(function () {
                
                $('#name').keyup(function (e) {
                    var $hlight = $('li.hlight'), $li = $('li');
                    if (e.keyCode == 40) {
                        $hlight.removeClass('hlight').next().addClass('hlight');
                        if ($hlight.next().length == 0) {
                            $li.eq(0).addClass('hlight')
                        }
                    } else if (e.keyCode === 38) {
                        $hlight.removeClass('hlight').prev().addClass('hlight');
                        if ($hlight.prev().length == 0) {
                            $li.eq(-1).addClass('hlight')
                        }
                    }
                });
            });
        </script>

    </body>
</html>