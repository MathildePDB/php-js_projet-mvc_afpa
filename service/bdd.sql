--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1
-- Dumped by pg_dump version 15.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: numeroter(character varying, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.numeroter(prefixe character varying, nomsequence character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
BEGIN
return concat(prefixe,trim(to_char(nextval(nomSequence), '000000')));
END
$$;


ALTER FUNCTION public.numeroter(prefixe character varying, nomsequence character varying) OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: appro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.appro (
    id integer NOT NULL,
    numappro character varying(10) DEFAULT public.numeroter('APP'::character varying, 'seq_num_appro'::character varying),
    fournisseur_id integer NOT NULL,
    dateappro timestamp without time zone NOT NULL
);


ALTER TABLE public.appro OWNER TO postgres;

--
-- Name: appro_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.appro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.appro_id_seq OWNER TO postgres;

--
-- Name: appro_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.appro_id_seq OWNED BY public.appro.id;


--
-- Name: article; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.article (
    id integer NOT NULL,
    numarticle character varying(10) DEFAULT public.numeroter('ART'::character varying, 'seq_num_article'::character varying) NOT NULL,
    designation character varying(250) NOT NULL,
    prixunitaire numeric(10,2) NOT NULL,
    prixrevient numeric(10,2) NOT NULL,
    photo character varying(150)
);


ALTER TABLE public.article OWNER TO postgres;

--
-- Name: article_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.article_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.article_id_seq OWNER TO postgres;

--
-- Name: article_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.article_id_seq OWNED BY public.article.id;


--
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client (
    id integer NOT NULL,
    numclient character varying(10) DEFAULT public.numeroter('CLT'::character varying, 'seq_num_client'::character varying) NOT NULL,
    nomclient character varying(250) NOT NULL,
    adresseclient character varying(250) NOT NULL,
    telephoneclient character varying(20) NOT NULL,
    photo character varying(100),
    typeclient character varying(5)
);


ALTER TABLE public.client OWNER TO postgres;

--
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO postgres;

--
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- Name: commande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.commande (
    id integer NOT NULL,
    numcommande character varying(10) DEFAULT public.numeroter('CMD'::character varying, 'seq_num_vente'::character varying),
    client_id integer NOT NULL,
    datecommande timestamp without time zone NOT NULL,
    typecommande character varying(5)
);


ALTER TABLE public.commande OWNER TO postgres;

--
-- Name: commande_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.commande_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.commande_id_seq OWNER TO postgres;

--
-- Name: commande_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.commande_id_seq OWNED BY public.commande.id;


--
-- Name: fournisseur; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.fournisseur (
    id integer NOT NULL,
    numfournisseur character varying(10) DEFAULT public.numeroter('FRS'::character varying, 'seq_num_frs'::character varying) NOT NULL,
    nomfournisseur character varying(250) NOT NULL,
    adressefournisseur character varying(250) NOT NULL,
    telephonefournisseur character varying(20) NOT NULL
);


ALTER TABLE public.fournisseur OWNER TO postgres;

--
-- Name: fournisseur_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.fournisseur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fournisseur_id_seq OWNER TO postgres;

--
-- Name: fournisseur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.fournisseur_id_seq OWNED BY public.fournisseur.id;


--
-- Name: groupeuser; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.groupeuser (
    id integer NOT NULL,
    libelle character varying(250),
    roles json NOT NULL
);


ALTER TABLE public.groupeuser OWNER TO postgres;

--
-- Name: groupeuser_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.groupeuser_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.groupeuser_id_seq OWNER TO postgres;

--
-- Name: groupeuser_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.groupeuser_id_seq OWNED BY public.groupeuser.id;


--
-- Name: ligneappro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ligneappro (
    id integer NOT NULL,
    appro_id integer NOT NULL,
    article_id integer NOT NULL,
    quantite numeric(10,2)
);


ALTER TABLE public.ligneappro OWNER TO postgres;

--
-- Name: ligneappro_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ligneappro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ligneappro_id_seq OWNER TO postgres;

--
-- Name: ligneappro_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ligneappro_id_seq OWNED BY public.ligneappro.id;


--
-- Name: lignecommande; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lignecommande (
    id integer NOT NULL,
    commande_id integer NOT NULL,
    article_id integer NOT NULL,
    quantite numeric(10,2)
);


ALTER TABLE public.lignecommande OWNER TO postgres;

--
-- Name: lignecommande_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lignecommande_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lignecommande_id_seq OWNER TO postgres;

--
-- Name: lignecommande_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lignecommande_id_seq OWNED BY public.lignecommande.id;


--
-- Name: message; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.message (
    id integer NOT NULL,
    auteur character varying(100),
    message text,
    datecreation timestamp without time zone
);


ALTER TABLE public.message OWNER TO postgres;

--
-- Name: message_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.message_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.message_id_seq OWNER TO postgres;

--
-- Name: message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.message_id_seq OWNED BY public.message.id;


--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    id integer NOT NULL,
    rang character varying(4),
    libelle character varying(100)
);


ALTER TABLE public.role OWNER TO postgres;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO postgres;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_id_seq OWNED BY public.role.id;


--
-- Name: seq_num_appro; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_num_appro
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_num_appro OWNER TO postgres;

--
-- Name: seq_num_article; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_num_article
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_num_article OWNER TO postgres;

--
-- Name: seq_num_client; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_num_client
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_num_client OWNER TO postgres;

--
-- Name: seq_num_frs; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_num_frs
    START WITH 20
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_num_frs OWNER TO postgres;

--
-- Name: seq_num_vente; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.seq_num_vente
    START WITH 200
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.seq_num_vente OWNER TO postgres;

--
-- Name: type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.type (
    id integer NOT NULL,
    type character varying(5) NOT NULL,
    nomtype character varying(50) NOT NULL
);


ALTER TABLE public.type OWNER TO postgres;

--
-- Name: type_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_id_seq OWNER TO postgres;

--
-- Name: type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.type_id_seq OWNED BY public.type.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(100),
    password character varying(100),
    email character varying(250),
    dateconnexion timestamp without time zone,
    groupeuser_id integer
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: v_check_client; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_check_client AS
 SELECT cl.id,
    cl.nomclient,
    cd.numcommande
   FROM (public.client cl
     LEFT JOIN public.commande cd ON ((cl.id = cd.client_id)))
  ORDER BY cl.id;


ALTER TABLE public.v_check_client OWNER TO postgres;

--
-- Name: v_check_commande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_check_commande AS
 SELECT cd.id,
    cd.numcommande,
    cl.nomclient,
    sum((l.quantite * a.prixunitaire)) AS sum
   FROM (((public.commande cd
     LEFT JOIN public.client cl ON ((cd.client_id = cl.id)))
     LEFT JOIN public.lignecommande l ON ((cd.id = l.commande_id)))
     LEFT JOIN public.article a ON ((l.article_id = a.id)))
  GROUP BY cd.id, cd.numcommande, cl.nomclient
  ORDER BY cd.id;


ALTER TABLE public.v_check_commande OWNER TO postgres;

--
-- Name: v_detail_commande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_detail_commande AS
 SELECT l.id,
    cd.id AS commande_id,
    cd.numcommande,
    cd.datecommande,
    cl.nomclient,
    ar.numarticle,
    ar.designation,
    ar.prixunitaire,
    l.quantite,
    sum((l.quantite * ar.prixunitaire)) AS total
   FROM (((public.lignecommande l
     LEFT JOIN public.commande cd ON ((l.commande_id = cd.id)))
     LEFT JOIN public.client cl ON ((cd.client_id = cl.id)))
     LEFT JOIN public.article ar ON ((l.article_id = ar.id)))
  GROUP BY l.id, cd.id, cd.numcommande, cd.datecommande, cl.nomclient, ar.numarticle, ar.designation, ar.prixunitaire, l.quantite
  ORDER BY cd.numcommande;


ALTER TABLE public.v_detail_commande OWNER TO postgres;

--
-- Name: v_liste_commande; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_liste_commande AS
 SELECT cd.id,
    cd.numcommande,
    cd.typecommande,
    cd.datecommande,
    cd.client_id,
    cl.nomclient,
    sum((l.quantite * a.prixunitaire)) AS montant
   FROM (((public.commande cd
     LEFT JOIN public.client cl ON ((cl.id = cd.client_id)))
     LEFT JOIN public.lignecommande l ON ((cd.id = l.commande_id)))
     LEFT JOIN public.article a ON ((a.id = l.article_id)))
  GROUP BY cd.id, cd.numcommande, cd.typecommande, cd.datecommande, cd.client_id, cl.nomclient
  ORDER BY cd.id DESC;


ALTER TABLE public.v_liste_commande OWNER TO postgres;

--
-- Name: appro id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appro ALTER COLUMN id SET DEFAULT nextval('public.appro_id_seq'::regclass);


--
-- Name: article id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article ALTER COLUMN id SET DEFAULT nextval('public.article_id_seq'::regclass);


--
-- Name: client id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- Name: commande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande ALTER COLUMN id SET DEFAULT nextval('public.commande_id_seq'::regclass);


--
-- Name: fournisseur id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fournisseur ALTER COLUMN id SET DEFAULT nextval('public.fournisseur_id_seq'::regclass);


--
-- Name: groupeuser id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.groupeuser ALTER COLUMN id SET DEFAULT nextval('public.groupeuser_id_seq'::regclass);


--
-- Name: ligneappro id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligneappro ALTER COLUMN id SET DEFAULT nextval('public.ligneappro_id_seq'::regclass);


--
-- Name: lignecommande id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lignecommande ALTER COLUMN id SET DEFAULT nextval('public.lignecommande_id_seq'::regclass);


--
-- Name: message id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.message ALTER COLUMN id SET DEFAULT nextval('public.message_id_seq'::regclass);


--
-- Name: role id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role ALTER COLUMN id SET DEFAULT nextval('public.role_id_seq'::regclass);


--
-- Name: type id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type ALTER COLUMN id SET DEFAULT nextval('public.type_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: appro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.appro (id, numappro, fournisseur_id, dateappro) FROM stdin;
8	APP000057	1	2020-10-02 00:00:00
9	APP000058	1	2021-02-15 00:00:00
10	APP000059	2	2022-07-12 00:00:00
11	APP000060	3	2020-01-15 00:00:00
12	APP000061	4	2021-05-04 00:00:00
13	APP000062	4	2022-09-02 00:00:00
14	APP000063	5	2021-08-15 00:00:00
\.


--
-- Data for Name: article; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.article (id, numarticle, designation, prixunitaire, prixrevient, photo) FROM stdin;
9	ART000208	Pommes de terre 1kg	3.50	3.00	potatoes-vegetables-erdfrucht-bio-144248.jpeg
6	ART000205	Fromage râpé 500g	2.50	1.10	pexels-photo-6659626.jpeg
8	ART000207	Jus de carotte 75cl	3.65	2.00	pexels-photo-4443451.jpeg
3	ART000202	Jus de pomme 5L	12.50	8.50	pexels-photo.webp
5	ART000204	sirop de grenadine 75cl	4.50	2.60	pexels-photo-11868780.webp
1	ART000200	Jus ananas 1l	2.80	2.00	pexels-photo-8963466.jpeg
4	ART000203	Farine de blé 1kg	0.85	0.23	flour-powder-wheat-jar.jpg
10	ART000209	Riz thaï 10kg	10.00	8.50	pexels-photo-674574.webp
2	ART000011	Riz basmati 20kg	15.00	10.00	pexels-photo-724300.webp
7	ART000206	Pommes 1kg	3.45	2.65	pexels-photo-1510392.jpeg
29	ART000223	Tomates 1kg	3.21	2.05	pexels-photo-1327838.png
\.


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client (id, numclient, nomclient, adresseclient, telephoneclient, photo, typeclient) FROM stdin;
6	CLT000205	Lou	Paris	0607012310	pexels-photo-14734651.jpeg	CLT
5	CLT000204	Sarah	Pau	0656987910	pexels-photo-14734608.jpeg	CLT
16	CLT000215	Leclerc	Brest	0684723325	pexels-photo-14734685.jpeg	FRS
15	CLT000214	Carrefour	Saintes	0745665872	pexels-photo-14734670.jpeg	FRS
14	CLT000213	Casino	Toulouse	0687253325	pexels-photo-14734668.jpeg	FRS
13	CLT000212	Super U	Nantes	0745698255	pexels-photo-14538597.jpeg	FRS
12	CLT000211	Intermarche	Angouleme	0741233325	pexels-photo-14538638.jpeg	FRS
11	CLT000210	Auchan	Bordeaux	0745693325	pexels-photo-14734608.jpeg	FRS
17	CLT000216	Pierre	Angouleme	0606060606	pexels-photo-14384825.jpeg	CLT
1	CLT000200	Marie	Paris	0607080910	pexels-photo-14384825.jpeg	CLT
2	CLT000201	Paul	Bordeaux	0623480910	pexels-photo-14538597.jpeg	CLT
3	CLT000202	Lola	Nantes	0607012340	pexels-photo-14538638.jpeg	CLT
22	CLT000220	Luna	Nantes	0606060606	pexels-photo-14734566.jpeg	CLT
4	CLT000203	Paul	Rennes	0607084342	pexels-photo-14734566.jpeg	CLT
\.


--
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.commande (id, numcommande, client_id, datecommande, typecommande) FROM stdin;
2	CMD000201	1	2021-02-15 00:00:00	FACT
4	CMD000203	2	2020-01-15 00:00:00	FACT
5	CMD000204	3	2021-05-04 00:00:00	FACT
6	CMD000205	4	2022-09-02 00:00:00	FACT
28	CMD000227	2	2022-12-02 00:00:00	DEV
29	CMD000228	3	2020-05-05 00:00:00	DEV
31	CMD000230	4	2022-03-12 00:00:00	DEV
32	CMD000231	1	2022-01-02 00:00:00	DEV
33	CMD000232	6	2020-04-15 00:00:00	DEV
34	CMD000233	11	2020-07-06 00:00:00	LIV
35	CMD000234	12	2022-10-06 00:00:00	LIV
36	CMD000235	13	2022-02-08 00:00:00	LIV
37	CMD000236	14	2020-10-20 00:00:00	LIV
38	CMD000237	15	2022-10-06 00:00:00	LIV
39	CMD000238	16	2020-12-13 00:00:00	LIV
40	CMD000239	11	2020-07-06 00:00:00	APP
44	CMD000243	14	2022-06-06 00:00:00	APP
7	CMD000206	1	2021-08-15 00:00:00	FACT
30	CMD000229	4	2021-09-02 00:00:00	FACT
3	CMD000202	2	2022-07-12 00:00:00	LIV
1	CMD000200	1	2020-10-02 00:00:00	DEV
45	CMD000244	11	2022-07-20 00:00:00	APP
50	CMD000249	3	2023-01-06 00:00:00	CLT
51	CMD000250	1	2023-01-06 00:00:00	CLT
52	CMD000251	16	2023-01-26 00:00:00	DEV
\.


--
-- Data for Name: fournisseur; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.fournisseur (id, numfournisseur, nomfournisseur, adressefournisseur, telephonefournisseur) FROM stdin;
1	FRS000050	Auchan	Bordeaux	0605684110
2	FRS000051	Leclerc	Nantes	0658432910
3	FRS000052	Intermarche	Poitiers	0568497340
4	FRS000053	Super U	Brest	0617084321
5	FRS000054	Carrefour	Angoulˆme	0556587510
\.


--
-- Data for Name: groupeuser; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.groupeuser (id, libelle, roles) FROM stdin;
1	ADMINISTRATEUR	["ROLE_USER", "ROLE_DIRECTION", "ROLE_STAGIAIRE", "ROLE_VENTE", "ROLE_ADMIN"]
2	DIRECTION	["ROLE_USER", "ROLE_DIRECTION", "ROLE_STAGIAIRE", "ROLE_VENTE"]
4	STAGIAIRE	["ROLE-USER", "ROLE_STAGIAIRE"]
5	AUTRE	["ROLE_USER","ROLE_CAISSE","ROLE_ASSISTANT"]
7	USER	["ROLE_USER"]
8	TEST	["ROLE_USER","ROLE_VENTE","ROLE_CAISSE"]
3	ASSISTANT DIRECTION	["ROLE_USER","ROLE_VENTE","ROLE_STAGIAIRE","ROLE_ASSISTANT","ROLE_DIRECTION"]
\.


--
-- Data for Name: ligneappro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ligneappro (id, appro_id, article_id, quantite) FROM stdin;
1	8	1	20.00
2	8	6	10.00
3	9	2	50.00
4	9	7	100.00
5	10	3	50.00
6	10	4	60.00
7	10	5	40.00
8	11	10	100.00
9	12	8	200.00
10	13	1	20.00
11	13	6	40.00
12	13	7	30.00
13	14	9	100.00
\.


--
-- Data for Name: lignecommande; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lignecommande (id, commande_id, article_id, quantite) FROM stdin;
1	1	2	2.00
2	1	6	5.00
3	1	8	1.00
4	1	10	1.00
5	1	3	10.00
6	1	7	2.00
7	2	1	1.00
8	2	8	8.00
9	3	5	1.00
10	3	6	1.00
11	3	7	1.00
12	3	10	1.00
13	4	10	5.00
14	5	4	2.00
15	6	1	5.00
16	6	6	4.00
17	6	10	3.00
18	7	5	1.00
19	7	6	6.00
20	7	8	1.00
21	7	9	2.00
22	7	10	1.00
23	33	7	2.00
24	1	7	2.00
25	40	4	200.00
26	45	1	200.00
27	44	10	50.00
28	44	3	12.00
29	44	3	150.00
30	45	6	50.00
31	39	2	12.00
32	39	5	65.00
33	50	8	2.00
34	50	2	1.00
35	50	1	3.00
36	50	7	1.00
37	38	9	50.00
38	38	3	112.00
39	38	8	75.00
40	38	4	25.00
41	37	8	115.00
42	36	6	65.00
43	36	5	20.00
44	36	2	16.00
45	35	5	80.00
46	34	4	153.00
47	33	3	1.00
48	33	4	2.00
49	32	5	1.00
50	31	5	1.00
51	31	2	1.00
52	31	8	2.00
53	31	6	1.00
54	31	4	1.00
55	30	3	2.00
56	29	7	2.00
57	29	1	1.00
58	29	8	1.00
59	28	5	2.00
60	51	29	2.00
61	51	9	1.00
62	51	1	2.00
63	51	10	1.00
64	51	3	1.00
65	51	6	3.00
66	51	3	5.00
67	52	8	2.00
68	52	3	10.00
\.


--
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.message (id, auteur, message, datecreation) FROM stdin;
2	Marie	Bonjour !	\N
3	Marie	Bonjour Paul, comment tu vas ?	2022-12-14 23:02:29.467389
4	Paul	Bonjour Marie, je vais bien. Et toi ?	2022-12-14 23:02:29.467389
5	Marie	Bien !	\N
6	Marie	Bonjour !!	\N
7	Marie	bien	\N
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role (id, rang, libelle) FROM stdin;
3	0003	ROLE_CAISSE
4	0004	ROLE_DEPOT
5	0005	ROLE_STAGIAIRE
6	0006	ROLE_ASSISTANT
7	0007	ROLE_DIRECTION
8	0008	ROLE_ADMIN
1	0001	ROLE_USER
2	0002	ROLE_VENTE
\.


--
-- Data for Name: type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.type (id, type, nomtype) FROM stdin;
1	CLT	client
2	FRS	fournisseur
3	FACT	facture
4	DEV	devis
5	LIV	livraison
6	APP	approvisionnement
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, password, email, dateconnexion, groupeuser_id) FROM stdin;
4	Alpha	b70dc1a8cb8ef994dbc035d241d154d7	alpha@mail.com	\N	2
2	Lolo	81dc9bdb52d04dc20036dbd8313ed055	lolo@localhost.com	2023-01-02 18:11:49.383843	3
1	Toto	d93591bdf7860e1e4ee2fca799911215	toto@localhost.com	2023-01-02 18:11:41.623757	5
12	Machin	b70dc1a8cb8ef994dbc035d241d154d7	machin@mail.com	\N	4
\.


--
-- Name: appro_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.appro_id_seq', 14, true);


--
-- Name: article_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.article_id_seq', 34, true);


--
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_id_seq', 23, true);


--
-- Name: commande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.commande_id_seq', 52, true);


--
-- Name: fournisseur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.fournisseur_id_seq', 5, true);


--
-- Name: groupeuser_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.groupeuser_id_seq', 11, true);


--
-- Name: ligneappro_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ligneappro_id_seq', 13, true);


--
-- Name: lignecommande_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lignecommande_id_seq', 68, true);


--
-- Name: message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.message_id_seq', 7, true);


--
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_id_seq', 10, true);


--
-- Name: seq_num_appro; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_num_appro', 63, true);


--
-- Name: seq_num_article; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_num_article', 225, true);


--
-- Name: seq_num_client; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_num_client', 221, true);


--
-- Name: seq_num_frs; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_num_frs', 54, true);


--
-- Name: seq_num_vente; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.seq_num_vente', 251, true);


--
-- Name: type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.type_id_seq', 6, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 13, true);


--
-- Name: appro appro_numappro_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appro
    ADD CONSTRAINT appro_numappro_key UNIQUE (numappro);


--
-- Name: appro appro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appro
    ADD CONSTRAINT appro_pkey PRIMARY KEY (id);


--
-- Name: article article_numarticle_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_numarticle_key UNIQUE (numarticle);


--
-- Name: article article_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article
    ADD CONSTRAINT article_pkey PRIMARY KEY (id);


--
-- Name: client client_numclient_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_numclient_key UNIQUE (numclient);


--
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- Name: commande commande_numcommande_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_numcommande_key UNIQUE (numcommande);


--
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id);


--
-- Name: fournisseur fournisseur_numfournisseur_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fournisseur
    ADD CONSTRAINT fournisseur_numfournisseur_key UNIQUE (numfournisseur);


--
-- Name: fournisseur fournisseur_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.fournisseur
    ADD CONSTRAINT fournisseur_pkey PRIMARY KEY (id);


--
-- Name: groupeuser groupeuser_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.groupeuser
    ADD CONSTRAINT groupeuser_pkey PRIMARY KEY (id);


--
-- Name: ligneappro ligneappro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligneappro
    ADD CONSTRAINT ligneappro_pkey PRIMARY KEY (id);


--
-- Name: lignecommande lignecommande_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lignecommande
    ADD CONSTRAINT lignecommande_pkey PRIMARY KEY (id);


--
-- Name: message message_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT message_pkey PRIMARY KEY (id);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: type type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.type
    ADD CONSTRAINT type_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: appro appro_fournisseur_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.appro
    ADD CONSTRAINT appro_fournisseur_id_fkey FOREIGN KEY (fournisseur_id) REFERENCES public.fournisseur(id);


--
-- Name: commande commande_client_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_client_id_fkey FOREIGN KEY (client_id) REFERENCES public.client(id);


--
-- Name: ligneappro ligneappro_appro_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligneappro
    ADD CONSTRAINT ligneappro_appro_id_fkey FOREIGN KEY (appro_id) REFERENCES public.appro(id);


--
-- Name: ligneappro ligneappro_article_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ligneappro
    ADD CONSTRAINT ligneappro_article_id_fkey FOREIGN KEY (article_id) REFERENCES public.article(id);


--
-- Name: lignecommande lignecommande_article_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lignecommande
    ADD CONSTRAINT lignecommande_article_id_fkey FOREIGN KEY (article_id) REFERENCES public.article(id);


--
-- Name: lignecommande lignecommande_commande_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lignecommande
    ADD CONSTRAINT lignecommande_commande_id_fkey FOREIGN KEY (commande_id) REFERENCES public.commande(id);


--
-- Name: users users_groupeuser_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_groupeuser_id_fkey FOREIGN KEY (groupeuser_id) REFERENCES public.groupeuser(id);


--
-- PostgreSQL database dump complete
--

