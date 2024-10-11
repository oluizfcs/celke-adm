<?php

namespace Adms\Models;

class AdmsLogin
{
    private array|null $data;

    public function login(array $data = null)
    {
        $this->data = $data;
        var_dump($this->data);
    }
}