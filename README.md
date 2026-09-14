Madrasati AI System
Overview

Madrasati AI System is a full-stack school management platform built for my graduation project. The main goal of the system is to make daily school tasks easier and safer for teachers, students, and administrators by combining a secure academic database with practical AI tools.

Most school platforms only store data. This project goes one step further: it uses artificial intelligence to help with two tasks that usually take teachers a lot of time — creating learning content and grading exams.

The Problem

Teachers spend many hours preparing lesson material and correcting exams by hand. At the same time, schools need a reliable way to manage student records, classes, and user accounts, and to make sure that only the right person can log into the right account. I wanted to build a system that solves both problems together, instead of treating them as separate tools.

My Role

This was a team project. I was responsible for the database structure and the AI integration, and I worked closely with the rest of the team on planning and managing the system from start to finish.

Key Features

Role-based database architecture The system separates users into roles (such as student, teacher, and administrator), and each role has different permissions and access to different data. Academic records, classes, and grades are all organized around this role structure, so information stays private and only reaches the people who are supposed to see it.

Secure login with facial recognition Instead of relying only on a password, the login process requires facial recognition as a second step. This makes it much harder for someone to access an account that is not theirs, even if a password is leaked or guessed.

AI-assisted content generation Teachers can use the built-in AI tool, powered by the Google Gemini API, to help generate learning material and exam questions. This does not replace the teacher's judgment — it gives them a starting point that they can review and edit, which saves preparation time.

AI-assisted exam grading The system can also grade exams automatically using AI, which reduces the manual work needed to correct large numbers of answers and gives students faster feedback.

Controlled AI behavior One detail I paid close attention to is how the AI is instructed. I wrote a specific system prompt that limits the AI to acting only as a teaching assistant. This means the AI stays focused on educational tasks and does not answer unrelated questions or go outside its intended role — an important safety consideration when AI is connected to a real academic system.

Technology Used
Backend: PHP (Laravel)
Database: MySQL, MongoDB
Frontend: HTML, CSS, JavaScript, Bootstrap
AI integration: Google Gemini API
APIs: RESTful APIs
Authentication: Facial recognition combined with standard login
What I Learned

This project pushed me to think beyond just writing code that works. I had to design a database structure that stays organized as more roles and records are added, and I had to think carefully about security — both for the login system and for how much freedom to give the AI inside the platform. Working with the Gemini API also taught me how to connect an external AI service to a Laravel application and control its output through prompt design. Working as part of a team also meant coordinating with others and making sure my part of the system fit well with the rest of the project.

Status

This project was completed as a team graduation project for a B.Sc. in Web Technology and Information Security at Palestine Technical College.

Repository

github.com/JamalMohBaker/School-management

Author

Jamal M. H. Baker GitHub: github.com/JamalMohBaker LinkedIn: linkedin.com/in/jamal-moh
