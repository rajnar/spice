<table width="40%" cellpadding="5" border="1" cellspacing="0">
    <tr>
        <td colspan="2" align="center"><span style="float:left">Receipt Number: <?php echo $pay_details->receipt_number;?></span>
            <span style="float:right"><?php echo date('d/m/Y h:i:s a');?></span></td>
    </tr>
    <tr>
        <td>Invoice Number:</td>
        <td><?php echo $pay_details->invoice_number;?></td>
    </tr>
    <tr>
        <td>Invoice Date:</td>
        <td><?php echo date('m/d/Y h:i:s a',strtotime($pay_details->date_added));?></td>
    </tr>
    <tr>
        <td>Name:</td>
        <td><?php echo $pay_details->name;?></td>
    </tr>
    <tr>
        <td>Total Sale Amount (Rs):</td>
        <td><?php echo number_format(round($pay_details->total_sale_amount,2), 2, '.', ',') ;?></td>
    </tr>
    <tr>
        <td>Discount(%):</td>
        <td><?php echo $pay_details->discount;?></td>
    </tr>
    <tr>
        <td>Amount After Discount (Rs):</td>
        <td><?php echo number_format(round($pay_details->amount_after_discount,2), 2, '.', ',');?></td>
    </tr>
    <tr>
        <td>Other details:</td>
        <td><?php echo $pay_details->other_details;?></td>
    </tr>
	<tr>
        <td>Amount Paid (Rs):</td>
        <td><?php echo number_format($paid_amount, 2, '.', ',');?></td>
    </tr>
    <tr>
        <td>Total Amount Paid (Rs):</td>
        <td><?php echo number_format(round($pay_details->amount_paid,2), 2, '.', ',');?></td>
    </tr>
    <tr>
        <td>Balance Amount (Rs):</td>
        <td><?php echo number_format(round($pay_details->balance_amount,2), 2, '.', ',');?></td>
    </tr>
</table>
<div style="padding-top:8px;width:40%" id='print_footer'>
    <div class="btn" id="back2grid">Back to Grid</div>
    <div class="btn" id="print" style="float:right"><button id="printThatText" name="printThatText" onClick="printPage();">Print this page</button></div>
</div>