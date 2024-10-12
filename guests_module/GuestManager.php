<?php

class GuestManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Função para adicionar convidado
    public function addGuest($reservation_id, $name, $phone, $email, $is_accompanied) {
        $stmt = $this->pdo->prepare("INSERT INTO guests (reservation_id, name, phone, email, is_accompanied) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$reservation_id, $name, $phone, $email, $is_accompanied]);
    }

    // Função para buscar convidados por reserva
    public function getGuestsByReservation($reservation_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM guests WHERE reservation_id = ?");
        $stmt->execute([$reservation_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Função para remover um convidado
    public function removeGuest($guest_id) {
        $stmt = $this->pdo->prepare("DELETE FROM guests WHERE id = ?");
        return $stmt->execute([$guest_id]);
    }

    // Função para editar um convidado
    public function editGuest($guest_id, $name, $phone, $email, $is_accompanied) {
        $stmt = $this->pdo->prepare("UPDATE guests SET name = ?, phone = ?, email = ?, is_accompanied = ? WHERE id = ?");
        return $stmt->execute([$name, $phone, $email, $is_accompanied, $guest_id]);
    }

    // Função para compartilhar link via WhatsApp
public function generateWhatsAppLink($reservation_id) {
    // Certifique-se de que o link reflete o seu domínio real e o caminho correto
    $link = "https://maisbarueri.com/reserva/reservations/{$reservation_id}";
    return "https://wa.me/?text=Veja%20os%20detalhes%20da%20reserva%20e%20confirme%20sua%20presença:%20" . urlencode($link);
}

}
?>
