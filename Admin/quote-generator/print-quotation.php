<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Preview Quotation</title>
    </head>
    <style type="text/css">
        body{
            background-color:white;            
        }
        .wrapper{
            background-color:#FFF;
            width:903px;
            height:auto;
            margin:auto;
        }
        .name{
            background-color:#fff;
            height:40px;
            width:900px;
            float:left;
        }
        .body{
            margin-top: -20px;
        }
        .name_{
            background-color:#fff;
            height:90px;
            width:450px;
            float:left;
        }
        .payslip{
            background-color:#fff;
            height:90px;
            width:450px;
            float:left;
        }
        .payslip2{
            background-color:#fff;
            width:900px;
            float:left;
        }
        .payslip2_{
            padding-left:25px;
        }
        td{
            font-size:10px;}
        .box{	font-family:Tahoma, Geneva, sans-serif;}
        .box1{
            font-weight:bold;
            opacity:0;
            font-size:1px;}
        </style>

        <body onload="window.print()">
            <div class="wrapper">
                <?php
                session_start();
                include('../../include/dbconnection.php');

                $refNo = $_GET['id'];

                $query2 = mysql_query("SELECT * FROM quote_tmp_tb  where ref_id = '$refNo' ");
                $count = mysql_num_rows($query2);
                $quotationRows = mysql_fetch_array($query2);

                $purposeOfQuotation = $quotationRows['quotation_for'];
                $quoteTo = $quotationRows['quote_to'];
                $po_refNo = $quotationRows['po_ref_no'];
                $sales_location = $quotationRows['sales_location'];
                $delivery_period = $quotationRows['delivery_period'];
                $sales_person = $quotationRows['sales_person'];
                $quotation_validity = $quotationRows['quotation_validity'];
                $payment_terms = $quotationRows['payment_terms'];
                
                echo '<br></br><center><div class="body"><img src="lso_logo.png"></div></center>';
                echo '<center><h5>P.O Box 32907, Lusaka <br>'
                . ' House No. 9 Green Lane, Kabulonga, Lusaka <br>'
                . 'Tel: +260955 530303 /+260978405401 <br> '
                . ' <u>Email: sales@lsocontractors.com/crystalik2000@gmail.com </u>'
                . ' </h5></center>'
                . '';
                
                echo '<center><u style=" font-size: 20px">Quotation for ' . $purposeOfQuotation . '</u></center>';
                
                ?>
            <div class="body">
                <div class="name"></div>
                <div class="name_">                    
                    <style type="text/css">
                        .top1{
                            margin-left:2px;
                        }
                    </style>
                    <form method="post" action="" onSubmit="return proceed()">
                        <?php
                        ?>
                        <table border="0" align="left" width="800" class="top1" >
                            <tr>
                                <td class="box" width="" style=" color: black;font-size: 15px"><b>Quotation To : </b> <?php
                                    echo $quoteTo;
                                    ?></td>
                            </tr>
                            <tr>
                                <td class="box" style=" color: black;font-size: 15px"><b>Quotation No : </b><?php echo $count; ?></td>

                            </tr>
                            <tr>
                                <tr>
                                    <td class="box" style=" color: black;font-size: 15px"><b> TAX Number : </b> 1002069674 </td>

                                </tr>                                
                        </table>
                </div>
                <div class="payslip">
                    <style type="text/css">
                        .top3{
                            margin-right: 50px}
                        </style>
                        <table border="0" align="left" width="300"  class="top3" cellspacing="0">
                        <tr>
                            <td class="box" style=" color: black;font-size: 15px"><b>Date Of Quotation : </b><?php
                                $datePrinted = strtoTime(date("Y/m/d"));
                                $datePrint = date('F d, Y', $datePrinted);
                                echo $datePrint;
                                ?></td>                           
                        </tr>
                        <tr>
                            <td class="box" style=" color: black;font-size: 15px"><b>Sales Location : </b><?php echo $sales_location ?></td>

                            <tr>
                                <td class="box" style=" color: black; font-size: 15px"><b> Sales Person : </b><?php echo $sales_person; ?></td>

                            </tr>
                    </table>
                </div>
                </form>
                <br></br><br></br><br></br><br></br><br></br>
                <div class="payslip2">                       
                    <style>
                        table {
                            font-family: arial, sans-serif;
                            border-collapse: collapse;
                            width: 100%;
                        }

                        td, th {
                            border: 1px solid black;
                            text-align: left;
                            padding: 10px;
                        }

                    </style>

                    <table class="top1">
                        <tr style=" background-color: #0063dc">
                            <th>Sr No</th>
                            <th>Item / Part No</th>
                            <th>Dimensions</th>
                            <th>Square Meters</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                        </tr>

                        <?php
                        $query = "SELECT * FROM quote_items_temp_tb  where ref_id = '$refNo' ";
                        $result = mysql_query($query, $link) or die(mysql_error());
                        $subTotal = 0;
                        $id = 1;
                        $vat = 0;
                        $total = 0;
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <?php
                            $Item = $row['item_description'];
                            $pricinngQuery = mysql_query("SELECT * FROM pricing_tb WHERE id = '$Item'");
                            $rows = mysql_fetch_array($pricinngQuery);
                            $itemDescription = $rows['description'];
                            $unitPrice = $rows['unit_price'];


                            $Amount = $row['qty'] * $unitPrice;
                            $subTotal += $Amount;
                            echo '  
                            <tr>                          
                            <td style=" font-size: 15px">' . $id++ . '</td> 
                             <td style=" font-size: 15px">' . $itemDescription . '</td> 
                             <td style=" font-size: 15px">' . $row['dimensions'] . '</td>                                                       
                             <td style=" font-size: 15px">' . $row['SQM'] . '</td>                                                           
                             <td style=" font-size: 15px">' . $row['qty'] . '</td>
                             <td style=" font-size: 15px">' . $unitPrice . '</td>  
                            <td style=" font-size: 15px">' . $Amount . '</td>  
                            </tr>  
                            ';
                            ?>
                            <?php
                        }

                        $vat = (16 / 100) * $subTotal;
                        $total = $vat + $subTotal;

                        echo '  
                                                            <tr>                          
                                                            <td  border: 1px solid white;></td> 
                                                             <td  border: 1px solid white;></td> 
                                                             <td  border: 1px solid white;></td>                                                       
                                                             <td  border: 1px solid white;></td>                                                          
                                                             <td  border: 1px solid white;></td> 
                                                            <td style="font-size: 15px">Sub Total</td>  
                                                            <td  style="font-size: 15px">' . number_format($subTotal) . '</td>  
                                                        </tr>';
                        echo '  
                                                            <tr>                          
                                                             <td  border: 1px solid white;></td>  
                                                             <td  border: 1px solid white;></td> 
                                                             <td  border: 1px solid white;></td>                                                   
                                                             <td  border: 1px solid white;></td>                                                          
                                                             <td  border: 1px solid white;></td> 
                                                            <td style="font-size: 18px">Vat ( 16% )</td>  
                                                            <td  style="font-size: 18px">' . $vat . '</td>  
                                                        </tr>';
                        echo '  
                                                            <tr>                          
                                                            <td  border: 1px solid white;></td>  
                                                             <td  border: 1px solid white;></td> 
                                                            <td  border: 1px solid white;></td>                                                        
                                                             <td  border: 1px solid white;></td>                                                         
                                                             <td  border: 1px solid white;></td> 
                                                           <td style="font-size: 15px"><b>Total</b></td>    
                                                            <td style="font-size: 15px">' . $total . '</td>  
                                                        </tr>';
                        ?>
                    </table>
                    <br></br>
                    <left><div style="margin-left:30px;" class="body"><h4>Quote Validity : <?php echo $quotation_validity; ?> Days </h4></div></left>                   
                    <left><div style="margin-left:30px;" class="body"><h4>Delivery & Installation Period : <?php echo $delivery_period; ?> Days </h4></div></left>
                    <left><div style="margin-left:30px;" class="body"><h4>Payment Terms : <?php echo $payment_terms; ?> Days </h4></div></left>
                    <left><div style="margin-left:3px;" class="body"><img src="quote-footeer_1.PNG"></div></left>
                    <br></br><br>
                </div>
            </div>
        </div>
    </body>
</html>

