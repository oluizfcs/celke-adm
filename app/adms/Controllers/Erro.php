<?php

namespace Adms\Controllers;

class Erro
{
    /** Recebe os dados a serem enviados para a view */
    private array|string|null $data;

    /**
     * Instanciar a classe responsável por carregar a view e enviar os dados para a mesma.
     *
     * @return void
     */
    public function index(): void
    {
        echo "Controller - Erro<br>";

        $this->data = "<p style='color: red'>Página não encontrada!</p>";
        
        $loadView = new \Core\ConfigView('adms/Views/erro/erro', $this->data);
        $loadView->loadView();
    }
}
