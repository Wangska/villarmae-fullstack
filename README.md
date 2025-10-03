# NFT Collection Web App

A modern, responsive NFT collection management web application built with PHP and MySQL.

## Features

- 🔐 **User Authentication** - Secure login and registration system
- 🎨 **NFT Management** - Add, view, and manage your NFT collection
- 📱 **Responsive Design** - Beautiful, mobile-friendly interface
- 🛡️ **Secure** - Password hashing and SQL injection protection
- 🎯 **Modern UI** - Clean, gradient-based design with Bootstrap 5

## Tech Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, Bootstrap 5, Font Awesome
- **Deployment**: Coolify

## Environment Variables

The application uses the following environment variables (already configured for Coolify):

```
DB_CONNECTION=mysql
DB_DATABASE=default
DB_HOST=joccwsg44gwo0oc0s8g48ko0
DB_PASSWORD=0439VpH3ybiZZdDmbFH7mI1PXBBSSGfMwh96BdMEcBGGYH5gJsIFZAiTAfCwNJGz
DB_PORT=3306
DB_USERNAME=root
```

## File Structure

```
├── index.php                 # Main homepage (outside app directory)
├── dashboard.php            # User dashboard for NFT management
├── setup.php               # Database initialization script
├── config/
│   ├── database.php        # Database connection configuration
│   └── init_db.php         # Database table creation
├── auth/
│   ├── login.php           # User login page
│   ├── register.php        # User registration page
│   └── logout.php          # Logout handler
└── README.md               # This file
```

## Database Schema

### Users Table
- `id` - Primary key
- `username` - Unique username
- `email` - Unique email address
- `password` - Hashed password
- `created_at` - Timestamp

### NFTs Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `name` - NFT name
- `description` - NFT description
- `image_url` - URL to NFT image
- `price` - Price in ETH
- `token_id` - Blockchain token ID
- `contract_address` - Smart contract address
- `created_at` - Timestamp

## Deployment Instructions

### For Coolify Deployment:

1. **Upload Files**: Upload all files to your Coolify project directory
2. **Environment Variables**: The environment variables are already configured in your Coolify setup
3. **Initialize Database**: Visit `your-domain.com/setup.php` to create database tables
4. **Access Application**: Visit `your-domain.com` to access the application

### Manual Setup (if needed):

1. **Database Setup**:
   ```bash
   # Run the setup script
   php setup.php
   ```

2. **File Permissions**:
   ```bash
   chmod 755 config/
   chmod 644 config/*.php
   ```

## Usage

1. **Homepage**: Visit the main page to see the landing page
2. **Registration**: Create a new account via the "Sign Up" button
3. **Login**: Use your credentials to log in
4. **Dashboard**: After login, you'll be redirected to your dashboard
5. **Add NFTs**: Use the form on the dashboard to add new NFTs
6. **View Collection**: Your NFTs will be displayed in a beautiful grid layout

## Security Features

- Password hashing using PHP's `password_hash()` function
- SQL injection protection with prepared statements
- Session management for user authentication
- Input validation and sanitization
- CSRF protection through session tokens

## Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## Contributing

This is a complete, production-ready NFT collection management application. Feel free to customize the design, add features, or modify the functionality to suit your needs.

## License

This project is open source and available under the MIT License.
