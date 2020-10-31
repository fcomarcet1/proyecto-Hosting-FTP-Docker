SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
USE docker;

CREATE TABLE `tblusuarios` (
  `idUsuario` int(11) Primary key AUTO_INCREMENT,
  `strNombre` varchar(50) ,
  `strPasswd` varchar(264) ,
  `strNivel` varchar(50) ,
  `dtmFechaReg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

