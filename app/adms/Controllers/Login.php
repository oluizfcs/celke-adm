<?php

namespace Adms\Controllers;

class Login
{
    /** Recebe os dados a serem enviados para a view */
    private array|string|null $data = null;

    /** Recebe os dados do formulário */
    private array|null $dataForm;

    /**
     * Instanciar a classe responsável por carregar a view e enviar os dados para a mesma.
     *
     * @return void
     */
    public function index(): void
    {
        echo 'Controller - Login<br>';

        $this->dataForm = filter_input_array(INPUT_POST, $_POST, FILTER_DEFAULT);

        $this->data['form'] = $this->dataForm;

        if ($this->data['form'] != null) {

            $valLogin = new \Adms\Models\AdmsLogin();
            $valLogin->login($this->dataForm);

            if ($valLogin->getResult()) {
                $urlRedirect = URLADM . '/dashboard/index';
                header("Location: $urlRedirect");
            }
        }

        $loadView = new \Core\ConfigView('adms/Views/login/login', $this->data);
        $loadView->loadView();
    }
}