<?php

namespace Dasha;

use PDO;
use Dasha\ArchiveMes;

class ArchiveMes_Mapper
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=MyBase;host=127.0.0.1', 'dasha', 'param12345');
    }

    // Получить все данные с таблицы
    public function getAll()
    {
        $sql = 'SELECT * from messArchive_ActiveRecord';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $table = $stmt->fetchAll();

        $records = array();
        if (isset($table)) {
            foreach ($table as $row) {
                if (isset($row)) {
                    $element = new ArchiveMes($row['ID_mes'], $row['data_mes'], $row['username'], $row['messages']);
                    array_push($records, $element);
                }
            }
        }
        return $records;
    }

    // Получение всех записей
    function getAllRecords($records)
    {
        foreach ($records as $element) {
            $ID = $element->getId();
            $data = $element->getData();
            $login = $element->getName();
            $message = $element->getMessage();

            echo "$ID $data $login: $message</p>";
        }
    }

    // Удаление записи
    public function deleteById($id)
    {
        $sql = 'DELETE FROM messArchive_ActiveRecord WHERE ID_mes = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        $stmt->execute();
        echo "Запись по ID номеру $id успешно удалена</p>";
    }

    // Добавление записи
    public function addById($records)
    {
        foreach ($records as $element) {
            $id = $element->getId();
            $data = $element->getData();
            $name = $element->getName();
            $message = $element->getMessage();
        }

        $sql = 'INSERT INTO messArchive_ActiveRecord values(:id, :data, :name, :message)';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam('id', $id);
        $stmt->bindParam('data', $data);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('message', $message);

        $stmt->execute();

        echo "Запись: $id успешно добавлена.";
    }

    // Обновление записи
    public function updateById($records)
    {
        foreach ($records as $element) {
            $id = $element->getId();
            $data = $element->getData();
            $name = $element->getName();
            $message = $element->getMessage();
        }

        $sql = 'UPDATE messArchive_ActiveRecord SET data_mes = :data, username = :name, messages = :message WHERE ID_mes = :id';
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam('id', $id);
        $stmt->bindParam('data', $data);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('message', $message);

        $stmt->execute();

        echo "Запись: $id успешно обновлена.";
    }

    // Поиск записи по любому полю
    public function findByValue($val, $command)
    {
        $sql = '';
        if ($command == 1) $sql = 'SELECT * from messArchive_ActiveRecord WHERE username = :val';
        if ($command == 2) $sql = 'SELECT * from messArchive_ActiveRecord WHERE data_mes = :val';
        if ($command == 3) $sql = 'SELECT * from messArchive_ActiveRecord WHERE messages = :val';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('val', $val);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $i = 0;
        foreach ($result as $row) $i = $i + 1;
        if ($i == 0) echo 'Записей нет</p>';
        else {
            foreach ($result as $row) {
                $id = $row["ID_mes"];
                $data = $row["data_mes"];
                $login = $row["username"];
                $message = $row["messages"];

                echo "<p>$id $data $login: $message</p>";
            }
        }
    }
}