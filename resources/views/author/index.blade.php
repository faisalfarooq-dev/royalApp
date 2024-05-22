<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
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

<h2>Authors Table</h2>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Action</th>
    </tr>
    @if(count($authors['items']) > 0)
        @foreach($authors['items'] as $author)
            <tr>
                <td>{{ $author['first_name'] ?? 'N/A' }}</td>
                <td>{{ $author['last_name'] ?? 'N/A' }}</td>
                <td>{{ $author['gender'] ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('author.show', $author['id']) }}">View</a>
                </td>
            </tr>
        @endforeach
    @else
        <h5>No Record Found.</h5>
    @endif
</table>
</body>
</html>

