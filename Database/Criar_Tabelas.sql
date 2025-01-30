CREATE DATABASE IF NOT EXISTS controle_financeiro;
USE controle_financeiro;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    user_level INT DEFAULT 2
);

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS transacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    categoria_id INT,
    data_transacao TIMESTAMP NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
);


INSERT INTO usuarios (id, nome, senha, email, user_level) VALUES 
(1, 'admin', 'admin', 'admin@admin.com', 1),
(999, 'global', 'globalglobal', 'global@global.com', 999),
(1000, 'user', 'user', 'user@user.com', 2);

INSERT INTO categorias (id, nome, tipo, usuario_id) VALUES 
(1, 'Despesa sem categoria', 'Despesa', 999),
(2, 'Receita sem categoria', 'Receita', 999),
(3, 'Alimentação', 'Despesa', 1000),
(4, 'Saúde', 'Despesa', 1000),
(5, 'Educação', 'Despesa', 1000),
(6, 'Outros', 'Despesa', 1000),
(7, 'Salário', 'Receita', 1000),
(8, 'Investimento', 'Receita', 1000),
(9, 'Extra', 'Receita', 1000),
(10, 'Outros', 'Receita', 1000);

INSERT INTO transacoes (tipo, descricao, valor, categoria_id, usuario_id, data_transacao) VALUES
('Despesa', 'Compra de supermercado', 120.50, 1, 1000, '2024-09-05 14:30:00'),
('Despesa', 'Pagamento de energia elétrica', 85.30, 1, 1000, '2024-09-10 12:00:00'),
('Receita', 'Salário mensal', 2500.00, 2, 1000, '2024-09-25 09:00:00'),
('Despesa', 'Manutenção do carro', 350.75, 1, 1000, '2024-09-30 16:15:00'),
('Despesa', 'Aluguel de apartamento', 1000.00, 1, 1000, '2024-10-01 10:00:00'),
('Receita', 'Freelance de design gráfico', 400.00, 2, 1000, '2024-10-03 18:45:00'),
('Despesa', 'Compra de roupas', 150.00, 1, 1000, '2024-10-08 11:30:00'),
('Despesa', 'Compra de eletrônicos', 800.00, 1, 1000, '2024-10-12 14:00:00'),
('Receita', 'Venda de produtos usados', 200.00, 2, 1000, '2024-10-15 09:15:00'),
('Despesa', 'Assinatura de streaming', 45.90, 1, 1000, '2024-10-16 20:00:00'),
('Despesa', 'Jantar em restaurante', 95.60, 1, 1000, '2024-09-08 19:30:00'),
('Despesa', 'Abastecimento de combustível', 220.00, 1, 1000, '2024-09-14 10:15:00'),
('Receita', 'Comissão de vendas', 600.00, 2, 1000, '2024-09-20 11:00:00'),
('Despesa', 'Compra de material de escritório', 180.50, 1, 1000, '2024-09-26 13:00:00'),
('Receita', 'Reembolso de despesas', 150.00, 2, 1000, '2024-10-05 15:00:00'),
('Despesa', 'Curso online', 300.00, 1, 1000, '2024-10-07 09:00:00'),
('Despesa', 'Manutenção de eletrodomésticos', 95.75, 1, 1000, '2024-10-10 14:45:00'),
('Receita', 'Pagamento de projeto freelance', 800.00, 2, 1000, '2024-10-14 17:30:00'),
('Despesa', 'Compra de móveis', 1200.00, 1, 1000, '2024-10-09 12:00:00'),
('Receita', 'Aluguel de imóvel', 1200.00, 2, 1000, '2024-10-13 08:30:00');