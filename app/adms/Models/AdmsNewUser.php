<?php

namespace Adms\Models;

use PDO;
use DateTime;

class AdmsNewUser extends helper\AdmsConn
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
    public function create(array $data = null): void
    {
        $this->data = $data;

        $this->conn = parent::connectDb();

        if (!$this->userAlreadyExists()) {
            // Obtendo a data e hora atual
            $dateTime = new DateTime();
            $dateTime->setTimezone(TIMEZONE);
            $this->data['created'] = $dateTime->format('Y-m-d H:i:s');
    
            // Criptografar senha
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
    
            var_dump($this->data);
    
            $query = $this->conn->prepare("INSERT INTO adms_users (name, email, password, user, created)
                                           VALUES (:name, :email, :password, :user, :created)");
            $query->bindParam(":name", $this->data['name'], PDO::PARAM_STR);
            $query->bindParam(":email", $this->data['email'], PDO::PARAM_STR);
            $query->bindParam(":password", $this->data['password'], PDO::PARAM_STR);
            $query->bindParam(":user", $this->data['email'], PDO::PARAM_STR);
            $query->bindParam(":created", $this->data['created'], PDO::PARAM_STR);
            
            if ($query->execute()) {
                $_SESSION['msg'] = "<p style='color: green'>Usuário cadastrado com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: red'>Erro: falha ao cadastrar usuário</p>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: Já existe um usuário cadastrado com este e-mail.</p>";
        }

    }

    private function userAlreadyExists(): bool
    {
        $query = $this->conn->prepare("SELECT email FROM adms_users WHERE email = :email");
        $query->bindParam(":email", $this->data['email'], PDO::PARAM_STR);

        $query->execute();

        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}