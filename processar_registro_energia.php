<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['erro'] = 'Você precisa estar logado para registrar contas de energia.';
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicione esta linha para depuração:
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $data_leitura = $_POST['data_leitura'] ?? '';
    $consumo_kwh = $_POST['consumo_kwh'] ?? '';
    $custo_reais = $_POST['custo_reais'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';

    $consumo_kwh = str_replace(',', '.', $consumo_kwh);
    $custo_reais = str_replace(',', '.', $custo_reais);

    if (empty($data_leitura) || empty($consumo_kwh) || empty($custo_reais)) {
        $_SESSION['erro'] = 'Por favor, preencha todos os campos obrigatórios (Data, Consumo, Custo).';
        header('Location: dashboard.php');
        exit();
    }

    if (!is_numeric($consumo_kwh) || $consumo_kwh <= 0) {
        $_SESSION['erro'] = 'Consumo de energia inválido. Use apenas números positivos.';
        header('Location: dashboard.php');
        exit();
    }
    if (!is_numeric($custo_reais) || $custo_reais <= 0) {
        $_SESSION['erro'] = 'Custo da energia inválido. Use apenas números positivos.';
        header('Location: dashboard.php');
        exit();
    }
    $sql = "INSERT INTO registros_energia (usuario_id, data_leitura, consumo_kwh, custo_reais, observacoes) 
            VALUES (:usuario_id, :data_leitura, :consumo_kwh, :custo_reais, :observacoes)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':data_leitura' => $data_leitura,
            ':consumo_kwh' => $consumo_kwh,
            ':custo_reais' => $custo_reais,
            ':observacoes' => $observacoes
        ]);

        $_SESSION['sucesso'] = 'Registro de energia salvo com sucesso!';
        header('Location: dashboard.php');
        exit();

    } catch (PDOException $e) {
        $_SESSION['erro'] = 'Ocorreu um erro ao salvar o registro de energia. Tente novamente.';
        header('Location: dashboard.php');
        exit();
    }

} else {
    header('Location: dashboard.php');
    exit();
}
?>