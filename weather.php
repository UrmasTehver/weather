<?php
$page = 'weather';

require 'config/settings.php';
require 'templates/header.php';
?>

<!-- Current weather -->
<div class="row justify-content-center mt-2">
    <h2 class="header text-secondary text-center mt-2">Ilm Kehtnas</h2>
    <div class="col-auto mr-2">
        <div class="flex">
            <img src="" alt="" class="icon text-center " />
            <p class="description text-center ">Pilvisus: ...</p>
        </div>
        <div>
            <p style="float: left;"><img class="image mt-2" src="img/sunrise.png" alt="sunrise" style="width:50px;"></p>
            <p style="float: right;"><img class="image mt-2" src="img/sunset.png" alt="sunrise" style="width:50px;"></p>
        </div>
        <div style="clear: left;">
            <p style="float: left;" class="sunrise m-2">Päikesetõus</p>
            <p style="float: right;" class="sunset m-2">Päikeseloojang</p>
        </div>
    </div>
    <div class="col-auto m-2">
        <h1 class="temp text-secondary mt-2">...°C</h1>
        </br>
        <div class="feels">Tajutav temperatuur: ...</div>
        <div class="pressure mt-2">Õhurõhk: ... hPa</div>
        <div class="humidity mt-2">Õhuniiskus: ...%</div>
        <div class="wind_deg mt-2">Tuule suund: ...°</div>
        <div class="wind_speed mt-2">Tuule kiirus: ... km/h</div>
    </div>
</div>

<!-- Next 24h weather forecast-->
<div class="row justify-content-center mt-2">
    <h2 class="text-secondary text-center mt-2">Järgmise 24 tunni prognoos</h2>
    <div class="col-auto m-2">
        <table class="table is-fullwidth is-hoverable is-bordered">
            <thead class="text-secondary has-text-centered">
                <tr>
                    <th>Kell</th>
                    <th>Temperatuur</th>
                    <th>Maks temp</th>
                    <th>Min temp</th>
                    <th>Õhurõhk</th>
                    <th>Õhuniiskus</th>
                    <th></th>
                    <th>Pilvisus</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <tr>
                        <td class="fc_time<?php echo $i ?>" style="vertical-align: middle;"> HH:MM </td>
                        <td class="fc_temp<?php echo $i ?>" style="text-align: center; vertical-align: middle;"> ...°</td>
                        <td class="fc_maxtemp<?php echo $i ?>" style="text-align: center; vertical-align: middle;"> ...° </td>
                        <td class="fc_mintemp<?php echo $i ?>" style="text-align: center; vertical-align: middle;"> ...° </td>
                        <td class="fc_pressure<?php echo $i ?>" style="text-align: center; vertical-align: middle;"> ... hPa </td>
                        <td class="fc_humidity<?php echo $i ?>" style="text-align: center; vertical-align: middle;"> ...% </td>
                        <td><img src="" alt="" class="fc_icon<?php echo $i ?> text-center " /></td>
                        <td class="fc_clouds<?php echo $i ?>" style="text-align: center; vertical-align: middle;"> Pilvisus </td>


                    <?php  } ?>
                    <script>
                        // Display weather forecast data 
                        function displayForecast(data) {
                            //console.log(data)
                            for (var i = 0; i < 8; i++) {
                                var {
                                    dt
                                } = data.list[i];
                                var {
                                    temp
                                } = data.list[i].main;
                                var {
                                    temp_max
                                } = data.list[i].main;
                                var {
                                    temp_min
                                } = data.list[i].main;
                                var {
                                    pressure
                                } = data.list[i].main;
                                var {
                                    humidity
                                } = data.list[i].main;
                                const {
                                    icon
                                } = data.list[i].weather[0];
                                const {
                                    main,
                                    description
                                } = data.list[i].weather[0];

                                var time = dt;
                                var date = new Date(time * 1000);
                                time = date.toLocaleTimeString([], {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: false
                                });
                                time = time.substring(0, 5);

                                document.querySelector(".fc_time" + i).innerText = time;
                                document.querySelector(".fc_temp" + i).innerText = temp + " °C";;
                                document.querySelector(".fc_maxtemp" + i).innerText = temp_max + " °C";;
                                document.querySelector(".fc_mintemp" + i).innerText = temp_min + " °C";;
                                document.querySelector(".fc_pressure" + i).innerText = pressure + " hPa";
                                document.querySelector(".fc_humidity" + i).innerText = humidity + "%";
                                document.querySelector(".fc_icon" + i).src = "https://openweathermap.org/img/wn/" + icon + ".png";
                                document.querySelector(".fc_clouds" + i).innerText = main + " / " + description;;
                            }
                        };
                    </script>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Constants for openweathermap.org api
    const apikey = "<?php echo (APPKEY); ?>";
    const long = parseFloat(<?php echo (LONG); ?>);
    const latt = parseFloat(<?php echo (LATT); ?>);
    // console.log(apikey, long, latt);

    // Fetching current weather data from openweathermap.org
    var currentWeather = {
        fetchCurrentWeather: function() {
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
            // console.log(data);

            const {
                name
            } = data;
            const {
                dt
            } = data;
            const {
                temp
            } = data.main;
            const {
                feels_like
            } = data.main;
            const {
                icon,
                main,
                description
            } = data.weather[0];
            const {
                pressure
            } = data.main;
            const {
                humidity
            } = data.main;
            const {
                deg
            } = data.wind;
            const {
                speed
            } = data.wind;
            const {
                sunrise
            } = data.sys;
            const {
                sunset
            } = data.sys;

            var currentTime = dt;
            var date = new Date(currentTime * 1000);
            currentTime = date.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });

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

            document.querySelector(".header").innerText = "Ilm asukohas: " + name + " täna kell: " + currentTime;
            document.querySelector(".temp").innerText = temp + " °C";
            document.querySelector(".feels").innerText = "Tajutav temperatuur " + feels_like + " °C";
            document.querySelector(".icon").src = "https://openweathermap.org/img/wn/" + icon + "@2x.png";
            document.querySelector(".description").innerText = main + " / " + description;
            document.querySelector(".pressure").innerText = "Õhurõhk: " + pressure + " hPa";
            document.querySelector(".humidity").innerText = "Õhuniiskus: " + humidity + "%";
            document.querySelector(".wind_deg").innerText = "Tuule suund: " + deg + "°";
            document.querySelector(".wind_speed").innerText = "Tuule kiirus: " + speed + " km/h";
            document.querySelector(".sunrise").innerText = sunriseHourMin;
            document.querySelector(".sunset").innerText = sunsetHourMin;
        },
    };

    // Fetching weather forecast data from openweathermap.org
    var weatherForecast = {
        fetchWeatherForecast: function() {
            fetch(
                    "https://api.openweathermap.org/data/2.5/forecast?lat=" + latt + "&lon=" + long + "&units=metric&appid=" + apikey
                )
                .then((response) => {
                    if (!response.ok) {
                        alert("No weather found.");
                        throw new Error("No weather found.");
                    }
                    return response.json();
                })
                .then((data) => displayForecast(data));
        },
    };

    currentWeather.fetchCurrentWeather();
    weatherForecast.fetchWeatherForecast();
</script>

<?php
require 'templates/footer.php';
