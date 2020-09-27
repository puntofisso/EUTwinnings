<?php
$code=$_GET['code'];

include('method.php');

$ret = array();

$name = "";

$nuts0 = "";
$nuts1 = "";
$nuts2 = "";
$pop3 = "";

$nuts0name = "";
$nuts1name = "";
$nuts2name = "";

$density = "";
$fertility = "";
$popchange = "";
$womenratio = "";
$gdppps = "";
$gva = "";





$db = null;
if ($method == "sqlite") {
  // SQLITE
  //$db = new SQLite3('data/nuts.db');

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


$stm = $db->prepare("SELECT * FROM nuts WHERE code = ?");
$res = $stm->execute(array($code));
$data = $stm->fetchAll();

foreach ($data as $row) {

  $name = $row['name'];
  $nuts0 = $row['nuts0'];
  $nuts1 = $row['nuts1'];
  $nuts2 = $row['nuts2'];
  $pop3 = $row['pop3'];

  $density = $row['density'];
  $fertility = $row['fertility'];
  $popchange = $row['popchange'];
  $womenratio = $row['womenratio'];
  $gdppps = $row['gdppps'];
  $gva = $row['gva'];

}

// Find nuts0 name
$stm = $db->prepare("SELECT * FROM relations WHERE code = ?");
// $stm->bindParam(1, $nuts0, SQLITE3_TEXT) ;
$res = $stm->execute(array($nuts0));
$data = $stm->fetchAll();
foreach ($data as $row) {
  $nuts0name = $row['name'];
}

// Find nuts1 name
$stm = $db->prepare("SELECT * FROM relations WHERE code = ?");
// $stm->bindParam(1, $nuts1, SQLITE3_TEXT) ;
$res = $stm->execute(array($nuts1));
$data = $stm->fetchAll();
foreach ($data as $row) {
  $nuts1name = $row['name'];
}

// Find nuts2 name
$stm = $db->prepare("SELECT * FROM relations WHERE code = ?");
// $stm->bindParam(1, $nuts2, SQLITE3_TEXT) ;
$res = $stm->execute(array($nuts2));
$data = $stm->fetchAll();
foreach ($data as $row) {
  $nuts2name = $row['name'];
}

$ret['code'] = $code;
$ret['name'] = $name;
$ret['nuts0'] = $nuts0;
$ret['nuts0name'] = $nuts0name;
$ret['nuts1'] = $nuts1;
$ret['nuts1name'] = $nuts1name;
$ret['nuts2'] = $nuts2;
$ret['nuts2name'] = $nuts2name;
$ret['population'] = $pop3;

$ret['density'] = $density;
$ret['fertility'] = $fertility;
$ret['popchange'] = $popchange;
$ret['womenratio'] = $womenratio;
$ret['gdppps'] = $gdppps;
$ret['gva'] = $gva;

// $similarity = json_decode(file_get_contents("data/$code.json"), true);
// $ret['similarity'] = $similarity;

// Find similarity
$stm = $db->prepare("SELECT s.code2, s.similarity as similarity, n.name as name, n.nuts0 as country FROM similarity s JOIN nuts n WHERE s.code2 = n.code and s.code1 = ?  AND n.name !='' ");
//$stm->bindParam(1, $code, SQLITE3_TEXT) ;
$res = $stm->execute(array($code));

$ret['similarity'] = $array;
$data = $stm->fetchAll();

foreach ($data as $row) {
  $code2 = $row['code2'];
  $name = $row['name'];
  $country = $row['country'];
  $similarity = $row['similarity'];

  $ret['similarity'][$code2]= array();
  $ret['similarity'][$code2]['name'] = $name;
  $ret['similarity'][$code2]['country'] = $country;
  $ret['similarity'][$code2]['similarity'] = $similarity;
}



echo json_encode($ret, true);

?>
