<!-- login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Esta línea establece la codificación de caracteres del documento en UTF-8, 
         lo que permite que se muestren correctamente caracteres especiales en español -->
    <meta charset="UTF-8">
    
    <!-- Esta meta etiqueta define la vista del dispositivo (responsiva). 
         Asegura que el diseño se ajuste según el tamaño de la pantalla del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- El título de la página que aparecerá en la pestaña del navegador -->
    <title>Iniciar sesión</title>
    
    <!-- Aquí se incluye una hoja de estilos CSS externa para darle formato a la página -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Título principal de la página que aparece en la parte superior -->
    <h2>Iniciar sesión</h2>

    <!-- Formulario donde el usuario ingresará su correo electrónico y contraseña -->
    <form action="login.php" method="POST">
        
        <!-- Etiqueta de texto para el campo de correo -->
        <label for="email">Correo electrónico:</label>
        
        <!-- Campo de entrada para el correo electrónico -->
        <!-- El atributo 'required' significa que este campo es obligatorio -->
        <input type="email" id="email" name="email" required>
        
        <!-- Etiqueta de texto para el campo de contraseña -->
        <label for="password">Contraseña:</label>
        
        <!-- Campo de entrada para la contraseña -->
        <!-- También tiene el atributo 'required', por lo que el usuario no podrá dejarlo vacío -->
        <input type="password" id="password" name="password" required>
        
        <!-- Botón para enviar el formulario -->
        <button type="submit" name="submit">Iniciar sesión</button>
    </form>

    <!-- Este bloque PHP se utiliza para mostrar un error si se pasa desde el controlador -->
    <?php
    // Verifica si existe la variable $error, que es pasada desde el controlador en caso de un fallo en el inicio de sesión
    if (isset($error)) {
        // Si existe el error, lo mostramos dentro de un <p> con color rojo
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <!-- Enlace para dirigir al usuario a la página de registro si aún no tiene cuenta -->
    <p>Aún no tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    
</body>
</html>
