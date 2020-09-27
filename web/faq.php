<?php
$code = $_GET['id'];
?>
<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon.ico">
  <link rel="icon" type="image/png" href="./assets/img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    EU Twinnings
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link href="./assets/css/eutwinnings.css" rel="stylesheet" />


  <script src="./assets/chartjs/Chart.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./assets/chartjs/Chart.min.css">

</head>



<body class="index-page sidebar-collapse">

  <?php
  include ('nav.php');
  ?>

  <div class="page-header header-region header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/eubg2.jpg');">
    <div class="container mt-0">
      <div class="row mt-0">





          <div class="col-md-12 mt-0 ml-auto mr-auto">
              <h2 id="regionName" class="title">Frequently Asked Questions</h2>
          </div>




      </div>
    </div>
  </div>


  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">

        <div class="row col-md-12">

          <div class="container">
            <h4 class="title">What is this website?</h4>
            <p>EU Twinnings is a website developed by <a href="http://twitter.com/puntofisso">Giuseppe Sollazzo</a> for the <a href="https://op.europa.eu/en/web/eudatathon/home">EU Datathon 2020</a>. It was selected as one of the 3 finalists of <i>Challenge 2: An economy that works for people</i>.<br/> You can watch an introduction <a href="https://www.youtube.com/watch?v=OO34wa2a7VE&list=PLT5rARDev_rmsUE8Wzvi0dGXsk9FCZQjr&index=12">here</a>.</p>
            <h4 class="title">How is similarity calculated?</h4>
            <p>The similarity between areas is calculated using the formula known as <a href="https://en.wikipedia.org/wiki/Cosine_similarity">cosine similarity</a> over a number of selected Eurostat statistics at either the NUTS3 area level, or at the level of one of its containers.</p>
            <p>The list of fields on which we currently calculate similarity is: population of the NUTS3 area, population of the containing NUTS0 area, population density, fertility rate, population change since the last census, ratio of women to men, GDP per PPS, and GVA.</p>
            <p>Although every similarity measure is, to a certain extent, arbitrary, we believe that this choice gives some food for thought.</p>
            <p>The full souce code is on <a href="http://github.com/puntofisso">GitHub</a>.
          </div>



        </div>






    </div>



    </div>
  </div>

  <?php
  include ('footer.php');
  ?>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <!--script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script-->
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <link rel="stylesheet" href="./assets/jquery-ui-1.12.1/jquery-ui.css">
  <script src="./assets/jquery-ui-1.12.1/jquery-ui.js"></script>
  <
</body>

</html>
