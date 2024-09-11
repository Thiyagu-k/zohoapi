<!DOCTYPE html>
<html>
<head>
    <title>E-Sandhai</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app">
        <zoho-sales-orders></zoho-/sales-orders>
    </div>
    @vite('resources/js/app.js')
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</body>
</html>
