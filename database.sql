CREATE TABLE user_info (
    username Text NOT NULL PRIMARY KEY,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT NOT NULL
);

INSERT INTO user_info (username, first_name, last_name, email) VALUES 
    ('johndoe', 'John', 'Doe', 'john.doe@example.com'),
    ('janedoe', 'Jane', 'Doe', 'jane.doe@example.com'),
    ('bobsmith', 'Bob', 'Smith', 'bob.smith@example.com'),
    ('charlesbiffin', 'Charles', 'Biffin', 'charles.biffin@example.com'),
    ('benvancise', 'Ben', 'Van Cise', 'ben.vancise@example.com'),
    ('jonidadurbaku', 'Jonida', 'Durbaku', 'jonida.durbaku@example.com'),
    ('annwilliams',  'Ann', 'Williams', 'ann.williams@example.com'),
    ('jamesblunt', 'James', 'Blunt', 'james.blunt@example.com'),
    ('samsmith', 'Sam', 'Smith', 'sam.smith@example.com'),
    ('admin','admin', 'admin', 'admin.admin@example.com');

CREATE TABLE user_account (
    account_id INTEGER PRIMARY KEY,
    username Text NOT NULL,
    user_password TEXT NOT NULL,
    FOREIGN KEY(username) REFERENCES user_info(username)
);

INSERT INTO user_account (account_id, username, user_password) VALUES 
    (1, 'johndoe', 'password123'),
    (2, 'janedoe', 'password123'),
    (3, 'bobsmith', 'password123'),
    (4, 'charlesbiffin', 'password123'),
    (5, 'benvancise', 'password123'),
    (6, 'jonidadurbaku', 'password123'),
    (7, 'annwilliams', 'password123'),
    (8, 'jamesblunt', 'password123'),
    (9, 'samsmith', 'password123'),
    (10, 'admin', 'password123');

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
  username TEXT NOT NULL,
  game_id INTEGER NOT NULL,
  category_id INTEGER,
  score INTEGER NOT NULL,
  FOREIGN KEY (username) REFERENCES user_account(username),
  FOREIGN KEY (game_id) REFERENCES games(game_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

INSERT INTO rounds (username, game_id, category_id, score) VALUES 
    ('johndoe', 1, 2, 100),
    ('bobsmith', 1, 2, 90),
    ('janedoe', 2, NULL, 75),
    ('charlesbiffin', 2, NULL, 60),
    ('benvancise', 2, NULL, 80), 
    ('johndoe', 1, 1, 85), 
    ('janedoe', 1, 2, 70),
    ('bobsmith', 2, NULL, 95),
    ('charlesbiffin', 2, NULL, 50),
    ('benvancise', 1, 1, 65);