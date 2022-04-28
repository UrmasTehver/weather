<?php
$page = 'west';
$note_error = '';

require 'config/settings.php';
require 'config/common.php';
require 'templates/header.php';

$today = date("Y-m-d");

if (isset($_POST['setdate'])) {
    $selectedday = $_POST["setdate"];
} else {
    $selectedday = $today;
}

#  Last record on table west (for calendar min date)
try {
    $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
    $connection->exec('SET NAMES utf8');
    $sql = 'SELECT added FROM `ilm_ds18_out_west` ORDER BY added ASC LIMIT 1';
    $statement = $connection->prepare($sql);
    $statement->execute();
    $west = $statement->fetch(PDO::FETCH_ASSOC);
    $firstdate = dbDateRemoveClock($west['added']);
    // show($east); # Testiks
} catch (PDOException $error) {
    $note_error = 'Viga andmebaasist lugemisel: <br /> ' . ($error->getMessage());
}

# mindate for Datepicker calendar settings
$mindate = minDateToDatepicker($today, $firstdate);

# Create array of dates for reading from database
$datestoread = datesToRead($firstdate, $selectedday);

try {
    $temperatures = array();

    for ($i = 0; $i < count($datestoread); $i++) {
        for ($j = 0; $j < count(TIME_FOR_TABLE); $j++) {
            $connection = new PDO($dsn, USERNAME, PASSWORD, $options);
            $connection->exec('SET NAMES utf8');
            $sql = 'SELECT celsius FROM ilm_ds18_out_west 
    WHERE (added BETWEEN DATE_SUB("' . $datestoread[$i] . ' ' . TIME_FOR_TABLE[$j] . ':00", INTERVAL 2.5 MINUTE) 
    AND  DATE_SUB("' . $datestoread[$i] . ' ' . TIME_FOR_TABLE[$j] . ':00", INTERVAL -2.5 MINUTE)) ';

            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            array_push($temperatures, [TIME_FOR_TABLE[$j], onlyYear($datestoread[$i]), $result]);
        }
    }
} catch (PDOException $error) {
    $note_error = 'Viga andmebaasist lugemisel: <br /> ' . ($error->getMessage());
}

// show($temperatures); # Testiks

?>

<div class="row justify-content-center mt-2">

    <?php if ($note_error != '') { ?>
        <h3 class="text-danger text-center"><?php echo $note_error ?></h3>
    <?php } else { ?>

        <div class="col-auto m-2">
            <p class="fw-bold text-secondary mt-2">Vali kuupäev:</p>
            <form action="west.php" method="post">
                <input type="text" name="setdate" value="<?php echo ($selectedday); ?>" class="form-control" id="setdate" />
                <input type="hidden" name="loadData" value="1" />
                <input type="submit" value="Lae andmed" class="form-control btn-primary btn-sm mt-2" />
            </form>
        </div>

        <div class="col-auto m-2">
            <p class="fw-bold text-secondary mt-2">Temperatuurid läänes kuupäeval: <?php echo (dbDateToEstDateOnly($selectedday)); ?></p>
            <table class="table is-fullwidth is-hoverable is-bordered">
                <thead class="text-secondary has-text-centered">
                    <tr>
                        <th>Kell/Aasta</th>
                        <?php for ($i = 0; $i < count($datestoread); $i++) { ?>
                            <th><?php echo (onlyYear($datestoread[$i])); ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $counter = 0;
                    for ($j = 0; $j < count(TIME_FOR_TABLE); $j++) { ?>
                        <tr>
                            <td> <?php echo (TIME_FOR_TABLE[$j]); ?> </td>
                            <?php
                            $k = $counter;

                            for ($i = $counter; $i < ($counter + count($datestoread)); $i++) { ?>

                                <td><?php if (!empty($temperatures[$k][2])) {
                                        echo ($temperatures[$k][2]['celsius']);
                                    } else { ?>
                                        -
                                    <?php } ?>
                                </td>
                            <?php
                                $k = $k + count(TIME_FOR_TABLE);
                            }
                            $counter = $counter + 1;
                            ?>

                        </tr>

                    <?php } ?>

                </tbody>
        </div>

    <?php } ?>

</div>

<script>
    $(function() {
        $("#setdate").datepicker({
            dateFormat: 'yy-mm-dd',
            maxDate: 0, // Not allowed future date
            minDate: <?php echo $mindate; ?>, // Not allowed date before first record date 
        });
    });
</script>

<?php
require 'templates/footer.php';
