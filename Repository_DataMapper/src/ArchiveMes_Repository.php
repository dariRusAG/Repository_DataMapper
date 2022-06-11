<?php

namespace Dasha;

use Dasha\ArchiveMes_Mapper;

class ArchiveMes_Repository
{
    private $recordsMapper;
    private $records = array();

    public function __construct()
    {
        $this->recordsMapper = new ArchiveMes_Mapper();
        $this->records = $this->recordsMapper->getAll();
    }
    
    public function findAll()
    {
        return $this->records;
    }

    public function printAll($records)
    {
        $this->recordsMapper->getAllRecords($records);
    }

    public function findById($id) {
        foreach ($this->records as $recordsMapper) {
            if ($recordsMapper->getId() == $id) {
                $data = $recordsMapper->getData();
                $login = $recordsMapper->getName();
                $message = $recordsMapper->getMessage();

                echo "$id $data $login: $message</p>";
                return;
            }
        }
        echo "Запись по ID номеру $id не найдена</p>";
    }

    // Удаление записи
    public function deleteById($id) {
        foreach ($this->records as $recordsMapper) {
            if ($recordsMapper->getId() == $id) {
                $this->recordsMapper->deleteById($id);
                return;
            }
        }
        echo "Запись по ID номеру $id не найдена</p>";
    }

    // Добавление записи
    public function addById($getId_save, $name, $data, $message) {
        $this->recordsMapper->addById($getId_save, $data, $name, $message);
    }

    // Обновление записи
    public function updateById($getId_save, $name, $data, $message) {
        $this->recordsMapper->updateById($getId_save,  $data, $name, $message);
    }

    public function sendInfo($ID_save) {
        $name_save = (string)$_GET['name_save'];
        $date_save = str_replace('T', ' ', (string)$_GET['date_save']);
        $message_save = (string)$_GET['message_save'];
        $action = $_GET['action'];

        $records = array();
        $element = new ArchiveMes($ID_save, $date_save, $name_save, $message_save);
        array_push($records, $element);

        switch ($action) {
            case 'addRecords':
                foreach ($this->records as $recordsMapper) {
                    if ($recordsMapper->getId() == $ID_save)
                    {
                        //echo "Такая запись уже есть. Поменяйте ID.";
                        exit("Такая запись уже есть. Поменяйте ID.");
                    }
                }
                $this->recordsMapper->addById($records);
                break;

            case 'updateRecords':
                foreach ($this->records as $recordsMapper) {
                    if ($recordsMapper->getId() == $ID_save) {
                        $this->recordsMapper->updateById($records);
                        break;
                    }
                }
                exit("Такой записи нет. Поменяйте ID.");
        }
    }

    function fieldInfo($input, $date_field)
    {
        $action = $_GET['action'];

        switch ($action) {
            case 'ID_act':
                $this->findById($input);
                break;

            case 'log_act':
                $this->recordsMapper->findByValue($input, 1);
                break;

            case 'date_act':
                $this->recordsMapper->findByValue($date_field, 2);
                break;

            case 'mes_act':
                $this->recordsMapper->findByValue($input, 3);
                break;
        }
    }
}
