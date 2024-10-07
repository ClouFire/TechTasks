CREATE DATABASE users;

CREATE TABLE IF NOT EXISTS 'users'.'comments' (
    'id' BIGINT NOT NULL AUTO_INCREMENT,
    'username' VARCHAR(30) NOT NULL DEFAULT 'Аноним',
    'date' TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(),
    'comment' TEXT NOT NULL,
    PRIMARY KEY ('id')
)
ENGINE = InnoDB;