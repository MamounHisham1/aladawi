# موقع الشيخ العدوي (Al-Adawi.net)

A full-stack Islamic website built with Laravel 12, Inertia.js, and Vue 3, featuring comprehensive content management for fatwas, audio lectures, books, and articles.

## Features

### Frontend Features
- **Homepage**: Latest fatwas, featured audio lectures, and books
- **Fatwas Section**: Searchable and filterable Islamic rulings by category, topic, and date
- **Audio Lectures**: Paginated audio content with series organization and filtering
- **Books Library**: Downloadable books (PDF, DOC) with descriptions and categories
- **Articles**: Markdown-rendered articles with filtering by subject
- **About Page**: Sheikh Al-Adawi biography with timeline and background
- **Contact Form**: User inquiry submission system
- **Arabic RTL Layout**: Full right-to-left language support
- **Dark Mode**: Toggle between light and dark themes
- **Responsive Design**: Mobile-first approach with Tailwind CSS

### Admin Panel Features (Filament)
- **Category Management**: Organize content by type and subject
- **Fatwa Management**: Create and manage Islamic rulings
- **Audio Management**: Upload and organize audio lectures with series
- **Book Management**: Upload books with metadata and cover images
- **Article Management**: Create and edit markdown articles
- **Contact Management**: Review and respond to user inquiries
- **Media Library**: File upload and management system

### Technical Features
- **SEO-Friendly**: Slug-based routing and metadata management
- **Audio Player**: Built-in audio player for lectures
- **File Downloads**: Secure file download system with tracking
- **Search Functionality**: Full-text search across all content types
- **Filtering**: Advanced filtering by categories, dates, and other criteria
- **Pagination**: Efficient content pagination

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Vue 3 with Composition API
- **Routing**: Inertia.js for SPA-like experience
- **Styling**: Tailwind CSS with dark mode support
- **Admin Panel**: Filament v3
- **Database**: MySQL/PostgreSQL (configurable)
- **File Storage**: Laravel Media Library (Spatie)
- **Slugs**: Laravel Sluggable (Spatie)
- **Markdown**: CommonMark for article rendering

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+ & npm
- MySQL or PostgreSQL

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd aladawi
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aladawi
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed --class=CategorySeeder
   ```

7. **Create admin user**
   ```bash
   php artisan make:filament-user
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

The application will be available at `http://localhost:8000`
Admin panel will be available at `http://localhost:8000/admin`

## Development

### Running in development mode
```bash
# Terminal 1: Laravel development server
php artisan serve

# Terminal 2: Vite development server
npm run dev
```

### Building for production
```bash
npm run build
```

## Project Structure

```
app/
├── Http/Controllers/           # Frontend controllers
├── Models/                     # Eloquent models
└── Filament/Resources/        # Admin panel resources

resources/
├── js/
│   ├── components/            # Vue components
│   ├── layouts/               # Layout components
│   ├── pages/                 # Page components
│   └── app.ts                 # Main JavaScript file
├── css/
│   └── app.css               # Tailwind CSS with Arabic support
└── views/                     # Blade templates

database/
├── migrations/                # Database migrations
└── seeders/                   # Database seeders

routes/
└── web.php                    # Application routes
```

## Models and Relationships

### Core Models
- **Category**: Content categorization
- **Fatwa**: Islamic rulings and Q&A
- **AudioLecture**: Audio content with series support
- **AudioSeries**: Organization for audio lectures
- **Book**: Downloadable books with metadata
- **Article**: Markdown articles
- **Contact**: User inquiries

### Key Relationships
- Categories have many fatwas, audio lectures, books, and articles
- Audio lectures belong to categories and optional series
- All content types support media attachments via Laravel Media Library

## Configuration

### Arabic Font Support
The application uses Noto Sans Arabic for optimal Arabic text rendering. Font loading is handled in `resources/css/app.css`.

### RTL Support
RTL layout is automatically applied based on content language. Tailwind's RTL utilities are configured for proper spacing and alignment.

### Dark Mode
Dark mode is implemented using Tailwind's dark mode feature with localStorage persistence.

## Content Management

### Adding Content via Admin Panel
1. Access `/admin` and log in
2. Use the navigation menu to access different content types
3. Categories should be created first to organize content
4. All content supports both Arabic and English versions

### File Uploads
- **Books**: Support PDF and DOC files with cover images
- **Audio**: Support MP3, WAV files
- **Images**: Support JPEG, PNG for covers and illustrations

## SEO and Performance

### SEO Features
- Slug-based URLs for all content
- Meta title and description fields
- Structured data ready (can be extended)

### Performance
- Lazy loading for images
- Efficient pagination
- Database indexing on searchable fields
- Asset optimization with Vite

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the MIT license.

## Support

For support and questions, please contact the development team or create an issue in the repository. 