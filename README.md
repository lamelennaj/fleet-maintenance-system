# fleet-maintenance-system
Web application developed with PHP and MySQL/MariaDB to manage vehicle parking status, maintenance records, and user access levels.

---

## Overview
A web-based database project designed to replace manual vehicle logs. It allows managing vehicle records, logging maintenance services performed by technicians, and restricting interface actions based on user roles.

---

## Key Features
* **Vehicle Management:** Register, update, and view parked vehicles and vehicle records.
* **Maintenance Logs:** Track service history, maintenance notes, and dates linked to specific vehicles.
* **User Roles:** Differentiated access and views for administrators and workshop mechanics.
* **Frontend Forms:** HTML/CSS interface with input validation for service and vehicle data entry.

---

## Tech Stack
* **Backend:** PHP
* **Database:** MySQL / MariaDB
* **Frontend:** HTML, CSS, JavaScript
* **Local Server:** XAMPP (Apache)

---

## Database Tables
The database (`estacionamiento_db`) contains three main related tables:
* `usuarios`: Stores usernames, passwords, and role designations (`admin`, `mecanico_a`, `mecanico_b`).
* `coches`: Stores vehicle information and status.
* `mantenimientos`: Stores service history linked to vehicles via foreign key (`id_coche`).

---

## Setup & Running Locally

1. Place the project folder inside your local server directory: `C:/xampp/htdocs/parking`
2. Open your MySQL/MariaDB client and import the database file: `database/schema.sql`
3. Start Apache and MySQL in XAMPP.
4. Open your browser and navigate to: `http://localhost/parking`

---

## Demo Accounts

Pre-configured test credentials included in `schema.sql`:

| Role | Username | Password | Access Scope |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin_mario` | `123456` | Full administrative access and vehicle/service logs |
| **Mechanic (Zone A)** | `mecanico_armando` | `123456` | Maintenance logging and service forms |
| **Mechanic (Zone B)** | `mecanico_benito` | `123456` | Maintenance logging and service forms |
