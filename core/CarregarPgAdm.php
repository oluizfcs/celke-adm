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

    /** Lista de páginas públicas */
    private array $listPgPublic;

    /** Lista de páginas que só podem ser acessadas com login */
    private array $listPgPrivate;

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

        // Ver se o usuário pode acessar a página
        $this->pgPublic();
        
        // Carregar a página se a a mesma existir, caso contrário, passar o padrão
        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            $this->urlController = CONTROLLERERRO;
            $this->urlMetodo = METODO;
            $this->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);
        }
    }

    /**
     * Verifica se a controller está presente na lista de páginas públicas
     * e a carrega. Caso não esteja, chama o método pgPrivate();
     *
     * @return void
     */
    private function pgPublic(): void
    {
        $this->listPgPublic = ['Login', 'Logout', 'Erro', 'NewUser'];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\Adms\\Controllers\\" . $this->urlController;
        } else {
            $this->pgPrivate();
        }
    }

    /**
     * Verifica se a controller está presente na lista de páginas que
     * precisam de login e valida o mesmo. Caso não esteja, redireciona para a página de erro.
     *
     * @return void
     */
    private function pgPrivate(): void
    {
        $this->listPgPrivate = ['Dashboard', 'ViewUsers'];

        if (in_array($this->urlController, $this->listPgPrivate)) {
            $this->verifyLogin();
        } else {
            header('Location: ' . URLADM . '/' . CONTROLLERERRO);
        }
    }

    private function verifyLogin(): void
    {
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
            $this->classLoad = "\\Adms\\Controllers\\" . $this->urlController;
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Você precisa estar logado para acessar aquela página.</p>";
            header('Location: ' . URLADM . '/' . CONTROLLER);
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