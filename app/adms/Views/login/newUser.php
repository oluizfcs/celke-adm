<h1>Novo Usuário</h1>

<?php
    if(isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>

<form method='POST' action=''>
    <label for='name'>Nome:</label>
    <input type='text' name='name' id='name' placeholder='Digite o nome completo' value='<?= $this->data['form']['user'] ?? '' ?>'>
    <br><br>
    <label for='email'>E-mail:</label>
    <input type='text' name='email' id='email' placeholder='Digite o seu e-mail' value='<?= $this->data['form']['user'] ?? '' ?>'>
    <br><br>
    <label for='password'>Senha:</label>
    <input type='password' name='password' placeholder='Insira sua senha' value='<?= $this->data['form']['password'] ?? '' ?>'>
    <br><br>
    <label for='confirm_password'>Confirmar senha:</label>
    <input type='password' name='confirm_password' placeholder='Confirme sua senha' value='<?= $this->data['form']['confirm_password'] ?? '' ?>'>
    <br><br>
    <input type='submit' name='SendNewUser' value='Cadastrar'>
</form>

<p><a href='<?= URLADM . '/' . 'Login' ?>>Clique aqui</a> para fazer login</p>