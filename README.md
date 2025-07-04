# Laravel News Application

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg)]()

A modern, feature-rich news application built with Laravel 11, featuring a comprehensive admin dashboard, role-based access control, and a responsive design.

## 📋 Project Overview

This Laravel News Application is a complete content management system designed for news websites and blogs. It provides a powerful admin interface for managing articles, categories, pages, and users with different permission levels. The application features a clean, responsive design and modern web technologies.

### Key Features
- **Multi-role User System**: Superadmin, Admin, and Author roles with granular permissions
- **Rich Content Editor**: CKEditor 5 integration for advanced content creation
- **Media Management**: File upload and image handling for featured images
- **SEO Friendly**: Automatic slug generation and meta tag support
- **Responsive Design**: Mobile-first approach with Tailwind CSS
- **Modern UI**: Clean admin dashboard with Alpine.js interactivity

## 🛠 Technology Stack

- **Backend**: Laravel 11.x
- **PHP Version**: 8.3+
- **Database**: MySQL 8.0+ / SQLite (development)
- **Frontend Build**: Vite 5.x
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Alpine.js 3.x
- **Rich Text Editor**: CKEditor 5
- **Authentication**: Laravel Breeze/Custom
- **Authorization**: Spatie Laravel Permission
- **File Storage**: Laravel Storage (local/cloud)
- **Asset Compilation**: Laravel Mix/Vite

## ✨ Features

### Content Management
- **Post Management**: Create, read, update, delete articles with rich text editor
- **Category System**: Organize posts into hierarchical categories
- **Page Management**: Static pages for About, Contact, etc.
- **Media Library**: Upload and manage images and files
- **SEO Optimization**: Meta titles, descriptions, and friendly URLs

### User Management & Security
- **Role-Based Access Control**: Three-tier permission system
  - **Superadmin**: Full system access
  - **Admin**: Content and user management
  - **Author**: Limited content creation
- **User Authentication**: Secure login/logout system
- **Profile Management**: User profile editing and password changes
- **CSRF Protection**: Enhanced security against cross-site attacks

### Admin Dashboard
- **Responsive Interface**: Mobile-friendly admin panel
- **Dashboard Analytics**: Content statistics and overview
- **Bulk Operations**: Mass actions for content management
- **Search & Filtering**: Advanced content filtering options
- **Real-time Validation**: Client-side and server-side validation

### Technical Features
- **Database Migrations**: Version-controlled database schema
- **Model Relationships**: Eloquent ORM with proper relationships
- **Form Validation**: Comprehensive input validation
- **Error Handling**: User-friendly error pages
- **Logging System**: Application activity logging
- **Caching**: Performance optimization with caching

## 📋 Requirements

### System Requirements
- **PHP**: 8.3 or higher
- **Composer**: 2.0 or higher
- **Node.js**: 18.0 or higher
- **NPM/Yarn**: Latest stable version
- **Database**: MySQL 8.0+ or SQLite 3.8+
- **Web Server**: Apache 2.4+ or Nginx 1.18+

### PHP Extensions
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- GD PHP Extension (for image processing)

## 🚀 Installation Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/laravel-news-app.git
cd laravel-news-app
```

### 2. Install Composer Dependencies
```bash
composer install
```

### 3. Install NPM Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Environment Variables
Edit the `.env` file with your configuration:
```env
APP_NAME="Laravel News App"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_app
DB_USERNAME=your_username
DB_PASSWORD=your_password

# For SQLite (development)
# DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite
```

### 6. Database Setup
```bash
# Create database (MySQL)
mysql -u root -p -e "CREATE DATABASE news_app;"

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 7. Storage Permissions Setup
```bash
# Create symbolic link for storage
php artisan storage:link

# Set proper permissions (Linux/macOS)
chmod -R 775 storage bootstrap/cache

# For Windows (run as administrator)
# icacls storage /grant Everyone:F /T
# icacls bootstrap/cache /grant Everyone:F /T
```

### 8. Build Assets
```bash
# Development build
npm run dev

# Production build
npm run build

# Watch for changes (development)
npm run dev -- --watch
```

### 9. Start Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## ⚙️ Configuration

### Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `APP_NAME` | Application name | Laravel News App |
| `APP_ENV` | Environment (local/production) | local |
| `APP_DEBUG` | Debug mode | true |
| `DB_CONNECTION` | Database driver | mysql |
| `MAIL_MAILER` | Mail driver | smtp |
| `FILESYSTEM_DISK` | Default storage disk | local |
| `SESSION_DRIVER` | Session storage | file |
| `SESSION_LIFETIME` | Session timeout (minutes) | 1440 |

### Database Configuration
The application supports multiple database drivers:
- **MySQL**: Recommended for production
- **SQLite**: Good for development and testing
- **PostgreSQL**: Alternative production database

### File Storage Configuration
```env
# Local storage (default)
FILESYSTEM_DISK=local

# AWS S3 storage
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-access-key
AWS_SECRET_ACCESS_KEY=your-secret-key
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

### CSRF and Session Configuration
```env
SESSION_DRIVER=file
SESSION_LIFETIME=1440
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
```

## 📖 Usage

### Accessing the Admin Panel
1. Navigate to `/admin` or `/login`
2. Use seeded credentials or create a new account
3. Default superadmin credentials (if seeded):
   - Email: `admin@example.com`
   - Password: `password`

### Creating Posts
1. Login to admin panel
2. Navigate to **Posts** → **Create New**
3. Fill in title, content (using CKEditor), category
4. Upload featured image (optional)
5. Set status (Draft/Published)
6. Click **Create Post**

### Managing Categories
1. Go to **Categories** (Superadmin only)
2. Create hierarchical category structure
3. Assign posts to categories

### User Roles and Permissions
- **Superadmin**: All permissions, user management
- **Admin**: Content management, limited user access
- **Author**: Create and edit own posts only

## 🔧 Development

### Project Structure
```
laravel-news-app/
├── app/
│   ├── Http/Controllers/Admin/    # Admin controllers
│   ├── Models/                    # Eloquent models
│   ├── Policies/                  # Authorization policies
│   └── Providers/                 # Service providers
├── database/
│   ├── migrations/                # Database migrations
│   ├── seeders/                   # Database seeders
│   └── factories/                 # Model factories
├── resources/
│   ├── views/admin/               # Admin panel views
│   ├── views/layouts/             # Layout templates
│   ├── js/                        # JavaScript files
│   └── css/                       # CSS files
├── routes/
│   └── web.php                    # Web routes
├── storage/
│   ├── app/public/                # Public file storage
│   └── logs/                      # Application logs
└── public/
    ├── css/                       # Compiled CSS
    ├── js/                        # Compiled JavaScript
    └── storage/                   # Storage symlink
```

### Key Directories and Files
- **Controllers**: `app/Http/Controllers/Admin/`
- **Models**: `app/Models/`
- **Views**: `resources/views/admin/`
- **Routes**: `routes/web.php`
- **Assets**: `resources/js/` and `resources/css/`
- **Config**: `config/`

### Development Workflow
1. **Make Changes**: Edit code in appropriate directories
2. **Run Tests**: `php artisan test`
3. **Compile Assets**: `npm run dev`
4. **Database Changes**: Create migrations with `php artisan make:migration`
5. **Clear Caches**: `php artisan cache:clear` and `php artisan config:clear`

### Asset Compilation
```bash
# Development (with file watching)
npm run dev

# Production build
npm run build

# Development with hot reload
npm run dev -- --hot
```

## 🐛 Troubleshooting

### Common Issues and Solutions

#### CSRF Token Mismatch (419 Error)
**Problem**: Form submissions fail with 419 Page Expired error
**Solution**:
```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Check session configuration in .env
SESSION_DRIVER=file
SESSION_LIFETIME=1440

# Ensure storage permissions are correct
chmod -R 775 storage bootstrap/cache
```

#### Storage Permission Issues
**Problem**: File uploads fail or images don't display
**Solution**:
```bash
# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# For Windows (run as administrator)
icacls storage /grant Everyone:F /T
```

#### CKEditor Content Not Saving
**Problem**: Rich text content appears empty after form submission
**Solution**: Ensure JavaScript is properly loaded and CKEditor is initialized correctly. Check browser console for errors.

#### Database Connection Issues
**Problem**: Cannot connect to database
**Solution**:
1. Verify database credentials in `.env`
2. Ensure database server is running
3. Check database exists and user has proper permissions
4. Test connection: `php artisan tinker` then `DB::connection()->getPdo()`

#### Asset Compilation Errors
**Problem**: CSS/JS files not loading or compilation fails
**Solution**:
```bash
# Clear npm cache
npm cache clean --force

# Reinstall dependencies
rm -rf node_modules package-lock.json
npm install

# Rebuild assets
npm run build
```

### Debug Mode
For development, enable debug mode in `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

**⚠️ Important**: Always set `APP_DEBUG=false` in production!

## 🤝 Contributing

We welcome contributions to improve this Laravel News Application! Here's how you can contribute:

### Getting Started
1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes
4. Run tests: `php artisan test`
5. Commit changes: `git commit -m 'Add amazing feature'`
6. Push to branch: `git push origin feature/amazing-feature`
7. Submit a Pull Request

### Contribution Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation as needed
- Use meaningful commit messages
- Ensure backward compatibility

### Code Style
This project follows Laravel coding conventions:
- Use PSR-12 for PHP code formatting
- Use meaningful variable and method names
- Add comments for complex logic
- Follow Laravel naming conventions

### Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### MIT License Summary
- ✅ Commercial use
- ✅ Modification
- ✅ Distribution
- ✅ Private use
- ❌ Liability
- ❌ Warranty

## 📞 Support

If you encounter any issues or have questions:

1. **Check Documentation**: Review this README and Laravel documentation
2. **Search Issues**: Look through existing GitHub issues
3. **Create Issue**: Submit a detailed bug report or feature request
4. **Community**: Join Laravel community forums and Discord

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com) - The PHP framework for web artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Alpine.js](https://alpinejs.dev) - A rugged, minimal framework for composing JavaScript behavior
- [CKEditor 5](https://ckeditor.com) - Smart WYSIWYG editor components
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) - Role and permission management

---

**Made with ❤️ using Laravel 11**

For more information, visit the [Laravel Documentation](https://laravel.com/docs).
