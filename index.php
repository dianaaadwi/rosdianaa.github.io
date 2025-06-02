<?php
include 'koneksi.php';

// Ambil data dari database
$query = "SELECT * FROM tb_mahasiswa";
$result = mysqli_query($koneksi, $query);

$no = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn { padding: 5px 10px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-danger { background-color: #f44336; color: white; border: none; }
        .btn-danger:hover { background-color: #d32f2f; }
        .btn-primary { background-color: #4CAF50; color: white; border: none; }
        .btn-primary:hover { background-color: #45a049; }
        .form-group { margin-bottom: 15px; }
        .form-control { width: 100%; padding: 8px; box-sizing: border-box; }
        .alert { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    
    <?php
    // Display status messages
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'sukses') {
            echo '<div class="alert alert-success">Data berhasil diproses!</div>';
        } elseif ($_GET['status'] == 'gagal') {
            $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : 'Terjadi kesalahan!';
            echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($pesan) . '</div>';
        }
    }
    ?>
    
    <!-- Form Tambah Data -->
    <h3>Tambah Data Mahasiswa</h3>
    <form action="tambah.php" method="POST">
        <div class="form-group">
            <label>id:</label>
            <input type="text" name="id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Kegiatan:</label>
            <input type="text" name="nama_kegiatan" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Waktu Kegiatan:</label>
            <textarea name="waktu_kegiatan" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
    
    <table>
        <tr>
            <th>id</th>
            <th>Nama Kegiatan</th>
            <th>Waktu Kegiatan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_kegiatan']); ?></td>
            <td><?php echo htmlspecialchars($row['waktu_kegiatan']); ?></td>
            <td>
                <a href="hapus.php?id=<?php echo urlencode($row['id']); ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                    Hapus
                </a>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"
                >EDIT</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>