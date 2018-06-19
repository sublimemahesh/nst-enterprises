
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link href="css/job-costing-card.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div id="wrapper">        
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="table-header">JOB COSTING CARD</h1>
                </div>
            </div>

            <table class="table">

                    <tr>
                        <td>JOB NO:</td>
                        <td><input type="text" class=""></td>
                    </tr>
                    <tr>
                        <td>INVOICE NUMBER:</td>
                        <td><input type="text" class=""></td>
                    </tr>
                    <tr>
                        <td>CONSIGNEE</td>
                        <td><input type="text" class=""></td>
                    </tr>
                    <tr>
                        <td>CONSIGNMENT</td>
                        <td><input type="text" class=""></td>    
                    </tr>

            </table>

            <!--Table-->

            <table class="table2 table-bordered" border="1">

                <!--Table head-->
                <tr>
                    <th class="col-1"></th>
                    <th class="text-center table-td-width col-2">V/NO</th>
                    <th class="text-center table-td-width col-3">AMOUNT</th>
                    <th class="text-center table-td-width col-4">DESCRIPTION</th>
                    <th class="text-center table-td-width col-5">SUB TOTAL</th>
                </tr>
                <!--Table head-->

                <!--Table body-->
                <tr>
                    <td>D/O</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D/O EXTENSION</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <!--Table body-->

            </table>
            
            <table class="profit-table">
                <tr>
                    <td>GROSS PROFIT</td>
                    <td>11456.00</td>
                    <td>GRAND TOTAL</td>
                    <td>44555.00</td>
                </tr>
            </table>
        </div>
        
        




<!--        <div id="print_button">
            <a href="#" class="btn btn-success btn-lg" onClick="myFunction()">
                <span class="glyphicon glyphicon-print"></span> Print
            </a>
        </div>-->


        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script>

                $(document).ready(function () {
                    myFunction();
                });

                function myFunction() {
                    window.print();
                }
        </script>
    </body>
</html>
