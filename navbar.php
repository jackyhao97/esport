<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="<?=BASE_URL?>"><i class="fa-solid fa-house"></i> HOME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse p-3 p-sm-0" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-3">
          <a class="nav-link text-dark" aria-current="page" href="<?=BASE_URL.DS.'berita/'?>"><i class="fa-solid fa-newspaper me-1"></i> BERITA</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link text-dark" href="<?=BASE_URL.DS.'event/'?>"><i class="fa-solid fa-calendar me-1"></i> EVENT</a>
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
            <li>
              <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal" style="cursor:pointer">
                Logout
              </a>
            </li>
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

<!-- Logout Modal-->
<div class="modal" tabindex="-1" id="logoutModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin untuk logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?=BASE_URL.DS.'logout.php'?>">Logout</a>
      </div>
    </div>
  </div>
</div>
