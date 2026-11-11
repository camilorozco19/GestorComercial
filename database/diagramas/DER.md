# Diagrama Entidad-Relación (DER) – GestorComercial

El siguiente diagrama representa la estructura relacional de la base de datos PostgreSQL del sistema GestorComercial, alojada en Supabase.

```mermaid
erDiagram
    USUARIOS {
        bigint id PK
        varchar nombre
        varchar correo UK
        varchar password
        varchar rol
        boolean activo
    }

    CATEGORIAS {
        bigint id PK
        varchar nombre UK
        text descripcion
        boolean activo
    }

    PROVEEDORES {
        bigint id PK
        varchar nombre
        varchar nit UK
        varchar correo
        varchar telefono
        varchar ciudad
        boolean activo
    }

    CLIENTES {
        bigint id PK
        varchar nombre
        varchar tipo_documento
        varchar numero_documento UK
        varchar correo
        varchar telefono
        varchar ciudad
        boolean activo
    }

    PRODUCTOS {
        bigint id PK
        bigint categoria_id FK
        bigint proveedor_id FK
        varchar codigo UK
        varchar nombre
        numeric precio_compra
        numeric precio_venta
        integer stock
        integer stock_minimo
        boolean activo
    }

    VENTAS {
        bigint id PK
        bigint cliente_id FK
        bigint usuario_id FK
        timestamptz fecha_venta
        numeric subtotal
        numeric descuento
        numeric impuesto
        numeric total
        varchar estado
    }

    DETALLE_VENTAS {
        bigint id PK
        bigint venta_id FK
        bigint producto_id FK
        integer cantidad
        numeric precio_unitario
        numeric descuento
        numeric subtotal
    }

    PAGOS {
        bigint id PK
        bigint venta_id FK
        timestamptz fecha_pago
        numeric monto
        varchar metodo_pago
        varchar estado
    }

    AUDITORIA {
        bigint id PK
        bigint usuario_id FK
        varchar accion
        varchar tabla_afectada
        bigint registro_id
        jsonb datos_anteriores
        jsonb datos_nuevos
        timestamptz fecha_evento
    }

    CATEGORIAS ||--o{ PRODUCTOS : clasifica
    PROVEEDORES o|--o{ PRODUCTOS : suministra
    CLIENTES ||--o{ VENTAS : realiza
    USUARIOS ||--o{ VENTAS : registra
    VENTAS ||--|{ DETALLE_VENTAS : contiene
    PRODUCTOS ||--o{ DETALLE_VENTAS : aparece_en
    VENTAS ||--o{ PAGOS : recibe
    USUARIOS o|--o{ AUDITORIA : genera
```

## Descripción de las relaciones

| Relación | Cardinalidad | Descripción |
|---|---|---|
| Categorías – Productos | 1:N | Una categoría puede clasificar varios productos. |
| Proveedores – Productos | 1:N | Un proveedor puede suministrar varios productos. |
| Clientes – Ventas | 1:N | Un cliente puede realizar varias ventas. |
| Usuarios – Ventas | 1:N | Un usuario puede registrar varias ventas. |
| Ventas – Detalle de ventas | 1:N | Una venta contiene sus respectivos detalles. |
| Productos – Detalle de ventas | 1:N | Un producto puede aparecer en varios detalles de venta. |
| Ventas – Pagos | 1:N | Una venta puede tener varios pagos. |
| Usuarios – Auditoría | 1:N | Un usuario puede generar varios registros de auditoría. |

**Convenciones:**
- PK: clave primaria.
- FK: clave foránea.
- UK: campo con restricción de unicidad.
- 1:N: relación uno a muchos.