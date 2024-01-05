<?php
session_start();
require_once 'config.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, hashed_password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['hashed_password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../index/index.html');
        exit();
    } else {
        $error_message = 'Usuário ou senha inválidos.';
    }
}

if (!isset($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="login.css">
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required><br>

            <?php if (!empty($error_message)): ?>
                <p id="msg-error" style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <input type="submit" class="btn btn-success mt-2" value="Login">
        </form>
    </body>
    </html>
    <?php
    exit();
}

echo 'Bem-vindo ao painel!';
?>