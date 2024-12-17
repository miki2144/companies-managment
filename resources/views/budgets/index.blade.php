<!DOCTYPE html>
<html>
<head>
    <title>Budget Forecasting</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f6f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2196F3;
            font-size: 36px;
            margin-bottom: 20px;
        }
        a {
            color: #2196F3;
            text-decoration: none;
            font-size: 18px;
            margin-bottom: 20px;
            display: block;
            text-align: center;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .chart-container {
            width: 100%;
            height: 450px;
            margin: 30px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }
        th {
            background-color: #2196F3;
            color: white;
            font-size: 18px;
        }
        td a, td button {
            color: #2196F3;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        td button {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
        }
        td button:hover {
            background-color: #e53935;
        }
        .btn-create {
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-create:hover {
            background-color: #388E3C;
        }
    </style>
</head>
<body>
    <h1>Budget Forecasting</h1>
    <a href="{{ route('budgets.create') }}" class="btn-create">Create New Budget</a>

    <!-- Graph Section -->
    <div class="chart-container">
        <canvas id="budgetChart"></canvas>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Forecast Period</th>
                    <th>Forecast Amount</th>
                    <th>Actual Amount</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($budgets as $budget)
                    <tr>
                        <td>{{ $budget->forecast_period }}</td>
                        <td>{{ $budget->forecast_amount }}</td>
                        <td>{{ $budget->actual_amount }}</td>
                        <td>{{ $budget->description }}</td>
                        <td>
                            <a href="{{ route('budgets.edit', $budget->Budget_id) }}">Edit</a>
                            <form action="{{ route('budgets.destroy', $budget->Budget_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Prepare data for the chart (from the PHP variable $budgets)
        var forecastData = @json($budgets);  // Pass PHP variable to JS
        
        var labels = forecastData.map(function(budget) {
            return budget.forecast_period;  // Using the forecast period as labels
        });
        
        var forecastAmounts = forecastData.map(function(budget) {
            return budget.forecast_amount;  // Forecast amounts for the data points
        });

        var actualAmounts = forecastData.map(function(budget) {
            return budget.actual_amount || 0;  // Default to 0 if no actual amount
        });

        // Chart.js Configuration
        var ctx = document.getElementById('budgetChart').getContext('2d');
        var budgetChart = new Chart(ctx, {
            type: 'bar',  // Bar chart for forecast and actual amounts
            data: {
                labels: labels,
                datasets: [{
                    label: 'Forecast Amount',
                    data: forecastAmounts,
                    backgroundColor: '#2196F3',  // Blue for forecast
                    borderColor: '#1976D2',
                    borderWidth: 1
                }, {
                    label: 'Actual Amount',
                    data: actualAmounts,
                    backgroundColor: '#f44336',  // Red for actual
                    borderColor: '#e53935',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                onClick: function(evt, activeElements) {
                    if (activeElements.length > 0) {
                        var chart = activeElements[0]._chart;
                        var index = activeElements[0]._index;
                        var budget = forecastData[index];
                        alert("Forecast Period: " + budget.forecast_period + "\nForecast Amount: " + budget.forecast_amount + "\nActual Amount: " + budget.actual_amount);
                    }
                }
            }
        });
    </script>

</body>
</html>
