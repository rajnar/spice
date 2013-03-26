<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Add Stock</title>
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
        <script src="<?php echo base_url();?>public/assets/js/bootbox.js" rel="stylesheet"/></script>
    <script src="<?php echo base_url();?>public/assets/js/blockui.js" type="text/javascript"></script>
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
            /*$('.jsave_stock').click(function(){
                                    if( ($('#models_id').val() == '') && ($('#imei_number').val() == '') )
                {
                                            bootbox.alert("Please Select Models Id<br>Please Select Products");
                }
                                    else if($('#models_id').val() == '')
                {
                                            bootbox.alert("Please Select Models Id");
                }
                                    else if($('#imei_number').val() == '')
                {
                                            bootbox.alert("Please Select Products");
                }
                else
                                    {
                                            $.ajax({
                                                    type: "POST",
                                                    url: '<?php echo site_url();?>stock/saveStock',
                                                    data: $('#stock_form').serialize(),
                                                    dataType:'json',
                                                    beforeSend : function(){
                                                    },
                                                    success: function(data){
                                                            //console.log(data);
                                                            if(data.error_code != '200')
                                                            {
                                                                    $('#error_msg').show();
                                                                    $('#msg_body').html(data.error_msg);
                                                                    $.blockUI({ message: ''});
                                                                    //alert(data.error_msg);
                                                            }
                                                            //console.log(data);
                                                    },
                                                    complete: function(){
                                                            window.location.href='<?php echo site_url()?>stock';
                                                    }
                                            });
                                    }

            });*/
            $('.jsave_stock').live('click',function(){
                $("#stock_form").submit();
            })
            $("#stock_form").validate({
                rules: {
                    models_id: {
                        required : true
                    },
                    imei_number: {
                        required : true
                    },
                },
                messages: {
                    models_id: {
                        required : "Please Select Model"
                    },
                    imei_number: {
                        required : "Please enter Product IMEI"
                    },
                },
                submitHandler: function()
                {
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>stock/saveStock',
                        data: $('#stock_form').serialize(),
                        dataType:'json',
                        beforeSend : function(){
                        },
                        success: function(data){
                            console.log(data);
                            if(data.error_code != '200')
                            {
                                $('#error_msg').show();
                                $('#msg_body').html(data.error_msg);
                                $.blockUI({ message: ''});
                                //alert(data.error_msg);
                            }
                            else
                            {
                                $('#error_msg').show();
                                var html = '<div>'+data.error_msg+'</div>'
                                html += '<div style="float:right"><input type="button" class="ok" name="ok" value="OK"></div>';
                                $('#msg_body').html(html);
                                $.blockUI({ message: ''});
                            }
                            //console.log(data);
                        },
                        complete: function(){
                            //window.location.href='<?php echo site_url()?>stock';
                        }
                    });
                }
            });
            $('.setheight').css('min-height',$(window).height()-230);
            $('.imei_number').css('height',$(window).height()-330);
            $('.ok').live('click',function(){
                window.location.href='<?php echo site_url()?>stock';
            });
            $('.close').live('click',function(){
                $.unblockUI();
                $('#error_msg').hide();
            });
        });
    </script>
</head>

<body>
    <?php echo $header;?>

    <div class="container-fluid">
        <div class="row-fluid ">
            <div class="span12" id="stock_grid">
                <form name="stock_form" id="stock_form" method="post" >
                    <div class="modal-header">
                        <h3>New Stock</h3>
                    </div>
                    <div class="modal-body setheight">
                        <div><label>Model:
                                <select name="models_id" id="models_id">
                                    <option value="">Select Model</option>
                                    <?php
                                    foreach($models as $model) {
                                        ?>
                                    <option value="<?php echo $model->id;?>"><?php echo $model->name;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </label>
                        </div>
                        <div><label>Products:
                                <textarea class="imei_number" name="imei_number" id="imei_number"></textarea>
                            </label></div>
                        <div>
                            <a href="#" class="btn btn-primary jsave_stock">Save changes</a>
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
