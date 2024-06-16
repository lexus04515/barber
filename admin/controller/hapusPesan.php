<?php
require "../../functions.php";
$id_booking = $_GET["id"];

if (hapusPesan($id_booking) > 0) {
  echo "
  <script>
    alert('Data Berhasil Dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
} else {
  echo "
  <script>
    alert('Data Gagal Dihapus');
    document.location.href = '../pesan.php'; 
  </script>
  ";
}
