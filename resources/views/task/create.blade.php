@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2>إضافة مهمة جديدة</h2>
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

        <div class="card p-4 shadow-sm">
            <form action="{{ route('task.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label"><strong>عنوان المهمة:</strong></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="أدخل عنوان المهمة" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label"><strong>وصف المهمة:</strong></label>
                    <textarea name="description" id="description" class="form-control" placeholder="أدخل وصف المهمة" rows="3" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="due_date" class="form-label"><strong>تاريخ الاستحقاق:</strong></label>
                    <input type="date" name="due_date" id="due_date" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">إضافة المهمة</button>
                </div>
            </form>
        </div>
    </div>
@endsection