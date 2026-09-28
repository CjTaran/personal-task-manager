<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Personal Task Manager</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: radial-gradient(circle at top, rgba(216, 180, 254, 0.8) 0%, rgba(168, 85, 247, 0.72) 18%, rgba(30, 27, 75, 0.96) 60%, rgba(0, 0, 0, 1) 100%);
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
        }

        .subtitle {
            color: #666;
            margin-top: 8px;
        }

        .add-button {
            background: #000000;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 6px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #111111;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .task-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-name {
            font-size: 20px;
            font-weight: bold;
        }

        .status {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .description {
            color: #555;
            margin: 12px 0;
        }

        .due-date {
            color: #666;
            font-size: 14px;
        }

        .actions {
            margin-top: 15px;
            display: flex;
            gap: 8px;
        }

        .actions a,
        .actions button {
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .edit {
            background: #e0e7ff;
            color: #3730a3;
        }

        .complete {
            background: #dcfce7;
            color: #166534;
        }

        .delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            color: #777;
        }

        @media (max-width: 600px) {

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .task-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>
                Personal Task Manager
            </h1>

        </div>

        <a
            href="{{ route('tasks.create') }}"
            class="add-button"
        >
            + Add New Task
        </a>

    </div>

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    @if ($tasks->count() > 0)

        @foreach ($tasks as $task)

            <div class="task-card">

                <div class="task-header">

                    <div class="task-name">
                        {{ $task->task_name }}
                    </div>

                    <span class="status
                        {{ $task->status === 'Completed'
                            ? 'completed'
                            : 'pending' }}">

                        {{ $task->status }}

                    </span>

                </div>

                @if ($task->description)

                    <div class="description">
                        {{ $task->description }}
                    </div>

                @endif

                @if ($task->due_date)

                    <div class="due-date">
                        Due:
                        {{ $task->due_date->format('F d, Y') }}
                    </div>

                @endif

                <div class="actions">

                    <a
                        href="{{ route('tasks.edit', $task) }}"
                        class="edit"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('tasks.status', $task) }}"
                        method="POST"
                    >

                        @csrf

                        @method('PATCH')

                        <button
                            type="submit"
                            class="complete"
                        >
                            {{ $task->status === 'Pending'
                                ? 'Mark Completed'
                                : 'Mark Pending' }}
                        </button>

                    </form>

                    <form
                        action="{{ route('tasks.destroy', $task) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty">

            <h2>
                No tasks yet.
            </h2>

            <p>
                Click "Add New Task" to create your first task.
            </p>

        </div>

    @endif

</div>

</body>

</html>