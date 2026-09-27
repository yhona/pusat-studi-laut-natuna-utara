# CodeIgniter 4 Project Development Guidelines & Rules

All AI coding agents working in this repository MUST adhere to the **CodeIgniter 4 Feature Development Skill & Rules**:

- **Skill**: [`.agents/skills/codeigniter4-feature-development-skill/SKILL.md`](.agents/skills/codeigniter4-feature-development-skill/SKILL.md)
- **Rules**: [`.agents/rules/codeigniter4-feature-development-skill.md`](.agents/rules/codeigniter4-feature-development-skill.md)

## Core Principles Summary

1. **Inspect Before Coding**:
   - Determine CI4 version, PHP version, database driver (SQLite at `writable/database.sqlite`), frontend dependencies (Tailwind CSS, Alpine.js), auth mechanism, existing models, filters, routes, and views.
   - Project architecture is the source of truth.

2. **Search Before Creating**:
   - Never duplicate existing controllers, models, entities, services, or views. Always check existing patterns.

3. **Do Not Assume Dependencies**:
   - Inspect `composer.json` and `package.json`. Follow existing project libraries and conventions.

4. **Security by Default**:
   - Always include CSRF tokens (`<?= csrf_field() ?>` / `csrf_token()`) on all POST/PUT/DELETE forms.
   - Validate file uploads with strict MIME types and size limits.
   - Protect against IDOR, XSS, and SQL injection.
   - Use password hashing (BCrypt) and maintain session security.

5. **Graceful Error Handling & UX**:
   - Never throw cold 404/500 exceptions for missing user/record lookups in the admin panel.
   - Gracefully redirect with user-friendly flash notifications (`redirect()->to(...)->with('error', '...')`).
   - Cleanly resequence and reset `sqlite_sequence` on table wipe/truncate to avoid ID drift.

6. **System Verification**:
   - Ensure 0 PHP syntax errors (`php -l`).
   - Ensure all 6 criteria in `audit_scanner.php` pass 100%.
   - Ensure browser test suite passes (`node playwright_check.js`).
