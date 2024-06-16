<?php
require "../../functions.php";
$idbooking = $_GET["id"];

if (konfirmasi($idbooking) > 0) {
  echo "
  <script>
    alert('Data Berhasil DiKonfirmasi');
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
