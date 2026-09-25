@php
    $isEdit = isset($task) && $task instanceof \App\Models\Task;
    $formAction = $isEdit ? route('tasks.update', $task) : route('tasks.store');
    $method = $isEdit ? 'PUT' : 'POST';
    $taskName = old('task_name', $isEdit ? $task->task_name : '');
    $description = old('description', $isEdit ? $task->description : '');
    $status = old('status', $isEdit ? $task->status : 'Pending');
    $dueDate = old('due_date', $isEdit && $task->due_date ? $task->due_date->format('Y-m-d') : '');
@endphp

<form action="{{ $formAction }}" method="POST">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="task_name">Task Name</label>
        <input id="task_name" type="text" name="task_name" value="{{ $taskName }}" required>
        @error('task_name')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description">{{ $description }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Completed" {{ $status == 'Completed' ? 'selected' : '' }}>Completed</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="due_date">Due Date</label>
        <input id="due_date" type="date" name="due_date" value="{{ $dueDate }}">
        @error('due_date')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="actions">
        <button type="submit" class="btn-primary">{{ $isEdit ? 'Update Task' : 'Save Task' }}</button>
        <a href="{{ route('home') }}" class="btn-secondary">Back</a>
    </div>
</form>
