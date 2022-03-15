CREATE SCHEMA livros;

CREATE TABLE `usuario` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `dataNascimento` date,
  `email` varchar(100),
  `senha` varchar(45),
  `telefone` varchar(45),
  PRIMARY KEY (`idU`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `livros`.`usuario` (`nome`, `dataNascimento`, `email`, `senha`, `telefone`) VALUES ('Anne', '1994-09-23', 'anne23@gmail.com', '1234', '(47) 988-090-900');
INSERT INTO `livros`.`usuario` (`nome`, `dataNascimento`, `email`, `senha`, `telefone` ) VALUES ('Bonnie', '2001-10-18', 'bonnie18@gmail.com', '2345', '(54) 988-905-040');
INSERT INTO `livros`.`usuario` (`nome`, `dataNascimento`, `email`, `senha`, `telefone` ) VALUES ('Carls', '1999-07-20', 'carls20@gmail.com', '3456', '(11) 988-456-709');
INSERT INTO `livros`.`usuario` (`nome`, `dataNascimento`, `email`, `senha`, `telefone` ) VALUES ('Denny', '2000-04-15', 'denny15@gmail.com', '4567', '(47) 988-546-789');

CREATE TABLE `editora` (
  `idE` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cidade` varchar(45),
  `dataFundacao` date,
  PRIMARY KEY (`idE`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `livros`.`editora` (`nome`, `dataFundacao`) VALUES ('Abc', '1994-09-23');
INSERT INTO `livros`.`editora` (`nome`, `dataFundacao`) VALUES ('Cde', '1998-10-18');
INSERT INTO `livros`.`editora` (`nome`, `dataFundacao`) VALUES ('Def', '1999-07-20');
INSERT INTO `livros`.`editora` (`nome`, `dataFundacao`) VALUES ('Efg', '1989-04-15');


CREATE TABLE `compra` (
  `idC` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `dataCompra` date,
  `idU` int(11) NOT NULL,
  PRIMARY KEY (`idC`),
  FOREIGN KEY (`idU`) REFERENCES `usuario` (`idU`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE `livro` (
  `idL` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `genero` varchar(45),
  `anoPublicacao` date,
  `autor` varchar(200),
  `valor` double,
  `idE` int(11) NOT NULL,
  PRIMARY KEY (`idL`),
  FOREIGN KEY (`idE`) REFERENCES `editora` (`idE`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `livros`.`livro` (`titulo`, `genero`, `anoPublicacao`, `autor`, `valor`, `idE`) VALUES ('Abcc', 'romance', '20001009', 'Ellys', '55.90', '1');
INSERT INTO `livros`.`livro` (`titulo`, `genero`, `anoPublicacao`, `autor`, `valor`, `idE`) VALUES ('Bcdd', 'romance', '20201008', 'Nanna', '60.50', '2');
INSERT INTO `livros`.`livro` (`titulo`, `genero`, `anoPublicacao`, `autor`, `valor`, `idE`) VALUES ('Cdee', 'suspense', '20080810', 'Brown', '20.99', '3');
INSERT INTO `livros`.`livro` (`titulo`, `genero`, `anoPublicacao`, `autor`, `valor`, `idE`) VALUES ('Efgg', 'Ficção Científica', '20100908', 'Mars', '30.45', '4');

CREATE TABLE `contato` (
  `idT` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(45),
  `email` varchar(100),
  `idE` int(11),
  PRIMARY KEY (`idT`),
  FOREIGN KEY (`idE`) REFERENCES `editora` (`idE`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

INSERT INTO `livros`.`contato` (`telefone`, `email`, `idE`) VALUES ('(47) 988-090-900', 'abc@gmail.com', '1');
INSERT INTO `livros`.`contato` (`telefone`, `email`, `idE`) VALUES ('(54) 988-905-040', 'cde@gmail.com', '2');
INSERT INTO `livros`.`contato` (`telefone`, `email`, `idE`) VALUES ('(11) 988-456-709', 'def@gmail.com', '3');
INSERT INTO `livros`.`contato` (`telefone`, `email`, `idE`) VALUES ('(47) 988-546-789', 'efg@gmail.com', '4');

CREATE TABLE `compra_has_livro` (
  `idC` INT NOT NULL,
  `idL` INT NOT NULL,
  PRIMARY KEY (`idC`, `idL`),
  INDEX `fk_compra_has_livro_livro1_idx` (`idL` ASC),
  INDEX `fk_compra_has_livro_compra1_idx` (`idC` ASC),
  CONSTRAINT `fk_compra_has_livro_compra1`
    FOREIGN KEY (`idC`)
    REFERENCES `compra` (`idC`),
    CONSTRAINT `fk_compra_has_livro_livro1`
    FOREIGN KEY (`idL`)
    REFERENCES `livro` (`idL`)
)ENGINE = InnoDB;