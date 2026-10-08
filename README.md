# Barbucks Bar

Barbucks Bar is a web app for running a bar or nightclub's drinks menu, pricing and stock. Staff can see what is available and at what price, while managers control beers, liquor, shooters and bottle service packages and track inventory and sales from an admin dashboard.

## Business idea

Bars lose money through untracked stock, inconsistent pricing between outlets and slow manual stock-taking. Barbucks Bar gives owners one place to control their drinks business:

- **One price list** for beers, liquor and shooters across every bar or outlet.
- **Bottle service packages** for regular nights, night service and pre-sales, so premium tables are priced and sold consistently.
- **Bar rolls** that show what each bar has and sells.
- **Inventory and sales tracking** so managers can spot losses and restock on time.

## Key features

- Staff login and logout
- Menus for beers, liquor and shooters, with per-bar views
- Bottle service, night bottle service and pre-sales bottle service pages
- Bar roll views per bar
- Admin dashboard to:
  - add, edit and delete beers and liquors
  - manage inventory
  - record and review beer sales
  - manage admin accounts and passwords
- AJAX actions with instant feedback (SweetAlert, toasts)

## Tech stack

- **Backend:** PHP
- **Database:** MySQL (schema in `barbucks.sql`)
- **Frontend:** HTML, CSS, Bootstrap, jQuery, DataTables, Owl Carousel, AOS

## Project structure

```
index.php, beers.php, liquor.php, shooters.php     # Drinks menus
bottle_service*.php, night_bottle_service.php       # Bottle service packages
barroll.php, barrolls_bars.php                      # Bar rolls
admin/                                              # Admin dashboard
admin/ajax_controls/                                # Admin AJAX endpoints
includes/, lib/, styles/, assets/                   # Shared layout, libraries, images
```

## Getting started

1. Install a PHP and MySQL stack such as XAMPP or WAMP.
2. Copy the project into your web server folder.
3. Create a MySQL database and import `barbucks.sql`.
4. Update the database connection settings.
5. Open the site in your browser and sign in.
