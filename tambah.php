<?php include 'koneksi.php';
if (!isset($_SESSION['uid'])) { header("Location: login.php"); exit; }
$pesan = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
  if (!in_array($ext, ['jpg','jpeg','png','gif'])) {
    $pesan = "Hanya file jpg, jpeg, png, gif!";
  } else {
    $nama = uniqid() . "." . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $nama);
    $s = $db->prepare("INSERT INTO foto (user_id, judul, deskripsi, file) VALUES (?,?,?,?)");
    $s->bind_param("isss", $_SESSION['uid'], $_POST['judul'], $_POST['deskripsi'], $nama);
    $s->execute();
    header("Location: index.php"); exit;
  }
}
?>
<link rel="stylesheet" href="style.css">
<div class="box">
  <h2>Tambah Foto</h2>
  <p class="error"><?= $pesan ?></p>
  <form method="post" enctype="multipart/form-data">
    <input name="judul" placeholder="Judul" required>
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <input type="file" name="foto" required>
    <button>Simpan</button>
  </form>
  <a href="index.php">Kembali</a>
</div>