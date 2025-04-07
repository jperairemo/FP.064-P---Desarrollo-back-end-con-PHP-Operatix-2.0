<?php
// Incluimos el modelo de Reserva para interactuar con la base de datos
require_once __DIR__ . '/../models/Reserva.php';

// Controlador para las operaciones relacionadas con las reservas
class ReservaController {

    // Método para listar todas las reservas
    public function listarReservas() {
        // Aquí conectaremos con la base de datos y recuperamos las reservas
        // Suponiendo que tenemos una conexión PDO ya configurada

        global $pdo; // Usamos la variable PDO global de la conexión

        try {
            // Ejecutamos una consulta para obtener todas las reservas
            $stmt = $pdo->query("SELECT * FROM transfer_reservas");

            // Mostramos las reservas
            while ($fila = $stmt->fetch()) {
                // Creamos un objeto Reserva por cada fila de datos
                $reserva = new Reserva(
                    $fila['id_reserva'],
                    $fila['localizador'],
                    $fila['id_hotel'],
                    $fila['id_tipo_reserva'],
                    $fila['email_cliente'],
                    $fila['fecha_reserva'],
                    $fila['fecha_modificacion'],
                    $fila['id_destino'],
                    $fila['fecha_entrada'],
                    $fila['hora_entrada'],
                    $fila['numero_vuelo_entrada'],
                    $fila['origen_vuelo_entrada'],
                    $fila['hora_vuelo_salida'],
                    $fila['fecha_vuelo_salida'],
                    $fila['num_viajeros'],
                    $fila['id_vehiculo']
                );

                // Aquí podrías hacer algo con $reserva, como mostrarla en una vista
                echo "Reserva Localizador: " . $reserva->getLocalizador() . "<br>";
                // Y de aquí seguiría mostrando más detalles de la reserva según se necesite
            }

        } catch (PDOException $e) {
            echo "Error al obtener las reservas: " . $e->getMessage();
        }
    }

    // Método para crear una nueva reserva
    public function crearReserva($data) {
        global $pdo;

        // Validamos los datos antes de insertarlos
        if (!isset($data['localizador'], $data['id_hotel'], $data['email_cliente'])) {
            echo "Faltan datos necesarios.";
            return;
        }

        // Usamos un statement preparado para evitar inyecciones SQL
        $stmt = $pdo->prepare("INSERT INTO transfer_reservas (localizador, id_hotel, id_tipo_reserva, email_cliente,
                                fecha_reserva, fecha_modificacion, id_destino, fecha_entrada, hora_entrada,
                                numero_vuelo_entrada, origen_vuelo_entrada, hora_vuelo_salida, fecha_vuelo_salida,
                                num_viajeros, id_vehiculo) 
                                VALUES (?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Ejecutamos la consulta con los valores del formulario
        $stmt->execute([
            $data['localizador'], 
            $data['id_hotel'], 
            $data['id_tipo_reserva'],
            $data['email_cliente'],
            $data['id_destino'],
            $data['fecha_entrada'],
            $data['hora_entrada'],
            $data['numero_vuelo_entrada'],
            $data['origen_vuelo_entrada'],
            $data['hora_vuelo_salida'],
            $data['fecha_vuelo_salida'],
            $data['num_viajeros'],
            $data['id_vehiculo']
        ]);

        echo "Reserva creada con éxito.";
    }

    // Método para mostrar detalles de una reserva específica
    public function verReserva($id_reserva) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM transfer_reservas WHERE id_reserva = ?");
            $stmt->execute([$id_reserva]);

            $fila = $stmt->fetch();

            if ($fila) {
                $reserva = new Reserva(
                    $fila['id_reserva'],
                    $fila['localizador'],
                    $fila['id_hotel'],
                    $fila['id_tipo_reserva'],
                    $fila['email_cliente'],
                    $fila['fecha_reserva'],
                    $fila['fecha_modificacion'],
                    $fila['id_destino'],
                    $fila['fecha_entrada'],
                    $fila['hora_entrada'],
                    $fila['numero_vuelo_entrada'],
                    $fila['origen_vuelo_entrada'],
                    $fila['hora_vuelo_salida'],
                    $fila['fecha_vuelo_salida'],
                    $fila['num_viajeros'],
                    $fila['id_vehiculo']
                );

                // Aquí puedes mostrar los detalles de la reserva en la vista
                echo "Detalles de la reserva: <br>";
                echo "Localizador: " . $reserva->getLocalizador() . "<br>";
                // Mostrar más detalles según necesites...
            } else {
                echo "Reserva no encontrada.";
            }

        } catch (PDOException $e) {
            echo "Error al obtener la reserva: " . $e->getMessage();
        }
    }
}
?>
