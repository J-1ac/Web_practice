<?php



function setConnectionInfo($values=array()) {
    // PDO(PHP Data Object)를 생성하고 리턴
    $connString = $values[0];
    $user = $values[1];
    $password = $values[2];

    $pdo = new PDO($connString, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;      
}


function runQuery($pdo, $sql, $parameters=array())     {
    // 받아온 파라미터가 배열인지 체크하고
    // 파라미터에 대해 execute 수행
    // 마지막으로 query를 수행하고 리턴
    $parameter = [];
    if (is_array($parameters)) {
       $parameter = array($parameters);
    }
    $statement = null;
    if (count($parameter) > 0) {
       $statement = $pdo->prepare($sql);
       $executedOk = $statement->execute($parameter[0]);
       if (!$executedOk) {
          throw new PDOExecption;
       }
    } else {
       $statement = $pdo->query($sql);
       if (!$statement) {
          throw new PDOException;
       }
    }

    return $statement;
}


function readAllCustomers() {
    // setConnectionInfo() 및 runQuery()를 한 번씩 호출하여
    // 모든 customer에 대한 정보를 프린트
    $pdo = setConnectionInfo(array('mysql:host=localhost; dbname=books', 'test', 'mypassword'));
    $statement = runQuery($pdo, "SELECT * FROM `customers` ORDER BY `customers`.`LastName` ASC;", null);
    return $statement;
}
function readSelectCustomers($lastName) {
    // setConnectionInfo() 및 runQuery()를 한 번씩 호출하여
    // customer의 lastname을 string으로 검색하고, 해당하는 customer에 대한 정보만 프린트
    $pdo = setConnectionInfo(array('mysql:host=localhost; dbname=books', 'test', 'mypassword'));
    $statement = runQuery($pdo, "SELECT * FROM customers WHERE LastName like '%$lastName%' ORDER BY customers.LastName ASC;", $lastName);
    return $statement;
}
function readCategories() {
    // setConnectionInfo() 및 runQuery()를 한 번씩 호출하여
    // categories를 배너에 프린트
    $pdo = setConnectionInfo(array('mysql:host=localhost; dbname=books', 'test', 'mypassword'));
    $statement = runQuery($pdo, "SELECT * FROM `categories`;", null);
    return $statement;
}
function readImprints() {
    // setConnectionInfo() 및 runQuery()를 한 번씩 호출하여
    // imprints를 배너에 프린트
    $pdo = setConnectionInfo(array('mysql:host=localhost; dbname=books', 'test', 'mypassword'));
    $statement = runQuery($pdo, "SELECT * FROM `imprints` ORDER BY `imprints`.`Imprint` ASC;", null);
    return $statement;
}


?>