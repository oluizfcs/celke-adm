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
    private array $format;
    private string $urlSlugController;
    private string $urlSlugMetodo;

    public function __construct()
    {
        parent::configAdm();

        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->clearUrl();
            $this->urlArray = explode('/', $this->url);

            // Define a Controller
            if(isset($this->urlArray[0])) {
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLER);
            }

            // Define o método
            if(isset($this->urlArray[1])) {
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            } else {
                $this->urlMetodo = $this->slugMetodo(METODO);
            }

            // Define o parâmetro
            if(isset($this->urlArray[2])) {
                $this->urlParameter = $this->urlArray[2];
            } else {
                $this->urlParameter = '';
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = '';
        }

        echo "Controller: {$this->urlController} <br>";
        echo "Método: {$this->urlMetodo} <br>";
        echo "Prâmetro: {$this->urlParameter} <hr> <br>";
    }

    private function clearUrl(): void
    {
        // Tira as tags (<a></a> <p></p>)
        $this->url = strip_tags($this->url);

        // Remove os espaços
        $this->url = trim($this->url);

        // Tira a / do final da url
        $this->url = rtrim($this->url, '/');

        // Eliminar caracteres
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(mb_convert_encoding($this->url, "ISO-8859-1", "UTF-8"), mb_convert_encoding($this->format["a"], "ISO-8859-1", "UTF-8"), $this->format["b"]);
    }

    private function slugController(string $slugController): string
    {
        // Tudo em minúsculo
        $slugController = strtolower($slugController);
        // Remove os -
        $slugController = str_replace('-', ' ', $slugController);
        // Primeira letra de cada palavra em maíusculo
        $slugController = ucwords($slugController);
        // Remove o espaço
        $slugController = str_replace(' ', '', $slugController);

        $this->urlSlugController = $slugController;

        return $this->urlSlugController;
    }

    public function slugMetodo(string $slugMetodo): string
    {
        $slugMetodo = $this->slugController($slugMetodo);

        // Primeira letra minúscula
        $slugMetodo = lcfirst($slugMetodo);

        $this->urlSlugMetodo = $slugMetodo;
        
        return $this->urlSlugMetodo;
    }

    public function loadPage()
    {
        echo "Carregar página: {$this->urlController}<br>";
        $this->classLoad = "\\Adms\\Controllers\\" . $this->urlController;
        $classPage = new $this->classLoad();
        $classPage->{$this->urlMetodo}();
    }
}