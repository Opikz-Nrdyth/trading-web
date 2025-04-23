<!-- resources/views/exports/table-pdf.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                @foreach ($header as $h)
                    <th>{{ str_replace('_', ' ', strtolower($h)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($filteredColumns as $d)
                <tr>
                    @foreach ($header as $h)
                        <td>{!! strip_tags(html_entity_decode($d[$h])) !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
