# fleet-maintenance-system
Full-stack web application for vehicle fleet tracking, maintenance scheduling, and role-based operational logs built with PHP and MySQL.

---

## Overview
Managing vehicle fleets and maintenance schedules manually often leads to missed inspection dates, disorganized service records, and data duplication. This project provides a centralized, web-based platform to streamline vehicle asset tracking, monitor ongoing maintenance routines, and maintain clean audit logs for fleet operations.

---

## Key Features
* **Vehicle Asset Tracking:** Create, read, update, and manage vehicle fleet records (plates, make, model, year, operational status).
* **Maintenance & Service Logging:** Track scheduled preventative maintenance, fluid replacements, and mechanical repairs.
* **Role-Based Access Control (RBAC):** Distinct workflows and access levels for administrators and operators to safeguard data integrity.
* **Data Integrity & Validation:** Client-side input validation and sanitized backend queries to prevent erroneous or incomplete data entry.

---

## Tech Stack
* **Backend:** PHP
* **Database:** MySQL / MariaDB
* **Frontend:** HTML5, CSS3, JavaScript
* **Environment:** Apache (XAMPP / Local Server)

---

## Database Architecture
The application relies on a normalized relational schema structured around core entities:
* `users` (credentials, role assignments)
* `vehicles` (identifiers, technical specs, status)
* `maintenance_logs` (service records, costs, timestamps, assigned technician/operator)

*(Optional: Insert an ER diagram or schema snapshot here if available)*
