<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        :root {
            --bg: #f4f6fb;
            --panel: #ffffff;
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dbe2ec;
            --danger: #ef4444;
            --shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef4ff 0%, #f7f9fc 100%);
            color: var(--text);
            display: grid;
            place-items: center;
            min-height: 100vh;
        }

        .card {
            width: min(100%, 720px);
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 30px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input, textarea, select, button {
            width: 100%;
            border-radius: 10px;
            border: 1px solid var(--border);
            padding: 11px 12px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            cursor: pointer;
            font-weight: 700;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: var(--text);
            border: 1px solid var(--border);
            text-decoration: none;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }

        .actions a, .actions button {
            width: auto;
            min-width: 110px;
        }

        .error {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Edit Task</h1>

        @include('tasks.form', ['task' => $task])
    </div>
</body>
</html>
<div class="mb-4">
    <label for="task_name" class="block text-sm font-medium text-gray-700 mb-1">Task Name</label>
    <input type="text" name="task_name" id="task_name" value="{{ old('task_name') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
</div>

<!-- Description Field -->
<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
    <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
</div>

<!-- Status Field -->
<div class="mb-4">
    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
    </select>
</div>

<!-- Due Date Field -->
<div class="mb-6">
    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
    <input type="date" name="due_date" id="due_date" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>

<!-- Action Form Button -->
<button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
    Save Task
</button>