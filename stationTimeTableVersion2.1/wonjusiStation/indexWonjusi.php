<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>원주열차시간표</title>
	<link rel="icon" type="image/x-icon" href="../media/favicon.png">
	<link rel="stylesheet" href="../index.css">
  <style>
    ul 
    {
      list-style-type: square;
      margin: 1px 20px;
      padding: 1px 1px;
    }

    a:link {
		color: dodgerblue;
		text-decoration: underline;
	  }
	  a:visited {
		color: dodgerblue;
		text-decoration: underline;
	  }
	  a:active {
		color: red;
		text-decoration: underline;
	  }
  </style>
</head>
<body>
  <h1 style="text-align:center; font-size:40px;">원주시 열차 시간표</h1>
  
    <!--상세페이지의 기본값을 원주역으로 설정-->
    <input type="button" class="indexWeekdayButton" onclick="document.location='weekday.php?id=wonjuStation&file=weekdayWonju'" value="평일(월,화,수,목)">
    <input type="button" class="indexFridayButton" onclick="document.location='friday.php?id=wonjuStation&file=fridayWonju'" value="금요일">
    <input type="button" class="indexWeekendButton" onclick="document.location='weekend.php?id=wonjuStation&file=weekendWonju'" value="주말(토,일)">
    <input type="button" class="indexTourButton" onclick="document.location='tour.php?id=wonjuStation&file=tourWonju'" value="관광열차(장날,주말)">
		<br>
    <br>
    
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
	<div>
	<ul>
		<li>평일은 녹색, 금요일은 파란색, 주말은 적색, 관광열차는 노란색 계열로 스타일 했습니다.</li>
		<li>관광열차는 2,7,12,17,22,27(장날) 및 토,일요일에 운행합니다. 주말에 운행하는 관광열차에 대한 정보는 위의 주말버튼 안에 통합되어 있으나, 평일 및 금요일에 해당되는 장날운행 건에 대해서는 해당버튼에 표시되지 않았습니다. 관광열차버튼에서 따로 정보를 확인할 수 있습니다.</li>
		<li>모바일 환경의 엣지,크롬 앱에서 보시는 것을 추천합니다.</li>
		<li>문의 및 건의 사항이 있을 경우에는 아래의 이메일 주소로 메시지를 남겨주세요.</li>
	</ul>
	</div>
	<input type="button" class="lightButton" onclick="lightmode()" value="밝음모드">
	<input type="button" class="darkButton" onclick="darkmode()" value="다크모드">
	<input type="button" class="indexNoteButton" onclick="document.location='note.php?file=note'" value="노트">
	<address>
	<a href="mailto:runamusedly@outlook.com">runamusedly@outlook</a><br>
	</address>
  <br>
  <input type="button" class="indexMainButton" onclick="document.location='../index.php'" value="Main">
	<?php
  date_default_timezone_set("Asia/Seoul");
  $now = date("Y-m-d_H");
  $counterFile = "log/visit_log_indexWonjusi.txt";
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