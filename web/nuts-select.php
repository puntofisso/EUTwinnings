<?php
// Select param from db where valiue is > than val passed
$code=$_GET['code'];
$param=$_GET['param'];
$val = $_GET['val'];

include('method.php');

$ret = array();

$name = "";
$paramval = "";


$method = "sqlite"; // or "mysql" or "sqlite"

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


$stm = $db->prepare("SELECT * FROM nuts WHERE (" . $param . " > ?) AND (" . $param . "!='') AND (code != ?)");
$res = $stm->execute(array($val, $code));
$data = $stm->fetchAll();


// List of codes
$ret['codes']  = array();

foreach ($data as $row) {
  $ret['codes'][] = $row['code'];
}

// var_dump($ret['codes']);

$similarity = json_decode(file_get_contents("data/$code.json"), true);
$ret['similarity'] = array();

// print similarity only of elements in list
foreach ($similarity as $areacode => $jsonobject) {
  if (in_array($areacode, $ret['codes'])) {
        $thissim = array();
          $thissim['similarity'] = $jsonobject['similarity'];
          $thissim['name'] = $jsonobject['name'];
          $thissim['country'] = $jsonobject['country'];
          $ret['similarity'][$areacode] = $thissim;

       }
     }



echo json_encode($ret, true);

?>
