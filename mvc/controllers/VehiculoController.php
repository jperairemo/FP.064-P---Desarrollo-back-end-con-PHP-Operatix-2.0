<?php
// Incluir el modelo de Vehiculo para interactuar con la base de datos
require_once __DIR__ . '/../models/Vehiculo.php';

// Controlador para las operaciones relacionadas con los vehículos
class VehiculoController {

    // Método para listar todos los vehículos
    public function listarVehiculos() {
        global $pdo;

        try {
            // Ejecutamos la consulta para obtener todos los vehículos
            $stmt = $pdo->query("SELECT * FROM transfer_vehiculo");

            // Mostramos los vehículos
            while ($fila = $stmt->fetch()) {
                // Creamos un objeto Vehiculo por cada fila de la base de datos
                $vehiculo = new Vehiculo(
                    $fila['id_vehiculo'],
                    $fila['Descripcion'],
                    $fila['email_conductor'],
                    $fila['password']
                );

                // Aquí puedes mostrar los detalles de cada vehículo o pasarlos a una vista
                echo "Vehículo ID: " . $vehiculo->getIdVehiculo() . " - Descripción: " . $vehiculo->getDescripcion() . "<br>";
            }

        } catch (PDOException $e) {
            echo "Error al obtener los vehículos: " . $e->getMessage();
        }
    }

    // Método para ver los detalles de un vehículo específico
    public function verVehiculo($id_vehiculo) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM transfer_vehiculo WHERE id_vehiculo = ?");
            $stmt->execute([$id_vehiculo]);

            $fila = $stmt->fetch();

            if ($fila) {
                // Creamos el objeto Vehiculo con los datos encontrados
                $vehiculo = new Vehiculo(
                    $fila['id_vehiculo'],
                    $fila['Descripcion'],
                    $fila['email_conductor'],
                    $fila['password']
                );

                // Mostrar detalles del vehículo
                echo "ID Vehículo: " . $vehiculo->getIdVehiculo() . "<br>";
                echo "Descripción: " . $vehiculo->getDescripcion() . "<br>";
                echo "Email Conductor: " . $vehiculo->getEmailConductor() . "<br>";
                // Otros detalles de interés aquí
            } else {
                echo "Vehículo no encontrado.";
            }

        } catch (PDOException $e) {
            echo "Error al obtener los detalles del vehículo: " . $e->getMessage();
        }
    }

    // Método para registrar un nuevo vehículo (admin)
    public function registrarVehiculo($data) {
        global $pdo;

        // Validamos los datos antes de insertarlos
        if (!isset($data['descripcion'], $data['email_conductor'], $data['password'])) {
            echo "Faltan datos necesarios.";
            return;
        }

        // Usamos un statement preparado para evitar inyecciones SQL
        $stmt = $pdo->prepare("INSERT INTO transfer_vehiculo (Descripcion, email_conductor, password) VALUES (?, ?, ?)");

        // Ejecutamos la consulta con los valores del formulario
        $stmt->execute([
            $data['descripcion'], 
            $data['email_conductor'], 
            $data['password']
        ]);

        echo "Vehículo registrado con éxito.";
    }

    // Método para actualizar la información de un vehículo
    public function actualizarVehiculo($data) {
        global $pdo;

        // Verificamos que tengamos los datos necesarios para la actualización
        if (!isset($data['id_vehiculo'], $data['descripcion'], $data['email_conductor'], $data['password'])) {
            echo "Faltan datos para actualizar el vehículo.";
            return;
        }

        // Usamos un statement preparado para evitar inyecciones SQL
        $stmt = $pdo->prepare("UPDATE transfer_vehiculo SET Descripcion = ?, email_conductor = ?, password = ? WHERE id_vehiculo = ?");

        // Ejecutamos la consulta para actualizar la fila correspondiente
        $stmt->execute([
            $data['descripcion'], 
            $data['email_conductor'], 
            $data['password'],
            $data['id_vehiculo']
        ]);

        echo "Vehículo actualizado con éxito.";
    }
}
?>
