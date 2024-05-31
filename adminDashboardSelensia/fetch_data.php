

<?php
// Gunakan file database.php untuk menginisialisasi koneksi PDO
require_once 'config/db.php';

try {
    // Buat prepared statement
    $stmt = $pdo->prepare('SELECT * FROM users');
    
    // Jalankan query
    $stmt->execute();
    
    // Ambil hasil query dalam bentuk array asosiatif
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Tampilkan data
    foreach ($users as $user) {
        echo "ID: " . $user['id_user'] . ", Username: " . $user['username'] . " pw: ". $user['password']. "<br>";
    }
} catch(PDOException $e) {
    // Tangani kesalahan jika query gagal
    echo "Error: " . $e->getMessage();
}
?>
