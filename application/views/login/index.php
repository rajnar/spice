<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Spice | Login</title>
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
            label {display:inline-block;width:140px}
            input, .uneditable-input {
                /* width:16px;*/
            }
            select{
                width:50px;
            }
            div.error{
                padding:0px 0px 9px 140px;
                color:#FF0000;
                font-size:14px;
                font-family:Arial, Helvetica, sans-serif;
                width:300px;
            }
            div.gerror{
                color:red;
                padding-bottom:9px;
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
            var base_url = '<?php echo base_url();?>';
            $(document).ready(function(){
                $.ajaxSetup({
                    jsonp: null,
                    jsonpCallback: null
                });

                $('#main_div').css('min-height',$(window).height()-150);
                $('.jlogin').live('click',function(){
                    $("#loginform").submit();
                });
                $("#loginform").validate({
                    rules : {
                        uname : "required",
                        upwd : "required"
                    },

                    messages : {
                        uname : " Please enter User Name",
                        upwd : {
                            required : " please enter password",
                            minlength : "Your password must be at least 6 characters long"
                        }
                    },

                    submitHandler : function() {
                        var dyn_url = base_url+'login/loginUser';
                        var	href = base_url+'stock';
                        var form_data = $('#loginform').serialize();

                        $.ajax({
                            type : 'POST',
                            url : dyn_url,
                            data : form_data,
                            success : function(msg) {
                                if (msg == 'success') {
                                    //HideDialog();
                                    window.location.href = href;
                                } else {
                                    $("#gerror").html("Failed to login, your User Name and password did not match.");
                                }
                            }
                        });
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
                <div>&nbsp;</div>
            </div>
            <div class="row-fluid" id="main_div">
                <div class="span12">
                    <form name="loginform" id="loginform" method="post" >
                        <input type="hidden" name="id" value="<?php echo '' ?>">
                        <div class="modal-header">
                            <h3>Login</h3>
                        </div>
                        <div class="modal-body">
                            <div id="gerror" class="gerror">
                            </div>
                            <div><label>Username :</label><input type="text" id="uname" name="uname" autocomplete="off" /></div>
                            <div><label>Password :</label><input type="password" id="upwd" name="upwd" autocomplete="off" /></div>
                            <div><input class="btn" type="submit" name="login" id="login" value="Login"> </div>
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
