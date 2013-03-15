<?php
/*echo '<pre>';
print_r($details['overview']);*/
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
        if(empty($details['overview']))
        {
            $valid_sale = false;
            ?>
            <tr>
                <td colspan="4">Invalid Products Selected</td>
            </tr>
        <?php
        }
        else
        {
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
?>
<div><label>Customer:
        <select name="customers_id" id="customers_id">
            <option value="">Select Customer</option>
            <?php
            foreach($customers as $cus_data) {
            ?>
            <option value="<?php echo $cus_data->id;?>"><?php echo $cus_data->first_name.' '.$cus_data->last_name;?></option>
            <?php
            }
            ?>
            <option value="2">customer 2</option>
        </select>
    </label></div>
<div><label>Discount %: <input type="text" name="discount" id="discount"></label></div>
<div><div>Payment Mode:</div>
    <div><label><input type="radio" id="ca" name="payment_method" value="ca" style="display:inline" checked> Cash</label></div>
    <div><label><input type="radio" id="cr" name="payment_method" style="display:inline"  value="cr"> Credit</label></div>
</div>

<!--<div>Payment Mode:
    <input type="radio" name="payment_method" value="ca" checked> Cash
    <input type="radio" name="payment_method" value="cr"> Credit
</div>-->
<div><label>Total Sale Amount: <input type="text" disabled name="amount_after_discount" id="amount_after_discount" value="<?php echo $details['overall_details']['total_sum'];?>"></label></div>
<div><label>Amount Paid: <input type="text" name="amount" value="0"></label></div>
<div><label>Other Details: <textarea name="other_details"></textarea></label></div>
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