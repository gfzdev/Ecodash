<?php
session_start();

require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar-senha'];
    $telefone = $_POST['tel'];

    if ($senha !== $confirmarSenha) {
        $_SESSION['erro'] = 'As senhas não coincidem.';
        header('Location: index.php');
        exit();
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $nomeArquivo = uniqid('foto_', true) . '.' . $extensao;
        $caminhoDestino = 'uploads/' . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoDestino)) {
            $foto = $caminhoDestino;
        } else {
            $_SESSION['erro'] = 'Erro ao fazer upload da foto.';
            header('Location: index.php');
            exit();
        }
    }

    $sql = 'INSERT INTO cd_usuario (nome, email, senha_hash, telefone, foto) VALUES (:nome, :email, :senha, :telefone, :foto)';
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash,
            ':telefone' => $telefone,
            ':foto' => $foto
        ]);

        $_SESSION['sucesso'] = 'Usuário cadastrado com sucesso!';
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['erro'] = 'Erro ao cadastrar usuário: ' . $e->getMessage();
        header('Location: index.php');
        exit();
    }
}
?>
