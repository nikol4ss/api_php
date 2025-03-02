# Simple PHP API

This is a simple PHP API for managing a To-Do list.

## Endpoints
- **GET /index.php**: List all tasks or get a specific task by ID (`?id=1`).
- **POST /index.php**: Create a new task. Requires JSON body: `{ "title": "Task title" }`.
- **PUT /index.php?id=1**: Update a task. Requires JSON body: `{ "title": "Updated title" }`.
- **DELETE /index.php?id=1**: Delete a task by ID.

## Database Setup
1. Create a database named `todo`.
2. Run the following SQL to create the `tasks` table:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL
);
