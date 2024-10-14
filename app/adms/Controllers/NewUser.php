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
            if ($this->dataForm['password'] == $this->dataForm['confirm_password']) {
                $newUser = new \Adms\Models\AdmsNewUser();
                $newUser->create($this->data['form']);
            } else {
                $_SESSION['msg'] = "<p style='color: red'>As senhas não coincidem.</p>";
            }
        }

        $loadView = new \Core\ConfigView('adms/Views/login/newUser', $this->data);
        $loadView->loadView();
    }
}