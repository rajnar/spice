<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PDF</title>
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

</head>

<body>
	<table width="100%" cellpadding="1" cellspacing="1" border="1">
		<tr>
				<?php
				foreach($headers as $k=>$v)
				{
					echo "<td>$v</td>";
				}
					
				?>	
		</tr>
				<?php
				foreach($values as $key=>$val)
				{
					echo "<tr>";
					foreach($val as $k=>$v)
					{
						echo "<td>$v</td>";
					}
					echo "</tr>";
				}
					
				?>	
	</table>
	
</body>
</html>