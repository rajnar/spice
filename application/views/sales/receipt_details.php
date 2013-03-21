<table width="40%" cellpadding="5" border="1" cellspacing="0">
    <tr>
        <td colspan="2" align="center">Receipt Number: <?php echo $pay_details->receipt_number;?></td>
    </tr>
    <tr>
        <td>Name:</td>
        <td><?php echo $pay_details->name;?></td>
    </tr>
    <tr>
        <td>Primary Contact Number:</td>
        <td><?php echo $pay_details->phone_number1;?></td>
    </tr>
    <tr>
        <td>Secondary Contact Number:</td>
        <td><?php echo $pay_details->phone_number2;?></td>
    </tr>
    <tr>
        <td>Invoice Number:</td>
        <td><?php echo $pay_details->invoice_number;?></td>
    </tr>
    <tr>
        <td>Total Sale Amount:</td>
        <td><?php echo round($pay_details->total_sale_amount,2);?></td>
    </tr>
    <tr>
        <td>Discount(%):</td>
        <td><?php echo $pay_details->discount;?></td>
    </tr>
    <tr>
        <td>Amount After Discount:</td>
        <td><?php echo round($pay_details->amount_after_discount,2);?></td>
    </tr>
    <tr>
        <td>Other details:</td>
        <td><?php echo $pay_details->other_details;?></td>
    </tr>
    <tr>
        <td>Invoice Date:</td>
        <td><?php echo date('m/d/Y h:i:s a',strtotime($pay_details->date_added));?></td>
    </tr>
    <tr>
        <td>Total Amount Paid:</td>
        <td><?php echo round($pay_details->amount_paid,2);?></td>
    </tr>
    <tr>
        <td>Balance Amount:</td>
        <td><?php echo round($pay_details->balance_amount,2);?></td>
    </tr>
</table>