-- =====================================================
-- GESTORCOMERCIAL - DATOS DE PRUEBA
-- Archivo: seed.sql
-- PostgreSQL / Supabase
-- =====================================================

-- 1. USUARIOS
INSERT INTO usuarios (nombre, correo, password, rol)
VALUES
('Camilo Orozco', 'camilo@gestorcomercial.com',
 'PENDIENTE_HASH_LARAVEL', 'administrador'),
('Chelsyn Velez', 'chelsyn@gestorcomercial.com',
 'PENDIENTE_HASH_LARAVEL', 'administrador'),
('Laura Martinez', 'laura@gestorcomercial.com',
 'PENDIENTE_HASH_LARAVEL', 'vendedor');

-- 2. CATEGORIAS
INSERT INTO categorias (nombre, descripcion)
VALUES
('Tecnología', 'Equipos y dispositivos tecnológicos'),
('Accesorios', 'Accesorios para dispositivos'),
('Oficina', 'Artículos de oficina'),
('Hogar', 'Productos para el hogar'),
('Electrodomésticos', 'Equipos eléctricos'),
('Papelería', 'Material escolar y papelería'),
('Muebles', 'Mobiliario empresarial'),
('Otros', 'Productos generales');

-- 3. PROVEEDORES
INSERT INTO proveedores
(nombre, nit, correo, telefono, ciudad)
SELECT
    'Proveedor ' || n,
    '900' || LPAD(n::TEXT, 6, '0'),
    'proveedor' || n || '@empresa.com',
    '310000' || LPAD(n::TEXT, 4, '0'),
    CASE n % 5
        WHEN 0 THEN 'Manizales'
        WHEN 1 THEN 'Bogota'
        WHEN 2 THEN 'Medellin'
        WHEN 3 THEN 'Pereira'
        ELSE 'Cali'
    END
FROM generate_series(1, 12) AS n;

-- 4. CLIENTES (40 REGISTROS)
INSERT INTO clientes
(nombre, tipo_documento, numero_documento,
 correo, telefono, direccion, ciudad)
SELECT
    'Cliente ' || n,
    'CC',
    '10' || LPAD(n::TEXT, 8, '0'),
    'cliente' || n || '@correo.com',
    '300' || LPAD(n::TEXT, 7, '0'),
    'Calle ' || n || ' # 10-20',
    CASE n % 5
        WHEN 0 THEN 'Manizales'
        WHEN 1 THEN 'Anserma'
        WHEN 2 THEN 'Pereira'
        WHEN 3 THEN 'Medellin'
        ELSE 'Bogota'
    END
FROM generate_series(1, 40) AS n;

-- 5. PRODUCTOS (50 REGISTROS)
INSERT INTO productos
(categoria_id, proveedor_id, codigo, nombre,
 descripcion, precio_compra, precio_venta,
 stock, stock_minimo)
SELECT
    ((n - 1) % 8) + 1,
    ((n - 1) % 12) + 1,
    'PROD-' || LPAD(n::TEXT, 4, '0'),
    'Producto ' || n,
    'Producto de demostracion numero ' || n,
    15000 + (n * 1250),
    ROUND((15000 + (n * 1250)) * 1.35, 2),
    10 + ((n * 7) % 60),
    5 + (n % 6)
FROM generate_series(1, 50) AS n;

-- 6. VENTAS (50 REGISTROS)
-- Cada venta tendrá dos productos.
-- Las fechas se distribuyen en los últimos 90 días.

WITH base AS (
    SELECT
        n,
        p1.id AS producto1,
        p2.id AS producto2,
        (1 + n % 4)::INTEGER AS cantidad1,
        (1 + (n + 1) % 3)::INTEGER AS cantidad2,
        p1.precio_venta AS precio1,
        p2.precio_venta AS precio2
    FROM generate_series(1, 50) AS n
    JOIN productos p1 ON p1.id = n
    JOIN productos p2 ON p2.id = ((n + 10 - 1) % 50) + 1
),
totales AS (
    SELECT
        *,
        ROUND(
            cantidad1 * precio1 + cantidad2 * precio2,
            2
        ) AS subtotal_calculado
    FROM base
)
INSERT INTO ventas
(cliente_id, usuario_id, fecha_venta, subtotal,
 descuento, impuesto, total, estado, observaciones)
SELECT
    ((n - 1) % 40) + 1,
    ((n - 1) % 3) + 1,
    NOW() - (n * INTERVAL '1 day'),
    subtotal_calculado,
    0,
    ROUND(subtotal_calculado * 0.19, 2),
    subtotal_calculado + ROUND(subtotal_calculado * 0.19, 2),
    CASE
        WHEN n <= 30 THEN 'pagada'
        WHEN n <= 40 THEN 'parcial'
        ELSE 'pendiente'
    END,
    'Venta de demostracion ' || n
FROM totales;

-- 7. DETALLE DE VENTAS (100 REGISTROS)
WITH base AS (
    SELECT
        n,
        p1.id AS producto1,
        p2.id AS producto2,
        (1 + n % 4)::INTEGER AS cantidad1,
        (1 + (n + 1) % 3)::INTEGER AS cantidad2,
        p1.precio_venta AS precio1,
        p2.precio_venta AS precio2
    FROM generate_series(1, 50) AS n
    JOIN productos p1 ON p1.id = n
    JOIN productos p2 ON p2.id = ((n + 10 - 1) % 50) + 1
)
INSERT INTO detalle_ventas
(venta_id, producto_id, cantidad,
 precio_unitario, descuento, subtotal)
SELECT
    n, producto1, cantidad1,
    precio1, 0,
    cantidad1 * precio1
FROM base

UNION ALL

SELECT
    n, producto2, cantidad2,
    precio2, 0,
    cantidad2 * precio2
FROM base;

-- 8. PAGOS (40 REGISTROS)
-- 30 ventas pagadas y 10 con pagos parciales.

INSERT INTO pagos
(venta_id, fecha_pago, monto, metodo_pago, referencia, estado)
SELECT
    id,
    fecha_venta + INTERVAL '1 hour',
    CASE
        WHEN id <= 30 THEN total
        ELSE ROUND(total * 0.50, 2)
    END,
    CASE id % 4
        WHEN 0 THEN 'efectivo'
        WHEN 1 THEN 'transferencia'
        WHEN 2 THEN 'tarjeta'
        ELSE 'otro'
    END,
    'PAGO-' || LPAD(id::TEXT, 5, '0'),
    'confirmado'
FROM ventas
WHERE id <= 40;

-- 9. AUDITORIA (50 REGISTROS)
INSERT INTO auditoria
(usuario_id, accion, tabla_afectada,
 registro_id, descripcion, datos_nuevos)
SELECT
    ((n - 1) % 3) + 1,
    CASE n % 4
        WHEN 0 THEN 'INSERT'
        WHEN 1 THEN 'UPDATE'
        WHEN 2 THEN 'CONSULTA'
        ELSE 'REGISTRO'
    END,
    CASE n % 3
        WHEN 0 THEN 'productos'
        WHEN 1 THEN 'clientes'
        ELSE 'ventas'
    END,
    n,
    'Operacion de demostracion numero ' || n,
    jsonb_build_object(
        'numero_operacion', n,
        'origen', 'seed.sql'
    )
FROM generate_series(1, 50) AS n;

-- =====================================================
-- FIN DE LA POBLACION INICIAL
-- =====================================================