<!DOCTYPE html>
<html lnang="ko">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>열차시간표</title>
    <link rel="icon" type="image/x-icon" href="./media/favicon.png">
    <link rel="stylesheet" href="./index.css">

  </head>
  <body style="background-color: black;">
    <h1 style="text-align:center; font-size:40px; color: azure;">지역별 열차</h1>
    <input type="button" class="indexWonjusiButton" onclick="document.location='./wonjusiStation/indexWonjusi.php'" value="원주시">
    <?php
  date_default_timezone_set("Asia/Seoul");
  $now = date("Y-m-d_H");
  $counterFile = "./log/visit_log_index.txt";
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
  </body>
</html>  