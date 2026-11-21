# Quick Start Guide - Phem Industrie Website

## 🚀 Get Started in 5 Minutes

### 1. Server is Already Running!

The development server is currently running on:
**http://127.0.0.1:8001**

Open this in your browser to see the website.

### 2. View the Public Website

Navigate to:
- **Home**: http://127.0.0.1:8001/
- **Services**: http://127.0.0.1:8001/services
- **Products**: http://127.0.0.1:8001/products
- **Gallery**: http://127.0.0.1:8001/gallery
- **About**: http://127.0.0.1:8001/about
- **Contact**: http://127.0.0.1:8001/contact

### 3. Login to Admin Panel

Go to: **http://127.0.0.1:8001/login**

**Default Credentials:**
- Email: `admin@phemindustrie.ma`
- Password: `admin123`

⚠️ **IMPORTANT**: Change this password immediately after logging in!

### 4. Add Your First Product

After logging in:
1. Click "Products" in the sidebar
2. Click "➕ Add Product" button
3. Click "Choose File" and select an image
4. Fill in:
   - Name: "Test Product"
   - Description: "This is my first product"
   - Price: 100 (optional)
5. Click "✓ Save Product"
6. Go to http://127.0.0.1:8001/products to see it live!

### 5. Update Site Settings

1. In admin panel, click "⚙️ Settings"
2. Update:
   - Phone number
   - WhatsApp number (format: +212 6XX XX XX XX)
   - Email
   - Address
3. Click "Save Settings"

## 📱 Test on Your Phone

### Option 1: Same WiFi Network
1. Find your computer's IP address:
   ```bash
   ipconfig
   ```
   Look for "IPv4 Address" (e.g., 192.168.1.100)

2. On your phone's browser, go to:
   `http://[YOUR-IP]:8001`
   Example: `http://192.168.1.100:8001`

### Option 2: Mobile Testing Later
- Deploy to a test server
- Use ngrok for temporary public URL

## 🎯 Next Steps

### Customize Content:

1. **Add Real Services**
   - Admin → Services → Add Service
   - Add your actual maintenance services

2. **Add Real Products**
   - Admin → Products → Add Product
   - Upload photos of your products

3. **Add Gallery Items**
   - Admin → Gallery → Add Gallery Item
   - Upload before/after photos of your work

4. **Update About Page**
   - Admin → Settings → Update about text

### Test WhatsApp Integration:

1. Update WhatsApp number in Settings
2. Click the floating green button on any page
3. Verify it opens WhatsApp with pre-filled message
4. Test "Ask on WhatsApp" buttons on products

## 🛑 Stop the Server

When you're done testing, stop the server by pressing `Ctrl+C` in the terminal.

## 🔄 Restart Later

To start the server again:
```bash
cd c:\Users\3AB9OR\Downloads\phemindustriewebsite
php artisan serve
```

## 📞 Common Questions

### Q: How do I change the admin password?
A: Currently via database or create a new admin user. We can add a password change feature.

### Q: Where are uploaded images stored?
A: In `storage/app/public/` and linked to `public/storage/`

### Q: Can I use MySQL instead of SQLite?
A: Yes! Update `.env` file with MySQL credentials and run `php artisan migrate`

### Q: How do I add Arabic content?
A: Use the *_ar fields when creating products/services. The RTL support is already in place.

### Q: How do I deploy to production?
A: See README.md "Deployment" section for detailed instructions.

## 🎉 You're Ready!

Your maintenance business website is running and ready to customize. Start adding your services and products!

---

**Need Help?**
- Check README.md for full documentation
- Review the Project Summary document
- Laravel Docs: https://laravel.com/docs
