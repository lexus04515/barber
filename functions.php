<?php

$conn = mysqli_connect("localhost", "root", "", "barber");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function hapusMember($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM user_barber WHERE barber_id_user = $id");

  return mysqli_affected_rows($conn);
}

function hapusLpg($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM layanan_barber WHERE barber_id_layanan = $id");

  return mysqli_affected_rows($conn);
}

function hapusAdmin($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM admin_barber WHERE barber_id_user = $id");

  return mysqli_affected_rows($conn);
}

function hapusPesan($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM booking_barber WHERE barber_id_booking = $id");

  return mysqli_affected_rows($conn);
}

function daftar($data)
{
  global $conn;

  $username = strtolower(stripslashes($data["email"]));
  $password = $data["password"];
  $nama = $data["nama"];
  $no_handphone = $data["hp"];
  $alamat = $data["alamat"];
  $gender = $data["gender"];
  //Upload Gambar
  $upload = upload();
  if (!$upload) {
    return false;
  }

  $result = mysqli_query($conn, "SELECT barber_email FROM user_barber WHERE barber_email = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('Username sudah terdaftar!');
        </script>";
    return false;
  }
  mysqli_query($conn, "INSERT INTO user_barber (barber_email,barber_password,barber_no_handphone,barber_jenis_kelamin,barber_nama_lengkap,barber_alamat,barber_foto) VALUES ('$username','$password','$no_handphone','$gender','$nama','$alamat','$upload')");
  return mysqli_affected_rows($conn);
}

function edit($data)
{
  global $conn;

  $userid = $_SESSION["id_user"];
  $username = strtolower(stripslashes($data["email"]));
  $nama = $data["nama_lengkap"];
  $no_handphone = $data["hp"];
  $gender = $data["jenis_kelamin"];
  $gambar = $data["foto"];
  $gambarLama = $data["fotoLama"];
 
  // Cek apakah User pilih gambar baru
  if ($_FILES["foto"]["error"] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  $query = "UPDATE user_barber SET barber_email = '$username', 
  barber_nama_lengkap = '$nama',
  barber_no_handphone = '$no_handphone',
  barber_jenis_kelamin = '$gender',
  barber_foto = '$gambar'
  WHERE barber_id_user = '$userid'
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function pesan($data)
{
  global $conn;

  $userid = $_SESSION["id_user"];
  $idlpg = $data["id_lpg"];
  $lama =  $data["jam_mulai"];
  $mulai = $data["tgl_main"];
  $mulai_waktu = strtotime($mulai); // mengubah format datetime-local menjadi format UNIX timestamp
  $habis_waktu = $mulai_waktu + (intval($lama) * 3600); // menambahkan waktu dalam menit ke waktu awal
  $habis = date('Y-m-d\TH:i', $habis_waktu); // mengubah format waktu kembali ke datetime-local
  $habis_datetime_local = date('Y-m-d\TH:i:s', strtotime($habis)); // mengubah format waktu dari Y-m-d\TH:i ke format datetime-local
  $habis = $habis_datetime_local; // menyimpan hasil ke dalam variabel $habis_datetime_local
  $harga = $data["harga"];
  $total = $lama * $harga;

  mysqli_query($conn, "INSERT INTO booking_barber (barber_id_user, barber_id_layanan,barber_lama_booking,barber_jam_mulai,barber_jam_habis,barber_harga,barber_total) VALUES ('$userid','$idlpg','$lama','$mulai','$habis','$harga','$total') ");

  return mysqli_affected_rows($conn);
}

function bayar($data)
{
  global $conn;
  $id_booking = $data["barber_id_booking"];

  //Upload Gambar
  $upload = upload();
  if (!$upload) {
    return false;
  }

  mysqli_query($conn, "INSERT INTO bayar_barber (barber_id_booking,barber_bukti,barber_konfirmasi) VALUES ('$id_booking','$upload','Sudah Bayar')");

  return mysqli_affected_rows($conn);
}

function tambahLpg($data)
{
  global $conn;

  $layanan_barber = $data["layanan"];
  $harga = $data["harga"];

  //Upload Gambar
  $upload = upload();
  if (!$upload) {
    return false;
  }


  $query = "INSERT INTO layanan_barber (barber_nama,barber_harga,barber_foto) VALUES ('$layanan_barber','$harga','$upload')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namaFile = $_FILES['foto']['name'];
  $ukuranFile = $_FILES['foto']['size'];
  $error = $_FILES['foto']['error'];
  $tmpName = $_FILES['foto']['tmp_name'];

  // Cek apakah tidak ada gambar yang di upload
  if ($error === 4) {
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  // Cek apakah gambar
  $extensiValid = ['jpg', 'png', 'jpeg'];
  $extensiGambar = explode('.', $namaFile);
  $extensiGambar = strtolower(end($extensiGambar));

  if (!in_array($extensiGambar, $extensiValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar!');
    </script>";
    return false;
  }

  if ($ukuranFile > 1000000) {
    echo "<script>
    alert('Ukuran Gambar Terlalu Besar!');
    </script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $extensiGambar;
  // Move File
  move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
  return $namaFileBaru;
}

function editLpg($data)
{
  global $conn;

  $id = $data["idlap"];
  $layanan_barber = $data["layanan"];
  $ket = $data["ket"];
  $harga = $data["harga"];
  $gambarLama =  $data["fotoLama"];

  // Cek apakah User pilih gambar baru
  if ($_FILES["foto"]["error"] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }


  $query = "UPDATE layanan_barber SET 
  barber_nama = '$layanan_barber',
  barber_keterangan = '$ket',
  barber_harga = '$harga',
  barber_foto = '$gambar' WHERE barber_id_layanan = '$id'
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}


function tambahAdmin($data)
{
  global $conn;

  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $no_handphone= $data["hp"];
  $email = $data["email"];

  $query = "INSERT INTO admin_barber (barber_username,barber_password,barber_nama,barber_no_handphone,barber_email) VALUES ('$username','$password','$nama','$no_handphone','$email')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function editAdmin($data)
{
  global $conn;

  $id = $data["id"];
  $username = $data["username"];
  $password = $data["password"];
  $nama = $data["nama"];
  $no_handphone= $data["hp"];
  $email = $data["email"];

  $query = "UPDATE admin_barber SET 
  barber_username = '$username',
  barber_password = '$password',
  barber_nama = '$nama',
  barber_no_handphone = '$no_handphone',
  barber_email  = '$email' WHERE barber_id_user = '$id'
  
  ";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function konfirmasi($id_booking)
{
  global $conn;

  $id = $id_booking;

  mysqli_query($conn, "UPDATE bayar_barber set barber_konfirmasi = ('Terkonfirmasi') WHERE barber_id_booking = '$id'");
  return mysqli_affected_rows($conn);
}
