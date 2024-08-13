CREATE DATABASE blood_donation;

USE blood_donation;

CREATE TABLE donor_details (
  donor_id INT AUTO_INCREMENT NOT NULL,
  donor_name VARCHAR(50) NOT NULL,
  donor_number VARCHAR(10) NOT NULL,
  donor_mail VARCHAR(50),
  donor_age INT NOT NULL,
  donor_gender VARCHAR(10) NOT NULL,
  donor_blood VARCHAR(10) NOT NULL,
  donor_address VARCHAR(100) NOT NULL,
  PRIMARY KEY (donor_id)
);

CREATE TABLE admin_info (
  admin_id INT AUTO_INCREMENT NOT NULL,
  admin_name VARCHAR(50) NOT NULL,
  admin_username VARCHAR(50) NOT NULL UNIQUE,
  admin_password VARCHAR(50) NOT NULL,
  PRIMARY KEY (admin_id)
);

INSERT INTO admin_info (admin_name, admin_username, admin_password)
VALUES ("Varun", "varunsardana004", "123");

CREATE TABLE blood (
  blood_id INT AUTO_INCREMENT NOT NULL,
  blood_group VARCHAR(10) NOT NULL,
  PRIMARY KEY (blood_id)
);

INSERT INTO blood (blood_group)
VALUES ("B+"), ("B-"), ("A+"), ("O+"), ("O-"), ("A-"), ("AB+"), ("AB-");

CREATE TABLE pages (
  page_id INT AUTO_INCREMENT NOT NULL,
  page_name VARCHAR(255) NOT NULL,
  page_type VARCHAR(50) NOT NULL,
  page_data LONGTEXT NOT NULL,
  PRIMARY KEY (page_id)
);

INSERT INTO pages (page_id, page_name, page_type, page_data)
VALUES
  (2, 'Why Become Donor', 'donor', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Blood is the most precious gift that anyone can give to another person — the gift of life. ...'),
  (3, 'About Us', 'aboutus', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">Blood bank is a place where blood bag that is collected from blood donation events is stored in one place. ...'),
  (4, 'The Need For Blood', 'needforblood', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">There are many reasons patients need blood. ...'),
  (5, 'Blood Tips', 'bloodtips', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">1) You must be in good health. ...'),
  (6, 'Who You Could Help', 'whoyouhelp', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">Every 2 seconds, someone in the World needs blood. ...'),
  (7, 'Blood Groups', 'bloodgroups', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">Blood group of any human being will mainly fall in any one of the following groups. ...'),
  (8, 'Universal Donors And Recipients', 'universal', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;">The most common blood type is O, followed by type A. ...');

CREATE TABLE contact_info (
  contact_id INT AUTO_INCREMENT NOT NULL,
  contact_address VARCHAR(100) NOT NULL,
  contact_mail VARCHAR(50) NOT NULL,
  contact_phone VARCHAR(100) NOT NULL,
  PRIMARY KEY (contact_id)
);

INSERT INTO contact_info (contact_address, contact_mail, contact_phone)
VALUES ("BLOOD, HELPING (125001)", "bloodbank@gmail.com", "9867418156");

CREATE TABLE contact_query (
  query_id INT AUTO_INCREMENT NOT NULL,
  query_name VARCHAR(100) NOT NULL,
  query_mail VARCHAR(120) NOT NULL,
  query_number CHAR(11) NOT NULL,
  query_message LONGTEXT NOT NULL,
  PRIMARY KEY (query_id)
);

CREATE TABLE user (
  user_id INT AUTO_INCREMENT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  PRIMARY KEY (user_id)
);
