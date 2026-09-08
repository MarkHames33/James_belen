# Laboratory Exercise No. 5 — CRUD with Authentication (LavaLust)

This project already includes:
- Session-based authentication (`AuthController`, `AuthenticationMiddleware`) — reused from the Users module.
- **Product CRUD** (new, added for this exercise): `ProductModel`, `ProductController`, and views `products_view.php` / `product_form_view.php`.
- Routes `/products`, `/products/create`, `/products/edit/{id}`, `/products/delete/{id}` — all protected by the `auth` middleware, exactly as required.
- A `Dockerfile` ready for Render deployment.

---

## 1. Run it locally on Laragon (using your EXISTING database)

You said you already have a database in phpMyAdmin — good, you don't need to create a new one.

1. **Copy this project folder** into `C:\laragon\www\` (or wherever your Laragon `www` folder is), so it's reachable via `http://your-folder-name.test` or `http://localhost/your-folder-name`.
2. **Add the `products` table to your existing database.**
   - Open phpMyAdmin → select your existing database → click the **SQL** tab.
   - Open the file `products_table.sql` (included in this project) → copy everything → paste it in → click **Go**.
   - This only creates the `products` table (with 3 sample rows). It does **not** touch your other tables.
3. **Set your database name in `.env`.**
   - A `.env` file is already included with Laragon defaults (`host=localhost`, `user=root`, no password).
   - Open `.env` and change this line to your actual database name:
     ```
     DB_NAME=CHANGE_THIS_to_your_existing_database_name
     ```
4. **Make sure you have a `users` table with at least one account** (this project's login checks the `users` table). If your existing database doesn't have one yet, you can run `database_seed.sql` instead (it creates `users`, `refresh_tokens`, and `products` all at once, with 5 demo accounts — password for all of them is `Admin@123`).
5. **Visit the app** in your browser, e.g. `http://localhost/crudlava/` (adjust to your actual folder/virtual host).
   - `/login` → sign in.
   - `/products` → the CRUD list (blocked until you're logged in).
   - `/products/create`, `/products/edit/{id}`, delete button → full CRUD.
6. Try opening `/products` in an incognito window (not logged in) — it should redirect you to `/login`, proving unauthenticated users are blocked.

---

## 2. Push to GitHub

```bash
git init                      # if not already a repo
git add .
git commit -m "Add Product CRUD for Lab Exercise 5"
git branch -M main
git remote add origin https://github.com/<your-username>/<your-repo>.git
git push -u origin main
```

`.env` is already in `.gitignore`, so your local credentials will **not** be pushed. Good — don't remove that line.

---

## 3. Set up the Aiven MySQL database

1. Log in to [Aiven](https://aiven.io/) → create a **MySQL** service (the free plan is fine for this exercise).
2. Once it's running, open the service → **Overview** tab → note down:
   - Host
   - Port
   - User (usually `avnadmin`)
   - Password
   - Default database name (usually `defaultdb`)
3. Connect to it (via Aiven's built-in query editor, or MySQL Workbench/DBeaver using those credentials) and run the contents of `database_seed.sql` from this project — this creates `users`, `refresh_tokens`, and `products`, with demo data.
   - If you'd rather keep it minimal, you can instead run just `products_table.sql` plus your own `users` table SQL.

---

## 4. Deploy to Render

1. Push this project to GitHub first (step 2).
2. In [Render](https://render.com/), click **New +** → **Web Service** → connect your GitHub repo.
3. Render will detect the `Dockerfile` in this project automatically — choose **Docker** as the environment (no build/start command needed, the Dockerfile handles it).
4. Under **Environment Variables**, add (using your Aiven credentials from step 3):
   | Key | Value |
   |---|---|
   | `DB_HOST` | your Aiven host |
   | `DB_PORT` | your Aiven port |
   | `DB_USERNAME` | your Aiven username |
   | `DB_PASSWORD` | your Aiven password |
   | `DB_NAME` | your Aiven database name |
   | `APP_ENV` | `production` |
   | `APP_KEY` | any random string (generate one, see below) |

   **Never commit these values to GitHub** — only set them in Render's Environment Variables panel.
5. Click **Create Web Service** and wait for the deploy to finish. Render will give you a URL like `https://your-app.onrender.com`.
6. Visit that URL → `/login` → test the full flow: login → `/products` → create → edit → delete, then confirm the same actions are reflected in Aiven (Aiven console → query editor → `SELECT * FROM products;`).

### Generating an APP_KEY
Locally, from the project root:
```bash
php console/cli.php key:generate
```
Copy the value it prints (or writes to `.env`) and paste it as the `APP_KEY` environment variable in Render.

---

## 5. What to submit (per the exercise)

1. GitHub Repository URL
2. Render Application URL
3. Screenshots: login, product list, add product, edit product, delete
4. Screenshot of the `products` table in Aiven (phpMyAdmin-equivalent is Aiven's console query view)
5. Confirm the working CRUD app end-to-end

If you want, I can also help you write the exact commands for your terminal, or troubleshoot any error message you get during local run or deployment — just paste it here.
