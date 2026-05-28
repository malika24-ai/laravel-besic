<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endsession

    <a class="btn btn-primary mb-3" href="{{ route('student.create') }}" role="button">Create</a>

    <ul class="list-group">
        @foreach ($students as $student)
            <li class="list-group-item">{{ $loop->iteration }} -- {{ $student->nim }} --
                {{ $student->name }}--{{ $student->gender }}
                <form action="{{ route('student.restore', $student) }}" method="POST" class="d-inline">
                    @method('PUT')
                    @csrf

                    <button type="submit" class="btn btn-warning"
                        onclick="return confirm
                    ('Anda yakin mengembalikan data')
">Restore</button>

                </form>

                <form action="{{ route('student.force-delete', $student) }}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm
                    ('Anda yakin ingin menghapus secara permanent')">Force
                        Delete</button>

                </form>

            </li>
        @endforeach
    </ul>

</x-app>
