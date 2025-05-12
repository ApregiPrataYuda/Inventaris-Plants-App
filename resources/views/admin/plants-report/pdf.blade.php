<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name Plants</th>
                <th>Name Scientific</th>
                <th>Kode</th>
                <th>Category Plants</th>
                <th>Location Plants</th>
                <th>Status</th>
                <th>Date Planting</th>
                <th>Updated Status Date</th>
                <th>Noted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plants as $plant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $plant->name }}</td>
                    <td>{{ $plant->scientific_name }}</td>
                    <td>{{ $plant->code_plants }}</td>
                    <td>{{ $plant->name_category }}</td>
                    <td>{{ $plant->name_locations }}</td>
                    <td>{{ ucfirst($plant->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($plant->planting_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($plant->updated_at)->format('d-m-Y') }}</td>
                     <td>{{ $plant->notes }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
