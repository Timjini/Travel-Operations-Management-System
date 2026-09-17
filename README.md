# Travel Operations Management System (TOMS)

A lightweight back-office travel management platform built with **Laravel**. This system streamlines agency workflows by automating booking management, agent assignments, multi-party notifications, invoicing, and payment reminders.

---

## Key Features

- **Booking Management:** Create and organize customer itineraries, destinations, and supplier details.
- **Agent Assignment:** Assign specific bookings to travel agents for streamlined account handling.
- **Invoicing & Proformas:** Instantly generate professional invoices and proforma billing documents in multiple currencies.
- **Multi-Party Notifications:** Automated email and alert notifications sent to:
  - **Customers:** Booking confirmations, proforma/invoice delivery, payment updates.
  - **Agents:** Assignment updates and client activity alerts.
  - **Suppliers:** Booking dispatch details and service requirements.
- **Automated Reminders:** Scheduled task queue (via Laravel Scheduler) to automate payment and schedule alerts.

---

## Tech Stack

- **Framework:** [Laravel](https://laravel.com/) (v10.x / v11.x)
- **Database:** MySQL / PostgreSQL
- **Queue & Scheduling:** Laravel Queues & Cron Task Scheduling
- **PDF Generation:** Dompdf / Snappy (for invoices & proformas)

---
