<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | New Sales</title>
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
			.error {
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
        <script src="<?php echo base_url();?>public/assets/js/bootbox.js" rel="stylesheet"/></script>
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
				
				$('.jsave_sale').live('click',function(){
                	$("#sale_form").submit();
            	});
				
				$("#sale_form").validate({
					rules: {
						customers_id: {
							required : true
						},
						discount: {
							number : true
						},
						vat: {
							required : true,
							number : true
						},
						payment_method: {
							required : true
						},
						 amount: {
							required : true,
							number:true
						},
						other_details: {
							required : true
						},
					},
					messages: {
						customers_id: {
							required : "Please Customer"
						},
						discount: {
							number : "Doscount Should be Number"
						},
						vat: {
							required :"Please Enter VAT",
							number : "VAT Should be Number"
						},
						payment_method: {
							required : "Please select Payment Method"
						},
						 amount: {
							required : "Please Enter Amount",
							number:"Amount Should be number"
						},
						other_details: {
							required : "Please enter Other Details"
						},
					},
					submitHandler: function()
					{
						$.ajax({
							type: "POST",
							url: '<?php echo site_url();?>sales/saveSale',
							data: $('#sale_form').serialize()+'&amount_after_discount='+$('#amount_after_discount').val(),
							//dataType:'json',
							beforeSend : function(){
							},
							success: function(Rdata){
								window.location.href='<?php echo site_url();?>sales/invoice/'+Rdata;
							},
							complete: function(){
							}
						});
					}
				});
				
                /*$('.jsave_sale').live('click',function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>sales/saveSale',
                        data: $('#sale_form').serialize()+'&amount_after_discount='+$('#amount_after_discount').val(),
                        //dataType:'json',
                        beforeSend : function(){
                        },
                        success: function(Rdata){
                            window.location.href='<?php echo site_url();?>sales/invoice/'+Rdata;
                        },
                        complete: function(){
                        }
                    });
                });*/
				
                $('#done').click(function(){
                    if($('#products').val() == '')
                    {
                        bootbox.alert("Please Select Products to Sell");
                    }
                    else
                    {
                        $.ajax({
                            type: "POST",
                            url: '<?php echo site_url();?>stock/getStockDetails',
                            data: 'products='+$('#products').val(),
                            beforeSend : function(){
                            },
                            success: function(data){
                                $('#sale_details').html(data).show();
                            },
                            complete: function(){
                            }
                        });
                    }
                });
                //$('.setheight').css('min-height',$(window).height()-230);
                $('#products').css('height',$(window).height()-330);
            });
        </script>
    </head>

    <body>
        <?php echo $header;?>

        <div class="container-fluid" style="min-height:400px">
            <div class="row-fluid" id="main_div">
                <div class="span12">
                    <form name="sale_form" id="sale_form" method="post" >
                        <div class="modal-header">
                            <h3>New Sale</h3>
                        </div>
                        <div class="modal-body">
                            <div><label>Select Products:
                                    <textarea name="products" id="products"></textarea>
                                </label></div>
                            <div class="btn btn-primary" id="done">Done</div>
                            
                            <div id="sale_details" style="display:none">
                                
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