<?php
$page = 'alarm';
$status = '';

require 'config/settings.php';
require 'templates/header.php';

?>

<!-- Alarm settings: time to countdown, alarm sound -->

<div class="row justify-content-center mt-2">
  <h2 class="fw-bold text-secondary text-center mt-2">Seadista äratus</h2>
  <div class="col-auto m-2">
    <form name="alarm_time">
      <div class="form-group">
        <select name="alarm_time" class="selectpicker form-select" id="alarm_time">
          <option value="0">Vali aeg</option>
          <?php for ($i = ALARM_MIN; $i <= ALARM_MAX; $i = $i + ALARM_STEP) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?> minutit</option>
          <?php } ?>
        </select>
      </div>
    </form>
  </div>

  <div class="col-auto m-2">
    <form name="alarm_sound">
      <div class="form-group">
        <select name="alarm_sound" class="selectpicker form-select" id="alarm_sound">
          <option value="0">Vali heli</option>
          <?php foreach (ALARM_SOUNDS as $x => $val) { ?>
            <option value="<?php echo $val; ?>"><?php echo $x; ?></option>
          <?php } ?>
        </select>
      </div>
    </form>
  </div>
</div>

<!-- Buttons for start, stop and reset alarm -->

<div class="row justify-content-center mt-2">

  <div class="col-auto m-2">
    <div class="container">
      <button id="stop-timer" class="m-2">
        <img src="https://img.icons8.com/ios-glyphs/30/000000/pause--v1.png" />
      </button>
      <button id="start-timer" class="m-2" <?php if ($status == 'disabled') {
                                              echo 'disabled';
                                            }; ?>>
        <img src="https://img.icons8.com/ios-glyphs/30/000000/play--v1.png" />
      </button>
      <button id="reset-timer" class="m-2">
        <img src="https://img.icons8.com/ios-glyphs/30/000000/stop.png" />
      </button>
    </div>
  </div>

  <audio id="alarm_audio"></audio>

</div>

<div class="row justify-content-center mt-2">

  <div class="col-auto m-2">
    <span class="count-digit">0</span>
    <span class="count-digit">0</span>
    <span class="separator">:</span>
    <span class="count-digit">0</span>
    <span class="count-digit">0</span>
  </div>

</div>

  <script>
    // Select Every Count Container
    const countContainer = document.querySelectorAll(".count-digit");

    // Select option buttons
    const startAction = document.getElementById("start-timer");
    const stopAction = document.getElementById("stop-timer");
    const resetAction = document.getElementById("reset-timer");

    // Select HTML5 Audio element
    const timeoutAudio = document.getElementById("alarm_audio");

    // Default inital value of timer
    const defaultValue = 0;

    // variable to the time
    var countDownTime;
    var choisedTime = document.getElementById('alarm_time');
    choisedTime.addEventListener('change', function() {
      return countDownTime = (this.value) * 60;
    }, false);

    // variable to the sound
    const soundDir = "sounds/"
    var alarmSound = "";
    alarmSound = document.getElementById('alarm_sound');
    alarmSound.addEventListener('change', (e) => {
      alarmSound = e.target.value;
      alarmSound = soundDir.concat(alarmSound);
      console.log(alarmSound);
    });

    // variable to store time interval
    var timerID;

    // Variable to track whether timer is running or not
    var isStopped = true;

    // Function calculate time string
    const findTimeString = () => {
      var minutes = String(Math.trunc(countDownTime / 60));
      var seconds = String(countDownTime % 60);
      if (minutes.length === 1) {
        minutes = "0" + minutes;
      }
      if (seconds.length === 1) {
        seconds = "0" + seconds;
      }
      return minutes + seconds;
    };

    // Function to start Countdown
    const startTimer = () => {
      if (countDownTime > 0) {
        if (isStopped) {
          isStopped = false;
          timerID = setInterval(runCountDown, 500);
          document.getElementById("alarm_time").disabled = true;
          document.getElementById("alarm_sound").disabled = true;
        }
      }
    };

    // Function to stop Countdown
    const stopTimer = () => {
      isStopped = true;
      if (timerID) {
        clearInterval(timerID);
      }
    };

    // Function to reset Countdown
    const resetTimer = () => {
      stopTimer();
      countDownTime = defaultValue;
      renderTime();
      document.getElementById("alarm_time").disabled = false;
      document.getElementById("alarm_time").value = 0;
      document.getElementById("alarm_sound").disabled = false;
      document.getElementById("alarm_sound").value = 0;
    };

    // Attach onclick event to buttons
    startAction.onclick = startTimer;
    resetAction.onclick = resetTimer;
    stopAction.onclick = stopTimer;

    // Function to display coundown on screen
    const renderTime = () => {
      const time = findTimeString();
      countContainer.forEach((count, index) => {
        count.innerHTML = time.charAt(index);
      });
    };

    // function to execute timer
    const runCountDown = () => {
      // decement time
      countDownTime -= 1;
      //Display updated time
      renderTime();

      // timeout on zero
      if (countDownTime === 0) {
        stopTimer();
        // Play alarm on timeout
        var sound = new Audio(alarmSound);
        sound.play();
        countDownTime = defaultValue;
        document.getElementById("alarm_time").disabled = false;
        document.getElementById("alarm_time").value = 0;
        document.getElementById("alarm_sound").disabled = false;
        document.getElementById("alarm_sound").value = 0;
      }
    };
  </script>

  <?php
  require 'templates/footer.php';
