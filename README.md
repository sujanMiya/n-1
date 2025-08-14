# Booking System - Laravel Project Setup

This guide will help you set up the Laravel Booking System project using Docker.

## Prerequisites

- Docker and Docker Compose installed
- Git installed
- Basic knowledge of Laravel and Docker

## Project Setup

### 1. Clone the Repository

```bash
git clone https://github.com/sujanMiya/booking_system/tree/story-01 booking_system
cd booking_system
```

### 2. Start Docker Services

```bash
docker-compose up -d
```

This command will start all the required services in detached mode.

### 3. Navigate to App Directory

```bash
cd app
```

### 4. Environment Configuration

Copy the example environment file:

```bash
cp .example.env .env
```


### 5. Install Dependencies

Access the app container and install Composer dependencies:

```bash
docker-compose exec app sh
composer install
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Database Setup

Run database migrations and seed data:

```bash
php artisan migrate
php artisan db:seed
```

## Default User Accounts

After running the database seeder, the following accounts will be available:

### Regular User
- **Email**: `user@example.com`
- **Password**: `password`

### Admin User
- **Email**: `admin@example.com`
- **Password**: `password`

## API Access

The application will be available at:

```
http://0.0.0.0:8000
```

### API Endpoints

- **Registration Endpoint**: `http://localhost:8000/api/v1/register`
- **Base API URL**: `http://localhost:8000/api/v1/`

## Project Structure

Detailed Architecture Components with folder structures for:

 -DTOs (Data Transfer Objects)
 -Services (Business Logic Layer)
 -Resources (API Response Formatting)
 -Requests (Request Validation)
 -Models with UUID implementation
 Benefits of This Architecture

 Maintainability: Clear separation of concerns
 Testability: Easy to unit test services and DTOs
 Scalability: Business logic separated from HTTP layer
 Security: UUID prevents ID enumeration attacks
 API Consistency: Resources ensure uniform response format
 Validation: Centralized request validation
 Type Safety: DTOs provide type hints and contracts

## Troubleshooting

### Common Issues

1. **Port conflicts**: If port 8000 is already in use, update the port mapping in `docker-compose.yml`
2. **Permission issues**: Ensure proper file permissions for Laravel storage and cache directories
3. **Database connection**: Verify database service is running with `docker-compose ps`

### Useful Commands

```bash
# View running containers
docker-compose ps

# View logs
docker-compose logs app

# Stop all services
docker-compose down

# Rebuild containers
docker-compose up --build -d
```

## Next Steps

1. Access the application at `http://localhost:8000`
2. Test user registration via API endpoint
3. Login with the provided default accounts
4. Explore the booking system features

# API Doc
-Api collection link : https://elements.getpostman.com/redirect?entityId=6434911-f7ff03e6-b6d6-4f8d-81a5-6071b5120a25&entityType=collection



