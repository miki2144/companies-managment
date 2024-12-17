<!-- resources/views/reports/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>{{ $report->title }}</h1>
    <p>{{ $report->content }}</p>
    <a href="{{ route('reports.index') }}">Back to Reports</a>
</body>
</html>