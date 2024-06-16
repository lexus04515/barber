<?php
session_start();
require "functions.php";

$id_user = $_SESSION["id_user"];

$profil = query("SELECT * FROM user_barber WHERE barber_id_user = '$id_user'")[0];

if (isset($_POST["simpan"])) {
  if (edit($_POST) > 0) {
    echo "<script>
          alert('Berhasil Diubah');
          </script>";
  } else {
    echo "<script>
          alert('Gagal Diubah');
          </script>";
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BABE Barbershop</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
  <!-- Navbar -->
  <div class="container">
    <nav class="navbar fixed-top bg-body-secondary navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="img/logo.png" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link active" aria-current="page" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#bayar">Tata Cara</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#galeri">Galeri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#contact">Kontak</a>
            </li>
            <?php
            if (isset($_SESSION['id_user'])) {
              echo '
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user/layanan.php">Layanan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="user/bayar.php">Pembayaran</a>
            </li>
            ';
            }
            ?>
          </ul>
          <?php
          if (isset($_SESSION['id_user'])) {
            // jika user telah login, tampilkan tombol profil dan sembunyikan tombol login
            echo '<a href="user/profil.php" data-bs-toggle="modal" data-bs-target="#profilModal" class="btn btn-inti"><i data-feather="user"></i></a>';
          } else {
            // jika user belum login, tampilkan tombol login dan sembunyikan tombol profil
            echo '<a href="login.php" class="btn btn-inti" type="submit">Login</a>';
          }
          ?>
        </div>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->

  <!-- Modal Profil -->
  <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profilModalLabel">Profil Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-4 my-5">
                <img src="img/<?= $profil["barber_foto"]; ?>" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col-8">
                <h5 class="mb-3"><?= $profil["barber_nama_lengkap"]; ?></h5>
                <p><?= $profil["barber_jenis_kelamin"]; ?></p>
                <p><?= $profil["barber_email"]; ?></p>
                <p><?= $profil["barber_no_handphone"]; ?></p>
                <p><?= $profil["barber_alamat"]; ?></p>
                <a href="logout.php" class="btn btn-danger">Logout</a>
                <a href="" data-bs-toggle="modal" data-bs-target="#editProfilModal" class="btn btn-inti">Edit Profil</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Profil -->

  <!-- Edit profil -->
  <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog edit modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="fotoLama" class="form-control" id="exampleInputPassword1" value="<?= $profil["barber_foto"]; ?>">
          <div class="modal-body">
            <div class="row justify-content-center align-items-center">
              <div class="mb-3">
                <img src="img/<?= $profil["barber_foto"]; ?>" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                  <input type="text" name="barber_nama_lengkap" class="form-control" id="exampleInputPassword1" value="<?= $profil["barber_nama_lengkap"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($profil['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($profil['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for=barber_" class="form-label">No Telp</label>
                  <input type="number" name="barber_no_handphone" barber_class"form-control" id="exampleInputPassword1" value="<?= $profil["barber_no_handphone"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $profil["barber_email"]; ?>">
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">barber_alamat</label>
                <input type="text" name="barber_alamat" class="form-control" id="exampleInputPassword1" value="<?= $profil["barber_alamat"]; ?>">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Foto : </label>
                <input type="file" name="barber_foto" class="form-control" id="exampleInputPassword1">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-inti" name="simpan" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Edit Modal -->

  <!-- Jumbotron -->
  <section class="jumbotron" id="home">
    <main class="contain" data-aos="fade-right" data-aos-duration="1000">
      <br><br>
      <h1 class="text-light">BABE BARBERSHOP</h1>
      <p>Potongan Rambut Berkualitas Seni dalam Detail.
      </p><br><br><br>
      <a href="user/layanan.php" class="btn btn-inti">Booking Sekarang</a>
    </main>
  </section>
  <!-- End Jumbotron -->

  <!-- About -->
  <section class="about" id="about">
    <h2 data-aos="fade-down" data-aos-duration="1000">
      <span>Tentang</span> Kami
    </h2>
    <div class="row">
      <div class="about-img" data-aos="fade-right" data-aos-duration="1000">
        <img src="img/7.png" alt="" />
      </div>
      <div class="contain" data-aos="fade-left" data-aos-duration="1000">
        <h4 class="text-center mb-2">Jadwal Buka BABE</h4>
        <p>Setiap Hari Pukul 09.00 - 18.00</p><br><br>
        <h4 class="text-center mb-3">Kenapa Memilih BABE?</h4>
        <p>Babe Barbershop didirikan pada tahun 2023. Sebagai sebuah tempat cukur rambut, Babershop memiliki konsep unik dengan menggabungkan antara gaya dan keahlian dalam seni potong rambut. Kami sangat peduli dengan kualitas hasil potongan rambut yang kami berikan kepada pelanggan kami. Bagi kami, rambut adalah kanvas yang kami gunakan untuk menciptakan karya seni. Kami berkomitmen untuk memberikan pengalaman potong rambut yang berkualitas dan memuaskan bagi setiap pelanggan kami.</p>
      </div>
    </div>
  </section>
  <!-- End About -->

  <!-- Pembayaran -->
  <section class="pembayaran" id="bayar">
    <h2 data-aos="fade-down" data-aos-duration="1000">
      <span>Tata Cara</span> Pembayaran
    </h2>
    <p class="text-center">Berikut adalah tata cara pembayaran layanan pada website BABE Barbershop:</p>
    <ul class="border list-group list-group-flush mt-5">
      <li class="list-group-item">1. Pengguna harus membuat akun atau mendaftar sebagai anggota pada website BABE Barbershop.</li>
      <li class="list-group-item">2. Pengguna dapat memilih jenis layanan yang ingin dipesan, memilih tanggal dan waktu tertentu.</li>
      <li class="list-group-item">3. Pengguna harus memilih tanggal dan waktu, melihat harga booking layanan dan melengkapi formulir pemesanan.</li>
      <li class="list-group-item">4. Bila dirasa sudah sesuai, pengguna dapat meng klik tombol pesan.</li>
      <li class="list-group-item">5. Lalu pengguna akan diarahkan ke menu pembayaran</li>
      <li class="list-group-item">5. Lakukan pembayaran ke rekening yang sudah tertera dan upload bukti pembayaran</li>
      <li class="list-group-item">5. Setelah upload, tunggu admin menyetujui pembayaran anda</li>
      <li class="list-group-item">5. Setelah status sudah di setujui, silahkan datang ke BABE Barbershop sesuai jadwal yang di pesan</li>
    </ul>
  </section>
  <!-- End Pembayaran -->

  <br><br><br>
  <!-- Start -->
  <section class="galeri" id="galeri">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 mb-4 pb-2">
                        <div class="section-title text-center">
                            <h2 class="title mb-4">
                              <span>Galeri</span> BABE Barbershop</h2>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog blog-primary">
                            <img src="img/1.png" class="img-fluid rounded-md shadow" alt="">
                        </div>
                    </div><!--end col-->
                    
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog blog-primary">
                            <img src="img/2.png" class="img-fluid rounded-md shadow" alt="">
                        </div>
                    </div><!--end col-->
                    
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog blog-primary">
                            <img src="img/3.png" class="img-fluid rounded-md shadow" alt="">
                        </div>
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog blog-primary">
                            <img src="img/4.png" class="img-fluid rounded-md shadow" alt="">
                        </div>
                    </div><!--end col-->
                    
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog blog-primary">
                            <img src="img/5.png" class="img-fluid rounded-md shadow" alt="">
                        </div>
                    </div><!--end col-->
                    
                    <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                        <div class="blog blog-primary">
                            <img src="img/6.png" class="img-fluid rounded-md shadow" alt="">
                        </div>
                    </div><!--end col-->
                </div><!--end row-->      

            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->

          <!-- Contact -->
  <section id="contact" class="contact" data-aos="fade-down" data-aos-duration="1000">
    <h2><span>Kontak</span> Kami</h2>
    <center><p>
      <img src="img/whatsapp.png" width="100" height="100"/></p>
    </center>
    <p class="text-center m-5">
      Hubungi kami jika ada saran yang ingin di sampaikan melalui <a href="https://wa.me/6282218487023">WhatsApp</a>
    </p>
    <div class="row">
     
      <div class="col">
        <form action="">
          <button type="submit" class="btn btn-inti mt-3"><span style="color: white"><a href="https://wa.me/6282218487023">Kirim Pesan</a></span></button>
        </form>
      </div>
    </div>
  </section>
  <!-- End Contact -->

  <!-- footer -->
  <footer>
    <div class="credit">
      <br>
      <p>Created by <a href="#">Haizuma & Wyldan</a> &copy; 2024</p>
    </div>
  </footer>
  <!-- End Footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script>
    feather.replace();
  </script>
</body>

</html>