# PathSeeker — Career Guidance Platform

A **Laravel** web platform that helps students and graduates choose a career path: browse a career catalogue, take aptitude quizzes, and get career recommendations matched to quiz results. Developed by **Team FBANEXTECH** as a Techwiz competition entry (September 2025).

## Features

**For users**
- Career catalogue with detailed career pages, bookmarks and search
- **Quizzes** — attempts with questions, scoring and result history
- **Career recommendations** generated from quiz performance
- Success stories and multimedia learning content
- Feedback submission
- Account security: **OTP email verification** on signup and **OTP-based password reset**

**For admins**
- Dashboard and full user management, including **approval of new user registrations**
- Manage careers, quizzes and questions, recommendations and multimedia content
- Moderate success stories and feedback

## Tech stack

- **Laravel** (PHP) with Blade views and a Bootstrap-based admin theme
- **MySQL** — migrations in `database/migrations/`; demo data in `data.sql`
- Models: `Career`, `Quiz`, `QuizQuestion`, `QuizAttempt`, `CareerRecommendation`, `Bookmark`, `SuccessStory`, `Multimedia`, `Feedback`, `User`

## Project structure

```
pathseeker/
├── app/            # Models, controllers (incl. AdminController), middleware
├── database/       # Migrations and seeders
├── resources/views # Blade templates (public site, career, quiz, admin)
├── routes/         # Web routes
├── data.sql        # Demo data
└── docs/           # Project documentation (PDF)
```

## Getting started

```bash
composer install
cp .env.example .env
php artisan key:generate
# configure DB_* in .env, then:
php artisan migrate --seed
php artisan serve
```

## Documentation

Full project documentation: [`docs/PathSeeker_Documentation.pdf`](docs/PathSeeker_Documentation.pdf)

---

*Team FBANEXTECH — Techwiz 2025 · Sheikh Maaz Abdullah · [GitHub](https://github.com/sheikhmaazabdullah)*
