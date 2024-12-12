<?php
//This function is used to load file such as templates file and it value send it to the browser
function newsTemlate($fileName, $variables)
{
    extract($variables);
    ob_start();
    require $fileName;
    $output = ob_get_clean();
    return $output;
}


//This function is used to query the database
function find($pdo, $table, $field, $values)
{
    $stm = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . '=:values');
    $values = ['values' => $values];
    $stm->execute($values);
    return $stm->fetch();
}


//This function is used to delete item from the database
function delete($pdo, $table, $field, $values)
{
    $stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE ' . $field . ' = :values');
    $values = [
        'values' => $values
    ];
    $stmt->execute($values);
}

//This function is used to INTER item to the database
function insert($pdo, $table, $record)
{
    $keys = array_keys($record);
    $values = implode(', ', $keys);
    $valuesWithColon = implode(', :', $keys);
    $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';
    $stmt = $pdo->prepare($query);
    $stmt->execute($record);
}

//This functions can be used acrose the website to update database
function genUpdate($pdo, $table, $record, $primaryKey)
{
    $query = 'UPDATE ' . $table . ' SET ';
    $parameters = [];
    foreach ($record as $key => $value) {
        $parameters[] = $key . ' = :' . $key;
    }
    $query .= implode(', ', $parameters);
    $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
    $record['primaryKey'] = $record[$primaryKey];
    $stmt = $pdo->prepare($query);
    $stmt->execute($record);
}

//This founction work with update and insert with try and catch
function save($pdo, $table, $record, $primaryKey)
{
    if (empty($record[$primaryKey])) {
        unset($record[$primaryKey]);
    }
    try {
        insert($pdo, $table, $record);
    } catch (Exception $e) {
        genUpdate($pdo, $table, $record, $primaryKey);
    }
}