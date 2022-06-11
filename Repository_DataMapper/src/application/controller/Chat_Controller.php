<?php
namespace Dasha\application\controller;

use Dasha\ArchiveMes;
use Twig\Environment;

class Chat_Controller
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invokeButtons()
    {
        echo $this->twig->render('buttons.html.twig');
    }

    public function __invokeID($name, $placeholder, $type, $text)
    {
        echo $this->twig->render('ID.html.twig', ['name' => $name, 'placeholder' => $placeholder, 'type' => $type, 'text' => $text]);
    }

    public function __invokeDelete()
    {
        echo $this->twig->render('deleteR.html.twig');
    }

    public function __invokeFieldValue()
    {
        echo $this->twig->render('fieldV.html.twig');
    }

    public function __invokeRemainingData()
    {
        echo $this->twig->render('remainingData.html.twig');
    }
}
