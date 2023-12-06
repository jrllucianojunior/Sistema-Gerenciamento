<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>budget plan</title>
</head>
<body>
    <div class="background-image"></div>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="testeLogin.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="password">Password:</label>
                <input type="password" id="senha" name="senha" required>

                <button type="submit" name = "entrar" >Login</button>
                <a href="#" class="forgot-password">Esqueci minha senha</a>
            </form>
        </div>
    </div>
</body>
</html>
 