
CREATE TABLE personas (
    id INT AUTO_INCREMENT PRIMARY KEY,           -- Identificador único autoincremental
    cedula VARCHAR(15) NOT NULL UNIQUE,          -- Cédula de identidad única
    nacionalidad ENUM('Venezolano', 'Extranjero') NOT NULL,  -- Nacionalidad con valores predefinidos
    nombres VARCHAR(100) NOT NULL,               -- Nombres de la persona
    apellidos VARCHAR(100) NOT NULL,             -- Apellidos de la persona
    nombre_completo VARCHAR(200) AS (CONCAT(nombres, ' ', apellidos)) STORED,  -- Concatenación de nombres y apellidos
    fecha_nacimiento DATE NOT NULL,              -- Fecha de nacimiento
    sexo ENUM('Masculino', 'Femenino') NOT NULL, -- Sexo con opciones predefinidas
    estado_civil ENUM('Soltero', 'Casado', 'Divorciado', 'Viudo') NOT NULL,  -- Estado civil con opciones predefinidas
    estado ENUM('Distrito Capital', 'Miranda') NOT NULL,  -- Estado limitado a dos opciones
    municipio ENUM('Libertador', 'Chacao', 'Baruta', 'Sucre') NOT NULL, -- Municipios según el estado
    parroquia ENUM('San Juan', 'Santa Teresa', 'El Valle', 'Chacao', 'El Cafetal', 'Las Minas', 'Petare', 'La Urbina') NOT NULL, -- Parroquias según el municipio
    direccion TEXT NOT NULL,                     -- Dirección (puede ser varias líneas)
    telefonos VARCHAR(50),                       -- Teléfonos de la persona
    correo_electronico VARCHAR(100) UNIQUE,      -- Correo electrónico único
    cantidad_hijos INT DEFAULT 0,                -- Cantidad de hijos, con valor por defecto de 0
    sueldo_actual DECIMAL(10, 2) DEFAULT 0,      -- Sueldo actual
    foto BLOB                                    -- Foto opcional, almacenada como BLOB (bytes)
);