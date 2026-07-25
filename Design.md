# KD Polytechnic Alumni Portal - Design System & UI Specification

## Overview
This document defines the official UI/UX design system and frontend architecture for the **KD Polytechnic Alumni Portal**. Designed for a 3-person development team using HTML5, Tailwind CSS, Alpine.js, and Laravel Blade, this guide serves as the definitive reference for maintaining a professional, academic, and modern institutional aesthetic.

**Core Constraint:** All styling must be achieved using standard Tailwind CSS utility classes. Custom CSS is strictly prohibited unless formally approved.

---

## 1. Brand Identity & Color Palette

To project a trustworthy, official, and academic tone, we use a classic **Deep Blue** as our primary brand color, paired with clean **Whites** and **Slate Grays** to ensure readability and focus.

### Tailwind Color Scales

| Category | Role / Usage | Tailwind Class | Hex Reference |
| :--- | :--- | :--- | :--- |
| **Primary Brand** | Main actions, headers, primary buttons, active links | `bg-blue-700` (Hover: `blue-800`) | `#1d4ed8` |
| **Secondary/Accent** | Highlights, secondary actions, soft backgrounds | `bg-sky-600` / `bg-sky-50` | `#0284c7` / `#f0f9ff` |
| **Backgrounds** | Application background (body) | `bg-slate-50` | `#f8fafc` |
| | Card / Container backgrounds | `bg-white` | `#ffffff` |
| **Text (Dark)** | H1/H2 Headings, emphasized text | `text-slate-900` | `#0f172a` |
| **Text (Body)** | Standard paragraph text, labels | `text-slate-600` | `#475569` |
| **Text (Muted)** | Metadata, footers, placeholders | `text-slate-500` | `#64748b` |

### Semantic Colors (Alerts & Validations)

| State | Background | Border | Text / Icon | Usage |
| :--- | :--- | :--- | :--- | :--- |
| **Success** | `bg-green-50` | `border-green-200` | `text-green-700` | Form success, profile saved |
| **Warning** | `bg-amber-50` | `border-amber-200` | `text-amber-700` | Missing info, pending approval |
| **Danger** | `bg-red-50` | `border-red-200` | `text-red-700` | Deletion warnings, form errors |

---

## 2. Typography

We use **Inter** (via Google Fonts) as the standard typeface across the portal. It provides excellent legibility on screens, particularly in data-dense views like directories and forms.

*Note: Ensure `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">` is in your base layout and tailwind.config.js is updated with `font-sans: ['Inter', ...defaultTheme.fontFamily.sans]`.*

### Typographic Hierarchy (Tailwind Classes)

| Element | Tailwind Classes | Example Usage |
| :--- | :--- | :--- |
| **Page Titles (H1)** | `text-3xl font-bold text-slate-900 tracking-tight` | "Alumni Directory", "My Profile" |
| **Section Headings (H2)**| `text-2xl font-semibold text-slate-800` | "Work Experience", "Recent News" |
| **Sub-headings (H3)** | `text-xl font-medium text-slate-800` | Card titles, Modal headers |
| **Body Text** | `text-base text-slate-600 leading-relaxed` | Paragraphs, article content |
| **Small Text** | `text-sm text-slate-500` | Footer links, timestamp captions |

---

## 3. Core Component Library

Copy-paste these standard HTML/Tailwind structures to ensure consistency across Laravel Blade views.

### 3.1 Primary Button
Used for primary actions (Submit, Save, Connect).

```html
<button type="button" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 transition-colors duration-200 ease-in-out">
    Save Profile
</button>
```

### 3.2 Secondary / Outline Button
Used for alternative actions (Cancel, Filter, Edit).

```html
<button type="button" class="inline-flex justify-center items-center px-4 py-2 border border-slate-300 text-sm font-medium rounded-md shadow-sm text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 transition-colors duration-200 ease-in-out">
    Cancel
</button>
```

### 3.3 Form Input Fields
Standard text input with label and focus states.

```html
<div class="mb-4">
    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
        Email Address
    </label>
    <input type="email" name="email" id="email" 
           class="block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm text-slate-900 placeholder-slate-400"
           placeholder="you@example.com">
</div>
```

### 3.4 Data Cards (Alumni Directory Grid)
Standard card layout for displaying profiles or news.

```html
<div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
    <!-- Card Header / Image Area -->
    <div class="p-5 border-b border-slate-100 bg-slate-50 flex items-center space-x-4">
        <img class="h-12 w-12 rounded-full border border-slate-200 object-cover" src="avatar.jpg" alt="Profile">
        <div>
            <h3 class="text-lg font-semibold text-slate-900">Rahul Patel</h3>
            <p class="text-sm text-slate-500">Class of 2018 • Mechanical Engineering</p>
        </div>
    </div>
    <!-- Card Body -->
    <div class="p-5">
        <p class="text-sm text-slate-600 mb-4">Senior Mechanical Engineer at L&T Construction.</p>
        <!-- Card Footer Actions -->
        <div class="flex space-x-3">
            <a href="#" class="text-sm font-medium text-blue-700 hover:text-blue-800">View Profile &rarr;</a>
        </div>
    </div>
</div>
```

### 3.5 Badges & Tags
Used to identify user roles (Student, Alumni, Faculty) or statuses.

```html
<!-- Alumni Badge (Brand) -->
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
    Alumni
</span>

<!-- Faculty Badge (Accent) -->
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800">
    Faculty
</span>

<!-- Student Badge (Neutral) -->
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
    Student
</span>
```

---

## 4. Layout & Grid System

### Container Width
All main page content must be wrapped in a standard container.
```html
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Content -->
</div>
```

### Alumni Directory Grid
Mobile-first grid layout that scales up smoothly.
*   **Mobile:** 1 column (`grid-cols-1`)
*   **Tablet:** 2 columns (`md:grid-cols-2`)
*   **Desktop:** 3 columns (`lg:grid-cols-3` or `xl:grid-cols-4`)

```html
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Insert Data Cards here -->
</div>
```

---

## 5. Interaction & Feedback

### Transitions
Standardize animations across hover effects, modals, and focus states.
*   Class: `transition-all duration-200 ease-in-out`
*   Apply this to buttons, links, and cards.

### Loading States
Instead of generic spinners, use Skeleton Loaders for initial data fetch (handled conditionally via Alpine.js or Livewire).

```html
<!-- Skeleton Loader for a Card -->
<div class="animate-pulse bg-white rounded-lg shadow-sm border border-slate-200 p-5">
    <div class="flex space-x-4 mb-4">
        <div class="rounded-full bg-slate-200 h-12 w-12"></div>
        <div class="flex-1 space-y-3 py-1">
            <div class="h-4 bg-slate-200 rounded w-3/4"></div>
            <div class="h-3 bg-slate-200 rounded w-1/2"></div>
        </div>
    </div>
    <div class="space-y-2">
        <div class="h-3 bg-slate-200 rounded"></div>
        <div class="h-3 bg-slate-200 rounded w-5/6"></div>
    </div>
</div>
```

### Empty States
When a query (like an Alumni search) yields no results.

```html
<div class="text-center py-12 bg-white rounded-lg border border-slate-200 border-dashed">
    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>
    <h3 class="mt-2 text-sm font-medium text-slate-900">No Alumni Found</h3>
    <p class="mt-1 text-sm text-slate-500">Adjust your search filters and try again.</p>
</div>
```

### Alpine.js Integration Note
For simple interactions like dismissing alerts or toggling dropdowns, rely on Alpine.js directly inline.
```html
<!-- Example: Dismissible Alert -->
<div x-data="{ show: true }" x-show="show" class="bg-blue-50 p-4 rounded-md flex justify-between items-start">
    <div class="text-sm text-blue-700">Profile updated successfully.</div>
    <button @click="show = false" class="text-blue-500 hover:text-blue-700">&times;</button>
</div>
```