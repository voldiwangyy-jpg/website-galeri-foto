<?php include 'koneksi.php';
if (!isset($_SESSION['uid'])) { header("Location: login.php"); exit; }
$id = (int)$_GET['id'];
$s = $db->prepare("SELECT file FROM foto WHERE id=? AND user_id=?");
$s->bind_param("ii", $id, $_SESSION['uid']);
$s->execute();
$r = $s->get_result()->fetch_assoc();
if ($r) {
  @unlink("uploads/" . $r['file']);
  $d = $db->prepare("DELETE FROM foto WHERE id=? AND user_id=?");
  $d->bind_param("ii", $id, $_SESSION['uid']);
  $d->execute();
}
header("Location: index.php");