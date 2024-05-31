<?php
require_once '../config/db.php';  // Pastikan path ini sesuai dengan struktur folder Anda

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
            header('Location: ../index.html'); // Sesuaikan dengan halaman dashboard Anda
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/style.css">  
</head>
<body>
    <form method="post" action="login.php">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
