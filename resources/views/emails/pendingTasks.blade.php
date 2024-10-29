<h2>مرحباً {{ $user->name }}</h2>

<p>لديك المهام التالية ما زالت معلقة:</p>

<ul>
    @foreach ($tasks as $task)
        <li>
            <strong>عنوان المهمة:</strong> {{ $task->title }}<br>
            <strong>وصف:</strong> {{ $task->description }}<br>
            <strong>تاريخ الاستحقاق:</strong> {{ $task->due_date }} <br>
        </li>
    @endforeach
</ul>

<p>يرجى متابعتها وإنهائها في أقرب وقت ممكن.</p>