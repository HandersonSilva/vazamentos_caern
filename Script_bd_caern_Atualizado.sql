create database bd_caern;

CREATE TABLE caern_usuario(
  id_usuario INT NOT NULL AUTO_INCREMENT,
  nome_usuario VARCHAR(60) NOT NULL,
  email_usuario VARCHAR(45) NOT NULL,
  senha_usuario VARCHAR(150) NOT NULL,
  PRIMARY KEY (id_usuario));

CREATE TABLE caern_ponto(
	id_ponto INT  NOT NULL AUTO_INCREMENT,
    log_ponto numeric(10,6) NOT NULL,
    lat_ponto numeric(10,7) NOT NULL,
    rua_ponto VARCHAR(100) NOT NULL,
    estado_ponto VARCHAR(60) NOT NULL,
    cidade_ponto VARCHAR(60) NULL,
  PRIMARY KEY (id_ponto));
  
  CREATE TABLE caern_vazamento(
	id_vazamento INT NOT NULL AUTO_INCREMENT,
	descricao_vazamento TEXT NOT NULL,
	status_vazamento INT NOT NULL DEFAULT 0 COMMENT '0 = reclamação fechada\n1 = reclamação aberta\n',
    data_vazamento  DATE NOT NULL,
    gravidade_vazamento  VARCHAR(50) NOT NULL,
    tempo_vazamento  INT(11) NULL,
    fk_id_ponto  INT  NOT NULL,
    fk_id_usuario  INT NOT NULL,
    constraint foreign key(fk_id_ponto) references caern_ponto(id_ponto),
    constraint foreign key(fk_id_usuario) references caern_usuario(id_usuario),
    PRIMARY KEY (id_vazamento));
    
    
    
    
    
    