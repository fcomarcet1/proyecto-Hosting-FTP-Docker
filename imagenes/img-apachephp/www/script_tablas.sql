/*TABLA USUARIOS LOGIN+REGISTRO*/
CREATE TABLE tblusuarios
(
  idUsuario    INT(11) PRIMARY KEY AUTO_INCREMENT,
  strNombre    VARCHAR(50) NOT NULL,
  strPasswd    VARCHAR(264) NOT NULL,
  strNivel     VARCHAR(50),
  dtmFechaReg  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*TABLA HOSTS*/
CREATE TABLE tblhosts
(
    idHost      INT(11) PRIMARY KEY AUTO_INCREMENT,
    strUsuario  VARCHAR(50) NOT NULL,
    strPasswd   VARCHAR(264) NOT NULL,
    strEmail    VARCHAR(264) NOT NULL,
    srtDominio  VARCHAR(50) NOT NULL,
    dtmFechaReg DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*TABLA USUARIOS FTP*/
CREATE TABLE tblftpusuarios
(
    idUsuarioFtp    INT(11) PRIMARY KEY AUTO_INCREMENT,
    idhost          INT(11) NOT NULL,
    strUsuarioftp   VARCHAR(50) NOT NULL,
    strPasswd       VARCHAR(264) NOT NULL,
    dtmFechaReg     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE tblftpusuarios
ADD CONSTRAINT tblftpusuarios_ibfk_1 FOREIGN KEY (idhost) REFERENCES tblhosts (idHost);
COMMIT;

/*TABLA PROVISIONING*/
CREATE TABLE tblprovisioning
(
    idProvisioning   INT(11) PRIMARY KEY AUTO_INCREMENT,
    strUsuario       VARCHAR(50) NOT NULL,
    strAccion        VARCHAR(50) NOT NULL,
    strDatosHost     VARCHAR(50) NOT NULL,
    strDatosUserFtp  VARCHAR(50) ,
    strDatosPassFtp  VARCHAR(50) ,
    bnrEstado        BINARY NOT NULL,
    dtmFechaReg      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



