<?php 
$mysqli = new mysqli('localhost', 'root', 'pass', 'base de datos');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Crear reserva
function createReservation($cliente, $fecha, $destino) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO reservas (cliente, fecha, destino) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $cliente, $fecha, $destino);
    $stmt->execute();
    $stmt->close();
}

// Leer todas las reservas
function getReservations() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, cliente, fecha, destino FROM reservas");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Leer una reserva específica
function getReservation($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT id, cliente, fecha, destino FROM reservas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Actualizar reserva
function updateReservation($id, $cliente, $fecha, $destino) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE reservas SET cliente = ?, fecha = ?, destino = ? WHERE id = ?");
    $stmt->bind_param("sssi", $cliente, $fecha, $destino, $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar reserva
function deleteReservation($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM reservas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
