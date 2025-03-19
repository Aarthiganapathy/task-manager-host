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

    /* Form Fields */
    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
    }

    .form-label {
        font-weight: 500;
        color: #333;
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

    /* Buttons */
    .btn-primary {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
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
            <h5>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</h5>
            <p>{{ isset($task) ? 'Update the task details.' : 'Add a new task to your task manager.' }}</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($task) ? 'Edit Task Details' : 'Task Details' }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
                @csrf
                @if (isset($task))
                    @method('PUT')
                @endif

                <div class="form-group mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter task title" value="{{ isset($task) ? $task->title : old('title') }}" required>
                </div>
                <div class="form-group mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter task description">{{ isset($task) ? $task->description : old('description') }}</textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ (isset($task) && $task->status === 'pending') ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ (isset($task) && $task->status === 'completed') ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($task) ? 'Update Task' : 'Create Task' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection