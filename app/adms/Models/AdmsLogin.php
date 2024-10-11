<?php

namespace Adms\Models;

class AdmsLogin extends helper\AdmsConn
{
    /** Recebe os dados do formulário */
    private array|null $data;
    /** Recebe o PDO */
    private object $conn;

    public function login(array $data = null)
    {
        $this->data = $data;

        $this->conn = parent::connectDb();
    }
}