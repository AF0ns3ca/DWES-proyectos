# Base de datos dwes_t3

## Tabla pizzas

```sql
INSERT INTO Pizza (nombre, coste, precio, ingredientes) VALUES ('Margherita', 3.00, 8.00, 'Tomate, Mozzarella, Albahaca'), ('Pepperoni', 3.50, 9.00, 'Tomate, Mozzarella, Pepperoni'), ('Hawaiana', 4.00, 10.00, 'Tomate, Mozzarella, Jamón, Piña'), ('Cuatro Quesos', 4.50, 11.00, 'Mozzarella, Queso Azul, Queso de Cabra, Parmesano'), ('Vegetariana', 3.80, 9.50, 'Tomate, Mozzarella, Pimiento, Cebolla, Champiñones, Aceitunas'), ('BBQ Chicken', 4.50, 11.00, 'Salsa BBQ, Pollo, Cebolla, Mozzarella'), ('Mexicana', 4.00, 10.50, 'Tomate, Mozzarella, Jalapeños, Carne Picada, Cebolla'), ('Marinara', 2.50, 7.50, 'Tomate, Ajo, Orégano'), ('Quattro Stagioni', 4.50, 11.50, 'Tomate, Mozzarella, Jamón, Champiñones, Alcachofas, Aceitunas'), ('Carbonara', 4.00, 10.00, 'Nata, Mozzarella, Panceta, Cebolla');
```

Introducir datos:
	Las sentencias SQL se pueden ejecutar en la pestaña SQL de phpmyadmin.

## Tabla clientes
```sql
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo_electronico VARCHAR(255) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    nombre VARCHAR(255),
    direccion VARCHAR(255)
);
```

Clientes de muestra:
```sql
INSERT INTO clientes (correo_electronico, telefono, nombre, direccion) VALUES ('mario_bros@example.com', '555-0101', 'Mario', 'Reino Champiñón 1'), ('luigi_green@example.com', '555-0102', 'Luigi', 'Reino Champiñón 2'), ('peach_castle@example.com', '555-0103', 'Peach', 'Castillo de Peach'), ('toad_mushroom@example.com', '555-0104', 'Toad', 'Casa de Toad'), ('yoshi_dino@example.com', '555-0105', 'Yoshi', 'Isla de Yoshi'), ('bowser_king@example.com', '555-0106', 'Bowser', 'Castillo de Bowser'), ('daisy_flower@example.com', '555-0107', 'Daisy', 'Reino de Sarasaland'), ('wario_gold@example.com', '555-0108', 'Wario', 'Mansión de Wario'), ('waluigi_tricky@example.com', '555-0109', 'Waluigi', 'Apartamento de Waluigi'), ('donkeykong_banana@example.com', '555-0110', 'Donkey Kong', 'Jungla DK');
```

## Tabla pedidos
```SQL
CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    fecha_pedido DATETIME,
    detalle_pedido TEXT,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id)
);
```

Pedidos de muestra:

```php
INSERT INTO Pedidos (id_cliente, fecha_pedido, detalle_pedido, total) VALUES 
(1, '2023-11-01 18:00:00', 'Pizza Margarita, Pizza Pepperoni', 19.99), 
(2, '2023-11-01 18:15:00', 'Pizza Hawaiana', 10.99), 
(3, '2023-11-01 18:30:00', 'Pizza Vegetariana', 11.99), 
(4, '2023-11-01 19:00:00', 'Pizza de Champiñones', 9.99), 
(5, '2023-11-02 17:45:00', 'Pizza de Cuatro Quesos', 12.99), 
(6, '2023-11-02 18:05:00', 'Pizza Barbacoa', 13.99), 
(7, '2023-11-02 18:20:00', 'Pizza Mexicana', 14.99), 
(8, '2023-11-02 18:40:00', 'Pizza de Atún', 11.99), 
(9, '2023-11-02 19:00:00', 'Pizza Carbonara', 12.99), 
(10, '2023-11-03 18:00:00', 'Pizza Margarita', 9.99),
(9, '2023-11-01 18:00:00', 'Pizza Margarita, Pizza Pepperoni', 19.99), 
(8, '2023-11-01 18:15:00', 'Pizza Hawaiana', 10.99), 
(7, '2023-11-01 18:30:00', 'Pizza Vegetariana', 11.99), 
(7, '2023-11-01 19:00:00', 'Pizza de Champiñones', 9.99), 
(6, '2023-11-02 17:45:00', 'Pizza de Cuatro Quesos', 12.99), 
(4, '2023-11-02 18:05:00', 'Pizza Barbacoa', 13.99), 
(7, '2023-11-02 18:20:00', 'Pizza Mexicana', 14.99), 
(8, '2023-11-02 18:40:00', 'Pizza de Atún', 11.99), 
(9, '2023-11-02 19:00:00', 'Pizza Carbonara', 12.99), 
(8, '2023-11-03 18:00:00', 'Pizza Margarita', 9.99);
```


```php
INSERT INTO Pedidos (id_cliente, fecha_pedido, detalle_pedido, total) VALUES 
(1, '2023-11-01 18:00:00', '1, 4, 8', 19.99), 
(2, '2023-11-01 18:15:00', '3, 8, 2', 10.99), 
(3, '2023-11-01 18:30:00', '1, 2, 7', 11.99), 
(4, '2023-11-01 19:00:00', '6, 8, 9', 9.99), 
(5, '2023-11-02 17:45:00', '2, 3', 12.99), 
(6, '2023-11-02 18:05:00', '8', 13.99), 
(7, '2023-11-02 18:20:00', '5, 9', 14.99), 
(8, '2023-11-02 18:40:00', '2, 5, 8', 11.99), 
(9, '2023-11-02 19:00:00', '3, 8, 9', 12.99), 
(10, '2023-11-03 18:00:00', '1, 8, 10', 9.99),
(9, '2023-11-01 18:00:00', '2, 4', 19.99), 
(8, '2023-11-01 18:15:00', '3', 10.99), 
(7, '2023-11-01 18:30:00', '3, 9', 11.99), 
(7, '2023-11-01 19:00:00', '1, 8', 9.99), 
(6, '2023-11-02 17:45:00', '5', 12.99), 
(4, '2023-11-02 18:05:00', '4, 7', 13.99), 
(7, '2023-11-02 18:20:00', '8', 14.99), 
(8, '2023-11-02 18:40:00', '1, 9', 11.99), 
(9, '2023-11-02 19:00:00', '7, 8, 9', 12.99), 
(8, '2023-11-03 18:00:00', '8, 6', 9.99);
```