<?php
/*echo '<pre>';
print_r($invoice_details);*/
?>
<hr>
<input type="hidden" name="total_sale_amount" value="<?php echo $details['overall_details']['total_sum'];?>">
<div style="padding-bottom:5px">
    <table border="1" class="custom_border" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td class="custom_bg">Model Name</td>
            <td class="custom_bg">Model Number</td>
            <td class="custom_bg">Price</td>
            <td class="custom_bg">Total Pieces</td>
        </tr>
        <?php
        $tot_pieces = 0;
        $valid_sale = true;
        if(empty($details['overview'])) {
            $valid_sale = false;
            ?>
        <tr>
            <td colspan="4">Invalid Products Selected</td>
        </tr>
<?php
        }
        else {
            foreach($details['overview'] as $model) {?>
        <tr>
            <td><?php echo $model->name;?></td>
            <td><?php echo $model->model_number;?></td>
            <td><?php echo $model->totalprice;?></td>
            <td><?php echo $model->total_pieces; $tot_pieces += $model->total_pieces;?></td>
        </tr>
    <?php
    }
        }
        ?>
        <tr>
            <td class="bold" colspan="2" align="right" style="padding-right:10px;">Grand Total:</td>
            <td class="bold"><?php echo $details['overall_details']['total_sum'];?></td>
            <td class="bold"><?php echo $tot_pieces;?></td>
        </tr>
    </table>

</div>
<?php
if($valid_sale)
{
    if(!empty($invoice_details['details_rs']->invoice_number))
    {
    ?>
        <div><label>Select Products:
                <textarea name="products" id="products" style="height:150px"><?php echo $products;?></textarea>
        </label></div>
    <?php
    }
?>
<input type="hidden" name="id" value="<?php echo $invoice_details['details_rs']->invoice_number;?>">
    <div><label>Customer:
        <select name="customers_id" id="customers_id">
            <option value="">Select Customer</option>
            <?php
            foreach($customers as $cus_data) {
                $selected = '';
                if($invoice_details['details_rs']->customers_id == $cus_data->id)
                {
                    $selected = 'selected=selected';
                }
            ?>
                <option value="<?php echo $cus_data->id;?>" <?php echo $selected;?>><?php echo $cus_data->first_name.' '.$cus_data->last_name;?></option>
            <?php
            }
            ?>
            <option value="2">customer 2</option>
        </select>
    </label></div>
<div><label>Discount %: <input type="text" name="discount" id="discount" value="<?php echo $invoice_details['details_rs']->discount;?>"></label></div>
<div><div>Payment Mode:</div>
    <div><label><input type="radio" id="ca" name="payment_method" value="ca" style="display:inline" <?php if($invoice_details['details_rs']->payment_method == 'ca'){?>  checked <?php }?> > Cash</label></div>
    <div><label><input type="radio" id="cr" name="payment_method" style="display:inline"  <?php if($invoice_details['details_rs']->payment_method == 'cr'){?>  checked <?php }?>  value="cr"> Credit</label></div>
</div>

<!--<div>Payment Mode:
    <input type="radio" name="payment_method" value="ca" checked> Cash
    <input type="radio" name="payment_method" value="cr"> Credit
</div>-->
<div><label>Total Sale Amount: <input type="text" disabled name="amount_after_discount" id="amount_after_discount" value="<?php echo $details['overall_details']['total_sum'];?>"></label></div>
<div><label>Amount Paid: <input type="text" name="amount" id=name="amount" value="<?php echo $invoice_details['details_rs']->amount_paid;?>""></label></div>
<div><label>Other Details: <textarea name="other_details" id="other_details"><?php echo $invoice_details['details_rs']->other_details;?></textarea></label></div>
<div>
    <a class="btn btn-primary jsave_sale">Submit</a>
</div>
<?php
}
?>
<script>
    $(document).ready(function(){
        var totalprice = '<?php echo $details['overall_details']['total_sum'];?>';

        $('#discount').blur(function(){
            var sale_amt = parseInt(totalprice)-(parseInt(totalprice)*parseInt($(this).val())/100);
            $('#amount_after_discount').val(sale_amt);
        });
    });
</script>