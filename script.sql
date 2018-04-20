CREATE TABLE categoria
(
  idCategoria          INT AUTO_INCREMENT
    PRIMARY KEY,
  categoria            VARCHAR(45)  NULL,
  descripcionCategoria VARCHAR(200) NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE cliente
(
  idCliente        INT AUTO_INCREMENT
    PRIMARY KEY,
  nombresCliente   VARCHAR(45) NULL,
  apellidosCliente VARCHAR(45) NULL,
  direccionCliente VARCHAR(45) NULL,
  nitCliente       VARCHAR(45) NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE combo
(
  idCombo          INT AUTO_INCREMENT
    PRIMARY KEY,
  descripcionCombo VARCHAR(45) NULL,
  precioCombo      FLOAT       NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE detallecombo
(
  idProducto INT AUTO_INCREMENT,
  idCombo    INT NOT NULL,
  PRIMARY KEY (idProducto, idCombo),
  CONSTRAINT fk_producto_has_combo_combo1
  FOREIGN KEY (idCombo) REFERENCES combo (idCombo)
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_producto_has_combo_combo1_idx
  ON detallecombo (idCombo);

CREATE TABLE detalleorden
(
  idDetalleOrden     INT AUTO_INCREMENT
    PRIMARY KEY,
  idOrden            INT             NOT NULL,
  idProducto         INT             NOT NULL,
  idCombo            INT             NULL,
  estadoDetalleOrden INT DEFAULT '0' NOT NULL,
  cantDetalleOrden   INT             NOT NULL,
  notaDetalleOrden   VARCHAR(200)    NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_detalleOrden_orden1_idx
  ON detalleorden (idOrden);

CREATE INDEX fk_detalleOrden_producto1_idx
  ON detalleorden (idProducto);

CREATE TABLE detalleproducto
(
  idDetalleProducto INT AUTO_INCREMENT
    PRIMARY KEY,
  idIngrediente     INT NOT NULL,
  idProducto        INT NOT NULL,
  cantIngrediente   INT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_ingrediente_has_producto_ingrediente1_idx
  ON detalleproducto (idIngrediente);

CREATE INDEX fk_ingrediente_has_producto_producto1_idx
  ON detalleproducto (idProducto);

CREATE TABLE empleado
(
  idEmpleado        INT AUTO_INCREMENT
    PRIMARY KEY,
  nombresEmpleado   VARCHAR(45) NULL,
  apellidosEmpleado VARCHAR(45) NULL,
  direccionEmpleado VARCHAR(45) NULL,
  telefonoEmpleado  INT         NULL,
  emailEmpleado     VARCHAR(45) NULL,
  idTipoEmpleado    INT         NOT NULL,
  idTurno           INT         NOT NULL,
  estado            INT(1)      NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_empleado_tipoempleado_idx
  ON empleado (idTipoEmpleado);

CREATE INDEX fk_empleado_turno1_idx
  ON empleado (idTurno);

CREATE TABLE estadomesa
(
  idEstadoMesa INT AUTO_INCREMENT
    PRIMARY KEY,
  estadoMesa   TINYINT(1) NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE ingrediente
(
  idIngrediente          INT AUTO_INCREMENT
    PRIMARY KEY,
  ingrediente            VARCHAR(45)    NULL,
  descripcionIngrediente VARCHAR(200)   NULL,
  costoIngrediente       DECIMAL(10, 2) NULL,
  cantIngrediente        INT            NULL,
  fechaIngreso           DATE           NULL,
  imagen                 LONGBLOB       NULL,
  medida                 VARCHAR(55)    NOT NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

ALTER TABLE detalleproducto
  ADD CONSTRAINT fk_ingrediente_has_producto_ingrediente1
FOREIGN KEY (idIngrediente) REFERENCES ingrediente (idIngrediente)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

CREATE TABLE mesa
(
  idMesa          INT AUTO_INCREMENT
    PRIMARY KEY,
  noMesa          INT             NULL,
  ubicacionMesa   VARCHAR(45)     NULL,
  descripcionMesa VARCHAR(100)    NULL,
  ocupada         INT DEFAULT '0' NOT NULL,
  estado          INT(1)          NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE orden
(
  idOrden     INT AUTO_INCREMENT
    PRIMARY KEY,
  idMesa      INT          NOT NULL,
  fechaOrden  DATE         NULL,
  horaOrden   TIME         NOT NULL,
  totalOrden  FLOAT        NULL,
  idEmpleado  INT          NOT NULL,
  estadoOrden INT          NOT NULL,
  aliasMesa   VARCHAR(100) NULL,
  CONSTRAINT fk_orden_mesa1
  FOREIGN KEY (idMesa) REFERENCES mesa (idMesa)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT orden_ibfk_1
  FOREIGN KEY (idEmpleado) REFERENCES empleado (idEmpleado)
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_orden_mesa1_idx
  ON orden (idMesa);

CREATE INDEX fk_orden_empleado1_idx
  ON orden (idEmpleado);

ALTER TABLE detalleorden
  ADD CONSTRAINT fk_detalleOrden_orden1
FOREIGN KEY (idOrden) REFERENCES orden (idOrden)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

CREATE TABLE producto
(
  idProducto          INT AUTO_INCREMENT
    PRIMARY KEY,
  producto            VARCHAR(45)    NULL,
  descripcionProducto VARCHAR(200)   NULL,
  costoProducto       DECIMAL(10, 2) NULL,
  precioProducto      DECIMAL(10, 2) NULL,
  cantProducto        INT            NULL,
  idCategoria         INT            NOT NULL,
  imagen              VARCHAR(255)   NULL,
  CONSTRAINT fk_producto_area1
  FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_producto_area1_idx
  ON producto (idCategoria);

ALTER TABLE detallecombo
  ADD CONSTRAINT fk_producto_has_combo_producto1
FOREIGN KEY (idProducto) REFERENCES producto (idProducto);

ALTER TABLE detalleorden
  ADD CONSTRAINT fk_detalleOrden_producto1
FOREIGN KEY (idProducto) REFERENCES producto (idProducto);

ALTER TABLE detalleproducto
  ADD CONSTRAINT fk_ingrediente_has_producto_producto1
FOREIGN KEY (idProducto) REFERENCES producto (idProducto)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

CREATE TABLE restaurante
(
  idRestaurante        INT AUTO_INCREMENT
    PRIMARY KEY,
  nombreRestaurante    VARCHAR(45) NULL,
  direccionRestaurante VARCHAR(50) NULL,
  telefonoRestuarante  INT         NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE TABLE tipoempleado
(
  idTipoEmpleado INT AUTO_INCREMENT
    PRIMARY KEY,
  tipoEmpleado   VARCHAR(45) NULL,
  idCategoria    INT         NOT NULL,
  estado         INT(1)      NULL,
  CONSTRAINT fk_tipoempleado_categoria1
  FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX fk_tipoempleado_categoria1_idx
  ON tipoempleado (idCategoria);

ALTER TABLE empleado
  ADD CONSTRAINT fk_empleado_tipoempleado
FOREIGN KEY (idTipoEmpleado) REFERENCES tipoempleado (idTipoEmpleado)
  ON UPDATE CASCADE
  ON DELETE CASCADE;

CREATE TABLE turno
(
  idTurno     INT AUTO_INCREMENT
    PRIMARY KEY,
  inicioTurno TIME NULL,
  finTurno    TIME NULL
)
  ENGINE = InnoDB
  CHARSET = utf8;

ALTER TABLE empleado
  ADD CONSTRAINT fk_empleado_turno1
FOREIGN KEY (idTurno) REFERENCES turno (idTurno);

CREATE TABLE users
(
  idUser     INT AUTO_INCREMENT
    PRIMARY KEY,
  username   VARCHAR(45)  NULL,
  password   VARCHAR(255) NULL,
  idEmpleado INT(10)      NULL,
  estado     INT(1)       NULL,
  CONSTRAINT users_empleado_idEmpleado_fk
  FOREIGN KEY (idEmpleado) REFERENCES empleado (idEmpleado)
)
  ENGINE = InnoDB
  CHARSET = utf8;

CREATE INDEX users_empleado_idEmpleado_fk
  ON users (idEmpleado);


