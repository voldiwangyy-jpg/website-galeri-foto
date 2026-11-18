<?php include 'koneksi.php';
if (!isset($_SESSION['uid'])) { header("Location: login.php"); exit; }
$id = (int)$_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $s = $db->prepare("UPDATE foto SET judul=?, deskripsi=? WHERE id=? AND user_id=?");
  $s->bind_param("ssii", $_POST['judul'], $_POST['deskripsi'], $id, $_SESSION['uid']);
  $s->execute();
  header("Location: index.php"); exit;
}
$s = $db->prepare("SELECT * FROM foto WHERE id=? AND user_id=?");
$s->bind_param("ii", $id, $_SESSION['uid']);
$s->execute();
$f = $s->get_result()->fetch_assoc();
if (!$f) die("Data tidak ditemukan");
?>
<link rel="stylesheet" href="style.css">
<div class="box">
  <h2>Edit Foto</h2>
  <form method="post">
    <input name="judul" value="<?= htmlspecialchars($f['judul']) ?>" required>
    <textarea name="deskripsi"><?= htmlspecialchars($f['deskripsi']) ?></textarea>
    <button>Update</button>
  </form>
  <a href="index.php">Kembali</a>
</div>