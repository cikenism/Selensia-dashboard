<?php
require_once '../config/db.php'; // Pastikan path ini sesuai dengan struktur folder Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Periksa apakah username sudah ada dalam database
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $existingUser = $stmt->fetch();

    if (!$existingUser) {
        // Jika username belum ada, lakukan proses registrasi
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);
        
        // Redirect ke halaman login setelah registrasi berhasil
        header('Location: ../welcomepage.php');
        exit;
    } else {
        // Jika username sudah ada, tampilkan pesan kesalahan
        $error = 'Username sudah digunakan';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="../styles/welcomepage.css">
</head>
<body>
    <div class="container">
        
        <h2>Registrasi</h2>
        <div class="form-container">

            <form method="post" action="register.php">
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
                <br>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <br>
                <button type="submit">Registrasi</button>
            </form>
        </div>
    </div>        
</body>
</html>
