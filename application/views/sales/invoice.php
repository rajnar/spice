<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Invoice</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url();?>public/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 60px;
                /*padding-bottom: 40px;*/
            }
            .sidebar-nav {
                padding: 9px 0;
            }
            .bold{
                font-weight:bold
            }
            .mydate{
                float: right;
                font-size: 12px;
                line-height: 18px;
                color: #000000;
                text-shadow: 0 1px 0 #ffffff;
                opacity: 0.8;
                filter: alpha(opacity=20);
            }
            .field{
                width:30%;
                float:left;
            }
            .value{
                width:70%;
                float:right;
            }
            .modal-body > div{
                height:20px
            }
            @media print {
                #myHeader, #myFooter, #butblock { display: none }
                .modal-body {padding:4px}
                body {font-size:8px}
            }

        </style>
        <link href="<?php echo base_url();?>public/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
        <script src="<?php echo base_url();?>public/assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootbox.js" rel="stylesheet"  /></script>
    <script src="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/js/i18n/grid.locale-en.js" type="text/javascript" language="javascript"></script>
    <script src="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/src/grid.base.js" type="text/javascript" language="javascript"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/assets/js/jquery-ui-1.8.21/css/smoothness/jquery-ui-1.8.21.custom.css" />
    <link href="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/src/css/ui.jqgrid.css" rel="stylesheet"  />
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                jsonp: null,
                jsonpCallback: null
            });

            $('#main_div').css('min-height',$(window).height()-130);
        });

        function printPage()
        {
            window.print();
            return true;
        }
    </script></head>

<body>
    <div id="myHeader">
        <?php echo $header;?>
    </div>
    <?php //print_r($products);?>
    <div class="container-fluid" style="min-height:400px">
        <div class="row-fluid" id="main_div">
            <div class="span12">
                <?php
                if(!empty($details_rs)) {
                    ?>
                <div >
                    <h3 align="center"><u>RETAIL/TAX INVOICE</u></h3>
                </div>
                <div class="modal-header">
                    <span class="mydate">Invoice Date: <?php echo date('d/m/Y h:i:s a',strtotime($details_rs->date_added));?> </span>
                    <h4>Invoice No.: <?php echo 'SIREE'.str_pad($details_rs->invoice_number,8,"0",STR_PAD_LEFT);?></h3>
                </div>
                <div class="modal-body">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                        <tr>
                            <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="50%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="0">
                                                <tr>
                                                    <td colspan='2' align="left" valign="top"><strong>Seller Details</strong></td>
                                                </tr>
                                                <tr>
                                                    <td width="20%">Name</td>
                                                    <td width="80%">SIREE MOBILES(Allapur)</td>
                                                </tr>
                                                <tr>
                                                    <td valign="top" align="left">Address</td>
                                                    <td align="left" valign="top">H.No 14-20-577/230, Vivekananda Nagar, Allapur</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td height="25">9000530053</td>
                                                </tr>
                                                <tr>
                                                    <td>VAT(TIN)</td>
                                                    <td>--</td>
                                                </tr>
                                            </table></td>
                                        <td width="50%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="0">
                                                <tr>
                                                    <td colspan='2' align="left" valign="top"><strong>Buyer Details</strong></td>
                                                </tr>
                                                <tr>
                                                    <td width="20%">Name</td>
                                                    <td width="80%" align="left"><?php echo $details_rs->customer_name;?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top">Address</td>
                                                    <td align="left" valign="top"><?php echo $details_rs->address.', '.$details_rs->city.', '.$details_rs->state.', '.$details_rs->zip;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td align="left"><?php echo $details_rs->phone_number1;?></td>
                                                </tr>
                                                <tr>
                                                    <td>VAT(TIN)</td>
                                                    <td align="left"><?php echo $details_rs->phone_number2;?></td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                </table></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-body">
                    <table width="100%" border="1" cellpadding="2" cellspacing="1" style="border:#999999">
                        <tr>
                            <td width="4%" align="center">Sr No</td>
                            <td width="18%" align="center">PRODUCT DESCRIPTION</td>
                            <td width="5%" align="center">Qty</td>
                            <td width="10%" align="center">RATE/Ut. Amount<br>(Rs.)</td>
                            <td width="10%" align="center">Sch Pre Vat(Amt.)<br>(Rs.)</td>
                            <td width="12%" align="center">Net Amount<br>(Rs.)</td>
                            <td width="8%" align="center">VAT(%)</td>
                            <td width="8%" align="center">VAT Amount<br>(Rs.)</td>
                            <td width="8%" align="center">Sch Post Vat(Amt.)<br	>(Rs.)</td>
                            <td align="center">TOTAL Amount<br>(Rs)</td>
                        </tr>
                        
    <?php
                                        //echo '<pre>'; print_r($products);die;
                                        $i = 1;
                                        $total_qty = 0;
                                        $total_netamt = 0;
                                        foreach($products as $key=>$values) {
                                            $total_qty = $total_qty+$values->qty;
                                            $total_netamt = $total_netamt+$values->total_price;
                                            ?>
                                    <tr>
                                        <td width="4%"><?php echo $i;?></td>
                                        <td width="18%"><?php echo $values->model_number.'-'.$values->name;?></td>
                                        <td width="5%" align="center"><?php echo $values->qty;?></td>
                                        <td width="10%" align="right"><?php echo number_format($values->price, 2, '.', ','); ?></td>
                                        <td width="10%" align="right"><?php echo '0.00';?></td>
                                        <td width="12%" align="right"><?php echo number_format($values->total_price, 2, '.', ',');?></td>
                                        <td width="8%" align="center"><?php echo '---';?></td>
                                        <td width="8%" align="center"><?php echo '--';?></td>
                                        <td width="8%" align="right"><?php echo '0.00';?></td>
                                        <td align="right"><?php echo number_format($values->total_price, 2, '.', ',');?></td>
                                    </tr>
        <?php
        $i++;
                                        }
                                        ?>
                                
                    </table>
                    <table width="100%" border="0" cellpadding="2" cellspacing="0">
                        <tr>
                            <td align="left" valign="top">&nbsp;</td>
                            <td align="left" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left" valign="top"><strong>PRODUCT DESCRIPTION </strong></td>
                            <td align="left" valign="top"><strong>IMEI NUMBERS </strong></td>
                        </tr>

    <?php
    //echo '<pre>'; print_r($products_details);
                            foreach($products_details as $product=>$imeinum) {
                                ?>
                        <tr>
                            <td width="20%"><?php echo $product;?></td>
                            <td width="80%"><?php echo implode(", ", $imeinum);?></td>
                        </tr>
    <?php
    }


                            ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>



                    <table width="100%" border="1" cellpadding="2" cellspacing="1" style="border:#999999">
                        <tr>
                            <td width="22%" align="center">TOTAL</td>
                            <td width="5%" align="center"><?php echo $total_qty;?></td>
                            <td width="10%" align="center">---</td>
                            <td width="10%" align="right">0.00</td>
                            <td width="12%" align="right"><?php echo  number_format($total_netamt, 2, '.', ',');?></td>
                            <td width="8%" align="center">---</td>
                            <td width="8%" align="left">VAT (Amt.)</td>
                            <td width="8%" align="center">---</td>
                            <td align="right"><?php echo  number_format($total_netamt, 2, '.', ',');?></td>
                        </tr>

                        <tr>
                            <td colspan="9"><table width="100%" border="0" cellpadding="1" cellspacing="0">
                                    <tr>
                                        <td><table width="35%" border="0" align="right" cellpadding="1" cellspacing="5">
                                                <tr>
                                                    <td width="70%">Cash Discount (Rs.) (-)</td>
                                                    <td width="30%" align="right"><?php echo number_format($details_rs->discount_amount, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td width="70%">VAT @ <?php echo $details_rs->vat.'%'?>(Rs.) (+)</td>
                                                    <td width="30%" align="right"><?php echo number_format($details_rs->vat_amount, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td width="70%">Total Amount (Rs.)</td>
                                                    <td width="30%" align="right"><?php echo number_format($details_rs->amount_with_vat, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td>Net Amount Paid (Rs.) </td>
                                                    <td align="right"><?php echo number_format($details_rs->amount_paid, 2, '.', '') ;?></td>
                                                </tr>
                                                <tr>
                                                    <td>Balance Amount (Rs.) </td>
                                                    <td align="right"><?php echo number_format($details_rs->balance_amount, 2, '.', '') ;?></td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr>
                                        <td>PRODUCT DESCRIPTION</td>
                                    </tr>

                                </table></td>
                        </tr>
                        <tr>
                            <td colspan="9">Narration for scheme/Discount (if any)</td>
                        </tr>
                    </table>

                    <table width="100%" border="0">
                        <tr>
                            <td colspan="3">Declaration:<br>
				(Can be customised as per state legislation requirement)</td>
                        </tr>
                        <tr>
                            <td align="right">&nbsp;</td>
                            <td align="center">For SIREE MOBILES</td>
                            <td align="right">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">&nbsp;</td>
                            <td align="right">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">&nbsp;</td>
                            <td align="right">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="72%" align="right">&nbsp;</td>
                            <td width="26%" align="center">Authorised Signetory</td>
                            <td width="2%" align="right">&nbsp;</td>
                        </tr>
                    </table>
<?php
}
else {
                        echo 'Invalid Invoice ID';
                    }
                    ?>
                </div><!--/span-->
            </div><!--/row-->
            <div id='butblock'><button id="printThatText" name="printThatText" onClick="printPage();">Print this page</button></div>
        </div><!--/.fluid-container-->
        <div id="myFooter">

            <hr>
            <footer>
                <p>&copy; Company 2012</p>
            </footer>
        </div>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-transition.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-alert.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-modal.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-scrollspy.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-tab.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-popover.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-button.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-collapse.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-carousel.js"></script>
        <script src="<?php echo base_url();?>public/assets/js/bootstrap-typeahead.js"></script>
</body>
</html>