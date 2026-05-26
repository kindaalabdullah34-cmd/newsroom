# NewsRoom API - Advanced Laravel Capstone


## Project Overview

NewsRoom is an advanced Laravel 11 backend application built as a capstone project for the Advanced Backend Track 2026.

The system allows admins and writers to manage articles, comments, tags, attachments, caching, queues, events, API versioning, scheduled tasks, and role-based authorization.

## Technologies Used

• Laravel 11
• PHP 8.3
• MySQL
• Redis
• Laravel Horizon
• Laravel Sanctum
• REST API

## Features
• Authentication using Sanctum
• Role-based authorization
• API Versioning (V1 / V2)
• Redis Caching
• Horizon Queues
• Events & Listeners
• Observer Pattern
• Scheduler & Artisan Commands
• Repository Pattern
• Service Layer

##  Design Patterns Used
• Repository Pattern
• Service Layer Pattern
• Dependency Injection
• Observer Pattern
• Event Driven Architecture

##  Setup Instructions
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. Configure database inside .env
5. php artisan migrate
6. php artisan db:seed
7. php artisan serve
8. php artisan horizon
9. php artisan schedule:work

##  API Endpoints
• V1
GET /api/v1/articles
POST /api/v1/articles
PUT /api/v1/articles/{id}
DELETE /api/v1/articles/{id}

•V2
GET /api/v2/articles
GET /api/v2/articles/{id}

##  Test Accounts
Admin:
email: admin@test.com
password: password
Writer:
email: writer@test.com
password: password

## Future Improvements
• Docker support
• CI/CD pipeline
• Real-time notifications
• Full-text search

## Author
Advanced Laravel Backend Capstone Project 2026
