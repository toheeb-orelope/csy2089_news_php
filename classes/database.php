<?php

/*
References:
Tom, B. (2024) Topic 10. [Lecture notes] CSY2089: Web ProgrammingWeb Programming. The University of Northampton, 2024.
Toheeb, H. (2024) PHP best practice. [Lab practice code] CSY2089: Web ProgrammingWeb Programming. The University of Northampton, 2024.


*/
class Database
{

    /*
    According to Tom (2024), the PHP code for web programming was covered during the lab sessions and lecture notes.
    According to Toheeb (2024), PHP best practice code involved best way to write php code, web structure, and database manipulation.
    */
    //This type of construction called Property Promotion

    public function __construct(
        public $pdo,
        public $table,
        public $primKey
    ) {
    }
    //This function is used to query the database to fetch a single item
    function genFind($field, $values)
    {
        $stm = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . '=:values');
        $values = ['values' => $values];
        $stm->execute($values);
        return $stm->fetch();
    }


    //This function is used to query the database to fetch all items in the database
    function genFindAll()
    {
        $stm = $this->pdo->prepare('SELECT * FROM ' . $this->table . '');
        $stm->execute();
        return $stm->fetchAll();
    }

    //According to Toheeb (2024), PHP best practice code involved best way to write php code, web structure, and database manipulation.

    //This functions would query by ordering
    function findByOrder($field, $values)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = ' . $values . ' ORDER by date desc');
        $stmt->execute();
        return $stmt->fetchAll();
    }


    //This function is used to delete item from the database
    function genDelete($field, $values)
    {
        $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $field . ' = :values');
        $values = [
            'values' => $values
        ];
        $stmt->execute($values);
    }

    //This function is used to INTER item from the database
    function genInsert($record)
    {
        $keys = array_keys($record);
        $values = implode(', ', $keys);
        $valuesWithColon = implode(', :', $keys);
        $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';
        $stmt = $this->pdo->prepare($query);
        // var_dump($query, $record);
        $stmt->execute($record);
    }


    //This functions is use to query update from database
    function genUpdate($record)
    {

        $query = 'UPDATE ' . $this->table . ' SET ';

        $parameters = [];
        foreach ($record as $key => $value) {
            $parameters[] = $key . ' = :' . $key;
        }
        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $this->primKey . ' = :primKey';


        $record['primKey'] = $record[$this->primKey];
        // var_dump($record, $query);
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($record);

    }

    //This founction work with update and insert with try and catch
    function genSave($record)
    {
        if (empty($record[$this->primKey])) {
            unset($record[$this->primKey]);
        }
        try {
            $this->genInsert($record);
        } catch (Exception $e) {
            $this->genUpdate($record, );
        }
    }

    //This function is used to load file such as templates file and it value send it to the browser
    function newsTemplate($fileName, $variables)
    {
        extract($variables);
        ob_start();
        require $fileName;
        $output = ob_get_clean();
        return $output;
    }


    //This code is from chatGPT 09/12/2024
    function getEnumValues(): array
    {
        try {
            $sql = 'SHOW COLUMNS FROM ' . $this->table . ' LIKE :primKey';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':primKey' => $this->primKey]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                preg_match('/^enum\((.*)\)$/', $row['Type'], $matches);
                return str_getcsv($matches[1], ",", "'");
            } else {
                return []; // Return an empty array if the primKey isn't found
            }
        } catch (PDOException $e) {
            // Log the error and return an empty array
            error_log('Error fetching enum values for $this->table.$this->primKey: ' . $e->getMessage());
            return [];
        }
    }


}
