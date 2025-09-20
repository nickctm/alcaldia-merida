<?php
// Define una variable para el título de la página
$pageTitle = "Registro de Usuario - Alcaldía de Mérida";

// Inicia el procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopila y sanitiza los datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $document_type = htmlspecialchars($_POST['document_type']);
    $document_number = htmlspecialchars($_POST['document_number']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $gender = htmlspecialchars($_POST['gender']);
    $address = htmlspecialchars($_POST['address']);
    $neighborhood = htmlspecialchars($_POST['neighborhood']);
    $municipality = htmlspecialchars($_POST['municipality']);
    $department = htmlspecialchars($_POST['department']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $socioeconomic_status = htmlspecialchars($_POST['socioeconomic_status']);
    $occupation = htmlspecialchars($_POST['occupation']);
    $family_members = htmlspecialchars($_POST['family_members']);

    // Combina los datos en una línea de texto separada por |
    $data_to_save = implode('|', [
        $name, $lastname, $document_type, $document_number, $birthdate, $gender, 
        $address, $neighborhood, $municipality, $department, $phone, $email, 
        $socioeconomic_status, $occupation, $family_members
    ]);

    // Guarda los datos en el archivo temporal
    file_put_contents('datos_temporales.txt', $data_to_save . PHP_EOL, FILE_APPEND | LOCK_EX);

    // Redirige al usuario al siguiente paso, pasando el email en la URL
    header("Location: registro.php?email=" . urlencode($email));
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styleFormReg.css">
</head>
<body>
    <div class="registration-container">
        <h2>Registro de Usuario</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="registration-form">
            
            <div class="form-section">
                <h3>Información Personal</h3>
                <div class="form-group">
                    <label for="name">Nombres <span style="color: red;">*</span></label>
                    <input type="text" id="name" name="name" placeholder="Ej. Juan Carlos" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Apellidos <span style="color: red;">*</span></label>
                    <input type="text" id="lastname" name="lastname" placeholder="Ej. Pérez Gómez" required>
                </div>
                <div class="form-group">
                    <label for="document_type">Tipo de Documento <span style="color: red;">*</span></label>
                    <select id="document_type" name="document_type" required>
                        <option value="">Selecciona una opción</option>
                        <option value="cedula">Cédula de Ciudadanía</option>
                        <option value="tarjeta">Tarjeta de Identidad</option>
                        <option value="pasaporte">Pasaporte</option>
                        <option value="extranjeria">Cédula de Extranjería</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="document_number">Número de Documento <span style="color: red;">*</span></label>
                    <input type="number" id="document_number" name="document_number" placeholder="Ej. 12345678" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento <span style="color: red;">*</span></label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="form-group">
                    <label for="gender">Género <span style="color: red;">*</span></label>
                    <select id="gender" name="gender" required>
                        <option value="">Selecciona una opción</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h3>Información de Contacto</h3>
                <div class="form-group">
                    <label for="address">Dirección de Residencia <span style="color: red;">*</span></label>
                    <input type="text" id="address" name="address" placeholder="Ej. Calle 10 # 5-20" required>
                </div>
                <div class="form-group">
                    <label for="neighborhood">Barrio/Vereda <span style="color: red;">*</span></label>
                    <input type="text" id="neighborhood" name="neighborhood" placeholder="Ej. El Centro" required>
                </div>
                <div class="form-group">
                    <label for="municipality">Municipio <span style="color: red;">*</span></label>
                    <input type="text" id="municipality" name="municipality" placeholder="Ej. Mérida" required>
                </div>
                <div class="form-group">
                    <label for="department">Departamento <span style="color: red;">*</span></label>
                    <input type="text" id="department" name="department" placeholder="Ej. Mérida" required>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono <span style="color: red;">*</span></label>
                    <input type="number" id="phone" name="phone" placeholder="Ej. 04141234567" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico <span style="color: red;">*</span></label>
                    <input type="email" id="email" name="email" placeholder="Ej. tunombre@correo.com" required>
                </div>
            </div>

            <div class="form-section">
                <h3>Información Adicional</h3>
                <div class="form-group">
                    <label for="socioeconomic_status">Estrato Socioeconómico <span style="color: red;">*</span></label>
                    <select id="socioeconomic_status" name="socioeconomic_status" required>
                        <option value="">Selecciona una opción</option>
                        <option value="1">Estrato 1 (Bajo-bajo)</option>
                        <option value="2">Estrato 2 (Bajo)</option>
                        <option value="3">Estrato 3 (Medio-bajo)</option>
                        <option value="4">Estrato 4 (Medio)</option>
                        <option value="5">Estrato 5 (Medio-alto)</option>
                        <option value="6">Estrato 6 (Alto)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="occupation">Ocupación <span style="color: red;">*</span></label>
                    <input type="text" id="occupation" name="occupation" placeholder="Ej. Estudiante, Ingeniero, Ama de Casa" required>
                </div>
                <div class="form-group">
                    <label for="family_members">Número de Familiares en Casa <span style="color: red;">*</span></label>
                    <input type="number" id="family_members" name="family_members" placeholder="Ej. 4" required>
                </div>
            </div>

            <button type="submit" class="btn">Continuar</button>
        </form>
    </div>
</body>
</html>