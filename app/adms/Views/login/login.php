<h1>Área Restrita</h1>

<?php
    if(isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

<form method='POST' action=''>
    <label for='user'>Usuário:</label>
    <input type='text' name='user' placeholder='Nome do usuário' value='<?= $this->data['form']['user'] ?? '' ?>'>
    <br><br>
    <label for='password'>Senha:</label>
    <input type='password' name='password' placeholder='Insira sua senha' value='<?= $this->data['form']['password'] ?? '' ?>'>
    <br><br>
    <input type='submit' name='SendLogin' value='Acessar'>
</form>

<p><a href='<?= URLADM . '/' . 'new-user' ?>'>Clique aqui</a> para cadastrar</p>