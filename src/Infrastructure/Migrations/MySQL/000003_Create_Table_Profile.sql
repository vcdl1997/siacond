CREATE TABLE IF NOT EXISTS `TB_PROFILE`(
    ID bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
    DESCRIPTION MEDIUMTEXT NOT NULL,
    CONSTANT VARCHAR(160) NOT NULL,
    CREATED_AT DATETIME DEFAULT CURRENT_TIMESTAMP,
    UPDATED_AT DATETIME ON UPDATE CURRENT_TIMESTAMP
);