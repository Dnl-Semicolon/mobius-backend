### Prompt to generate a Mobius landing page at `/`

You are a senior full-stack Laravel developer helping me add a simple **marketing landing page** to my existing project for **Mobius Smart Recycling Bin Ecosystem**.

Please read this carefully and follow all constraints.

---

### 1. Project context (what this startup does)

My project is **Mobius Smart Recycling Bin Ecosystem for Beverage Store Recycling with AI-Based Sorting and Monitoring**.

High-level story:

* Beverage stores (Starbucks, Mixue, Chagee, etc.) generate huge volumes of disposable cups, lids, and straws.
* Right now, most of these cups go into mixed trash. They are hard to sort and hard to turn into recyclables or revenue.
* Mobius provides:

  * **AI-powered smart recycling bins**:

    * A camera + AI (OpenAI Vision) detects whether an item is a cup, what brand it is, whether it has a lid and straw, and what materials are involved (paper vs plastic).
  * **Gamified customer experience**:

    * Customers earn **points** by throwing their cups into the Mobius bin and scanning a QR to claim points in a mobile app.
  * **Store owner dashboard (admin)**:

    * Shows cups recycled, material breakdown, brands, and estimated recyclable value for each outlet.
  * **Recycling partner view** in the future:

    * Helps recyclers see how much material is available and optimize pickup routes.

Right now, I already have:

* A **Laravel backend** with:

  * APIs for cup events, sessions, user points, and mobile summaries.
  * A working **admin dashboard** at `/admin` for store owners / admins.
* A **Flutter app** for customers, connected to these APIs.
* A **bin UI** page (not public marketing) that runs on the bin/touchscreen to show live points & QR.

What I do *not* have yet is a proper public **landing page** at `/`.

---

### 2. What I want you to build

I want you to:

1. **Create a simple, clean landing page at the root `/` URL** that explains Mobius and links to the admin login.
2. Do **NOT** break any existing admin or API routes.

   * `/admin` should continue to work as is.
   * Existing auth (Laravel Breeze, etc.) should remain intact.

You may assume:

* This is a Laravel 12 app.
* We are using Blade templates.
* The admin dashboard is accessible via `/admin` (already exists).
* Auth/login is already provided (e.g. `/login` from Breeze or similar).

---

## 3. Landing page content & sections (very open)

Honestly, I just want a cool landing page at `/`. Something that explains what Mobius is in your own interpretation. You can design the layout however you think looks good.

The only thing I really need is a navigation bar at the top with the project name and a link to the existing admin login route. Beyond that, you’re free to structure the page however you want — hero section, descriptions, visuals, features, anything you think fits. I do have a logo btw

---

### 4. Technical requirements & constraints

1. **Routing**

   * Update `routes/web.php` so that:

     * `Route::get('/', ...)` returns the new landing page view.
   * **Do not remove or change** the existing admin route definitions (e.g. `/admin`).
   * Check for any existing home route from Laravel Breeze (like `Route::get('/dashboard', ...)`):

     * Leave `/dashboard` and auth routes unchanged.
     * It’s fine if `/dashboard` stays as the logged-in home; `/` is the public marketing page.

2. **Views**

   * Create a Blade view for the landing page, for example:
     `resources/views/landing.blade.php`
   * Use the existing main layout if there is one (e.g. `layouts.app`) or create a simple standalone layout for the landing page.
   * Ensure the navigation bar and content are responsive (mobile friendly) with simple CSS or utility classes. You may use Tailwind if the project is already set up for it.

3. **Auth links**

   * For the “Admin Login” button in the nav and hero:

     * Detect the correct login route from the project (likely `route('login')`).
     * Use route helpers where appropriate, e.g. `{{ route('login') }}`.
   * Do **not** roll your own auth; reuse existing Breeze or auth scaffolding.

4. **Do not break existing functionality**

   * Do **not** modify any controllers or logic related to AI, bin sessions, APIs, or admin dashboard.
   * Only:

     * Add the new landing view.
     * Wire `/` route to it.
     * Possibly slightly adjust layout files to include the nav/footer if needed.

---

### 5. What I expect from you

* Create/modify the necessary **Blade view(s)** and `routes/web.php` so that:

  * Visiting `/` in the browser shows the new Mobius landing page with nav, hero, sections, and footer.
  * “Admin Login” goes to the existing login page.
  * `/admin` (and existing admin flow) continues to behave exactly as before.
* Keep the code clean and self-contained.
* If you need some nice reactivity or wanna use cool HTMX features, go ahead. and Alpine JS. Use Tailwind for making things pretty.
* Add brief comments in the Blade view where helpful.

Please proceed and implement this landing page within the existing Laravel project.