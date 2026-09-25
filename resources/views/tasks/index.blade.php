<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <style>
        :root {
            --bg: #f4f6fb;
            --panel: #ffffff;
            --panel-alt: #eef4ff;
            --primary: #3b82f6;
            --primary-dark: #1d4ed8;
            --success: #16a34a;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #dbe2ec;
            --shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f0ff 0%, #f4f6fb 100%);
            color: var(--text);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding: 18px 22px;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
        }

        .topbar h1 {
            margin: 0;
            font-size: 2rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .badge.pending {
            background: rgba(245, 158, 11, 0.12);
            color: #a16207;
        }

        .badge.completed {
            background: rgba(22, 163, 74, 0.12);
            color: #166534;
        }

        .layout {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: var(--shadow);
            padding: 20px;
        }

        .panel h2 {
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 1.4rem;
        }

        .form-group {
            margin-bottom: 16px;
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

        input:focus, textarea:focus, select:focus {
            outline: 2px solid rgba(59, 130, 246, 0.2);
            border-color: var(--primary);
        }

        textarea {
            resize: vertical;
            min-height: 110px;
        }

        button {
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        button:hover {
            transform: translateY(-1px);
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
        }

        .btn-danger {
            background: var(--danger);
            color: white;
            border: none;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 10px;
            background: rgba(22, 163, 74, 0.1);
            border: 1px solid rgba(22, 163, 74, 0.2);
            color: #166534;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--panel);
            border-radius: 18px;
            overflow: hidden;
        }

        th, td {
            padding: 16px 14px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            vertical-align: top;
        }

        th {
            background: var(--panel-alt);
            font-size: 0.8rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .task-name {
            font-weight: 700;
            color: var(--text);
        }

        .task-description {
            color: var(--muted);
            line-height: 1.5;
        }

        .task-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 170px;
        }

        .status-form {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .status-form select {
            flex: 1;
        }

        .status-form button {
            width: auto;
            padding-inline: 14px;
        }

        .action-links {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-links a, .action-links button {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: auto;
            min-width: 80px;
        }

        .empty-state {
            text-align: center;
            color: var(--muted);
            padding: 30px 20px;
        }

        @media (max-width: 860px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h1>Personal Task Manager</h1>
            <a href="{{ route('tasks.create') }}" class="btn-primary" style="display:inline-flex; align-items:center; justify-content:center; width:auto; padding:10px 18px; text-decoration:none; color:white; border-radius:10px;">Add Task</a>
        </div>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="layout">
            <section class="panel">
                <h2>Add Task</h2>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="task_name">Task Name</label>
                        <input id="task_name" type="text" name="task_name" value="{{ old('task_name') }}" required>
                        @error('task_name')
                            <div style="color: var(--danger); margin-top: 6px; font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div style="color: var(--danger); margin-top: 6px; font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div style="color: var(--danger); margin-top: 6px; font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input id="due_date" type="date" name="due_date" value="{{ old('due_date') }}">
                        @error('due_date')
                            <div style="color: var(--danger); margin-top: 6px; font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary">Save Task</button>
                </form>
            </section>

            <section class="panel">
                <h2>Task List</h2>

                @if ($tasks->isEmpty())
                    <div class="empty-state">
                        No tasks yet. Add your first task to get started.
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="task-name">{{ $task->task_name }}</td>
                                    <td class="task-description">{{ $task->description ?: 'No description provided.' }}</td>
                                    <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</td>
                                    <td>
                                        <span class="badge {{ strtolower($task->status) }}">{{ $task->status }}</span>
                                    </td>
                                    <td>
                                        <div class="task-actions">
                                            <form action="{{ route('tasks.status', $task) }}" method="POST" class="status-form">
                                                @csrf
                                                <select name="status">
                                                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <button type="submit" class="btn-secondary">Update</button>
                                            </form>

                                            <div class="action-links">
                                                <a href="{{ route('tasks.edit', $task) }}" class="btn-secondary" style="padding: 10px 14px;">Edit</a>

                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </section>
        </div>
    </div>
</body>
</html>
