<?php

namespace Adms\Models;

use PDO;

class AdmsLogin extends helper\AdmsConn
{
    /** Recebe os dados do formulário */
    private array|null $data;
    /** Recebe o PDO */
    private object $conn;
    /** Resultado da tentativa de login */
    private bool $result;

    /**
     * Diz se o login deu certo ou não
     *
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Tenta realizar o login com os dados do formulário
     *
     * @param array|null $data
     * @return void
     */
    public function login(array $data = null): void
    {
        $this->data = $data;

        $this->conn = parent::connectDb();

        $query = $this->conn->prepare("SELECT id, name, nickname, email, password, image
                              FROM adms_users
                              WHERE user = :user
                              LIMIT 1");
        $query->bindParam(":user", $this->data['user'], PDO::PARAM_STR);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $this->data['user'] = $query->fetch(PDO::FETCH_ASSOC);
            $this->checkPassword();
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: credenciais incorretas</p>";
            $this->result = false;
        }
    }

    /**
     * Verifica se as senhas coincidem
     *
     * @return void
     */
    private function checkPassword(): void
    {
        if (password_verify($this->data['password'], $this->data['user']['password'])) {
            $_SESSION['user_id'] = $this->data['user']['id'];
            $_SESSION['user_name'] = $this->data['user']['name'];
            $_SESSION['user_nickname'] = $this->data['user']['nickname'];
            $_SESSION['user_email'] = $this->data['user']['email'];
            $_SESSION['user_image'] = $this->data['user']['image'];
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: credenciais incorretas</p>";
            $this->result = false;
        }
    }
}