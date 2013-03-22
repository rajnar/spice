<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Sales</title>
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
       <!-- <script src="<?php //echo base_url();?>public/assets/js/jquery_mobile.js" type="text/javascript"></script>-->
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

                jQuery("#sales_grid_tbl").jqGrid431({
                    url:'<?php echo site_url();?>sales/getSales',
                    datatype: "json",
                    mtype:"POST",
                    colNames:['Invoice Number','Name','Total Sale Aamount','Discount (%)','Amount after Discount','Total Amount Paid','Balance Amount','Payment Method','Date Added','Pay Amount'],
                    colModel:[
                        {name:'invoice_number',index:'invoice_number',width:'10%'},
                        {name:'name',index:'name',width:'10%'},
                        {name:'total_sale_amount',index:'total_sale_amount',width:'10%'},
                        {name:'discount',index:'discount',width:'7%'},
                        {name:'amount_after_discount',index:'amount_after_discount',width:'13%'},
                        {name:'total_paid',index:'total_paid',width:'10%'},
                        {name:'balance',index:'balance',width:'10%'},
                        {name:'payment_method',index:'payment_method',width:'10%'},
                        {name:'date_added',index:'date_added',width:'20%'},
                        {name:'edit',index:'edit',width:'15%'}
                    ],
                    rowNum:18,
                    height:$(window).height()-230,
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

                $('#cnewSale').click(function(){
                    //$.mobile.changePage("<?php echo site_url();?>sales/newSale",{transition:"slide"});
                    window.location.href = '<?php //echo site_url();?>sales/newSale';
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
                <div class="span2" style="float:right;text-align:right">
                    <button class="btn btn-primary" id="cnewSale">Add Sale</button>
                </div>
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
                <div class="span12">
                    <!--<div class="hero-unit">
                      <h1>Hello, world!</h1>
                      <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                      <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
                    </div>-->
                    <div class="row-fluid">
                        <div class="span12">
                            <table id="sales_grid_tbl" class="cs_gd"></table>
                            <div id="sales_grid_pager"></div>
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
    </body>
</html>
