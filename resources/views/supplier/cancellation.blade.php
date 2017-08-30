<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{$table1->first_name}},</strong>
<br/>
<br/> 
<div>
    <p>
       Unfortunately your order <b>{{$table1->order_number}}</b> has been cancelled, your amount will be refunded in 3 business days.
	   Here are you order details . 
    </p>
    <table style="border-collapse: collapse; border: 1px solid #000;" border="1">
	<thead>
        <tr>
			<th>Order #</th>
            <th>Product</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Delivery Date</th>
			<th>Supplier</th>
			<th>Status</th>
        </tr>
		</thead>
		<tbody>
		<tr>
		<td>{{$table1->order_number}}</td>
        <td>{{$table1->products_name}}</td>
        <td>${{$table1->product_price}}</td>
		<td>{{$table1->product_qty}}</td>
		<td>{{$table1->delivery_date}}</td>
		<td>{{$table1->sup_fName}} {{$table1->sup_lName}}</td>
		<td>Cancelled</td>
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