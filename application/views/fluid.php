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
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
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

                jQuery("#customers_grid_tbl").jqGrid431({
                    url:'<?php echo site_url();?>customers/getCustomers',
                    datatype: "json",
                    mtype:"POST",
                    colNames:['Name','Address', 'City', 'State', 'Zip', 'Phone Number1','Phone Number2','Edit'],
                    colModel:[
                        {name:'username',index:'username',width:'10%'},
                        {name:'address',index:'address',width:'10%'},
                        {name:'city',index:'city',width:'10%'},
                        {name:'state',index:'state',width:'10%'},
                        {name:'zip',index:'zip',width:'10%'},
                        {name:'phone_number1',index:'phone_number1',width:'20%'},
                        {name:'phone_number2',index:'phone_number2',width:'20%'},
                        {name:'edit',index:'edit',width:'15%'}
                    ],
                    rowNum:10,
                    autowidth: true,
                    //rowList:[10,20,30],
                    pager: '#customers_grid_pager',
                    sortname: 'id',
                    viewrecords: true,
                    sortorder: "desc",
                    multiselect: false,
                    childGrid: true,
                    childGridIndex: "rows",
                    gridComplete:function(){
                        $('.span12 .ui-jqgrid-bdiv').css('overflow','hidden'); // hide horizontal scroll bar
                    }
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
                    <button class="btn btn-primary" data-toggle="button">Add Customer</button>
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
                            <table id="customers_grid_tbl" class="cs_gd"></table>
                            <div id="customers_grid_pager"></div>
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
