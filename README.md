# NewsRoom API - Advanced Laravel Capstone
 
## Project Overview

NewsRoom is an advanced Laravel 11 backend application developed as a capstone project for the Advanced Backend Track 2026.

The platform provides a complete news management system where administrators, writers, and readers can interact through articles, comments, attachments, notifications, and role-based permissions.

The application follows modern Laravel architecture principles and implements multiple design patterns and advanced backend concepts including caching, queues, events, observers, API versioning, automated testing, and scheduled tasks.

---

## Technologies Used

* Laravel 11
* PHP 8.2+
* MySQL
* Redis
* Laravel Horizon
* Laravel Sanctum
* PHPUnit
* REST API

---

## Features

### Authentication & Authorization

* Authentication using Laravel Sanctum
* Role-based authorization (Admin, Writer, Reader)

### Article Management

* Create, update, view, and delete articles
* Soft Deletes support
* Draft and Published article states

### Comment System

* Add comments to published articles
* Notifications for article owners

### Attachments

* Upload files and attachments to articles
* Attachment management with polymorphic relationships

### API Features

* API Versioning (V1 / V2)
* Resource Responses
* Validation Handling
* Secure API Responses

### Performance & Infrastructure

* Redis Caching
* Laravel Horizon Queues
* Scheduled Tasks
* Artisan Commands

### Application Architecture

* Repository Pattern
* Service Layer Pattern
* Dependency Injection
* Observer Pattern
* Event-Driven Architecture

### Testing

* Feature Tests
* Unit Tests
* Mail Testing
* Queue Testing
* Notification Testing
* Database Testing

---

## Design Patterns Used

* Repository Pattern
* Service Layer Pattern
* Dependency Injection
* Observer Pattern
* Event-Driven Architecture

---

## Testing Coverage

The project includes automated tests covering:

### Feature Tests

* ArticleManagementTest
* CommentSystemTest
* ArticlePublishingTest
* AttachmentUploadTest
* ApiResponseStructureTest

### Unit Tests

* ArticlePublishedMailTest
* NewCommentNotificationTest
* NotifySubscribersJobTest

Run tests using:

```bash
php artisan test
```

Current Status:

```text
17 Passed Tests
32 Assertions
```

---

## Setup Instructions

1. Install dependencies

```bash
composer install
```

2. Create environment file

```bash
cp .env.example .env
```

3. Generate application key

```bash
php artisan key:generate
```

4. Configure database credentials inside `.env`

5. Run migrations

```bash
php artisan migrate
```

6. Seed database

```bash
php artisan db:seed
```

7. Start application

```bash
php artisan serve
```

8. Run Horizon

```bash
php artisan horizon
```

9. Run Scheduler

```bash
php artisan schedule:work
```

---

## API Endpoints

### Version 1

```http
GET    /api/v1/articles
POST   /api/v1/articles
PUT    /api/v1/articles/{id}
DELETE /api/v1/articles/{id}
```

### Version 2

```http
GET /api/v2/articles
GET /api/v2/articles/{id}
```

---

## Test Accounts

### Admin

```text
Email: admin@test.com
Password: password
```

### Writer

```text
Email: writer@test.com
Password: password
```

---

## Future Improvements

* Docker Support
* CI/CD Pipeline
* Real-Time Notifications
* Full-Text Search
* WebSockets Integration
* Advanced Analytics Dashboard

---

## Author

Advanced Laravel Backend Capstone Project 2026
