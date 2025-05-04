<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Absences</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #070E2A;
            color: white;
        }
        .status-present {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }
        .status-absent {
            background-color: #f44336;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Rapport des Absences</h1>

    <table>
        <thead>
            <tr>
                <th>Nom de l'Employé</th>
                <th>Status</th>
                <th>Justification</th>
                <th>Dates</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $absence)
                <tr>
                    <td>{{ $absence->employee->name }}</td>
                    <td class="{{ $absence->status == 'Absent' ? 'status-absent' : 'status-present' }}">
                        {{ $absence->status }}
                    </td>
                    <td>{{ $absence->reason ?? 'Aucune' }}</td>
                    <td>{{ $absence->start_date }} - {{ $absence->end_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
