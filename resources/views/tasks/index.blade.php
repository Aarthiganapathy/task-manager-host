@extends('layouts.app')


@section('css')

<style>
    
    /* Buttons */
    .btn {
        padding: 8px 12px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
        border: none;
    }

    .btn-info:hover {
        background-color: #138496;
        transform: translateY(-2px);
    }

    .btn-warning {
        background-color: #ffc107;
        color: black;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
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

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    }

    /* Custom Pagination Styles */
    .pagination {
        margin: 0;
    }

    .page-item.active .page-link {
        background-color: #6a11cb;
        border-color: #6a11cb;
    }

    .page-link {
        color: #6a11cb;
        border: 1px solid #dee2e6;
        margin: 0 2px;
        border-radius: 4px;
    }

    .page-link:hover {
        color: #6a11cb;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tasks</h1>
            <p class="mb-0">Manage your tasks and create new tasks here.</p>
        </div>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Create Task
            </a>
        </div>
    </div>

    <!-- Management Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Task Management</h6>
            <div class="d-flex align-items-center">
                <span class="badge badge-primary mr-3">Total Tasks: {{ $tasks->total() }}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                <span class="badge {{ $task->status === 'completed' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Compact Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        {{-- Previous Page Link --}}
                        @if ($tasks->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $tasks->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                            @if ($page == $tasks->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($tasks->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $tasks->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection