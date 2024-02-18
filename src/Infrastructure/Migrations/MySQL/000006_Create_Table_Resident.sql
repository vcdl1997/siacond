CREATE TABLE IF NOT EXISTS `TB_RESIDENT`(
    ID BIGINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NATIONAL_IDENTIFIER_CODE VARCHAR(100) NOT NULL,
    FIRSTNAME VARCHAR(100) NOT NULL,
    LASTNAME VARCHAR(200) NOT NULL,
    BIRTHDATE DATE NOT NULL,
    REGISTERED_BIOMETRICS boolean NOT NULL DEFAULT false,
    ACTIVE boolean NOT NULL DEFAULT true,
    USER_ID bigint NOT NULL,
    CREATED_AT DATETIME DEFAULT CURRENT_TIMESTAMP,
    UPDATED_AT DATETIME ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT FK_TB_RESIDENT_USER_ID FOREIGN KEY (USER_ID) REFERENCES TB_USER(ID)
);