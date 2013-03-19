<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Change Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo base_url();?>public/assets/css/bootstrap.css" rel="stylesheet">
        <style>

            label {display:inline-block;width:140px}

            .mdlctr {
                overflow:auto;
                min-height:450px;
                width:810px;
                padding: 5px;
                margin-bottom: 20px;
                /*background-color: #f5f5f5;*/
                border: 1px solid #e3e3e3;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
                -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            }
            .error {
                color: red;
            }

            #password div {
                margin-left: 115px;
            }

            #password input[type="text"] {
                height: 36px;
                width:262px;
            }

        </style>
        <link href="<?php echo base_url();?>public/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../customers/images/favicon.ico">
        <link rel="apple-touch-icon" href="../customers/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../customers/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../customers/images/apple-touch-icon-114x114.png">
        <script src="<?php echo base_url();?>public/assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>public/assets/js/validate.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/js/i18n/grid.locale-en.js" type="text/javascript" language="javascript"></script>
        <script src="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/src/grid.base.js" type="text/javascript" language="javascript"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>public/assets/js/jquery-ui-1.8.21/css/smoothness/jquery-ui-1.8.21.custom.css" />
        <link href="<?php echo base_url();?>public/assets/js/jqGrid-4.3.1/src/css/ui.jqgrid.css" rel="stylesheet"  />
        <script>
            $(document).ready(function() {
                $('#main_div').css('min-height',$(window).height()-130);

                var base_url = '<?php echo base_url();?>';
                var site_url='<?php echo site_url(); ?>';

                $("#resetpwd").validate({

                    rules: {
                        old_password: {
                            required : true
                        },

                        new_password: {
                            required : true
                        },

                        conf_password: {
                            required : true,
                            equalTo : "#new_password"
                        },

                    },

                    messages: {

                        old_password: {
                            required : "Please enter old password"
                        },
                        new_password: {
                            required : "Please enter new password"
                        },

                        conf_password: {
                            required : "Please confirm your password",
                            equalTo  :  "Did not match with entered password",
                        },
                    },

                    submitHandler: function()
                    {
                        var data = $('#resetpwd').serialize();
                        var error_msg;

                        $.ajax({
                            type: "POST",
                            data: data,
                            url: site_url+"login/ChangePwd",

                            success: function(data)
                            {

                                if(data > 0)
                                {

                                    error_msg = '<div class="alert" style="margin-top:23px;"><span class="label label-success"><i class="icon-thumbs-up icon-white"></i>Password has been changed successfully.</span></div>';
                                }
                                else
                                {
                                    error_msg = '<div class="alert" style="margin-top:23px;"><span class="label label-important"><i class="icon-thumbs-down icon-white"></i>Unable to process...please refresh the screen and try again</span></div>';

                                }

                                /* setTimeout(function() {
                                                            //window.location = site_url+'accounts/reset_pwd';
                                                           }, 3000);
                                 */

                            },
                            complete : function()
                            {

                                //window.location.href=window.location.href;
                                $('.err_msg').html(error_msg);

                            }
                        });
                    }
                });
            });
        </script>
    </head>

    <body OnResize="refreshWindow()">
        <?php echo $header;?>

        <div class="container-fluid" style="min-height:400px">
            <div class="row-fluid" id="main_div">
                <div class="span12">
                    <form name="resetpwd" id="resetpwd" method="post" >
                        <input type="hidden" name="id" value="<?php echo '' ?>">
                        <div class="modal-header">
                            <h3>Change Password</h3>
                        </div>
                        <div class="modal-body">
                            <div><label>Old Password :</label> <input type="password" id="old_password" name="old_password" autocomplete="off" /></div>
                            <div><label>New Password :</label> <input type="password" id="new_password" name="new_password" autocomplete="off" /></div>
                            <div><label>Confirm Password :</label><input type="password" id="conf_password" name="conf_password"  autocomplete="off"/></div>
                            <div><input class="btn" type="submit" name="Change" value="Change"> </div>
                        </div>

                    </form>
                </div><!--/span-->
            </div><!--/row-->
            <hr>
            <footer>
                <p>&copy; Company 2012</p>
            </footer>
        </div><!--/.fluid-container-->
        <!--/.fluid-container-->

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
