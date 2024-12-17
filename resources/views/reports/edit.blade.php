<!-- resources/views/reports/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Report</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Edit Report</h1>
    <form action="{{ route('reports.update', $report) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $report->title }}" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required>{{ $report->content }}</textarea>
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('reports.index') }}">Back to Reports</a>
</body>
</html>