CREATE DATABASE IF NOT EXISTS registration;
USE registration;

CREATE TABLE IF NOT EXISTS course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL
);

CREATE TABLE IF NOT EXISTS faculty (
    faculty_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    department VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS section (
    section_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    faculty_id INT NOT NULL,
    semester VARCHAR(20) NOT NULL,
    FOREIGN KEY (course_id) REFERENCES course(course_id),
    FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id)
);

CREATE TABLE IF NOT EXISTS enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    section_id INT NOT NULL,
    grade VARCHAR(2),
    FOREIGN KEY (student_id) REFERENCES student(student_id),
    FOREIGN KEY (section_id) REFERENCES section(section_id)
);

INSERT INTO course (course_name, credits) VALUES ('Intro to Computer Science', 3), ('Calculus I', 4);
INSERT INTO faculty (first_name, last_name, department) VALUES ('Eric', 'Charnesky', 'Computer Science');
INSERT INTO student (first_name, last_name, email) VALUES ('John', 'Doe', 'jdoe@email.com');
INSERT INTO section (course_id, faculty_id, semester) VALUES (1, 1, 'Winter 2026');
INSERT INTO enrollment (student_id, section_id, grade) VALUES (1, 1, 'A');
