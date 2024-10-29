@extends('layouts.app')

@section('content')
    <div class="row" style="margin-left: 19px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>قائمة المهام اليومية</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('task.create') }}">إضافة مهمة جديدة</a>
            </div>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <table class="table table-bordered" style="margin-left: 19px;">
        <tr>
            <th>الرقم</th>
            <th>عنوان المهمة</th>
            <th>وصف المهمة</th>
            <th>تاريخ الاستحقاق</th>
            <th>الحالة</th>
            <th width="280px">الإجراءات</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->status == 'Pending' ? 'معلقة' : 'مكتملة' }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('task.edit', $task->id) }}">تعديل</a>
                    <form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

   
@endsection