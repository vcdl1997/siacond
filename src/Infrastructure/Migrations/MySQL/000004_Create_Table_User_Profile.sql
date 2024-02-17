CREATE TABLE IF NOT EXISTS `TB_USER_PROFILE`(
    USER_ID bigint NOT NULL,
    PROFILE_ID bigint NOT NULL,
    UNIQUE KEY `USER_PROFILE_ID` (`USER_ID`,`PROFILE_ID`),
    CONSTRAINT FK_USER_ID FOREIGN KEY (USER_ID) REFERENCES TB_USER(ID),
    CONSTRAINT FK_PROFILE_ID FOREIGN KEY (PROFILE_ID) REFERENCES TB_PROFILE(ID)
);