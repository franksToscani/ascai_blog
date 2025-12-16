# 🇨🇲 ASCAI Bologna - Sito Web Associazione

Sito web moderno e completo per **ASCAI Bologna** (Associazione Camerun Ascai Italia) costruito con **Laravel 12**, **Blade Templates**, **Inertia.js**, **Vue 3** e **Tailwind CSS**. Un'applicazione full-stack con autenticazione, gestione contenuti (news, eventi, galleria), messaggi di contatto e pannello amministrativo completo.

## ✨ Caratteristiche Principali

### 🆕 Aggiornamenti recenti (Dic 2025)
- 👥 **Ownership tracking**: `user_id` su post, eventi e foto con relazioni `belongsTo`
- 📬 **Email async sicure**: invio messaggi contatto in transazione DB + `Mail::queue`
- ⚙️ **Caching homepage**: dati news/eventi/galleria con TTL 1h e cache invalidation su CRUD
- 🚀 **Performance DB**: indici su slug/status/visibilità/date e indice composito eventi
- 🛡️ **Logging completo**: audit per create/update/delete e warning su rate limit contatti
- 🖼️ **Fallback carousel**: gradienti automatici se mancano i banner

### 🌍 Frontend Pubblico
- 🎨 **Hero Carousel** - Slider dinamico con 3 slide auto-rotate, navigazione frecce e dot indicators, transizioni fluide
- 🧭 **Navigation Moderna** - Sticky header con Alpine.js, menu mobile responsive, icone SVG, stati attivi
- 👣 **Footer Completo** - Logo ASCAI, info contatti, social media icons (Facebook, Instagram, TikTok, X, WhatsApp), link admin
- **Homepage** con logo ASCAI e sezioni home, chi siamo, associati
- 📝 **News/Blog** - Lettura articoli con sistema draft/published, ricerca e filtri
- 📅 **Eventi** - Visualizzazione prossimi e passati con ubicazione, ricerca e filtri
- 🎨 **Galleria Fotografica** - Grid responsive con foto organizzate, lazy loading nativo
- 💬 **Modulo Contatti** - Raccolta messaggi con ottimizzazione mobile, rate limiting 5 msg/24h per IP
- 📧 **Notifiche Email** - Admins ricevono email automatiche su nuovi messaggi di contatto

### 🛡️ Area Amministrativa
- 🔐 **Autenticazione** - Login, registrazione, 2FA, recupero password (Laravel Fortify)
- 📝 **Gestione News** - CRUD completo con status draft/published
- 📅 **Gestione Eventi** - CRUD con status public/private e published/draft
- 🎨 **Gestione Galleria** - CRUD completo foto con upload, modifica, eliminazione
- 💬 **Messaggi Contatti** - Visualizzazione e gestione messaggi ricevuti
- 🎯 **Dashboard Admin** - Pannello di controllo con riepilogo statistiche, audit log filtering
- 🔴 **Azioni Inline** - Modifica/Elimina direttamente dalle pagine pubbliche (per admin)
- 📊 **Audit Log** - Tracciamento completo di tutte le modifiche (creazione, modifica, eliminazione) con filtri avanzati

### 🏗️ Architettura Tecnica
- 🛡️ **Sistema Ruoli** - Gestione admin con accesso privilegiato (is_admin flag)
- 📱 **Responsive Design** - Mobile-first con Tailwind CSS
- ⚡ **Alpine.js** - Micro-framework per interattività (carousel autoplay, mobile menu, transitions)
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
│   ├── PostController.php           # CRUD news (draft/published), ricerca
│   ├── EventController.php          # CRUD eventi (public/private, draft/published), ricerca
│   ├── GalleryPhotoController.php   # CRUD galleria foto
│   ├── ContactMessageController.php # Messaggi contatti, rate limiting, email notifications
│   └── AdminDashboardController.php # Dashboard admin, audit log filtering
│
├── app/Models/
│   ├── User.php              # Users (is_admin, 2FA)
│   ├── Post.php              # Posts (status: draft/published, slug, searchable)
│   ├── Event.php             # Events (status, is_public, slug, searchable)
│   ├── GalleryPhoto.php       # Foto (is_visible, published_at, lazy loadable)
│   ├── ContactMessage.php     # Messaggi contatti (rate limited)
│   └── AuditLog.php          # Audit trail di tutte le modifiche
│
├── app/Mail/
│   └── NewContactMessageNotification.php  # Email su nuovi messaggi
│
├── database/migrations/
│   ├── posts_table              # status enum: draft/published
│   ├── events_table             # status enum, is_public boolean
│   ├── gallery_photos_table      # is_visible, published_at
│   ├── contact_messages_table    # Messaggi, read_at timestamp
│   ├── audit_logs_table          # Tracciamento modifiche
│   └── users_table              # is_admin boolean, 2FA fields
│
├── database/seeders/
│   └── DatabaseSeeder.php    # Test data: 2 admin users, 1 user, 7 posts, 7 events, 8 photos
│
├── resources/views/
│   ├── pages/
│   │   ├── home.blade.php              # Homepage con logo ASCAI
│   │   ├── chi-siamo.blade.php
│   │   ├── associati.blade.php
│   │   ├── contatti.blade.php          # Modulo contatti ottimizzato mobile
│   │   ├── posts/index.blade.php       # Posts pubblici + ricerca + modifica/elimina admin
│   │   ├── posts/show.blade.php
│   │   ├── events/index.blade.php      # Events pubblici + ricerca + modifica/elimina admin
│   │   ├── events/show.blade.php
│   │   └── gallery/index.blade.php     # Galleria pubblica con lazy loading + azioni admin
│   │
│   ├── admin/
│   │   ├── dashboard.blade.php         # Dashboard admin con audit log
│   │   ├── audit-log.blade.php         # Audit log dettagliato con filtri
│   │   ├── messages.blade.php          # Messaggi contatti ricevuti
│   │   ├── posts/
│   │   │   ├── index.blade.php         # Lista posts con ricerca e status badges
│   │   │   ├── create.blade.php        # Form nuovo post
│   │   │   └── edit.blade.php          # Form modifica post
│   │   ├── events/
│   │   │   ├── index.blade.php         # Lista events con ricerca
│   │   │   ├── create.blade.php        # Form nuovo event
│   │   │   └── edit.blade.php          # Form modifica event
│   │   └── gallery/
│   │       ├── index.blade.php         # Lista foto con lazy loading
│   │       ├── create.blade.php        # Upload foto
│   │       └── edit.blade.php          # Modifica foto
│   │
│   ├── emails/
│   │   └── new-contact-message.blade.php  # Email template per notifiche messaggi
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
│   │   ├── GET  /news → posts pubblici (con ricerca)
│   │   ├── GET  /eventi → events pubblici (con ricerca)
│   │   ├── GET  /galleria → gallery pubblica (con lazy loading)
│   │   ├── GET  /chi-siamo, /associati, /contatti
│   │   ├── POST /contatti → salva messaggio + invia email admin + rate limit
│   │   └── GET  /admin/* → area protetta (audit log, CRUD)
│   │
│   ├── auth.php                        # Fortify routes
│   └── settings.php                    # Profilo utente
│
├── public/
│   ├── images/
│   │   ├── logoAscai.svg              # Logo ASCAI personalizzato (SVG)
│   │   ├── banner0.jpg, banner1.jpg, banner2.jpg  # Banner carousel homepage
│   │   └── logoAscai.png              # Logo ASCAI (legacy)
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

## 🧪 Testing e Credenziali di Sviluppo

### Account di Test (seeder)
```
Admin ASCAI (Originale):
  Email: admin@ascai.it
  Password: (generato da factory)
  
Test Admin (Per test):
  Email: testadmin@ascai.it
  Password: password
  
Test User (Utente standard):
  Email: test@example.com
  Password: (generato da factory)
```

### Comandi Test
```bash
# Setup completo per testing
php artisan migrate:fresh --seed

# Esegui unit tests
php artisan test

# Con coverage
php artisan test --coverage

# Interactive shell per debug
php artisan tinker
```

## 🚀 Sprint 1 - Feature Completate

### ✅ Novembre 2025 - Foundation & Core Features
- [x] Setup Laravel 12 con Fortify authentication
- [x] Struttura database (Users, Posts, Events, Gallery, ContactMessages)
- [x] Seeding automatico con test data (2 admin, 1 user, 7 posts, 7 events, 8 photos)
- [x] Layout pubblico con logo ASCAI e navigation
- [x] CRUD News (PostController + views pubbliche/admin)
- [x] CRUD Eventi con is_public e status (EventController)
- [x] CRUD Galleria con upload/delete immagini (GalleryPhotoController)
- [x] Modulo Contatti con raccolta messaggi (ContactMessageController)

### ✅ Dicembre 2025 - UI/UX Enhancements
- [x] **Hero Carousel** - Slider dinamico homepage con Alpine.js
  - 3 slide auto-rotate (5s intervalli)
  - Navigazione frecce prev/next con hover effects
  - Dot indicators per navigazione diretta
  - Transizioni fluide con fade e translate
  - Responsive: 2-colonne desktop, stack mobile
  - Gradient backgrounds personalizzabili (ready per immagini)
  - Altezza ottimizzata 380px con border-radius professionale
- [x] **Navigation Moderna** - Sticky header responsive
  - Alpine.js mobile menu con hamburger toggle
  - Icone SVG per ogni sezione (Home, Eventi, News, Galleria)
  - Active states dinamici con `request()->routeIs()`
  - Shadow dinamico on scroll
  - Logo con hover glow effect
  - CTA button gradient per Contatti
- [x] **Footer Completo** - Unified footer per tutto il sito
  - Logo ASCAI header con brand name
  - 2-colonne layout: "Dove siamo" + "Contatti"
  - Social media icons: Facebook, Instagram, TikTok, X, WhatsApp
  - Brand-specific hover colors (blu Facebook, gradient Instagram, etc.)
  - Link admin area nel copyright
  - Gradient slate background con pattern SVG
  - Applicato a layouts.app e layouts.public

### ✅ Dicembre 2025 - Security & UX Polish (Priority 1-3)
- [x] **URL SEO** - Implementazione slug route model binding (posts e events accessible via /posts/{slug})
- [x] **Paginazione** - Posts (15/pagina), Events (15/pagina), Gallery (12/pagina) in tutte le views
- [x] **Rate Limiting** - Protezione form contatti: max 5 messaggi per IP / 24 ore con cache
- [x] **Audit Logging** - Tracciamento completo (creazione, modifica, eliminazione) con AuditLog model e middleware
- [x] **Audit Dashboard** - View admin con filtri avanzati (model type, action, user, date range)
- [x] **Search/Filter** - Ricerca full-text su Posts e Events (title, description) in views pubbliche e admin
- [x] **Email Notifications** - Mailable class + template blade, invia email a TUTTI gli admin su nuovo messaggio contatto
- [x] **Lazy Loading** - Attributo nativo `loading="lazy"` su galleria (public + admin)
- [x] **Mobile Optimization** - Responsive Tailwind classes (sm: breakpoints) su contact form e tutti gli elementi

### 📊 Sprint 1 Metrics
- **Commits:** 14 commits di feature + fixes
- **Files Modified:** 45+ files
- **Database Migrations:** 11 migration files
- **Models:** 6 models (User, Post, Event, GalleryPhoto, ContactMessage, AuditLog)
- **Controllers:** 7 controllers
- **Views:** 30+ blade templates
- **Test Data:** Seeder con 18 record di test (users, posts, events, photos)

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

### code sendgrid pour le service mail en cas de perte de mon phone: TFUQEH9XAYLXWS6Y2M98R4JB
