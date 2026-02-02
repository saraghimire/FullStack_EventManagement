# Name: Sara Ghimire Kshetri
# Student Id: 2550064


# ----Event Master----
Event Master is a professional, full-stack Event Management System built using a custom MVC (Model-View-Controller) architecture. This system provides a seamless experience for hosting events, managing attendees, and administrative oversight, all within a secure and modern interface.

# ----- Features ----
- User Authentication: Secure Sign-up and Login system using password hashing.
- Dashboard: A centralized hub to view all upcoming events.
- Ownership Logic: Users can only Edit or Delete events that they personally created.
- Join/Registration System: Users can register for events with a single click.
- User Management: Admin capability to promote/demote users or remove accounts.
- Personalized "My Bookings": A dedicated page for users to track events they have joined.
- AJAX Live Search: Instantly filter events by title or category without reloading the page.
- Flash Messages: Smooth, non-intrusive UI notifications for success and error states.
- Security Suite:
        CSRF Protection (Cross-Site Request Forgery).
        XSS Prevention (Cross-Site Scripting) using data escaping.
        PDO prepared statements to prevent SQL Injection.

# --------Tech Stack------

- Backend: PHP 8.x (Object-Oriented Programming).
- Database: MySQL / MariaDB (using InnoDB for relational integrity).
- Connection: PDO (PHP Data Objects) with Prepared Statements.
- Frontend: HTML5, Modern CSS3 (utilizing custom variables and Google Fonts).

# --------Setup Instructions-----

##  Database Setup
1. Create the database and tables using phoMyAdmin or MySQL CLI:
     - Import or run the SQL in `database/schema.sql`
  

# ----------Project Structure---------

/project-root
│
├── app/                        # CORE APPLICATION LOGIC
│   ├── Controllers/            # Handles business logic & routing actions
│   │   ├── AdminController.php # Global management (Events & Users)
│   │   ├── AuthController.php  # Login, Signup, and Logout
│   │   └── EventController.php # Dashboard, CRUD, and Join logic
│   │
│   ├── Models/                 # DATABASE INTERACTIONS (SQL Queries)
│   │   ├── EventModel.php      # Data logic for all event tasks
│   │   └── UserModel.php       # Data logic for user and role tasks
│   │
│   └── Views/                  # UI TEMPLATES (HTML/PHP)
│       ├── layout/             # Reusable components
│       │   ├── header.php      # Navigation & Session checks
│       │   └── footer.php      # Script includes & closing tags
│       ├── admin_view.php      # Admin Dashboard (Global Stats)
│       ├── admin_users_view.php# User Management Dashboard
│       ├── auth_view.php       # Shared Login/Signup screen
│       ├── edit_view.php       # Event editing form
│       ├── event_form_view.php # Event creation form
│       ├── index_view.php      # Main User Dashboard
│       └── my_events_view.php  # Personal user bookings
│
├── assets/                     # STATIC RESOURCES (Publicly Linked)
│   ├── css/
│   │   └── style.css           # Premium SaaS-style Dashboard UI
│   └── js/
│       └── script.js           # AJAX and frontend interactions
│
├── config/
│   └── db.php                  # Database Connection Class (PDO)
│
├── database/                   # DATABASE SETUP FILES
│   └── schema.sql              # Database Blueprint & Table structures
│
├── includes/
│   └── functions.php           # Security Helpers (XSS, CSRF, Auth guards)
│
├── public/                     # WEB ROOT (ONLY FOLDER EXPOSED TO WEB)
│   ├── index.php               # Front Controller (Entry Point)
│   └── ajax_search.php         # Standalone AJAX search handler
│
└── README.md                   # Project Documentation & Setup Guide

# ---------Security Implementation-----------

- MVC Pattern: Keeps sensitive logic (app/) outside the web root (public/).
- SQL Injection Prevention: 100% usage of PDO Prepared Statements.
- XSS Protection: All user-generated content is escaped using custom e() helper functions.
- CSRF Protection: Tokens are generated per session to prevent cross-site request forgery.
- Authorization Guards: Controller-level checks (protect_admin, protect_page) prevent unauthorized URL access.
- Password Hashing: Uses industry-standard BCRYPT encryption via PHP password_hash.


# ---------MVC Architecture----------

- Models: EventModel.php and UserModel.php handle all raw SQL queries and data sanitization.
- Views: Decoupled UI templates located in app/Views/. Utilizes a render() helper to pass data from logic to display.
- Controllers:
        AuthController: Manages sessions and security.
        EventController: Handles user-facing CRUD and registration logic.
        AdminController: Oversees global system state and user roles.
        Routing: A "Front Controller" pattern via public/index.php. All requests are routed through a single entry point for centralized security.


# --------Assignment Requirements Met-------

- Full CRUD: Users can Create, Read, Update, and Delete events.
- Search Functionality: Implemented a live AJAX search that filters events by title or category without refreshing the page.
- Security Implementation:
        XSS: Data escaping via a custom e() helper.
        CSRF: Token generation and verification on all POST requests.
        SQL Injection: 100% prevention via PDO Parameter Binding.
        Role-Based Access (RBAC): Admin Panel is strictly protected and hidden from standard users.
        SUser Ownership: Logic implemented to ensure standard users cannot edit or delete events created by others.

# -------------Known Issues-------------

- Image Uploads: The current version is text-based; event banners/images are not yet supported.
- Pagination: As the database grows, the dashboard will continue to list all events on one page (no "Next/Previous" buttons yet).
- Email Notifications: The system uses on-screen "Flash Messages" rather than sending confirmation emails for registrations.
- Session Timeout: Sessions remain active as long as the browser is open; there is no automatic "Inactivity Logout" after a specific time period.

# --- Login Credentials----
   Username: admin
   Password: admin@123

   Username: sara ghimire
   Password: 12345

   Username: Prince Ghimire
   Password: 12345

   Username: amshu
   Password: 12345

# -------------------------------------