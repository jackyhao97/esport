<?php 
  session_start();
  require_once '../config.php';
  $username = (isset($_POST['txt_username']) ? $_POST['txt_username'] : '');
  $password = (isset($_POST['txt_password']) ? md5($_POST['txt_password']) : '');
  if (isset($_POST["btn_login"])) {
    $result = $conn->query("SELECT * FROM tb_account WHERE username = '$username' AND is_active = 1");
    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      if ($password == $row["password"]) {
        $_SESSION["login"] = true;
        $_SESSION['status'] = "login";
        $_SESSION['username'] = $row["username"];
        $_SESSION['id'] = $row["id"];
        header("Location: ../index.php");
      } else {
        $_SESSION["login"] = false;
        $_SESSION['status'] = "";
        $_SESSION['username'] = "";
        echo "<script>alert('Password Salah!')</script>";
      }
    } else {
      $_SESSION["login"] = false;
      $_SESSION['status'] = "";
      $_SESSION['username'] = "";
      echo "<script>alert('Username tidak tersedia!')</script>";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <?php 
      require_once '../header.php';
    ?>
    <title>Login Esports</title>
  </head>
  <body style="background: url('../assets/img/bg-login.jpg')">
    <?php 
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Login -->
    <div class="container d-flex mt-100">
      <form class="esport-login m-auto bg-login" method="post">
        <img src="../assets/img/logo.png" alt="Ligasport" class="w-50 text-center mb-3 d-flex m-auto">
        <div class="mb-3">
          <label for="txt_username" class="form-label">Username</label>
          <input type="text" class="form-control" id="txt_username" name="txt_username" autofocus>
        </div>
        <div class="mb-3">
          <label for="txt_password" class="form-label">Password</label>
          <input type="password" class="form-control" id="txt_password" name="txt_password">
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <button type="submit" class="btn btn-primary" name="btn_login">Login</button>
          <div>
            <span>Belum punya account?</span>
            <a href="../register/" class="text-right">Register</a>
          </div>
        </div>
      </form>
    </div>
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>
  </body>
</html>
