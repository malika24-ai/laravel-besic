<x-app>

    <x-slot:title>{{ $title }}</x-slot>

    @session('success')
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endsession

<a class="btn btn-primary mb-3" href="{{ route ('department.create') }}" role="button">Create</a>

    <ul class="list-group">
        @foreach ($departments as $department)
            <li class="list-group-item">{{ $loop->iteration }} -- {{ $department->nim }} --{{ $department->name }}
                <a class="btn btn-warning btn-sm " href="{{ route ('department.edit',$department) }}" 
                role="button">edit</a>
                <form action="{{ route ('department.destroy',$department) }}" method="POST" class="d-inline" >
    @method('DELETE')
    @csrf

    <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin')">Delete</button>

</form>

            </li>
        @endforeach
    </ul>

</x-app>

