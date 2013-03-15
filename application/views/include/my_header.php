<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Spice Dealer</a>
            <div class="nav-collapse">
                <?php 
				if(isset($user_details) && !empty($user_details))
				{
				?>
				<ul class="nav">
                    <li class="pn <?php echo $active_tab=='stock'?'active':'';?>"><a href="<?php echo site_url();?>stock">Stock</a></li>
                    <li class="pn <?php echo $active_tab=='sales'?'active':'';?>"><a href="<?php echo site_url();?>sales">Sales</a></li>
                    <li class="pn <?php echo $active_tab=='customers'?'active':'';?>"><a href="<?php echo site_url();?>customers">Customers</a></li>
                    <li class="pn <?php echo $active_tab=='reports'?'active':'';?>"><a href="<?php echo site_url();?>reports">Reports</a></li>
                    <li class="pn <?php echo $active_tab=='models'?'active':'';?>"><a href="<?php echo site_url();?>models">Models</a></li>
                    <li class="pn <?php echo $active_tab=='return_stock'?'active':'';?>"><a href="<?php echo site_url();?>stock/return_stock">Return Stock</a></li>
                    <li class="pn <?php echo $active_tab=='return_sale'?'active':'';?>"><a href="<?php echo site_url();?>sales/return_sale">Return Sale</a></li>
                </ul>
				<p class="navbar-text pull-right"> <a href="<?php echo site_url();?>login/logout">logout</a></p>
                <p class="navbar-text pull-right">Logged in as <?php echo $user_details->firstname.' '.$user_details->lastname;?>&nbsp;</a></p>
				<p class="navbar-text pull-right"> <a href="<?php echo site_url();?>login/changepwd">Change Password</a>&nbsp;</p>
				<?php 
				}
				?>
				
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>