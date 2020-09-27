<?php
$how = $_GET['how'];
include('method.php');

$db = null;
if ($method == "sqlite") {
  $db = new PDO('sqlite:data/nuts.db');
} else {

  $host = '127.0.0.1';
  $dbname   = 'eutwinnings';
  $user = 'eutwinnings';
  $pass = '';
  $port = "3306";
  $charset = 'utf8';

  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
  try {
       $db = new PDO($dsn, $user, $pass, $options);
  } catch (PDOException $e) {
       throw new PDOException($e->getMessage(), (int)$e->getCode());
  }


}
$lista1 = null;
$uselista1 = false;

$lista2 = null;
$uselista2 = false;


if (isset($_GET['list1'])) {
  $uselista1 = true;
  $list1 = $_GET['list1'];
  $lista1 = explode(",", $list1);
  $result1 = "'" . implode ( "', '", $lista1 ) . "'";
} else {
  $result1 = "'AL','AT','BE','BG','CH','CY','CZ','DE','DK','EE','EL','ES','FI','FR','HR','HU','IE','IS','IT','LI','LT','LU','LV','ME','MK','MT','NL','NO','PL','PT','RO','RS','SE','SI','SK','TR','UK'";
  $lista1 = explode(",",str_replace("'","",$result1));

}

if (isset($_GET['list2'])) {
  $uselista2 = true;
  $list2 = $_GET['list2'];
  $lista2 = explode(",", $list2);
  $result2 = "'" . implode ( "', '", $lista2 ) . "'";
} else {
  $result2 = "'AL','AT','BE','BG','CH','CY','CZ','DE','DK','EE','EL','ES','FI','FR','HR','HU','IE','IS','IT','LI','LT','LU','LV','ME','MK','MT','NL','NO','PL','PT','RO','RS','SE','SI','SK','TR','UK'";
  $lista2 = explode(",",str_replace("'","",$result2));
}

$stm = $db->prepare("SELECT s.code1 as code1, s.code2 as code2, n1.name as name1, n1.nuts0 as country1, n2.name as name2, n2.nuts0 as country2, s.similarity as similarity FROM similarity s, nuts n1 , nuts n2 WHERE s.code1 = n1.code AND s.code2 = n2.code AND n1.name != '' AND n2.name != '' AND n1.nuts0 IN ($result1) AND n2.nuts0 IN ($result2) ORDER BY similarity $how LIMIT 20;");
$res = $stm->execute();
$data = $stm->fetchAll();




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
              <h2 id="geoContext" class="title">Top 20</h2>
              <?php

                if ($how == "desc") {
                  echo "<h4>Most similar</h2>";
                } else {
                  echo "<h4>Least similar</h2>";
                }

              ?>

          </div>

      </div>
    </div>
  </div>


  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">



  <div class="row container">


    <div class="col-md-6">

      <h3>Select regions 1</h3>
        <?php

          $countries = ['AL','AT','BE','BG','CH','CY','CZ','DE','DK','EE','EL','ES','FI','FR','HR','HU','IE','IS','IT','LI','LT','LU','LV','ME','MK','MT','NL','NO','PL','PT','RO','RS','SE','SI','SK','TR','UK'];

          foreach ($countries as $country) {
            $checked="";
            if ($uselista1) {
              if (in_array($country,$lista1)) {
                $checked="checked";
              }
            } else {
              $checked="checked";
            }

            ?>
              <input class="countrytoggles1" id="<?php echo $country;?>" type="checkbox" <?php echo $checked;?> data-toggle="toggle" data-onstyle="warning" data-size="xs"><?php echo $country;?></input>
            <?php
          }

        ?>
        <div class="container">
          <a href="#" id="btnCheck1" class="btn btn-primary btn-xs" role="button" aria-disabled="true">Check all</a>
          <a href="#" id="btnUncheck1" class="btn btn-primary btn-xs" role="button" aria-disabled="true">Uncheck all</a>
      </div>

</div>
<div class="col-md-6">
      <h3>Select regions 2</h3>
        <?php

          $countries = ['AL','AT','BE','BG','CH','CY','CZ','DE','DK','EE','EL','ES','FI','FR','HR','HU','IE','IS','IT','LI','LT','LU','LV','ME','MK','MT','NL','NO','PL','PT','RO','RS','SE','SI','SK','TR','UK'];

          foreach ($countries as $country) {
            $checked="";
            if ($uselista2) {
              if (in_array($country,$lista2)) {
                $checked="checked";
              }
            } else {
              $checked="checked";
            }

            ?>
              <input class="countrytoggles2" id="<?php echo $country;?>" type="checkbox" <?php echo $checked;?> data-toggle="toggle" data-onstyle="warning" data-size="xs"><?php echo $country;?></input>
            <?php
          }

        ?>
        <div class="container">
          <a href="#" id="btnCheck2" class="btn btn-primary btn-xs" role="button" aria-disabled="true">Check all</a>
          <a href="#" id="btnUncheck2" class="btn btn-primary btn-xs" role="button" aria-disabled="true">Uncheck all</a>
      </div>


</div>
  <a href="#" id="btnGo" class="btn btn-primary btn-m" role="button" aria-disabled="true">Go</a>


              <table class="table">
                <thead>
                    <th class="text-left">#</th>
                    <th class="text-left">Region 1</th>
                    <th class="text-left">Region 2</th>
                    <th class="text-center">Similarity</th>
                </thead>
                <tbody>

                  <?php
                    $i=0;
                    foreach ($data as $row) {

                      $i++;
                      ?>
                      <tr>
                          <td class="text=left"><?php echo $i;?></td>
                          <td class="text-centre"><?php echo $row['name1'] . ", " . $row['country1']; ?></td>
                          <td class="text-centre"><?php echo $row['name2'] . ", " . $row['country2']; ?></td>
                          <td class="text-centre"><a href="compare.php?code1=<?php echo $row['code1'];?>&code2=<?php echo $row['code2'];?>"><?php echo $row['similarity'] ;?></a></td>
                      </tr>
                      <?php

                    }

                  ?>





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

  <!--link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script-->
<link href="./assets/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="./assets/bootstrap4-toggle.min.js"></script>

  <script>




function wordCase(str) {
  str = String(str).toLowerCase();
  str = str.split(" ");


for (var i = 0, x = str.length; i < x; i++) {
str[i] = str[i][0].toUpperCase() + str[i].substr(1);
}

return str.join(" ");
        }


          $("#btnCheck1").click(function(e) {
            e.preventDefault();
              $(".countrytoggles1").each(function () {

                $(this).bootstrapToggle('on');


              });
          });

          $("#btnCheck2").click(function(e) {
            e.preventDefault();
              $(".countrytoggles2").each(function () {

                $(this).bootstrapToggle('on');


              });
          });

          $("#btnUncheck1").click(function(e) {
            e.preventDefault();
              $(".countrytoggles1").each(function () {
                $(this).bootstrapToggle('off');
              });
          });

          $("#btnUncheck2").click(function(e) {
            e.preventDefault();
              $(".countrytoggles2").each(function () {
                $(this).bootstrapToggle('off');
              });
          });




          $("#btnGo").click(function(e) {
            e.preventDefault();
            // document.getElementById('toggle-state').checked
            var listArray1 = [];
            $(".countrytoggles1").each(function () {

              if (this.checked) {
                listArray1.push(this.id);
              }
            });

            var listArray2 = [];
            $(".countrytoggles2").each(function () {

              if (this.checked) {
                listArray2.push(this.id);
              }
            });


            var url="";

            var list1 = "";
            var list2 = "";

            if (listArray1.length > 0) {
              var list = listArray1.join();
              list1 = list;
            } else {
              list1 = "AL,AT,BE,BG,CH,CY,CZ,DE,DK,EE,EL,ES,FI,FR,HR,HU,IE,IS,IT,LI,LT,LU,LV,ME,MK,MT,NL,NO,PL,PT,RO,RS,SE,SI,SK,TR,UK";
            }

            if (listArray2.length > 0) {
              var list = listArray2.join();
              list2 = list;
            } else {
              list2 = "AL,AT,BE,BG,CH,CY,CZ,DE,DK,EE,EL,ES,FI,FR,HR,HU,IE,IS,IT,LI,LT,LU,LV,ME,MK,MT,NL,NO,PL,PT,RO,RS,SE,SI,SK,TR,UK";
            }


            var url = url + "top20.php?how=<?php echo $how;?>&list1="+list1+"&list2="+list2;




            window.location.href=url;
          })


  </script>

</body>

</html>
