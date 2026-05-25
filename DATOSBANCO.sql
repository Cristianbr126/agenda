CREATE DATABASE IF NOT EXISTS agenda
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
 
USE agenda;
create table contactos (
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100), 
email VARCHAR(100), 
telefone VARCHAR(14),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

create table clientes(
id INT PRIMARY KEY AUTO_INCREMENT,
nome VARCHAR(100),
CPF VARCHAR(14) NOT NULL UNIQUE,
email VARCHAR(100),
telefone VARCHAR(14),
endereco VARCHAR(100), 
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT,
    preco DECIMAL(10, 2),
    estoque INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


=
INSERT INTO contactos (nome, email, telefone) VALUES
('Ana Silva', 'ana@email.com', '(11) 91234-5678'),
('Carlos Souza', 'carlos@email.com', '(21) 98765-4321'),
('Mariana Oliveira', 'mariana@email.com', '(31) 99876-5432');


INSERT INTO clientes (nome, CPF, email, telefone, endereco) VALUES
('João Pereira', '123.456.789-00', 'joao@email.com', '(11) 91111-1111', 'Rua A, 123 - São Paulo/SP'),
('Fernanda Lima', '987.654.321-00', 'fernanda@email.com', '(21) 92222-2222', 'Av. B, 456 - Rio de Janeiro/RJ'),
('Roberto Alves', '456.123.789-00', 'roberto@email.com', '(31) 93333-3333', 'Rua C, 789 - Belo Horizonte/MG');


INSERT INTO produtos (nome, descricao, preco, estoque) VALUES
('Notebook Pro', '15 polegadas, 16GB RAM, SSD 512GB', 4599.90, 10),
('Mouse Sem Fio', 'Conexão USB, 3 botões, preto', 49.90, 50),
('Teclado Mecânico', 'Switch vermelho, RGB, ABNT2', 299.90, 25);

INSERT INTO contactos (nome, email, telefone) VALUES
('Rafael Costa', 'rafael.costa@email.com', '(11) 98888-1234'),
('Juliana Santos', 'juliana.santos@email.com', '(21) 97777-5678'),
('Fernando Rocha', 'fernando.rocha@email.com', '(31) 99999-8765'),
('Patrícia Lima', 'patricia.lima@email.com', '(41) 95555-4321'),
('Gustavo Almeida', 'gustavo.almeida@email.com', '(51) 96666-7890');


ALTER TABLE produtos CHANGE COLUMN imagen imagem VARCHAR(255) NULL;