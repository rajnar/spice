<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap, from Twitter</title>
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
        <script src="<?php echo base_url();?>public/assets/js/bootbox.js" rel="stylesheet"  />
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
        </script>
    </head>

    <body>
        <?php echo $header;?>
        <?php //print_r($products);?>
        <div class="container-fluid" style="min-height:400px">
            <div class="row-fluid" id="main_div">
                <div class="span12">
                    <?php
                    if(!empty($details_rs))
                    {
                    ?>
                    <div class="modal-header">
                        <span class="mydate">Date: <?php echo date('d/m/Y h:i:s a',strtotime($details_rs->date_added));?> </span>
                        <h3>Invoice: <?php echo $details_rs->invoice_number;?></h3>
                    </div>
                    <div class="modal-body">
                        <div>
                            <span class="field">Customer Name:</span>
                            <span class="value"><?php echo $details_rs->customer_name;?></span>
                        </div>
                        <div style="height:90px">
                            <span class="field">Address:</span>
                            <span class="value"><?php echo $details_rs->address.'<br>'.$details_rs->city.'<br>'.$details_rs->state.'<br>'.$details_rs->zip;?></span>
                        </div>
                        <div>
                            <span class="field">Contact Numbers:</span>
                            <span class="value"><?php echo $details_rs->phone_number1.', '.$details_rs->phone_number2;?></span>
                        </div>
                        <div>
                            <span class="field">Total Sale Amount:</span>
                            <span class="value"><?php echo $details_rs->total_sale_amount;?></span>
                        </div>
                        <div>
                            <span class="field">Discount:</span>
                            <span class="value"><?php echo $details_rs->discount;?></span>
                        </div>
                        <div>
                            <span class="field">Payable Amount:</span>
                            <span class="value"><?php echo $details_rs->amount_after_discount;?></span>
                        </div>
                        <div>
                            <span class="field">Paid Amount:</span>
                            <span class="value"><?php echo $details_rs->amount_paid;?></span>
                        </div>
                        <div>
                            <span class="field">Balance Amount:</span>
                            <span class="value"><?php echo $details_rs->balance_amount;?></span>
                        </div>
                        <div>
                            <span class="field">Products Sold (IMEI Numbers):</span>
                            <div class="span12" style="margin-left:0;margin-top:5px">
                                <table cellpadding="6" cellspacing="0" border="1" style="width:inherit">
                                    <?php
                                    $tot_imei = count($products);
                                    for($i=0;$i<$tot_imei;$i++)
                                    {
                                        if($i%5 == 0)
                                        {
                                            if($i != 0)
                                            {
                                                echo '</tr>';
                                            }
                                            echo '<tr>';
                                        }
                                        echo '<td>'.$products[$i]->imei_number.'</td>';
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                        <div id="sale_details" style="display:none">

                        </div>
                    </div>
                    <?php
                    }
                    else
                    {
                        echo 'Invalid Invoice ID';
                    }
                    ?>
                </div><!--/span-->
            </div><!--/row-->
            <hr>
            <footer>
                <p>&copy; Company 2012</p>
            </footer>
        </div><!--/.fluid-container-->

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