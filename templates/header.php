<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
  <!-- DatePicker stiil jms JQuery UI STAFF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <!-- Estonian calendar -->
  <script src="js/datepicker-et.js"></script>
  <!-- JQuery UI stiilid (DatePicker) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">

  <!-- Separate Popper and Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  <!-- My styles -->
  <link rel="stylesheet" href="css/mystyles.css">

  <title>Urmas Tehver lõputöö</title>

</head>

<body>

  <!-- Menu buttons -->
  <div id="header" class="container-md">
    <div class="row justify-content-center mt-2">
      <div class="col-auto mt-2"><a href="index.php" class="btn btn-primary btn-lg <?php if ($page == 'home') {
                                                                                      echo 'disabled';
                                                                                    } ?> " role="button" aria-disabled="true">Avaleht</a></div>
      <div class="col-auto mt-2"><a href="west.php" class="btn btn-secondary btn-lg <?php if ($page == 'west') {
                                                                                      echo 'disabled';
                                                                                    } ?> " role="button" aria-disabled="true">Läänes</a></div>
      <div class="col-auto mt-2"><a href="east.php" class="btn btn-success btn-lg <?php if ($page == 'east') {
                                                                                    echo 'disabled';
                                                                                  } ?> " role="button" aria-disabled="true">Idas</a></div>
      <div class="col-auto mt-2"><a href="alarm.php" class="btn btn-danger btn-lg <?php if ($page == 'alarm') {
                                                                                    echo 'disabled';
                                                                                  } ?> " role="button" aria-disabled="true">Äratus</a></div>
      <div class="col-auto mt-2"><a href="radio.php" class="btn btn-warning btn-lg <?php if ($page == 'radio') {
                                                                                      echo 'disabled';
                                                                                    } ?> " role="button" aria-disabled="true">Raadio</a></div>
      <div class="col-auto mt-2"><a href="weather.php" class="btn btn-info btn-lg <?php if ($page == 'weather') {
                                                                                    echo 'disabled';
                                                                                  } ?> " role="button" aria-disabled="true">Ilm</a></div>
    </div>
  </div>