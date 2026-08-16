# NewsRoom API - Advanced Laravel Capstone

NewsRoom is an advanced Laravel 11 REST API developed as a capstone project for the Advanced Backend Track 2026.

The platform provides a complete news management system with articles, comments, attachments, notifications, authentication, role-based authorization, API versioning, caching, queues, events, observers, scheduled tasks, and automated testing.

## Technologies

- Laravel 11
- PHP 8.2+
- MySQL
- Redis
- Laravel Horizon
- Laravel Sanctum
- PHPUnit
- REST API

## Features

### Authentication & Authorization

- Laravel Sanctum authentication
- Role-based authorization
- Admin, Writer, and Reader roles

### Article Management

- Create, update, view, and delete articles
- Draft, published, and archived states
- Soft deletes
- Article validation
- Article policies

### Comments

- Add comments to articles
- Notifications for article owners

### Attachments

- Upload attachments to articles
- Polymorphic relationships

### API

- API Versioning (V1 / V2)
- API Resources
- Validation
- Secure API responses
- Rate limiting

### Performance & Infrastructure

- Redis caching
- Laravel Horizon queues
- Scheduled tasks
- Artisan commands

### Architecture

- Repository Pattern
- Service Layer
- Dependency Injection
- Observer Pattern
- Event-Driven Architecture

## Testing

The project includes Feature and Unit tests covering:

### Feature Tests

- Article Management
- Article Publishing
- Comment System
- Attachment Upload
- API Response Structure

### Unit Tests

- Article Published Mail
- New Comment Notification
- Notify Subscribers Job

Run tests with:

```bash
php artisan test
Current test result:
17 tests passed
32 assertions

Setup
1. Install dependencies
composer install
2. Create environment file
cp .env.example .env

On Windows PowerShell:
Copy-Item .env.example .env

3. Generate application key
php artisan key:generate

4. Configure environment
Configure the database and Redis settings in .env.
Example:
DB_CONNECTION=mysql
DB_DATABASE=newsroom

CACHE_STORE=redis
QUEUE_CONNECTION=redis

5. Run migrations and seed the database
php artisan migrate:fresh --seed

6. Start the application
php artisan serve

7. Start Redis
Redis must be running for caching and queues.

8. Start Laravel Horizon
php artisan horizon

9. Run the scheduler
php artisan schedule:work

API Endpoints
Authentication
POST /api/login

API V1:
GET    /api/v1/articles
GET    /api/v1/articles/{id}
POST   /api/v1/articles
PUT    /api/v1/articles/{id}
DELETE /api/v1/articles/{id}

POST   /api/v1/articles/{id}/comments
POST   /api/v1/articles/{id}/attachments

API V2:
GET    /api/v2/articles
GET    /api/v2/articles/{id}
POST   /api/v2/articles
PUT    /api/v2/articles/{id}
PATCH  /api/v2/articles/{id}
DELETE /api/v2/articles/{id}

All protected API endpoints require authentication using Laravel Sanctum.
Test Accounts
Admin
Email: admin@test.com
Password: password

Writer
Email: writer@test.com
Password: password

Scheduled Tasks
The application includes scheduled commands for:
articles:archive
articles:report

Future Improvements
Docker support
CI/CD pipeline
Real-time notifications
Full-text search
WebSockets integration
Advanced analytics dashboard

Author
Kinda Alabdullah
Advanced Backend Track 2026
```
