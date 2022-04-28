<?php
$page = 'radio';

require 'config/settings.php';
require 'config/common.php';
require 'templates/header.php';
?>

<h2 class="fw-bold text-secondary text-center mt-4">Vali raadiojaam</h2>

<!-- Radiochannel buttons -->

<div id="buttons" class="d-grid gap-2 d-md-flex mt-4 justify-content-md-center">
    <?php foreach (RADIO_STATION as $x => $val) { ?>

        <button id="button" type="button" class="custom-btn btn-outline-success" data-value="<?php echo $val; ?>"> <strong><?php echo $x; ?></strong> </button>

    <?php } ?>
</div>

<!-- Audioplayer -->

<div class="row justify-content-center mt-2">

    <div class="col-auto mt-4">
        <audio id="audio" controls="controls" autoplay>
            <source id="audio-source" src="">
            </source>
            Your browser does not support the audio format.
        </audio>
    </div>

</div>

<script>
    // Attach onclick event to radiochannel buttons
    buttons.onclick = function(e) {
        e.preventDefault();
        var elm = e.target;
        var audio = document.getElementById('audio');
        var source = document.getElementById('audio-source');
        source.src = elm.getAttribute('data-value');
        console.log(source.src);
        audio.load();
    };
</script>

<?php
require 'templates/footer.php';
