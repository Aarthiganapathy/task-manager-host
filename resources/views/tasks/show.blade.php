@extends('layouts.app')


@section('css')

<style>

    /* Header Section */
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 30px;
        padding: 20px;
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        border-radius: 12px;
        color: white;
    }

    .header h5 {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 600;
    }

    .header p {
        margin: 0;
        font-size: 1rem;
        opacity: 0.9;
    }

    
    /* Card Design */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 12px 12px 0 0;
    }

    .card-body {
        padding: 20px;
    }

    /* Status Badges */
    .badge {
        padding: 8px 12px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
        }
    }


    


</style>

@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="header">
        <div>
            <h5>Task Details</h5>
            <p>View the details of the selected task.</p>
        </div>
    </div>

    <!-- Task Details Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Task Information</h6>
        </div>
        <div class="card-body">
            <div class="task-details">
                <h3 class="task-title">{{ $task->title }}</h3>
                <p class="task-description">{{ $task->description }}</p>
                <div class="task-status">
                    <span class="badge {{ $task->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </div>
            </div>
            <div class="task-actions mt-4">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Task
                </a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
                        <i class="fas fa-trash"></i> Delete Task
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection