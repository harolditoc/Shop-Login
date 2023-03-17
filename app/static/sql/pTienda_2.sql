CREATE TABLE articulo 
    (
     idarticulo INTEGER NOT NULL , 
     categoria_idcategoria INTEGER NOT NULL , 
     codigo VARCHAR (50) , 
     nombre VARCHAR (100) NOT NULL , 
     precio_venta DECIMAL (11,2) NOT NULL , 
     stock INTEGER NOT NULL , 
     descripcion VARCHAR (256) , 
     imagen VARCHAR (256) NOT NULL , 
     estado CHAR (1) 
    )
;

ALTER TABLE articulo ADD CONSTRAINT articulo_PK PRIMARY KEY (idarticulo)
;

ALTER TABLE articulo ADD CONSTRAINT articulo_nombre_UN UNIQUE (nombre)
;

CREATE TABLE categoria 
    (
     idcategoria INTEGER NOT NULL , 
     nombre VARCHAR (50) NOT NULL , 
     descripcion VARCHAR (256) , 
     estado CHAR (1) 
    )
;

ALTER TABLE categoria ADD CONSTRAINT categoria_PK PRIMARY KEY (idcategoria)
;

ALTER TABLE categoria ADD CONSTRAINT categoria_nombre_UN UNIQUE (nombre)
;

CREATE TABLE detalle_ingreso 
    (
     iddetalle_ingreso INTEGER NOT NULL , 
     ingreso_idingreso INTEGER NOT NULL , 
     articulo_idarticulo INTEGER NOT NULL , 
     cantidad INTEGER NOT NULL , 
     precio DECIMAL (11,2) NOT NULL 
    )
;

ALTER TABLE detalle_ingreso ADD CONSTRAINT detalle_ingreso_PK PRIMARY KEY (iddetalle_ingreso)
;

CREATE TABLE detalle_venta 
    (
     iddetalle_venta INTEGER NOT NULL , 
     venta_idventa INTEGER NOT NULL , 
     articulo_idarticulo INTEGER NOT NULL , 
     cantidad INTEGER NOT NULL , 
     precio DECIMAL (11,2) NOT NULL , 
     descuento DECIMAL (11,2) NOT NULL 
    )
;

ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_PK PRIMARY KEY (iddetalle_venta)
;

CREATE TABLE ingreso 
    (
     idingreso INTEGER NOT NULL , 
     persona_idpersona INTEGER NOT NULL , 
     usuario_idusuario INTEGER NOT NULL , 
     tipo_comprobante VARCHAR (20) NOT NULL , 
     serie_comprobante VARCHAR (7) , 
     num_comprobante VARCHAR (10) NOT NULL , 
     fecha TIMESTAMP NOT NULL , 
     impuesto DECIMAL (4,2) NOT NULL , 
     total DECIMAL (11,2) NOT NULL , 
     estado VARCHAR (20) NOT NULL 
    )
;

ALTER TABLE ingreso ADD CONSTRAINT ingreso_PK PRIMARY KEY (idingreso)
;

CREATE TABLE persona 
    (
     idpersona INTEGER NOT NULL , 
     tipo_persona VARCHAR (20) NOT NULL , 
     nombre VARCHAR (100) NOT NULL , 
     tipo_documento VARCHAR (20) , 
     num_documento VARCHAR (20) , 
     direccion VARCHAR (70) , 
     telefono VARCHAR (20) , 
     email VARCHAR (50) , 
     password BLOB NOT NULL  
    )
;

ALTER TABLE persona ADD CONSTRAINT persona_PK PRIMARY KEY (idpersona)
;

CREATE TABLE rol 
    (
     idrol INTEGER NOT NULL , 
     nombre VARCHAR (30) NOT NULL , 
     descripcion VARCHAR (100) , 
     estado CHAR (1) 
    )
;

ALTER TABLE rol ADD CONSTRAINT rol_PK PRIMARY KEY (idrol)
;

CREATE TABLE usuario 
    (
     idusuario INTEGER NOT NULL , 
     rol_idrol INTEGER NOT NULL , 
     nombre VARCHAR (100) NOT NULL , 
     tipo_documento VARCHAR (20) , 
     num_documento VARCHAR (20) , 
     direccion VARCHAR (70) , 
     telefono VARCHAR (20) , 
     email VARCHAR (50) NOT NULL , 
     password BLOB NOT NULL , 
     estado CHAR (1) 
    )
;

ALTER TABLE usuario ADD CONSTRAINT usuario_PK PRIMARY KEY (idusuario)
;

CREATE TABLE venta 
    (
     idventa INTEGER NOT NULL , 
     persona_idpersona INTEGER NOT NULL , 
     usuario_idusuario INTEGER NOT NULL , 
     tipo_comprobante VARCHAR (20) NOT NULL , 
     serie_comprobante VARCHAR (7) , 
     num_comprobante VARCHAR (10) NOT NULL , 
     fecha_hora TIMESTAMP NOT NULL , 
     impuesto DECIMAL (4,2) NOT NULL , 
     total DECIMAL (11,2) NOT NULL , 
     estado VARCHAR (20) NOT NULL 
    )
;

ALTER TABLE venta ADD CONSTRAINT venta_PK PRIMARY KEY (idventa)
;

ALTER TABLE articulo
    ADD CONSTRAINT articulo_categoria_FK FOREIGN KEY
    ( 
     categoria_idcategoria
    ) 
    REFERENCES categoria 
    ( 
     idcategoria
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE detalle_ingreso
    ADD CONSTRAINT detalle_ingreso_articulo_FK FOREIGN KEY
    ( 
     articulo_idarticulo
    ) 
    REFERENCES articulo 
    ( 
     idarticulo
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE detalle_ingreso
    ADD CONSTRAINT detalle_ingreso_ingreso_FK FOREIGN KEY
    ( 
     ingreso_idingreso
    ) 
    REFERENCES ingreso 
    ( 
     idingreso
    )
    ON DELETE CASCADE
    ON UPDATE NO ACTION
;

ALTER TABLE detalle_venta
    ADD CONSTRAINT detalle_venta_articulo_FK FOREIGN KEY
    ( 
     articulo_idarticulo
    ) 
    REFERENCES articulo 
    ( 
     idarticulo
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE detalle_venta
    ADD CONSTRAINT detalle_venta_venta_FK FOREIGN KEY
    ( 
     venta_idventa
    ) 
    REFERENCES venta 
    ( 
     idventa
    )
    ON DELETE CASCADE
    ON UPDATE NO ACTION
;

ALTER TABLE ingreso
    ADD CONSTRAINT ingreso_persona_FK FOREIGN KEY
    ( 
     persona_idpersona
    ) 
    REFERENCES persona 
    ( 
     idpersona
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE ingreso
    ADD CONSTRAINT ingreso_usuario_FK FOREIGN KEY
    ( 
     usuario_idusuario
    ) 
    REFERENCES usuario 
    ( 
     idusuario
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE usuario
    ADD CONSTRAINT usuario_rol_FK FOREIGN KEY
    ( 
     rol_idrol
    ) 
    REFERENCES rol 
    ( 
     idrol
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE venta
    ADD CONSTRAINT venta_persona_FK FOREIGN KEY
    ( 
     persona_idpersona
    ) 
    REFERENCES persona 
    ( 
     idpersona
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;

ALTER TABLE venta
    ADD CONSTRAINT venta_usuario_FK FOREIGN KEY
    ( 
     usuario_idusuario
    ) 
    REFERENCES usuario 
    ( 
     idusuario
    )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
;