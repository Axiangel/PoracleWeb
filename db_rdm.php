<?php

function get_quest_mons() {

   include "./config.php";

   $conn = new mysqli($scan_dbhost.":".$scan_dbport, $scan_dbuser, $scan_dbpass, $scan_dbname);
   $sql = "SELECT distinct quest_pokemon_id id FROM pokestop WHERE quest_pokemon_id > 0 AND quest_reward_type = 7 order by quest_pokemon_id;";
   $result = $conn->query($sql);

   $mons=array();
   while($row = $result->fetch_assoc()) { 
      array_push($mons, $row['id']); 
   }

   if (isset($additional_quest_mons) && !empty($additional_quest_mons)) {
      $add_mons = explode(",", $additional_quest_mons);
      foreach ($add_mons as &$mon) {
           array_push($mons, $mon);
      }
   }

   $mons=array_unique($mons);
   sort($mons);
   return $mons; 

}

function get_quest_items() {

   include "./config.php";

   $conn = new mysqli($scan_dbhost.":".$scan_dbport, $scan_dbuser, $scan_dbpass, $scan_dbname);
   $sql = "SELECT distinct quest_item_id id FROM pokestop WHERE quest_item_id > 0 order by quest_item_id;";
   $result = $conn->query($sql);

   $items=array();
   while($row = $result->fetch_assoc()) {
      array_push($items, $row['id']);
   }

   return $items;

}

function get_quest_energy() {

   include "./config.php";

   $conn = new mysqli($scan_dbhost.":".$scan_dbport, $scan_dbuser, $scan_dbpass, $scan_dbname);
   $sql = "SELECT distinct json_extract(json_extract(`quest_rewards`,'$[*].info.pokemon_id'),'$[0]') AS quest_energy_pokemon_id
           FROM pokestop WHERE quest_reward_type = 12;";
   $result = $conn->query($sql);

   $mons=array();
   while($row = $result->fetch_assoc()) {
      array_push($mons, $row['id']);
   }

   return $mons;

}

function get_raid_bosses() {

   include "./config.php";

   $conn = new mysqli($scan_dbhost.":".$scan_dbport, $scan_dbuser, $scan_dbpass, $scan_dbname);
   $sql = "SELECT raid_level, raid_pokemon_id, raid_pokemon_form, raid_pokemon_evolution, raid_pokemon_costume FROM gym
           WHERE raid_pokemon_id <> 0 AND raid_end_timestamp > UNIX_TIMESTAMP(DATE_SUB(now(), INTERVAL 1 DAY))
           GROUP BY raid_level, raid_pokemon_id, raid_pokemon_form, raid_pokemon_evolution, raid_pokemon_costume ORDER BY raid_level, raid_pokemon_id;";
   $result = $conn->query($sql);

   $bosses=array();
   while($row = $result->fetch_assoc()) {
      $pokemon_id=str_pad($row['raid_pokemon_id'], 3, "0", STR_PAD_LEFT);;
      $form=str_pad($row['raid_pokemon_form'], 2, "0", STR_PAD_LEFT);
      $costume=$row['raid_pokemon_costume'];
      $evolution=$row['raid_pokemon_evolution'];
      if ( $evolution <> '0' ) { $boss = $pokemon_id."_".$form."_".$evolution; }
      else { $boss = $pokemon_id."_".$form."_".$costume; }
      array_push($bosses, $boss);
   }

   return $bosses;

}

