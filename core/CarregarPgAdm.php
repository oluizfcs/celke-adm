<?php

namespace Core;

/**
 * Carrega as controllers e os seus métodos caso eles existam
 */
class CarregarPgAdm
{
    /** Nome da Controller */
    private string $urlController;

    /** Nome do método */
    private string $urlMetodo;

    /** Nome do parâmetro */
    private string $urlParameter;

    /** Classe a ser instanciada (Controller) */
    private string $classLoad;

    /**
     * Verifica se a Controller existe e instancia o método para carregar ela
     *
     * @param string|null $urlController Nome da Controller tratado
     * @param string|null $urlMetodo Nome do método tratado
     * @param string|null $urlParameter Parâmetro
     * @return void
     */
    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter)
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;

        $this->classLoad = "\\Adms\\Controllers\\" . $this->urlController;
        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            $this->urlController = CONTROLLERERRO;
            $this->urlMetodo = METODO;
            $this->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
        }
    }

    /**
     * Carrega a o método da Controller
     *
     * @return void
     */
    private function loadMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}();
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM);
        }
    }
}