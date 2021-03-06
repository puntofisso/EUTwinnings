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
              <h2 id="regionName" class="title">&nbsp;</h2>
              <h4 id="geoContext">&nbsp;</h3>
          </div>




      </div>
    </div>
  </div>


  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">

        <div class="row col-md-12">



            <div class="col-md-4 mt-0 ml-auto mr-auto">
              <img src="assets/nutsmaps/<?php echo $code;?>.png"/>
            </div>

            <div class="col-md-4 mt-0 ml-auto mr-auto">
                <!--h2 id="regionName" class="title">&nbsp;</h2>
                <h4 id="geoContext">&nbsp;</h3-->
                &nbsp;
            </div>

            <div class="col-md-4 mt-0 ml-auto mr-auto">
              <b>Info</b><br/>
              <div id="basicInfo">
                &nbsp;
              </div>
            </div>



        </div>

      <div class="row col-md-12">

        <!-- FIRST ROW-->
        <div class="btn-group" role="group" aria-label="Basic example">
          <button id="btnAll" type="button" class="btn btn-secondary">All</button>
          <button id="btnSameCountry" type="button" class="btn btn-secondary">Same country</button>
          <button id="btnDifferentCountry" type="button" class="btn btn-secondary">Different country</button>

          <button id="btnHigherGDPPS" type="button" class="btn btn-secondary">Higher GDP PPS</button>
          <button id="btnHigherGVA" type="button" class="btn btn-secondary">Higher GVA</button>

        </div>

      </div>
<a href="region.php?id=<?php echo $code;?>">See less...</a> 
      <!-- SECOND ROW-->
      <div class="row col-md-12">

        <div id="chartTop10Container" class="row col-md-6">
          <h3 class="title">Most similar</h3>
          <canvas id="chartTop10"></canvas>
        </div>
        <div id="chartBottom10Container" class="row col-md-6">
          <h3 class="title">Least similar</h3>
          <canvas id="chartBottom10"></canvas>
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
  <script>
    // $(document).ready(function() {
    //   //init DateTimePickers
    //   materialKit.initFormExtendedDatetimepickers();
    //
    //   // Sliders Init
    //   materialKit.initSliders();
    // });


    $(document).ready( function() {

      // $.ajaxSetup({
      //     async: false
      // });
      // $.getJSON("nuts.json", function(data){
      //     window.nuts = data;
      // }).fail(function(){
      //     console.log("An error has occurred.");
      // });


      //init DateTimePickers
       //materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      // materialKit.initSliders();
      $.getJSON( "nuts.php?code=<?php echo $code;?>", function( data ) {
        window.data = data;
        setBasicInfo();
        generateAll();
      });
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
  var data = window.data;

  $('#regionName').html(data['name']);
  $('#geoContext').html(wordCase(data['nuts2name'] + ", " + data['nuts1name'] + " (" + data['nuts0name'] + ")"));

  var basicInfo =  "NUTS3 code: " + data['code'];
  basicInfo = basicInfo + "<br/>Population: " + data['population'];
  basicInfo = basicInfo + "<br/>Population change: " + data['popchange'];
  basicInfo = basicInfo + "<br/>Density: " + data['density'] + " people/km2";


  percW = (100 * data['womenratio']) / (data['womenratio'] + 100);
  percW = Math.round(percW * 100) / 100 ;


  basicInfo = basicInfo + "<br/>Women Ratio: " + data['womenratio'] + " women per 100 men (" + percW +"%)";



  basicInfo = basicInfo + "<br/>Fertility: " + data['fertility'] + " live births per woman";
  basicInfo = basicInfo + "<br/>GDP per capita in PPS: " + data['gdppps'];
  basicInfo = basicInfo + "<br/>GVA: " + data['gva'] + " M€";


  $('#basicInfo').html(basicInfo);
}


function generateAll() {

  var data = window.data;

  tosort = $.map(data['similarity'], function(value, index) {
    var item = {index: index , value:value['similarity'], name:value['name'], country:value['country']};
    return item;
  });

  executeChartsForSelection(tosort);


}



function executeChartsForSelection(selection) {
  var similarity = selection;
  sorted = tosort.sort( function (a,b) { return b.value - a.value })
  var top10 = sorted.slice(0,2000);
  var bottom10 = sorted.slice(-2000).reverse();
  createchart(top10, 'chartTop10');
  createchart(bottom10, 'chartBottom10');
}

$('#btnAll').click(function() {

  var data = window.data;

  tosort = $.map(data['similarity'], function(value, index) {
    var item = {index: index , value:value['similarity'], name:value['name'], country:value['country']};
    return item;
  });

  executeChartsForSelection(tosort);


});

$('#btnSameCountry').click(function() {

  var data = window.data;
  tosort = $.map(data['similarity'], function(value, index) {
    if (value['country'] == data['nuts0']) {
      var item = {index: index , value:value['similarity'], name:value['name'], country:value['country']};
      return item;
    }
  });

  executeChartsForSelection(tosort);

});

$('#btnDifferentCountry').click(function() {

  var data = window.data;
  tosort = $.map(data['similarity'], function(value, index) {
    if (value['country'] != data['nuts0']) {
      var item = {index: index , value:value['similarity'], name:value['name'], country:value['country']};
      return item;
    }
  });

  executeChartsForSelection(tosort);

});

$('#btnHigherGDPPS').click(function() {

  // extract those with higher GDPPPS
  var myGDPPPS = window.data['gdppps'];
  var mycode = window.data['code'];

  var dbdata;
  $.ajaxSetup({
      async: false
  });
  $.getJSON("nuts-select.php?code="+ mycode +"&param=gdppps&val="+myGDPPPS, function(data){
      dbdata = data;
  }).fail(function(){
      console.log("An error has occurred.");
  });




  tosort = $.map(dbdata['similarity'], function(value, index) {

      var item = {index: index , value:value['similarity'], name:value['name'], country:value['country']};
      return item;

  });

  executeChartsForSelection(tosort);

});


$('#btnHigherGVA').click(function() {

  // extract those with higher GDPPPS
  var myGVA = window.data['gva'];
  var mycode = window.data['code'];

  var dbdata;
  $.ajaxSetup({
      async: false
  });
  $.getJSON("nuts-select.php?code="+ mycode +"&param=gva&val="+myGVA, function(data){
      dbdata = data;
  }).fail(function(){
      console.log("An error has occurred.");
  });




  tosort = $.map(dbdata['similarity'], function(value, index) {

      var item = {index: index , value:value['similarity'], name:value['name'], country:value['country']};
      return item;

  });

  executeChartsForSelection(tosort);

});

function createchart (dataArray, elementID) {

  $('#'+elementID).remove(); // this is my <canvas> element
  $('#'+elementID+'Container').append('<canvas id="' + elementID + '"></canvas>');


  var labels =   $.map(dataArray, function(item) {
    return item['name'] + ", " +item['country'];
  });
  var data =   $.map(dataArray, function(item) {
      return item['value'];
    });
    var indices =   $.map(dataArray, function(item) {
        return item['index'];
      });





  var canvas = document.getElementById(elementID);
  var ctx = document.getElementById(elementID).getContext('2d');
  canvas.height = 2000;

var myChart = new Chart(ctx, {
  type: 'horizontalBar',
  data: {
      labels: labels,
      indices: indices,
      datasets: [{
          label: 'similarity',
          data: data,
          borderWidth: 0
      }]
  },

  options: {
    responsive: true,
    legend: {
          display: false
       },
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true,
              }
          }],
          xAxes: [{
          ticks: {
              beginAtZero: true,
              max: 1,
              stepSize: 0.2
          }
      }],
    },

    tooltips: {
            callbacks: {
                label: function(tooltipItem, data) {


                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

                    if (label) {
                        label += ': ';
                    }
                    label += (tooltipItem.value * 100).toFixed(2); ;
                    label += '%';
                    return label;
                }
            }
        }

  }
});

canvas.onclick = function (e) {
  var helpers = Chart.helpers;

var eventPosition = helpers.getRelativePosition(e, myChart.chart);
var mouseX = eventPosition.x;
var mouseY = eventPosition.y;

var activePoints = [];
// loop through all the labels
//
// helpers.each(myChart.scale.ticks, function (label, index) {
//     for (var i = this.getValueCount() - 1; i >= 0; i--) {
//         // here we effectively get the bounding box for each label
//         var pointLabelPosition = this.getPointPosition(i, this.getDistanceFromCenterForValue(this.options.reverse ? this.min : this.max) + 5);
//
//         var pointLabelFontSize = helpers.getValueOrDefault(this.options.pointLabels.fontSize, Chart.defaults.global.defaultFontSize);
//         var pointLabeFontStyle = helpers.getValueOrDefault(this.options.pointLabels.fontStyle, Chart.defaults.global.defaultFontStyle);
//         var pointLabeFontFamily = helpers.getValueOrDefault(this.options.pointLabels.fontFamily, Chart.defaults.global.defaultFontFamily);
//         var pointLabeFont = helpers.fontString(pointLabelFontSize, pointLabeFontStyle, pointLabeFontFamily);
//         ctx.font = pointLabeFont;
//
//         var labelsCount = this.pointLabels.length,
//             halfLabelsCount = this.pointLabels.length / 2,
//             quarterLabelsCount = halfLabelsCount / 2,
//             upperHalf = (i < quarterLabelsCount || i > labelsCount - quarterLabelsCount),
//             exactQuarter = (i === quarterLabelsCount || i === labelsCount - quarterLabelsCount);
//         var width = ctx.measureText(this.pointLabels[i]).width;
//         var height = pointLabelFontSize;
//
//         var x, y;
//
//         if (i === 0 || i === halfLabelsCount)
//             x = pointLabelPosition.x - width / 2;
//         else if (i < halfLabelsCount)
//             x = pointLabelPosition.x;
//         else
//             x = pointLabelPosition.x - width;
//
//         if (exactQuarter)
//             y = pointLabelPosition.y - height / 2;
//         else if (upperHalf)
//             y = pointLabelPosition.y - height;
//         else
//             y = pointLabelPosition.y
//
//         // check if the click was within the bounding box
//         if ((mouseY >= y && mouseY <= y + height) && (mouseX >= x && mouseX <= x + width))
//             activePoints.push({ index: i, label: this.pointLabels[i] });
//     }
// }, myChart.scale);
//
// var firstPoint = activePoints[0];
// if (firstPoint !== undefined) {
//     alert(firstPoint.index + ': ' + firstPoint.label);
// }
}



canvas.onclick = function(evt) {
      var activePoints = myChart.getElementsAtEvent(evt);
      if (activePoints[0]) {
        var chartData = activePoints[0]['_chart'].config.data;
        var idx = activePoints[0]['_index'];

        var label = chartData.labels[idx];
        var value = chartData.indices[idx];
        // var value = chartData.datasets[0].data[idx];

        // url = "region.php?id=" + value;
        url = "compare.php?code1=<?php echo $code;?>&code2="+value;
        window.location = url;
      }
    };


}



  </script>
</body>

</html>
