<?php
/**
 * тестовое задание
 * User: vvpol
 * Date: 20.02.2017
 * Time: 8:45
 */
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );
ini_set( 'display_startup_errors', 1);
date_default_timezone_set("Europe/Moscow");

require_once 'lib.php';
$data = array();
$err = '';
if (isset($_POST['interval'])){
    $interval = (int)$_POST['interval'];
    if ($interval == 0){
        $err = 'Ввевите интервал в днях';
    } else {
        $data = formConv($interval);
    }
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Тестовое задание</title>
    <style>
        .error {
            color: red;
        }
        .graf {
            display: inline-block;
            background-color: blue;
            height: 20px;
        }
        td  {
            padding: 2px 4px;
        }
    </style>
</head>
<body>
<h3>Конверсия</h3>
<div class="error"><?= $err ?></div>
    <form method="post">
        Интервал: <input type="number" name="interval" value="1"> дней
        <input type="submit" value="Применить">
    </form>
<hr>
<?php if (sizeof($data['list']) > 0) { ?>
    <table>

<?php
    $beginDate = strtotime($data['begin']);
    $kProc = 100 * 2 / $data['max']; // Коэффициент для отображения процентов на диаграмме
        for ($i = 0; $i < sizeof($data['list']); $i++){
            $begDay = $beginDate + ($i * $interval * 86400);
            $endDay = $begDay + ($interval - 1) * 86400;
            echo '<tr><td>' . date("Y-m-d", $begDay) . '</td>';
            if ($interval > 1){
                echo '<td>' . date("Y-m-d", $endDay) . '</td>';
            }
            echo '<td>' . $data['list'][$i] . '%</td>';
            echo '<td><div class="graf" style="width: ' . $data['list'][$i] * $kProc . 'px"></div></td></tr>';
        }
?>
</table>
<?php } ?>
</body>
</html>