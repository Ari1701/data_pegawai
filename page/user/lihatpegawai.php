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
    include '../../auth/koneksi.php'; 

    $successMessage = isset($_GET['success']) ? $_GET['success'] : '';
    $errorMessage = isset($_GET['error']) ? $_GET['error'] : '';

    $sql = "SELECT * FROM pegawai";
    $result = $conn->query($sql);
    ?>

      </div>
      <div class="container mt-5">
        <h2>Data Pegawai</h2>

        <?php if ($successMessage): ?>
            <div class="alert alert-success">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <div class="alert alert-danger">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
                    <th>Gaji</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telepon']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['jabatan']; ?></td>
                            <td><?php echo $row['tanggal_masuk']; ?></td>
                            <td><?php echo $row['gaji']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td>
                                <a href="editpegawai.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="showDeleteModal(<?php echo $row['id']; ?>)">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Tidak ada data pegawai.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal untuk konfirmasi penghapusan -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus pengguna ini?</p>
            <form id="deleteForm" method="post" action="deleteUser.php">
                <input type="hidden" name="id" id="deleteId">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
            </form>
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
<script src="../../assets/js/edit.js"></script>
</body>
</body>
</html>
