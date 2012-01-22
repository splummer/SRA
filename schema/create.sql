CREATE TABLE user (
    user_id SERIAL PRIMARY KEY NOT NULL,
    user_name character varying(15) NOT NULL,
    last_name character varying(25) NOT NULL,
    first_name character varying(25) NOT NULL,
    email character varying(35) NOT NULL,
    nickname character varying(25),
    address_1 character varying(40),
    address_2 character varying(40),
    city character varying(30),
    state character varying(20),
    zip character varying(10),
    country character varying(35),
    area_code character varying(3),
    phone3 character varying(3),
    phone4 character varying(4),
    over13 boolean DEFAULT true NOT NULL,
    contact_attend boolean DEFAULT true NOT NULL,
    contact_any boolean DEFAULT false NOT NULL,
    created timestamp with time zone NOT NULL,
    password character varying(34) NOT NULL,
    modified timestamp with time zone NOT NULL,
    last_login timestamp with time zone NOT NULL
);

CREATE TABLE organization (
    org_id SERIAL PRIMARY KEY NOT NULL,
    org_name character varying(20) NOT NULL,
    location character varying(30),
    fk_user_id integer NOT NULL,
    approved boolean DEFAULT false NOT NULL
);

CREATE TABLE event (
    event_id SERIAL PRIMARY KEY NOT NULL,
    event_name character varying(40) NOT NULL,
    event_short_name character varying(40) NOT NULL,
    start_time timestamp with time zone NOT NULL,
    end_time timestamp with time zone NOT NULL,
    event_submission boolean DEFAULT false NOT NULL,
    pre_reg boolean DEFAULT false NOT NULL,
    onsite_reg boolean DEFAULT false NOT NULL,
    active boolean DEFAULT true NOT NULL
);

CREATE TABLE event_timeslot (
	fk_con_id integer NOT NULL,
	timeslot_name character varying(155) PRIMARY KEY NOT NULL,
	start_time timestamp with time zone NOT NULL,
	end_time timestamp with time zone NOT NULL
);

CREATE TABLE event_locations (
	fk_event_id integer NOT NULL,
    location_name character varying(45) NOT NULL,
);

CREATE TABLE session (
    session_id SERIAL PRIMARY KEY NOT NULL,
    user_id integer NOT NULL,
    session_title character varying(255) NOT NULL,
    description text,
    min_players integer,
    max_players integer,
    difficulty character varying(15),
    familiarity character varying(10),
    pregen_chars boolean,
    game_system character varying(50),
    cost numeric(6,2),
    equipment character varying(100),
    notes text,
    created timestamp with time zone,
    modified timestamp with time zone,
    num_of_tables integer,
    num_of_timeslots integer,
    maturity character(1),
    event_type character varying(25),
    approved boolean DEFAULT false,
    show_change boolean DEFAULT false,
    featured boolean DEFAULT false,
    cancelled boolean DEFAULT false,
    change_description character varying(300),
    display_org boolean DEFAULT false
);

CREATE TABLE event_session (
	fk_event_id integer NOT NULL,
	fk_session_id integer NOT NULL
	fk_location_name character varying(45) NOT NULL
);


CREATE TABLE role (
    role_id SERIAL PRIMARY KEY NOT NULL,
    role_name character varying(100) NOT NULL
);


CREATE TABLE permission (
    perm_id SERIAL PRIMARY KEY NOT NULL,
    perm_name character varying(15) NOT NULL
);


CREATE TABLE rp_lookup (
    fk_role_id integer NOT NULL,
    fk_perm_id integer NOT NULL
);

CREATE TABLE uco_role_lookup (
    fk_user_id integer,
    fk_event_id integer,
    fk_org_id integer,
    fk_role_id integer
);

COMMENT ON COLUMN convention.con_name IS 'Convention name in long form';


--
-- TOC entry 17 (OID 104099)
-- Name: COLUMN convention.site; Type: COMMENT; Schema: public; Owner: unycon
--

COMMENT ON COLUMN convention.site IS 'Short name that will show up in the url';


--
-- TOC entry 18 (OID 104099)
-- Name: COLUMN convention.event_submit; Type: COMMENT; Schema: public; Owner: unycon
--

COMMENT ON COLUMN convention.event_submit IS 'Can users submit events for the con';


--
-- TOC entry 19 (OID 104099)
-- Name: COLUMN convention.prereg; Type: COMMENT; Schema: public; Owner: unycon
--

COMMENT ON COLUMN convention.prereg IS 'Can users preregister and sign up for events';

