<?php
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
</head>

<body class="index-page sidebar-collapse">

  <?php
  include ('nav.php');
  ?>

  <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" style="background-image: url('./assets/img/eubg2.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1>EU Twinnings</h1>
            <h3>Discover similar <span data-toggle="modal" data-target="#exampleModal"><i class="fa fa-question-circle"></i></span> areas in the EU </h3>
          </div>

          <div class="container">
            <form>
              <div class="form-group">
                <!--label for="exampleInputEmail1">NUTS 3</label-->
                <input type="text" class="form-control" id="inputRegion2" aria-describedby="emailHelp" placeholder="Enter NUTS 3 name (e.g. Berlin or Northumberland)">
                <small id="emailHelp" class="form-text text-muted">Start typing and enter at least 3 characters... </small>
              </div>

            </form>

          </div>

        </div>
      </div>
    </div>
  </div>






  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Similarity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>The similarity between areas is calculated using the formula known as <a href="https://en.wikipedia.org/wiki/Cosine_similarity">cosine similarity</a> over a number of selected Eurostat statistics at either the NUTS3 area level, or at the level of one of its containers.</p>
          <p>The list of fields on which we currently calculate similarity is: population of the NUTS3 area, population of the containing NUTS0 area, population density, fertility rate, population change since the last census, ratio of women to men, GDP per PPS, and GVA.</p>
          <p>Although every similarity measure is, to a certain extent, arbitrary, we believe that this choice gives some food for thought.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
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


      $.ajaxSetup({
          async: false
      });
      $.getJSON("nuts.json", function(data){
          window.nuts = data;
      }).fail(function(){
          console.log("An error has occurred.");
      });
      $.ajaxSetup({
          async: true
      });

      var names = [ "Jörn Zaefferer", "Scott González", "John Resig" ];
      var nuts = window.nuts

      var accentMap = {
        "á": "a",
        "ö": "o",
        "á": "a"
      };

      var normalize = function( term ) {
        var ret = "";
        for ( var i = 0; i < term.length; i++ ) {
          ret += accentMap[ term.charAt(i) ] || term.charAt(i);
        }
        return ret;
      };

      // other init by gs
      $('#inputRegion2').click(function() {
            $(this).val('');
        });

      $( "#inputRegion2" ).autocomplete({

        minLength: 3,
        width: 300,
        max: 10,
        source: function( request, response ) {

          var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i") , results = [];

          /* Make sure each entry is only in the suggestions list once: */
          $.each(nuts, function (i, value) {
              if (matcher.test(value.label) && $.inArray(value.label, results) < 0) {

                  // TODO: note that the below isn't very well documented;
                  // it looks like both label and value need to be the value of the label (confusingly...)
                  // obj = { 'label': value.label, 'object': value }
                  obj = { 'label': value.label, 'code': value.code }
                  results.push(obj);

              }
          });
          response(results);

        },
        select: function (event, ui) {
          //event.preventDefault()
            regionID = ui.item.code;
            window.location.href = "region.php?id="+regionID;
            //$("#inputRegion").val(ui.item.label); // display the selected text
            //var array = ui.item.value;
            //alert(array)
            // $("#txtAllowSearchID").val(ui.item.value); // save selected id to hidden input
        }
      }


    );


});



  </script>
</body>

</html>
