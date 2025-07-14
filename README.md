# Research Grant Management System

A comprehensive web-based research grant management system built with Laravel PHP framework, designed to streamline the management of academician profiles, research grant applications, funding tracking, and project monitoring for academic institutions.

## 🚀 Features

### Core Functionality
- **Academician Profile Management** - Complete profiles with research interests and qualifications
- **Grant Application Management** - Comprehensive grant application workflow with funding tracking
- **Dynamic Team Assignments** - Flexible team member management with role-based permissions
- **Milestone-Based Project Monitoring** - Track project progress through defined milestones
- **Funding Tracking** - Real-time monitoring of grant funding and expenditure
- **Analytics Dashboard** - Visual insights into funding summaries and project deadlines

### Advanced Features
- **Complex Database Relationships** - Many-to-many associations between grants and academicians
- **Project Leadership Hierarchies** - Define and manage project leadership structures
- **Status Progression Tracking** - Monitor milestone completion and project advancement
- **Grant Lifecycle Management** - Complete workflow from application to completion
- **Team Member Assignment/Removal** - Dynamic team composition management
- **Deliverable Tracking** - Monitor and track project deliverables
- **Deadline Monitoring** - Automated alerts and deadline management

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **ORM**: Eloquent ORM with advanced relationships
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS
- **Build Tool**: Vite
- **Language**: PHP

## 📋 Prerequisites

Before running this application, make sure you have the following installed:

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & npm
- Git

## ⚡ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/research-grant-management.git
   cd research-grant-management
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
   DB_DATABASE=research_grants
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.

## 🗄️ Database Schema

### Core Tables
- **academicians** - Store academician profiles and information
- **grants** - Grant applications and details
- **milestones** - Project milestones and tracking
- **grant_academician** - Many-to-many relationship between grants and academicians
- **teams** - Team compositions and member roles

### Key Relationships
- **Many-to-Many**: Grants ↔ Academicians (with pivot table for roles)
- **One-to-Many**: Grants → Milestones
- **One-to-Many**: Grants → Team Members
- **Hierarchical**: Project Leadership Structure

## 📱 Usage

### Managing Academicians
1. Navigate to the Academicians section
2. Add new academician profiles with research interests
3. Update qualifications and contact information
4. View academician research portfolio

### Grant Management
1. Create new grant applications
2. Assign team members and define roles
3. Set project milestones and deadlines
4. Track funding allocation and usage
5. Monitor project progress

### Team Collaboration
1. Add/remove team members dynamically
2. Define project leadership hierarchy
3. Assign specific roles and responsibilities
4. Track individual contributions

### Analytics and Reporting
1. View funding summaries by department/period
2. Monitor upcoming deadlines
3. Track milestone completion rates
4. Generate project status reports

## 🏗️ Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── ...
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   └── ...
├── routes/
│   └── web.php             # Web routes
└── ...
```

## 🔧 Configuration

### Database Relationships
The system implements complex Eloquent relationships:

```php
// Grant Model
public function academicians()
{
    return $this->belongsToMany(Academician::class)
                ->withPivot('role', 'responsibility')
                ->withTimestamps();
}

// Academician Model
public function grants()
{
    return $this->belongsToMany(Grant::class)
                ->withPivot('role', 'responsibility')
                ->withTimestamps();
}
```

### Key Features Implementation
- **Milestone Tracking**: Status progression with completion percentages
- **Team Management**: Dynamic assignment with role-based access
- **Funding Analytics**: Real-time calculations and reporting
- **Deadline Alerts**: Automated notification system

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Muhammad Syazwan Akmal bin Sahimi**
- GitHub: [@flerraa](https://github.com/flerraa)
- Email: syazwanakmal80@gmail.com

## 🙏 Acknowledgments

- Laravel framework for providing excellent PHP development tools
- Tailwind CSS for the responsive design framework
- Academic institutions for inspiration and requirements gathering

---

*Built with ❤️ for academic research management*
