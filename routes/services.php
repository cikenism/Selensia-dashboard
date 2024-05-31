<?php
session_start();
require_once '../config/db.php'; // Path to your database configuration

try {
    // Ambil data dari tabel service_schedule
    $stmt = $pdo->query('SELECT * FROM service_schedule');
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../styles/welcomepage.css">
</head>
<body>

    <div class="container2">
        <h1>Service Schedule</h1>
        <?php if (count($services) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Contract</th>
                        <th>Expired</th>
                        <th>Segmentasi</th>
                        <th>Operation</th>
                        <th>No. Contract</th>
                        <th>CSR</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['id_schedule']); ?></td>
                            <td><?php echo htmlspecialchars($service['customer']); ?></td>
                            <td><?php echo htmlspecialchars($service['contract']); ?></td>
                            <td><?php echo htmlspecialchars($service['expired']); ?></td>
                            <td><?php echo htmlspecialchars($service['id_segmentasi']); ?></td>
                            <td><?php echo htmlspecialchars($service['operation']); ?></td>
                            <td><?php echo htmlspecialchars($service['no_contract']); ?></td>
                            <td><?php echo htmlspecialchars($service['csr']); ?></td>
                            <!-- Tambahkan data lain sesuai kebutuhan -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No services scheduled.</p>
        <?php endif; ?>
    </div>
</body>
</html>
