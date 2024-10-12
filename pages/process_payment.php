<?php
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $comprovante = $_FILES['comprovante'];

    // Verificar se o comprovante foi enviado corretamente
    if (isset($comprovante) && $comprovante['error'] == 0) {
        $file_name = $comprovante['name'];
        $file_tmp = $comprovante['tmp_name'];

        // Diretório de upload
        $upload_dir = '../uploads/comprovantes/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Cria o diretório, se não existir
        }

        // Gerar um nome único para o arquivo
        $file_destination = $upload_dir . uniqid() . '-' . $file_name;

        // Mover o arquivo para o diretório de uploads
        if (move_uploaded_file($file_tmp, $file_destination)) {
            // Atualizar a reserva com o comprovante
            $stmt = $pdo->prepare("UPDATE reservations SET comprovante = ? WHERE id = ?");
            if ($stmt->execute([$file_destination, $reservation_id])) {
                header('Location: success.php');
                exit;
            } else {
                echo "Erro ao salvar o comprovante.";
            }
        } else {
            echo "Erro ao fazer upload do comprovante.";
        }
    } else {
        echo "Nenhum comprovante foi enviado ou ocorreu um erro no envio.";
    }
}
?>
