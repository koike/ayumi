-- DROP TABLE IF EXISTS RESULT;
-- DROP TABLE IF EXISTS GIST;
-- DROP TABLE IF EXISTS URL;
-- DROP TABLE IF WHITE_LIST;

CREATE TABLE RESULT
(
    url TEXT,
    description TEXT,
    created_at DATETIME
);

CREATE TABLE GIST
(
    url TEXT,
    gist TEXT,
    created_at DATETIME
);

CREATE TABLE URL
(
    url TEXT,
    created_at DATETIME
);

CREATE TABLE AFRAID
(
    domain TEXT,
    created_at DATETIME
);
