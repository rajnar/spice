<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Stock</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url();?>public/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 60px;
                /*padding-bottom: 10px;*/
            }
            .sidebar-nav {
                padding: 9px 0;
            }
            .custom_bg {
                background:#E8E8E8;
            }
            .custom_border{
                border:1px solid #aaaaaa;
            }
            input, .uneditable-input {
                width:16px;
            }
            select{
                width:50px;
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

                $('.pn').click(function(){
                    $('.active').removeClass('active');
                    $(this).addClass('active');
                });

                jQuery("#stock_grid_tbl").jqGrid431({
                    url:'<?php echo site_url();?>stock/getStock',
                    datatype: "json",
                    mtype:"POST",
                    colNames:['Model Number','Model Name','Price','IMEI Number'],
                    colModel:[
                        {name:'model_number',index:'model_number',width:'25%'},
                        {name:'name',index:'name',width:'25%'},
                        {name:'price',index:'price',width:'25%'},
                        {name:'imei_number',index:'imei_number',width:'25%'}
                    ],
                    rowNum:20,
                    height: 470,//$(window).height()-$('.mycls').height()-500,
                    autowidth: true,
                    rowList:[10,20,30],
                    pager: '#stock_grid_pager',
                    sortname: 'id',
                    viewrecords: true,
                    sortorder: "desc",
                    multiselect: false,
                    childGrid: true,
                    childGridIndex: "rows",
                    caption: 'Detailed Stock Details',
                    hiddengrid: true,
                    gridComplete:function(){
                        $('#stock_grid .ui-jqgrid-bdiv').css('overflow-x','hidden'); // hide horizontal scroll bar
                        //$('#stock_grid').find('.ui-jqgrid-titlebar-close').trigger('click');
                    }
                });
                
                jQuery("#stockov_grid_tbl").jqGrid431({
                    url:'<?php echo site_url();?>stock/getStockOverview',
                    datatype: "json",
                    mtype:"POST",
                    colNames:['Model Number','Model Name','Price','Current Available Stock (Pieces)'],
                    colModel:[
                        {name:'model_number',index:'model_number',width:'25%'},
                        {name:'name',index:'name',width:'25%'},
                        {name:'price',index:'price',width:'25%'},
                        {name:'total_pieces',index:'total_pieces',width:'25%'}
                    ],
                    rowNum:20,
                    height: 300,
                    autowidth: true,
                    rowList:[10,20,30],
                    pager: '#stockov_grid_pager',
                    sortname: 'name',
                    viewrecords: true,
                    sortorder: "desc",
                    multiselect: false,
                    childGrid: true,
                    childGridIndex: "rows",
                    caption: 'Stock Overview',
                    gridComplete:function(){
                        $('#stockov_grid .ui-jqgrid-bdiv').css('overflow-x','hidden'); // hide horizontal scroll bar
                    }
                });
				
				$('.jexcel').live('click',function(){
                    var qry_str = '';
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>stock/generateExcel',
                        data: qry_str,
                        dataType:'json',
                        beforeSend : function(){
							$('#loading').show();
                        },
                        success: function(retdata){
							$('#loading').hide();
                            if(retdata.error_code == '301')
                            {
                                $('#error_msg').show();
                                var html = '<div>'+retdata.error_msg+'</div>'
                                html += '<div style="float:right"><input type="button" class="ok" name="ok" value="OK"></div>';
                                $('#msg_body').html(html);
                                $.blockUI({ message: ''});
                            }
                            else
                            {
                                $('.jexcel').hide();
								$('#downloadexcel').show();
								html = '<a href="<?php echo site_url();?>reports/download/'+retdata.filename+'" class="btn btn-primary jexceldl">Download Excel</a>';
								$('#downloadexcel').html(html);
                                //$('.jexceldl').show();
                            }
                        },
                        complete: function(){
                        }
                    });
                });

            });
            function refreshWindow()
            {
                document.location.reload();
            }
        </script>
    </head>

    <body OnResize="refreshWindow()">
        <?php echo $header;?>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span2" style="float:right;text-align:right;padding-bottom:10px">
                    <a class="btn btn-primary" href="<?php echo site_url();?>stock/add_stock">Add Stock</a>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12 mycls" id="stockov_grid">
                    <table id="stockov_grid_tbl" class="cs_gd"></table>
                    <div id="stockov_grid_pager"></div>
                    <?php /*<table border="1" class="custom_border" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="custom_bg">Model Name</td>
                            <td class="custom_bg">Model Number</td>
                            <td class="custom_bg">Price</td>
                            <td class="custom_bg">Current Available Stock (Pieces)</td>
                        </tr>
                        <?php
                        foreach($stock_overview as $model)
                        {?>
                        <tr>
                            <td><?php echo $model->name;?></td>
                            <td><?php echo $model->model_number;?></td>
                            <td><?php echo $model->price;?></td>
                            <td><?php echo $model->total_pieces;?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>*/?>
                </div>
            </div>
            <div class="row-fluid">
                <div>&nbsp;</div>
            </div>
			<div>
				<span id="exportexcel"><a href="#" class="btn btn-primary jexcel">Export to Excel</a></span>
				<span id="downloadexcel" style="display:none"></span>
				<span id="loading" style="display:none"> <strong>Loading...Please wait</strong></span>
			</div>

            <div class="row-fluid">
                <div>&nbsp;</div>
            </div>
            <div class="row-fluid">
                <!-- <div class="span3">
                  <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                      <li class="nav-header">Sidebar</li>
                      <li class="active"><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li class="nav-header">Sidebar</li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li class="nav-header">Sidebar</li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                      <li><a href="#">Link</a></li>
                    </ul>
                  </div><!--/.well -->
                <!-- </div><!--/span-->
                <div class="span12" id="stock_grid">
                    <!--<div class="hero-unit">
                      <h1>Hello, world!</h1>
                      <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                      <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
                    </div>-->
                    <table id="stock_grid_tbl" class="cs_gd"></table>
                    <div id="stock_grid_pager"></div>
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
        <div class="modal hide fade in" id="myStock"  style="display:none">
            <form name="stock_form" id="stock_form" method="post" >
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>New Stock</h3>
                </div>
                <div class="modal-body">
                    <div><label>Model:
                            <select name="models_id" id="models_id">
                                <option value="">Select Model</option>
                                <?php
                                foreach($models as $model)
                                {
                                ?>
                                <option value="<?php echo $model->id;?>"><?php echo $model->name;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div><label>Products:
                            <textarea name="imei_number" id="imei_number"></textarea>
                        </label></div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary jsave_stock">Save changes</a>
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </body>
</html>
