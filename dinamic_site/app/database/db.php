<?php

session_start();

require('connect.php');

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

//Проверка выполнения запроса к БД
function dbCheckError($query){
    $errorInfo = $query ->errorInfo();

    if ($errorInfo[0] !== PDO::ERR_NONE){
        echo $errorInfo[2];
        exit();
    }
    return true;
}

//Запрос на получение данных одной таблици
function selectAll($table, $params  = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    if(!empty($params)){
       $i = 0;
       foreach ($params as $key => $value){
           if(!is_numeric($value)){
               $value = "'".$value."'";
           }
           if($i === 0){
                $sql = $sql . " WHERE $key = $value";
           }else{
                $sql = $sql . " AND $key = $value";
           }
           $i++;
       }

    }

    $sql = $sql . ";";

    $query = $pdo ->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query ->fetchAll();
}

//Запрос на получение одной строки с таблици
function selectOne($table, $params  = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }

    }
    //$sql = $sql . " LIMIT 1";
    // echo $sql;
    $sql = $sql . ";";
    $query = $pdo ->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query ->fetch();
}

// Подсчет количества строк
// function countTable($table){
//     global $pdo;
//     $sql = "SELECT count(*) FROM $table";
//     $sql = $sql . ";";
//     $query = $pdo ->prepare($sql);
//     $query->execute();

//     dbCheckError($query);

//     return $query ->fetch();
// }

function lockTables(){
    global $pdo;
    $sql = "LOCK TABLES users WRITE, pasport WRITE, posts WRITE, cart WRITE;";
    $query = $pdo ->prepare($sql);
    $query->execute();
}
function unlockTables(){
    global $pdo;
    $sql = "UNLOCK TABLES;";
    $query = $pdo ->prepare($sql);
    $query->execute();
}



//Запись в таблицу БД

function insert($table, $params){
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" ."$value" . "'";
        }else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask);";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}

// Обновление строки в таблице
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else {
            $str = $str .", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id;";
    // echo $sql;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

}

// Обновление строки в таблице
function delete($table, $id){
    global $pdo;
    //DELETE FROM `topics` WHERE id = 3
    $sql = "DELETE FROM $table WHERE id =". $id . ";";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

}

// Выборка записей (posts) с авторами в админку
    function selectAllFromPostWithUsers($table1, $table2){
        global $pdo;
        $sql = "
        SELECT
        t1.id,
        t1.status,
        t1.type,
        t1.created_date,
        t2.username
        FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id
        ;";


        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query ->fetchAll();

    }

function DocGet($table, $id){
    global $pdo;

    $sql = "SELECT * FROM $table WHERE id_user = $id;";


    $query = $pdo ->prepare($sql);
    $query->execute();

    dbCheckError($query);

    return $query ->fetchAll();
}

