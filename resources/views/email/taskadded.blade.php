<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
          * {
            font-family: 'Times New Roman', Times, serif !important;
            /* font-size: 15px !important; */
            margin: 0 0px 0 0px;
            padding: 0;
        }

        body {
            margin: 0 10px 0 10px !important;

        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

    <p>New Task Has been Added.</p>

    <h5 style="text-align: center;">Task Details</h5>
    <table style="width: 95%;margin:10px;">
        <tr>
            <th>Task Name</th>
            <th>{{$datas['task_name']}}</th>
        </tr>

        <tr>
            <td>From Date</td>
            <th>{{$datas['from_date_bs']}}</th>
        </tr>
        <tr>
            <td>To Date</td>
            <th>{{$datas['to_date_bs']}}</th>
        </tr>
        <tr>
            <td>Description</td>
            <th>{{$datas['description']}}</th>
        </tr>
    </table>

</body>
</html>
