---
name: codeigniter4-feature-development-skill
description: >-
  Disciplined, dependency-aware workflow for implementing, modifying, or extending features in CodeIgniter 4 applications. Use when building or modifying CI4 controllers, models, entities, migrations, seeders, validation, filters, routes, views, security, or audit logs.
---

# CodeIgniter 4 Feature Development Skill

## Purpose

This skill defines a disciplined workflow for AI coding agents when
implementing, modifying, or extending features in a CodeIgniter 4
application.

The goal is to reduce missed requirements, avoid unnecessary code
duplication, preserve the existing project architecture, and ensure that
every feature is implemented and verified systematically.

This skill is intentionally **dependency-aware**.

The AI MUST NOT assume that the project uses:

-   MySQL
-   PostgreSQL
-   REST API
-   Bootstrap
-   Tailwind
-   jQuery
-   React
-   Vue
-   Alpine.js
-   Any other frontend or backend package

Instead, the AI MUST inspect the existing project and follow the
dependencies, architecture, conventions, and patterns already used by
that project.

------------------------------------------------------------------------

# 1. Core Principles

## 1.1 Inspect Before Coding

Never start implementing immediately after receiving a feature request.

First inspect the existing project.

At minimum determine:

-   CodeIgniter 4 version.
-   PHP version.
-   Database driver, if relevant.
-   Frontend technology, if relevant.
-   Authentication mechanism.
-   Authorization mechanism.
-   Existing Filters.
-   Existing Models.
-   Existing Entities.
-   Existing Services.
-   Existing Validation rules.
-   Existing Controllers.
-   Existing Routes.
-   Existing Views/components.
-   Existing migrations.
-   Existing seeders.
-   Existing tests.
-   Existing logging/audit mechanism.
-   Installed Composer dependencies.
-   Installed frontend dependencies, if applicable.

The project's existing architecture is the source of truth.

------------------------------------------------------------------------

## 1.2 Search Before Creating

Before creating a new:

-   Controller
-   Model
-   Entity
-   Service
-   Filter
-   Validation rule
-   View
-   Component
-   Helper
-   Library
-   Route

search the project to determine whether an equivalent already exists.

Do not duplicate functionality unnecessarily.

------------------------------------------------------------------------

## 1.3 Do Not Assume Dependencies

The AI MUST inspect:

``` text
composer.json
composer.lock
package.json
package-lock.json
yarn.lock
pnpm-lock.yaml
```

when those files exist and are relevant.

Do not install a package just because it would make implementation
easier.

Only introduce a new dependency when:

1.  The requirement genuinely needs it.
2.  Existing project capabilities are insufficient.
3.  The dependency is compatible with the project.
4.  The change is justified.

------------------------------------------------------------------------

## 1.4 Follow Existing Architecture

If the project already uses:

``` text
Controller
→ Service
→ Model
```

follow it.

If the project uses:

``` text
Controller
→ Model
```

for simple modules, do not introduce unnecessary Services.

If the project uses custom repositories, actions, domain classes, or
another established pattern, follow that pattern.

Consistency with the existing project is preferred over theoretical
architectural purity.

------------------------------------------------------------------------

## 1.5 Do Not Overengineer

Use the simplest design that correctly satisfies the requirement.

Do not create:

-   unnecessary abstraction layers,
-   unnecessary interfaces,
-   unnecessary repositories,
-   unnecessary services,
-   unnecessary events,
-   unnecessary packages.

Complexity must have a reason.

------------------------------------------------------------------------

## 1.6 Security Is Part of the Feature

Security is not an optional final step.

Every feature must consider:

-   Authentication.
-   Authorization.
-   Input validation.
-   Mass assignment.
-   Access control.
-   IDOR.
-   File security.
-   Sensitive data exposure.
-   CSRF where applicable.
-   XSS where applicable.
-   SQL injection protection.
-   Session/security implications.

------------------------------------------------------------------------

# 2. Standard Feature Development Workflow

Every meaningful feature should follow this sequence:

``` text
1. Requirement Analysis
        ↓
2. Existing Codebase Inspection
        ↓
3. Dependency & Architecture Detection
        ↓
4. Business Flow / Use Case
        ↓
5. Database / Data Design
        ↓
6. Migration
        ↓
7. Model
        ↓
8. Entity
        ↓
9. Seeder / Test Data
        ↓
10. Validation
        ↓
11. Authorization / Filters
        ↓
12. Service / Business Logic
        ↓
13. Controller
        ↓
14. Routes
        ↓
15. Response / Transformation
        ↓
16. View / UI
        ↓
17. Search / Filter / Sort / Pagination
        ↓
18. File / Storage
        ↓
19. Audit Log
        ↓
20. Error Handling
        ↓
21. Testing
        ↓
22. Security Review
        ↓
23. Performance Review
        ↓
24. Final Verification
```

Not every feature requires every stage.

However, every stage must be consciously evaluated.

Do not silently skip a stage.

------------------------------------------------------------------------

# 3. Phase 1 --- Requirement Analysis

Convert the user's request into an explicit implementation requirement.

Determine:

### Actors

Who will use the feature?

Examples:

-   Administrator
-   Operator
-   Supervisor
-   Manager
-   Viewer
-   Public user

### Actions

Examples:

-   View
-   Create
-   Update
-   Delete
-   Restore
-   Approve
-   Reject
-   Export
-   Import
-   Print
-   Upload
-   Download

### Data

Determine:

-   What data is stored?
-   What data is displayed?
-   What data is calculated?
-   What data comes from another table/module?

### Business Rules

Examples:

-   A record must have a unique number.
-   An approved record cannot be edited.
-   Only active users can perform an action.
-   A record requires approval before becoming active.
-   Deleted records must remain recoverable.

### Constraints

Identify:

-   Required fields.
-   Optional fields.
-   Unique fields.
-   Relationships.
-   Status values.
-   Approval rules.
-   File requirements.
-   Permission requirements.

Before coding, summarize the interpreted requirement internally or in
the response when appropriate.

------------------------------------------------------------------------

# 4. Phase 2 --- Existing Codebase Inspection

Inspect the project before modifying it.

Important directories may include:

``` text
app/
├── Config/
├── Controllers/
├── Database/
│   ├── Migrations/
│   └── Seeds/
├── Entities/
├── Filters/
├── Libraries/
├── Models/
├── Services/
├── Validation/
└── Views/

tests/
```

The actual structure may differ.

Do not force the project into this structure.

Inspect the actual structure first.

Also inspect:

``` text
composer.json
composer.lock
.env
phpunit.xml*
app/Config/*
routes
database configuration
authentication configuration
```

when relevant.

------------------------------------------------------------------------

# 5. Phase 3 --- Dependency & Architecture Detection

Before implementing, identify what the project actually uses.

Determine:

``` text
CodeIgniter version
PHP version
Database
Authentication
Authorization
Frontend
CSS framework
JS framework
Template engine
File storage
Logging
Testing framework
Third-party packages
```

Do not assume any of them.

Examples:

If the project uses:

``` text
CodeIgniter 4
+ Native Views
+ Vanilla JavaScript
```

continue with that.

If it uses:

``` text
CodeIgniter 4
+ Inertia
+ React
```

follow that.

If it uses:

``` text
CodeIgniter 4
+ custom frontend
```

follow the existing implementation.

The feature must fit the project's dependency ecosystem.

------------------------------------------------------------------------

# 6. Phase 4 --- Business Flow / Use Case

Define the feature flow before implementation.

Example:

``` text
User opens Employee page
        ↓
System checks access
        ↓
Display employee list
        ↓
User selects Create
        ↓
Display form
        ↓
User submits
        ↓
Validate input
        ↓
Check authorization
        ↓
Execute business rules
        ↓
Save data
        ↓
Write audit log if required
        ↓
Return response
```

For complex workflows define:

-   Initial state.
-   Allowed transitions.
-   Actors.
-   Approval process.
-   Failure paths.
-   Rollback behavior.

------------------------------------------------------------------------

# 7. Phase 5 --- Database / Data Design

Before creating migrations, determine the data model.

Identify:

-   Tables.
-   Columns.
-   Data types.
-   Nullable fields.
-   Default values.
-   Primary keys.
-   Foreign keys.
-   Unique constraints.
-   Indexes.
-   Soft delete requirements.
-   Timestamps.
-   Relationships.

Example:

``` text
departments
      │
      └── employees
              │
              └── employee_documents
```

Consider:

-   One-to-one.
-   One-to-many.
-   Many-to-many.
-   Polymorphic structures only when genuinely necessary.

Do not add columns without a clear requirement.

------------------------------------------------------------------------

# 8. Phase 6 --- Migration

Use CodeIgniter 4 migrations according to the existing project
convention.

Typical command:

``` bash
php spark make:migration CreateEmployeesTable
```

Migration should define:

-   Columns.
-   Primary keys.
-   Foreign keys.
-   Indexes.
-   Defaults.
-   Constraints.
-   Timestamps where appropriate.

Before changing an existing table:

1.  Inspect current migrations.
2.  Inspect current model usage.
3.  Inspect related code.
4.  Check whether the schema is already deployed.
5.  Create a new migration for deployed schema changes.

Do not casually edit an old production migration.

------------------------------------------------------------------------

# 9. Phase 7 --- Model

Create or modify the CodeIgniter 4 Model.

Example:

``` php
class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_number',
        'name',
        'department_id',
        'status',
    ];
}
```

Consider:

-   `$table`
-   `$primaryKey`
-   `$allowedFields`
-   `$useTimestamps`
-   `$useSoftDeletes`
-   `$returnType`
-   `$casts`
-   `$validationRules`
-   `$validationMessages`
-   Query scopes/patterns already used by the project.

Never expose fields through `$allowedFields` merely for convenience.

Only allow fields that the application is intentionally allowed to
write.

------------------------------------------------------------------------

# 10. Phase 8 --- Entity

Use a CodeIgniter 4 Entity when the project uses Entities or when the
domain benefits from an entity layer.

Entity responsibilities may include:

-   Data representation.
-   Casting.
-   Accessors.
-   Mutators.
-   Small domain-related transformations.

Do not move large business workflows into Entities.

Follow the project's existing Entity convention.

If the project does not use Entities, do not introduce them without
justification.

------------------------------------------------------------------------

# 11. Phase 9 --- Seeder / Test Data

Evaluate whether the feature needs:

-   Seeder.
-   Fixture.
-   Factory-like test data.
-   Development sample data.

Use seeders for:

-   Master data.
-   Initial application data.
-   Development setup.
-   Reproducible test scenarios.

Respect:

-   Foreign keys.
-   Unique constraints.
-   Required fields.
-   Valid statuses.

Never put real production secrets or sensitive personal data into
seeders.

------------------------------------------------------------------------

# 12. Phase 10 --- Validation

Use the CodeIgniter 4 Validation system or the project's established
validation layer.

Validation should cover:

-   Required values.
-   Data types.
-   String length.
-   Numeric ranges.
-   Formats.
-   Unique values.
-   Existing foreign keys.
-   Allowed status values.
-   File constraints.
-   Cross-field requirements.

Example:

``` php
$rules = [
    'employee_number' => [
        'required',
        'max_length[50]',
    ],
    'name' => [
        'required',
        'max_length[100]',
    ],
];
```

Use custom validation rules when the business rule genuinely requires
them.

Do not rely only on frontend validation.

Server-side validation is mandatory.

------------------------------------------------------------------------

# 13. Phase 11 --- Authorization / Filters

Determine how the project controls access.

Possible mechanisms:

``` text
Filters
Session checks
Role checks
Permission checks
Custom authorization classes
Controller checks
Service-level authorization
```

Follow the existing project.

Authorization must be enforced server-side.

Example:

``` text
Admin
├── View
├── Create
├── Update
└── Delete

Operator
├── View
├── Create
└── Update

Viewer
└── View
```

Hiding a button is not authorization.

------------------------------------------------------------------------

# 14. Phase 12 --- Service / Business Logic

Use a Service when business logic becomes complex or spans multiple
operations.

Example:

``` text
EmployeeController
        ↓
EmployeeService
        ↓
EmployeeModel
        ↓
Database
```

A Service may handle:

-   Multiple model operations.
-   Database transactions.
-   Business rules.
-   Status transitions.
-   Number generation.
-   File processing.
-   External integrations.
-   Audit operations.
-   Event dispatching.

Do not create Services for trivial logic if the project does not use
them.

------------------------------------------------------------------------

# 15. Phase 13 --- Controller

The Controller coordinates the HTTP request lifecycle.

Typical responsibilities:

-   Receive request.
-   Check access.
-   Validate input.
-   Call business logic.
-   Return the correct response.

For CRUD, typical methods are:

``` text
index
new
create
show
edit
update
delete
```

Use the project's existing naming conventions.

Keep Controllers reasonably small.

Avoid:

``` text
Controller
= validation
+ database logic
+ business rules
+ file processing
+ audit logic
+ HTML generation
+ 700 lines
```

Move meaningful business logic into the appropriate existing layer.

------------------------------------------------------------------------

# 16. Phase 14 --- Routes

Use CodeIgniter 4 routing according to the project's existing
conventions.

Example:

``` php
$routes->get('employees', 'EmployeeController::index');
$routes->get('employees/new', 'EmployeeController::new');
$routes->post('employees', 'EmployeeController::create');
$routes->get('employees/(:num)', 'EmployeeController::show/$1');
$routes->get('employees/(:num)/edit', 'EmployeeController::edit/$1');
$routes->post('employees/(:num)', 'EmployeeController::update/$1');
$routes->delete('employees/(:num)', 'EmployeeController::delete/$1');
```

Before adding routes:

-   Search existing routes.
-   Check route conflicts.
-   Check route filters.
-   Check authentication requirements.
-   Check naming conventions.

Do not create duplicate or conflicting routes.

------------------------------------------------------------------------

# 17. Phase 15 --- Response / Transformation

Determine how the project returns data.

Possible patterns:

``` text
View
Redirect
JSON
Custom response class
API Resource/Transformer
Inertia response
```

Follow the existing project.

For JSON responses, maintain consistent:

-   Status codes.
-   Response structure.
-   Error format.
-   Validation format.
-   Message format.

Do not expose internal model fields accidentally.

------------------------------------------------------------------------

# 18. Phase 16 --- View / UI

Use whatever frontend technology the project already uses.

Possible examples:

``` text
Native CodeIgniter Views
Blade-like custom templates
React
Vue
Inertia
Livewire-like solutions
Vanilla JavaScript
Other existing components
```

Do not assume a CSS or JS framework.

Before creating UI:

-   Inspect existing pages.
-   Reuse existing layouts.
-   Reuse existing components.
-   Follow existing naming.
-   Follow existing visual conventions.

The UI should handle:

-   Loading state where applicable.
-   Empty state.
-   Validation errors.
-   Success messages.
-   Failure messages.
-   Confirmation dialogs.
-   Permission-based actions.

------------------------------------------------------------------------

# 19. Phase 17 --- Search / Filter / Sort / Pagination

For list features, determine whether the requirement needs:

-   Search.
-   Filtering.
-   Sorting.
-   Pagination.
-   Date range.
-   Status filtering.
-   Relationship filtering.

Perform filtering and pagination at the data/query level where
practical.

Avoid loading huge datasets into memory unnecessarily.

Preserve the project's existing query and pagination conventions.

------------------------------------------------------------------------

# 20. Phase 18 --- File / Storage

If the feature handles files, determine:

-   Allowed file types.
-   MIME validation.
-   Maximum size.
-   Storage location.
-   Naming strategy.
-   Access control.
-   Replacement behavior.
-   Deletion behavior.

Never trust user-provided filenames.

Do not expose sensitive files publicly unless intended and authorized.

Follow the project's existing storage abstraction.

------------------------------------------------------------------------

# 21. Phase 19 --- Audit Log

Determine whether the feature requires traceability.

Important actions may include:

``` text
CREATE
UPDATE
DELETE
RESTORE
APPROVE
REJECT
EXPORT
DOWNLOAD
LOGIN
```

An audit entry may contain:

``` text
user
action
module
record ID
timestamp
IP address where appropriate
before values where appropriate
after values where appropriate
```

Use the project's existing logging/audit mechanism.

Do not invent a second audit system when one already exists.

For regulated or sensitive systems, auditability should be treated as a
first-class requirement.

------------------------------------------------------------------------

# 22. Phase 20 --- Error Handling

Handle expected failures properly.

Examples:

-   Validation failure.
-   Unauthorized access.
-   Forbidden action.
-   Record not found.
-   Database constraint failure.
-   File failure.
-   External integration failure.
-   Transaction failure.

User-facing errors should be understandable.

Do not expose:

-   SQL statements.
-   Stack traces.
-   Internal server paths.
-   Credentials.
-   Sensitive configuration.
-   Debug information.

Detailed technical information should remain in logs.

------------------------------------------------------------------------

# 23. Phase 21 --- Database Transactions

Use transactions when multiple operations must succeed or fail together.

Example:

``` php
$db->transStart();

// Operation A
// Operation B
// Operation C

$db->transComplete();
```

Before using a transaction, determine whether the project's existing
transaction pattern should be followed.

Transactions are especially important for:

-   Financial operations.
-   Approval workflows.
-   Multi-table writes.
-   Inventory changes.
-   Record creation with related records.
-   Operations that must remain atomic.

Do not use transactions blindly for every read operation.

------------------------------------------------------------------------

# 24. Phase 22 --- Testing

Use the testing tools already present in the project.

Test critical behavior:

``` text
Create
Read
Update
Delete
Validation
Authorization
Business rules
Relationships
Status transitions
File handling
Failure cases
```

Examples:

``` text
Authorized user → action succeeds
Unauthorized user → action denied
Invalid input → validation error
Missing record → appropriate response
Duplicate unique value → validation/database protection
```

Do not only test the happy path.

------------------------------------------------------------------------

# 25. Phase 23 --- Security Review

Before completion, review:

``` text
[ ] Authentication
[ ] Authorization
[ ] Input validation
[ ] CSRF where applicable
[ ] Mass assignment / allowed fields
[ ] SQL injection protection
[ ] XSS protection
[ ] IDOR
[ ] File upload security
[ ] Sensitive data exposure
[ ] Session/security controls
[ ] Access control
```

### IDOR Example

If the route is:

``` text
/employees/123
```

the application must verify that the current user is actually allowed to
access record `123`.

Knowing the ID is not permission.

------------------------------------------------------------------------

# 26. Phase 24 --- Performance Review

Check for:

-   N+1 queries.
-   Missing indexes.
-   Excessive database calls.
-   Large unpaginated datasets.
-   Repeated calculations.
-   Unnecessary file operations.
-   Expensive loops.

Follow the project's existing optimization patterns.

Do not prematurely optimize without evidence.

------------------------------------------------------------------------

# 27. Change Management Rules

When modifying existing functionality:

1.  Inspect current behavior.
2.  Identify dependencies.
3.  Understand why the existing code exists.
4.  Determine the smallest safe change.
5.  Implement the change.
6.  Test related functionality.
7.  Check for regression.

Never rewrite an unrelated module simply because a different
implementation appears cleaner.

------------------------------------------------------------------------

# 28. Database Change Rules

Before changing schema:

``` text
Inspect existing migrations
        ↓
Inspect current model
        ↓
Inspect relationships
        ↓
Inspect code using the table
        ↓
Determine deployment state
        ↓
Create safe migration
        ↓
Test migration
```

Do not casually:

-   Delete columns.
-   Rename production columns.
-   Change primary keys.
-   Change data types.
-   Remove constraints.

without considering existing data and dependent code.

------------------------------------------------------------------------

# 29. Handling Ambiguous Requirements

Use this decision process:

``` text
Is the requirement clear?
        │
        ├── YES
        │    ↓
        │  Implement
        │
        └── NO
             ↓
      Can the codebase resolve it?
             │
             ├── YES → Inspect
             │
             └── NO
                  ↓
          Is the ambiguity blocking?
                  │
             ┌────┴────┐
             │         │
            YES       NO
             │         │
          Ask user   Follow the
                     safest existing
                     project convention
```

Do not ask questions that can be answered by inspecting the codebase.

------------------------------------------------------------------------

# 30. Implementation Strategy for Large Features

For larger features, implement in stages.

``` text
Stage 1
Requirement + Architecture
        ↓
Stage 2
Database
        ↓
Stage 3
Model + Entity
        ↓
Stage 4
Validation + Authorization
        ↓
Stage 5
Business Logic
        ↓
Stage 6
Controller + Routes
        ↓
Stage 7
View / UI
        ↓
Stage 8
Testing
        ↓
Stage 9
Security + Performance Review
        ↓
Stage 10
Final Verification
```

After each meaningful stage:

-   Check syntax.
-   Check references.
-   Check imports/namespaces.
-   Check database assumptions.
-   Run relevant tests when possible.

------------------------------------------------------------------------

# 31. AI Behavior Rules

The AI MUST:

-   Inspect before modifying.
-   Search before creating.
-   Detect the project's actual dependencies.
-   Follow existing architecture.
-   Reuse existing components.
-   Reuse existing validation conventions.
-   Reuse existing authorization conventions.
-   Validate user input.
-   Enforce authorization server-side.
-   Consider database integrity.
-   Consider transactions where required.
-   Consider audit requirements.
-   Consider error handling.
-   Consider security.
-   Consider testing.
-   Verify the final result.

The AI MUST NOT:

-   Assume a dependency exists.
-   Install unnecessary packages.
-   Assume a frontend framework.
-   Assume a database engine.
-   Assume an API architecture.
-   Invent existing files.
-   Invent existing classes.
-   Claim something works without verification.
-   Skip validation silently.
-   Skip authorization silently.
-   Delete code without understanding its purpose.
-   Rewrite unrelated code.
-   Leave debug code behind.
-   Expose secrets.
-   Ignore failing tests.
-   Introduce a second implementation when one already exists.

------------------------------------------------------------------------

# 32. Dependency-Aware Decision Rule

When implementing a feature, determine the actual project stack first.

``` text
What does the project already use?
            ↓
      Inspect dependencies
            ↓
      Inspect architecture
            ↓
     Identify existing pattern
            ↓
      Follow that pattern
```

Example:

If the project has no React:

``` text
DO NOT create React components.
```

If the project has no REST API:

``` text
DO NOT introduce an API layer unnecessarily.
```

If the project uses native CodeIgniter Views:

``` text
Use the existing Views system.
```

If the project uses a custom service layer:

``` text
Follow the custom service pattern.
```

The skill must adapt to the project, not force the project to adapt to
the skill.

------------------------------------------------------------------------

# 33. Final Verification

Before declaring the feature complete, compare the implementation
against the original requirement.

Mandatory checklist:

``` text
[ ] Requirement implemented
[ ] Existing code inspected
[ ] Dependencies inspected
[ ] Existing architecture followed
[ ] No duplicate functionality created
[ ] Database design correct
[ ] Migration correct
[ ] Model correct
[ ] Entity evaluated
[ ] Seeder/test data evaluated
[ ] Validation implemented
[ ] Authorization implemented
[ ] Business logic implemented
[ ] Controller implemented
[ ] Routes correct
[ ] Response behavior correct
[ ] UI implemented according to existing stack
[ ] Error states handled
[ ] Search/filter/sort/pagination evaluated
[ ] File handling evaluated
[ ] Audit logging evaluated
[ ] Transactions evaluated
[ ] Tests created/updated
[ ] Tests executed where possible
[ ] Security reviewed
[ ] Performance reviewed
[ ] Existing functionality not broken
[ ] No unnecessary dependency added
[ ] No debug code remains
[ ] No secrets exposed
[ ] Requirement verified
```

A feature is not complete simply because files were created.

It is complete when the requested behavior has been implemented and
verified.

------------------------------------------------------------------------

# 34. Final Response Format

When the feature is completed, report:

``` text
## Implemented

### Requirement
- What was requested.

### Architecture
- Existing project pattern used.
- Dependencies detected.
- Important architectural decisions.

### Database
- Migration created/updated.
- Tables/columns/relationships.

### Backend
- Models.
- Entities.
- Validation.
- Filters/authorization.
- Services/actions.
- Controllers.
- Routes.

### Frontend
- Views/components/pages.
- Forms.
- Validation handling.
- Search/filter/pagination.

### Security
- Authorization.
- Validation.
- Access control.
- File protection where applicable.

### Audit
- Logging implemented or not required.

### Testing
- Tests created/updated.
- Tests executed.
- Result.

### Verification
- Requirement checklist.
- Known limitations.
- Assumptions.

### Files Changed
- `path/to/file`
- `path/to/file`
```

If something could not be verified, state it explicitly.

Never claim:

> "Everything works perfectly."

unless it was actually verified.

------------------------------------------------------------------------

# 35. Definition of Done

A CodeIgniter 4 feature is DONE only when:

``` text
Requirement
    +
Existing Architecture
    +
Dependencies
    +
Data Design
    +
Validation
    +
Authorization
    +
Business Logic
    +
Controller
    +
Routes
    +
UI / Response
    +
Error Handling
    +
Testing
    +
Security
    +
Verification
```

have all been evaluated.

The objective is not:

> "The code exists."

The objective is:

> "The requested behavior exists, follows the existing CodeIgniter 4
> project architecture, is secure, validated, maintainable, testable,
> and verified."

------------------------------------------------------------------------

# 36. Quick Checklist

## Before Coding

``` text
[ ] Understand requirement
[ ] Inspect project structure
[ ] Inspect CodeIgniter/PHP version
[ ] Inspect dependencies
[ ] Inspect existing architecture
[ ] Search for existing implementation
[ ] Identify affected files
[ ] Identify database impact
[ ] Identify authorization
[ ] Identify business rules
```

## While Coding

``` text
[ ] Migration
[ ] Model
[ ] Entity if applicable
[ ] Seeder/test data if applicable
[ ] Validation
[ ] Authorization/filter
[ ] Service/action if required
[ ] Controller
[ ] Routes
[ ] Response/transformer if applicable
[ ] View/UI according to existing stack
[ ] Search/filter/pagination if required
[ ] File handling if required
[ ] Audit log if required
[ ] Transaction if required
```

## Before Finishing

``` text
[ ] Validation
[ ] Authorization
[ ] Error handling
[ ] Tests
[ ] Security
[ ] Performance
[ ] Regression check
[ ] No debug code
[ ] No secrets
[ ] No unnecessary dependencies
[ ] Requirement verified
```

------------------------------------------------------------------------

# 37. Golden Rule

> **DO NOT CODE FIRST. UNDERSTAND FIRST, INSPECT SECOND, PLAN THIRD,
> IMPLEMENT FOURTH, TEST FIFTH, VERIFY LAST.**

The default workflow is:

``` text
Understand
    ↓
Inspect
    ↓
Detect Dependencies
    ↓
Plan
    ↓
Implement
    ↓
Test
    ↓
Review
    ↓
Verify
```

The AI should always adapt the implementation to the actual CodeIgniter
4 project rather than forcing a predetermined technology stack.
