# Real Estate Management System

A comprehensive real estate management system built with PHP, MySQL, and modern web technologies.

## Features

- User Authentication (Buyer/Seller)
- Property Listing and Management
- Appointment Scheduling
- Contact Form
- Admin Dashboard
- Responsive Design

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP/LAMP stack

## Installation

1. Clone the repository:
   ```bash
   git clone [your-repository-url]
   ```

2. Import the database:
   - Create a new database named `j`
   - Import the `j.sql` file into your database

3. Configure the database connection:
   - Update database credentials in the relevant PHP files

4. Start your local server:
   - Start Apache and MySQL services

5. Access the application:
   - Open your browser and navigate to `http://localhost/j`

## Project Structure

```
├── signUpLogin/         # Authentication system
├── real-estate/         # Main application
├── css/                 # Stylesheets
└── j.sql               # Database schema
```

## Security Features

- Password hashing
- Input sanitization
- SQL injection prevention
- XSS protection
- Session management

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 