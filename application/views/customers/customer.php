<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Add Customers</title>
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
			div.error {
                color: red;
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
		<script src="<?php echo base_url();?>public/assets/js/validate.js" type="text/javascript"></script>
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
               /* $('.jsave_customer').live('click',function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php //echo site_url();?>customers/saveCustomer',
                        data: $('#customer_form').serialize(),
                        beforeSend : function(){
                        },
                        success: function(){
                        },
                        complete: function(){
                            window.location.href='<?php echo site_url();?>customers/';
                        }
                    });
                });*/
				
				$('.jsave_customer').live('click',function(){
                	$("#customer_form").submit();
            	})
				
				 $.validator.addMethod("checklenght1", function(value, phone_number1) {
					if($("#phone_number1").val().length != 10)
					{
						return false;
					}
					else
					{
						return true;
					}
				}, "");
				 /*$.validator.addMethod("checklenght2", function(value, phone_number2) {
					if($("#phone_number2").val().length != 10)
					{
						return false;
					}
					else
					{
						return true;
					}
				}, "");*/
				
				 $("#customer_form").validate({
                rules: {
                    first_name: {
                        required : true
                    },
                    last_name: {
                        required : true
                    },
					 address: {
                        required : true
                    },
                    city: {
                        required : true
                    },
					 state: {
                        required : true
                    },
                    zip: {
                        required : true,
						number: true
                    },
					 phone_number1: {
                        required : true,
						number: true,
						checklenght1: true
                    },
                    /*phone_number2: {
                        required : true,
						number: true,
						checklenght2: true
                    },*/
                },
                messages: {
                    first_name: {
                        required : "Please enter First Name"
                    },
                    last_name: {
                        required : "Please enter Last Name"
                    },
					 address: {
                        required : "Please Enter Address"
                    },
                    city: {
                        required : "Please enter City"
                    },
					 state: {
                        required : "Please enter State"
                    },
                    zip: {
                        required : "Please enter Zip",
						number :  "Zip should be number only"
                    },
					 phone_number1: {
                        required : "Please Enter Primary Contact Number",
						number :  "Primary Contact Number should be number only",
						checklenght1: "Primary Contact Number should be 10 digit number"
                    },
                    /*phone_number2: {
                        required : "Please enter Alternate Contact Number",
						number :  "Alternate Contact Number should be number only",
						checklenght2: "Alternate Contact Number should be 10 digit number"
                    },*/
                },
                submitHandler: function()
                {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>customers/saveCustomer',
                        data: $('#customer_form').serialize(),
                        beforeSend : function(){
                        },
                        success: function(){
                        },
                        complete: function(){
                            window.location.href='<?php echo site_url();?>customers/';
                        }
                    });
                }
            });
				
            });
        </script>
    </head>

    <body>
        <?php echo $header;?>

        <div class="container-fluid" style="min-height:400px">
            <div class="row-fluid" id="main_div">
                <div class="span12">
                    <form name="customer_form" id="customer_form" method="post" >
                        <input type="hidden" name="id" value="<?php echo $cus_data->id;?>">
                        <div class="modal-header">
                            <h3>New Customer</h3>
                        </div>
                        <div class="modal-body">
                           <div><label>First Name: <input type="text" name="first_name" id="first_name" value="<?php echo $cus_data->first_name;?>"></label></div>
                            <div><label>Last Name: <input type="text" name="last_name" id="last_name" value="<?php echo $cus_data->last_name;?>"></label></div>
                            <div><label>Address: <textarea name="address" id="address"><?php echo $cus_data->address;?></textarea></label></div>
                            <div><label>City: <input type="text" name="city" id="city" value="<?php echo $cus_data->city;?>"></label></div>
                            <div><label>State: <input type="text" name="state" id="state" value="<?php echo $cus_data->state;?>"></label></div>
                            <div><label>Zip: <input type="text" name="zip" id="zip" maxlength="6" value="<?php echo $cus_data->zip;?>"></label></div>
                            <div><label>Primary Contact Number: <input type="text" name="phone_number1" id="phone_number1" value="<?php echo $cus_data->phone_number1;?>" maxlength="10"></label></div>
                            <div><label>VAT(TIN): <input type="text" name="phone_number2" id="phone_number2" value="<?php echo $cus_data->phone_number2;?>" maxlength="10"></label></div>

                            <div>
                                <a href="#" class="btn btn-primary jsave_customer">Save changes</a>
                            </div>
                        </div>

                    </form>
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