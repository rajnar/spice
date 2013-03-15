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
                $('.jreturn_sale').live('click',function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>sales/returnSaleSave',
                        data: $('#return_sale_form').serialize(),
                        beforeSend : function(){
                        },
                        success: function(){
                        },
                        complete: function(){
                            window.location.href='<?php echo site_url();?>stock/';
                            /*jQuery("#sales_grid_tbl").trigger("reloadGrid");
                            $('#mySale').find('.close').trigger('click');*/
                        }
                    });
                });
                /*$('#done').click(function(){
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
                                $('#return_sale_details').html(data).show();
                            },
                            complete: function(){
                            }
                        });
                    }
                });*/
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
                    <form name="return_sale_form" id="return_sale_form" method="post" >
                        <div class="modal-header">
                            <h3>Return Sale</h3>
                        </div>
                        <div class="modal-body">
                            <div><label>Select Products:
                                    <textarea name="products" id="products"></textarea>
                                </label></div>
                            <div class="btn btn-primary jreturn_sale" id="done">Return Sale</div>
                            
                            <div id="return_sale_details" style="display:none">
                                
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