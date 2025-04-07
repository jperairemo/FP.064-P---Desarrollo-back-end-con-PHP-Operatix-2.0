<?php
// Incluir el modelo de Cliente
require_once __DIR__ . '/../models/Cliente.php';

// Controlador para manejar las operaciones relacionadas con los clientes
class ClienteController {

    // Método para crear un nuevo cliente (registro)
    public function registrarCliente($data) {
        global $pdo;

        // Validamos que tengamos los datos necesarios
        if (!isset($data['nombre'], $data['correo'], $data['password'], $data['tipo'])) {
            echo "Faltan datos para registrar el cliente.";
            return;
        }

        // Usamos un statement preparado para evitar inyecciones SQL
        $stmt = $pdo->prepare("INSERT INTO transfer_viajeros (nombre, apellido1, apellido2, direccion, codigoPostal,
                                ciudad, pais, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Ejecutamos la consulta con los valores del formulario
        $stmt->execute([
            $data['nombre'], 
            $data['apellido1'], 
            $data['apellido2'],
            $data['direccion'],
            $data['codigoPostal'],
            $data['ciudad'],
            $data['pais'],
            $data['correo'],
            password_hash($data['password'], PASSWORD_BCRYPT)  // Encriptamos la contraseña antes de guardarla
        ]);

        echo "Cliente registrado con éxito.";
    }

    // Método para listar todos los clientes (solo para administradores)
    public function listarClientes() {
        global $pdo;

        try {
            $stmt = $pdo->query("SELECT * FROM transfer_viajeros");

            // Mostramos la lista de clientes
            while ($fila = $stmt->fetch()) {
                $cliente = new Cliente(
                    $fila['id_viajero'],
                    $fila['nombre'],
                    $fila['apellido1'],
                    $fila['apellido2'],
                    $fila['direccion'],
                    $fila['codigoPostal'],
                    $fila['ciudad'],
                    $fila['pais'],
                    $fila['email'],
                    $fila['password']
                );

                // Aquí podemos mostrar los detalles de cada cliente o devolverlos a la vista
                echo "Cliente: " . $cliente->getNombre() . " " . $cliente->getApellido1() . "<br>";
            }

        } catch (PDOException $e) {
            echo "Error al obtener los clientes: " . $e->getMessage();
        }
    }

    // Método para ver detalles de un cliente específico
    public function verCliente($id_cliente) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM transfer_viajeros WHERE id_viajero = ?");
            $stmt->execute([$id_cliente]);

            $fila = $stmt->fetch();

            if ($fila) {
                $cliente = new Cliente(
                    $fila['id_viajero'],
                    $fila['nombre'],
                    $fila['apellido1'],
                    $fila['apellido2'],
                    $fila['direccion'],
                    $fila['codigoPostal'],
                    $fila['ciudad'],
                    $fila['pais'],
                    $fila['email'],
                    $fila['password']
                );

                // Mostrar los detalles del cliente
                echo "Nombre: " . $cliente->getNombre() . "<br>";
                echo "Apellido: " . $cliente->getApellido1() . "<br>";
                echo "Correo: " . $cliente->getEmail() . "<br>";
                // Aquí puedes mostrar más detalles según sea necesario
            } else {
                echo "Cliente no encontrado.";
            }

        } catch (PDOException $e) {
            echo "Error al obtener los detalles del cliente: " . $e->getMessage();
        }
    }

    // Método para autenticar a un cliente (Login)
    public function autenticarCliente($correo, $password) {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
            $stmt->execute([$correo]);

            $fila = $stmt->fetch();

            if ($fila && password_verify($password, $fila['password'])) {
                // Si las contraseñas coinciden
                echo "Bienvenido " . $fila['nombre'];
                // Aquí podrías guardar una sesión o hacer algún redireccionamiento
            } else {
                echo "Credenciales incorrectas.";
            }

        } catch (PDOException $e) {
            echo "Error al autenticar el cliente: " . $e->getMessage();
        }
    }
}
?>
