# Real Estate Management System

A full-featured real estate management platform that connects buyers and sellers, featuring property listings, appointment scheduling, and user management.

## 🌟 Key Features

### User Management
- **Dual Role System**: Separate interfaces for buyers and sellers
- **Secure Authentication**: Password hashing and session management
- **Profile Management**: User profiles with customizable information

### Property Management
- **Property Listings**: Create, view, and manage property listings
- **Image Upload**: Support for multiple property images
- **Property Search**: Filter properties by type, location, and price
- **Detailed Views**: Comprehensive property information pages

### Appointment System
- **Scheduling**: Book property viewings and meetings
- **Calendar Integration**: View and manage appointments
- **Notifications**: Email notifications for appointments

### Contact System
- **Inquiry Forms**: Contact forms for property inquiries
- **Location-based**: City-specific inquiry handling
- **User Type**: Different forms for buyers and sellers

### Admin Dashboard
- **User Management**: View and manage all users
- **Property Oversight**: Monitor and manage property listings
- **Appointment Tracking**: View and manage all appointments
- **Activity Logs**: Track system activities and changes

## 🛠️ Technical Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (XAMPP)
- **Security**: Password hashing, SQL injection prevention, XSS protection

## 📋 Prerequisites

- XAMPP/WAMP/LAMP stack installed
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, Edge)

## 🚀 Installation Guide

1. **Clone the Repository**
   ```bash
   git clone [your-repository-url]
   cd [project-directory]
   ```

2. **Database Setup**
   - Start XAMPP/WAMP/LAMP
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `j`
   - Import `j.sql` file into the database

3. **Configuration**
   - Ensure all database credentials are correctly set in PHP files
   - Configure email settings for notifications (if required)

4. **Start the Application**
   - Start Apache and MySQL services
   - Access the application at `http://localhost/j`

## 📁 Project Structure

```
├── signUpLogin/         # Authentication system
│   ├── admin/          # Admin panel
│   ├── login.html      # Login page
│   ├── signup.html     # Registration page
│   └── process*.php    # Authentication processing
├── real-estate/        # Main application
│   ├── index.php       # Home page
│   ├── contact.php     # Contact form
│   ├── property-details.php
│   └── appointments.php
├── css/                # Stylesheets
│   └── style.css
└── j.sql              # Database schema
```

## 🔒 Security Features

- **Password Protection**: Secure password hashing
- **Input Validation**: Server-side validation of all inputs
- **SQL Injection Prevention**: Prepared statements
- **XSS Protection**: Input sanitization
- **Session Management**: Secure session handling
- **Role-Based Access**: Different access levels for users

## 👥 User Roles

1. **Buyers**
   - Browse properties
   - Schedule viewings
   - Contact sellers
   - Save favorite properties

2. **Sellers**
   - List properties
   - Manage listings
   - View inquiries
   - Schedule appointments

3. **Administrators**
   - Manage all users
   - Monitor listings
   - Track appointments
   - View system logs

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support, please:
- Check the [Issues](https://github.com/yourusername/your-repo/issues) section
- Create a new issue if your problem isn't listed
- Contact the maintainers for critical issues

## 🙏 Acknowledgments

- Thanks to all contributors
- Special thanks to the open-source community
- Inspired by modern real estate platforms
