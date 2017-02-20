<?php
/**
 * Created by PhpStorm.
 * User: vvpol
 * Date: 20.02.2017
 * Time: 8:51
 */
/**
 * Соединение с БД
 */
function initDB(){
    $conf = include('confdb.php');
    try {
        $DBH = new PDO($conf['dsn'], $conf['user'], $conf['password']);
        $DBH -> exec("set names 'utf8'");
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $DBH;
    } catch (PDOException $e) {
        die($e -> getMessage());
    }
}

/**
 * Выборка данных из БД
 * возвращает массив: array[i][field_name]=field_value
 * --------------------------------------------------
 * @param string $sql
 * @param array $params
 * @return array
 * @throws Exception
 */
function select($DBH, $sql, $params){
    try {
    $STH = $DBH->prepare( $sql );
    $STH -> execute( $params );
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $res = array();
    while($row = $STH->fetch()) {
        $res[] = $row;
    }
    return $res;
} catch (Exception $e){
        die($e->getMessage());
    }
}

/**
 * Формирование массива данных
 * @param $interval
 * @return array
 */
function formConv($interval){
    $DBH = initDB();
// Получаем стартовую дату и общее количество клиент ов
    $sql = 'select date(min(`added_time`)) as created, TO_DAYS(min(`added_time`)) as min_day, count(*) as count from `st_test`';
    $res = select($DBH, $sql, array());
    $num = $res[0]['count'];
    $begin = $res[0]['created'];
    // Привязка к дням от начала эпохи
    $startDay = (int)$res[0]['min_day'];
    // Выборка количеств по датам
    $sql = 'select count(*) as count, DATE(`added_time`) as day, TO_DAYS(`added_time`) as abs_day from `st_test` where `status`="registered" GROUP by DATE(`added_time`) order by `added_time`';
    $res = select($DBH, $sql, array());
    $stopDay = (int)$res[sizeof($res) - 1]['abs_day'];
    $numPriods = ceil(($stopDay - $startDay + 1) / $interval); // Кол-во периодов
    $max = 0;  // Максимальный результат
    $result = [];
    // Заполнение результата нулями
    for ($i = 0; $i < $numPriods; $i++){
        $result[] = 0;
    }
    // Заполнение результата количествами
    for ($i = 0; $i < sizeof($res); $i++){
        $numPer = (int)(($res[$i]['abs_day'] - $startDay) / $interval); // Номер периода
        $result[$numPer] += $res[$i]['count'];
    }
    // Заполнение процентами
    for ($i = 0; $i <$numPer; $i++){
        if ($result[$i] > $max) $max = $result[$i];
        $result[$i] = (int)($result[$i] * 100 / $num);
    }
    return array(
        'list' => $result,
        'max' => (int)($max * 100 / $num),
        'begin' => $begin
    );
}