Create database crud_notas ;
use crud_notas ; 

CREATE TABLE notas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    conteudo TEXT NOT NULL
);