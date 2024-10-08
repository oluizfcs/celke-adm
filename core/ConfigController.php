<?php

require './core/Config.php';

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;

    public function __construct()
    {
        parent::configAdm();

        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->urlArray = explode('/', $this->url);

            // Define a Controller
            if(isset($this->urlArray[0])) {
                $this->urlController = $this->urlArray[0];
            } else {
                $this->urlController = CONTROLLER;
            }

            // Define o método
            if(isset($this->urlArray[1])) {
                $this->urlMetodo = $this->urlArray[1];
            } else {
                $this->urlMetodo = METODO;
            }

            // Define o parâmetro
            if(isset($this->urlArray[2])) {
                $this->urlParameter = $this->urlArray[2];
            } else {
                $this->urlParameter = '';
            }
        } else {
            $this->urlController = CONTROLLERERRO;
            $this->urlMetodo = METODO;
        }

        echo 'Controller: ' . $this->urlController . '<br> Metodo: ' . $this->urlMetodo . '<br>';
        $this->loadPage();
    }

    public function loadPage()
    {
        require './app/adms/Controllers/Login.php';
        $login = new Controller\Login();
        $login->index();

        require './app/adms/Controllers/Users.php';
        $users = new Controller\Users();
        $users->index();
    }
}