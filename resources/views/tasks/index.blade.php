<x-app-layout>
    <div class="container mt-4">
        <h2>Task Management System</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description ?? 'No description' }}</td>
                        <td><span class="badge {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($task->status) }}
                        </span></td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No tasks found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $tasks->links() }}
    </div>
</x-app-layout>
