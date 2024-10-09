<?php

namespace Core;

/**
 * Carregar as páginas da View
 */
class ConfigView
{
    private string $nameView;
    private array|string|null $data;

    /**
     * Recebe o endereço da view e os dados
     *
     * @param string $nameView Endereço da view que deve ser carregada
     * @param array|string|null $data Dados que a view deve receber
     */
    public function __construct(string $nameView, array|string|null $data)
    {
        $this->nameView = $nameView;
        $this->data = $data;
    }

    /**
     * Carrega a view caso ela exista.
     *
     * @return void
     */
    public function loadView(): void
    {
        if(file_exists('app/' . $this->nameView . '.php')) {
            include 'app/' . $this->nameView . '.php';
        } else {
            echo "<span style='color: red'>O arquivo <mark>app/{$this->nameView}.php</mark> não existe!</span> <br>";
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM);
        }
    }
}