
--CREATE USER abdou ENCRYPTED PASSWORD '/XkY3IF/MCeEh3apFFS1NRLXisFuD/lTSzwaro2i3CA=';
--CREATE DATABASE mydb WITH OWNER abdou ENCODING 'UTF8' TEMPLATE template0;
REVOKE ALL PRIVILEGES ON DATABASE mydb FROM PUBLIC;
GRANT ALL PRIVILEGES on DATABASE mydb to abdou;




CREATE SEQUENCE public.users_user_id_seq
	INCREMENT BY 1
	MINVALUE -2147483648
	MAXVALUE 2147483647
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;
-- ddl-end --
ALTER SEQUENCE public.users_user_id_seq OWNER TO abdou;
-- ddl-end --

-- object: public.users | type: TABLE --
-- DROP TABLE IF EXISTS public.users CASCADE;
CREATE TABLE users(
	u_id integer NOT NULL DEFAULT nextval('public.users_user_id_seq'::regclass),
	u_login character varying(30) NOT NULL,
	u_email character varying(60) NOT NULL,
	u_pass character varying(255) NOT NULL,
	u_first_name varchar(45),
	u_last_name varchar(45),
	u_status boolean NOT NULL,
	u_token varchar(64),
	CONSTRAINT users_pkey PRIMARY KEY (u_id),
	CONSTRAINT users_login_unique UNIQUE (u_login)

);
-- ddl-end --
ALTER TABLE public.users OWNER TO abdou;
-- ddl-end --

-- create admin --
INSERT INTO users values (1,'admin','admin@my_domain','$2y$12$ox93xKZ20tIHCIu2/CeMKOlIOBNLoQ2FyKvYDk/swSwT7mTTFaoRe','Administrator','Administrator',TRUE,NULL);

CREATE SEQUENCE public.tbl_token_auth_id_seq
	INCREMENT BY 1
	MINVALUE -2147483648
	MAXVALUE 2147483647
	START WITH 1
	CACHE 1
	NO CYCLE
	OWNED BY NONE;
-- ddl-end --
ALTER SEQUENCE public.tbl_token_auth_id_seq OWNER TO abdou;

CREATE TABLE tbl_token_auth (
  id integer NOT NULL DEFAULT nextval('public.tbl_token_auth_id_seq'::regclass),
  username varchar(255) NOT NULL,
  password_hash varchar(255) NOT NULL,
  selector_hash varchar(255) NOT NULL,
  is_expired integer NOT NULL DEFAULT '0',
  expiry_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
);

ALTER TABLE public.tbl_token_auth OWNER TO abdou;