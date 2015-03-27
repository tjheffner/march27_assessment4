--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: tanner; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    brand_name character varying
);


ALTER TABLE brands OWNER TO tanner;

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: tanner
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO tanner;

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: tanner
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: sold_by; Type: TABLE; Schema: public; Owner: tanner; Tablespace: 
--

CREATE TABLE sold_by (
    id integer NOT NULL,
    store_id integer,
    brand_id integer
);


ALTER TABLE sold_by OWNER TO tanner;

--
-- Name: sold_by_id_seq; Type: SEQUENCE; Schema: public; Owner: tanner
--

CREATE SEQUENCE sold_by_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sold_by_id_seq OWNER TO tanner;

--
-- Name: sold_by_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: tanner
--

ALTER SEQUENCE sold_by_id_seq OWNED BY sold_by.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: tanner; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    name character varying,
    address character varying
);


ALTER TABLE stores OWNER TO tanner;

--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: tanner
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO tanner;

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: tanner
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: tanner
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: tanner
--

ALTER TABLE ONLY sold_by ALTER COLUMN id SET DEFAULT nextval('sold_by_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: tanner
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: tanner
--

COPY brands (id, brand_name) FROM stdin;
3	Asics
4	Converse
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: tanner
--

SELECT pg_catalog.setval('brands_id_seq', 4, true);


--
-- Data for Name: sold_by; Type: TABLE DATA; Schema: public; Owner: tanner
--

COPY sold_by (id, store_id, brand_id) FROM stdin;
2	7	4
3	6	4
4	8	4
5	8	3
6	7	4
\.


--
-- Name: sold_by_id_seq; Type: SEQUENCE SET; Schema: public; Owner: tanner
--

SELECT pg_catalog.setval('sold_by_id_seq', 6, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: tanner
--

COPY stores (id, name, address) FROM stdin;
\.


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: tanner
--

SELECT pg_catalog.setval('stores_id_seq', 8, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: tanner; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: sold_by_pkey; Type: CONSTRAINT; Schema: public; Owner: tanner; Tablespace: 
--

ALTER TABLE ONLY sold_by
    ADD CONSTRAINT sold_by_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: tanner; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: tanner
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM tanner;
GRANT ALL ON SCHEMA public TO tanner;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

