<?php
session_start();
require_once '../config.php';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : header("location:../login/");
?>

<!doctype html>
<html lang="en">

<head>
  <?php
  require_once '../header.php';
  ?>
  <title>Event</title>
</head>

<body>
  <?php
  require_once '../navbar-white.php';
  ?>

  <!-- Tampilan Banner -->
  <img src="<?= BASE_URL . DS . 'assets/img/event/banner-event.jpg' ?>" class="d-block w-100" alt="Event">
  <!-- Akhir Tampilan Banner -->

  <!-- Tampilan Kategori -->
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <button type="button" class="btn btn-outline-primary rounded-pill category event-active" id="hot">HOT</button>
        <button type="button" class="btn btn-outline-primary rounded-pill category" id="moba">MOBA</button>
        <button type="button" class="btn btn-outline-primary rounded-pill category" id="fps">FPS</button>
        <button type="button" class="btn btn-outline-primary rounded-pill category" id="battle-royale">Battle Royale</button>
        <button type="button" class="btn btn-outline-primary rounded-pill category" id="fighting">Fighting</button>
        <button type="button" class="btn btn-outline-primary rounded-pill category" id="talkshow">TalkShow</button>
      </div>
    </div>
    <div class="row mt-5" id="hasil">
      <!-- Event Inject disini -->
    </div>
  </div>
  <!-- Akhir Tampilan Kategori -->
  <?php
  require_once '../footer.php';
  ?>

  <script>
    // tampil data untuk tipe hot
    function loadData() {
      let tipe = "hot";
      let user = "<?= $id ?>";
      $.ajax({
        type: "post",
        url: "data-event.php",
        data: {
          tipe: tipe,
          user: user
        },
        success: function(data) {
          $("#hasil").html(data);
        },
        error: function(data) {
          console.log('error');
        }
      })
    }
    loadData();

    $("#hot").click(function() {
      $(".category").each(function() {
        $(this).removeClass("event-active");
      })
      $(this).addClass("event-active");
      loadData();
    })

    // tampil data untuk tipe moba
    $("#moba").click(function() {
      let tipe = "moba";
      $(".category").each(function() {
        $(this).removeClass("event-active");
      })
      $(this).addClass("event-active");
      $.ajax({
        type: "post",
        url: "data-event.php",
        data: {
          tipe: tipe
        },
        success: function(data) {
          $("#hasil").html(data);
        },
        error: function(data) {
          console.log('error');
        }
      })
    })

    // tampil data untuk tipe fps
    $("#fps").click(function() {
      let tipe = "fps";
      $(".category").each(function() {
        $(this).removeClass("event-active");
      })
      $(this).addClass("event-active");
      $.ajax({
        type: "post",
        url: "data-event.php",
        data: {
          tipe: tipe
        },
        success: function(data) {
          $("#hasil").html(data);
        },
        error: function(data) {
          console.log('error');
        }
      })
    })

    // tampil data untuk tipe battle royale
    $("#battle-royale").click(function() {
      let tipe = "battle-royale";
      $(".category").each(function() {
        $(this).removeClass("event-active");
      })
      $(this).addClass("event-active");
      $.ajax({
        type: "post",
        url: "data-event.php",
        data: {
          tipe: tipe
        },
        success: function(data) {
          $("#hasil").html(data);
        },
        error: function(data) {
          console.log('error');
        }
      })
    })

    // tampil data untuk tipe fighting
    $("#fighting").click(function() {
      let tipe = "fighting";
      $(".category").each(function() {
        $(this).removeClass("event-active");
      })
      $(this).addClass("event-active");
      $.ajax({
        type: "post",
        url: "data-event.php",
        data: {
          tipe: tipe
        },
        success: function(data) {
          $("#hasil").html(data);
        },
        error: function(data) {
          console.log('error');
        }
      })
    })

    // tampil data untuk tipe talkshow
    $("#talkshow").click(function() {
      let tipe = "talkshow";
      $(".category").each(function() {
        $(this).removeClass("event-active");
      })
      $(this).addClass("event-active");
      $.ajax({
        type: "post",
        url: "data-event.php",
        data: {
          tipe: tipe
        },
        success: function(data) {
          $("#hasil").html(data);
        },
        error: function(data) {
          console.log('error');
        }
      })
    })
  </script>
</body>

</html>