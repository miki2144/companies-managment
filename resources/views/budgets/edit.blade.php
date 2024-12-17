<!DOCTYPE html>
<html>
<head>
    <title>Edit Budget Forecast</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #FF9800;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #FF9800;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #f57c00;
        }
    </style>
</head>
<body>
    <h1>Edit Budget Forecast</h1>
    <form action="{{ route('budgets.update', $budget->Budget_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="forecast_period">Forecast Period</label>
        <input type="text" name="forecast_period" id="forecast_period" value="{{ $budget->forecast_period }}" required>

        <label for="forecast_amount">Forecast Amount</label>
        <input type="number" name="forecast_amount" id="forecast_amount" value="{{ $budget->forecast_amount }}" required>

        <label for="actual_amount">Actual Amount</label>
        <input type="number" name="actual_amount" id="actual_amount" value="{{ $budget->actual_amount }}">

        <label for="description">Description</label>
        <textarea name="description" id="description">{{ $budget->description }}</textarea>

        <label for="comment">Comment</label>
        <textarea name="comment" id="comment">{{ $budget->comment }}</textarea>

        <label for="created_by">Created By (User ID)</label>
        <input type="number" name="created_by" id="created_by" value="{{ $budget->created_by }}" required>

        <label for="approved_by">Approved By (User ID)</label>
        <input type="number" name="approved_by" id="approved_by" value="{{ $budget->approved_by }}">

        <button type="submit">Update</button>
    </form>
</body>
</html>
