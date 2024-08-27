<?php
include('../conexao/conexao.php');

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $email = mysqli_real_escape_string($db->con, $email);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $query = "SELECT * FROM Usuarios WHERE email = '$email'";
    $result = mysqli_query($db->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario['senha'])) {
            echo "Login realizado com sucesso!";
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}

$db->fechar();
?>

