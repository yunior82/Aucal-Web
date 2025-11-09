Aucal-Web

Aucal-Web is the front-end web application for the Aucal system. It is built using PHP and Twig (template engine) and serves as the public-facing website for the Aucal platform.

🧩 Features

- Server-rendered web application using PHP + Twig for templating.

- Clean separation of views (views/), pages (pages/), static (built) assets (dist/).

- Easy to extend with new pages or templated content.

- Designed to support dynamic content (courses/offers) and to integrate with backend services.

🛠 Technologies

- PHP — server-side scripting.

- Twig — template engine for rendering HTML views.

- HTML / CSS / JavaScript — front-end assets.

🏗 Architecture & Folder Structure

- index.php: acts as the front controller or entry script, bootstrapping the application.

- pages/: contains individual page scripts that set up data and render Twig templates.

- views/: contains Twig templates (layouts, partials, page views).

- dist/: holds compiled/minified front-end assets for deployment.
