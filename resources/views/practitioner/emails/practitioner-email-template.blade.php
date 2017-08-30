<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{$name}},</strong>
<br/>
<br/>
<div>
    <p>
        Practitioner {{$pra_name}} has registered you on PracticeTabs. Please use follow credentials to login
    </p>
    <table style="border-collapse: collapse; border: 1px solid #000;" border="1">
        <tr>
            <th colspan="2" style="background-color: #d6d8dd; padding: 5px;">Login Information: </th>
        </tr>
        <tr><td style="padding: 5px;">Email: </td><td>{{$email}}</td></tr>
        <tr><td style="padding: 5px;">Password: </td><td>{{$password}}</td></tr>
    </table>
    <p>
        Use the following link to login:
        <a href="{{url('/users/supplier/login')}}">Login</a>
    </p>
    <p>
        <strong>Note: You can change your password after login.</strong>
    </p>
    <br/>
    Kind Regards,
    <br/>
    <strong>The Practicetabs.com Team</strong>
</div>
</body>
</html>