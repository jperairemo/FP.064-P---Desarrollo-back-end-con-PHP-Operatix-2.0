<!-- listar.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Codificación de caracteres UTF-8 para soportar caracteres especiales -->
    <meta charset="UTF-8">
    
    <!-- Meta para que la página sea responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Título de la página -->
    <title>Lista de Reservas</title>
    
    <!-- Enlace a los estilos CSS para dar formato a la página -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Encabezado con el título de la página -->
    <header>
        <h1>Lista de Reservas</h1>
    </header>

    <div class="reservas">
        <!-- Si existen reservas, las mostramos -->
        <?php if (!empty($reservas) && is_array($reservas)): ?>
            <!-- Iteramos a través de todas las reservas -->
            <?php foreach ($reservas as $reserva): ?>
                <!-- Verificamos si la reserva pertenece al cliente actual -->
                <?php if (isset($_SESSION['email_cliente']) && isset($reserva['email_cliente']) && $reserva['email_cliente'] === $_SESSION['email_cliente']): ?>
                <div class="reserva">
                    <h3>Reserva: <?= htmlspecialchars($reserva['localizador']) ?></h3>
                    <p><strong>Hotel:</strong> <?= htmlspecialchars($reserva['id_hotel']) ?></p>
                    <p><strong>Fecha de Reserva:</strong> <?= htmlspecialchars($reserva['fecha_reserva']) ?></p>
                    <p><strong>Fecha de Modificación:</strong> <?= htmlspecialchars($reserva['fecha_modificacion']) ?></p>
                    <p><strong>Fecha de Entrada:</strong> <?= htmlspecialchars($reserva['fecha_entrada']) ?> <?= htmlspecialchars($reserva['hora_entrada']) ?></p>
                    <p><strong>Origen del Vuelo:</strong> <?= htmlspecialchars($reserva['origen_vuelo_entrada']) ?></p>
                    <p><strong>Fecha de Vuelo de Salida:</strong> <?= htmlspecialchars($reserva['fecha_vuelo_salida']) ?></p>
                    <p><strong>Hora del Vuelo de Salida:</strong> <?= htmlspecialchars($reserva['hora_vuelo_salida']) ?></p>
                    <p><strong>Hora de Recogida:</strong> <?= htmlspecialchars($reserva['hora_recogida']) ?></p>
                    <p><strong>Número de Viajeros:</strong> <?= htmlspecialchars($reserva['num_viajeros']) ?></p>
                    <p><strong>Vehículo:</strong> <?= htmlspecialchars($reserva['id_vehiculo']) ?></p>
                    <p><strong>Número de Vuelo:</strong> <?= htmlspecialchars($reserva['numero_vuelo']) ?></p>

                    <!-- Botón de Cancelar con verificación de 48 horas -->
                    <?php if ($reserva['cancelable']): ?>
                        <a href="eliminar_reserva.php?id=<?= urlencode($reserva['id_reserva']) ?>">
                            <button>Cancelar Reserva</button>
                        </a>
                        <a href="modificar_reserva.php?id=<?= urlencode($reserva['id_reserva']) ?>">
                            <button>Modificar Reserva</button>
                        </a>
                    <?php else: ?>
                        <button disabled>Cancelar no disponible (menos de 48 horas)</button>
                        <button disabled>Modificar no disponible (menos de 48 horas)</button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Mensaje si no hay reservas disponibles -->
            <p>No tienes reservas disponibles.</p>
        <?php endif; ?>
    </div>

    <!-- Enlace para volver al menú del usuario -->
    <div class="volver-menu">
        <a href="home_cliente.php">
            Volver al Menú del Usuario
        </a>
    </div>

</body>
</html>
