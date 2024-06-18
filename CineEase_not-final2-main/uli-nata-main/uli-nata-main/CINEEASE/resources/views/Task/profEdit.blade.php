<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Edit Profile</title>
</head>
<body>
    <form method="POST" action="{{ route('password.store') }}">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
        </div>
        <div class="mt-4">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
        </div>
        <div class="mt-4">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
        </div>
        <div class="flex items-center justify-end mt-4">
            <button type="submit">Reset Password</button>
        </div>
    </form>
</body>
</html>
