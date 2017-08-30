<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<strong>Hi {{$pat_name}},</strong>
<br/>
<br/>
<div>
    <p>
        Practitioner {{$full_name}} has sent you invitation code of his store on PracticeTabs. Please use follow code to get access to.
    </p>
    <table style="border-collapse: collapse; border: 1px solid #000;" border="1">
        <tr>
            <th colspan="2" style="background-color: #d6d8dd; padding: 5px;">Store Code Information: </th>
        </tr>
        <tr><td style="padding: 5px;">Store Name: </td><td>{{$manufacturer->value}}</td></tr>
        <tr><td style="padding: 5px;">Store Access Code: </td><td>{{$store_code}}</td></tr>
    </table>
    <p>
        Use the following link to login:
        <a href="{{url('/users/patient/login')}}">Login</a>
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