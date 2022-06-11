<?php

namespace Dasha;

class ArchiveMes
{
    private $id;
    private $data;
    private $name;
    private $message;

    public function __construct($id, $data, $name, $message) {
        $this->id = $id;
        $this->data = $data;
        $this->name = $name;
        $this->message = $message;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}