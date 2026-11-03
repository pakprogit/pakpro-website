# PAKPRO Website — Laravel 11 + Filament 3 Admin

## Overview

This is the PAKPRO Kenya public website and staff administration panel, built with:

- **Laravel 11** (PHP 8.3+)
- **Filament 3** admin panel at `/admin`
- **Spatie** packages: permission, activitylog, medialibrary, backup
- **MariaDB / MySQL** — database `pakpro_prototype`

> **"My PAKPRO login"** on the public homepage links directly to `/admin` — staff log in there to manage all content.

---

## Quick Start (Local XAMPP Development)

### Requirements

- XAMPP with PHP 8.3 at `C:\xampp\pakpro-runtime\php83\php.exe`
- MariaDB at `localhost:3306`
- Composer phar at `C:\xampp\htdocs\fts_new\composer.phar`

### Step 1 — Configure .env

Copy `.env.example` to `.env` and update:

```env
APP_URL=http://pakpro.local        # or http://localhost:8000 for artisan serve
DB_DATABASE=pakpro_prototype
DB_USERNAME=root
DB_PASSWORD=
MAIL_MAILER=log                    # use smtp/ses in production
```

### Step 2 — Install dependencies

```powershell
$env:PATH = "C:\xampp\pakpro-runtime\php83;$env:PATH"
php C:\xampp\htdocs\fts_new\composer.phar install --no-interaction
```

### Step 3 — Generate application key

```powershell
$env:PATH = "C:\xampp\pakpro-runtime\php83;$env:PATH"
cd C:\xampp\htdocs\pakpro-website
php artisan key:generate
```

### Step 4 — Run migrations and seed

```powershell
php artisan migrate
php artisan db:seed
```

This creates:
- All database tables (prices, highlights, site_settings, etc.)
- Three Spatie roles: **Administrator**, **Communications editor**, **Price editor**
- 15 recycled material prices (no publication row — public shows "Date to be confirmed")
- 9 placeholder highlights (3 per tab, not shown on public site)
- Homepage site settings (hero, marquee, counters, contact)
- Two seed admin users (update passwords immediately):
  - `admin@pakpro.local` / `password`
  - `franklin.okoth@pakpro.co.ke` / `password`

### Step 5 — Create a storage link

```powershell
php artisan storage:link
```

### Step 6 — Start the dev server

```powershell
$env:PATH = "C:\xampp\pakpro-runtime\php83;$env:PATH"
cd C:\xampp\htdocs\pakpro-website
php artisan serve --port=8000
```

**Access:**
- 🌐 Public website: http://127.0.0.1:8000/
- 🔐 Admin panel: http://127.0.0.1:8000/admin

### Step 7 (Optional) — Apache virtual host (clean URLs without port)

Add to `C:\xampp82\apache\conf\extra\httpd-vhosts.conf` (already done):

```apache
<VirtualHost *:80>
    ServerName pakpro.local
    DocumentRoot "C:/xampp82/htdocs/pakpro-website/public"
    <Directory "C:/xampp82/htdocs/pakpro-website/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Add to `C:\Windows\System32\drivers\etc\hosts` (**run Notepad as Administrator**):

```
127.0.0.1   pakpro.local
```

Then restart Apache and visit http://pakpro.local

---

## Creating the First Administrator

The seed creates two admins. To create a new admin from scratch:

```powershell
php artisan tinker
```

```php
$user = App\Models\User::create([
    'name'          => 'Your Name',
    'email'         => 'you@pakpro.co.ke',
    'username'      => 'yourusername',
    'password'      => bcrypt('YourStrongPassword123!'),
    'password_hash' => bcrypt('YourStrongPassword123!'),
    'role'          => 'admin',
    'is_active'     => true,
]);
$user->assignRole('Administrator');
```

---

## Roles and Permissions

| Area | Administrator | Communications editor | Price editor |
|---|:---:|:---:|:---:|
| Prices | ✓ | ✓ | ✓ |
| Highlights | ✓ | ✓ | ✗ |
| Homepage settings | ✓ | ✓ | ✗ |
| Forms inbox | ✓ | ✓ (no grievances) | ✗ |
| Users & roles | ✓ | ✗ | ✗ |
| Audit log | ✓ | ✗ | ✗ |
| Grievance reports | ✓ (with permission) | ✗ | ✗ |

> **Minimum 2 active Administrators must exist at all times.** The system blocks deactivation or demotion of the last administrator.

---

## Running the Scheduler (Windows Task Scheduler)

The scheduler runs daily checks:
- Alerts admins if prices haven't been published in 30+ days

**Setup in Task Scheduler:**

1. Open Task Scheduler → Create Basic Task
2. Name: `PAKPRO Laravel Scheduler`
3. Trigger: Daily, repeat every 1 minute for 1 day
4. Action: Start a program
   - Program: `C:\xampp\pakpro-runtime\php83\php.exe`
   - Arguments: `C:\xampp\htdocs\pakpro-website\artisan schedule:run`
   - Start in: `C:\xampp\htdocs\pakpro-website`

Or run manually to test:

```powershell
$env:PATH = "C:\xampp\pakpro-runtime\php83;$env:PATH"
cd C:\xampp\htdocs\pakpro-website
php artisan schedule:run
php artisan pakpro:check-prices  # test the price staleness check
```

---

## Backups

Backups use `spatie/laravel-backup`. Configure in `config/backup.php` and `.env`:

```env
BACKUP_DISK=local   # or s3/sftp for off-site
```

Run manually:

```powershell
php artisan backup:run
php artisan backup:list
```

Schedule daily backups by adding to `routes/console.php`:

```php
Schedule::command('backup:run')->daily()->at('02:00');
```

---

## Admin Features

### Dashboard
- Live stats: prices last updated, highlights this month, forms waiting, active users
- **Needs attention** panel — flags stale prices, empty highlight tabs, unset publish date
- Quick actions: Update prices, Add highlight, Change hero video
- Recent audit log entries

### Prices (`/admin/prices`)
- Edit all 15 recycled material prices inline
- **Save and publish** → confirmation dialog → creates snapshot → clears public cache → emails admins
- Import from Excel/CSV with row-level validation
- Export to Excel
- Publication history with "Before you publish" checklist

### Highlights (`/admin/highlights`)
- Three tabs: Policy | Projects & Partnerships | BCC Campaigns
- Month picker — warns if any tab is empty for the selected month
- Image uploads (JPG/PNG/WebP, max 5MB) or video (MP4/WebM, max 5MB, 720p)
- For larger videos: use a YouTube/Vimeo link instead

### Homepage (`/admin/homepage`)
- Hero: video, poster, eyebrow, headline, body, two buttons
- Marquee ticker items (repeater)
- Counters (repeater: number, prefix, suffix, label)
- Contact details: phone, email, WhatsApp, address, office hours

### Users & Roles (`/admin/users`)
- Invite users by email — 48-hour signed invitation link
- Role assignment: Administrator, Communications editor, Price editor
- Deactivate without deleting history
- Two-factor authentication status display

### Audit Log (`/admin/audit-log`)
- Read-only, immutable audit trail
- Filter by user, area, date
- No entries can be edited or deleted by anyone

---

## Public Website

The public website at `/` is server-rendered from the database:

- **"My PAKPRO login"** in the top bar → `/admin` (Filament login)
- **Price ticker** and table: from `prices` table; "Last updated" from latest `price_publications` row
- **Highlights tabs**: accessible ARIA tablist, arrow-key navigation, URL hash navigation
- **Hero, counters, contact**: from `site_settings` table
- **Cache**: all public data is cached; cleared automatically when admin saves changes

---

## Running Tests

```powershell
$env:PATH = "C:\xampp\pakpro-runtime\php83;$env:PATH"
cd C:\xampp\htdocs\pakpro-website
php artisan test
```

**Test coverage:**
- `RolePermissionTest` — Price editor gets 403 on Highlights and Users
- `PricePublishTest` — publication creates snapshot, clears cache
- `PublicWebsiteTest` — homepage renders with correct login link; honeypot blocks bots
- `UserProtectionTest` — minimum 2 admins enforced; invitation expiry returns 410

---

## Environment Variables Reference

```env
APP_NAME="PAKPRO Admin"
APP_ENV=local
APP_KEY=                          # generated by php artisan key:generate
APP_DEBUG=true
APP_URL=http://pakpro.local

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pakpro_prototype
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=database
QUEUE_CONNECTION=database

MAIL_MAILER=log                   # smtp in production
MAIL_FROM_ADDRESS="noreply@pakpro.co.ke"
MAIL_FROM_NAME="PAKPRO"

# Optional
ALLOW_PLACEHOLDER_HIGHLIGHTS_ON_PUBLIC=false
```

---

## Deployment Checklist (Production)

- [ ] Set `APP_ENV=production`, `APP_DEBUG=false`
- [ ] Set `APP_URL` to actual domain (e.g. `https://pakpro.co.ke`)
- [ ] Configure SMTP mail (`MAIL_MAILER=smtp`)
- [ ] Set up off-site backup disk in `config/backup.php`
- [ ] Run `php artisan config:cache && php artisan route:cache && php artisan view:cache`
- [ ] Set up cron for scheduler (every minute)
- [ ] Ensure HTTPS — Filament uses secure cookies in production automatically
- [ ] Change all seed passwords immediately
- [ ] Enable two-factor authentication for all admin users
- [ ] Verify `storage/` and `bootstrap/cache/` are writable by web server

---

## Git Workflow

All admin work is on the `feature/website-admin` branch:

```powershell
git checkout feature/website-admin
git add .
git commit -m "feat: description of change"
git push origin feature/website-admin
```

Do **not** commit `.env` — it is in `.gitignore`.

