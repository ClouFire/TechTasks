CREATE DATABASE users;

CREATE TABLE IF NOT EXISTS 'users'.'comments' (
    'id' BIGINT NOT NULL AUTO_INCREMENT,
    'username' VARCHAR(225) NOT NULL DEFAULT 'Аноним',
    'comment' TEXT NOT NULL,
    'date' DATETIME NOT NULL,
    PRIMARY KEY ('id')
)
ENGINE = InnoDB;