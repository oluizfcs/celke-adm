<?php

namespace Core;

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;

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
            $this->urlController = CONTROLLER;
            $this->urlMetodo = METODO;
            $this->urlParameter = '';
        }

        echo "Controller: {$this->urlController} <br>";
        echo "Método: {$this->urlMetodo} <br>";
        echo "Prâmetro: {$this->urlParameter} <hr> <br>";
    }

    public function loadPage()
    {
        echo "Carregar página: {$this->urlController}<br>";
        $this->classLoad = "\\Adms\\Controllers\\" . $this->urlController;
        $classPage = new $this->classLoad();
        $classPage->{$this->urlMetodo}();
    }
}