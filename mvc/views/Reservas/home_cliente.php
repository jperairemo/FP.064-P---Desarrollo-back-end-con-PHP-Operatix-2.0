<!-- home_cliente.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Codificación de caracteres UTF-8 para soportar caracteres especiales -->
    <meta charset="UTF-8">
    
    <!-- Meta para que la página sea responsiva -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Título de la página -->
    <title>Panel de Cliente</title>
    
    <!-- Enlace a los estilos CSS para dar formato a la página -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Título principal de la página -->
    <h2>Bienvenido al Panel de Cliente</h2>

    <!-- Mensaje introductorio -->
    <p>Desde este panel, puedes gestionar tus reservas, editar tu perfil y más.</p>

    <!-- Menú de opciones -->
    <div class="menu">
        <ul>
            <li><a href="mis_reservas.php">Mis Reservas</a></li>
            <li><a href="crear_reserva_cliente.php">Crear Nueva Reserva</a></li>
            <li><a href="perfil.php">Editar Perfil</a></li>
        </ul>
    </div>

    <!-- Enlace para cerrar sesión -->
    <p><a href="logout.php">Cerrar sesión</a></p>

</body>
</html>
