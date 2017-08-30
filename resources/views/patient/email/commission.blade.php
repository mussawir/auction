<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{ $commission->first_name }},</strong>
<br/>
<br/>
<div>
    <p>
       You have received a ${{ $commission->amount }} commission on new product sale. 
    </p>
    <a href='{{url("/practitioner/accounts/commission_details/$commission->order_id")}}'>Click Here For Details</a>
    <br/>
	<br/>
    Kind Regards,
    <br/>
    <strong>The Practicetabs.com Team</strong>
</div>
</body>
</html>