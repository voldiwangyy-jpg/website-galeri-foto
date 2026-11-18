<?php include 'koneksi.php';
$pesan = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $u = trim($_POST['username']);
  $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $s = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $s->bind_param("ss", $u, $p);
  if ($s->execute()) { header("Location: login.php"); exit; }
  $pesan = "Username sudah dipakai!";
}
?>
<link rel="stylesheet" href="style.css">
<div class="box">
  <h2>Registrasi</h2>
  <p class="error"><?= $pesan ?></p>
  <form method="post">
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Daftar</button>
  </form>
  <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>