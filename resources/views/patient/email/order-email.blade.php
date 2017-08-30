<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{$patient_name}},</strong>
<br/>
<br/>
<div>
    <p>
       Thank you for purchasing from practicetabs.. 
	   Here are you order details . 
    </p>
    <table style="border-collapse: collapse; border: 1px solid #000;" border="1">
	<thead>
        <tr>
            <th>Product</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Delivery Date</th>
			<th>Supplier</th>
        </tr>
		</thead>
		<tbody>
		<?php $GTotal=0; ?>
		@foreach($table1 as $items)
		<tr>
		<?php 
		$GTotal = (floatval($items->product_price)+$GTotal);
		?>
        <td>{{$items->products_name}}</td>
        <td>${{$items->product_price}}</td>
		<td>{{$items->product_qty}}</td>
		<td>{{$items->delivery_date}}</td>
		<td>{{$items->sup_fName}} {{$items->sup_lName}}</td>
		</tr>
		@endforeach
		<tr>
		<td colspan="5" align="right">
			Total : $<?php echo $GTotal; ?>	
		</td>
		</tr>
		</tbody>
    </table>
    <br/>
	<br/>
    Kind Regards,
    <br/>
    <strong>The Practicetabs.com Team</strong>
</div>
</body>
</html>