<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="<?=BASE_URL?>"><i class="fa-solid fa-house"></i> HOME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse p-3 p-sm-0" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-3">
          <a class="nav-link text-dark" aria-current="page" href="<?=BASE_URL.DS.'berita/'?>"><i class="fa-solid fa-newspaper"></i> BERITA</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'event/'?>"><i class="fa-solid fa-calendar"></i> EVENT</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'create-event/'?>">Create Event</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'event-organizer/'?>">Event Organizer</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'history/'?>">History</a>
        </li>
      </ul>
      <ul class="navbar-nav flex-row justify-content-between mt-5 mt-sm-0">
      <?php 
        if (isset($_SESSION['id'])) :
      ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hello, <?=$_SESSION['username']?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?=BASE_URL.DS.'logout.php'?>">Logout</a></li>
            <li><a class="dropdown-item" href="<?=BASE_URL.DS.'profile/'?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="<?=BASE_URL.DS.'profile/ubahpassword.php'?>">Ubah Password</a></li>
          </ul>
        </li>
      <?php
        else :
      ?>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'login/'?>"><i class="fa-solid fa-circle-user"></i> PROFIL</a>
        </li>
      <?php
        endif;
      ?>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'notifikasi/'?>"><i class="fa-regular fa-bell"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>