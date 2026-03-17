<div class="filament-hidden">

![HelpDeskKit v5](https://raw.githubusercontent.com/jeffersongoncalves/helpdeskkitv5/main/art/jeffersongoncalves-helpdeskkitv5.png)

</div>

# HelpDeskKit — Start Kit Filament 5.x and Laravel 13.x

## About HelpDeskKit

HelpDeskKit is a robust starter kit built on Laravel 13.x and Filament 5.x, designed to accelerate the development of help desk and support ticket applications with a ready-to-use multi-panel structure and integrated ticket management.

## Features

- **Laravel 13.x** — The latest version of the most elegant PHP framework
- **Filament 5.x** — Powerful and flexible admin framework
- **Help Desk System** — Full ticket management powered by [filament-help-desk](https://github.com/jeffersongoncalves/filament-help-desk)
    - Ticket creation, assignment, comments, attachments, and history
    - Departments, categories, canned responses, and email channels
    - Priority and status workflows with bulk actions
- **Multi-Panel Structure** — Includes four pre-configured panels:
    - Admin Panel (`/admin`) — System administration and help desk oversight
    - Operator Panel (`/operator`) — Support agents managing tickets
    - App Panel (`/app`) — End users creating and tracking tickets
    - Guest Panel — Public-facing interface for visitors
- **Multi-Auth Guard** — Three independent authentication guards:
    - `admin` — Admin model with full system access
    - `operator` — Operator model for support agents
    - `web` — User model for application users
- **Environment Configuration** — Centralized configuration through the `config/helpdeskkit.php` file

## System Requirements

- PHP 8.3 or higher
- Composer
- Node.js and PNPM

## Installation

Clone the repository
``` bash
laravel new my-app --using=jeffersongoncalves/helpdeskkitv5 --database=mysql
```

### Using FilaKit CLI

Or use [FilaKit CLI](https://github.com/jeffersongoncalves/filakit-cli) for a simplified setup:

```bash
filakit new my-app --kit=jeffersongoncalves/helpdeskkitv5
```

> Install FilaKit CLI: `composer global require jeffersongoncalves/filakit-cli`

###  Easy Installation

helpdeskkit can be easily installed using the following command:

```bash
php install.php
```

This command automates the installation process by:
- Installing Composer dependencies
- Setting up the environment file
- Generating application key
- Setting up the database
- Running migrations
- Installing Node.js dependencies
- Building assets
- Configuring Herd (if used)

### Manual Installation

Install JavaScript dependencies
``` bash
pnpm install
```
Install Composer dependencies
``` bash
composer install
```
Set up environment
``` bash
cp .env.example .env
php artisan key:generate
```

Configure your database in the .env file

Run migrations
``` bash
php artisan migrate
```
Run the server
``` bash
php artisan serve
```

## Installation with Docker

Clone the repository
```bash
laravel new my-app --using=jeffersongoncalves/helpdeskkitv5 --database=mysql
```

Move into the project directory
```bash
cd my-app
```

Install Composer dependencies
```bash
composer install
```

Set up environment
```bash
cp .env.example .env
```

Configuring custom ports may be necessary if you have other services running on the same ports.

```bash
# Application Port (ex: 8080)
APP_PORT=8080

# MySQL Port (ex: 3306)
FORWARD_DB_PORT=3306

# Redis Port (ex: 6379)
FORWARD_REDIS_PORT=6379

# Mailpit Port (ex: 1025)
FORWARD_MAILPIT_PORT=1025
```

Start the Sail containers
```bash
./vendor/bin/sail up -d
```
You won’t need to run `php artisan serve`, as Laravel Sail automatically handles the development server within the container.

Attach to the application container
```bash
./vendor/bin/sail shell
```

Generate the application key
```bash
php artisan key:generate
```

Install JavaScript dependencies
```bash
pnpm install
```

## Authentication Structure

HelpDeskKit comes pre-configured with a multi-guard authentication system that supports three types of users:

- `Admin` — Full administrative access, help desk oversight, user/operator management (`/admin`)
- `Operator` — Support agent access, ticket management and assignment (`/operator`)
- `User` — End-user access, ticket creation and tracking (`/app`)

Each guard uses its own database table, model, login page, and password reset flow.

## Development

``` bash
# Run the development server with logs, queues and asset compilation
composer dev

# Or run each component separately
php artisan serve
php artisan queue:listen --tries=1
pnpm run dev
```

## Customization

### Panel Configuration

Panels can be customized through their respective providers:

- `app/Providers/Filament/AdminPanelProvider.php`
- `app/Providers/Filament/OperatorPanelProvider.php`
- `app/Providers/Filament/AppPanelProvider.php`
- `app/Providers/Filament/GuestPanelProvider.php`

Each panel can be enabled or disabled in `config/helpdeskkit.php`.

### Themes and Colors

Each panel can have its own color scheme, which can be easily modified in the corresponding Provider files or in the
`helpdeskkit.php` configuration file.

### Configuration File

The `config/helpdeskkit.php` file centralizes the configuration of the starter kit, including:

- Panel routes
- Middleware for each panel
- Branding options (logo, colors)
- Authentication guards

## Help Desk — jeffersongoncalves/filament-help-desk

HelpDeskKit includes a full-featured help desk system powered by [filament-help-desk](https://github.com/jeffersongoncalves/filament-help-desk):

- **User Panel (`/app/tickets`)** — End users create tickets, track status, and view responses
- **Operator Panel (`/operator/tickets`)** — Support agents manage assigned tickets, change status/priority, add comments
- **Admin Panel (`/admin/tickets`)** — Administrators oversee all tickets, departments, categories, and settings

### Help Desk Features

- Ticket creation with departments and categories
- Ticket assignment to operators
- Comments and attachments
- Status and priority workflows
- Ticket history and audit trail
- Canned responses
- Email channel integration (Mailgun, Postmark, Resend, SendGrid)
- Bulk actions (assign, change status, change priority)

### Configuration

- `config/help-desk.php` — Core help desk settings (models, tables, features)
- `config/filament-help-desk.php` — Filament UI settings (navigation, slugs, icons)

## User Profile — joaopaulolndev/filament-edit-profile

This project comes with the Filament Edit Profile plugin integrated for all panels (Admin, Operator, and App). It adds a complete profile editing page with avatar, language, theme color, security (tokens, MFA), browser sessions, and email/password change.

- Routes (defaults in this project):
  - Admin: /admin/my-profile
  - Operator: /operator/my-profile
  - App: /app/my-profile
- Navigation: by default, the page does not appear in the menu (shouldRegisterNavigation(false)). If you want to show it in the sidebar menu, change it to true in the panel provider.

Where to configure
- Panel providers
  - Admin: app/Providers/Filament/AdminPanelProvider.php
  - Operator: app/Providers/Filament/OperatorPanelProvider.php
  - App: app/Providers/Filament/AppPanelProvider.php
  In these files you can adjust:
  - ->slug(‘my-profile’) to change the URL (e.g., ‘profile’)
  - ->setTitle(‘My Profile’) and ->setNavigationLabel(‘My Profile’)
  - ->setNavigationGroup(‘Group Profile’), ->setIcon(‘heroicon-o-user’), ->setSort(10)
  - ->shouldRegisterNavigation(true|false) to show/hide it in the menu
  - Shown forms: ->shouldShowEmailForm(), ->shouldShowLocaleForm([...]), ->shouldShowThemeColorForm(), ->shouldShowSanctumTokens(), ->shouldShowMultiFactorAuthentication(), ->shouldShowBrowserSessionsForm(), ->shouldShowAvatarForm()

- General settings: config/filament-edit-profile.php
  - locales: language options available on the profile page
  - locale_column: column used in your model for language/locale (default: locale)
  - theme_color_column: column for theme color (default: theme_color)
  - avatar_column: avatar column (default: avatar_url)
  - disk: storage disk used for the avatar (default: public)
  - visibility: file visibility (default: public)

Migrations and models
- The required columns are already included in this kit’s default migrations (users, admins, and operators): avatar_url, locale and theme_color, using the names defined in config/filament-edit-profile.php.
- The App\Models\User, App\Models\Admin, and App\Models\Operator models already read the avatar using the plugin configuration (getFilamentAvatarUrl).

Avatar storage
- Make sure the filesystem disk is configured and that the storage link exists:
  php artisan storage:link
- Adjust the disk and visibility in the config file according to your infrastructure.

Quick access
- Via direct URL: /admin/my-profile, /operator/my-profile, or /app/my-profile
- To make it visible in the sidebar navigation, set shouldRegisterNavigation(true) in the respective Provider.

Reference
- Plugin repository: https://github.com/joaopaulolndev/filament-edit-profile

## Default Credentials

After running `php artisan db:seed`, use these credentials:

| Panel | URL | Email | Password |
|-------|-----|-------|----------|
| Admin | `/admin` | `admin@helpdeskkit.com` | `password` |
| Operator | `/operator` | `operator@helpdeskkit.com` | `password` |
| App | `/app` | `user@helpdeskkit.com` | `password` |

## Resources

HelpDeskKit includes support for:

- User, admin, and operator management
- Multi-guard authentication system (3 guards)
- Help desk ticket system with full lifecycle management
- Tailwind CSS 4.x integration
- Database queue configuration
- Customizable panel routing and branding

## License

This project is licensed under the [MIT License](LICENSE).

## Credits

Developed by [Jefferson Gonçalves](https://github.com/jeffersongoncalves).
