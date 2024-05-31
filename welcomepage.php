<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles/welcomepage.css">
</head>
<body>
    <div class="container">
        <img src="img/Logo Selensia EO - Putih.png"> 
        <h1>Welcome to Selensia Dashboard</h1>
        <div class="form-container">
         
            <form action="auth/login.php" method="POST">
                <h2>Login</h2>
                <label for="login-username">Username</label>
                <input type="text" id="login-username" name="username" required>
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>
                <button type="submit">Login</button>
            </form>

            <p>Don't have an account? <a href="auth/register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>  -->

<?php
session_start();
require_once 'config/db.php'; // Path to your database configuration

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Buat prepared statement untuk mengambil data user berdasarkan username
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        
        // Ambil data user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Periksa apakah user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password'])) {
            // Login sukses
            session_start();
            $_SESSION['user_id'] = $user['id_user'];
            header('Location: index.html'); // Sesuaikan dengan halaman dashboard Anda
            exit;
        } else {
            // Login gagal
            $error = 'Username atau password salah';
        }
    } catch(PDOException $e) {
        // Tangani kesalahan jika query gagal
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles/welcomepage.css">
</head>
<body>
    <div class="container">
        <h1>Welcome Page</h1>
        <form method="post" action="welcomepage.php">
            <h2>Login</h2>
            
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="auth/register.php">Register</a></p>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles/welcomepage.css">
</head>
<body>
    <div class="container">
        
        <h1>Welcome to Selensia Dashboard</h1>
        <div class="form-container">
         
            <form action="welcomepage.php" method="POST">
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
                <h2>Login</h2>
                <label for="login-username">Username</label>
                <input type="text" id="login-username" name="username" required>
                <label for="login-password">Password</label>
                <input type="password" id="login-password" name="password" required>
                <button type="submit">Login</button>
            </form>

            <p>Don't have an account? <a href="auth/register.php">Register here</a></p>
        </div>
    </div>
</body>
</html> 