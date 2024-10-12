<?php

namespace Adms\Controllers;

class NewUser
{
    /** Dados a serem enviados para a view */
    private array|string|null $data;

    /** Dados recebidos do formulário de cadastro */
    private array|null $dataForm = null;

    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, $_POST, FILTER_DEFAULT);
        
        $this->data['form'] = $this->dataForm;

        if ($this->data['form'] != null) {
            $newUser = new \Adms\Models\AdmsNewUser();
            $newUser->create($this->data['form']);
            var_dump($this->data['form']);
        }

        $loadView = new \Core\ConfigView('adms/Views/login/newUser', $this->data);
        $loadView->loadView();
    }
}