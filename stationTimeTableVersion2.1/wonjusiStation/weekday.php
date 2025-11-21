<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>평일열차</title>
	<link rel="icon" type="image/x-icon" href="../media/favicon.png">
	<link rel="stylesheet" href="../index.css">
  <style>
  body
  {
    margin:0 ;
    padding: 0;
  }

  ul.main /*NavBar의 첫줄*/
	{
		list-style-type: none;
		margin: 0px;
		padding: 0px;
		background-color: mediumseagreen; /*대표요일색상*/
    display: flex; /*horizontal NavBar*/
    justify-content: center;
    font-size: 24px;
    position: fixed;
    top: 0px;
    width: 100%;
    height: 65px;
	}

  ul li
  {
    padding-top: 0px;
    padding-right: 0%;
    padding-bottom: 0px;
    padding-left: 0%;  
  }

  ul.sub /*NavBar의 부가설명줄*/
  {
    list-style-type: none;
    margin-top: 65px;
    margin-right:0px;
    margin-bottom: 0px;
    margin-left: 0px;
    padding: 0px;
    background-color: mediumaquamarine; /*요일색상보다 살짝연함*/
    font-size: 15px;
    overflow: hidden;
    position: fixed;
    top: 0px;
    width: 100%;
   
  }

  ul li.sub
  {
    float: center; /*horizontal NavBar의 변형*/
    padding-top: 5px;
    padding-right: 0%;
    padding-bottom: 5px;
    padding-left: 10px; 
  }

	ul li a 
	{
 
		display: block;
		color: white;
    
    padding-top: 15px;
    padding-right: 10px; /* navbar의 리스트간격을 표현*/
    padding-bottom: 15px;
    padding-left: 10px; /* navbar의 리스트간격을 표현*/
		text-decoration: none;
	}

  ul li a:hover:not(.active)
  {
    background-color: Green; /*요일색상보다 살짝진함*/
  }

  ul li a.active 
  {
    background-color: DarkViolet; /*활성화된 리스트, 고정색상*/
  }

  </style>
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
    <!--
    <input type="button" class="weekdayButton" onclick="document.location='indexWonjusi.php'" value="첫화면">
    <input type="button" class="weekdayButton" onclick="document.location='weekday.php?id=wonjuStation&file=weekdayWonju'" value="원주역">
    <input type="button" class="weekdayButton" onclick="document.location='weekday.php?id=manjongStation&file=weekdayManjong'" value="만종역">
    <input type="button" class="weekdayButton" onclick="document.location='weekday.php?id=seowonjuStation&file=weekdaySeowonju'" value="서원주역">
    -->
    <ul class="main">
      <li><a href="indexWonjusi.php">첫화면</a></li>
      <li><a class="<?php echo ($id == '원주역') ? 'active' : ' '; ?>" href="weekday.php?id=wonjuStation&file=weekdayWonju">원주역</a></li>
      <li><a class="<?php echo ($id == '만종역') ? 'active' : ' '; ?>" href="weekday.php?id=manjongStation&file=weekdayManjong">만종역</a></li>
      <li><a class="<?php echo ($id == '서원주역') ? 'active' : ' '; ?>" href="weekday.php?id=seowonjuStation&file=weekdaySeowonju">서원주역</a></li>
    </ul>
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
		?>  
    <ul class="sub">
      <li class="sub"><b>평일-월,화,수,목(<?php echo $id; ?>)</b></li>
      <li class="sub"><?php echo "오늘날짜 : " . date("y-m-j ") . "(" . $weekdays[$today] . ")" . "<br>";?></li>
      <li class="sub"><?php echo "현재시각 : " . date("H:i:s");?></li>
      <li class="sub" id="notice"></li>
    </ul>    
  <?php
    //echo file_get_contents("data/" . $file . ".txt");
    $handle = fopen("data/" . $file . ".txt", "r");
    If($handle) {
      while (($line = fgets($handle)) !== false) {
        echo $line;
      }
      fclose($handle);
    }
    else {
      echo "I can not open that file.";
    }
  ?>
  <?php
  date_default_timezone_set("Asia/Seoul");
  $now = date("Y-m-d_H");
  $counterFile = "log/visit_log_weekday.txt";
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