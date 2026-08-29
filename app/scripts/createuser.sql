CREATE TABLE users (
    id_user BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(45) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo TINYINT(1) DEFAULT 1
);

/* Valores para teste de funciomento da tabela via terminal
INSERT INTO users (name, email, password)
VALUES
('Gustavo Plata', 'gustavo@titan.com', '123456'),
('Bruno Henrique', 'bruno@titan.com', '123456'),
('Luis Araujo', 'luis@titan.com', '123456');

*/