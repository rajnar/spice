<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Reports</title>
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
            input, .uneditable-input {
                width:25px;
            }
            select{
                width:150px;
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
       <!-- <script src="<?php //echo base_url();?>public/assets/js/jquery_mobile.js" type="text/javascript"></script>-->
        <script src="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/js/i18n/grid.locale-en.js" type="text/javascript" language="javascript"></script>
        <script src="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/src/grid.base.js" type="text/javascript" language="javascript"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/assets/js/jquery-ui-1.8.21/css/smoothness/jquery-ui-1.8.21.custom.css" />
        <link href="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/src/css/ui.jqgrid.css" rel="stylesheet"  />
		<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>public/assets/js/jquery-ui-1.8.21/js/jquery-ui-1.8.21.custom.min.js" ></script>
        <script>
            $(document).ready(function(){
                $.ajaxSetup({
                    jsonp: null,
                    jsonpCallback: null
                });

                $('.pn').click(function(){
                    $('.active').removeClass('active');
                    $(this).addClass('active');
                });
			$('.jexcel').live('click',function(){
				var cust_id = $('#customers').val();
				var fromdate = $('.jfrom').val();
				var todate = $('.jto').val();
				var qry_str = "customer_id="+cust_id+"&fromdate="+fromdate+"&todate="+todate;
				$.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>reports/generateExcel',
                        data: qry_str,
                        dataType:'json',
                        beforeSend : function(){
                        },
                        success: function(data){
							if(data.error_code == '301')
							{
								$('#error_msg').show();
                                var html = '<div>'+data.error_msg+'</div>'
                                html += '<div style="float:right"><input type="button" class="ok" name="ok" value="OK"></div>';
                                $('#msg_body').html(html);
                                $.blockUI({ message: ''});
							}
                        },
                        complete: function(){
                        }
                    });
			});	
			$('.jgetrep').live('click',function(){
				$('#report_grid').html('<table id="sales_grid_tbl" class="cs_gd"></table><div id="sales_grid_pager"></div>')
				var cust_id = $('#customers').val();
				var fromdate = $('.jfrom').val();
				var todate = $('.jto').val();
				var qry_str = "customer_id="+cust_id+"&fromdate="+fromdate+"&todate="+todate;
                jQuery("#sales_grid_tbl").jqGrid431({
						url:'<?php echo site_url();?>reports/getCustomresInvData?'+qry_str,
						datatype: "json",
						mtype:"POST",
						colNames:['Invoice Number','Name','Address','Total Sale Amount(Rs)','Discount(Rs.)','Amount After Discount(Rs.)','VAT','Total Amount(Rs)','Total Amount Paid(Rs)','Balance Amount(Rs)','Invoice Date'],
						colModel:[
							{name:'invoice_number',index:'invoice_number',width:'7%'},
							{name:'name',index:'name',width:'10%'},
							{name:'address',index:'address',width:'12%'},
							{name:'total_sale_amount',index:'total_sale_amount',width:'8%',align:"right"},
							{name:'discount',index:'discount',width:'7%',align:"right"},
							{name:'amount_after_discount',index:'amount_after_discount',width:'7%',align:"right"},
							{name:'vat_amount',index:'vat_amount',width:'7%',align:"right"},
							{name:'total_amount',index:'total_amount',width:'8%',align:"right"},
							{name:'total_paid',index:'total_paid',width:'8%',align:"right"},
							{name:'balance',index:'balance',width:'7%',align:"right"},
							{name:'date_added',index:'date_added',width:'8%'}
						],
						rowNum:10,
						height:$(window).height()-150,
						autowidth: true,
						//rowList:[10,20,30],
						pager: '#sales_grid_pager',
						sortname: 'id',
						viewrecords: true,
						sortorder: "desc",
						multiselect: false,
						childGrid: true,
						childGridIndex: "rows",
						gridComplete:function(){
							$('.span12 .ui-jqgrid-bdiv').css('overflow-x','hidden'); // hide horizontal scroll bar
						}
					});
                });
				
				if($('.jfrom').length>0){
                    $('.jfrom').datepicker({beforeShow: customRange2_Year,dateFormat:'dd-mm-yy', changeMonth: true, changeYear: true});
                }

                if($('.jto').length>0){
                    $('.jto').datepicker({beforeShow: customRange_Year,dateFormat:'dd-mm-yy', changeMonth: true, changeYear: true});
                }
				
				$('.ok').live('click',function(){
				$('#error_msg').hide();
					//window.location.href='<?php //echo site_url()?>stock';
				});
				$('.close').live('click',function(){
					$.unblockUI();
					$('#error_msg').hide();
				});
				
            });
            function refreshWindow()
            {
                document.location.reload();
            }
			
			function customRange_Year(input) {
                if($.trim($("#from").val())!=''){
                    from_date=$("#from").datepicker("getDate");
                    from_date.setMonth(from_date.getMonth() + 12);

                    return {
                        maxDate: (input.id == "to" ? from_date : null),
                        minDate: (input.id == "to" ? $("#from").datepicker("getDate") : null)
                    };
                }else{
                    return {
                        minDate: (input.id == "to" ? $("#from").datepicker("getDate") : null)
                    };
                }
            }

            function customRange2_Year(input) {
                if($.trim($("#to").val())!=''){
                    to_date=$("#to").datepicker("getDate");
                    to_date.setMonth(to_date.getMonth() - 12);

                    return {
                        maxDate: (input.id == "from" ? $("#to").datepicker("getDate") : null),
                        minDate: (input.id == "from" ? to_date : null)
                    };
                }else{
                    return {
                        maxDate: (input.id == "from" ? $("#to").datepicker("getDate") : null)
                    };
                }
            }
        </script>
    </head>

    <body>
        <?php echo $header;
		//echo '<pre>';print_r($cutomers);die;
		?>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="modal-body setheight">
					<div><label><h3>Invoice Report</h3> </label></div>
					<div style="width:30%">
                        <label>From Date:
                            <input type="text" name="from" id="from" class="jfrom" style="width:150px" ></div>
                        </label>
                    <div style="width:30%">
                        <label>To Date:
                            <input type="text" name="to" id="to" class="jto" style="width:150px"></div>
                        </label>
					<div><label>Customers:
							<select name="customers" id="customers">
								<option value="all">All</option>
								<?php
								foreach($cutomers as $key=>$value) {
									?>
								<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php
								}
								?>
							</select>
						</label>
					</div>
					<div>
						<a href="#" class="btn btn-primary jgetrep">Get Report</a>
						
						<a href="#" class="btn btn-primary jexcel">Download Excel</a>
					</div>
				</div>
            </div>
            <div class="row-fluid">
                <div>&nbsp;</div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span12" id='report_grid'>
                            
                        </div><!--/span-->
                    </div><!--/row-->
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
	<div class="modal hide fade in" id="error_msg"  style="display:none">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3>Alert</h3>
        </div>
        <div class="modal-body" id="msg_body">
        </div>
    </div>	
    </body>
</html>
