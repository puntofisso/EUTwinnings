<?php
$code1 = $_GET['code1'];
$code2 = $_GET['code2'];
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
              <h2 id="geoContext" class="title">Compare</h2>
              <h4 id="sim">Similarity: TBC</h4>
          </div>

      </div>
    </div>
  </div>


  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">

<div class="row col-md-12">








              <table class="table">
                <thead>
                    <th class="text-left"></th>
                    <th class="text-center" id="th_11"></th>
                    <th class="text-center" id="th_12"></th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left-middle">&nbsp;</td>
                        <td class="text-center"><img src="assets/nutsmaps/<?php echo $code1;?>.png"/></td>
                        <td class="text-center"><img src="assets/nutsmaps/<?php echo $code2;?>.png"/></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>Code</b></td>
                        <td class="text-center" id="th_21"></td>
                        <td class="text-center" id="th_22"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>Population</b></td>
                        <td class="text-center" id="th_pop1"></td>
                        <td class="text-center" id="th_pop2"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>Population change</b></td>
                        <td class="text-center" id="th_popch1"></td>
                        <td class="text-center" id="th_popch2"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>Density</b></td>
                        <td class="text-center" id="th_density1"></td>
                        <td class="text-center" id="th_density2"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>Women ratio</b></td>
                        <td class="text-center" id="th_women1"></td>
                        <td class="text-center" id="th_women2"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>Fertility</b></td>
                        <td class="text-center" id="th_fertility1"></td>
                        <td class="text-center" id="th_fertility2"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>GDP per capita PPS</b></td>
                        <td class="text-center" id="th_gdp1"></td>
                        <td class="text-center" id="th_gdp2"></td>
                    </tr>

                    <tr>
                        <td class="text-left"><b>GVA</b></td>
                        <td class="text-center" id="th_gva1"></td>
                        <td class="text-center" id="th_gva2"></td>
                    </tr>

                </tbody>
                  </table>







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
  <script>


    $(document).ready( function() {


      $.ajaxSetup({
          async: false
      });

      $.getJSON( "nuts.php?code=<?php echo $code1;?>", function( data ) {
        window.data1 = data;
      });

        $.getJSON( "nuts.php?code=<?php echo $code2;?>", function( data ) {
          window.data2 = data;
        });


        setBasicInfo();

        $.ajaxSetup({
            async: true
        });
});

function wordCase(str) {
  str = String(str).toLowerCase();
  str = str.split(" ");


for (var i = 0, x = str.length; i < x; i++) {
str[i] = str[i][0].toUpperCase() + str[i].substr(1);
}

return str.join(" ");
        }


function setBasicInfo() {
  var data1 = window.data1;
  var data2 = window.data2;

  $('#geoContext').html(data1['name'] + " vs " + data2['name']);


  similarity = data1['similarity'][data2.code]['similarity'];
  $('#sim').html("Similarity: " + similarity);


  $('#th_11').html(data1['name']);
  $('#th_12').html(data2['name']);


  var html1 = "<a href='region.php?id=" + data1['code'] + "'>" + data1['code'] + "</a>";
  var html2 = "<a href='region.php?id=" + data2['code'] + "'>" + data2['code'] + "</a>";
  $('#th_21').html(html1);
  $('#th_22').html(html2);


  $('#th_pop1').html(data1['population']);
  $('#th_pop2').html(data2['population']);

  $('#th_popch1').html(data1['popchange']);
  $('#th_popch2').html(data2['popchange']);

  $('#th_density1').html(data1['density']);
  $('#th_density2').html(data2['density']);

  $('#th_women1').html(data1['womenratio']);
  $('#th_women2').html(data2['womenratio']);

  $('#th_fertility1').html(data1['fertility']);
  $('#th_fertility2').html(data2['fertility']);

  $('#th_gdp1').html(Math.round(data1['gdppps']* 100)/100);
  $('#th_gdp2').html(Math.round(data2['gdppps']* 100)/100);




  $('#th_gva1').html(Math.round(data1['gva']* 100)/100);
  $('#th_gva2').html(Math.round(data2['gva']* 100)/100);


}










  </script>
</body>

</html>
