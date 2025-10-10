--
-- PostgreSQL database dump
--

\restrict q4HoRbzovxivO4JmNSZM2dwEBAa0PgyRWVORLeBE4Qt82Lne30VypqIURiJAhnK

-- Dumped from database version 17.6
-- Dumped by pg_dump version 17.6

-- Started on 2025-10-10 14:50:29

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 223 (class 1259 OID 41929)
-- Name: cache; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO "BPJS123";

--
-- TOC entry 224 (class 1259 OID 41936)
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO "BPJS123";

--
-- TOC entry 229 (class 1259 OID 41961)
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO "BPJS123";

--
-- TOC entry 228 (class 1259 OID 41960)
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: BPJS123
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO "BPJS123";

--
-- TOC entry 4901 (class 0 OID 0)
-- Dependencies: 228
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: BPJS123
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 233 (class 1259 OID 41984)
-- Name: fkrtl; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.fkrtl (
    id bigint NOT NULL,
    id_fkrtl character varying(255) NOT NULL,
    kode_rumah_sakit character varying(255) NOT NULL,
    nama_rumah_sakit character varying(255) NOT NULL,
    jenis character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.fkrtl OWNER TO "BPJS123";

--
-- TOC entry 232 (class 1259 OID 41983)
-- Name: fkrtl_id_seq; Type: SEQUENCE; Schema: public; Owner: BPJS123
--

CREATE SEQUENCE public.fkrtl_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.fkrtl_id_seq OWNER TO "BPJS123";

--
-- TOC entry 4902 (class 0 OID 0)
-- Dependencies: 232
-- Name: fkrtl_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: BPJS123
--

ALTER SEQUENCE public.fkrtl_id_seq OWNED BY public.fkrtl.id;


--
-- TOC entry 227 (class 1259 OID 41953)
-- Name: job_batches; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO "BPJS123";

--
-- TOC entry 226 (class 1259 OID 41944)
-- Name: jobs; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO "BPJS123";

--
-- TOC entry 225 (class 1259 OID 41943)
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: BPJS123
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO "BPJS123";

--
-- TOC entry 4903 (class 0 OID 0)
-- Dependencies: 225
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: BPJS123
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- TOC entry 218 (class 1259 OID 41896)
-- Name: migrations; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO "BPJS123";

--
-- TOC entry 217 (class 1259 OID 41895)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: BPJS123
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO "BPJS123";

--
-- TOC entry 4904 (class 0 OID 0)
-- Dependencies: 217
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: BPJS123
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 221 (class 1259 OID 41913)
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO "BPJS123";

--
-- TOC entry 231 (class 1259 OID 41973)
-- Name: pelayanan; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.pelayanan (
    id bigint NOT NULL,
    nama_fkrtl character varying(100) NOT NULL,
    jenis_pelayanan character varying(50) NOT NULL,
    jumlah_kasus integer NOT NULL,
    biaya numeric(18,2) DEFAULT '0'::numeric NOT NULL,
    tgl_bast date,
    no_bast character varying(50),
    max_tgl_bakb date,
    tgl_bakb date,
    no_bakb character varying(50),
    max_tgl_bahv date,
    tgl_bahv date,
    no_bahv character varying(50),
    kasus_hv character varying(50),
    biaya_hv numeric(18,2) DEFAULT '0'::numeric NOT NULL,
    umk numeric(18,2) DEFAULT '0'::numeric NOT NULL,
    koreksi numeric(18,2) DEFAULT '0'::numeric NOT NULL,
    tgl_reg_boa date,
    tgl_jt date,
    memorial character varying(50),
    voucher character varying(50),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    memorial_file character varying(255),
    voucher_file character varying(255),
    detail_pelayanan character varying(255),
    bulan_pelayanan date NOT NULL,
    tgl_bayar date,
    voucher_pdf character varying(255),
    memorial_pdf character varying(255),
    kasus_pending integer DEFAULT 0 NOT NULL,
    biaya_pending numeric(15,2) DEFAULT '0'::numeric NOT NULL,
    kasus_tidak_layak integer DEFAULT 0 NOT NULL,
    biaya_tidak_layak numeric(15,2) DEFAULT '0'::numeric NOT NULL,
    kasus_dispute integer DEFAULT 0 NOT NULL,
    biaya_dispute numeric(15,2) DEFAULT '0'::numeric NOT NULL
);


ALTER TABLE public.pelayanan OWNER TO "BPJS123";

--
-- TOC entry 230 (class 1259 OID 41972)
-- Name: pelayanan_id_seq; Type: SEQUENCE; Schema: public; Owner: BPJS123
--

CREATE SEQUENCE public.pelayanan_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pelayanan_id_seq OWNER TO "BPJS123";

--
-- TOC entry 4905 (class 0 OID 0)
-- Dependencies: 230
-- Name: pelayanan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: BPJS123
--

ALTER SEQUENCE public.pelayanan_id_seq OWNED BY public.pelayanan.id;


--
-- TOC entry 222 (class 1259 OID 41920)
-- Name: sessions; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO "BPJS123";

--
-- TOC entry 220 (class 1259 OID 41903)
-- Name: users; Type: TABLE; Schema: public; Owner: BPJS123
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role character varying(255) DEFAULT 'verifikator'::character varying NOT NULL,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['admin'::character varying, 'keuangan'::character varying, 'finance'::character varying, 'verifikator'::character varying, 'PMU'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO "BPJS123";

--
-- TOC entry 219 (class 1259 OID 41902)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: BPJS123
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO "BPJS123";

--
-- TOC entry 4906 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: BPJS123
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 4690 (class 2604 OID 41964)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 4703 (class 2604 OID 41987)
-- Name: fkrtl id; Type: DEFAULT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.fkrtl ALTER COLUMN id SET DEFAULT nextval('public.fkrtl_id_seq'::regclass);


--
-- TOC entry 4689 (class 2604 OID 41947)
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- TOC entry 4686 (class 2604 OID 41899)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 4692 (class 2604 OID 41976)
-- Name: pelayanan id; Type: DEFAULT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.pelayanan ALTER COLUMN id SET DEFAULT nextval('public.pelayanan_id_seq'::regclass);


--
-- TOC entry 4687 (class 2604 OID 41906)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 4885 (class 0 OID 41929)
-- Dependencies: 223
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.cache (key, value, expiration) FROM stdin;
captcha_c32996122ff08591ab7850748bcefac8	a:4:{i:0;s:1:"8";i:1;s:1:"t";i:2;s:1:"3";i:3;s:1:"u";}	1759571576
captcha_99d1cab2b8c153902c06de10da561e1d	a:4:{i:0;s:1:"m";i:1;s:1:"g";i:2;s:1:"a";i:3;s:1:"t";}	1759571589
captcha_0df9f00a4c40ebef9675b1168f62b963	a:4:{i:0;s:1:"e";i:1;s:1:"b";i:2;s:1:"d";i:3;s:1:"e";}	1759571593
captcha_53706c465f749e96682399e4072bcc2a	a:4:{i:0;s:1:"d";i:1;s:1:"6";i:2;s:1:"x";i:3;s:1:"p";}	1759990544
captcha_a76ece192c16b6ad1a30ef934ed7fc99	a:4:{i:0;s:1:"u";i:1;s:1:"u";i:2;s:1:"n";i:3;s:1:"4";}	1760067833
captcha_ab374ecad0057d6f67bd756866c3ebb2	a:4:{i:0;s:1:"x";i:1;s:1:"n";i:2;s:1:"q";i:3;s:1:"x";}	1759571967
captcha_187d0e3e771fbcba443cab3331895022	a:4:{i:0;s:1:"u";i:1;s:1:"n";i:2;s:1:"m";i:3;s:1:"h";}	1760067937
captcha_2a82caf01630dd19c3dac6e97d77e400	a:4:{i:0;s:1:"z";i:1;s:1:"a";i:2;s:1:"6";i:3;s:1:"q";}	1759722402
captcha_d2d99905e2e20e03c6e0ae462ecc9c88	a:4:{i:0;s:1:"b";i:1;s:1:"8";i:2;s:1:"q";i:3;s:1:"7";}	1759722406
captcha_a6b444428f08609e6387a725b8537383	a:4:{i:0;s:1:"x";i:1;s:1:"m";i:2;s:1:"z";i:3;s:1:"4";}	1759723034
captcha_6c0fb9455bce3d6bfc14ba56a5a337d8	a:4:{i:0;s:1:"4";i:1;s:1:"d";i:2;s:1:"z";i:3;s:1:"t";}	1759737178
captcha_ce08696f9a8e8eb64441a4a183b39c01	a:4:{i:0;s:1:"2";i:1;s:1:"g";i:2;s:1:"q";i:3;s:1:"a";}	1759737195
captcha_38e3877244feb2b3227fb4e503d5680b	a:4:{i:0;s:1:"c";i:1;s:1:"r";i:2;s:1:"e";i:3;s:1:"h";}	1759737199
captcha_079852d5fcfe33a2bef3b804369ee153	a:4:{i:0;s:1:"z";i:1;s:1:"7";i:2;s:1:"9";i:3;s:1:"9";}	1760077496
captcha_d4d8760b8ba44ca2c75056693da22ac4	a:4:{i:0;s:1:"t";i:1;s:1:"z";i:2;s:1:"r";i:3;s:1:"c";}	1760078745
captcha_9956835b8315b44a7cb99158273bd8e0	a:4:{i:0;s:1:"e";i:1;s:1:"z";i:2;s:1:"a";i:3;s:1:"8";}	1760080189
captcha_84fd0381df1bd1578db67db23077f7d7	a:4:{i:0;s:1:"z";i:1;s:1:"q";i:2;s:1:"t";i:3;s:1:"e";}	1760081490
captcha_f0d70f2b05477f6ade16ea4baf7cbeee	a:4:{i:0;s:1:"m";i:1;s:1:"a";i:2;s:1:"y";i:3;s:1:"e";}	1759836446
captcha_e713f4963406b26b11a8e8c61231f3d4	a:4:{i:0;s:1:"p";i:1;s:1:"4";i:2;s:1:"q";i:3;s:1:"y";}	1759836526
captcha_3f6cf26323e7244d55a214911c16a892	a:4:{i:0;s:1:"f";i:1;s:1:"h";i:2;s:1:"y";i:3;s:1:"t";}	1759836580
captcha_8ad5d2540101e883606f52d2a8dff94f	a:4:{i:0;s:1:"e";i:1;s:1:"b";i:2;s:1:"y";i:3;s:1:"9";}	1759937088
captcha_4c1e3226c262bb1c03796547a403d881	a:4:{i:0;s:1:"g";i:1;s:1:"h";i:2;s:1:"p";i:3;s:1:"g";}	1759937138
captcha_cd70edec6789ffa2c70895d0b03baa67	a:4:{i:0;s:1:"q";i:1;s:1:"p";i:2;s:1:"x";i:3;s:1:"r";}	1759937166
captcha_46fdfa324e77bcd641a3c5cc31055703	a:4:{i:0;s:1:"h";i:1;s:1:"3";i:2;s:1:"d";i:3;s:1:"q";}	1759937355
captcha_da333c90f4250741ce36edea06d51042	a:4:{i:0;s:1:"8";i:1;s:1:"4";i:2;s:1:"d";i:3;s:1:"4";}	1759937454
captcha_b3e8d66f3e30aa46852ac7e51436b362	a:4:{i:0;s:1:"b";i:1;s:1:"g";i:2;s:1:"a";i:3;s:1:"t";}	1759937462
captcha_98b771a7cba2d92da202c421fccae73f	a:4:{i:0;s:1:"m";i:1;s:1:"a";i:2;s:1:"z";i:3;s:1:"m";}	1759973098
captcha_698c4d624fd5560b48da37674f7a090f	a:4:{i:0;s:1:"j";i:1;s:1:"6";i:2;s:1:"f";i:3;s:1:"y";}	1759974206
captcha_b25318710de2af5cd7627853523158c6	a:4:{i:0;s:1:"a";i:1;s:1:"y";i:2;s:1:"z";i:3;s:1:"r";}	1759974447
captcha_891feb6b1c8ddf6989b7661e71fd82a6	a:4:{i:0;s:1:"y";i:1;s:1:"u";i:2;s:1:"p";i:3;s:1:"n";}	1759372883
\.


--
-- TOC entry 4886 (class 0 OID 41936)
-- Dependencies: 224
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 4891 (class 0 OID 41961)
-- Dependencies: 229
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- TOC entry 4895 (class 0 OID 41984)
-- Dependencies: 233
-- Data for Name: fkrtl; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.fkrtl (id, id_fkrtl, kode_rumah_sakit, nama_rumah_sakit, jenis, created_at, updated_at) FROM stdin;
1	0120A046	RS001	Apotik IF RS AMC BANDUNG	Apotik	2025-09-23 04:29:32	2025-09-23 04:29:32
2	0120A044	RS002	Apotik IF RSUD Cicalengka	Apotik	2025-09-23 04:29:32	2025-09-23 04:29:32
3	0120A042	RS003	Apotik IF RSUD MAJALAYA	Apotik	2025-09-23 04:29:32	2025-09-23 04:29:32
4	0120A068	RS004	IF Hermina Soreang	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
5	0120A070	RS005	IF KU Hasna Medika Bandung	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
6	0120A076	RS006	IF RS BEDAS KERTASARI	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
7	0120A075	RS007	IF RS LANUD SULAIMAN	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
8	0120A071	RS008	IF RS OETOMO	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
9	1002A009	RS009	IF RSUD Al Ihsan	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
10	0120A074	RS010	IF RSUD BEDAS CIMAUNG	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
11	0120A043	RS011	IF RSUD OTO ISKANDAR DI NATA	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
12	0120A065	RS012	IF RS UKM	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
13	0120A066	RS013	IF RSUD KESEHATAN KERJA	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
14	0120A067	RS014	IF RSU KPBS	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
15	0120A069	RS015	IF KU GENTA ARAS SALAMA	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
16	0120A073	RS016	IF RSMBS	Instalasi Farmasi	2025-09-23 04:29:32	2025-09-23 04:29:32
17	0120S001	RS017	KU GENTA ARAS SALAMA	Klinik Utama	2025-09-23 04:29:32	2025-09-23 04:29:32
18	0120S003	RS018	KU HASNA MEDIKA BANDUNG	Klinik Utama	2025-09-23 04:29:32	2025-09-23 04:29:32
19	0120R014	RS019	RSU KPBS	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
20	0120O005	OPT001	KING OPTIK	Optik	2025-09-23 04:29:32	2025-09-23 04:29:32
21	0120O006	OPT002	MERCURY OPTIKAL	Optik	2025-09-23 04:29:32	2025-09-23 04:29:32
22	0120R022	RS020	MUHAMMADIYAH BANDUNG SELATAN	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
23	0120O002	OPT003	OPTIK IMAN	Optik	2025-09-23 04:29:32	2025-09-23 04:29:32
24	0120O007	OPT004	OPTIK INTERNASIONAL	Optik	2025-09-23 04:29:32	2025-09-23 04:29:32
25	0120O004	OPT005	Optik Krida	Optik	2025-09-23 04:29:32	2025-09-23 04:29:32
26	0120R007	RS021	RS AMC	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
27	0120R018	RS022	RS HERMINA SOREANG	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
28	0120R012	RS023	RS LANUD SULAIMAN	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
29	0120R020	RS024	RS RUMAH SAKIT OETOMO	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
30	0120R015	RS025	RS UNGGUL KARSA MEDIKA	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
31	1002R005	RS026	RSUD AL IHSAN	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
32	0120R023	RS027	RSUD BEDAS CIMAUNG	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
33	0120R024	RS028	RSUD BEDAS KERTASARI	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
34	0120R004	RS029	RSUD CICALENGKA	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
35	0120R017	RS030	RSUD KESEHATAN KERJA	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
36	1002R002	RS031	RSUD MAJALAYA	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
37	1002R006	RS032	RSUD OTO ISKANDAR DI NATA	Rumah Sakit	2025-09-23 04:29:32	2025-09-23 04:29:32
\.


--
-- TOC entry 4889 (class 0 OID 41953)
-- Dependencies: 227
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- TOC entry 4888 (class 0 OID 41944)
-- Dependencies: 226
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- TOC entry 4880 (class 0 OID 41896)
-- Dependencies: 218
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_09_07_112817_create_pelayanan_table	1
5	2025_09_08_032313_add_tanggal_bast_to_pelayanan_table	1
6	2025_09_08_130223_create_fkrtl_table	1
7	2025_09_09_032255_add_file_columns_to_pelayanan_table	1
8	2025_09_10_012650_add_detail_pelayanan_to_pelayanan_table	1
9	2025_09_11_131620_change_bulan_pelayanan_to_date	1
10	2025_09_16_041931_add_tgl_bayar_to_pelayanan_table	1
11	2025_09_17_032458_add_role_to_table_user_table	1
12	2025_09_19_035959_add_pdf_columns_to_pelayanan_table	1
13	2025_09_22_013712_add_pending_dispute_fields_to_pelayanan_table	1
14	2025_09_23_041738_alter_role_check_constraint_in_users_table	1
15	2025_09_24_061257_alter_role_column_in_users_table	2
16	2025_09_29_023831_update_role_check_in_users_table	3
\.


--
-- TOC entry 4883 (class 0 OID 41913)
-- Dependencies: 221
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- TOC entry 4893 (class 0 OID 41973)
-- Dependencies: 231
-- Data for Name: pelayanan; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.pelayanan (id, nama_fkrtl, jenis_pelayanan, jumlah_kasus, biaya, tgl_bast, no_bast, max_tgl_bakb, tgl_bakb, no_bakb, max_tgl_bahv, tgl_bahv, no_bahv, kasus_hv, biaya_hv, umk, koreksi, tgl_reg_boa, tgl_jt, memorial, voucher, created_at, updated_at, memorial_file, voucher_file, detail_pelayanan, bulan_pelayanan, tgl_bayar, voucher_pdf, memorial_pdf, kasus_pending, biaya_pending, kasus_tidak_layak, biaya_tidak_layak, kasus_dispute, biaya_dispute) FROM stdin;
1	Apotik IF RS AMC BANDUNG	RITL	5	5000000.00	\N	\N	\N	\N	\N	\N	\N	\N	\N	0.00	0.00	0.00	\N	\N	\N	\N	2025-10-10 07:42:00	2025-10-10 07:42:00	\N	\N	\N	2025-10-01	\N	\N	\N	0	0.00	0	0.00	0	0.00
\.


--
-- TOC entry 4884 (class 0 OID 41920)
-- Dependencies: 222
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
iHzNk6wGBaVJYAWlob9iVvIglVtYLMLgprUUTgpY	9	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSVhEbkkxRzVaVnBOYVVtZWlRMTNmaEN2UGxDQ2I1QXN0Vk5BTkNtUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZWxheWFuYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=	1760082121
\.


--
-- TOC entry 4882 (class 0 OID 41903)
-- Dependencies: 220
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: BPJS123
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role) FROM stdin;
9	Admin AK	Ak12@gmail.com	\N	$2y$12$0FV5K/nTU/yRe2nzYpnXretzBBc7wYe9VDHy.dnFhQEL/wiq5Saqm	\N	2025-09-24 06:37:00	2025-09-24 06:37:00	admin
10	Staff Pembukuan	keuangan@gmail.com	\N	$2y$12$9WhwT.y0dSeoevEu.FKY.uGGf1vwImQq32Slbicbkw6TfgiAJTQiS	\N	2025-09-24 06:37:01	2025-09-24 06:37:01	keuangan
11	Staff Kasir	finance@gmail.com	\N	$2y$12$hPB1Xi9hUdV9rXOCD2o.M.7KA7dBDlBOKmd46KQRJrK5S0yaTfA0u	\N	2025-09-24 06:37:01	2025-09-24 06:37:01	finance
12	Verifikator	verifikator@gmail.com	\N	$2y$12$0MtZX7Ct95FL2RhgHivb5udyERaDBQFPqdXskQc9sABNPB7i8TWum	\N	2025-09-24 06:37:02	2025-09-24 06:37:02	verifikator
14	PMU User	pmu@gmail.com	\N	$2y$12$hOiK0Oq8w84Unl4z3ihrWOaVLIaMy3oB6eeqNvBCpVw.o7tFfnxk.	\N	2025-09-29 02:51:17	2025-09-29 02:51:17	PMU
15	Eva	eva@gmail.com	\N	$2y$12$504ifYsf.HFKyTi8MIZyVOZEZIvXk1HttdyKaelAdteaWmhvm2ncS	\N	2025-10-07 11:23:05	2025-10-07 11:23:05	finance
16	Siska	siska@gmail.com	\N	$2y$12$uy1YLHmyGUi1qAMmbbR9leMMqgiP3zjgJOPntgxK/1SE/T1usFP5S	\N	2025-10-07 11:23:05	2025-10-07 11:23:05	finance
17	Widi	widi@gmail.com	\N	$2y$12$dIC0owpGelXiTo9P/hiYAO4Z4DaKFGjVXWMLLH1kbq8wtziHJTpkG	\N	2025-10-07 11:23:06	2025-10-07 11:23:06	finance
18	Heni	heni@gmail.com	\N	$2y$12$jaQTXQ3QbQEKVZk8TXh9U.vYXF7pGBIdxD2SeQTiaOSKVMNwawPJe	\N	2025-10-07 11:23:06	2025-10-07 11:23:06	finance
19	Ucha	ucha@gmail.com	\N	$2y$12$tLRJ9MlGNgEM69SKOn7KquxE0Wg.yVUkH.2qgn2./pZJW3tEWCzT.	\N	2025-10-07 11:23:06	2025-10-07 11:23:06	finance
20	Leoni	leoni@gmail.com	\N	$2y$12$OZB4h.mvDURcId86qMkaU.Telt0yFg5ewhs1uIyCFrLrKDLOtBRbG	\N	2025-10-07 11:23:07	2025-10-07 11:23:07	finance
21	Ghalih	ghalih@gmail.com	\N	$2y$12$WtjJfLGntE9h85sT0hQhdu4pgWrU96en2Wq5byTEhwn6YCKPkD6im	\N	2025-10-07 11:23:07	2025-10-07 11:23:07	finance
22	Desi	desi@gmail.com	\N	$2y$12$7/Q0R7M/M2gIu6xbncXgZOdOchIQxlIuzTQpnw6mlhkfiwpyUYxiK	\N	2025-10-07 11:23:07	2025-10-07 11:23:07	finance
23	Meida	meida@gmail.com	\N	$2y$12$uAOTgrQ93uvjulbl9Ugui.Ob0nZmO0qj62NrWJEOPgxW3B4NR73RC	\N	2025-10-07 11:23:07	2025-10-07 11:23:07	finance
24	Wita	wita@gmail.com	\N	$2y$12$Ls4/iGqooT/fPUZ/wy0HheHoY.xYHyZ53SQfZrBj7QD4S6d/pI1eW	\N	2025-10-07 11:23:08	2025-10-07 11:23:08	finance
25	Senny	senny@gmail.com	\N	$2y$12$LjN33OEPJ.a6XGZ88G7LVepasq2PL9Bpp3ZvoV7v6L3lWowlXrSzG	\N	2025-10-07 11:23:08	2025-10-07 11:23:08	finance
26	Omar	omar@gmail.com	\N	$2y$12$0TdIrpnaTE3SowmZrzEbuO6Nivph/Tu0kc9kmSIncj.p/cZPBGpby	\N	2025-10-07 11:23:08	2025-10-07 11:23:08	finance
27	Eko	Eko@gmail.com	\N	$2y$12$G7j.DrtuliTuLJpHY84gBeaO6yR6pLXrtKhFt9iAQ6/G9TTZ7Yg2i	\N	2025-10-10 06:22:19	2025-10-10 06:22:19	admin
28	Lia	Lia@gmail.com	\N	$2y$12$M1eES5fv19xRpRBZcQV3qevWOzj1CHRdF6nXT2rXM.MTEwh4OPmmi	\N	2025-10-10 06:41:34	2025-10-10 06:41:34	finance
\.


--
-- TOC entry 4907 (class 0 OID 0)
-- Dependencies: 228
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: BPJS123
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 4908 (class 0 OID 0)
-- Dependencies: 232
-- Name: fkrtl_id_seq; Type: SEQUENCE SET; Schema: public; Owner: BPJS123
--

SELECT pg_catalog.setval('public.fkrtl_id_seq', 37, true);


--
-- TOC entry 4909 (class 0 OID 0)
-- Dependencies: 225
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: BPJS123
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- TOC entry 4910 (class 0 OID 0)
-- Dependencies: 217
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: BPJS123
--

SELECT pg_catalog.setval('public.migrations_id_seq', 16, true);


--
-- TOC entry 4911 (class 0 OID 0)
-- Dependencies: 230
-- Name: pelayanan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: BPJS123
--

SELECT pg_catalog.setval('public.pelayanan_id_seq', 1, true);


--
-- TOC entry 4912 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: BPJS123
--

SELECT pg_catalog.setval('public.users_id_seq', 28, true);


--
-- TOC entry 4720 (class 2606 OID 41942)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 4718 (class 2606 OID 41935)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 4727 (class 2606 OID 41969)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 4729 (class 2606 OID 41971)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 4733 (class 2606 OID 41991)
-- Name: fkrtl fkrtl_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.fkrtl
    ADD CONSTRAINT fkrtl_pkey PRIMARY KEY (id_fkrtl);


--
-- TOC entry 4725 (class 2606 OID 41959)
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- TOC entry 4722 (class 2606 OID 41951)
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 4706 (class 2606 OID 41901)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 4712 (class 2606 OID 41919)
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- TOC entry 4731 (class 2606 OID 41982)
-- Name: pelayanan pelayanan_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.pelayanan
    ADD CONSTRAINT pelayanan_pkey PRIMARY KEY (id);


--
-- TOC entry 4715 (class 2606 OID 41926)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 4708 (class 2606 OID 41912)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 4710 (class 2606 OID 41910)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: BPJS123
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 4723 (class 1259 OID 41952)
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: BPJS123
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- TOC entry 4713 (class 1259 OID 41928)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: BPJS123
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 4716 (class 1259 OID 41927)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: BPJS123
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


-- Completed on 2025-10-10 14:50:29

--
-- PostgreSQL database dump complete
--

\unrestrict q4HoRbzovxivO4JmNSZM2dwEBAa0PgyRWVORLeBE4Qt82Lne30VypqIURiJAhnK

