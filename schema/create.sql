-- This is incomplete sql file very much in development. 
-- Most of the objects in it have not even been implemented yet.
-- This is more of a guideline of what we may want to store.


CREATE TABLE organization (
    org_id SERIAL,
	fk_acl_resources_id INTEGER ,
    org_name character varying(20) NOT NULL,
    location character varying(30),
    fk_user_id integer NOT NULL,
    approved boolean DEFAULT false NOT NULL
);

CREATE TABLE event (
    event_id SERIAL NOT NULL,
	fk_acl_resources_id INTEGER ,
    event_name character varying(40) NOT NULL,
    event_short_name character varying(40) NOT NULL,
    start_time timestamp with time zone,
    end_time timestamp with time zone,
    session_submission boolean DEFAULT false NOT NULL,
    pre_reg boolean DEFAULT false NOT NULL,
    onsite_reg boolean DEFAULT false NOT NULL
);

CREATE TABLE event_timeslot (
	timeslot_id SERIAL PRIMARY KEY NOT NULL,
	fk_event_id integer NOT NULL,
	timeslot_name character varying(155) NOT NULL,
	start_time timestamp with time zone NOT NULL,
	end_time timestamp with time zone NOT NULL 
);

CREATE TABLE session (
    session_id SERIAL PRIMARY KEY NOT NULL,
    fk_user_id integer NOT NULL,
	fk_acl_resources_id INTEGER ,
    session_title character varying(255) NOT NULL,
    description text,
    min_attendees integer,
    max_attendees integer,
    difficulty character varying(15),
    familiarity character varying(10),
    pregen_chars boolean,
    game_system character varying(50),
    cost numeric(6,2),
    equipment character varying(100),
    notes text,
    created timestamp with time zone,
    modified timestamp with time zone,
    maturity character(1),
    event_type character varying(25),
    approved boolean DEFAULT false, 
    show_change boolean DEFAULT false,
    featured boolean DEFAULT false,
    display_org boolean DEFAULT false
);

CREATE TABLE event_session (
	event_session_id SERIAL,
	fk_event_id integer NOT NULL,
	fk_session_id integer NOT NULL,
	fk_resource_id integer NOT NULL,
	fk_timeslot_id integer,
	start_time timestamp with time zone NOT NULL,
	end_time timestamp with time zone NOT NULL,
    cancelled boolean DEFAULT false
);

CREATE TABLE session_change_log (
	session_change_log_id SERIAL,
	fk_session_id integer NOT NULL,
	fk_user_id integer NOT NULL,
    change_description text,
	created timestamp with time zone DEFAULT now()
);

CREATE TABLE gm (
	gm_id SERIAL,
	event_session_id integer NOT NULL,
	fk_user_id integer NOT NULL
);

CREATE TABLE event_resources (
	resource_id SERIAL,
	resource_type character varying (45) NOT NULL,
    resource_name character varying(155) NOT NULL
);

-- This whole permissions section is not needed due to ZendACL tables in separate acl.sql
CREATE TABLE role (
    role_id SERIAL,
    role_name character varying(100) NOT NULL,
    Description character varying (255)
);

CREATE TABLE permission (
    perm_id SERIAL,
    perm_name character varying(15) NOT NULL,
    description character varying (255)
);

CREATE TABLE rp_lookup (
	rp_lookup_id SERIAL NOT NULL,
    fk_role_id integer NOT NULL,
    fk_perm_id integer NOT NULL
);

CREATE TABLE uco_role_lookup (
    fk_user_id integer,
    fk_event_id integer,
    fk_org_id integer,
    fk_role_id integer NOT NULL
);

COMMENT ON COLUMN session.approved IS 'Approved and featured fields should be an event specific flag';

-- Not needed section.

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

