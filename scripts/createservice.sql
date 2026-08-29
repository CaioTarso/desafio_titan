CREATE TABLE service (
    id_service BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(45) NOT NULL,
    price DECIMAL(11,3) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    finished_at DATETIME DEFAULT NULL,
    commission_user DECIMAL(11,3) DEFAULT NULL,
    user_id_user BIGINT(20) NOT NULL,
    FOREIGN KEY (user_id_user) REFERENCES users(id_user)
);

/* Valores usadospara testar a inserção de valores pelo terminal

INSERT INTO service (description, price, user_id_user)
VALUES
('Instalação de sistema', 500.000, 1),
('Manutenção de computador', 1500.000, 1),
('Configuração de servidor', 12000.000, 2),
('Formatação de computador', 800.000, 3);
 


*/