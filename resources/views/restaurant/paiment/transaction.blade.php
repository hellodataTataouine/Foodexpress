<!DOCTYPE html>
<html>
<head>
    <title>Transaction Status</title>
</head>
<body>
    <div>
        <h1>Transaction Status</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
    </div>
</body>
</html>