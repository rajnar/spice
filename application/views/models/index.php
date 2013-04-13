<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Models</title>
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
            .ui-pg-input, .uneditable-input {
                width:16px;
            }
            select{
                width:50px;
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

                $('.close').live('click',function(){
                    window.location.href = '<?php echo site_url()?>models/';
                });

                jQuery("#models_grid_tbl").jqGrid431({
                    url:'<?php echo site_url();?>models/getModelsGrid',
                    datatype: "json",
                    mtype:"POST",
                    colNames:['Model Number','Model Name', 'Price','Edit'],
                    colModel:[
                        {name:'model_number',index:'model_number',width:'10%',search:true},
                        {name:'name',index:'name',width:'10%'},
                        {name:'price',index:'price',width:'10%'},
                        {name:'edit',index:'edit',width:'15%'}
                    ],
                    rowNum:18,
                    height:$(window).height()-230,
                    autowidth: true,
                    //rowList:[10,20,30],
                    pager: '#models_grid_pager',
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

                /* $('.jsave_model').click(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>models/saveModel',
                        data: $('#model_form').serialize(),
                        beforeSend : function(){
                        },
                        success: function(){
                        },
                        complete: function(){
                            jQuery("#models_grid_tbl").trigger("reloadGrid");
                            $('#myModal').find('.close').trigger('click');
                        }
                    });
                });*/

                $('.jsave_model').live('click',function(){
                    $("#model_form").submit();
                })

                $("#model_form").validate({
                    rules: {
                        name: {
                            required : true
                        },
                        model_number: {
                            required : true
                        },
                        price: {
                            required : true,
                            number: true
                        },

                    },
                    messages: {
                        name: {
                            required : "Please enter First Name"
                        },
                        model_number: {
                            required : "Please enter Last Name"
                        },
                        price: {
                            required : "Please Enter Address",
                            number:"Model Price Should be number"
                        },
                    },
                    submitHandler: function()
                    {
                        $.ajax({
                            type: "POST",
                            url: '<?php echo site_url();?>models/saveModel',
                            data: $('#model_form').serialize(),
                            beforeSend : function(){
                            },
                            success: function(){
                                window.location.href='<?php echo site_url();?>models/';
                            },
                            complete: function(){
                                jQuery("#models_grid_tbl").trigger("reloadGrid");
                                $('#myModal').find('.close').trigger('click');
                            }
                        });
                    }
                });

                $('.cmodel_edit').live('click',function(){
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url();?>models/getModelDetails',
                        data: 'model_id='+$(this).attr('id'),
                        dataType: 'json',
                        beforeSend : function(){
                        },
                        success: function(data){
                            $('.cadd_model').trigger('click');
                            $('#id').val(data.id);
                            $('#name').val(data.name);
                            $('#model_number').val(data.model_number);
                            $('#price').val(data.price);
                        },
                        complete: function(){
                            //jQuery("#models_grid_tbl").trigger("reloadGrid");
                            // $('#myModal').find('.close').trigger('click');
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
                <div class="span2" style="float:right;text-align:right">
                    <button class="btn btn-primary cadd_model" data-toggle="modal" href="#myModal">Add Model</button>
                </div>
            </div>
            <div class="row-fluid">
                <div>&nbsp;</div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="row-fluid">
                        <div class="span12">
                            <table id="models_grid_tbl" class="cs_gd"></table>
                            <div id="models_grid_pager"></div>
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
        <script src="<?php echo base_url();?>public/assets/js/hideshow.js" type="text/javascript"></script>
        <div class="modal hide fade in" id="myModal"  style="display:none">
            <form name="model_form" id="model_form" method="post" >
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>New Modal</h3>
                </div>
                <div class="modal-body">
                    <div><label>Model Name: <input type="text" name="name" id="name"></label></div>
                    <div><label>Model Number: <input type="text" name="model_number" id="model_number"></label></div>
                    <div><label>Cost per piece: <input type="text" name="price" id="price"></label></div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary jsave_model">Save changes</a>
                </div>
            </form>
        </div>
    </body>
</html>
