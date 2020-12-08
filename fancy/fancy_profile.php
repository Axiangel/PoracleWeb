<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>POracle Configurator</title>
  <link rel="icon" type="image/x-icon" href="favicon.png"/>
  <link rel="stylesheet" type="text/css" href="css/style.css?v=<?=time();?>">
  <link rel="stylesheet" type="text/css" href="css/add_style.css?v=<?=time();?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</head>
<body style="background-color:#FFFFFF; color: grey;">


<?php

$sql = "select area, latitude, longitude, enabled from humans WHERE id = '".$_SESSION['id']."'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
        $area=$row['area'];
        $latitude=$row['latitude'];
        $longitude=$row['longitude'];
        $enabled=$row['enabled'];
}

// Add Hidden Fancy Profile

echo " <div style='display: none;' id='profile'>";

  echo "<center>";
  echo "<p><b><font color='darkblue' size=4>Welcome ".$_SESSION['username']."</font></b></p>";
  $avatar = "https://cdn.discordapp.com/avatars/".$_SESSION['id']. "/".$_SESSION['avatar'].".png";
  echo "<img src='$avatar' style='border-radius: 50%; width:50px;'><br><br>";


  // Add Button to enable/disable Alarms

  echo "<table><tr>";
  echo "<td>$enabled_color</td>";
  echo "<td>Alarms</td>";
  echo "<td>";
  if ( $enabled == "1") {
    echo "<a href='./form_action.php?action=disable'><button class='button_disable'>Disable</button></a><br>";
  } else {
    echo "<a href='./form_action.php?action=enable'><button class='button_enable'>Enable</button></a><br>";
  }
  echo "</td>";
  echo "</tr><tr>";
  echo "<td>$all_mon_cleaned_color</td>";
  echo "<td>";
  echo "<div class='tooltip'><i class='fa fa-question-circle' style='color:darkgreen;'></i><span class='tooltiptext'>".$tt_clean_pkmn."</span></div>&nbsp;";
  echo "All Monsters Cleaning";
  echo "</td>";
  echo "<td>";
  if ( $all_mon_cleaned == "1") {
    echo "<a href='./form_action.php?action=disable_mon_clean' onclick='return confirm_mon_cleaning();'><button class='button_disable'>Disable</button></a><br>";
  } else {
    echo "<a href='./form_action.php?action=enable_mon_clean'><button class='button_enable'>Enable</button></a><br>";
  }
  echo "</td>";
  echo "</tr><tr>";
  echo "<td>$all_raid_cleaned_color</td>";
  echo "<td>";
  echo "<div class='tooltip'><i class='fa fa-question-circle' style='color:darkgreen;'></i><span class='tooltiptext'>".$tt_clean_raid."</span></div>&nbsp;";
  echo "All Raids/Eggs Cleaning";
  echo "</td>";
  echo "<td>";
  if ( $all_raid_cleaned == "1") {
    echo "<a href='./form_action.php?action=disable_raid_clean' onclick='return confirm_raid_cleaning();'><button class='button_disable'>Disable</button></a><br>";
  } else {
    echo "<a href='./form_action.php?action=enable_raid_clean'><button class='button_enable'>Enable</button></a><br>";
  }
  echo "</td>";
  echo "</tr><tr>";
  echo "</tr></table>";

  if ( $latitude == "0.0000000000" && $longitude == "0.0000000000" ) {
          echo "<font color='darkred'><b>Your Location is not set and cannot be set here.<br>";
          echo "Please set it in discord using <code>/location</code> command</font></b><br><br>";
  } else if ( isset($mapURL) && $mapURL <> ""  ) {
          echo "<br>Your Location is set to ".round($latitude,4).", ".round($longitude,4)."<br><br>";
          $mapURL=str_replace('#LAT#', $latitude, $mapURL);
          $mapURL=str_replace('#LON#', $longitude, $mapURL);
          echo "<img src='$mapURL' width=300><br><br>";
  }
  echo "</center>";

echo "</div>";

?>