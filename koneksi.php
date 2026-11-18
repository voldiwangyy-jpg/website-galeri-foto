<?php
session_start();
$db = new mysqli("localhost", "root", "", "db_galeri");
if ($db->connect_error) die("Koneksi gagal");