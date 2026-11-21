# Phem Industrie - Maintenance Business Website

A professional maintenance business website with product catalog, built with Laravel 12 and Tailwind CSS. Mobile-first design optimized for Morocco market with WhatsApp integration.

## Features

### Public Website
- **Home Page** - Hero section, services overview, product showcase, gallery preview
- **Services** - List of maintenance services (Electricity, Plumbing, etc.)
- **Products** - Product catalog with photos, descriptions, and prices
- **Gallery** - Before/after photos of completed work
- **About** - Company information and values
- **Contact** - Contact form and information
- **WhatsApp Integration** - Floating button and quick contact links
- **Bilingual Support** - French and Arabic (ready for RTL)

### Admin Panel
- **Mobile-First Design** - Optimized for adding products from phone
- **Dashboard** - Stats overview and quick actions
- **Product Management** - CRUD operations with image upload
- **Service Management** - Manage services offered
- **Gallery Management** - Upload before/after photos
- **Settings** - Site-wide configuration
- **Camera Upload** - Take photos directly from phone camera

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS, Blade templates
- **Database**: SQLite (can be changed to MySQL/PostgreSQL)
- **Image Storage**: Local storage with automatic compression recommended

## Installation

1. Install dependencies:
```bash
composer install
npm install
```

2. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

3. Run migrations and seed:
```bash
php artisan migrate
php artisan db:seed
```

4. Create storage link:
```bash
php artisan storage:link
```

5. Build assets:
```bash
npm run build
```

6. Start development server:
```bash
php artisan serve
```

Visit: http://localhost:8000

## Default Admin Credentials

- **Email**: admin@phemindustrie.ma
- **Password**: admin123

**⚠️ IMPORTANT: Change these credentials after first login!**

## Mobile Admin Usage

The admin panel is designed for quick product uploads from mobile:

1. Log in from your phone
2. Go to Products > Add Product
3. Tap the photo field and take a picture
4. Fill in name and description (under 30 seconds!)
5. Save

## Configuration

### WhatsApp Number

Update in Admin > Settings or directly in the `settings` table:
- Key: `whatsapp`
- Value: Your WhatsApp number with country code (e.g., +212 6XX XX XX XX)

### Site Information

Configure these settings in Admin > Settings:
- Site name
- Phone number
- Email
- Address
- About text (French and Arabic)

## Database Schema

### Products
- name, name_ar (Arabic)
- description, description_ar
- image (auto-compressed recommended)
- price (optional)
- category
- order (for sorting)
- is_active

### Services
- name, name_ar
- description, description_ar
- icon
- images (JSON array)
- order
- is_active

### Gallery
- title, title_ar
- description, description_ar
- before_image
- after_image
- category
- order
- is_active

### Contact Messages
- name, email, phone
- message
- is_read

### Settings
- key-value pairs for site configuration

## Recommended Enhancements

1. **Image Compression**: Add package like `intervention/image` to auto-compress uploads
   ```bash
   composer require intervention/image
   ```

2. **SEO**: Add meta tags, sitemaps, and structured data

3. **Google Business**: Create profile for local SEO

4. **Analytics**: Add Google Analytics

5. **Performance**: Enable caching, optimize images, use CDN

## Deployment

### Shared Hosting
1. Upload files via FTP
2. Import database
3. Configure `.env` file
4. Run migrations
5. Set document root to `/public`

### VPS (Recommended)
```bash
# Install required software
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd
sudo apt install nginx mysql-server

# Clone and setup
cd /var/www
git clone <your-repo>
cd phemindustriewebsite
composer install --no-dev
npm install && npm run build
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## Security

- Change default admin credentials immediately
- Use HTTPS in production
- Keep Laravel and dependencies updated
- Enable CSRF protection (enabled by default)
- Use environment variables for sensitive data
- Regularly backup database

## Support & Customization

This website is fully customizable. Key areas to modify:

- **Colors**: Edit `tailwind.config.js` or update classes in views
- **Layout**: Modify views in `resources/views/`
- **Logic**: Update controllers in `app/Http/Controllers/`
- **Database**: Create migrations in `database/migrations/`

## License

This project is open-source. Customize as needed for your business.

## Credits

Built with:
- Laravel 12
- Tailwind CSS
- Blade Templates

---

**Made for maintenance professionals in Morocco 🇲🇦**
