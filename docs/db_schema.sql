--THIRRA Software Design 
--Updated : March 27, 2012


--SCHEMA TO SETUP THIRRA

-- source : dev12d-091119.backup

CREATE RULE offline_log_append AS ON INSERT TO patient_complaint DO ALSO 
INSERT INTO offline_log (offline_log_id,offline_log_table,offline_log_type,offline_log_date,offline_log_timestamp,offline_log_user)
 VALUES (now(),'patient_complaint','inserting',current_date,now(),now())


-- ADDITIONS

CREATE TABLE offline_log 
( 
  offline_log_id character(10) NOT NULL, --  
  offline_log_table character varying(100) NOT NULL, 
  offline_log_type character varying(50) NOT NULL, 
  offline_log_descr text, 
  offline_log_sql text, 
  offline_log_num integer, 
  offline_log_bool boolean, 
  offline_log_date date, 
  offline_log_timestamp character(10) NOT NULL, 
  offline_log_user character(10) NOT NULL, 
  CONSTRAINT testing_pkey PRIMARY KEY (offline_log_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE offline_log OWNER TO thirra; 


CREATE TABLE addr_village
( 
  addr_village_id character(10) NOT NULL,
  addr_town_id character varying(10),
  addr_area_id character(10),
  addr_village_name character varying(100) NOT NULL,
  addr_village_code character varying(20) NOT NULL,
  addr_village_subcode character varying(20),
  addr_village_sort integer, 
  addr_village_descr text, 
  addr_village_section character varying(100),
  addr_village_address1 character varying(50),
  addr_village_address2 character varying(50),
  addr_village_address3 character varying(50),
  addr_village_postcode character varying(50),
  addr_village_town character varying(50),
  addr_village_state character varying(50),
  addr_village_country character varying(50),
  addr_village_tel character varying(50),
  addr_village_fax character varying(50),
  addr_village_email character varying(50),
  addr_village_mgr1_position character varying(50),
  addr_village_mgr1_name character varying(50),
  addr_village_mgr2_position character varying(50),
  addr_village_mgr2_name character varying(50),
  addr_village_gps_lat character varying(25),
  addr_village_gps_long character varying(25),
  addr_village_population int,
  CONSTRAINT addr_village_pkey PRIMARY KEY (addr_village_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE addr_village OWNER TO thirra; 


CREATE TABLE addr_town
( 
  addr_town_id character(10) NOT NULL,
  addr_area_id character(10),
  addr_district_id character(10) NOT NULL,
  addr_town_name character varying(100) NOT NULL,
  addr_town_code character varying(20) NOT NULL,
  addr_town_subcode character varying(20),
  addr_town_sort integer, 
  addr_town_descr text, 
  addr_town_section character varying(100),
  addr_town_address1 character varying(50),
  addr_town_address2 character varying(50),
  addr_town_address3 character varying(50),
  addr_town_postcode character varying(50),
  addr_town_town character varying(50),
  addr_town_state character varying(50),
  addr_town_country character varying(50),
  addr_town_tel character varying(50),
  addr_town_fax character varying(50),
  addr_town_email character varying(50),
  addr_town_mgr1_position character varying(50),
  addr_town_mgr1_name character varying(50),
  addr_town_mgr2_position character varying(50),
  addr_town_mgr2_name character varying(50),
  addr_town_population int,
  CONSTRAINT addr_town_pkey PRIMARY KEY (addr_town_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE addr_town OWNER TO thirra; 


CREATE TABLE addr_area
( 
  addr_area_id character(10) NOT NULL,
  addr_district_id character(10) NOT NULL,
  addr_area_name character varying(100) NOT NULL,
  addr_area_code character varying(20) NOT NULL,
  addr_area_subcode character varying(20),
  addr_area_sort integer, 
  addr_area_descr text, 
  addr_area_section character varying(100),
  addr_area_address1 character varying(50),
  addr_area_address2 character varying(50),
  addr_area_address3 character varying(50),
  addr_area_postcode character varying(50),
  addr_area_town character varying(50),
  addr_area_state character varying(50),
  addr_area_country character varying(50),
  addr_area_tel character varying(50),
  addr_area_fax character varying(50),
  addr_area_email character varying(50),
  addr_area_mgr1_position character varying(50),
  addr_area_mgr1_name character varying(50),
  addr_area_mgr2_position character varying(50),
  addr_area_mgr2_name character varying(50),
  addr_area_population int,
  CONSTRAINT addr_area_pkey PRIMARY KEY (addr_area_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE addr_area OWNER TO thirra; 


CREATE TABLE addr_district
( 
  addr_district_id character(10) NOT NULL,
  addr_state_id character(10) NOT NULL,
  addr_district_name character varying(100) NOT NULL,
  addr_district_code character varying(20) NOT NULL,
  addr_district_subcode character varying(20),
  addr_district_sort integer, 
  addr_district_descr text, 
  addr_district_section character varying(100),
  addr_district_address1 character varying(50),
  addr_district_address2 character varying(50),
  addr_district_address3 character varying(50),
  addr_district_postcode character varying(50),
  addr_district_town character varying(50),
  addr_district_state character varying(50),
  addr_district_country character varying(50),
  addr_district_tel character varying(50),
  addr_district_fax character varying(50),
  addr_district_email character varying(50),
  addr_district_mgr1_position character varying(50),
  addr_district_mgr1_name character varying(50),
  addr_district_mgr2_position character varying(50),
  addr_district_mgr2_name character varying(50),
  addr_district_population int,
  CONSTRAINT addr_district_pkey PRIMARY KEY (addr_district_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE addr_district OWNER TO thirra; 


CREATE TABLE addr_state
( 
  addr_state_id character(10) NOT NULL,
  addr_state_name character varying(100) NOT NULL,
  addr_state_code character varying(20) NOT NULL,
  addr_state_subcode character varying(20),
  addr_state_sort integer, 
  addr_state_descr text, 
  addr_state_section character varying(100),
  addr_state_address1 character varying(50),
  addr_state_address2 character varying(50),
  addr_state_address3 character varying(50),
  addr_state_postcode character varying(50),
  addr_state_town character varying(50),
  addr_state_state character varying(50),
  addr_state_country character varying(50),
  addr_state_tel character varying(50),
  addr_state_fax character varying(50),
  addr_state_email character varying(50),
  addr_state_mgr1_position character varying(50),
  addr_state_mgr1_name character varying(50),
  addr_state_mgr2_position character varying(50),
  addr_state_mgr2_name character varying(50),
  CONSTRAINT addr_state_pkey PRIMARY KEY (addr_state_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE addr_state OWNER TO thirra; 


CREATE TABLE district
( 
  district_id character(10) NOT NULL,
  district_name character varying(100) NOT NULL,
  district_code character varying(20) NOT NULL,
  district_subcode character varying(20),
  district_sort integer, 
  district_descr text, 
  district_section character varying(100),
  district_address1 character varying(50),
  district_address2 character varying(50),
  district_address3 character varying(50),
  district_postcode character varying(50),
  district_town character varying(50),
  district_state character varying(50),
  district_country character varying(50),
  district_tel character varying(50),
  district_fax character varying(50),
  district_email character varying(50),
  district_mgr1_position character varying(50),
  district_mgr1_name character varying(50),
  district_mgr2_position character varying(50),
  district_mgr2_name character varying(50),
  CONSTRAINT district_pkey PRIMARY KEY (district_id) 
) 
WITH (OIDS=TRUE); 
ALTER TABLE district OWNER TO thirra; 


CREATE TABLE bio_case
(
  bio_case_id character(10) NOT NULL,
  notification_id character varying(10),
  summary_id character(10) NOT NULL,
  patient_id character(26) NOT NULL,
  case_ref character varying(25),
  bio_phi_ref character varying(25),
  location_id character(10) NOT NULL,
  case_location_isolation character varying(50),
  case_clinical_outcome character varying(25),
  case_disease_confirmed character varying(10),
  date_disease_confirmed date,
  gps_lat character varying(25),
  gps_long character varying(25),
  patient_status character varying(25),
  case_prior_movements text,
  case_findings text,
  case_outbreak_degree character varying(255),
  case_in_outbreak character varying(255),
  case_summary text,
  case_conclusion varchar(255),
  alert_max integer,
  alert_now integer,
  start_date date,
  end_date date,
  staff_start_id character(10) NOT NULL,
  staff_end_id character(10),
  staff_close_id character(10),
  staff_close_date date,
  case_comments character varying(255),
  case_remarks character varying(255),
  CONSTRAINT bio_case_pkey PRIMARY KEY (bio_case_id),
  CONSTRAINT bio_case_fk1 FOREIGN KEY (notification_id)
      REFERENCES patient_disease_notification (notification_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (OIDS=TRUE);
ALTER TABLE bio_case OWNER TO thirra;


CREATE TABLE bio_investigate
(
  bio_inv_id character(10) NOT NULL,
  bio_case_id character(10) NOT NULL,
  inv_ref character varying(20),
  inv_main_name character varying(50),
  inv_main_relship character varying(20),
  inv_main_answer text,
  inv_main_remarks character varying(255),
  inv_main_age numeric(5,2),
  inv_main_contacttype character varying(20),
  inv_main_sex character varying(6),
  inv_other_remarks character varying(255),
  inv_cluster_size integer,
  inv_findings text,
  inv_summary text,
  inv_comments text,
  inv_address1 character varying(50),
  inv_address2 character varying(50),
  inv_address3 character varying(50),
  inv_postcode character varying(50),
  inv_town character varying(50),
  inv_state character varying(50),
  inv_tel character varying(50),
  inv_fax character varying(50),
  inv_email character varying(50),
  inv_gps_lat character varying(20),
  inv_gps_long character varying(20),
  inv_start_date date,
  inv_end_date date,
  staff_start_id character(10) NOT NULL,
  staff_end_id character(10),
  inv_remarks text,
  CONSTRAINT bio_inv_pkey PRIMARY KEY (bio_inv_id),
  CONSTRAINT bio_inv_fk1 FOREIGN KEY (bio_case_id)
      REFERENCES bio_case (bio_case_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (OIDS=TRUE);
ALTER TABLE bio_investigate OWNER TO thirra;


CREATE TABLE bio_file
(
  bio_file_id character(10) NOT NULL,
  bio_filename character varying(255), 
  bio_origname character varying(255), 
  bio_inv_id character(10),
  bio_patient_id character(26),
  bio_file_category character varying(50),
  bio_file_ref character varying(30),
  bio_file_title character varying(100),
  bio_file_descr character varying(255),
  bio_file_sort integer,
  staff_id character(10),
  date_uploaded date,
  time_uploaded time without time zone,
  bio_mimetype varchar(25),
  bio_fileext varchar(5),
  bio_filesize int,
  bio_filepath varchar(50),
  bio_summary_id character(10),
  location_id character varying(10),
  ip_uploaded character varying(20),
  file_remarks text,
  CONSTRAINT bio_file_pkey PRIMARY KEY (bio_file_id)
)
WITH (OIDS=TRUE);
ALTER TABLE bio_file OWNER TO thirra;


DROP TABLE if exists report_header;
CREATE TABLE report_header
(
  report_header_id character(10) NOT NULL,
  report_code character varying(50),
  report_name character varying(100) NOT NULL,
  report_shortname character varying(50),
  report_title1 character varying(255) NOT NULL,
  report_title2 character varying(255),
  report_descr text,
  report_source character varying(50) NOT NULL,
  report_type character varying(50),
  report_section character varying(50),
  report_scope character varying(50),
  report_version character varying(50),
  report_paper_orient character varying(10),
  report_paper_size character varying(50),
  report_latest boolean,
  report_sort integer,
  report_formbean character varying(30),
  report_urllink character varying(255),
  report_urltext character varying(255),
  report_extrafield character varying(255),
  report_password character varying(255),
  report_security integer,
  report_unlock boolean,
  report_prototype boolean,
  report_expiry date,
  report_db_sort character varying(255),
  report_db_groupby character varying(255),
  report_db_having character varying(255),
  report_filter_sex character(1),
  report_filter_youngerthan numeric(3),
  report_filter_olderthan numeric(3),
  report_filter_1 character varying(255),
  report_filter_2 character varying(255),
  report_snapshot boolean,
  report_added_staff character varying(50),
  report_added_date date,
  report_added_remarks character varying(255),
  report_active boolean,
  report_del_staff character varying(50),
  report_del_date date,
  report_del_remarks character varying(255),
  report_edit_staff character varying(50),
  report_edit_date date,
  report_edit_remarks character varying(255),
  report_remarks character varying(255),
  report_1 character varying(255),
  CONSTRAINT report_header_pkey PRIMARY KEY (report_header_id)
)
WITH (OIDS=FALSE);
ALTER TABLE report_header OWNER TO thirra;


DROP TABLE if exists report_body;
CREATE TABLE report_body
(
  report_body_id character(10) NOT NULL,
  report_header_id character(10) NOT NULL,
  report_line integer,
  col_fieldname character varying(255),
  col_security integer,
  col_sort integer,
  col_title1 character varying(100) NOT NULL,
  col_title2 character varying(100),
  col_format character varying(100),
  col_transform text,
  col_widthmin smallint,
  col_widthmax smallint,
  col_statsum boolean,
  col_statmean boolean,
  col_statmax boolean,
  col_statmin boolean,
  col_subtotal character varying(255),
  body_added_staff character varying(50),
  body_added_date date,
  body_added_remarks character varying(255),
  body_active boolean,
  body_del_staff character varying(50),
  body_del_date date,
  body_del_remarks character varying(255),
  body_edit_staff character varying(50),
  body_edit_date date,
  body_edit_remarks character varying(255),
  reportbody_remarks character varying(255),
  report_body_1 character varying(255),
  CONSTRAINT report_body_pkey PRIMARY KEY (report_body_id)
)
WITH (OIDS=FALSE);
ALTER TABLE report_body OWNER TO thirra;


DROP TABLE if exists patient_event;
CREATE TABLE patient_event
(
  event_id character(10) NOT NULL,
  event_tabletop character varying(25) NOT NULL,
  event_key character varying(28) NOT NULL,
  event_name character varying(50),
  patient_id character varying(26) NOT NULL,
  location_id character varying(10) NOT NULL,
  staff_id character varying(10) NOT NULL,
  event_description character varying(255),
  event_remarks character varying(255),
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_event_1 character varying(255),
  CONSTRAINT patient_event_pkey PRIMARY KEY (event_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_event OWNER TO thirra;
COMMENT ON TABLE patient_event IS 'THIRRA October 5, 2010';


--Generic Engine for Modules (GEM)

DROP TABLE if exists gem_report;
CREATE TABLE gem_report
(
  gem_report_id character(10) NOT NULL,
  gem_module_id character(10),
  gem_report_code character varying(50),
  gem_report_name character varying(100),
  gem_report_shortname character varying(50),
  gem_report_title1 character varying(255),
  gem_report_title2 character varying(255),
  gem_report_descr text,
  gem_report_scope character varying(50),
  gem_report_version character varying(50),
  gem_report_latest boolean,
  gem_report_sort integer,
  gem_report_formbean character varying(30),
  gem_report_urllink character varying(255),
  gem_report_urltext character varying(255),
  gem_report_extrafield character varying(255),
  gem_report_password character varying(255),
  gem_report_security integer,
  gem_report_unlock boolean,
  gem_report_prototype boolean,
  gem_report_expiry date,
  gem_report_order character varying(255),
  gem_filter_sex character(1),
  gem_filter_youngerthan numeric(3),
  gem_filter_olderthan numeric(3),
  gem_filter_1 character varying(255),
  gem_filter_2 character varying(255),
  gem_report_snapshot boolean,
  gem_added_staff character varying(50),
  gem_added_date date,
  gem_added_remarks character varying(255),
  gem_active boolean,
  gem_del_staff character varying(50),
  gem_del_date date,
  gem_del_remarks character varying(255),
  gem_edit_staff character varying(50),
  gem_edit_date date,
  gem_edit_remarks character varying(255),
  gem_report_remarks character varying(255),
  gem_report_1 character varying(255),
  CONSTRAINT gem_report_pkey PRIMARY KEY (gem_report_id)
)
WITH (OIDS=FALSE);
ALTER TABLE gem_report OWNER TO thirra;


DROP TABLE if exists gem_report_body;
CREATE TABLE gem_report_body
(
  gem_report_body_id character(10) NOT NULL,
  gem_report_id character(10),
  gem_report_line integer,
  gem_question_id character(10),
  gem_col_security integer,
  gem_col_sort integer,
  gem_col_title1 character varying(100),
  gem_col_title2 character varying(100),
  gem_col_format character varying(100),
  gem_col_transform text,
  gem_col_widthmin smallint,
  gem_col_widthmax smallint,
  gem_col_statsum boolean,
  gem_col_statmean boolean,
  gem_col_statmax boolean,
  gem_col_statmin boolean,
  gem_col_subtotal character varying(255),
  gem_added_staff character varying(50),
  gem_added_date date,
  gem_added_remarks character varying(255),
  gem_active boolean,
  gem_del_staff character varying(50),
  gem_del_date date,
  gem_del_remarks character varying(255),
  gem_edit_staff character varying(50),
  gem_edit_date date,
  gem_edit_remarks character varying(255),
  gem_reportbody_remarks character varying(255),
  gem_report_body_1 character varying(255),
  CONSTRAINT gem_report_body_pkey PRIMARY KEY (gem_report_body_id)
)
WITH (OIDS=FALSE);
ALTER TABLE gem_report_body OWNER TO thirra;


ALTER TABLE gem_conanswer DROP COLUMN gem_conanswer_1;
ALTER TABLE gem_conanswer ADD COLUMN synch_in character varying(10);
ALTER TABLE gem_conanswer ADD COLUMN synch_out character varying(10);
ALTER TABLE gem_conanswer ADD COLUMN synch_remarks character varying(255);
ALTER TABLE gem_conanswer ADD COLUMN gem_conanswer_1
 character varying(255);
COMMENT ON COLUMN gem_conanswer.synch_in IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_conanswer.synch_out IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_conanswer.synch_remarks IS 'THIRRA April 22, 2010';


ALTER TABLE gem_question DROP COLUMN gem_question_1;
ALTER TABLE gem_question ADD COLUMN gem_quest_lookkey character varying(50);
ALTER TABLE gem_question ADD COLUMN gem_quest_gemkey character varying(50);
ALTER TABLE gem_question ADD COLUMN gem_lookdisplay character varying(50);
ALTER TABLE gem_question ADD COLUMN gem_quest_validate text;
ALTER TABLE gem_question ADD COLUMN gem_quest_minlegal numeric(7,2);
ALTER TABLE gem_question ADD COLUMN gem_quest_minnormal numeric(7,2);
ALTER TABLE gem_question ADD COLUMN gem_quest_maxnormal numeric(7,2);
ALTER TABLE gem_question ADD COLUMN gem_quest_maxlegal numeric(7,2);
ALTER TABLE gem_question ADD COLUMN gem_quest_decimal smallint;
ALTER TABLE gem_question ADD COLUMN gem_quest_default character varying(255);
ALTER TABLE gem_question ADD COLUMN gem_quest_conceptid character varying(10);
ALTER TABLE gem_question ADD COLUMN gem_quest_codesection character varying(50);
ALTER TABLE gem_question ADD COLUMN gem_question_1
 character varying(255);
COMMENT ON COLUMN gem_question.gem_quest_lookkey IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_quest_gemkey IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_lookdisplay IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_quest_validate IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_quest_minlegal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN gem_question.gem_quest_minnormal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN gem_question.gem_quest_maxnormal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN gem_question.gem_quest_maxlegal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN gem_question.gem_quest_decimal IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_quest_default IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_quest_conceptid IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_question.gem_quest_codesection IS 'THIRRA April 22, 2010';


ALTER TABLE gem_session DROP COLUMN gem_session_1;
ALTER TABLE gem_session ADD COLUMN synch_in character varying(10);
ALTER TABLE gem_session ADD COLUMN synch_out character varying(10);
ALTER TABLE gem_session ADD COLUMN synch_remarks character varying(255);
ALTER TABLE gem_session ADD COLUMN gem_session_1
 character varying(255);
COMMENT ON COLUMN gem_session.synch_in IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_session.synch_out IS 'THIRRA April 22, 2010';
COMMENT ON COLUMN gem_session.synch_remarks IS 'THIRRA April 22, 2010';


CREATE OR REPLACE VIEW gem_report_02 AS 
 SELECT gsub.gem_module_id, 
gque.gem_question_id, gque.gem_submod_id, gque.gem_modque, gque.gem_quest_code, gque.gem_quest_latest, gque.gem_quest_sort, gque.gem_quest_text, gque.gem_quest_cast, gque.gem_quest_length, gque.gem_quest_uilength, gque.gem_quest_uom, gque.gem_quest_descr, gque.gem_quest_remarks, gque.gem_quest_showlower, gque.gem_quest_showupper, gque.gem_quest_looktable, gque.gem_quest_lookfield, gque.gem_active, 
gcan.gem_conanswer_id, gcan.gem_session_id, gcan.gem_showquest, gcan.gem_ans_type, gcan.gem_conanswer, gses.summary_id,
pdin.name AS patient_name, pdin.gender, pdin.birth_date,
pcsm.date_started, pcsm.patient_id, pcsm.location_start
   FROM gem_question gque
   JOIN gem_conanswer gcan ON gque.gem_modque = gcan.gem_modque
   JOIN gem_submodule gsub ON gque.gem_submod_id = gsub.gem_submod_id
   JOIN gem_session gses ON gcan.gem_session_id = gses.gem_session_id
   JOIN patient_consultation_summary pcsm ON gses.summary_id = pcsm.summary_id
   JOIN patient_demographic_info pdin ON gses.patient_id = pdin.patient_id
  ORDER BY gque.gem_quest_sort;

ALTER TABLE gem_report_02 OWNER TO thirra;


CREATE OR REPLACE VIEW gem_report_diagnosis AS 
 SELECT patient_diagnosis.diagnosis_id, patient_diagnosis.patient_id, patient_diagnosis.session_id, patient_diagnosis.icpc_code, patient_diagnosis.diagnosis_type, patient_diagnosis.notes, patient_diagnosis.dcode1set, patient_diagnosis.dcode1ext_code, patient_diagnosis.dcode2set, patient_diagnosis.dcode2ext_code, patient_diagnosis.remarks, patient_diagnosis.synch_in, patient_diagnosis.synch_out, patient_diagnosis.edit_remarks, patient_diagnosis.edit_staff, patient_diagnosis.edit_date, patient_diagnosis.delete_remarks, patient_diagnosis.delete_staff, patient_diagnosis.delete_date, patient_diagnosis.confirm_dcode1ext, patient_diagnosis.confirm_remarks, patient_diagnosis.confirm_staff, patient_diagnosis.confirm_date, patient_diagnosis.synch_remarks, patient_diagnosis.patient_diagnosis_1, dcode1ext.dcode1ext_longname, dcode1ext.dcode1ext_shortname, dcode1ext.chapter
   FROM patient_diagnosis
   JOIN dcode1ext ON patient_diagnosis.dcode1ext_code::text = dcode1ext.dcode1ext_code::text;

ALTER TABLE gem_report_diagnosis OWNER TO thirra;




-- MODIFICATIONS

ALTER TABLE account OWNER TO thirra; 
ALTER TABLE account_group OWNER TO thirra; 
ALTER TABLE account_type OWNER TO thirra; 
ALTER TABLE adt OWNER TO thirra; 
ALTER TABLE asset OWNER TO thirra; 
ALTER TABLE asset_type OWNER TO thirra; 
ALTER TABLE billing OWNER TO thirra; 
ALTER TABLE billing_descr OWNER TO thirra; 
ALTER TABLE billing_inv_detail OWNER TO thirra; 
ALTER TABLE billing_invoice OWNER TO thirra; 
ALTER TABLE booking OWNER TO thirra; 
ALTER TABLE ccs_lab_findings OWNER TO thirra; 
ALTER TABLE ccs_lab_question OWNER TO thirra; 
ALTER TABLE ccs_lab_result_enhanced OWNER TO thirra; 
ALTER TABLE ccs_lab_resultcombo OWNER TO thirra; 
ALTER TABLE ccs_papsmear OWNER TO thirra; 
ALTER TABLE clinic_info OWNER TO thirra; 
ALTER TABLE company_contact_info OWNER TO thirra; 
ALTER TABLE company_employee OWNER TO thirra; 
ALTER TABLE company_patient OWNER TO thirra; 
ALTER TABLE condev_topics OWNER TO thirra; 
ALTER TABLE cpg OWNER TO thirra; 
ALTER TABLE customer_info OWNER TO thirra; 
ALTER TABLE dcode1 OWNER TO thirra; 
ALTER TABLE dcode1ext OWNER TO thirra; 
ALTER TABLE dcode2 OWNER TO thirra; 
ALTER TABLE dcode2ext OWNER TO thirra; 
ALTER TABLE dcode_map OWNER TO thirra; 
ALTER TABLE dispense_queue OWNER TO thirra; 
ALTER TABLE doctor_remark OWNER TO thirra; 
ALTER TABLE drug_atc OWNER TO thirra; 
ALTER TABLE drug_code OWNER TO thirra; 
ALTER TABLE drug_formulary OWNER TO thirra; 
ALTER TABLE drug_interaction OWNER TO thirra; 
ALTER TABLE drug_manufacturer OWNER TO thirra; 
ALTER TABLE drug_manufacturer_supplier_ref OWNER TO thirra; 
ALTER TABLE drug_order OWNER TO thirra; 
ALTER TABLE drug_order_received OWNER TO thirra; 
ALTER TABLE drug_package OWNER TO thirra; 
ALTER TABLE drug_package_content OWNER TO thirra; 
ALTER TABLE drug_physical_stock OWNER TO thirra; 
ALTER TABLE drug_product OWNER TO thirra; 
ALTER TABLE drug_reorder OWNER TO thirra; 
ALTER TABLE drug_stock OWNER TO thirra; 
ALTER TABLE drug_supplier OWNER TO thirra; 
ALTER TABLE gem_agegroup OWNER TO thirra; 
ALTER TABLE gem_ageset OWNER TO thirra; 
ALTER TABLE gem_conanswer OWNER TO thirra; 
ALTER TABLE gem_module OWNER TO thirra; 
ALTER TABLE gem_option OWNER TO thirra; 
ALTER TABLE gem_overview OWNER TO thirra; 
ALTER TABLE gem_ovvanswer OWNER TO thirra; 
ALTER TABLE gem_question OWNER TO thirra; 
ALTER TABLE gem_session OWNER TO thirra; 
ALTER TABLE gem_submodule OWNER TO thirra; 
ALTER TABLE general_supply_order OWNER TO thirra; 
ALTER TABLE general_supply_order_received OWNER TO thirra; 
ALTER TABLE general_supply_physical_stock OWNER TO thirra; 
ALTER TABLE general_supply_product OWNER TO thirra; 
ALTER TABLE general_supply_rol OWNER TO thirra; 
ALTER TABLE general_supply_stock OWNER TO thirra; 
ALTER TABLE general_supply_supplier OWNER TO thirra; 
ALTER TABLE generic_drug OWNER TO thirra; 
ALTER TABLE health_department OWNER TO thirra; 
ALTER TABLE hl7_clisum_adt OWNER TO thirra; 
ALTER TABLE hl7_clisum_in OWNER TO thirra; 
ALTER TABLE hl7_clisum_out OWNER TO thirra; 
ALTER TABLE hl7_egl_in OWNER TO thirra; 
ALTER TABLE hl7_egl_out OWNER TO thirra; 
ALTER TABLE icpc2_administration OWNER TO thirra; 
ALTER TABLE icpc2_category OWNER TO thirra; 
ALTER TABLE icpc2_diagnose OWNER TO thirra; 
ALTER TABLE icpc2_diagnostic OWNER TO thirra; 
ALTER TABLE icpc2_ext_diagnosis OWNER TO thirra; 
ALTER TABLE icpc2_other OWNER TO thirra; 
ALTER TABLE icpc2_symptom OWNER TO thirra; 
ALTER TABLE icpc2_test OWNER TO thirra; 
ALTER TABLE icpc2_treatment OWNER TO thirra; 
ALTER TABLE imaging_billing OWNER TO thirra; 
ALTER TABLE imaging_invoice OWNER TO thirra; 
ALTER TABLE imaging_order OWNER TO thirra; 
ALTER TABLE imaging_product OWNER TO thirra; 
ALTER TABLE imaging_result OWNER TO thirra; 
ALTER TABLE imaging_supplier OWNER TO thirra; 
ALTER TABLE immunisation OWNER TO thirra; 
ALTER TABLE immunisation_billing OWNER TO thirra; 
ALTER TABLE immunisation_drug OWNER TO thirra; 
ALTER TABLE insurance_client_company OWNER TO thirra; 
ALTER TABLE insurance_company OWNER TO thirra; 
ALTER TABLE insurance_employee OWNER TO thirra; 
ALTER TABLE lab_answers OWNER TO thirra; 
ALTER TABLE lab_classification OWNER TO thirra; 
ALTER TABLE lab_findings OWNER TO thirra; 
ALTER TABLE lab_invoice OWNER TO thirra; 
ALTER TABLE lab_order OWNER TO thirra; 
ALTER TABLE lab_package OWNER TO thirra; 
ALTER TABLE lab_package_test OWNER TO thirra; 
ALTER TABLE lab_product OWNER TO thirra; 
ALTER TABLE lab_questions OWNER TO thirra; 
ALTER TABLE lab_result OWNER TO thirra; 
ALTER TABLE lab_supplier OWNER TO thirra; 
ALTER TABLE lab_test_billing OWNER TO thirra; 
ALTER TABLE loinc OWNER TO thirra; 
ALTER TABLE loinc_class OWNER TO thirra; 
ALTER TABLE mco OWNER TO thirra; 
ALTER TABLE mco_company OWNER TO thirra; 
ALTER TABLE mco_employee OWNER TO thirra; 
ALTER TABLE medical_supply_order OWNER TO thirra; 
ALTER TABLE medical_supply_order_received OWNER TO thirra; 
ALTER TABLE medical_supply_physical_stock OWNER TO thirra; 
ALTER TABLE medical_supply_product OWNER TO thirra; 
ALTER TABLE medical_supply_rol OWNER TO thirra; 
ALTER TABLE medical_supply_stock OWNER TO thirra; 
ALTER TABLE medical_supply_supplier OWNER TO thirra; 
ALTER TABLE medication_billing OWNER TO thirra; 
ALTER TABLE past_final_account OWNER TO thirra; 
ALTER TABLE patient_allergic_history OWNER TO thirra; 
ALTER TABLE patient_allergy_history OWNER TO thirra; 
ALTER TABLE patient_antenatal OWNER TO thirra; 
ALTER TABLE patient_antenatal_current OWNER TO thirra; 
ALTER TABLE patient_antenatal_delivery OWNER TO thirra; 
ALTER TABLE patient_antenatal_followup OWNER TO thirra; 
ALTER TABLE patient_antenatal_health OWNER TO thirra; 
ALTER TABLE patient_antenatal_info OWNER TO thirra; 
ALTER TABLE patient_complaint OWNER TO thirra; 
ALTER TABLE patient_consultation_summary OWNER TO thirra; 
ALTER TABLE patient_contact_info OWNER TO thirra; 
ALTER TABLE patient_correspondence OWNER TO thirra; 
ALTER TABLE patient_demographic_info OWNER TO thirra; 
ALTER TABLE patient_diagnosis OWNER TO thirra; 
ALTER TABLE patient_disease_notification OWNER TO thirra; 
ALTER TABLE patient_drug_allergy OWNER TO thirra; 
ALTER TABLE patient_employment OWNER TO thirra; 
ALTER TABLE patient_family_details OWNER TO thirra; 
ALTER TABLE patient_family_history OWNER TO thirra; 
ALTER TABLE patient_family_relationship OWNER TO thirra; 
ALTER TABLE patient_immunisation OWNER TO thirra; 
ALTER TABLE patient_medical_history OWNER TO thirra; 
ALTER TABLE patient_medical_leave OWNER TO thirra; 
ALTER TABLE patient_medication OWNER TO thirra; 
ALTER TABLE patient_menstrual_history OWNER TO thirra; 
ALTER TABLE patient_past_procedure OWNER TO thirra; 
ALTER TABLE patient_physical_exam OWNER TO thirra; 
ALTER TABLE patient_problem_list OWNER TO thirra; 
ALTER TABLE patient_psychiatric_history OWNER TO thirra; 
ALTER TABLE patient_referral OWNER TO thirra; 
ALTER TABLE patient_social_history OWNER TO thirra; 
ALTER TABLE patient_vital OWNER TO thirra; 
ALTER TABLE pcode1 OWNER TO thirra; 
ALTER TABLE pcode1ext OWNER TO thirra; 
ALTER TABLE prescript_queue OWNER TO thirra; 
ALTER TABLE procedure OWNER TO thirra; 
ALTER TABLE procedure_billing OWNER TO thirra; 
ALTER TABLE procedure_invoice OWNER TO thirra; 
ALTER TABLE procedure_order OWNER TO thirra; 
ALTER TABLE procedure_product OWNER TO thirra; 
ALTER TABLE procedure_result OWNER TO thirra; 
ALTER TABLE procedure_supplier OWNER TO thirra; 
ALTER TABLE psv_applicant_category OWNER TO thirra; 
ALTER TABLE psv_application_type OWNER TO thirra; 
ALTER TABLE psv_bio_data OWNER TO thirra; 
ALTER TABLE psv_checkup OWNER TO thirra; 
ALTER TABLE psv_jpjl8a OWNER TO thirra; 
ALTER TABLE psv_medical_exam OWNER TO thirra; 
ALTER TABLE psv_patient_vitals OWNER TO thirra; 
ALTER TABLE purchase_order OWNER TO thirra; 
ALTER TABLE purorder_nondrug OWNER TO thirra; 
ALTER TABLE referral_center OWNER TO thirra; 
ALTER TABLE referral_doctor OWNER TO thirra; 
ALTER TABLE room OWNER TO thirra; 
ALTER TABLE room_category OWNER TO thirra; 
ALTER TABLE sequence_num OWNER TO thirra; 
ALTER TABLE shift_category OWNER TO thirra; 
ALTER TABLE staff_appointment OWNER TO thirra; 
ALTER TABLE staff_category OWNER TO thirra; 
ALTER TABLE staff_contact OWNER TO thirra; 
ALTER TABLE staff_education OWNER TO thirra; 
ALTER TABLE staff_info OWNER TO thirra; 
ALTER TABLE staff_provident_fund OWNER TO thirra; 
ALTER TABLE staff_roster OWNER TO thirra; 
ALTER TABLE staff_social_security OWNER TO thirra; 
ALTER TABLE staff_task OWNER TO thirra; 
ALTER TABLE staff_work OWNER TO thirra; 
ALTER TABLE supplier_contact_info OWNER TO thirra; 
ALTER TABLE supplier_inv_drug OWNER TO thirra; 
ALTER TABLE supplier_inv_drug_adhoc OWNER TO thirra; 
ALTER TABLE supplier_inv_lab OWNER TO thirra; 
ALTER TABLE supplier_inv_nondrug OWNER TO thirra; 
ALTER TABLE supplier_invoice OWNER TO thirra; 
ALTER TABLE system_log OWNER TO thirra; 
ALTER TABLE system_user OWNER TO thirra; 
ALTER TABLE system_user_category OWNER TO thirra; 
ALTER TABLE test OWNER TO thirra; 
ALTER TABLE transaction OWNER TO thirra; 
ALTER TABLE transaction_detail OWNER TO thirra; 
ALTER TABLE transaction_type OWNER TO thirra; 


ALTER TABLE clinic_info DROP COLUMN clinic_info_1;
ALTER TABLE clinic_info ADD COLUMN addr_village_id character varying(10);
ALTER TABLE clinic_info ADD COLUMN addr_town_id character varying(10);
ALTER TABLE clinic_info ADD COLUMN addr_area_id character varying(10);
ALTER TABLE clinic_info ADD COLUMN addr_district_id character varying(10);
ALTER TABLE clinic_info ADD COLUMN addr_state_id character varying(10);
ALTER TABLE clinic_info ADD COLUMN clinic_district_id character varying(10);
ALTER TABLE clinic_info ADD COLUMN clinic_status character varying(20);
ALTER TABLE clinic_info ADD COLUMN clinic_gps_lat character varying(20);
ALTER TABLE clinic_info ADD COLUMN clinic_gps_long character varying(20);
ALTER TABLE clinic_info ADD COLUMN clinic_type character varying(20);
ALTER TABLE clinic_info ADD COLUMN clinic_info_1
 character varying(255);
COMMENT ON COLUMN clinic_info.clinic_status IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN clinic_info.addr_village_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN clinic_info.addr_town_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN clinic_info.addr_area_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN clinic_info.addr_district_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN clinic_info.addr_state_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN clinic_info.clinic_district_id IS 'THIRRA April 19, 2010';
COMMENT ON COLUMN clinic_info.clinic_gps_lat IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN clinic_info.clinic_gps_long IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN clinic_info.clinic_type IS 'THIRRA March 31, 2010';


ALTER TABLE patient_contact_info DROP COLUMN patient_contact_info_1;
ALTER TABLE patient_contact_info ADD COLUMN addr_village_id character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN addr_town_id character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN addr_area_id character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN addr_district_id character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN addr_state_id character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN contact_district_id character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_contact_info ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_contact_info ADD COLUMN patient_contact_info_1
 character varying(255);
COMMENT ON COLUMN patient_contact_info.addr_village_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_contact_info.addr_town_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_contact_info.addr_area_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_contact_info.addr_district_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_contact_info.addr_state_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_contact_info.contact_district_id IS 'THIRRA April 19, 2010';
COMMENT ON COLUMN patient_contact_info.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_contact_info.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_contact_info.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_correspondence DROP COLUMN patient_contact_info_1;
ALTER TABLE patient_correspondence ADD COLUMN addr_village_id character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN addr_town_id character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN addr_area_id character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN addr_district_id character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN addr_state_id character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN corr_district_id character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_correspondence ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_correspondence ADD COLUMN patient_contact_info_1
 character varying(255);
COMMENT ON COLUMN patient_correspondence.addr_village_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_correspondence.addr_town_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_correspondence.addr_area_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_correspondence.addr_district_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_correspondence.addr_state_id IS 'THIRRA May 01, 2010';
COMMENT ON COLUMN patient_correspondence.corr_district_id IS 'THIRRA April 19, 2010';
COMMENT ON COLUMN patient_correspondence.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_correspondence.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_correspondence.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_drug_allergy DROP COLUMN patient_drug_allergy_1;
ALTER TABLE patient_drug_allergy ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_drug_allergy ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_drug_allergy ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_drug_allergy ADD COLUMN patient_drug_allergy_1
 character varying(255);
COMMENT ON COLUMN patient_drug_allergy.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_drug_allergy.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_drug_allergy.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_family_history DROP COLUMN patient_family_history_1;
ALTER TABLE patient_family_history ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_family_history ADD COLUMN patient_family_history_1
 character varying(255);
COMMENT ON COLUMN patient_family_history.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_family_relationship ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_family_relationship ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_family_relationship ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_family_relationship ADD COLUMN patient_family_relationship_1
 character varying(255);
COMMENT ON COLUMN patient_family_relationship.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_family_relationship.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_family_relationship.synch_remarks IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_family_relationship.patient_family_relationship_1 IS 'THIRRA March 31, 2010';


ALTER TABLE patient_medical_history DROP COLUMN patient_medical_history_1;
ALTER TABLE patient_medical_history ADD COLUMN diagnosis_id character varying(10);
ALTER TABLE patient_medical_history ADD COLUMN confirm_dcode1ext character varying(10);
ALTER TABLE patient_medical_history ADD COLUMN confirm_remarks character varying(255);
ALTER TABLE patient_medical_history ADD COLUMN confirm_staff character varying(10);
ALTER TABLE patient_medical_history ADD COLUMN confirm_date character varying(10);
ALTER TABLE patient_medical_history ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_medical_history ADD COLUMN patient_medical_history_1
 character varying(255);
COMMENT ON COLUMN patient_medical_history.confirm_dcode1ext IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_medical_history.diagnosis_id IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_medical_history.confirm_remarks IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_medical_history.confirm_staff IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_medical_history.confirm_date IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_medical_history.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_medication DROP COLUMN patient_medication_1;
ALTER TABLE patient_medication ADD COLUMN medication_importance integer;
ALTER TABLE patient_medication ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_medication ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_medication ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_medication ADD COLUMN patient_medication_1
 character varying(255);
COMMENT ON COLUMN patient_medication.medication_importance IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_medication.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_medication.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_medication.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE adt DROP COLUMN adt_1;
ALTER TABLE adt ADD COLUMN delete_remarks character varying(255);
ALTER TABLE adt ADD COLUMN delete_staff character varying(10);
ALTER TABLE adt ADD COLUMN delete_date date;
ALTER TABLE adt ADD COLUMN synch_start character varying(10);
ALTER TABLE adt ADD COLUMN synch_in character varying(10);
ALTER TABLE adt ADD COLUMN synch_out character varying(10);
ALTER TABLE adt ADD COLUMN synch_remarks character varying(255);
ALTER TABLE adt ADD COLUMN adt_1
 character varying(255);
COMMENT ON COLUMN adt.delete_remarks IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN adt.delete_staff IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN adt.delete_date IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN adt.synch_start IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN adt.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN adt.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN adt.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_consultation_summary DROP COLUMN patient_consultation_1;
ALTER TABLE patient_consultation_summary ADD COLUMN delete_remarks character varying(255);
ALTER TABLE patient_consultation_summary ADD COLUMN delete_staff character varying(10);
ALTER TABLE patient_consultation_summary ADD COLUMN delete_date date;
ALTER TABLE patient_consultation_summary ADD COLUMN session_gps_lat character varying(20);
ALTER TABLE patient_consultation_summary ADD COLUMN session_gps_long character varying(20);
ALTER TABLE patient_consultation_summary ADD COLUMN synch_start character varying(10);
ALTER TABLE patient_consultation_summary ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_consultation_summary ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_consultation_summary ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_consultation_summary ADD COLUMN patient_consultation_1
 character varying(255);
COMMENT ON COLUMN patient_consultation_summary.delete_remarks IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.delete_staff IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.delete_date IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.session_gps_lat IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.session_gps_long IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.synch_start IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_consultation_summary.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_demographic_info DROP COLUMN patient_demographic_info_2;
ALTER TABLE patient_demographic_info DROP COLUMN patient_demographic_info_1;
ALTER TABLE patient_demographic_info ADD COLUMN guardian_name character varying(100);
ALTER TABLE patient_demographic_info ADD COLUMN guardian_relationship character varying(25);
ALTER TABLE patient_demographic_info ADD COLUMN birth_date_estimate boolean;
ALTER TABLE patient_demographic_info ADD COLUMN patient_demographic_info_1
 character varying(255);
ALTER TABLE patient_demographic_info ADD COLUMN patient_demographic_info_2
 character varying(255);
COMMENT ON COLUMN patient_demographic_info.guardian_name IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_demographic_info.guardian_relationship IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_demographic_info.birth_date_estimate IS 'THIRRA March 31, 2010';


ALTER TABLE patient_diagnosis DROP COLUMN patient_diagnosis_1;
ALTER TABLE patient_diagnosis ADD COLUMN confirm_dcode1ext character varying(10);
ALTER TABLE patient_diagnosis ADD COLUMN confirm_remarks character varying(255);
ALTER TABLE patient_diagnosis ADD COLUMN confirm_staff character varying(10);
ALTER TABLE patient_diagnosis ADD COLUMN confirm_date character varying(10);
ALTER TABLE patient_diagnosis ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_diagnosis ADD COLUMN patient_diagnosis_1
 character varying(255);
COMMENT ON COLUMN patient_diagnosis.confirm_dcode1ext IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_diagnosis.confirm_remarks IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_diagnosis.confirm_staff IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_diagnosis.confirm_date IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_diagnosis.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_disease_notification DROP COLUMN patient_disease_notification_1;
ALTER TABLE patient_disease_notification ADD COLUMN notify_status character varying(50);
ALTER TABLE patient_disease_notification ADD COLUMN edit_remarks character varying(255);
ALTER TABLE patient_disease_notification ADD COLUMN edit_staff character varying(10);
ALTER TABLE patient_disease_notification ADD COLUMN edit_date character varying(10);
ALTER TABLE patient_disease_notification ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_disease_notification ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_disease_notification ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_disease_notification ADD COLUMN patient_disease_notification_1
 character varying(255);
COMMENT ON COLUMN patient_disease_notification.notify_status IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_disease_notification.edit_remarks IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_disease_notification.edit_staff IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_disease_notification.edit_date IS 'THIRRA April 3, 2010';
COMMENT ON COLUMN patient_disease_notification.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_disease_notification.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_disease_notification.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_immunisation DROP COLUMN patient_immunisation_1;
ALTER TABLE patient_immunisation ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_immunisation ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_immunisation ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_immunisation ADD COLUMN patient_immunisation_1
 character varying(255);
COMMENT ON COLUMN patient_immunisation.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_immunisation.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_immunisation.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_medical_leave DROP COLUMN patient_medical_leave_1;
ALTER TABLE patient_medical_leave ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_medical_leave ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_medical_leave ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_medical_leave ADD COLUMN patient_medical_leave_1
 character varying(255);
COMMENT ON COLUMN patient_medical_leave.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_medical_leave.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_medical_leave.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_physical_exam ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN patient_physical_exam_1
 character varying(255);
COMMENT ON COLUMN patient_physical_exam.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_physical_exam.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_physical_exam.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE patient_vital DROP COLUMN patient_vital_1;
ALTER TABLE patient_vital ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_vital ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_vital ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_vital ADD COLUMN patient_vital_1
 character varying(255);
COMMENT ON COLUMN patient_vital.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_vital.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN patient_vital.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE prescript_queue DROP COLUMN prescript_queue_1;
ALTER TABLE prescript_queue ADD COLUMN eprescript_id character varying(10);
ALTER TABLE prescript_queue ADD COLUMN eprescript_remarks character varying(255);
ALTER TABLE prescript_queue ADD COLUMN eprescript_status character varying(50);
ALTER TABLE prescript_queue ADD COLUMN prescript_ref character varying(50);
ALTER TABLE prescript_queue ADD COLUMN synch_in character varying(10);
ALTER TABLE prescript_queue ADD COLUMN synch_out character varying(10);
ALTER TABLE prescript_queue ADD COLUMN synch_remarks character varying(255);
ALTER TABLE prescript_queue ADD COLUMN prescript_queue_1
 character varying(255);
COMMENT ON COLUMN prescript_queue.eprescript_id IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN prescript_queue.eprescript_remarks IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN prescript_queue.eprescript_status IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN prescript_queue.prescript_ref IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN prescript_queue.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN prescript_queue.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN prescript_queue.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE dispense_queue DROP COLUMN dispense_queue_1;
ALTER TABLE dispense_queue ADD COLUMN drug_code_id character varying(10);
ALTER TABLE dispense_queue ADD COLUMN synch_in character varying(10);
ALTER TABLE dispense_queue ADD COLUMN synch_out character varying(10);
ALTER TABLE dispense_queue ADD COLUMN synch_remarks character varying(255);
ALTER TABLE dispense_queue ADD COLUMN dispense_queue_1
 character varying(255);
COMMENT ON COLUMN dispense_queue.drug_code_id IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN dispense_queue.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN dispense_queue.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN dispense_queue.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE lab_order DROP COLUMN lab_order_1;
ALTER TABLE lab_order ADD COLUMN result_date date;
ALTER TABLE lab_order ADD COLUMN date_recorded date;
ALTER TABLE lab_order ADD COLUMN lab_order_1
 character varying(255);
COMMENT ON COLUMN lab_order.result_date IS 'THIRRA May 28, 2010';
COMMENT ON COLUMN lab_order.date_recorded IS 'THIRRA May 28, 2010';


ALTER TABLE imaging_order DROP COLUMN imaging_order_1;
ALTER TABLE imaging_order ADD COLUMN synch_in character varying(10);
ALTER TABLE imaging_order ADD COLUMN synch_out character varying(10);
ALTER TABLE imaging_order ADD COLUMN synch_remarks character varying(255);
ALTER TABLE imaging_order ADD COLUMN imaging_order_1
 character varying(255);
COMMENT ON COLUMN imaging_order.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_order.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_order.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE procedure_order ADD COLUMN procedure_ref character varying(10);
ALTER TABLE procedure_order ADD COLUMN synch_in character varying(10);
ALTER TABLE procedure_order ADD COLUMN synch_out character varying(10);
ALTER TABLE procedure_order ADD COLUMN synch_remarks character varying(255);
ALTER TABLE procedure_order ADD COLUMN procedure_order_1
 character varying(255);
COMMENT ON COLUMN procedure_order.procedure_ref IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN procedure_order.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN procedure_order.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN procedure_order.synch_remarks IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN procedure_order.procedure_order_1 IS 'THIRRA March 31, 2010';


ALTER TABLE supplier_contact_info DROP COLUMN supplier_contact_info_1;
ALTER TABLE supplier_contact_info ADD COLUMN contact_other character varying(255);
ALTER TABLE supplier_contact_info ADD COLUMN website character varying(255);
ALTER TABLE supplier_contact_info ADD COLUMN contact_remarks character varying(255);
ALTER TABLE supplier_contact_info ADD COLUMN synch_in character varying(10);
ALTER TABLE supplier_contact_info ADD COLUMN synch_out character varying(10);
ALTER TABLE supplier_contact_info ADD COLUMN synch_remarks character varying(255);
ALTER TABLE supplier_contact_info ADD COLUMN supplier_contact_info_1
 character varying(255);
COMMENT ON COLUMN supplier_contact_info.contact_other IS 'THIRRA May 9, 2010';
COMMENT ON COLUMN supplier_contact_info.website IS 'THIRRA May 9, 2010';
COMMENT ON COLUMN supplier_contact_info.contact_remarks IS 'THIRRA May 9, 2010';
COMMENT ON COLUMN supplier_contact_info.synch_in IS 'THIRRA May 9, 2010';
COMMENT ON COLUMN supplier_contact_info.synch_out IS 'THIRRA May 9, 2010';
COMMENT ON COLUMN supplier_contact_info.synch_remarks IS 'THIRRA May 9, 2010';


ALTER TABLE lab_package_test DROP COLUMN lab_package_test_1;
ALTER TABLE lab_package_test ADD COLUMN test_minlegal numeric(9,4);
ALTER TABLE lab_package_test ADD COLUMN test_minnormal numeric(9,4);
ALTER TABLE lab_package_test ADD COLUMN test_maxnormal numeric(9,4);
ALTER TABLE lab_package_test ADD COLUMN test_maxlegal numeric(9,4);
ALTER TABLE lab_package_test ADD COLUMN concept_id character varying(10);
ALTER TABLE lab_package_test ADD COLUMN synch_in character varying(10);
ALTER TABLE lab_package_test ADD COLUMN synch_out character varying(10);
ALTER TABLE lab_package_test ADD COLUMN synch_remarks character varying(255);
ALTER TABLE lab_package_test ADD COLUMN lab_package_test_1
 character varying(255);
COMMENT ON COLUMN lab_package_test.test_minlegal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN lab_package_test.test_minnormal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN lab_package_test.test_maxnormal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN lab_package_test.test_maxlegal IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN lab_package_test.concept_id IS 'THIRRA May 10, 2010';
COMMENT ON COLUMN lab_package_test.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN lab_package_test.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN lab_package_test.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE imaging_supplier ADD COLUMN credit_term int4;
ALTER TABLE imaging_supplier ADD COLUMN supplier_remarks character varying(255);
ALTER TABLE imaging_supplier ADD COLUMN synch_in character varying(10);
ALTER TABLE imaging_supplier ADD COLUMN synch_out character varying(10);
ALTER TABLE imaging_supplier ADD COLUMN synch_remarks character varying(255);
ALTER TABLE imaging_supplier ADD COLUMN patch_remarks character varying(255);
ALTER TABLE imaging_supplier ADD COLUMN patch_version character varying(50);
ALTER TABLE imaging_supplier ADD COLUMN patch_date date;
ALTER TABLE imaging_supplier ADD COLUMN imaging_supplier_1
 character varying(255);
COMMENT ON COLUMN imaging_supplier.credit_term IS 'THIRRA May 24, 2010';
COMMENT ON COLUMN imaging_supplier.supplier_remarks IS 'THIRRA May 24, 2010';
COMMENT ON COLUMN imaging_supplier.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_supplier.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_supplier.synch_remarks IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_supplier.supplier_remarks IS 'THIRRA May 24, 2010';
COMMENT ON COLUMN imaging_supplier.patch_remarks IS 'THIRRA May 24, 2010';
COMMENT ON COLUMN imaging_supplier.patch_version IS 'THIRRA May 24, 2010';
COMMENT ON COLUMN imaging_supplier.patch_date IS 'THIRRA May 24, 2010';


-- End of initial modifications


-- Build 115 onwards

ALTER TABLE patient_antenatal ADD COLUMN antenatal_reference character varying(25);
ALTER TABLE patient_antenatal ADD COLUMN event_id character varying(10);
ALTER TABLE patient_antenatal ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal ADD COLUMN patient_antenatal_1
 character varying(255);
COMMENT ON COLUMN patient_antenatal.antenatal_reference IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal.event_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE patient_antenatal_current ADD COLUMN menstrual_cycle_length int2;
ALTER TABLE patient_antenatal_current ADD COLUMN lmp_edd date;
ALTER TABLE patient_antenatal_current ADD COLUMN lmp_gestation character varying(255);
ALTER TABLE patient_antenatal_current ADD COLUMN usscan_date date;
ALTER TABLE patient_antenatal_current ADD COLUMN usscan_edd date;
ALTER TABLE patient_antenatal_current ADD COLUMN usscan_gestation character varying(255);
ALTER TABLE patient_antenatal_current ADD COLUMN event_id character varying(10);
ALTER TABLE patient_antenatal_current ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal_current ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal_current ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal_current ADD COLUMN patient_antenatal_1
 character varying(255);
COMMENT ON COLUMN patient_antenatal_current.menstrual_cycle_length IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.lmp_edd IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.lmp_gestation IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.usscan_date IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.usscan_edd IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.usscan_gestation IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.event_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_current.synch_remarks IS 'THIRRA October 5, 2010';


DROP TABLE if exists patient_antenatal_delivery;
CREATE TABLE patient_antenatal_delivery
(
  antenatal_delivery_id character(10) NOT NULL,
  antenatal_id character(10) NOT NULL,
  date_admission date,
  time_admission time without time zone, -- Modified for THIRRA October 5, 2010
  date_delivery date,
  time_delivery time without time zone, -- Modified for THIRRA October 5, 2010
  delivery_type character varying(255), -- Modified for THIRRA October 5, 2010
  delivery_place character varying(255), -- Modified for THIRRA October 5, 2010
  mother_condition text,
  baby_condition text,
  baby_weight smallint, -- Modified for THIRRA October 5, 2010
  complication_icpc character(6),
  complication_notes text,
  baby_alive boolean, -- THIRRA October 5, 2010
  birth_attendant character varying(255), -- THIRRA October 5, 2010
  breastfeed_immediate character varying(255), -- THIRRA October 5, 2010
  post_partum_bleed character varying(255), -- THIRRA October 5, 2010
  apgar_score smallint, -- THIRRA October 5, 2010
  event_id character varying(10), -- THIRRA October 5, 2010
  synch_in character varying(10), -- THIRRA October 5, 2010
  synch_out character varying(10), -- THIRRA October 5, 2010
  synch_remarks character varying(255), -- THIRRA October 5, 2010
  patient_antenatal_delivery_1 character varying(255),
  CONSTRAINT patient_antenatal_delivery_pkey PRIMARY KEY (antenatal_delivery_id),
  CONSTRAINT patient_antenatal_delivery_fk_1 FOREIGN KEY (antenatal_id)
      REFERENCES patient_antenatal (antenatal_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT,
  CONSTRAINT patient_antenatal_delivery_fk_2 FOREIGN KEY (complication_icpc)
      REFERENCES icpc2_ext_diagnosis (icpc_extension) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_antenatal_delivery OWNER TO thirra;
COMMENT ON COLUMN patient_antenatal_delivery.time_admission IS 'Modified for THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.time_delivery IS 'Modified for THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.delivery_type IS 'Modified for THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.delivery_place IS 'Modified for THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.baby_weight IS 'Modified for THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.baby_alive IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.birth_attendant IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.breastfeed_immediate IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.post_partum_bleed IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.apgar_score IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.event_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.synch_remarks IS 'THIRRA October 5, 2010';


DROP TABLE if exists patient_antenatal_followup;
CREATE TABLE patient_antenatal_followup
(
  antenatal_followup_id character(10) NOT NULL,
  antenatal_id character(10) NOT NULL,
  date date,
  pregnancy_duration character varying(20),
  lie character varying(100),
  weight character varying(10),
  fundal_height smallint, -- Modified for THIRRA October 5, 2010
  hb character varying(100),
  urine_alb character varying(20),
  urine_sugar character varying(10),
  ankle_odema character varying(10),
  notes text,
  next_followup date,
  fundal_height2 smallint, -- THIRRA October 5, 2010
  session_id character varying(10), -- THIRRA October 5, 2010
  event_id character varying(10), -- THIRRA October 5, 2010
  synch_in character varying(10), -- THIRRA October 5, 2010
  synch_out character varying(10), -- THIRRA October 5, 2010
  synch_remarks character varying(255), -- THIRRA October 5, 2010
  patient_antenatal_followup_1 character varying(255),
  CONSTRAINT patient_antenatal_followup_pkey PRIMARY KEY (antenatal_followup_id),
  CONSTRAINT patient_antenatal_followup_fk_1 FOREIGN KEY (antenatal_id)
      REFERENCES patient_antenatal (antenatal_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_antenatal_followup OWNER TO thirra;
COMMENT ON COLUMN patient_antenatal_followup.fundal_height IS 'Modified for THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_followup.fundal_height2 IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_followup.session_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_followup.event_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_followup.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_followup.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_followup.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE patient_antenatal_health ADD COLUMN height_lessthan_145cm boolean;
ALTER TABLE patient_antenatal_health ADD COLUMN event_id character varying(10);
ALTER TABLE patient_antenatal_health ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal_health ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal_health ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal_health ADD COLUMN patient_antenatal_health_1
 character varying(255);
COMMENT ON COLUMN patient_antenatal_health.height_lessthan_145cm IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_health.event_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_health.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_health.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_health.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE patient_antenatal_info ADD COLUMN num_term_deliveries character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN num_preterm_deliveries character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN num_preg_lessthan_21wk character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN num_live_births character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN num_caesarean_births character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN num_miscarriages character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN three_consec_miscarriages boolean;
ALTER TABLE patient_antenatal_info ADD COLUMN num_stillbirths character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN post_partum_depression character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN present_pulmonary_tb character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN present_heart_disease character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN present_diabetes character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN present_bronchial_asthma character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN present_goiter character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN present_hepatitis_b character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN antenatal_id character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN event_id character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN patient_antenatal_info_1
 character varying(255);
COMMENT ON COLUMN patient_antenatal_info.num_term_deliveries IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.num_preterm_deliveries IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.num_preg_lessthan_21wk IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.num_live_births IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.num_caesarean_births IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.num_miscarriages IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.three_consec_miscarriages IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.num_stillbirths IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.post_partum_depression IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.present_pulmonary_tb IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.present_heart_disease IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.present_diabetes IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.present_bronchial_asthma IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.present_goiter IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.present_hepatitis_b IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.antenatal_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.event_id IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_remarks IS 'THIRRA October 5, 2010';


-- End of Build 115 modifications


-- Build 122 onwards

DROP TABLE IF EXISTS clinic_dept;
CREATE TABLE clinic_dept
(
  clinic_dept_id character(10) NOT NULL,
  location_id character(10) NOT NULL,
  dept_name character varying(100) NOT NULL,
  dept_shortname character varying(20) NOT NULL,
  dept_code character varying(20),
  dept_description character varying(255),
  dept_head character varying(50),
  dept_telno character varying(20),
  dept_sort integer,
  dept_remarks character varying(255),
  clinic_dept_1 character varying(255),
  CONSTRAINT clinic_dept_pkey PRIMARY KEY (clinic_dept_id),
  CONSTRAINT clinic_dept_fk_1 FOREIGN KEY (location_id)
      REFERENCES clinic_info (clinic_info_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE clinic_dept OWNER TO thirra;
COMMENT ON TABLE clinic_dept IS 'Added on November 17, 2010';


ALTER TABLE room DROP COLUMN room_1;
ALTER TABLE room ADD COLUMN beds_qty int2;
ALTER TABLE room ADD COLUMN room_floor character varying(20);
ALTER TABLE room ADD COLUMN clinic_dept_id character(10);
ALTER TABLE room ADD COLUMN room_remarks character varying(255);
ALTER TABLE room ADD COLUMN room_1 character varying(255);
COMMENT ON COLUMN room.beds_qty IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN room.room_floor IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN room.clinic_dept_id IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN room.room_remarks IS 'THIRRA November 17, 2010';
ALTER TABLE room ADD CONSTRAINT room_fk_2 FOREIGN KEY (clinic_dept_id)
      REFERENCES clinic_dept (clinic_dept_id) MATCH SIMPLE;


ALTER TABLE staff_work DROP COLUMN staff_work_1;
ALTER TABLE staff_work ADD COLUMN staff_id character(10);
ALTER TABLE staff_work ADD COLUMN employee_no character varying(50);
ALTER TABLE staff_work ADD COLUMN clinic_dept_id character(10);
ALTER TABLE staff_work ADD COLUMN work_remarks character varying(255);
ALTER TABLE staff_work ADD COLUMN staff_work_1 character varying(255);
COMMENT ON COLUMN staff_work.staff_id IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN staff_work.employee_no IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN staff_work.clinic_dept_id IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN staff_work.work_remarks IS 'THIRRA November 17, 2010';
ALTER TABLE staff_work ADD CONSTRAINT staff_work_fk_2 FOREIGN KEY (clinic_dept_id)
      REFERENCES clinic_dept (clinic_dept_id) MATCH SIMPLE;
-- Need to add foreign key for staff_id in the future


ALTER TABLE patient_antenatal_delivery DROP COLUMN synch_in;
ALTER TABLE patient_antenatal_delivery DROP COLUMN synch_out;
ALTER TABLE patient_antenatal_delivery DROP COLUMN synch_remarks;
ALTER TABLE patient_antenatal_delivery DROP COLUMN patient_antenatal_delivery_1;
ALTER TABLE patient_antenatal_delivery ADD COLUMN child_id character varying(26);
ALTER TABLE patient_antenatal_delivery ADD COLUMN delivery_remarks character varying(255);
ALTER TABLE patient_antenatal_delivery ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal_delivery ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal_delivery ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal_delivery ADD COLUMN patient_antenatal_delivery_1 character varying(255);
COMMENT ON COLUMN patient_antenatal_delivery.child_id IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN patient_antenatal_delivery. delivery_remarks IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_delivery.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE patient_antenatal_info DROP COLUMN synch_in;
ALTER TABLE patient_antenatal_info DROP COLUMN synch_out;
ALTER TABLE patient_antenatal_info DROP COLUMN synch_remarks;
ALTER TABLE patient_antenatal_info DROP COLUMN patient_antenatal_info_1;
ALTER TABLE patient_antenatal_info ADD COLUMN antenatal_remarks character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN patient_antenatal_info_1 character varying(255);
COMMENT ON COLUMN patient_antenatal_delivery.child_id IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN patient_antenatal_info.antenatal_remarks IS 'THIRRA November 17, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE referral_doctor DROP COLUMN referral_doctor_1;
ALTER TABLE referral_doctor ADD COLUMN doctor_active character varying(10);
ALTER TABLE referral_doctor ADD COLUMN referral_doctor_1 character varying(255);
COMMENT ON COLUMN referral_doctor. doctor_active IS 'THIRRA November 17, 2010';


-- End of Build 122 modifications


-- Build 158 onwards

DROP TABLE IF EXISTS counselling; 
CREATE TABLE counselling 
( 
  counselling_id character(10) NOT NULL, 
  counsel_code character varying(20), 
  counsel_sort int2, 
  counsel_group character varying(50), 
  counsel_level character varying(20), 
  counsel_name character varying(50), 
  counsel_descr text, 
  counsel_text text, 
  counsel_filepath character varying(255), 
  filter_sex character(1), 
  filter_youngerthan numeric(2), 
  filter_olderthan numeric(2), 
  filter_1 character(255), 
  filter_2 character(255), 
  counsel_remarks character varying(255), 
  counselling_1 character varying(255), 
  CONSTRAINT counselling_pkey PRIMARY KEY (counselling_id)
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE counselling OWNER TO thirra; 
COMMENT ON TABLE counselling IS 'Added on January 31, 2011';

COMMENT ON TABLE counselling IS 'Added on January 31, 2011';
-- Index: counselling_ik1
-- DROP INDEX counselling_ik1;
CREATE INDEX counselling_ik1
  ON counselling
  USING btree
  (counsel_name);

-- Index: counselling_ik2
-- DROP INDEX counselling_ik2;
CREATE INDEX counselling_ik2
  ON counselling
  USING btree
  (counsel_group, counsel_level, counsel_name);

-- Index: counselling_ik3
-- DROP INDEX counselling_ik3;
CREATE INDEX counselling_ik3
  ON counselling
  USING btree
  (counsel_code);


DROP TABLE IF EXISTS diagnosis_group; 
CREATE TABLE diagnosis_group 
( 
  diagnosis_group_id character(10) NOT NULL, 
  diagnosis_group_code character varying(50), 
  group_sort smallint, 
  group_code character varying(50), 
  group_name character varying(50), 
  dcode1ext_code character varying(50) NOT NULL, 
  diagnosis_group_remarks character varying(255), 
  diagnosis_group_1 character varying(255), 
  CONSTRAINT diagnosis_group_pkey PRIMARY KEY (diagnosis_group_id), 
  CONSTRAINT diagnosis_group_fk1 FOREIGN KEY (dcode1ext_code) 
      REFERENCES dcode1ext (dcode1ext_code) MATCH SIMPLE 
      ON UPDATE CASCADE ON DELETE RESTRICT 
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE diagnosis_group OWNER TO thirra; 
COMMENT ON TABLE diagnosis_group IS 'Added on January 31, 2011'; 


ALTER TABLE dispense_queue DROP COLUMN dispense_queue_1;
ALTER TABLE dispense_queue ADD COLUMN dose_duration numeric(5,2);
ALTER TABLE dispense_queue ADD COLUMN generic_drugname character varying(255);
ALTER TABLE dispense_queue ADD COLUMN drug_tradename character varying(255);
ALTER TABLE dispense_queue ADD COLUMN dispense_remarks character varying(255);
ALTER TABLE dispense_queue ADD COLUMN dispense_queue_1 character varying(255);
COMMENT ON COLUMN dispense_queue.dose_duration IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN dispense_queue.generic_drugname IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN dispense_queue.drug_tradename IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN dispense_queue.dispense_remarks IS 'THIRRA January 31, 2011';


ALTER TABLE drug_stock DROP COLUMN drug_stock_1;
ALTER TABLE drug_stock ADD COLUMN product_name character varying(100);
ALTER TABLE drug_stock ADD COLUMN drug_stock_1 character varying(255);
COMMENT ON COLUMN drug_stock.product_name IS 'THIRRA January 28, 2011';


ALTER TABLE imaging_product DROP COLUMN imaging_product_1;
ALTER TABLE imaging_product ADD COLUMN remarks character varying(255);
ALTER TABLE imaging_product ADD COLUMN imaging_product_1 character varying(255);
COMMENT ON COLUMN imaging_product.remarks IS 'THIRRA January 31, 2011';


ALTER TABLE immunisation DROP COLUMN immunisation_1;
ALTER TABLE immunisation ADD COLUMN immunisation_code character varying(50);
ALTER TABLE immunisation ADD COLUMN immunisation_1 character varying(255);
COMMENT ON COLUMN immunisation.immunisation_code IS 'THIRRA January 28, 2011';


DROP TABLE IF EXISTS immunisation_group; 
CREATE TABLE immunisation_group 
( 
  immunisation_group_id character(10) NOT NULL, 
  immunisation_group character varying(20), 
  immunisation_id character(10) NOT NULL, 
  group_sort int2, 
  note character varying(255), 
  remarks character varying(255), 
  immunisation_group_1 character varying(255), 
  CONSTRAINT immunisation_group_pkey PRIMARY KEY (immunisation_group_id), 
  CONSTRAINT immunisation_drug_fk1 FOREIGN KEY (immunisation_id) 
      REFERENCES immunisation (immunisation_id) MATCH SIMPLE 
      ON UPDATE CASCADE ON DELETE RESTRICT 
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE immunisation_group OWNER TO thirra; 
COMMENT ON TABLE immunisation_group IS 'Added on January 31, 2011';


DROP TABLE IF EXISTS lab_group; 
CREATE TABLE lab_group 
( 
  lab_group_id character(10) NOT NULL, 
  lab_group_code character varying(50), 
  group_sort smallint, 
  group_code character varying(50), 
  group_name character varying(50), 
  lab_package_id character varying(50) NOT NULL, 
  lab_group_remarks character varying(255), 
  lab_group_1 character varying(255), 
  CONSTRAINT lab_group_pkey PRIMARY KEY (lab_group_id), 
  CONSTRAINT lab_group_fk1 FOREIGN KEY (lab_package_id) 
      REFERENCES lab_package (lab_package_id) MATCH SIMPLE 
      ON UPDATE CASCADE ON DELETE RESTRICT 
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE lab_group OWNER TO thirra; 
COMMENT ON TABLE lab_group IS 'Added on January 31, 2011'; 


ALTER TABLE lab_order DROP COLUMN lab_order_1;
ALTER TABLE lab_order DROP COLUMN date_recorded;
ALTER TABLE lab_order ADD COLUMN result_ref character varying(50);
ALTER TABLE lab_order ADD COLUMN recorded_timestamp character varying(10);
ALTER TABLE lab_order ADD COLUMN lab_order_1 character varying(255);
COMMENT ON COLUMN lab_order.result_ref IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN lab_order.recorded_timestamp IS 'THIRRA January 28, 2011';


ALTER TABLE lab_result DROP COLUMN lab_result_1;
ALTER TABLE lab_result ADD COLUMN result_ref character varying(50);
ALTER TABLE lab_result ADD COLUMN recorded_timestamp character varying(10);
ALTER TABLE lab_result ADD COLUMN lab_result_1 character varying(255);
COMMENT ON COLUMN lab_result.result_ref IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN lab_result.recorded_timestamp IS 'THIRRA January 28, 2011';


ALTER TABLE patient_antenatal_info DROP COLUMN patient_antenatal_info_1;
ALTER TABLE patient_antenatal_info DROP COLUMN synch_remarks;
ALTER TABLE patient_antenatal_info DROP COLUMN synch_out;
ALTER TABLE patient_antenatal_info DROP COLUMN synch_in;
ALTER TABLE patient_antenatal_info ADD COLUMN contact_person character varying(26);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_antenatal_info ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_antenatal_info ADD COLUMN patient_antenatal_info_1 character varying(255);
COMMENT ON COLUMN patient_antenatal_info.contact_person IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_antenatal_info.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_antenatal_info.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE patient_consultation_summary DROP COLUMN patient_consultation_1;
ALTER TABLE patient_consultation_summary ADD COLUMN postcon_annotate text;
ALTER TABLE patient_consultation_summary ADD COLUMN annotate_by character varying(10);
ALTER TABLE patient_consultation_summary ADD COLUMN annotate_time character varying(10);
ALTER TABLE patient_consultation_summary ADD COLUMN patient_consultation_1 character varying(255);
COMMENT ON COLUMN patient_consultation_summary.postcon_annotate IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_consultation_summary.annotate_by IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_consultation_summary.annotate_time IS 'THIRRA January 31, 2011';


DROP TABLE IF EXISTS patient_counselling; 
CREATE TABLE patient_counselling 
( 
  patient_counselling_id character(10) NOT NULL, 
  patient_id character(26) NOT NULL, 
  session_id character(10), 
  counselling_id character(10) NOT NULL, 
  counsel_note character varying(255), 
  counsel_remarks character varying(255), 
  counsel_by character(10), 
  counsel_when character(10), 
  counsel_depth character varying(255), 
  patient_response character varying(255), 
  synch_in character varying(10), 
  synch_out character varying(10), 
  synch_remarks character varying(255), 
  patient_counselling character varying(255),
 CONSTRAINT patient_counselling_pkey PRIMARY KEY (patient_counselling_id)
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE patient_counselling OWNER TO thirra; 
COMMENT ON TABLE patient_counselling IS 'Added on January 31, 2011';


ALTER TABLE patient_drug_allergy DROP COLUMN patient_drug_allergy_1;
ALTER TABLE patient_drug_allergy DROP COLUMN synch_remarks;
ALTER TABLE patient_drug_allergy DROP COLUMN synch_out;
ALTER TABLE patient_drug_allergy DROP COLUMN synch_in;
ALTER TABLE patient_drug_allergy ADD COLUMN generic_drugname character varying(255);
ALTER TABLE patient_drug_allergy ADD COLUMN drug_tradename character varying(255);
ALTER TABLE patient_drug_allergy ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_drug_allergy ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_drug_allergy ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_drug_allergy ADD COLUMN prescript_queue_1 character varying(255);
COMMENT ON COLUMN patient_drug_allergy.generic_drugname IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_drug_allergy.drug_tradename IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_drug_allergy.synch_in IS 'THIRRA March 31, 2011';
COMMENT ON COLUMN patient_drug_allergy.synch_out IS 'THIRRA March 31, 2011';
COMMENT ON COLUMN patient_drug_allergy.synch_remarks IS 'THIRRA March 31, 2011';


ALTER TABLE patient_medication DROP COLUMN patient_medication_1;
ALTER TABLE patient_medication ADD COLUMN generic_drugname character varying(255);
ALTER TABLE patient_medication ADD COLUMN drug_tradename character varying(255);
ALTER TABLE patient_medication ADD COLUMN patient_medication_1 character varying(255);
COMMENT ON COLUMN patient_medication.generic_drugname IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_medication.drug_tradename IS 'THIRRA January 28, 2011';


ALTER TABLE patient_physical_exam DROP COLUMN patient_physical_exam_1;
ALTER TABLE patient_physical_exam DROP COLUMN synch_remarks;
ALTER TABLE patient_physical_exam DROP COLUMN synch_out;
ALTER TABLE patient_physical_exam DROP COLUMN synch_in;
ALTER TABLE patient_physical_exam ADD COLUMN breasts character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN breasts_spec character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN physical_exam_1 character varying(255);
COMMENT ON COLUMN patient_physical_exam.breasts IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_physical_exam.breasts_spec IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_physical_exam.synch_in IS 'THIRRA March 31, 2011';
COMMENT ON COLUMN patient_physical_exam.synch_out IS 'THIRRA March 31, 2011';
COMMENT ON COLUMN patient_physical_exam.synch_remarks IS 'THIRRA March 31, 2011';


ALTER TABLE patient_referral_reply ADD COLUMN reply_remarks text;
ALTER TABLE patient_referral_reply ADD COLUMN reply_reference character varying(50);
ALTER TABLE patient_referral_reply ADD COLUMN reply_recorder character varying(10);
ALTER TABLE patient_referral_reply ADD COLUMN when_recorded character varying(10);
ALTER TABLE patient_referral_reply ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_referral_reply ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_referral_reply ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_referral_reply ADD COLUMN patient_referral_reply_1 character varying(255);
COMMENT ON COLUMN patient_referral_reply.reply_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.reply_reference IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.reply_recorder IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.when_recorded IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.synch_in IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.synch_out IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.synch_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN patient_referral_reply.patient_referral_reply_1 IS 'THIRRA January 28, 2011';


DROP TABLE IF EXISTS patient_referral_attach; 
CREATE TABLE  patient_referral_attach
(
  referral_attach_id character(10) NOT NULL,
  referral_id character(10) NOT NULL,
  attach_section character varying(50) NOT NULL,
  attach_sort int2,
  attach_table character varying(50),
  attach_pkey character varying(30),
  attach_session_id character varying(10),
  attach_var01 character varying(50),
  attach_info01 character varying(255),
  attach_var02 character varying(50),
  attach_info02 character varying(255),
  attach_var03 character varying(50),
  attach_info03 character varying(255),
  attach_var04 character varying(50),
  attach_info04 character varying(255),
  attach_var05 character varying(50),
  attach_info05 character varying(255),
  attach_var06 character varying(50),
  attach_info06 character varying(255),
  attach_var07 character varying(50),
  attach_info07 character varying(255),
  attach_var08 character varying(50),
  attach_info08 character varying(255),
  attach_var09 character varying(50),
  attach_info09 character varying(255),
  attach_var10 character varying(50),
  attach_info10 character varying(255),
  attach_note text,
  attach_remarks character varying(255),
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_referral_attach_1 character varying(255),
  CONSTRAINT patient_referral_attach_pkey PRIMARY KEY (referral_attach_id),
  CONSTRAINT patient_referral_attach_fk1 FOREIGN KEY (referral_id)
      REFERENCES patient_referral (referral_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_referral_attach OWNER TO thirra;
COMMENT ON TABLE patient_referral_attach IS 'Added on January 28, 2011';


ALTER TABLE patient_social_history ALTER COLUMN alcohol_spec TYPE character varying(255);
ALTER TABLE patient_social_history ALTER COLUMN tobacco_spec TYPE character varying(255);
ALTER TABLE patient_social_history ALTER COLUMN exercise_spec TYPE character varying(255);
ALTER TABLE patient_social_history ALTER COLUMN trauma TYPE text;
ALTER TABLE patient_social_history ALTER COLUMN hospitalizations TYPE text;
ALTER TABLE patient_social_history ALTER COLUMN illness TYPE text;
ALTER TABLE patient_social_history ALTER COLUMN operation TYPE text;
ALTER TABLE patient_social_history ADD COLUMN social_others text;
ALTER TABLE patient_social_history ADD COLUMN social_edited character varying(5);
ALTER TABLE patient_social_history ADD COLUMN edit_reason character varying(255);
ALTER TABLE patient_social_history ADD COLUMN edit_staff character (10);
ALTER TABLE patient_social_history ADD COLUMN edit_date character (10);
ALTER TABLE patient_social_history ADD COLUMN social_deleted character varying(5);
ALTER TABLE patient_social_history ADD COLUMN delete_reason character varying(255);
ALTER TABLE patient_social_history ADD COLUMN delete_staff character (10);
ALTER TABLE patient_social_history ADD COLUMN delete_date character (10);
ALTER TABLE patient_social_history ADD COLUMN patient_social_history_1 character varying(255);
COMMENT ON COLUMN patient_social_history.alcohol_spec IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.tobacco_spec IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.exercise_spec IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.trauma IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.hospitalizations IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.illness IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.operation IS 'THIRRA edited January 31, 2011';
COMMENT ON COLUMN patient_social_history.social_others IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.social_edited IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.edit_reason IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.edit_reason IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.edit_staff IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.edit_date IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.social_deleted IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.delete_reason IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.delete_staff IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_social_history.delete_date IS 'THIRRA January 31, 2011';


ALTER TABLE patient_vital DROP COLUMN patient_vital_1;
ALTER TABLE patient_vital DROP COLUMN synch_remarks;
ALTER TABLE patient_vital DROP COLUMN synch_out;
ALTER TABLE patient_vital DROP COLUMN synch_in;
ALTER TABLE patient_vital ADD COLUMN vital1_var character varying(50);
ALTER TABLE patient_vital ADD COLUMN vital1_value character varying(50);
ALTER TABLE patient_vital ADD COLUMN vital1_uom character varying(20);
ALTER TABLE patient_vital ADD COLUMN vital2_var character varying(50);
ALTER TABLE patient_vital ADD COLUMN vital2_value character varying(50);
ALTER TABLE patient_vital ADD COLUMN vital2_uom character varying(20);
ALTER TABLE patient_vital ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_vital ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_vital ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_vital ADD COLUMN patient_vital_1 character varying(255);
COMMENT ON COLUMN patient_vital.vital1_var IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_vital.vital1_value IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_vital.vital1_uom IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_vital.vital2_var IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_vital.vital2_value IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_vital.vital2_uom IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN patient_vital.synch_in IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_vital.synch_out IS 'THIRRA October 5, 2010';
COMMENT ON COLUMN patient_vital.synch_remarks IS 'THIRRA October 5, 2010';


ALTER TABLE prescript_queue DROP COLUMN prescript_queue_1;
ALTER TABLE prescript_queue ADD COLUMN dose_duration numeric(5,2);
ALTER TABLE prescript_queue ADD COLUMN generic_drugname character varying(255);
ALTER TABLE prescript_queue ADD COLUMN drug_tradename character varying(255);
ALTER TABLE prescript_queue ADD COLUMN prescript_remarks character varying(255);
ALTER TABLE prescript_queue ADD COLUMN prescript_queue_1 character varying(255);
COMMENT ON COLUMN prescript_queue.dose_duration IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN prescript_queue.generic_drugname IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN prescript_queue.drug_tradename IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN prescript_queue.prescript_remarks IS 'THIRRA January 31, 2011';


ALTER TABLE procedure_invoice ADD COLUMN supplier_invoice_id character varying(10);
ALTER TABLE procedure_invoice ADD COLUMN procedure_invoice_1 character varying(255);
COMMENT ON COLUMN procedure_invoice.supplier_invoice_id IS 'THIRRA January 28, 2011';


ALTER TABLE procedure_product ADD COLUMN pcode1ext_id character(10);
ALTER TABLE procedure_product ADD COLUMN product_code character varying(50);
ALTER TABLE procedure_product ADD COLUMN commonly_used int2;
ALTER TABLE procedure_product ADD COLUMN prod_description character varying(255);
ALTER TABLE procedure_product ADD COLUMN retail_price_1 numeric(10,2);
ALTER TABLE procedure_product ADD COLUMN retail_price_2 numeric(10,2);
ALTER TABLE procedure_product ADD COLUMN retail_price_3 numeric(10,2);
ALTER TABLE procedure_product ADD COLUMN seller_code character varying(50);
ALTER TABLE procedure_product ADD COLUMN supplier_cost numeric(10,2);
ALTER TABLE procedure_product ADD COLUMN prod_remarks character varying(255);
ALTER TABLE procedure_product ADD COLUMN location_id character varying(10);
ALTER TABLE procedure_product ADD COLUMN procedure_product_1 character varying(255);
COMMENT ON COLUMN procedure_product.pcode1ext_id IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.product_code IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.commonly_used IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.prod_description IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.retail_price_1 IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.retail_price_2 IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.retail_price_3 IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.seller_code IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.supplier_cost IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.prod_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.location_id IS 'THIRRA January 28, 2011';


ALTER TABLE procedure_supplier ADD COLUMN credit_term int2;
ALTER TABLE procedure_supplier ADD COLUMN supplier_remarks character varying(255);
ALTER TABLE procedure_supplier ADD COLUMN synch_in character varying(10);
ALTER TABLE procedure_supplier ADD COLUMN synch_out character varying(10);
ALTER TABLE procedure_supplier ADD COLUMN synch_remarks character varying(255);
ALTER TABLE procedure_supplier ADD COLUMN patch_remarks character varying(255);
ALTER TABLE procedure_supplier ADD COLUMN patch_version character varying(50);
ALTER TABLE procedure_supplier ADD COLUMN patch_date character varying(10);
ALTER TABLE procedure_supplier ADD COLUMN procedure_supplier_1 character varying(255);
COMMENT ON COLUMN procedure_supplier.credit_term IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.supplier_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.synch_in IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.synch_out IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.synch_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.patch_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.patch_version IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_supplier.patch_date IS 'THIRRA January 28, 2011';


ALTER TABLE purchase_order DROP COLUMN purchase_order_1;
ALTER TABLE purchase_order ADD COLUMN supplier_name character varying(100);
ALTER TABLE purchase_order ADD COLUMN supplier_code character varying(20);
ALTER TABLE purchase_order ADD COLUMN purchase_order_1 character varying(255);
COMMENT ON COLUMN purchase_order. supplier_name IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN purchase_order. supplier_code IS 'THIRRA January 31, 2011';


ALTER TABLE referral_center DROP COLUMN referral_center_1;
ALTER TABLE referral_center ADD COLUMN pcdom_ref character varying(50);
ALTER TABLE referral_center ADD COLUMN thirra_url character varying(255);
ALTER TABLE referral_center ADD COLUMN referral_center_1 character varying(255);
COMMENT ON COLUMN referral_center.pcdom_ref IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN referral_center.thirra_url IS 'THIRRA January 28, 2011';


ALTER TABLE room DROP CONSTRAINT room_u_1;
ALTER TABLE room DROP COLUMN room_1;
ALTER TABLE room ADD CONSTRAINT room_uk1 UNIQUE (location_id, name);
ALTER TABLE room ADD COLUMN room_code character varying(50);
ALTER TABLE room ADD COLUMN room_1 character varying(255);
COMMENT ON COLUMN room.room_code IS 'THIRRA January 31, 2011';


ALTER TABLE system_user ADD COLUMN security_clearance int4;
ALTER TABLE system_user ADD COLUMN user_remarks character varying(255);
ALTER TABLE system_user ADD COLUMN failed_1 character varying(10);
ALTER TABLE system_user ADD COLUMN failed_2 character varying(10);
ALTER TABLE system_user ADD COLUMN failed_3 character varying(10);
ALTER TABLE system_user ADD COLUMN added_remarks character varying(255);
ALTER TABLE system_user ADD COLUMN added_staff character varying(10);
ALTER TABLE system_user ADD COLUMN added_time character varying(10);
ALTER TABLE system_user ADD COLUMN edit_remarks character varying(255);
ALTER TABLE system_user ADD COLUMN edit_staff character varying(10);
ALTER TABLE system_user ADD COLUMN edit_time character varying(10);
ALTER TABLE system_user ADD COLUMN synch_in character varying(10);
ALTER TABLE system_user ADD COLUMN synch_out character varying(10);
ALTER TABLE system_user ADD COLUMN synch_remarks character varying(255);
ALTER TABLE system_user ADD COLUMN system_user_1 character varying(255);
COMMENT ON COLUMN system_user.security_clearance IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.user_remarks IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.failed_1 IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.failed_2 IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.failed_3 IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.added_remarks IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.added_staff IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.added_time IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.edit_remarks IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.edit_staff IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.edit_time IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.synch_in IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.synch_out IS 'THIRRA January 31, 2011';
COMMENT ON COLUMN system_user.synch_remarks IS 'THIRRA January 31, 2011';


-- End of Build 158 modifications


-- Build 159 onwards

ALTER TABLE patient_antenatal_followup ALTER COLUMN weight TYPE character varying(10);
COMMENT ON COLUMN patient_antenatal_followup.weight IS 'THIRRA February 8, 2011';


-- End of Build 159 modifications


-- Build 171 onwards

DROP TABLE IF EXISTS database_info; 
CREATE TABLE   database_info
(
  database_info_id character(10) NOT NULL,
  upgrade_when character(10),
  thirra_version character varying(100),
  database_name character varying(255),
  upgrade_remarks text,
  database_info_1 character varying(255),
  CONSTRAINT database_info_pkey PRIMARY KEY (database_info_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE database_info OWNER TO thirra;


DROP TABLE IF EXISTS data_synch_log; 
CREATE TABLE  data_synch_log
(
  data_synch_log_id character(10) NOT NULL,
  export_by character(10),
  export_when character(10),
  thirra_version character varying(100),
  export_clinicname character varying(255),
  export_clinicref character varying(30),
  export_reference character varying(100),
  import_by character(10),
  import_when character(10),
  data_filename character varying(255),
  import_remarks text,
  import_reference character varying(100),
  import_number integer,
  import_outcome character varying(50),
  count_inserted integer,
  count_declined integer,
  count_rejected integer,
  entities_inserted text,
  entities_declined text,
  entities_rejected text,
  declined_list text,
  rejected_list text,
  outcome_remarks text,
  sync_type character varying(50),
  data_synch_log_1 character varying(255),
  CONSTRAINT data_synch_log_pkey PRIMARY KEY (data_synch_log_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE data_synch_log OWNER TO thirra;


ALTER TABLE drug_formulary DROP COLUMN drug_formulary_2;
ALTER TABLE drug_formulary DROP COLUMN drug_formulary_1;
ALTER TABLE drug_formulary ADD COLUMN formulary_active character varying(5);
ALTER TABLE drug_formulary ADD COLUMN drug_formulary_1 character varying(255);
ALTER TABLE drug_formulary ADD COLUMN drug_formulary_2 character varying(255);
COMMENT ON COLUMN drug_formulary.formulary_active IS 'THIRRA March 11, 2011';
UPDATE drug_formulary SET formulary_active='TRUE';


ALTER TABLE imaging_product DROP COLUMN imaging_product_1;
ALTER TABLE imaging_product ADD COLUMN location_id character(10);
ALTER TABLE imaging_product ADD COLUMN imaging_product_1 character varying(255);
COMMENT ON COLUMN imaging_product.location_id IS 'THIRRA March 11, 2011';


DROP TABLE IF EXISTS patient_file; 
CREATE TABLE patient_file
(
  patient_file_id character(10) NOT NULL,
  file_filename character varying(255),
  file_origname character varying(255),
  patient_id character(26),
  file_category character varying(100),
  file_ref character varying(30),
  file_title character varying(100),
  file_descr text,
  file_sort integer,
  staff_id character(10),
  file_upload_time character(10),
  file_mimetype character varying(25),
  file_extension character varying(10),
  file_size bigint,
  file_path character varying(100),
  summary_id character(10),
  location_id character varying(10),
  ip_uploaded character varying(20),
  file_remarks text,
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_file_1 character varying(255),
  CONSTRAINT patient_file_pkey PRIMARY KEY (patient_file_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_file OWNER TO thirra;


ALTER TABLE patient_family_details DROP COLUMN patient_family_details_1;
ALTER TABLE patient_family_details DROP COLUMN synch_remarks;
ALTER TABLE patient_family_details DROP COLUMN synch_out;
ALTER TABLE patient_family_details DROP COLUMN synch_in;
ALTER TABLE patient_family_details DROP COLUMN edit_date;
ALTER TABLE patient_family_details DROP COLUMN edit_staff;
ALTER TABLE patient_family_details DROP COLUMN edit_remarks;
ALTER TABLE patient_family_details DROP COLUMN added_date;
ALTER TABLE patient_family_details DROP COLUMN added_staff;
ALTER TABLE patient_family_details DROP COLUMN added_remarks;
ALTER TABLE patient_family_details ADD COLUMN other_head character(26);
ALTER TABLE patient_family_details ADD COLUMN added_remarks character varying(255);
ALTER TABLE patient_family_details ADD COLUMN added_staff character varying(10);
ALTER TABLE patient_family_details ADD COLUMN added_date character varying(10);
ALTER TABLE patient_family_details ADD COLUMN edit_remarks character varying(255);
ALTER TABLE patient_family_details ADD COLUMN edit_staff character varying(10);
ALTER TABLE patient_family_details ADD COLUMN edit_date character varying(10);
ALTER TABLE patient_family_details ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_family_details ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_family_details ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_family_details ADD COLUMN patient_family_details_1 character varying(10);
COMMENT ON COLUMN patient_family_details.other_head IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_family_details.added_remarks IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.added_staff IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.added_date IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.edit_remarks IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.edit_staff IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.edit_date IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.synch_in IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.synch_out IS 'THIRRA Oct 10, 2007';
COMMENT ON COLUMN patient_family_details.synch_remarks IS 'THIRRA Oct 10, 2007';


ALTER TABLE patient_physical_exam DROP COLUMN physical_exam_1;
ALTER TABLE patient_physical_exam DROP COLUMN synch_remarks;
ALTER TABLE patient_physical_exam DROP COLUMN synch_out;
ALTER TABLE patient_physical_exam DROP COLUMN synch_in;
ALTER TABLE patient_physical_exam ADD COLUMN exam_part1 character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN exam_spec1 character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN exam_part2 character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN exam_spec2 character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN exam_part3 character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN exam_spec3 character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_physical_exam ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_physical_exam ADD COLUMN physical_exam_1 character varying(255);
COMMENT ON COLUMN patient_physical_exam.exam_part1 IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.exam_spec1 IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.exam_part2 IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.exam_spec2 IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.exam_part3 IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.exam_spec3 IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.synch_in IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.synch_out IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_physical_exam.synch_remarks IS 'THIRRA March 11, 2011';


ALTER TABLE patient_social_history DROP COLUMN patient_social_history_1;
ALTER TABLE patient_social_history DROP COLUMN delete_date;
ALTER TABLE patient_social_history DROP COLUMN delete_staff;
ALTER TABLE patient_social_history DROP COLUMN delete_reason;
ALTER TABLE patient_social_history DROP COLUMN social_deleted;
ALTER TABLE patient_social_history DROP COLUMN edit_date;
ALTER TABLE patient_social_history DROP COLUMN edit_staff;
ALTER TABLE patient_social_history DROP COLUMN edit_reason;
ALTER TABLE patient_social_history DROP COLUMN social_edited;
ALTER TABLE patient_social_history DROP COLUMN social_others;
ALTER TABLE patient_social_history ADD COLUMN drugs_uom character varying(30);
ALTER TABLE patient_social_history ADD COLUMN alcohol_uom character varying(30);
ALTER TABLE patient_social_history ADD COLUMN tobacco_use_uom character varying(30);
ALTER TABLE patient_social_history ADD COLUMN exercise_use_uom character varying(30);
ALTER TABLE patient_social_history ADD COLUMN social_others text;
ALTER TABLE patient_social_history ADD COLUMN social_edited character varying(5);
ALTER TABLE patient_social_history ADD COLUMN edit_reason character varying(255);
ALTER TABLE patient_social_history ADD COLUMN edit_staff character varying(10);
ALTER TABLE patient_social_history ADD COLUMN edit_date character varying(10);
ALTER TABLE patient_social_history ADD COLUMN social_deleted character varying(5);
ALTER TABLE patient_social_history ADD COLUMN delete_reason character varying(255);
ALTER TABLE patient_social_history ADD COLUMN delete_staff character varying(10);
ALTER TABLE patient_social_history ADD COLUMN delete_date character varying(10);
ALTER TABLE patient_social_history ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_social_history ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_social_history ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_social_history ADD COLUMN patient_social_history_1 character varying(255);
COMMENT ON COLUMN patient_social_history.drugs_uom IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_social_history.alcohol_uom IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_social_history.tobacco_use_uom IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_social_history.exercise_use_uom IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN patient_social_history.social_others IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.social_edited IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.edit_reason IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.edit_staff IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.edit_date IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.social_deleted IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.delete_reason IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.delete_staff IS 'THIRRA January 30, 2011';
COMMENT ON COLUMN patient_social_history.delete_date IS 'THIRRA January 30, 2011';


ALTER TABLE system_log DROP COLUMN system_log_1;
ALTER TABLE system_log ADD COLUMN log_outcome character varying(50);
ALTER TABLE system_log ADD COLUMN system_log_1 character varying(255);
COMMENT ON COLUMN system_log.log_outcome IS 'THIRRA March 11, 2011';
UPDATE system_log SET log_outcome='In';


ALTER TABLE system_user DROP COLUMN failed_1;
ALTER TABLE system_user DROP COLUMN failed_2;
ALTER TABLE system_user DROP COLUMN failed_3;


ALTER TABLE system_user_category ADD COLUMN security_clearance integer;
ALTER TABLE system_user_category ADD COLUMN category_remarks character varying(255);
ALTER TABLE system_user_category ADD COLUMN system_category_1 character varying(255);
COMMENT ON COLUMN system_user_category.security_clearance IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN system_user_category.category_remarks IS 'THIRRA March 11, 2011';
COMMENT ON COLUMN system_user_category.system_category_1 IS 'THIRRA March 11, 2011';


-- End of Build 171 modifications


-- Build 178 onwards

ALTER TABLE imaging_order DROP COLUMN imaging_order_1;
ALTER TABLE imaging_order DROP COLUMN synch_remarks;
ALTER TABLE imaging_order DROP COLUMN synch_out;
ALTER TABLE imaging_order DROP COLUMN synch_in;
ALTER TABLE imaging_order ADD COLUMN invoice_detail_id character varying(10);
ALTER TABLE imaging_order ADD COLUMN synch_in character varying(10);
ALTER TABLE imaging_order ADD COLUMN synch_out character varying(10);
ALTER TABLE imaging_order ADD COLUMN synch_remarks character varying(255);
ALTER TABLE imaging_order ADD COLUMN imaging_result_1 character varying(255);
COMMENT ON COLUMN imaging_order.invoice_detail_id IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_order.synch_in IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_order.synch_out IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN imaging_order.synch_remarks IS 'THIRRA March 31, 2010';


ALTER TABLE imaging_result DROP COLUMN imaging_result_1;
ALTER TABLE imaging_result ADD COLUMN result_remarks character varying(255);
ALTER TABLE imaging_result ADD COLUMN result_reviewed_by character varying(10);
ALTER TABLE imaging_result ADD COLUMN result_reviewed_date character varying(10);
ALTER TABLE imaging_result ADD COLUMN result_ref character varying(50);
ALTER TABLE imaging_result ADD COLUMN recorded_timestamp character varying(10);
ALTER TABLE imaging_result ADD COLUMN synch_in character varying(10);
ALTER TABLE imaging_result ADD COLUMN synch_out character varying(10);
ALTER TABLE imaging_result ADD COLUMN synch_remarks character varying(255);
ALTER TABLE imaging_result ADD COLUMN imaging_result_1 character varying(255);
COMMENT ON COLUMN imaging_result.result_remarks IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.result_reviewed_by IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.result_reviewed_date IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.result_ref IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.recorded_timestamp IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.synch_in IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.synch_out IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN imaging_result.synch_remarks IS 'THIRRA April 11, 2011';


ALTER TABLE patient_antenatal_delivery DROP COLUMN patient_antenatal_delivery_1;
ALTER TABLE patient_antenatal_delivery ADD COLUMN delivery_outcome character varying(255);
ALTER TABLE patient_antenatal_delivery ADD COLUMN dcode1ext_code character varying(50);
ALTER TABLE patient_antenatal_delivery ADD COLUMN patient_antenatal_delivery_1 character varying(255);
ALTER TABLE patient_antenatal_delivery DROP CONSTRAINT  patient_antenatal_delivery_fk_2;
ALTER TABLE patient_antenatal_delivery ADD CONSTRAINT patient_antenatal_delivery_fk_3 FOREIGN KEY (dcode1ext_code) REFERENCES dcode1ext (dcode1ext_code) MATCH SIMPLE ON UPDATE NO ACTION ON DELETE RESTRICT;
COMMENT ON COLUMN patient_antenatal_delivery.delivery_outcome IS 'THIRRA April 11, 2011';
COMMENT ON COLUMN patient_antenatal_delivery.dcode1ext_code IS 'THIRRA April 11, 2011';


ALTER TABLE patient_file DROP COLUMN patient_file_1;
ALTER TABLE patient_file DROP COLUMN synch_remarks;
ALTER TABLE patient_file DROP COLUMN synch_out;
ALTER TABLE patient_file DROP COLUMN synch_in;
ALTER TABLE patient_file ADD COLUMN order_id character varying(10);
ALTER TABLE patient_file ADD COLUMN synch_in character varying(10);
ALTER TABLE patient_file ADD COLUMN synch_out character varying(10);
ALTER TABLE patient_file ADD COLUMN synch_remarks character varying(255);
ALTER TABLE patient_file ADD COLUMN patient_file character varying(255);
COMMENT ON COLUMN patient_file.order_id IS 'THIRRA April 11, 2011';


-- End of Build 178 modifications


-- Build 179 onwards


ALTER TABLE patient_antenatal_info ADD CONSTRAINT patient_antenatal_info_uk1 UNIQUE (patient_id, gravida);


-- End of Build 179 modifications


-- Build 182 onwards 

DROP TABLE if exists patient_antenatal_postpartum; 
CREATE TABLE patient_antenatal_postpartum 
( 
  antenatal_postpartum_id character(10) NOT NULL, 
  antenatal_id character(10) NOT NULL, 
  session_id character varying(10), 
  event_id character varying(10), 
  care_date date, 
  termination_date date,
  breastfeed character varying(255), 
  want_family_planning character varying(255), 
  fever_38 character varying(255),
  vaginal_discharge character varying(255),
  vaginal_bleeding character varying(255),
  pallor character varying(255),
  cord character varying(255),
  postpartum_remarks text,
  synch_in character varying(10),
  synch_out character varying(10), 
  synch_remarks character varying(255), 
  patient_antenatal_postpartum_1 character varying(255), 
  CONSTRAINT patient_antenatal_postpartum_pkey PRIMARY KEY (antenatal_postpartum_id), 
  CONSTRAINT patient_antenatal_postpartum_fk_1 FOREIGN KEY (antenatal_id) 
      REFERENCES patient_antenatal (antenatal_id) MATCH SIMPLE 
      ON UPDATE NO ACTION ON DELETE RESTRICT 
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE patient_antenatal_postpartum OWNER TO thirra; 
COMMENT ON TABLE patient_antenatal_postpartum IS 'Added on April 25, 2011';


-- End of Build 182 modifications 


-- Build 184 onwards 


ALTER TABLE patient_antenatal DROP COLUMN patient_antenatal_1; 
ALTER TABLE patient_antenatal ADD COLUMN update_when numeric(10,0); 
ALTER TABLE patient_antenatal ADD COLUMN update_by character varying(10); 
ALTER TABLE patient_antenatal ADD COLUMN patient_antenatal_1 character varying(255); 
COMMENT ON COLUMN patient_antenatal.update_when IS 'THIRRA May 5, 2011'; 
COMMENT ON COLUMN patient_antenatal.update_by IS 'THIRRA May 5, 2011'; 


ALTER TABLE patient_antenatal_current DROP COLUMN patient_antenatal_1; 
ALTER TABLE patient_antenatal_current ADD COLUMN update_when numeric(10,0); 
ALTER TABLE patient_antenatal_current ADD COLUMN update_by character varying(10); 
ALTER TABLE patient_antenatal_current ADD COLUMN patient_antenatal_current_1 character varying(255); 
COMMENT ON COLUMN patient_antenatal_current.update_when IS 'THIRRA May 5, 2011'; 
COMMENT ON COLUMN patient_antenatal_current.update_by IS 'THIRRA May 5, 2011'; 


ALTER TABLE patient_antenatal_health DROP COLUMN patient_antenatal_health_1; 
ALTER TABLE patient_antenatal_health ADD COLUMN update_when numeric(10,0); 
ALTER TABLE patient_antenatal_health ADD COLUMN update_by character varying(10); 
ALTER TABLE patient_antenatal_health ADD COLUMN patient_antenatal_health_1 character varying(255); 
COMMENT ON COLUMN patient_antenatal_health.update_when IS 'THIRRA May 5, 2011'; 
COMMENT ON COLUMN patient_antenatal_health.update_by IS 'THIRRA May 5, 2011'; 


ALTER TABLE patient_antenatal_info DROP COLUMN patient_antenatal_info_1; 
ALTER TABLE patient_antenatal_info ADD COLUMN update_when numeric(10,0); 
ALTER TABLE patient_antenatal_info ADD COLUMN update_by character varying(10); 
ALTER TABLE patient_antenatal_info ADD COLUMN patient_antenatal_info_1 character varying(255); 
COMMENT ON COLUMN patient_antenatal_info.update_when IS 'THIRRA May 5, 2011'; 
COMMENT ON COLUMN patient_antenatal_info.update_by IS 'THIRRA May 5, 2011'; 


ALTER TABLE patient_demographic_info DROP COLUMN patient_demographic_info_2; 
ALTER TABLE patient_demographic_info DROP COLUMN patient_demographic_info_1; 
ALTER TABLE patient_demographic_info ADD COLUMN update_when numeric(10,0); 
ALTER TABLE patient_demographic_info ADD COLUMN update_by character varying(10); 
ALTER TABLE patient_demographic_info ADD COLUMN patient_demographic_info_1 character varying(255); 
ALTER TABLE patient_demographic_info ADD COLUMN patient_demographic_info_2 character varying(255); 
COMMENT ON COLUMN patient_demographic_info.update_when IS 'THIRRA May 5, 2011'; 
COMMENT ON COLUMN patient_demographic_info.update_by IS 'THIRRA May 5, 2011'; 


-- End of Build 184 modifications 


-- Build 185 onwards 

ALTER TABLE patient_antenatal_followup DROP COLUMN patient_antenatal_followup_1; 
ALTER TABLE patient_antenatal_followup DROP COLUMN synch_remarks; 
ALTER TABLE patient_antenatal_followup DROP COLUMN synch_out; 
ALTER TABLE patient_antenatal_followup DROP COLUMN synch_in; 
ALTER TABLE patient_antenatal_followup ADD COLUMN glucose_tolerance_test character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN vaginal_bleeding character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN vaginal_infection character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN urinary_tract_infection character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN blood_pressure character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN fever character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN pallor character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN abnormal_fundal_height character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN movements character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN abnormal_presentation character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN fetal_heart_tones character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN missing_fetal_heartbeat character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN supplement_iodine character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN supplement_iron character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN supplement_vitamins character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN supplement_folate character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN malaria_prophylaxis character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN breastfeed_intention character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN advise_4_danger_signs character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN dental_checkup character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN emergency_plans character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN healthy_diet character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN adequate_rest character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN adequate_exercise character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN thirdtrimester_issues character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN followup_remarks text; 
ALTER TABLE patient_antenatal_followup ADD COLUMN risks text; 
ALTER TABLE patient_antenatal_followup ADD COLUMN synch_in character varying(10); 
ALTER TABLE patient_antenatal_followup ADD COLUMN synch_out character varying(10); 
ALTER TABLE patient_antenatal_followup ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE patient_antenatal_followup ADD COLUMN update_when numeric(10,0); 
ALTER TABLE patient_antenatal_followup ADD COLUMN update_by character(10); 
ALTER TABLE patient_antenatal_followup ADD COLUMN patient_antenatal_followup_1 character varying(255); 
COMMENT ON COLUMN patient_antenatal_followup.glucose_tolerance_test IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.vaginal_bleeding IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.vaginal_infection IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.urinary_tract_infection IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.blood_pressure IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.fever IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.pallor IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.abnormal_fundal_height IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.movements IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.abnormal_presentation IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.fetal_heart_tones IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.missing_fetal_heartbeat IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.supplement_iodine IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.supplement_iron IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.supplement_vitamins IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.supplement_folate IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.malaria_prophylaxis IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.breastfeed_intention IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.advise_4_danger_signs IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.dental_checkup IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.emergency_plans IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.healthy_diet IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.adequate_rest IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.adequate_exercise IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.thirdtrimester_issues IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.followup_remarks IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.risks IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.synch_in IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.synch_out IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.synch_remarks IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.update_when IS 'THIRRA May 6, 2011'; 
COMMENT ON COLUMN patient_antenatal_followup.update_by IS 'THIRRA May 6, 2011'; 


ALTER TABLE staff_work DROP COLUMN staff_work_1; 
ALTER TABLE staff_work ADD COLUMN staff_position character varying(255); 
ALTER TABLE staff_work ADD COLUMN staff_work_1 character varying(255); 
COMMENT ON COLUMN staff_work.staff_position IS 'THIRRA April 30, 2011'; 


ALTER TABLE supplier_invoice DROP COLUMN supplier_invoice_1; 
ALTER TABLE supplier_invoice DROP COLUMN synch_remarks;
ALTER TABLE supplier_invoice DROP COLUMN synch_out;
ALTER TABLE supplier_invoice DROP COLUMN synch_in;
ALTER TABLE supplier_invoice DROP COLUMN posted_time;
ALTER TABLE supplier_invoice DROP COLUMN posted_date;
ALTER TABLE supplier_invoice DROP COLUMN posted_by;
ALTER TABLE supplier_invoice ADD COLUMN with_po boolean;
ALTER TABLE supplier_invoice ADD COLUMN posted_by character varying(10);
ALTER TABLE supplier_invoice ADD COLUMN posted_date date;
ALTER TABLE supplier_invoice ADD COLUMN posted_time time;
ALTER TABLE supplier_invoice ADD COLUMN synch_in character varying(10);
ALTER TABLE supplier_invoice ADD COLUMN synch_out character varying(10);
ALTER TABLE supplier_invoice ADD COLUMN synch_remarks character varying(255);
ALTER TABLE supplier_invoice ADD COLUMN supplier_invoice_1 character varying(255); 
COMMENT ON COLUMN supplier_invoice.with_po IS 'THIRRA April 30, 2011'; 
COMMENT ON COLUMN supplier_invoice.posted_by IS 'THIRRA Nov 28, 07'; 
COMMENT ON COLUMN supplier_invoice.posted_date IS 'THIRRA Nov 28, 07'; 
COMMENT ON COLUMN supplier_invoice.posted_time IS 'THIRRA Nov 28, 07'; 
COMMENT ON COLUMN supplier_invoice.synch_in IS 'THIRRA Nov 28, 07'; 
COMMENT ON COLUMN supplier_invoice.synch_out IS 'THIRRA Nov 28, 07'; 
COMMENT ON COLUMN supplier_invoice.synch_remarks IS 'THIRRA Nov 28, 07'; 


-- End of Build 185 modifications 


-- Build 201 onwards 

ALTER TABLE dispense_queue ALTER COLUMN instruction TYPE character varying(255);
ALTER TABLE dispense_queue ALTER COLUMN indication TYPE character varying(255);
ALTER TABLE dispense_queue ALTER COLUMN caution TYPE character varying(255);
COMMENT ON COLUMN dispense_queue.instruction IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN dispense_queue.indication IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN dispense_queue.caution IS 'Altered for THIRRA July 7, 2011'; 


ALTER TABLE drug_package ADD COLUMN package_code character varying(50);
ALTER TABLE drug_package ADD COLUMN package_remarks character varying(255);
ALTER TABLE drug_package ADD COLUMN package_sort integer;
ALTER TABLE drug_package ADD COLUMN package_active boolean;
ALTER TABLE drug_package ADD COLUMN location_id character(10);
ALTER TABLE drug_package ADD COLUMN drug_package_1 character varying(50);
COMMENT ON COLUMN drug_package.package_code IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package.package_remarks IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package.package_sort IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package.package_active IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package.location_id IS 'THIRRA July 7, 2011'; 


ALTER TABLE drug_package_content ALTER COLUMN instruction TYPE character varying(255);
ALTER TABLE drug_package_content ALTER COLUMN indication TYPE character varying(255);
ALTER TABLE drug_package_content ALTER COLUMN caution TYPE character varying(255);
ALTER TABLE drug_package_content ADD COLUMN drug_code_id character(10);
ALTER TABLE drug_package_content ADD COLUMN drug_remarks character varying(255);
ALTER TABLE drug_package_content ADD COLUMN package_content_1 character varying(255);
COMMENT ON COLUMN drug_package_content.instruction IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package_content.indication IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package_content.caution IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package_content.drug_code_id IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN drug_package_content.drug_remarks IS 'THIRRA July 7, 2011'; 


-- DROP TABLE drug_package_diagnosis;
CREATE TABLE drug_package_diagnosis
(
  package_diagnosis_id character(10) NOT NULL,
  drug_package_id character(10) NOT NULL,
  dcode1ext1_id character(10) NOT NULL,
  drug_diagnosis_code character varying(50), 
  drug_diagnosis_description character varying(255), 
  drug_diagnosis_remarks character varying(255), 
  drug_diagnosis_sort integer, 
  drug_diagnosis_active boolean, 
  drug_package_diagnosis_1 character varying(255), 
  CONSTRAINT package_diagnosis_pkey PRIMARY KEY (package_diagnosis_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE drug_package_diagnosis OWNER TO thirra;
COMMENT ON TABLE drug_package_diagnosis IS 'THIRRA July 7, 11';


ALTER TABLE imaging_result DROP COLUMN imaging_result_1; 
ALTER TABLE imaging_result DROP COLUMN synch_remarks; 
ALTER TABLE imaging_result DROP COLUMN synch_out; 
ALTER TABLE imaging_result DROP COLUMN synch_in; 
ALTER TABLE imaging_result ADD COLUMN result_status character varying(20); 
ALTER TABLE imaging_result ADD COLUMN synch_in character varying(10); 
ALTER TABLE imaging_result ADD COLUMN synch_out character varying(10); 
ALTER TABLE imaging_result ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE imaging_result ADD COLUMN imaging_result_1 character varying(255); 
COMMENT ON COLUMN imaging_result.result_status IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN imaging_result.synch_in IS 'THIRRA April 11, 2011'; 
COMMENT ON COLUMN imaging_result.synch_out IS 'THIRRA April 11, 2011'; 
COMMENT ON COLUMN imaging_result.synch_remarks IS 'THIRRA April 11, 2011'; 


DROP VIEW IF EXISTS gem_report_diagnosis;
ALTER TABLE patient_diagnosis ALTER COLUMN diagnosis_type TYPE character varying(20);
COMMENT ON COLUMN patient_diagnosis.diagnosis_type IS 'Altered for THIRRA July 7, 2011'; 

CREATE OR REPLACE VIEW gem_report_diagnosis AS 
 SELECT patient_diagnosis.diagnosis_id, patient_diagnosis.patient_id, patient_diagnosis.session_id, patient_diagnosis.icpc_code, patient_diagnosis.diagnosis_type, patient_diagnosis.notes, patient_diagnosis.dcode1set, patient_diagnosis.dcode1ext_code, patient_diagnosis.dcode2set, patient_diagnosis.dcode2ext_code, patient_diagnosis.remarks, patient_diagnosis.synch_in, patient_diagnosis.synch_out, patient_diagnosis.edit_remarks, patient_diagnosis.edit_staff, patient_diagnosis.edit_date, patient_diagnosis.delete_remarks, patient_diagnosis.delete_staff, patient_diagnosis.delete_date, patient_diagnosis.confirm_dcode1ext, patient_diagnosis.confirm_remarks, patient_diagnosis.confirm_staff, patient_diagnosis.confirm_date, patient_diagnosis.synch_remarks, patient_diagnosis.patient_diagnosis_1, dcode1ext.dcode1ext_longname, dcode1ext.dcode1ext_shortname, dcode1ext.chapter
   FROM patient_diagnosis
   JOIN dcode1ext ON patient_diagnosis.dcode1ext_code::text = dcode1ext.dcode1ext_code::text;
ALTER TABLE gem_report_diagnosis OWNER TO thirra;


ALTER TABLE patient_medication ALTER COLUMN instruction TYPE character varying(255);
COMMENT ON COLUMN patient_medication.instruction IS 'Altered for THIRRA July 7, 2011'; 


-- DROP TABLE prescript_abbr;
CREATE TABLE  prescript_abbr
(
  prescript_abbr_id character(10) NOT NULL,
  abbr_code character varying(50),
  abbr_type character varying(20),
  abbr_medical character varying(255),
  abbr_latin character varying(255),
  abbr_meaning character varying(255),
  abbr_sort integer,
  abbr_active boolean,
  abbr_remark character varying(255),
  prescript_abbr_1 character varying(255),
  CONSTRAINT prescript_abbr_pkey PRIMARY KEY (prescript_abbr_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE prescript_abbr OWNER TO thirra;
COMMENT ON TABLE prescript_abbr IS 'THIRRA July 7, 11';


ALTER TABLE prescript_queue ALTER COLUMN instruction TYPE character varying(255);
ALTER TABLE prescript_queue ALTER COLUMN indication TYPE character varying(255);
ALTER TABLE prescript_queue ALTER COLUMN caution TYPE character varying(255);
ALTER TABLE prescript_queue RENAME COLUMN prescript_queue_1 TO drug_code_id;
ALTER TABLE prescript_queue ADD COLUMN prescript_queue_1 character varying(255);
COMMENT ON COLUMN prescript_queue.instruction IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN prescript_queue.indication IS 'Altered for THIRRA July 7, 2011'; 
COMMENT ON COLUMN prescript_queue.caution IS 'Altered for THIRRA July 7, 2011'; 


ALTER TABLE procedure ADD COLUMN procedure_name character varying(50);
ALTER TABLE procedure ADD COLUMN procedure_remarks character varying(255);
ALTER TABLE procedure ADD COLUMN added_remarks character varying(255);
ALTER TABLE procedure ADD COLUMN added_staff character(10);
ALTER TABLE procedure ADD COLUMN added_date date;
ALTER TABLE procedure ADD COLUMN procedure_1 character varying(255);
COMMENT ON COLUMN procedure.procedure_name IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN procedure.procedure_remarks IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN procedure.added_remarks IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN procedure.added_staff IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN procedure.added_date IS 'THIRRA July 7, 2011'; 


ALTER TABLE system_user DROP COLUMN system_user_1; 
ALTER TABLE system_user DROP COLUMN synch_remarks; 
ALTER TABLE system_user DROP COLUMN synch_out; 
ALTER TABLE system_user DROP COLUMN synch_in; 
ALTER TABLE system_user ADD COLUMN user_font character varying(20); 
ALTER TABLE system_user ADD COLUMN synch_in character varying(10); 
ALTER TABLE system_user ADD COLUMN synch_out character varying(10); 
ALTER TABLE system_user ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE system_user ADD COLUMN system_user_1 character varying(255); 
COMMENT ON COLUMN system_user.user_font IS 'THIRRA July 7, 2011'; 
COMMENT ON COLUMN system_user.synch_in IS 'THIRRA January 31, 2011'; 
COMMENT ON COLUMN system_user.synch_out IS 'THIRRA January 31, 2011'; 
COMMENT ON COLUMN system_user.synch_remarks IS 'THIRRA January 31, 2011'; 


-- End of Build 201 modifications 


-- Build 203 onwards 

ALTER TABLE drug_package_content DROP COLUMN package_content_1;
ALTER TABLE drug_package_content ADD COLUMN dose_duration numeric(5,2);
ALTER TABLE drug_package_content ADD COLUMN package_content_1 character varying(255);
COMMENT ON COLUMN drug_package_content.dose_duration IS 'THIRRA July 12, 2011'; 


ALTER TABLE patient_medication ALTER COLUMN instruction TYPE character varying(255);
ALTER TABLE patient_medication DROP COLUMN patient_medication_1;
ALTER TABLE patient_medication DROP COLUMN drug_tradename;
ALTER TABLE patient_medication DROP COLUMN generic_drugname;
ALTER TABLE patient_medication ADD COLUMN dose_duration numeric(5,2);
ALTER TABLE patient_medication ADD COLUMN generic_drugname character varying(255);
ALTER TABLE patient_medication ADD COLUMN drug_tradename character varying(255);
ALTER TABLE patient_medication ADD COLUMN patient_medication_1 character varying(255);
COMMENT ON COLUMN patient_medication.instruction IS 'Altered for THIRRA July 16, 2011'; 
COMMENT ON COLUMN patient_medication.dose_duration IS 'THIRRA July 16, 2011'; 
COMMENT ON COLUMN patient_medication.generic_drugname IS 'THIRRA January 28, 2011'; 
COMMENT ON COLUMN patient_medication.drug_tradename IS 'THIRRA January 28, 2011'; 


-- End of Build 203 modifications 


-- Build 208 onwards 


ALTER TABLE drug_package DROP CONSTRAINT drug_package_u_1;
ALTER TABLE drug_package ADD CONSTRAINT drug_package_uk_2 UNIQUE (location_id, package_name);


-- End of Build 208 modifications 


-- Build 230 onwards 


DROP TABLE IF EXISTS patient_referral_in; 
CREATE TABLE  patient_referral_in 
( 
  referral_in_id character(10) NOT NULL, 
  referin_staging_id character(10) NOT NULL, 
  referral_filename character varying(255), 
  staged_time character(10), 
  staged_by character(10), 
  staged_reference character varying(50), 
  staged_sequence int4, 
  import_time character(10), 
  import_by character(10), 
  import_reference character varying(50), 
  import_sequence int4, 
  refer_clinicname character varying(100), 
  refer_clinicid character varying(10), 
  refer_clinicref character varying(50), 
  refer_person character varying(50), 
  refer_position character varying(50), 
  refer_department character varying(50), 
  refer_specialty character varying(50), 
  refer_staffno character varying(20), 
  refer_reference character varying(50), 
  refer_remarks text, 
  import_remarks text, 
  patient_id character varying(26), 
  patient_id_refer character varying(26), 
  patient_reference character varying(50), 
  patient_pns_id character varying(50), 
  patient_nhfa character varying(50), 
  patient_name character varying(100), 
  patient_name_first character varying(100), 
  patient_gender character(6), 
  patient_icno character varying(20), 
  patient_icother_type character varying(50), 
  patient_icother_no character varying(50), 
  patient_nationality character varying(100), 
  patient_birthdate date, 
  patient_ethnicity character varying(50), 
  patient_religion character varying(50), 
  patient_marital_status character varying(20), 
  patient_blood_group character varying(2), 
  patient_blood_rhesus character varying(10), 
  patient_refer_contact character varying(10), 
  patient_address character varying(255), 
  patient_address2 character varying(255), 
  patient_address3 character varying(255), 
  patient_town character varying(50), 
  patient_state character varying(50), 
  patient_postcode character varying(20), 
  patient_country character varying(50), 
  patient_tel_home character varying(20), 
  patient_tel_office character varying(20), 
  patient_tel_mobile character varying(20), 
  patient_faxno character varying(20), 
  patient_email character varying(50), 
  patient_other character varying(255), 
  synch_in character varying(10), 
  synch_out character varying(10), 
  synch_remarks character varying(255), 
  patient_referral_in_1 character varying(255), 
  CONSTRAINT patient_referral_in_pkey PRIMARY KEY (referral_in_id)
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE patient_referral_in OWNER TO thirra; 
COMMENT ON TABLE patient_referral_in IS 'Added on October 25, 2011'; 


DROP TABLE IF EXISTS patient_referral_in_consult;
CREATE TABLE patient_referral_in_consult
(
  referin_consult_id character(10) NOT NULL,
  session_ref character varying(50),
  session_sequence integer,
  external_ref character varying(50),
  session_type character varying(20),
  patient_id character(26) NOT NULL,
  staff_id character varying(100),
  date_started date, -- Added on Dec 15, 06
  time_started time without time zone,
  date_ended date, -- Added on Dec 15, 06
  time_ended time without time zone,
  signed_by character varying(100),
  location_start character varying(255),
  location_end character varying(255),
  summary text,
  status smallint,
  remarks text, -- Added on April 1, 2008
  synch_start character varying(10), 
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  postcon_annotate text,
  annotate_by character varying(10),
  annotate_time character varying(10),
  patient_referral_in_consult_1 character varying(255),
  CONSTRAINT patient_referral_in_consult_pkey PRIMARY KEY (referin_consult_id)
) 
WITH OIDS;
ALTER TABLE patient_referral_in_consult OWNER TO thirra;
COMMENT ON TABLE patient_referral_in_consult IS 'Added on October 25, 2011'; 


DROP TABLE IF EXISTS patient_referral_in_detail; 
CREATE TABLE  patient_referral_in_detail 
( 
  referin_detail_id character(10) NOT NULL, 
  referin_consult_id character(10) NOT NULL, 
  attach_section character varying(50) NOT NULL, 
  attach_sort int2, 
  attach_table character varying(50), 
  attach_pkey character varying(30), 
  attach_session_id character varying(10), 
  attach_var01 character varying(50), 
  attach_info01 character varying(255), 
  attach_var02 character varying(50), 
  attach_info02 character varying(255), 
  attach_var03 character varying(50), 
  attach_info03 character varying(255), 
  attach_var04 character varying(50), 
  attach_info04 character varying(255), 
  attach_var05 character varying(50), 
  attach_info05 character varying(255), 
  attach_var06 character varying(50), 
  attach_info06 character varying(255), 
  attach_var07 character varying(50), 
  attach_info07 character varying(255), 
  attach_var08 character varying(50), 
  attach_info08 character varying(255), 
  attach_var09 character varying(50), 
  attach_info09 character varying(255), 
  attach_var10 character varying(50), 
  attach_info10 character varying(255), 
  attach_note text, 
  attach_remarks character varying(255), 
  synch_in character varying(10), 
  synch_out character varying(10), 
  synch_remarks character varying(255), 
  patient_referral_in_detail_1 character varying(255), 
  CONSTRAINT patient_referral_in_detail_pkey PRIMARY KEY (referin_detail_id), 
  CONSTRAINT patient_referral_in_detail_fk1 FOREIGN KEY (referin_consult_id) 
      REFERENCES patient_referral_in_consult (referin_consult_id) MATCH SIMPLE 
      ON UPDATE CASCADE ON DELETE RESTRICT 
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE patient_referral_in_detail OWNER TO thirra; 
COMMENT ON TABLE patient_referral_in_detail IS 'Added on October 25, 2011'; 


DROP TABLE IF EXISTS patient_referral_in_staging; 
CREATE TABLE  patient_referral_in_staging 
( 
  referin_staging_id character(10) NOT NULL, 
  referin_filename character varying(255), 
  staged_time character(10), 
  staged_by character(10), 
  staged_reference character varying(50), 
  staged_sequence int4, 
  import_time character(10), 
  import_by character(10), 
  import_reference character varying(50), 
  import_sequence int4, 
  referral_in_id character(10), 
  refer_version character varying(50), 
  refer_to_person character varying(50), 
  refer_to_department character varying(50), 
  refer_to_specialty character varying(50), 
  refer_clinicname character varying(100), 
  refer_clinicid character varying(10), 
  refer_clinicref character varying(50), 
  refer_by_person character varying(50), 
  refer_by_position character varying(50), 
  refer_by_department character varying(50), 
  refer_by_specialty character varying(50), 
  refer_staffno character varying(20), 
  refer_reference character varying(50), 
  refer_reason text, 
  refer_clinical_exam text, 
  refer_remarks text, 
  import_remarks text, 
  patient_id character varying(26), 
  patient_id_refer character varying(26), 
  patient_reference character varying(50), 
  patient_pns_id character varying(50), 
  patient_nhfa character varying(50), 
  patient_name character varying(100), 
  patient_name_first character varying(100), 
  patient_gender character(6), 
  patient_icno character varying(20), 
  patient_icother_type character varying(50), 
  patient_icother_no character varying(50), 
  patient_birthdate date, 
  xmlin_string text,
  xmlin_mdhash character varying(255),
  synch_in character varying(10), 
  synch_out character varying(10), 
  synch_remarks character varying(255), 
  patient_referral_in_staging_1 character varying(255), 
  CONSTRAINT patient_referral_in_staging_pkey PRIMARY KEY (referin_staging_id)
) 
WITH ( 
  OIDS=TRUE 
); 
ALTER TABLE patient_referral_in_staging OWNER TO thirra; 
COMMENT ON TABLE patient_referral_in_staging IS 'Added on October 25, 2011'; 


DROP TABLE IF EXISTS patient_referral_replyout;
CREATE TABLE patient_referral_replyout
(
  refer_replyout_id character(10) NOT NULL,
  referral_in_id character(10) NOT NULL,
  referin_staging_id character(10) NOT NULL,
  reply_sequence int4, 
  reply_reference character varying(50),
  reply_when character(10),
  replying_doctor character varying(100),
  reply_department character varying(100),
  reply_findings text,
  reply_investigation text,
  reply_diagnosis text,
  reply_treatment text,
  reply_plan text,
  reply_comments text,
  reply_remarks text,
  reply_staff_id character(10),
  xmlout_string text,
  xmlout_mdhash character varying(255),
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_referral_replyout_1 character varying(255),
  CONSTRAINT patient_referral_replyout_pkey PRIMARY KEY (refer_replyout_id),
  CONSTRAINT patient_referral_replyout_fk1 FOREIGN KEY (referral_in_id)
      REFERENCES patient_referral_in (referral_in_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
) 
WITH OIDS;
ALTER TABLE patient_referral_replyout OWNER TO thirra;
COMMENT ON TABLE patient_referral_replyout IS 'Added on October 25, 2011'; 


-- End of Build 230 modifications 


-- Build 242 onwards 


ALTER TABLE billing_descr DROP COLUMN billing_descr_1; 
ALTER TABLE billing_descr DROP COLUMN added_date; 
ALTER TABLE billing_descr DROP COLUMN added_staff; 
ALTER TABLE billing_descr DROP COLUMN added_remarks; 
ALTER TABLE billing_descr ADD COLUMN default_value1 numeric(7,2); 
ALTER TABLE billing_descr ADD COLUMN default_value2 numeric(7,2); 
ALTER TABLE billing_descr ADD COLUMN default_value3 numeric(7,2); 
ALTER TABLE billing_descr ADD COLUMN added_remarks character varying(255); 
ALTER TABLE billing_descr ADD COLUMN added_staff character(10); 
ALTER TABLE billing_descr ADD COLUMN added_date character(10); 
ALTER TABLE billing_descr ADD COLUMN billing_descr_1 character varying(255); 
COMMENT ON COLUMN billing_descr.default_value1 IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN billing_descr.default_value2 IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN billing_descr.default_value3 IS 'THIRRA February 24, 2012'; 


DROP TABLE IF EXISTS booking_reminder;
CREATE TABLE booking_reminder
(
  booking_reminder_id character(10) NOT NULL,
  booking_id character(10) NOT NULL,
  remind_timestamp character(10),
  remind_method character varying(20),
  remind_note character varying(255),
  remind_remarks character varying(255),
  remind_done character(10),
  reminded_by character(10),
  canceled_reason character varying(255),
  booking_reminder_1 character varying(255),
  CONSTRAINT booking_reminder_pkey PRIMARY KEY (booking_reminder_id)
) 
WITH OIDS;
ALTER TABLE booking_reminder OWNER TO thirra;
COMMENT ON TABLE booking_reminder IS 'Added on February 24, 2012'; 


ALTER TABLE clinic_info DROP COLUMN clinic_info_1; 
ALTER TABLE clinic_info ADD COLUMN nhfa_no character varying(50); 
ALTER TABLE clinic_info ADD COLUMN clinic_url character varying(255); 
ALTER TABLE clinic_info ADD COLUMN clinic_info_1 character varying(255); 
COMMENT ON COLUMN clinic_info.nhfa_no IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN clinic_info.clinic_url IS 'THIRRA February 24, 2012'; 
ALTER TABLE clinic_info ADD CONSTRAINT clinic_info_u_1 UNIQUE (clinic_name);
ALTER TABLE clinic_info ADD CONSTRAINT clinic_info_u_2 UNIQUE (clinic_shortname);

ALTER TABLE patient_referral DROP COLUMN patient_referral_1; 
ALTER TABLE patient_referral DROP COLUMN synch_remarks; 
ALTER TABLE patient_referral DROP COLUMN synch_out; 
ALTER TABLE patient_referral DROP COLUMN synch_in; 
ALTER TABLE patient_referral ADD COLUMN date_reviewed character(10); 
ALTER TABLE patient_referral ADD COLUMN transport_mode character varying(255); 
ALTER TABLE patient_referral ADD COLUMN referral_type character varying(50); 
ALTER TABLE patient_referral ADD COLUMN synch_in character varying(255); 
ALTER TABLE patient_referral ADD COLUMN synch_out character varying(255); 
ALTER TABLE patient_referral ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE patient_referral ADD COLUMN patient_referral_1 character varying(255); 
COMMENT ON COLUMN patient_referral.date_reviewed IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN patient_referral.transport_mode IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN patient_referral.referral_type IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN patient_referral.synch_in IS 'THIRRA September 18, 2007'; 
COMMENT ON COLUMN patient_referral.synch_out IS 'THIRRA September 18, 2007'; 
COMMENT ON COLUMN patient_referral.synch_remarks IS 'THIRRA September 18, 2007'; 


DROP TABLE IF EXISTS patient_referral_replyout;
DROP TABLE IF EXISTS patient_referral_in_replyout;
CREATE TABLE patient_referral_in_replyout
(
  referin_replyout_id character(10) NOT NULL,
  referral_in_id character(10) NOT NULL,
  referin_staging_id character(10) NOT NULL,
  reply_sequence int4, 
  reply_reference character varying(50),
  reply_when character(10),
  replying_doctor character varying(100),
  reply_department character varying(100),
  reply_findings text,
  reply_investigation text,
  reply_diagnosis text,
  reply_treatment text,
  reply_plan text,
  reply_comments text,
  reply_remarks text,
  reply_staff_id character(10),
  xmlout_string text,
  xmlout_mdhash character varying(255),
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_referral_in_replyout_1 character varying(255),
  CONSTRAINT patient_referral_in_replyout_pkey PRIMARY KEY (referin_replyout_id),
  CONSTRAINT patient_referral_in_replyout_fk1 FOREIGN KEY (referral_in_id)
      REFERENCES patient_referral_in (referral_in_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
) 
WITH OIDS;
ALTER TABLE patient_referral_in_replyout OWNER TO thirra;
COMMENT ON TABLE patient_referral_in_replyout IS 'Added on February 24, 2012'; 


ALTER TABLE prescript_queue DROP COLUMN prescript_queue_1; 
ALTER TABLE prescript_queue ADD COLUMN refill_cycles smallint; 
ALTER TABLE prescript_queue ADD COLUMN refill_remarks character varying(255); 
ALTER TABLE prescript_queue ADD COLUMN prescript_queue_1 character varying(255); 
COMMENT ON COLUMN prescript_queue.refill_cycles IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN prescript_queue.refill_remarks IS 'THIRRA February 24, 2012'; 


ALTER TABLE referral_center DROP COLUMN referral_center_1; 
ALTER TABLE referral_center ADD COLUMN pns_entity_no character varying(50); 
ALTER TABLE referral_center ADD COLUMN clinic_info_id character(10); 
ALTER TABLE referral_center ADD COLUMN server_location character varying(50); 
ALTER TABLE referral_center ADD COLUMN referral_center_1 character varying(255); 
COMMENT ON COLUMN referral_center.pns_entity_no IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN referral_center.clinic_info_id IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN referral_center.server_location IS 'THIRRA February 24, 2012'; 


ALTER TABLE referral_doctor DROP COLUMN referral_doctor_1; 
ALTER TABLE referral_doctor ADD COLUMN doctor_dept character varying(255); 
ALTER TABLE referral_doctor ADD COLUMN referral_doctor_1 character varying(255); 
COMMENT ON COLUMN referral_doctor.doctor_dept IS 'THIRRA February 24, 2012'; 


DROP TABLE IF EXISTS sketch;
CREATE TABLE  sketch
(
  sketch_id character(10) NOT NULL,
  sketch_code character varying(50),
  template_name character varying(255) NOT NULL,
  template_description text,
  sketch_sort smallint,
  sketch_section character varying(50),
  sketch_sex character(1),
  sketch_age_morethan integer,
  sketch_age_lessthan integer,
  sketch_active boolean,
  sketch_remarks text,
  sketch_1 text,
  CONSTRAINT sketch_pkey PRIMARY KEY (sketch_id)
) 
WITH OIDS;
ALTER TABLE sketch OWNER TO thirra;
COMMENT ON TABLE sketch IS 'Added on February 24, 2012'; 


DROP TABLE IF EXISTS patient_sketch;
CREATE TABLE patient_sketch
(
  patient_sketch_id character(10) NOT NULL,
  sketch_id character(10) NOT NULL,
  summary_id character(10),
  patient_id character(26) NOT NULL,
  sketch_remarks text,
  staff_id character(10) NOT NULL,
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_sketch character varying(255),
  CONSTRAINT patient_sketch_pkey PRIMARY KEY (patient_sketch_id),
  CONSTRAINT patient_sketch_fk1 FOREIGN KEY (summary_id)
      REFERENCES patient_consultation_summary (summary_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT patient_sketch_fk2 FOREIGN KEY (patient_id)
      REFERENCES patient_demographic_info (patient_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT patient_sketch_fk3 FOREIGN KEY (sketch_id)
      REFERENCES sketch (sketch_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_sketch OWNER TO thirra;
COMMENT ON TABLE patient_sketch IS 'Added on February 24, 2012';


ALTER TABLE staff_info DROP COLUMN staff_info_1; 
ALTER TABLE staff_info DROP COLUMN synch_remarks; 
ALTER TABLE staff_info DROP COLUMN synch_out; 
ALTER TABLE staff_info DROP COLUMN synch_in; 
ALTER TABLE staff_info ADD COLUMN nhfa_no character varying(50); 
ALTER TABLE staff_info ADD COLUMN nhfa_remarks character varying(255); 
ALTER TABLE staff_info ADD COLUMN pns_user_no character varying(50); 
ALTER TABLE staff_info ADD COLUMN pns_user_remarks character varying(255); 
ALTER TABLE staff_info ADD COLUMN synch_in character varying(10); 
ALTER TABLE staff_info ADD COLUMN synch_out character varying(10); 
ALTER TABLE staff_info ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE staff_info ADD COLUMN staff_info_1 character varying(255); 
COMMENT ON COLUMN staff_info.nhfa_no IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN staff_info.nhfa_remarks IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN staff_info.pns_user_no IS 'THIRRA February 24, 2012';
COMMENT ON COLUMN staff_info.pns_user_remarks IS 'THIRRA February 24, 2012';
COMMENT ON COLUMN staff_info.synch_in IS 'THIRRA November 18, 2007';
COMMENT ON COLUMN staff_info.synch_out IS 'THIRRA November 18, 2007';
COMMENT ON COLUMN staff_info.synch_remarks IS 'THIRRA November 18, 2007';
ALTER TABLE staff_info DROP CONSTRAINT staff_info_u_1;
ALTER TABLE staff_info ADD CONSTRAINT staff_info_u_1 UNIQUE (staff_initials);


DROP TABLE IF EXISTS system_module;
CREATE TABLE system_module
(
  sysmodule_id character(10) NOT NULL,
  sysmodule_name character varying(100) NOT NULL,
  sysmodule_shortname character varying(100) NOT NULL,
  sysmodule_sort smallint,
  sysmodule_code character varying(50),
  sysmodule_description text,
  sysmodule_remarks text,
  sysmodule_version character varying(50),
  sysmodule_releasedate date,
  sysmodule_author character varying(255),
  system_module_1 character varying(255),
  CONSTRAINT system_module_pkey PRIMARY KEY (sysmodule_id)
) 
WITH OIDS;
ALTER TABLE system_module OWNER TO thirra;
COMMENT ON TABLE system_module IS 'Added on February 24, 2012'; 


DROP TABLE IF EXISTS system_section;
CREATE TABLE system_section
(
  syssection_id character(10) NOT NULL,
  sysmodule_id character(10) NOT NULL,
  syssection_name character varying(100) NOT NULL,
  syssection_code character varying(50),
  syssection_level character varying(100) NOT NULL,
  syssection_layout character varying(100) NOT NULL,
  syssection_link_text character varying(255),
  syssection_link_url character varying(255),
  syssection_description text,
  syssection_sort smallint,
  syssection_age_morethan integer,
  syssection_age_lessthan integer,
  syssection_sex character(1),
  syssection_active boolean,
  syssection_remarks text,
  system_section_1 character varying(255),
  CONSTRAINT system_section_pkey PRIMARY KEY (syssection_id),
  CONSTRAINT system_section_fk1 FOREIGN KEY (sysmodule_id)
      REFERENCES system_module (sysmodule_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT system_section_uk1 UNIQUE (sysmodule_id, syssection_name, syssection_level)) 
WITH OIDS;
ALTER TABLE system_section OWNER TO thirra;
COMMENT ON TABLE system_section IS 'Added on February 24, 2012'; 


DROP TABLE IF EXISTS system_acl;
CREATE TABLE system_acl
(
  acl_id character(10) NOT NULL,
  syssection_id character(10) NOT NULL,
  category_id character(10) NOT NULL,
  rights_single smallint,
  rights_multi smallint,
  acl_remarks character varying(255),
  added_remarks character varying(255),
  added_staff character varying(10),
  added_time character varying(10),
  edit_remarks character varying(255),
  edit_staff character varying(10),
  edit_time character varying(10),
  system_acl_1 character varying(255),
  CONSTRAINT system_acl_pkey PRIMARY KEY (acl_id),
  CONSTRAINT system_acl_fk1 FOREIGN KEY (syssection_id)
      REFERENCES system_section (syssection_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT system_acl_fk2 FOREIGN KEY (category_id)
      REFERENCES system_user_category (category_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT system_acl_uk1 UNIQUE (syssection_id, category_id)) 
WITH OIDS;
ALTER TABLE system_acl OWNER TO thirra;
COMMENT ON TABLE system_acl IS 'Added on February 24, 2012'; 


DROP TABLE IF EXISTS system_clinic_staff;
CREATE TABLE system_clinic_staff
(
  sysclinic_staff_id character(10) NOT NULL,
  clinic_info_id character(10) NOT NULL,
  staff_id character(10) NOT NULL,
  user_id character(10) NOT NULL,
  sysclinic_staff_active boolean,
  sysclinic_staff_remarks character varying(255),
  added_remarks character varying(255),
  added_staff character varying(10),
  added_time character varying(10),
  system_clinic_staff_1 character varying(255),
  CONSTRAINT system_clinic_staff_pkey PRIMARY KEY (sysclinic_staff_id),
  CONSTRAINT system_clinic_staff_fk1 FOREIGN KEY (clinic_info_id)
      REFERENCES clinic_info (clinic_info_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT system_clinic_staff_fk2 FOREIGN KEY (staff_id)
      REFERENCES staff_info (staff_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT system_clinic_staff_u_1 UNIQUE (clinic_info_id, staff_id)) 
WITH OIDS;
ALTER TABLE system_clinic_staff OWNER TO thirra;
COMMENT ON TABLE system_clinic_staff IS 'Added on February 24, 2012'; 


INSERT INTO system_clinic_staff SELECT suser.user_id,swrk.home_clinic,suser.staff_id,suser.user_id,TRUE,cinf.clinic_shortname,'Added during upgrade to Build 242.','1111647339','1329969941' FROM system_user suser, staff_info sinf, staff_work swrk, clinic_info cinf WHERE suser.staff_id=sinf.staff_id AND sinf.staff_id=swrk.staff_id AND swrk.home_clinic=cinf.clinic_info_id; 


INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000000','Core','Core',1000,'Core','Core module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000001','Patient','Patient',2000,'Patient','Core Patients module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000002','Pharmacy','Pharmacy',3000,'Pharmacy','Core Pharmacy module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000003','Orders','Orders',4000,'Orders','Core Orders module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000004','Queue','Queue',5000,'Queue','Core Queue module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000005','Reports','Reports',6000,'Reports','Core Reports module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000006','Utilities','Utilities',7000,'Utilities','Core Utilities module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000009','Admin','Admin',8000,'Admin','Core Admin module','Illustrate module','1.0','2012-01-03','PCDOM'); 
INSERT INTO system_module (sysmodule_id,sysmodule_name,sysmodule_shortname,sysmodule_sort,sysmodule_code,sysmodule_description,sysmodule_remarks,sysmodule_version, sysmodule_releasedate, sysmodule_author)  VALUES ('1000000101','Module A','ModuleA',11000,'ModA','Example module','External module','1.0','2012-01-03','PCDOM'); 


INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000001','1000000000','Core Section Panel','Sec1','ehr','panel','Panel A1',NULL,NULL, 0,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000002','1000000000','Core Section Widget','Sec2','ehr','widget','Widget A2',NULL,NULL, 0,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000003','1000000000','Core Section Side','Sec3','ehr','menu','Home','/ehr/ehr/index/ehr_dashboard/ehr_dashboard/index',NULL, 0,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000999','1000000000','Core Logout','Sec3','ehr','menu','Logout','/thirra/logout',NULL, 16000,1,43800,'B',TRUE,NULL); 
-- Core modules
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000004','1000000001','Core Patient Menu','Sec1','ehr','menu','Patient','/ehr/ehr/index/ehr_patients/ehr_patient/patients_mgt',NULL, 100,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000005','1000000002','Core Pharmacy Menu','Sec1','ehr','menu','Pharmacy','/ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/pharmacy_mgt',NULL, 200,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000006','1000000003','Core Orders Menu','Sec1','ehr','menu','Orders','/ehr/ehr/index/ehr_orders/ehr_orders/orders_mgt',NULL, 300,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000007','1000000004','Core Queue Menu','Sec1','ehr','menu','Queue','/ehr/ehr/index/ehr_queue/ehr_queue/queue_mgt',NULL, 400,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000008','1000000005','Core Reports Menu','Sec1','ehr','menu','Reports','/ehr/ehr/index/ehr_reports/ehr_reports/reports_mgt',NULL, 500,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000009','1000000006','Core Utilities Menu','Sec1','ehr','menu','Utilities','/ehr/ehr/index/ehr_utilities/ehr_utilities/utilities_mgt',NULL, 600,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1000000010','1000000009','Core Admin Menu','Sec1','ehr','menu','Admin','/ehr/ehr/index/ehr_admin/ehr_admin/admin_mgt',NULL, 900,1,43800,'B',TRUE,NULL); 
-- New modules
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000004','1000000101','ModA Panel 1','Sec1','ehr','panel','ModA Panel A1',NULL,NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000005','1000000101','ModA Widget1','Wid1','ehr','widget','ModA Widget A1','ehr_modulea/ehr_modulea_widgets/display_widget',NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000006','1000000101','ModA Section 3','Sec3','ehr','menu','ModA','/ehr/ehr/index/ehr_modulea/ehr_modulea/modulea_mgt',NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000007','1000000101','ModA Panel2','Sec1','ovv','panel','ModA Panel2',NULL,NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000008','1000000101','ModA Widget 2','Sec2','ovv','widget','ModA Widget2','indv_modulea/ehr_indv_modulea_widgets/display_widget',NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000009','1000000101','ModA Menu2','Sec3','ovv','menu','ModA Menu2','/indv/indv/index/indv_modulea/ehr_indv_modulea/list_history_antenatal/list_antenatal/',NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000010','1000000101','ModA Panel3','Sec1','con','panel','ModA Panel3',NULL,NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000011','1000000101','ModA Widget 3','Sec2','con','widget','ModA Widget3','cons_modulea/ehr_consult_modulea_widgets/display_widget',NULL, 1000,1,43800,'B',TRUE,NULL); 
INSERT INTO system_section (syssection_id,sysmodule_id,syssection_name,syssection_code,syssection_level,syssection_layout, syssection_link_text,syssection_link_url,syssection_description,syssection_sort,syssection_age_morethan, syssection_age_lessthan,syssection_sex,syssection_active,syssection_remarks)  VALUES ('1100000012','1000000101','ModA Menu3','Sec3','con','menu','ModA Menu3','/cons/cons/index/cons_modulea/ehr_consult_modulea/edit_lab/new_lab/',NULL, 1000,1,43800,'B',TRUE,NULL); 


-- ------

INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000001','1000000001','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000002','1000000002','1111605618',0,0,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000003','1000000003','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000999','1000000999','1111605618',15,15,'Added during upgrade to Build 242.'); 

INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000004','1000000004','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000005','1000000005','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000006','1000000006','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000007','1000000007','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000008','1000000008','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000009','1000000009','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1110000010','1000000010','1111605618',15,15,'Added during upgrade to Build 242.'); 

INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000004','1100000004','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000005','1100000005','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000006','1100000006','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000007','1100000007','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000008','1100000008','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000009','1100000009','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000010','1100000010','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000011','1100000011','1111605618',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1111000012','1100000012','1111605618',15,15,'Added during upgrade to Build 242.'); 


-- ------

INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000001','1000000001','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000002','1000000002','1111605589',0,0,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000003','1000000003','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000999','1000000999','1111605589',15,15,'Added during upgrade to Build 242.'); 

INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000004','1000000004','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000005','1000000005','1111605589',0,0,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000006','1000000006','1111605589',0,0,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000007','1000000007','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000008','1000000008','1111605589',0,0,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000009','1000000009','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1210000010','1000000010','1111605589',0,0,'Added during upgrade to Build 242.'); 

INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000004','1100000004','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000005','1100000005','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000006','1100000006','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000007','1100000007','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000008','1100000008','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000009','1100000009','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000010','1100000010','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000011','1100000011','1111605589',15,15,'Added during upgrade to Build 242.'); 
INSERT INTO system_acl (acl_id,syssection_id,category_id,rights_single,rights_multi,acl_remarks)  VALUES ('1211000012','1100000012','1111605589',15,15,'Added during upgrade to Build 242.'); 

-- End of Build 242 modifications 


-- Build 244 onwards 


ALTER TABLE billing_descr ALTER COLUMN billing_show TYPE character varying(15);
ALTER TABLE billing_descr DROP COLUMN billing_descr_1; 
ALTER TABLE billing_descr DROP COLUMN added_date; 
ALTER TABLE billing_descr DROP COLUMN added_staff; 
ALTER TABLE billing_descr DROP COLUMN added_remarks; 
ALTER TABLE billing_descr ADD COLUMN billable_table character varying(50); 
ALTER TABLE billing_descr ADD COLUMN billable_field character varying(50); 
ALTER TABLE billing_descr ADD COLUMN billable_join text; 
ALTER TABLE billing_descr ADD COLUMN billable_rate character varying(50); 
ALTER TABLE billing_descr ADD COLUMN billable_qty character varying(50); 
ALTER TABLE billing_descr ADD COLUMN billable_product character varying(50); 
ALTER TABLE billing_descr ADD COLUMN billable_etc text; 
ALTER TABLE billing_descr ADD COLUMN added_remarks character varying(255); 
ALTER TABLE billing_descr ADD COLUMN added_staff character(10); 
ALTER TABLE billing_descr ADD COLUMN added_date character(10); 
ALTER TABLE billing_descr ADD COLUMN billing_descr_1 character varying(255); 
COMMENT ON COLUMN billing_descr.billable_table IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.billable_field IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.billable_join IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.billable_rate IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.billable_qty IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.billable_product IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.billable_etc IS 'THIRRA February 29, 2012'; 
COMMENT ON COLUMN billing_descr.added_remarks IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN billing_descr.added_staff IS 'THIRRA February 24, 2012'; 
COMMENT ON COLUMN billing_descr.added_date IS 'THIRRA February 24, 2012'; 


ALTER TABLE booking DROP COLUMN booking_id_1; 
ALTER TABLE booking ADD COLUMN queue_ticket smallint; 
ALTER TABLE booking ADD COLUMN booking_1 character varying(255); 
COMMENT ON COLUMN booking.queue_ticket IS 'THIRRA February 29, 2012'; 


ALTER TABLE dispense_queue DROP COLUMN dispense_queue_1; 
ALTER TABLE dispense_queue ADD COLUMN drug_formulary_id character(10); 
ALTER TABLE dispense_queue ADD COLUMN dispense_queue_1 character varying(255); 
COMMENT ON COLUMN dispense_queue.drug_formulary_id IS 'THIRRA February 29, 2012'; 


ALTER TABLE system_user_category DROP COLUMN system_category_1; 
ALTER TABLE system_user_category ADD COLUMN can_consult smallint; 
ALTER TABLE system_user_category ADD COLUMN system_user_category_1 character varying(255); 
COMMENT ON COLUMN system_user_category.can_consult IS 'THIRRA February 29, 2012'; 


DROP TABLE IF EXISTS booking_status;
CREATE TABLE  booking_status
(
  booking_status_id character(10) NOT NULL,
  clinic_info_id character(10) NOT NULL,
  status_series smallint,
  status_digits smallint,
  status_description character varying(255),
  status_remarks character varying(255),
  reminder_times smallint,
  reminder_intervals smallint,
  booking_id character(10),
  queue_active boolean,
  ticket_current character varying(10),
  status_date date,
  ticket_last_issued character varying(10),
  booking_status_1 character varying(255),
  CONSTRAINT booking_status_pkey PRIMARY KEY (booking_status_id),
  CONSTRAINT booking_status_fk1 FOREIGN KEY (clinic_info_id)
      REFERENCES clinic_info (clinic_info_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT booking_status_fk2 FOREIGN KEY (booking_id)
      REFERENCES booking (booking_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT booking_status_u_1 UNIQUE (clinic_info_id, status_series,status_digits)) 
WITH OIDS;
ALTER TABLE booking_status OWNER TO thirra;
COMMENT ON TABLE booking_status IS 'Added on February 29, 2012'; 


DROP TABLE IF EXISTS booking_ticket;
CREATE TABLE  booking_ticket
(
  booking_ticket_id character(10) NOT NULL,
  booking_id character(10) NOT NULL,
  booking_status_id character(10) NOT NULL,
  clinic_info_id character(10) NOT NULL,
  ticket_number character varying(10),
  queue_date date,
  timestamp_issued character(10),
  issued_by character(10),
  timestamp_exec character(10),
  cancelled_reason character varying(255),
  cancelled_staff character(10),
  ticket_remarks character varying(255),
  booking_ticket_1 character varying(255),
  CONSTRAINT booking_ticket_pkey PRIMARY KEY (booking_ticket_id),
  CONSTRAINT booking_ticket_fk1 FOREIGN KEY (clinic_info_id)
      REFERENCES clinic_info (clinic_info_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT booking_ticket_fk2 FOREIGN KEY (booking_id)
      REFERENCES booking (booking_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT booking_ticket_u_1 UNIQUE (clinic_info_id, queue_date,ticket_number)) 
WITH OIDS;
ALTER TABLE booking_ticket OWNER TO thirra;
COMMENT ON TABLE booking_ticket IS 'Added on February 29, 2012'; 


UPDATE drug_product SET location_id = '1143691352';
ALTER TABLE drug_product ALTER COLUMN commonly_used TYPE smallint;


UPDATE "system_user_category" SET "can_consult" = 100 WHERE "category_name" = 'Doctor';
UPDATE "system_user_category" SET "can_consult" = 100 WHERE "category_name" = 'OwnerDoctor';
UPDATE "system_user_category" SET "can_consult" = 100 WHERE "category_name" = 'Doctor-Assistant';
UPDATE "system_user_category" SET "can_consult" = 100 WHERE "category_name" = 'Nurse-Practitioner';

-- End of Build 244 modifications 


-- Build 245 onwards 

ALTER TABLE patient_employment DROP COLUMN patient_employment_1; 
ALTER TABLE patient_employment ADD COLUMN entity_patient_id character(10); 
ALTER TABLE patient_employment ADD COLUMN patient_employment_1 character varying(255); 
COMMENT ON COLUMN patient_employment.entity_patient_id IS 'THIRRA March 2, 2012'; 

-- End of Build 245 modifications 


-- Build 248 onwards 

DROP TABLE IF EXISTS entity_patient_relation;
DROP TABLE IF EXISTS entity_clinic_relation;
DROP TABLE IF EXISTS entity_contact_info;
DROP TABLE IF EXISTS entity_info;
CREATE TABLE entity_info
(
  entity_info_id character varying(10) NOT NULL,
  entity_name character varying(200) NOT NULL,
  entity_shortname character varying(100) NOT NULL,
  entity_code character varying(50),
  entity_statutory character varying(50),
  entity_sort smallint,
  entity_industry character varying(255),
  entity_remarks character varying(255),
  is_panel boolean,
  is_mco boolean,
  is_mco_client boolean,
  is_insurer boolean,
  is_insurer_client boolean,
  pcdom_reference character varying(50),
  nhfa_reference character varying(50),
  entity_info_1 character varying(255),
  CONSTRAINT entity_info_pkey PRIMARY KEY (entity_info_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE entity_info OWNER TO thirra;
COMMENT ON TABLE entity_info IS 'Added on March 23, 2012'; 


CREATE TABLE entity_contact_info
(
  entity_contact_id character varying(10) NOT NULL,
  entity_info_id character(10) NOT NULL, 
  contact_active boolean,
  contact_type character varying(50),
  contact_start date,
  contact_stop date,
  address_1 character varying(255),
  address_2 character varying(255),
  address_3 character varying(255),
  town character varying(50),
  state character varying(50),
  postcode character varying(20),
  country character varying(50),
  tel_office1 character varying(50),
  tel_office2 character varying(50),
  tel_office3 character varying(50),
  pager_no character varying(30),
  fax_no1 character varying(50),
  fax_no2 character varying(50),
  email character varying(50),
  other character varying(255),
  addr_village_id character(10), 
  addr_town_id character varying(10), 
  addr_area_id character(10), 
  contact_person character varying(255),
  contact_remarks character varying(255),
  entity_contact_info_1 character varying(255),
  CONSTRAINT entity_contact_info_pkey PRIMARY KEY (entity_contact_id),
  CONSTRAINT entity_contact_info_fk1 FOREIGN KEY (entity_info_id)
      REFERENCES entity_info (entity_info_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE entity_contact_info OWNER TO thirra;
COMMENT ON TABLE entity_contact_info IS 'Added on March 23, 2012'; 


CREATE TABLE entity_clinic_relation
(
  entity_clinic_id character(10) NOT NULL,
  clinic_info_id character(10) NOT NULL,
  entity_info_id character(10) NOT NULL,
  relation_clinic_reference character varying(50),
  relation_entity_reference character varying(50),
  entity_clinic_sort smallint,
  entity_type character varying(20), -- Panel | MCO
  account_id character varying(50),
  credit_term smallint,
  credit_limit numeric(11,2),
  relation_start date,
  relation_stop date,
  relation_active boolean,
  markup_tier smallint, -- Tier 1 to 3
  contact_person character varying(50),
  contact_tel character varying(50),
  contact_fax character varying(50),
  relation_description character varying(255),
  clinic_relation_notes text,
  relation_remarks character varying(255),
  entity_clinic_relation_1 character varying(255),
  CONSTRAINT entity_clinic_relation_pkey PRIMARY KEY (entity_clinic_id),
  CONSTRAINT entity_clinic_relation_fk1 FOREIGN KEY (clinic_info_id)
      REFERENCES clinic_info (clinic_info_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT,
  CONSTRAINT entity_clinic_relation_fk2 FOREIGN KEY (entity_info_id)
      REFERENCES entity_info (entity_info_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT,
  CONSTRAINT entity_clinic_relation_u_1 UNIQUE (clinic_info_id,entity_info_id, entity_type)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE entity_clinic_relation OWNER TO thirra;
COMMENT ON TABLE entity_clinic_relation IS 'Added on March 23, 2012'; 


CREATE TABLE entity_patient_relation
(
  entity_patient_id character(10) NOT NULL,
  patient_id character(26) NOT NULL,
  entity_clinic_id character(10) NOT NULL,
  entity_info_id character(10) NOT NULL,
  entity_type character varying(20), -- Panel | MCO
  relation_type character varying(20), -- Client | Employee | Dependent
  relation_start date,
  relation_stop date,
  relation_reference character varying(50),
  relation_description character varying(255),
  patient_relation_notes text,
  job_position character varying(100),
  job_industry character varying(255),
  job_function text,
  relation_remarks character varying(255),
  added_remarks character varying(255),
  added_staff character varying(10),
  added_timestamp character varying(10),
  edit_remarks character varying(255),
  edit_staff character varying(10),
  edit_timestamp character varying(10),
  delete_remarks character varying(255),
  delete_staff character varying(10),
  delete_timestamp character varying(10),
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  entity_patient_relation_1 character varying(255),
  CONSTRAINT entity_patient_relation_pkey PRIMARY KEY (entity_patient_id),
  CONSTRAINT entity_patient_relation_fk1 FOREIGN KEY (patient_id)
      REFERENCES patient_demographic_info (patient_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT,
  CONSTRAINT entity_patient_relation_fk2 FOREIGN KEY (entity_clinic_id)
      REFERENCES entity_clinic_relation (entity_clinic_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE RESTRICT,
  CONSTRAINT entity_patient_relation_u_1 UNIQUE (patient_id, entity_clinic_id))
WITH (
  OIDS=TRUE
);
ALTER TABLE entity_patient_relation OWNER TO thirra;
COMMENT ON TABLE entity_patient_relation IS 'Added on March 23, 2012'; 


ALTER TABLE clinic_info DROP COLUMN clinic_info_1; 
ALTER TABLE clinic_info ADD COLUMN refresh_rate smallint; 
ALTER TABLE clinic_info ADD COLUMN clinic_info_1 character varying(255); 
COMMENT ON COLUMN clinic_info.refresh_rate IS 'THIRRA March 23, 2012'; 


ALTER TABLE cpg ADD COLUMN dcode1_id character varying(10); 
ALTER TABLE cpg ADD COLUMN dcode1ext_id character varying(10); 
ALTER TABLE cpg ADD COLUMN ccode1ext_code character varying(10); 
ALTER TABLE cpg ADD COLUMN cpg_remarks character varying(255); 
ALTER TABLE cpg ADD COLUMN cpg_1 character varying(255); 
COMMENT ON COLUMN cpg.dcode1_id IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN cpg.dcode1ext_id IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN cpg.ccode1ext_code IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN cpg.cpg_remarks IS 'THIRRA March 23, 2012'; 


ALTER TABLE health_department DROP COLUMN health_department_1; 
ALTER TABLE health_department ADD COLUMN addr_area_id character varying(10); 
ALTER TABLE health_department ADD COLUMN addr_district_id character varying(10); 
ALTER TABLE health_department ADD COLUMN health_department_1 character varying(255); 
COMMENT ON COLUMN health_department.addr_area_id IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN health_department.addr_district_id IS 'THIRRA March 23, 2012'; 


ALTER TABLE patient_consultation_summary DROP COLUMN patient_consultation_1; 
ALTER TABLE patient_consultation_summary ADD COLUMN note_subjective text; 
ALTER TABLE patient_consultation_summary ADD COLUMN note_objective text; 
ALTER TABLE patient_consultation_summary ADD COLUMN note_assessment text; 
ALTER TABLE patient_consultation_summary ADD COLUMN note_plan text; 
ALTER TABLE patient_consultation_summary ADD COLUMN patient_consultation_1 character varying(255); 
COMMENT ON COLUMN patient_consultation_summary.note_subjective IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN patient_consultation_summary.note_objective IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN patient_consultation_summary.note_assessment IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN patient_consultation_summary.note_plan IS 'THIRRA March 23, 2012'; 


ALTER TABLE patient_demographic_info DROP COLUMN patient_demographic_info_2; 
ALTER TABLE patient_demographic_info DROP COLUMN patient_demographic_info_1; 
ALTER TABLE patient_demographic_info ADD COLUMN guardian_id character varying(26); 
ALTER TABLE patient_demographic_info ADD COLUMN patient_demographic_info_1 character varying(255); 
ALTER TABLE patient_demographic_info ADD COLUMN patient_demographic_info_2 character varying(255); 
COMMENT ON COLUMN patient_demographic_info.guardian_id IS 'THIRRA March 23, 2012'; 


ALTER TABLE patient_disease_notification DROP COLUMN patient_disease_notification_1; 
ALTER TABLE patient_disease_notification DROP COLUMN synch_remarks; 
ALTER TABLE patient_disease_notification DROP COLUMN synch_out; 
ALTER TABLE patient_disease_notification DROP COLUMN synch_in; 
ALTER TABLE patient_disease_notification DROP COLUMN edit_date; 
ALTER TABLE patient_disease_notification DROP COLUMN edit_staff; 
ALTER TABLE patient_disease_notification DROP COLUMN edit_remarks; 
ALTER TABLE patient_disease_notification ADD COLUMN health_department_id character varying(10); 
ALTER TABLE patient_disease_notification ADD COLUMN notify_follow_up text; 
ALTER TABLE patient_disease_notification ADD COLUMN edit_remarks character varying(255); 
ALTER TABLE patient_disease_notification ADD COLUMN edit_staff character varying(10); 
ALTER TABLE patient_disease_notification ADD COLUMN edit_date character varying(10); 
ALTER TABLE patient_disease_notification ADD COLUMN synch_in character varying(10); 
ALTER TABLE patient_disease_notification ADD COLUMN synch_out character varying(10); 
ALTER TABLE patient_disease_notification ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE patient_disease_notification ADD COLUMN patient_disease_notification_1 character varying(255); 
COMMENT ON COLUMN patient_disease_notification.health_department_id IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN patient_disease_notification.notify_follow_up IS 'THIRRA March 23, 2012'; 


ALTER TABLE patient_medical_leave DROP COLUMN patient_medical_leave_1; 
ALTER TABLE patient_medical_leave DROP COLUMN synch_remarks; 
ALTER TABLE patient_medical_leave DROP COLUMN synch_out; 
ALTER TABLE patient_medical_leave DROP COLUMN synch_in; 
ALTER TABLE patient_medical_leave ADD COLUMN time_in time; 
ALTER TABLE patient_medical_leave ADD COLUMN time_out time; 
ALTER TABLE patient_medical_leave ADD COLUMN synch_in character varying(10); 
ALTER TABLE patient_medical_leave ADD COLUMN synch_out character varying(10); 
ALTER TABLE patient_medical_leave ADD COLUMN synch_remarks character varying(255); 
ALTER TABLE patient_medical_leave ADD COLUMN patient_medical_leave_1 character varying(255); 
COMMENT ON COLUMN patient_medical_leave.time_in IS 'THIRRA March 23, 2012'; 
COMMENT ON COLUMN patient_medical_leave.time_out IS 'THIRRA March 23, 2012'; 


DROP TABLE IF EXISTS patient_past_procedure;
CREATE TABLE patient_past_procedure
(
  past_procedure_id character varying(20) NOT NULL,
  staff_id character(10) NOT NULL,
  patient_id character(26) NOT NULL,
  --procedure_id character(10) NOT NULL,
  procedure_date date,
  date_precision character varying(10), 	-- Y M D N one
  procedure_notes text,
  pcode1ext_id character(10),
  pcode1ext_code character varying(50) NOT NULL,
  order_id character(10),
  product_id character(10),
  procedure_remarks text,
  procedure_place character varying(255),
  procedure_outcome text, -- THIRRA March 23, 2012
  outcome_remarks character varying(255), -- THIRRA March 23, 2012
  outcome_staff character varying(10), -- THIRRA March 23, 2012
  outcome_date date, -- THIRRA March 23, 2012
  added_remarks character varying(255),
  added_staff character varying(10),
  added_date character varying(10),
  edit_remarks character varying(255),
  edit_staff character varying(10),
  edit_date character varying(10),
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  patient_past_procedure_1 character varying(255),
  CONSTRAINT patient_past_procedure_pkey PRIMARY KEY (past_procedure_id),
  CONSTRAINT patient_past_procedure_fk1 FOREIGN KEY (patient_id)
      REFERENCES patient_demographic_info (patient_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE patient_past_procedure OWNER TO thirra;
COMMENT ON TABLE patient_past_procedure IS 'Modified on March 23, 2012'; 


DROP TABLE procedure_order CASCADE;
CREATE TABLE procedure_order
(
  order_id character(10) NOT NULL,
  staff_id character(10) NOT NULL,
  patient_id character(26) NOT NULL,
  session_id character(10) NOT NULL,
  product_id character(10),
  counselling text,
  other text,
  notes text,
  result_status character varying(20),
  invoice_status character varying(20),
  procedure_ref character varying(10), -- THIRRA March 31, 2010
  pcode1ext_code character varying(50) NOT NULL,
  pcode1ext_id character(10), -- THIRRA March 23, 2012
  procedure_outcome text, -- THIRRA March 23, 2012
  outcome_reference character varying(50), -- THIRRA March 23, 2012
  outcome_remarks character varying(255), -- THIRRA March 23, 2012
  outcome_staff character varying(10), -- THIRRA March 23, 2012
  outcome_date date, -- THIRRA March 23, 2012
  synch_in character varying(10),
  synch_out character varying(10),
  synch_remarks character varying(255),
  procedure_order_1 character varying(255),
  CONSTRAINT procedure_order_pkey PRIMARY KEY (order_id),
  CONSTRAINT procedure_order_fk1 FOREIGN KEY (pcode1ext_code)
      REFERENCES pcode1ext (pcode1ext_code) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT procedure_order_fk2 FOREIGN KEY (session_id)
      REFERENCES patient_consultation_summary (summary_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
)
WITH (
  OIDS=TRUE
);
ALTER TABLE procedure_order OWNER TO thirra;
COMMENT ON COLUMN procedure_order.procedure_ref IS 'THIRRA March 31, 2010';
COMMENT ON COLUMN procedure_order.pcode1ext_id IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_order.pcode1ext_code IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_order.procedure_outcome IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_order.outcome_reference IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_order.outcome_remarks IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_order.outcome_staff IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_order.outcome_date IS 'THIRRA March 23, 2012';


ALTER TABLE pcode1 RENAME COLUMN chapter to pcode_category; 
COMMENT ON COLUMN pcode1.pcode_category IS 'THIRRA March 23, 2012'; 
ALTER TABLE pcode1ext RENAME COLUMN chapter to pcode_category; 
COMMENT ON COLUMN pcode1ext.pcode_category IS 'THIRRA March 23, 2012'; 


DROP TABLE procedure_product CASCADE;
CREATE TABLE procedure_product
(
  product_id character(10) NOT NULL,
  supplier_id character(10) NOT NULL,
  pcode1ext_id character(10) NOT NULL, -- THIRRA January 28, 2011
  pcode1ext_code character varying(50),
  product_code character varying(50), -- THIRRA January 28, 2011
  commonly_used smallint, -- THIRRA January 28, 2011
  product_name character varying(255),
  prod_description text, -- THIRRA January 28, 2011
  retail_price_1 numeric(10,2), -- THIRRA January 28, 2011
  retail_price_2 numeric(10,2), -- THIRRA January 28, 2011
  retail_price_3 numeric(10,2), -- THIRRA January 28, 2011
  seller_code character varying(50), -- THIRRA January 28, 2011
  supplier_cost numeric(10,2), -- THIRRA January 28, 2011
  prod_remarks character varying(255), -- THIRRA January 28, 2011
  location_id character varying(10), -- THIRRA January 28, 2011
  product_active boolean,
  procedure_product_1 character varying(255),
  CONSTRAINT procedure_product_pkey PRIMARY KEY (product_id),
  CONSTRAINT procedure_product_fk_1 FOREIGN KEY (pcode1ext_id)
      REFERENCES pcode1ext (pcode1ext_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE procedure_product OWNER TO thirra;
COMMENT ON COLUMN procedure_product.pcode1ext_id IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.product_code IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.commonly_used IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.product_name IS 'THIRRA March 23, 2012';
COMMENT ON COLUMN procedure_product.prod_description IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.retail_price_1 IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.retail_price_2 IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.retail_price_3 IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.seller_code IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.supplier_cost IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.prod_remarks IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.location_id IS 'THIRRA January 28, 2011';
COMMENT ON COLUMN procedure_product.product_active IS 'THIRRA March 23, 2012';

-- End of Build 248 modifications 


-- Build 249 onwards 

ALTER TABLE pcode1ext DROP COLUMN full_title; 
ALTER TABLE pcode1ext DROP COLUMN short_title; 
ALTER TABLE pcode1ext DROP COLUMN pcode2maps; 

ALTER TABLE pcode1 DROP COLUMN pcode2_maps; 

ALTER TABLE procedure_product ALTER COLUMN commonly_used TYPE smallint;
COMMENT ON COLUMN procedure_product.commonly_used IS 'Modified on March 27, 2012';

-- End of Build 249 modifications 

