<?php

namespace Core;

/**
 * Classe responsável por tratar a URL
 */
class ConfigController extends Config
{
    /** Recebe a url que foi feita a partir do .htaccess */
    private string $url;

    /** Array que separa a controller do método e do parâmetro */
    private array $urlArray;

    /** Nome da Controller */
    private string $urlController;

    /** Nome do método */
    private string $urlMetodo;

    /** Nome do Parâmetro */
    private string $urlParameter;

    /** Classe a ser instanciada (Controller) */
    private string $classLoad;

    /** Lista contendo os caracteres especiais e aqueles que os substituem */
    private array $format;

    /** Contém o nome da controller pronto para ser instanciado (PascalCase) */
    private string $urlSlugController;

    /** Contém o nome do método pronto para ser instanciado (camelCase) */
    private string $urlSlugMetodo;

    /**
     * Trata a URL
     */
    public function __construct()
    {
        parent::configAdm();

        // Caso o usuário esteja tentando acessar uma página que não seja a padrão
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
            // Padrão
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = '';
        }

        // echo "Controller: {$this->urlController} <br>";
        // echo "Método: {$this->urlMetodo} <br>";
        // echo "Prâmetro: {$this->urlParameter} <hr> <br>";
    }

    /**
     * Remove anomalias da URL
     *
     * @return void
     */
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

    /**
     * Remove anomalias do nome da Controller
     *
     * @param string $slugController Nome da Controller
     * @return string Nome da Controller tratado
     */
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

    /**
     * Remove anomalias do nome do Método
     *
     * @param string $slugMetodo Nome do método
     * @return string Nome do método tratado
     */
    public function slugMetodo(string $slugMetodo): string
    {
        $slugMetodo = $this->slugController($slugMetodo);

        // Primeira letra minúscula
        $slugMetodo = lcfirst($slugMetodo);

        $this->urlSlugMetodo = $slugMetodo;
        
        return $this->urlSlugMetodo;
    }

    /**
     * Instancia a classe responsável por carregar as controllers e seus métodos
     *
     * @return void
     */
    public function loadPage():void
    {
        $loadPgAdm = new \Core\CarregarPgAdm();
        $loadPgAdm->loadPage($this->slugController($this->urlController), $this->slugMetodo($this->urlMetodo), $this->urlParameter);
    }
}