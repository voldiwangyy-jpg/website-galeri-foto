<?php include 'koneksi.php';
$pesan = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $s = $db->prepare("SELECT id, password FROM users WHERE username=?");
  $s->bind_param("s", $_POST['username']);
  $s->execute();
  $r = $s->get_result()->fetch_assoc();
  if ($r && password_verify($_POST['password'], $r['password'])) {
    $_SESSION['uid'] = $r['id'];
    $_SESSION['nama'] = $_POST['username'];
    header("Location: index.php"); exit;
  }
  $pesan = "Username atau password salah!";
}
?>
<link rel="stylesheet" href="style.css">
<div class="box">
  <h2>Login</h2>
  <p class="error"><?= $pesan ?></p>
  <form method="post">
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button>Masuk</button>
  </form>
  <p>Belum punya akun? <a href="register.php">Daftar</a></p>
</div>