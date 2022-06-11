<?php

use Dasha\application\controller\Chat_Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Dasha\ArchiveMes_Repository;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . '/templates/');
$twig = new Environment($loader);

$recordsRepository = new ArchiveMes_Repository();
$records = $recordsRepository->findAll();

$chat = new Chat_Controller($twig);
$chat->__invokeButtons();

// Получение всех записей
if (isset($_GET['getAllRecords'])) $recordsRepository->printAll($records);

// Получение записи по ID
if (isset($_GET['getByID'])) {
    $name = 'ID';
    $placeholder = 'Введите ID для поиска';
    $type = 'getRecordById';
    $text = 'ВЫВЕСТИ ЗАПИСЬ';

    $chat->__invokeID($name, $placeholder, $type, $text);
}

$getId = (string)$_GET['ID'];
if ($getId != '') $recordsRepository->findById($getId);

// Удаление записи
if (isset($_GET['deleteRecord'])) {
    $name = 'ID_del';
    $placeholder = 'Введите ID для удаления';
    $type = 'deleteRecordsById';
    $text = 'УДАЛИТЬ';

    $chat->__invokeID($name, $placeholder, $type, $text);
}

$getId_del = (string)$_GET['ID_del'];
if ($getId_del != '') $recordsRepository->deleteById($getId_del);

// Сохранение записи (добавление, обновление)
if (isset($_GET['saveRecord'])) $chat->__invokeRemainingData();

$getId_save = (string)$_GET['ID_save'];
if ($getId_save != '') $recordsRepository->sendInfo($getId_save);

// Получению записей по значению поля из таблицы
if (isset($_GET['getByFieldValue'])) $chat->__invokeFieldValue();

$input = (string)$_GET['input'];
$date_field = str_replace('T', ' ', (string)$_GET['date_field']);

if ($input != '' || $date_field != '') $recordsRepository->fieldInfo($input, $date_field);

?>