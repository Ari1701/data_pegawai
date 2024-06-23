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
          <h5 class="offcanvas-title" id="sidebarMenuLabel">E-Office</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto" style="height: 100%;">
            <ul class="nav flex-column" style="height: 100%; overflow-y: auto;">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 <?php echo ($_SERVER['REQUEST_URI'] == '/page/admin/admin.php' || $_SERVER['REQUEST_URI'] == '/admin/') ? 'active' : ''; ?>" href="../admin/admin_dashboard.php">
                        <i class="bi bi-house-fill"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-1 <?php echo ($_SERVER['REQUEST_URI'] == '/tambahUser.php' || $_SERVER['REQUEST_URI'] == '/tambahUser/') ? 'active' : ''; ?>" href="../admin/tambahUser.php">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah User
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link mb-3 <?php echo ($_SERVER['REQUEST_URI'] == '/lihatUser.php' || $_SERVER['REQUEST_URI'] == '/lihatUser/') ? 'active' : ''; ?>" href="../admin/lihatUser.php">
                    <i class="bi bi-people-fill"></i>
                    Lihat User
                </a>
            </li>
            </ul>
        </div>

      </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah User</h1>
    </div>
    <div class="container">
        <h1 class="my-4">Edit Pengguna</h1>

        <?php
        // Sertakan file koneksi.php
        require_once '../../auth/koneksi.php';

        // Periksa apakah form telah dikirimkan (method POST)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $userId = $_POST['userId'];
            $editusername = $_POST['editusername'];
            $editRole = $_POST['editRole'];

            // Query untuk memperbarui data pengguna berdasarkan id
            $sql = "UPDATE users SET username=?, role=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $editusername, $editRole, $userId);

            // Eksekusi statement
            if ($stmt->execute()) {
                // Redirect ke halaman lihatUser.php setelah berhasil diupdate
                header("Location: lihatUser.php");
                exit();
            } else {
                echo "Terjadi kesalahan saat memperbarui pengguna.";
            }

            // Tutup statement
            $stmt->close();
        } else {
            // Jika tidak ada id pengguna yang diterima dari parameter GET, beri pesan error
            if (!isset($_GET['id'])) {
                echo "Parameter id tidak ditemukan.";
                exit();
            }

            // Ambil id pengguna dari parameter GET
            $userId = $_GET['id'];

            // Query untuk mengambil data pengguna berdasarkan id
            $sql = "SELECT * FROM users WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();


            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Formulir untuk mengedit data pengguna
                echo '<form action="editUser.php" method="post">';
                echo '<input type="hidden" name="userId" value="' . $row['id'] . '">';
                echo '<div class="form-group">';
                echo '<label for="editusername">Nama Pengguna</label>';
                echo '<input type="text" class="form-control" id="editusername" name="editusername" value="' . $row['username'] . '" required>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="editRole">Role Pengguna</label>';
                echo '<input type="text" class="form-control" id="editRole" name="editRole" value="' . $row['role'] . '" required>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary">Simpan Perubahan</button>';
                echo '</form>';
            } else {
                echo "Pengguna dengan id tersebut tidak ditemukan.";
            }

            // Tutup statement
            $stmt->close();
        }

        // Tutup koneksi database
        $conn->close();
        ?>
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
