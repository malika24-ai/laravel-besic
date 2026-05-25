<x-app>

    <x-slot:title>{{ $title }}</x-slot>


    <a class="btn btn-warning mb-3" href="{{ route('department.index') }}" role="button">Back</a>

    {{-- department --}}
    <h4>Data Derpartment</h4>
    <ul class="list-group mb-3">
        <li class="list-group-item">name : {{ $department->name }}</li>
        <li class="list-group-item">
            Created at : {{ $department->created_at->format('d F Y H:i:s') }}

        </li>
        <li class="list-group-item">
            Last updated : {{ $department->updated_at->diffForHumans() }}
    </ul>

    {{-- lecturer --}}
    <h4>Data Lecturers</h4>
    <ul class="list-group">
        @foreach ($department->lecturers as $lecturer)
            <li class="list-group-item">{{ $lecturer->name }}</li>
        @endforeach
    </ul>


</x-app>
