<!DOCTYPE html>
<html>
<head>
    <title>Business Hub</title>
</head>
<body>

<h2>Login</h2>
<form action="/business-hub/php/login.php" method="POST">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>

<h2>Sign Up</h2>
<form action="/business-hub/php/signup.php" method="POST">
    <input type="text" name="username" required>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Sign Up</button>
</form>

</body>
</html>
