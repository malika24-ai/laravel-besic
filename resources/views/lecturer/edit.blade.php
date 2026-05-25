<x-app>

    <x-slot:title>{{ $title }}</x-slot>

<form method="POST" action="{{ route ('lecturer.update', $lecturer->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror"
    id="name" name="name" value="{{ old('name', $lecturer->name) }}">
    @error('name')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
    
    </div>
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">department_id</label>

<select class="form-select" @error('department_id') is-invalid @enderror id="department_id" 
name="department_id" value="{{ old('department_id', $lecturer->department_id) }}">
    <option value="">Choose Department</option>
    @foreach ($departments as $department) 
    <option value="{{ $department->id }}"
        @selected(old('department_id') == $department->id)>
        {{ $department->name }}
    </option>
        
    @endforeach
</select>


    @error('department_id')
    <div class="invalid-feedback">{{ $message }}
    </div>
@enderror
    
    </div>

<a class="btn btn-warning" href="{{ route ('lecturer.create') }}" 
role="button">Cancel</a>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


</x-app>

