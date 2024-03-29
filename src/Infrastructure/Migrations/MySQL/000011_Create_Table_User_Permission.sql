CREATE TABLE IF NOT EXISTS `TB_USER_PERMISSION`(
    PERMISSION_ID bigint NOT NULL,
    USER_ID bigint NOT NULL,
    CONDOMINIUM_ID bigint NOT NULL,
    CREATED_AT DATETIME DEFAULT CURRENT_TIMESTAMP,
    UPDATED_AT DATETIME ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `UNIQUE_KEY_TB_USER_PERMISSION` (`PERMISSION_ID`,`USER_ID`,`CONDOMINIUM_ID`),
    CONSTRAINT FK_TB_USER_PERMISSION_PERMISSION_ID FOREIGN KEY (PERMISSION_ID) REFERENCES TB_PERMISSION(ID),
    CONSTRAINT FK_TB_USER_PERMISSION_USER_ID FOREIGN KEY (USER_ID) REFERENCES TB_USER(ID),
    CONSTRAINT FK_TB_USER_PERMISSION_CONDOMINIUM_ID FOREIGN KEY (CONDOMINIUM_ID) REFERENCES TB_CONDOMINIUM(ID)
);