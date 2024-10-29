@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>تعديل المهمة</h2>
            </div>
            <div class="col-md-6 text-end">
                <a class="btn btn-primary" href="{{ route('task.index') }}"> العودة</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>خطأ!</strong> هناك بعض المشاكل في إدخالك.
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Display session errors -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-4 shadow-sm">
            <form action="{{ route('task.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label"><strong>عنوان المهمة:</strong></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="أدخل عنوان المهمة" value="{{ old('title', $task->title) }}" >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>وصف المهمة:</strong></label>
                    <textarea name="description" id="description" class="form-control" placeholder="أدخل وصف المهمة" rows="3" required>{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="form-label"><strong>تاريخ الاستحقاق:</strong></label>
                    <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}" >
                </div>

                @if (auth()->id() === $task->user_id)
                    <div class="mb-4">
                        <label for="status" class="form-label"><strong>حالة المهمة:</strong></label>
                        <select name="status" id="status" class="form-control">
                            <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                @endif

                <div class="text-center">
                    <button type="submit" class="btn btn-success">تحديث المهمة</button>
                </div>
            </form>
        </div>
    </div>
@endsection