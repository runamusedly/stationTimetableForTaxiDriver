<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관광열차</title>
  <link rel="icon" type="image/x-icon" href="media/favicon.png">
	<link rel="stylesheet" href="index.css">
</head>
<body>
   <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
      }
      else {
        $id = "noValue";
      }

      if (isset($_GET['file'])) {
        $file = $_GET['file'];
      }
      else {
        $file = "noValue";
      }  

      $wonju = array(
        'wonjuStation' => '원주역',
        'manjongStation' => '만종역',
        'seowonjuStation' => '서원주역',
        'noValue' => '값이 없음'
      );

      $id = $wonju[$id];
    ?>
    <input type="button" class="tourButton" onclick="document.location='indexWonjusi.php'" value="첫화면">
    <input type="button" class="tourButton" onclick="document.location='tour.php?id=wonjuStation&file=tourWonju'" value="원주역">
  
  <h1 style="text-align:center;">관광열차(장날(2,7,12,17,22,27), 주말(토,일))</h1>  
  <h2 style="text-align:center;"><?php echo $id; ?></h2>
  <?php 
			$weekdays = array(
				'Sunday' => '일요일',
				'Monday' => '월요일',
				'Tuesday' => '화요일',
				'Wednesday' => '수요일',
				'Thursday' => '목요일',
				'Friday' => '금요일',
				'Saturday' => '토요일'
			);
			$today = date("l");
			date_default_timezone_set("Asia/Seoul");
			echo "오늘날짜 : " . date("y-m-j ") . "(" . $weekdays[$today] . ")" . "<br>";
			echo "현재시각 : " . date("H:i:s"); 
		?>
  <p id="notice"></p>
  <?php
    echo file_get_contents("data/". $file .".txt");
  ?>
  <?php
  date_default_timezone_set("Asia/Seoul");
  $now = date("Y-m-d_H");
  $counterFile = "log/visit_log_tour.txt";
  $fp = fopen($counterFile, "c+");
  
  if (flock($fp, LOCK_EX)) 
  {
    $lines = [];
    while (!feof($fp)) 
    {
      $line = fgets($fp);
      if (trim($line) !== "") 
      {
        $lines[] = trim($line);
      }
    }
    $visits = [];
    foreach ($lines as $line)
    {
      list($timekey, $count) = explode(":", $line);
      $visits[$timekey] = (int)$count;
    }
    if (isset($visits[$now])) 
    {
       $visits[$now]++;
    } 
    else
    {
      $visits[$now] = 1;
    }
    ftruncate($fp, 0);
    rewind($fp);
    foreach ($visits as $timekey => $count)
    {
      fwrite($fp, $timekey . ":" . $count . "\n");
    }
    flock($fp, LOCK_UN);
    fclose($fp);  
  }
  else
  {
    echo "File lock fail!";
    fclose($fp);
  }  
?>
  <script src="stationScript.js"></script>
</body>
</html>