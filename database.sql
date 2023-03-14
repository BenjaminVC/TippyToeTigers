CREATE TABLE user_info (
    user_id INTEGER PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL
);

INSERT INTO user_info (user_id, first_name, last_name, email) VALUES 
    (1, 'John', 'Doe', 'john.doe@example.com'),
    (2, 'Jane', 'Doe', 'jane.doe@example.com'),
    (3, 'Bob', 'Smith', 'bob.smith@example.com'),
    (4, 'Charles', 'Biffin', 'charles.biffin@example.com'),
    (5, 'Ben', 'Van Cise', 'ben.vancise@example.com'),
    (6, 'Jonida', 'Durbaku', 'jonida.durbaku@example.com'),
    (7, 'Ann', 'Williams', 'ann.williams@example.com'),
    (8, 'James', 'Blunt', 'james.blunt@example.com'),
    (9, 'Sam', 'Smith', 'sam.smith@example.com'),
    (10, 'admin', 'admin', 'admin.admin@example.com');

CREATE TABLE user_account (
    account_id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    user_password TEXT NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user_info(user_id)
);

INSERT INTO user_account (account_id, user_id, user_password) VALUES 
    (1, 1, 'password123'),
    (2, 2, 'password123'),
    (3, 3, 'password123'),
    (4, 4, 'password123'),
    (5, 5, 'password123'),
    (6, 6, 'password123'),
    (7, 7, 'password123'),
    (8, 8, 'password123'),
    (9, 9, 'password123'),
    (10, 10, 'password123');

CREATE TABLE games (
  game_id INTEGER PRIMARY KEY,
  game_name TEXT
);

INSERT INTO games (game_id, game_name) VALUES (1, 'hangman'), (2, 'snake') ;

CREATE TABLE categories (
  category_id INTEGER PRIMARY KEY,
  category_name TEXT
);

INSERT INTO categories (category_id, category_name) VALUES (1, 'Fruits'), (2, 'Animals'), (3, 'Countries');

CREATE TABLE rounds (
  round_id INTEGER PRIMARY KEY,
  user_id INTEGER,
  game_id INTEGER,
  category_id INTEGER,
  score INTEGER,
  FOREIGN KEY (user_id) REFERENCES user_account(user_id),
  FOREIGN KEY (game_id) REFERENCES games(game_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

INSERT INTO rounds (user_id, game_id, category_id, score) VALUES 
    (1, 1, 2, 100),
    (3, 1, 2, 90),
    (2, 2, 1, 75),
    (4, 3, 3, 60),
    (5, 2, 2, 80), 
    (1, 3, 1, 85), 
    (2, 1, 1, 70),
    (3, 3, 2, 95),
    (4, 2, 3, 50),
    (5, 1, 1, 65);