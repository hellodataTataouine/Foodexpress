
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsClient/css/login.css') }}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" method="POST" action="{{ route('client.login.submit') }}" > 
                        @csrf

                        <h1>Login</h1>
                        <p class="text-muted"> Please enter your email and password!</p> 
                        <input type="email" id="email" name="email" placeholder="Email"> 
                        <input type="password" id="password" name="password" placeholder="Password"> 
                        <input type="submit" name="" value="Login" > 
                    </form> 
                </div>
            </div> 
        </div>
     </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>