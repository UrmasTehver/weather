<?php
$page = 'home';
$note_error = '';

require 'config/settings.php';
require 'config/common.php';
require 'templates/header.php';


# Last record on table west
try {
    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8');
    $sql = 'SELECT * FROM `ilm_ds18_out_west` ORDER BY added DESC LIMIT 1';
    $statement = $connection->prepare($sql);
    $statement->execute();
    $west = $statement->fetch(PDO::FETCH_ASSOC);
    $westtemp = round($west['celsius'], 1);
    $westtime = dbDateToEstDateClock($west['added']);
    // show($west); # Testiks
} catch (PDOException $error) {
    $note_error = 'Viga andmebaasist lugemisel: <br /> ' . ($error->getMessage());
}

#  Last record on table east
try {
    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8');
    $sql = 'SELECT * FROM `ilm_ds18_out_east` ORDER BY added DESC LIMIT 1';
    $statement = $connection->prepare($sql);
    $statement->execute();
    $east = $statement->fetch(PDO::FETCH_ASSOC);
    $easttemp = round($east['celsius'], 1);
    $easttime = dbDateToEstDateClock($east['added']);
    // show($east); # Testiks
} catch (PDOException $error) {
    $note_error = 'Viga andmebaasist lugemisel: <br /> ' . ($error->getMessage());
}
?>

<!-- Show last saved temperature, sunrise and sunset time on website -->
<div class="row justify-content-center mt-2">

    <?php if ($note_error != '') { ?>
        <h3 class="text-danger text-center"><?php echo $note_error ?></h3>
    <?php } else { ?>

        <div class="col-auto m-2">
            <span class="count-text">Läänes</span></br>
            <span class="count-digit"><?php echo ($westtemp); ?> &degC</span>
            <p class="fw-bold text-secondary mt-2">Viimane mõõtmine: <?php echo ($westtime); ?></p>
            <img class="image mt-4" src="img/sunrise.png" alt="sunrise" style="width:100px;">
            <p class="sunrise fw-bold text-secondary mt-2"></p>
        </div>

        <div class="col-auto m-2">
            <span class="count-text">Idas</span></br>
            <span class="count-digit"><?php echo ($easttemp); ?> &degC</span>
            <p class="fw-bold text-secondary mt-2">Viimane mõõtmine: <?php echo ($easttime); ?></p>
            <img class="image mt-4" src="img/sunset.png" alt="sunset" style="width:100px;">
            <p class="sunset fw-bold text-secondary mt-2"></p>
        </div>

    <?php } ?>

</div>

<script>
    // Constants for openweathermap.org api
    const apikey = "<?php echo (APPKEY); ?>";
    const long = parseFloat(<?php echo (LONG); ?>);
    const latt = parseFloat(<?php echo (LATT); ?>);
    // console.log(apikey, long, latt);


    // Fetching current weather data from openweathermap.org
    var weather = {
        fetchWeather: function() {
            fetch(
                    "https://api.openweathermap.org/data/2.5/weather?lat=" + latt + "&lon=" + long + "&units=metric&appid=" + apikey
                )
                .then((response) => {
                    if (!response.ok) {
                        alert("No weather found.");
                        throw new Error("No weather found.");
                    }
                    return response.json();
                })
                .then((data) => this.displayWeather(data));
        },

        // Display current weather data
        displayWeather: function(data) {
            const {
                sunrise
            } = data.sys;
            const {
                sunset
            } = data.sys;

            var sunrisetime = sunrise;
            var date = new Date(sunrisetime * 1000);
            var sunriseHourMin = date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });

            var sunsettime = sunset;
            var date = new Date(sunsettime * 1000);
            var sunsetHourMin = date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });

            document.querySelector(".sunrise").innerText = "Päike tõuseb täna: " + sunriseHourMin;
            document.querySelector(".sunset").innerText = "Päike loojub täna: " + sunsetHourMin;

        },
    };

    weather.fetchWeather();
</script>

<?php
require 'templates/footer.php';
