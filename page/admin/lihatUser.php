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
        <h1 class="h2">Lihat User</h1>
    </div>
    <?php
    include '../../auth/koneksi.php';
    $successMessage = isset($_GET['success']) ? $_GET['success'] : '';
    $errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
    ?>

    <div class="container">
        <h1>Admin Dashboard</h1>

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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT id, username, role FROM users");
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td>';
                    echo '<a href="editUser.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm mr-2">Edit</a>';
                    echo '<a href="#" class="btn btn-danger btn-sm" onclick="showDeleteModal(' . $row['id'] . ')">Hapus</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal konfirmasi -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <p>Anda yakin ingin menghapus pengguna ini?</p>
            <form action="deleteUser.php" method="post">
                <input type="hidden" id="userId" name="userId" value="">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
    </main>
  </div>
</div>
<script>
        function showDeleteModal(userId) {
            var modal = document.getElementById('deleteModal');
            var userIdInput = document.getElementById('userId');
            userIdInput.value = userId;
            modal.style.display = "block";
        }

        function closeDeleteModal() {
            var modal = document.getElementById('deleteModal');
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/dashboard.js"></script>
</body>
</body>
</html>
