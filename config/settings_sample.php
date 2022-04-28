<?php

// Constants for database connection
define('HOST', '...'); // Serveri nimi
define('USERNAME', '...'); // Kasutajanimi
define('PASSWORD', '...'); // Parool
define('DBNAME', '...'); // Andmebaasi fail

// Database connection
$dsn = 'mysql:host=' . HOST . ';dbname=' . DBNAME;
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Constants for openweathermap.org
define('APPKEY', '...);
define('PLACE', 'Kehtna, EE');
define('LONG', 24.868806);
define('LATT', 58.924888);

// West.php and East.php
// Times for table
define('TIME_FOR_TABLE', array("06:00", "07:00", "08:00", "09:00", "12:00", "13:00", "14:00", "15:00", "19:00", "20:00", "21:00", "22:00"));

// Alarm.php
// Sounds "Name (showing on website)" => "failname on folder 'sounds'"
define('ALARM_SOUNDS', array("Koer" => "dog.mp3", "Kass" => "kitty.mp3", "Lind" => "bird.mp3", "Hobune" => "horse.mp3", "Lammas" => "sheep.mp3"));

// Min and max time and step for alarm
define('ALARM_MIN', 5);
define('ALARM_MAX', 60);
define('ALARM_STEP', 5);

// Radiochannels list for radio.php (NB! max 4). "Channel name (showing on website)" => "online stations url"
define('RADIO_STATION', array(
    "RetroFM" => "https://skymedia-live.bitflip.ee/RETRO", "Vikerraadio" => "http://icecast.err.ee/vikerraadio.mp3",
    "Elmar" => "https://router.euddn.net/8103046e16b71d15d692b57c187875c7/elmar.mp3", "RockFM" => "https://skymedia-live.bitflip.ee/rck"
));
