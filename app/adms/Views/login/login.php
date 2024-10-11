<?php

echo 'View - login';
var_dump($this->data);

# Decidi utilizar o operador null coalescing para corrigir este erro
// if ($this->data['form'] == null) {
//     $this->data['form']['user'] = '';
//     $this->data['form']['password'] = '';
// }

// Criptografar senhas
// echo password_hash("123", PASSWORD_DEFAULT);

?>

<h1>Área Restrita</h1>

<form method='POST' action=''>
    <label for='user'>Usuário:</label>
    <input type='text' name='user' placeholder='Nome do usuário' value='<?= $this->data['form']['user'] ?? '' ?>'>
    <br><br>
    <label for='password'>Senha:</label>
    <input type='password' name='password' placeholder='Insira sua senha' value='<?= $this->data['form']['password'] ?? '' ?>'>
    <br><br>
    <input type='submit' name='SendLogin' value='Acessar'>
</form>