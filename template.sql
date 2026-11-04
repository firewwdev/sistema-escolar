create table prova(
  id int primary key auto_increment,
  prova varchar(55) not null,
  id_disciplina int not null,

  foreign key (id_disciplina) references disciplina(id)

);

CREATE TABLE nota(
  id int PRIMARY KEY AUTO_INCREMENT,
  nota DECIMAL(4,2) not null,
  aluno_id int not null,
  prova_id int not null,

  unique(aluno_id, prova_id),
  
  FOREIGN KEY (aluno_id) REFERENCES aluno(id),
  FOREIGN KEY (prova_id) REFERENCES prova(id)
);

CREATE TABLE Usuario(
  id int primary key auto_increment,
  nome varchar(55) NOT NULL,
  matricula varchar(11) NOT NULL UNIQUE,
  email varchar(55) NOT NULL,
  senha varchar(255),
  tipo ENUM('aluno', 'professor', 'admin') NOT NULL
);


CREATE TABLE disciplina(
  id int PRIMARY KEY AUTO_INCREMENT,
  id_professor int not null,
  nome varchar(55) not null,

  FOREIGN KEY (id_professor) REFERENCES Usuario(id)

);
