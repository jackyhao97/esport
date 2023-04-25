<?php 
  session_start();
  require_once '../config.php';
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
      require_once '../navbar.php';
    ?>

    <!-- Tampilan Banner -->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <img src="<?=BASE_URL.DS.'assets/img/home/esports.jpg'?>" class="d-block w-100" alt="...">
        </div>
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
    <!-- End -->
    <?php 
      require_once '../footer.php';
    ?>

    <script>
      function loadData() {
        let tipe = "hot";
        $.ajax({
          type: "post",
          url: "data-event.php",
          data: {tipe: tipe},
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
      $("#moba").click(function() {        
        let tipe = "moba";
        $(".category").each(function() {
          $(this).removeClass("event-active");
        })
        $(this).addClass("event-active");
        $.ajax({
          type: "post",
          url: "data-event.php",
          data: {tipe: tipe},
          success: function(data) {
            $("#hasil").html(data);
          },
          error: function(data) {
            console.log('error');
          }
        })
      })      
      $("#fps").click(function() {        
        let tipe = "fps";
        $(".category").each(function() {
          $(this).removeClass("event-active");
        })
        $(this).addClass("event-active");
        $.ajax({
          type: "post",
          url: "data-event.php",
          data: {tipe: tipe},
          success: function(data) {
            $("#hasil").html(data);
          },
          error: function(data) {
            console.log('error');
          }
        })
      })
      $("#battle-royale").click(function() {
        let tipe = "battle-royale";
        $(".category").each(function() {
          $(this).removeClass("event-active");
        })
        $(this).addClass("event-active");
        $.ajax({
          type: "post",
          url: "data-event.php",
          data: {tipe: tipe},
          success: function(data) {
            $("#hasil").html(data);
          },
          error: function(data) {
            console.log('error');
          }
        })
      })      
      $("#fighting").click(function() {
        let tipe = "fighting";
        $(".category").each(function() {
          $(this).removeClass("event-active");
        })
        $(this).addClass("event-active");
        $.ajax({
          type: "post",
          url: "data-event.php",
          data: {tipe: tipe},
          success: function(data) {
            $("#hasil").html(data);
          },
          error: function(data) {
            console.log('error');
          }
        })
      })
      $("#talkshow").click(function() {
        let tipe = "talkshow";
        $(".category").each(function() {
          $(this).removeClass("event-active");
        })
        $(this).addClass("event-active");
        $.ajax({
          type: "post",
          url: "data-event.php",
          data: {tipe: tipe},
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
