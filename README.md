# 🇨🇲 ASCAI Bologna - Sito Web Associazione

Sito web moderno e completo per **ASCAI Bologna** (Associazione Camerun Ascai Italia) costruito con **Laravel 12**, **Blade Templates**, **Inertia.js**, **Vue 3** e **Tailwind CSS**. Un'applicazione full-stack con autenticazione, gestione contenuti (news, eventi, galleria), messaggi di contatto e pannello amministrativo completo.

## ✨ Caratteristiche Principali

### 🌍 Frontend Pubblico
- **Homepage** con logo ASCAI e sezioni home, chi siamo, associati
- 📝 **News/Blog** - Lettura articoli con sistema draft/published
- 📅 **Eventi** - Visualizzazione prossimi e passati con ubicazione
- 🎨 **Galleria Fotografica** - Grid responsive con foto organizzate
- 💬 **Modulo Contatti** - Raccolta messaggi da visitatori
- 🧭 **Navigazione Intuitiva** - Logo rimanda sempre alla home

### 🛡️ Area Amministrativa
- 🔐 **Autenticazione** - Login, registrazione, 2FA, recupero password (Laravel Fortify)
- 📝 **Gestione News** - CRUD completo con status draft/published
- 📅 **Gestione Eventi** - CRUD con status public/private e published/draft
- 🎨 **Gestione Galleria** - CRUD completo foto con upload, modifica, eliminazione
- 💬 **Messaggi Contatti** - Visualizzazione e gestione messaggi ricevuti
- 🎯 **Dashboard Admin** - Pannello di controllo con riepilogo statistiche
- 🔴 **Azioni Inline** - Modifica/Elimina direttamente dalle pagine pubbliche (per admin)

### 🏗️ Architettura Tecnica
- 🛡️ **Sistema Ruoli** - Gestione admin con accesso privilegiato (is_admin flag)
- 📱 **Responsive Design** - Mobile-first con Tailwind CSS
- 🎨 **Logo Personalizzato** - Branding ASCAI integrato
- 🔄 **RESTful API** - Endpoint CRUD per tutte le risorse
- 📋 **Database Robusto** - Enum status, soft/hard relationships, seeding automatico

## 🧭 Scelte architetturali: Blade vs Vue/Inertia (SPA)

| Approccio | Pro | Contro | Quando usarlo |
| --- | --- | --- | --- |
| **Blade (SSR)** | SEO immediato, first-load veloce, semplicità, costi bassi, funziona anche senza JS | Reload pagina, interattività limitata | Siti di contenuto, blog/news, landing, admin semplice |
| **Vue 3 + Inertia (SPA)** | UX fluida senza reload, UI complesse, riuso API | Bundle JS iniziale, SEO più complesso (serve SSR/pre-render), maggiore complessità | Dashboard ricche, real-time, app-like |

🎯 Due Approcci Diversi
1️⃣ Laravel + Blade (Traditional Server-Side Rendering)

Browser → Request → Laravel → Blade Template → HTML → Browser
Blade = Template engine PHP di Laravel
Il server genera HTML per ogni richiesta
Ogni click = reload della pagina
Nessun JavaScript framework richiesto (o jQuery opzionale)
2️⃣ Laravel + Vue 3 + Inertia (Modern SPA)

Browser → Request → Laravel → Inertia → Vue Component → Client-side Render
Vue gestisce tutto il frontend
Il server invia JSON/props a Vue
Nessun reload della pagina (SPA)
File .blade.php NON servono (tranne app.blade.php come shell)

### Scelta per ASCAI Bologna
- Sito **content-driven** (news, eventi, galleria) con SEO importante ⇒ priorità a **Blade SSR**
- Viste pubbliche e admin in Blade; Inertia/Vue resta dove serve (auth/settings)
- Per micro-interazioni: **Alpine.js**; per interattività più ricca senza SPA completa: **Livewire**

## 📋 Prerequisiti

- **PHP** 8.2 o superiore
- **Node.js** 18+ e npm
- **Composer** 2.0+
- **Database** MySQL 8.0+ o PostgreSQL 12+
- **Git** per versionamento

## 🔧 Installazione

### 1️⃣ Clone del Repository
```bash
git clone https://github.com/franksToscani/ascai_blog.git
cd ascai_blog
```

### 2️⃣ Configurazione Ambiente
```bash
cp .env.example .env
php artisan key:generate
```

### 3️⃣ Installazione Dipendenze
```bash
# PHP
composer install

# Node.js
npm install
```

### 4️⃣ Configurazione Database
Modifica il file `.env` con le credenziali del database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ascai_blog
DB_USERNAME=root
DB_PASSWORD=
```

Esegui le migrazioni:
```bash
php artisan migrate
```

### 5️⃣ Avvio Sviluppo
```bash
# Terminal 1: Server PHP (porta 8000)
php artisan serve

# Terminal 2: Vite dev server (porta 5173)
npm run dev
```

Accedi a: `http://localhost:8000`

## 📁 Struttura del Progetto

### Cartelle Principali
```
ascai_blog/
├── app/Http/Controllers/
│   ├── PageController.php           # Home, chi siamo, contatti
│   ├── PostController.php           # CRUD news (draft/published)
│   ├── EventController.php          # CRUD eventi (public/private, draft/published)
│   ├── GalleryPhotoController.php   # CRUD galleria foto
│   ├── ContactMessageController.php # Messaggi contatti
│   └── AdminDashboardController.php # Dashboard admin
│
├── app/Models/
│   ├── User.php              # Users (is_admin, 2FA)
│   ├── Post.php              # Posts (status: draft/published)
│   ├── Event.php             # Events (status, is_public)
│   ├── GalleryPhoto.php       # Foto (is_visible, published_at)
│   └── ContactMessage.php     # Messaggi contatti
│
├── database/migrations/
│   ├── posts_table              # status enum: draft/published
│   ├── events_table             # status enum, is_public boolean
│   ├── gallery_photos_table      # is_visible, published_at
│   ├── contact_messages_table    # Messaggi
│   └── users_table              # is_admin boolean, 2FA fields
│
├── database/seeders/
│   └── DatabaseSeeder.php    # Test data: 2 users, 7 posts, 7 events, 8 photos
│
├── resources/views/
│   ├── pages/
│   │   ├── home.blade.php              # Homepage con logo ASCAI
│   │   ├── chi-siamo.blade.php
│   │   ├── associati.blade.php
│   │   ├── contatti.blade.php
│   │   ├── posts/index.blade.php       # Posts pubblici + modifica/elimina admin
│   │   ├── posts/show.blade.php
│   │   ├── events/index.blade.php      # Events pubblici + modifica/elimina admin
│   │   ├── events/show.blade.php
│   │   └── gallery/index.blade.php     # Galleria pubblica + azioni admin hover
│   │
│   ├── admin/
│   │   ├── dashboard.blade.php         # Dashboard admin
│   │   ├── posts/
│   │   │   ├── index.blade.php         # Lista posts con status badges
│   │   │   ├── create.blade.php        # Form nuovo post
│   │   │   └── edit.blade.php          # Form modifica post
│   │   ├── events/
│   │   │   ├── index.blade.php         # Lista events
│   │   │   ├── create.blade.php        # Form nuovo event
│   │   │   └── edit.blade.php          # Form modifica event
│   │   └── gallery/
│   │       ├── index.blade.php         # Lista foto
│   │       ├── create.blade.php        # Upload foto
│   │       └── edit.blade.php          # Modifica foto
│   │
│   ├── layouts/
│   │   ├── app.blade.php               # Layout dashboard
│   │   ├── public.blade.php            # Layout pubblico
│   │   └── navigation.blade.php        # Top navigation
│   │
│   ├── components/
│   │   └── application-logo.blade.php  # Logo ASCAI
│   │
│   └── auth/                           # Fortify auth views
│
├── routes/
│   ├── web.php                         # Rotte principali
│   │   ├── GET  / → home (logo ASCAI, news, eventi)
│   │   ├── GET  /news → posts pubblici
│   │   ├── GET  /eventi → events pubblici
│   │   ├── GET  /galleria → gallery pubblica
│   │   ├── GET  /chi-siamo, /associati, /contatti
│   │   └── GET  /admin/* → area protetta
│   │
│   ├── auth.php                        # Fortify routes
│   └── settings.php                    # Profilo utente
│
├── public/
│   ├── images/
│   │   └── logoAscai.png              # Logo ASCAI personalizzato
│   └── storage → symlink storage/app/public
│
└── storage/app/public/gallery/        # Foto caricate dagli admin
```

## 📦 Dipendenze Principali

### Backend (PHP)

| Pacchetto | Versione | Descrizione |
|-----------|----------|-------------|
| **laravel/framework** | ^12.0 | Framework PHP web |
| **inertiajs/inertia-laravel** | ^2.0 | Adapter Laravel per Inertia.js |
| **laravel/fortify** | ^1.30 | Autenticazione e 2FA |
| **laravel/tinker** | ^2.10.1 | Interactive shell |
| **laravel/wayfinder** | ^0.1.9 | Utility per routing |

### Frontend (JavaScript/Vue 3)

| Pacchetto | Versione | Descrizione |
|-----------|----------|-------------|
| **vue** | ^3.5.13 | Framework Vue.js |
| **@inertiajs/vue3** | ^2.1.0 | Adapter Vue3 per Inertia.js |
| **tailwindcss** | ^4.1.1 | Utility-first CSS framework |
| **@tailwindcss/forms** | ^0.5.2 | Form styling plugin |
| **lucide-vue-next** | ^0.468.0 | Icon library |
| **reka-ui** | ^2.4.1 | Headless UI components |
| **@vueuse/core** | ^12.8.2 | Vue composition utilities |
| **alpinejs** | ^3.4.2 | Lightweight JavaScript framework |

### Strumenti di Sviluppo

| Pacchetto | Versione | Descrizione |
|-----------|----------|-------------|
| **vite** | ^7.0.4 | Build tool moderno |
| **@vitejs/plugin-vue** | ^6.0.0 | Plugin Vue per Vite |
| **typescript** | ^5.2.2 | Linguaggio TypeScript |
| **tailwindcss-vite** | ^4.1.11 | Plugin Tailwind per Vite |
| **eslint** | ^9.17.0 | Linter JavaScript |
| **prettier** | ^3.4.2 | Code formatter |
| **postcss** | ^8.4.31 | Tool CSS |
| **laravel-vite-plugin** | ^2.0.0 | Plugin Laravel per Vite |

## 📄 Pagine e Componenti

### Pagine Pubbliche
- **Welcome.vue** - Homepage del blog
- **Dashboard.vue** - Dashboard post-login

### Pagine Autenticazione (`auth/`)
- **Login.vue** - Login utente
- **Register.vue** - Registrazione nuovo account
- **ForgotPassword.vue** - Recupero password
- **ResetPassword.vue** - Reset password
- **VerifyEmail.vue** - Verifica email
- **ConfirmPassword.vue** - Conferma password
- **TwoFactorChallenge.vue** - Verifica 2FA

### Pagine Impostazioni (`settings/`)
- **Profile.vue** - Profilo utente
- **Password.vue** - Cambio password
- **Appearance.vue** - Temi e aspetto
- **TwoFactor.vue** - Configurazione 2FA

### Componenti Principali
- **AppShell.vue** - Shell principale dell'app
- **AppLayout.vue** - Layout principale
- **AuthLayout.vue** - Layout autenticazione
- **AppHeader.vue** - Header top
- **AppSidebar.vue** - Sidebar navigazione
- **NavMain.vue** - Menu principale
- **NavUser.vue** - Menu utente

### Componenti UI (`components/ui/`)
Basati su **Reka UI** (headless components):
- Button
- Input
- Select
- Dialog
- Dropdown Menu
- Tooltip
- E altri...

## 📋 Database Schema

### Tabella: users
```
id (PK), name, email, email_verified_at, password, 
remember_token, two_factor_secret, two_factor_recovery_codes,
is_admin (boolean: false=user, true=admin),
created_at, updated_at
```
**Ruoli:** Guest (pubblico) | User (autenticato) | Admin (is_admin = true)

### Tabella: posts
```
id (PK), user_id (FK → users), title, slug, excerpt, content,
status (enum: 'draft' | 'published'),
created_at, updated_at
```
**Funzionalità:** CRUD completo, filtro status, modifica/elimina inline da home (solo admin)

### Tabella: events
```
id (PK), user_id (FK → users), title, description, location,
starts_at (datetime), ends_at (datetime),
is_public (boolean: false=privato, true=pubblico),
status (enum: 'draft' | 'published'),
created_at, updated_at
```
**Funzionalità:** Separazione pubblici/privati, filtro per data, modifica/elimina inline (solo admin)

### Tabella: gallery_photos
```
id (PK), user_id (FK → users), title, caption, image_path,
is_visible (boolean),
published_at (datetime),
created_at, updated_at
```
**Funzionalità:** Upload immagini, modifica metadata, eliminazione con cleanup file storage, hover actions

### Tabella: contact_messages
```
id (PK), name, email, subject, message,
read_at (nullable datetime),
created_at, updated_at
```
**Funzionalità:** Raccolta messaggi modulo contatti pubblico, visualizzazione admin

## 🔐 Autenticazione e Autorizzazione

### Laravel Fortify - Autenticazione Completa
- ✅ **Registrazione** - Nuovi utenti (default is_admin = false)
- ✅ **Login/Logout** - Gestione sessioni sicure
- ✅ **Verifica Email** - Conferma via link
- ✅ **2FA** (Two-Factor Authentication) - TOTP/SMS recovery codes
- ✅ **Recupero Password** - Reset via email
- ✅ **Profilo Utente** - Gestione dati personali

### Sistema Ruoli e Autorizzazione

| Ruolo | Accesso | Permessi |
|-------|---------|----------|
| **Guest** | Pubblico | Lettura news, eventi, galleria, contatti |
| **User** | Autenticato | Dashboard, modifica profilo, 2FA |
| **Admin** | is_admin=true | CRUD completo (posts, events, gallery) + azioni inline su pagine pubbliche |

### Middleware di Protezione
- `auth` - Richiede autenticazione
- `admin` - Richiede is_admin = true
- Protezione CSRF su tutti i form
- Rate limiting su login/register
- Azioni admin inline: modifica/elimina su posts, events, gallery direttamente dalle pagine pubbliche

## 🛠️ Comandi Utili

### Sviluppo e Build
```bash
# Avvia server di sviluppo (Terminal 1)
php artisan serve          # Porta 8000

# Avvia Vite dev server (Terminal 2)
npm run dev                # Porta 5173

# Build per production
npm run build

# Ottimizzazione cache
php artisan optimize
php artisan config:cache
php artisan route:cache

# Pulizia cache
php artisan optimize:clear
```

### Database
```bash
# Esegui migrazioni
php artisan migrate

# Reset + seed (development)
php artisan migrate:fresh --seed

# Rollback migrazioni
php artisan migrate:rollback

# Rollback tutto
php artisan migrate:reset

# Seed database
php artisan db:seed
```

### Code Quality
```bash
# Esegui test
php artisan test
php artisan test --coverage

# Format code
npm run format

# Lint JavaScript
npm run lint

# Interactive shell
php artisan tinker
```

### Gestione File e Storage
```bash
# Crea symbolic link storage
php artisan storage:link

# Pulisci file temporanei
php artisan cache:clear
php artisan view:clear
```

## 🚀 Flusso di Sviluppo

### Setup Iniziale
```bash
# 1. Clone repository
git clone https://github.com/franksToscani/ascai_blog.git
cd ascai_blog

# 2. Environment configuration
cp .env.example .env
php artisan key:generate

# 3. Install dependencies
composer install
npm install

# 4. Database
php artisan migrate:fresh --seed

# 5. Start development (2 terminals)
# Terminal 1
php artisan serve

# Terminal 2
npm run dev

# Accedi a: http://localhost:8000
```

### Feature Development Workflow
```bash
# Crea branch feature
git checkout -b feature/new-feature

# Sviluppa e testa
npm run dev        # Vite watch
php artisan serve  # Server

# Commit changes
git add .
git commit -m "Add new feature"

# Push e PR
git push origin feature/new-feature
```

### Production Deployment
```bash
# Build assets
npm run build

# Cache optimization
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link (se su nuovo server)
php artisan storage:link

# Database migration (se schema changed)
php artisan migrate --force
```

## 📱 Responsive Design

- 📱 **Mobile-First** - Ottimizzato per smartphone (320px+)
- 📱 **Tablet** - Layout adattivo (768px+)
- 💻 **Desktop** - Esperienza completa (1024px+)
- 🌙 **Dark Mode** - Supporto tema scuro/chiaro (dove implementato)
- ⚡ **Performance** - Lazy loading immagini, CSS optimizzato, JS minificato

## 🔍 Testing

```bash
# Esegui unit tests
php artisan test

# Con coverage
php artisan test --coverage
```

## 🤝 Contributi

Per contribuire al progetto:
1. Fork il repository
2. Crea un branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push al branch (`git push origin feature/AmazingFeature`)
5. Apri una Pull Request

## 📝 Licenza

Questo progetto è **privato** e di proprietà personale. Tutti i diritti riservati.

## 👨‍💻 Autore

**Frank Toscani**

---

### 📚 Risorse Utili

- [Laravel Docs](https://laravel.com/docs)
- [Inertia.js](https://inertiajs.com/)
- [Vue 3 Documentation](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Reka UI](https://reka-ui.com/)

### 🆘 Support

Per problemi o domande, apri un issue nel repository." 
