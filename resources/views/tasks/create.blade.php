<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Task</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: radial-gradient(circle at top, rgba(216, 180, 254, 0.85) 0%, rgba(168, 85, 247, 0.7) 22%, rgba(30, 27, 75, 0.96) 60%, rgba(0, 0, 0, 1) 100%);
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        p {
            color: #666;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #000000;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #000000;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error ul {
            margin-bottom: 0;
        }
    </style>

</head>

<body>

<div class="container">

    <a href="{{ route('tasks.index') }}" class="back">
        ← Back to Tasks
    </a>

    <div class="card">

        <h1>Add New Task</h1>

        <p>Create a task and keep track of its progress.</p>

        @if ($errors->any())

            <div class="error">

                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <form action="/tasks" method="POST">

            @csrf

            <div class="form-group">

                <label for="task_name">
                    Task Name
                </label>

                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ old('task_name') }}"
                    placeholder="Enter task name"
                    required
                >

            </div>

            <div class="form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Enter task description"
                >{{ old('description') }}</textarea>

            </div>

            <div class="form-group">

                <label for="status">
                    Status
                </label>

                <select id="status" name="status" required>

                    <option
                        value="Pending"
                        {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="Completed"
                        {{ old('status') === 'Completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label for="due_date">
                    Due Date
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                >

            </div>

            <button
                type="submit"
                class="submit-button"
            >
                Add Task
            </button>

        </form>

    </div>

</div>

</body>

</html>