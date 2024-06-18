<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/welcome.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>To do List Application</h1>
        <h4>Login</h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        
        <!-- Display error messages -->
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        
        <div class="create-account">
            <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
        </div>
    </div>
</body>
</html>
