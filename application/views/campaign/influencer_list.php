<?php 
//print_r($listData);
	$sum= 0;
	foreach ($listData as $key => $value) {
		//$sum = array_sum($value->amount[]);
		$sum += $value->amount;
?>
<tr>
	<!-- <th scope="row"></th> -->
	<td>
		<input type="text" name="userName[]" value="<?=$value->userName;?>" placeholder="Name" readonly>
	</td>
	<td>
		<input type="text" name="amount[]" value="<?=$value->amount;?>" placeholder="Amount">
	</td>
	<td>
		<input type="text" name="invoiceNumber[]" value="" placeholder="Invoive No.">
	</td>
	<td>
		<select name="payment_status[]">
			<option value="1">Yes</option>	
			<option value="0">No</option>	
		</select>
	</td>
	<td><input type="text" class="datepicker" id="paymentDate" name="payment_date[]"
		value="" placeholder="Select Date"></td>
	<td><input type="file" name="screenshot[]" class=""></td>
	
</tr>
<?php } ?>
<input type="hidden" name="amountSum" id="amountSum" value="<?=$sum;?>">
<script type="text/javascript">
	$('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            todayHighlight: true,
            //startDate: today,
            //endDate: end,
            //autoclose: true
        });
</script>