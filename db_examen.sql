CREATE DATABASE EXAMEN2parc;

USE EXAMEN2parc;


CREATE TABLE usuarios(
	
	clave INTEGER PRIMARY KEY,
	nombre VARCHAR(20),
	apellidop VARCHAR(20),
	apellidom VARCHAR(20),
	tipo VARCHAR(12)

);


SELECT nombre,clave
                    FROM usuarios
                    WHERE nombre='' AND clave=''

CREATE TABLE ARBOLES(

idarbol INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fuente VARCHAR(50),
especie VARCHAR(50),
edad INT,
numarbol INT,
diametro INT,
altura INT,	
codigositio INT,
fechaplan DATE,
FOREIGN KEY (codigositio)
		REFERENCES Sitios(idsitio)

);     


CREATE TABLE SITIOS(
	
	idsitio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	sitio VARCHAR(50),
	codigoorden INT(50),
	
	FOREIGN KEY(CODIGOORDEN)
		REFERENCES orden(idorden)
 );

CREATE TABLE orden(

idorden INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
anoplanta INT(50),
superficie REAL,
bloque INT(50),
codigocontrato INTEGER,
FOREIGN KEY(codigocontrato)
		REFERENCES contratos(idcontrado)

); 


CREATE TABLE contratos(
	idcontrato INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contrato TEXT(12),
	codigopredio INTEGER,
	
	FOREIGN KEY(codigopredio)
		REFERENCES predios(idpredio)
	

);
SELECT u.idcontrato, u.contrato,
    u.codigopredio	  
FROM contratos u,predios r
WHERE u.idcontrato=r.idpredio;

delete  from predios
            where idpredio='5'; 

select * from contratos;

create table predios(
	
		idpredio integer NOT NULL AUTO_INCREMENT PRIMARY KEY
		,predio text(50),
		zona text(30),
		codigoinventario integer,
		
		foreign key (codigoinventario)
			references inventario(idinvetario)
		
);
select * from arboles;

create table inventario(

	idinventario integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
	realizo text(30)

);






 
 
 
 
 
SELECT a.ID_ARBOL,a.FUENTE, 
        a.ESPECIE ,a.EDAD,
        a.NUM_ARBOL ,a.DIAMETRO,
        a.ALTURA,s.sitio AS ID_SITIO,
        a.FECHA_PLAN 
 FROM arboles a
 INNER JOIN sitios s
 ON(a.id_sitio=s.id_sitio)
 ORDER BY id_arbol;

SELECT * FROM arboles 

UPDATE arboles SET               
            FUENTE='$this->fuente',
            ESPECIE='$this->especie',
            EDAD INT='$this->edad',
            NUM_ARBOL ='1',
            DIAMETRO='1',
            ALTURA ='1',	
            ID_SITIO='$this->id_sitio',
            FECHA_PLAN='$this->fecha_plan'
            WHERE id_arbol='1';
