-- Criação do database
CREATE DATABASE linfy_database;

-- Seleção do batabase
USE linfy_databse;

-- Criação da tabela
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- ID do usuário (chave primária)
    username VARCHAR(255) NOT NULL UNIQUE,  -- Usuário (garante que será único)
    email VARCHAR (255) NOT NULL UNIQUE,  -- E-mail do usuário (garante que será único)
    password VARCHAR(255) NOT NULL,           -- Senha criptografada
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Data de criação do registro
);

-- Adicionar um usuario exemplo (opcional)
-- INSERT INTO users (username, password) VALUES ('userame@gmail.com', 'SENHA_CRIPTOGRAFADA');