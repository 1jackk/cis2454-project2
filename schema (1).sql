CREATE DATABASE IF NOT EXISTS registration;
USE registration;

CREATE TABLE IF NOT EXISTS student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    major VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS course (
    code VARCHAR(10) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    credits INT NOT NULL
);

CREATE TABLE IF NOT EXISTS faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(10) NOT NULL,
    faculty_id INT NOT NULL,
    semester VARCHAR(20) NOT NULL,
    FOREIGN KEY (course_code) REFERENCES course(code),
    FOREIGN KEY (faculty_id) REFERENCES faculty(id)
);

CREATE TABLE IF NOT EXISTS enrollment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    section_id INT NOT NULL,
    grade VARCHAR(2),
    FOREIGN KEY (student_id) REFERENCES student(id),
    FOREIGN KEY (section_id) REFERENCES section(id)
);

INSERT INTO student (name, major) VALUES ('John Doe', 'Computer Science'), ('Sarah Johnson', 'Mathematics');
INSERT INTO course (code, name, description, credits) VALUES ('CIS2454', 'Full Stack Web Dev', 'Web development with PHP and Node', 3), ('MAT1580', 'Statistics', 'Intro to statistics', 4);
INSERT INTO faculty (name, email) VALUES ('Eric Charnesky', 'echarnesky@oaklandcc.edu');
INSERT INTO section (course_code, faculty_id, semester) VALUES ('CIS2454', 1, 'Winter 2026');
INSERT INTO enrollment (student_id, section_id, grade) VALUES (1, 1, 'A');
