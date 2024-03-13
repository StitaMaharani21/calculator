<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1> Report Material </h1>
    <table>
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Part Number</th>
                <th scope="col">Name</th>
                <th scope="col">UM</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->partnum }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->um }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>