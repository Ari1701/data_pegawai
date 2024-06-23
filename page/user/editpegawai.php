<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/dashboard.css" rel="stylesheet">

  </head>
  <body>

  <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Admin</a>

  <ul class="navbar-nav flex-row d-md-none">
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
        <svg class="bi"><use xlink:href="#search"/></svg>
      </button>
    </li>
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="bi"><use xlink:href="#list"/></svg>
      </button>
    </li>
  </ul>

  <div class="container">
    <h1>Selamat Datang di Halaman Utama</h1>
    <form action="../../auth/logout.php" method="post">
        <button type="submit" class="btn btn-danger">
            Logout
        </button>
    </form>
</div>

</header>

<div class="container-fluid" style="height: 100vh;">
  <div class="row">
  <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary" style="height: 100vh; overflow-y: auto;">
      <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="sidebarMenuLabel">ATravel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto" style="height: 100%;">
            <ul class="nav flex-column" style="height: 100%; overflow-y: auto;">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 <?php echo ($_SERVER['REQUEST_URI'] == '/page/user/index.php' || $_SERVER['REQUEST_URI'] == '/user/') ? 'active' : ''; ?>" href="../user/index.php">
                        <i class="bi bi-house-fill"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-1 <?php echo ($_SERVER['REQUEST_URI'] == '/tambahpegawai.php' || $_SERVER['REQUEST_URI'] == '/tambahpegawai/') ? 'active' : ''; ?>" href="../user/tambahpegawai.php">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah Pegawai
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link mb-3 <?php echo ($_SERVER['REQUEST_URI'] == '/lihatpegawai.php' || $_SERVER['REQUEST_URI'] == '/lihatpegawai/') ? 'active' : ''; ?>" href="../user/lihatpegawai.php">
                    <i class="bi bi-people-fill"></i>
                    Lihat Pegawai
                </a>
            </li>
            </ul>
        </div>

      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
    <?php
// Include koneksi ke database
include '../../auth/koneksi.php';

// Ambil ID pegawai dari parameter URL
$id = $_GET['id'];

// Query untuk mengambil data pegawai berdasarkan ID
$sql = "SELECT * FROM pegawai WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nama = $row['nama'];
    $email = $row['email'];
    $telepon = $row['telepon'];
    $alamat = $row['alamat'];
    $jabatan = $row['jabatan'];
    $tanggal_masuk = $row['tanggal_masuk'];
    $gaji = $row['gaji'];
    $jenis_kelamin = $row['jenis_kelamin']; // Menambahkan jenis kelamin
} else {
    echo "Pegawai tidak ditemukan.";
    exit();
}
?>

    <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Edit Pegawai
                        </div>
                        <div class="card-body">
                            <form action="../../auth/editpegawai_proses.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $nama; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" name="telepon" id="telepon" class="form-control" value="<?php echo $telepon; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control"><?php echo $alamat; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?php echo $jabatan; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="<?php echo $tanggal_masuk; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gaji">Gaji</label>
                                    <input type="text" name="gaji" id="gaji" class="form-control" value="<?php echo $gaji; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="../user/lihatpegawai.php" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/dashboard.js"></script>
</body>
</body>
</html>
