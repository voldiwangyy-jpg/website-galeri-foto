<?php include 'koneksi.php';
if (!isset($_SESSION['uid'])) { header("Location: login.php"); exit; }
$s = $db->prepare("SELECT * FROM foto WHERE user_id=? ORDER BY id DESC");
$s->bind_param("i", $_SESSION['uid']);
$s->execute();
$hasil = $s->get_result();
?>
<link rel="stylesheet" href="style.css">
<div class="nav">
  <b>Galeri Foto</b>
  <span>Halo, <?= htmlspecialchars($_SESSION['nama']) ?> |
  <a href="tambah.php">+ Tambah Foto</a> | <a href="logout.php">Logout</a></span>
</div>
<div class="grid">
<?php while ($f = $hasil->fetch_assoc()): ?>
  <div class="card">
    <img src="uploads/<?= htmlspecialchars($f['file']) ?>">
    <h3><?= htmlspecialchars($f['judul']) ?></h3>
    <p><?= htmlspecialchars($f['deskripsi']) ?></p>
    <a href="edit.php?id=<?= $f['id'] ?>">Edit</a> |
    <a href="hapus.php?id=<?= $f['id'] ?>" onclick="return confirm('Hapus foto ini?')">Hapus</a>
  </div>
<?php endwhile; ?>
</div>