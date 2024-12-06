@extends('backEnd.layouts.master')
@section('title')
Sections
@endsection
@section('content')
    <div class="container">
        <h1>Sections</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->title }}</td>
						
                        <td>{{ $section->slug }}</td>
                        <td>{{ $section->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <!-- Add toggle status button if needed -->
							  <!-- Delete Form -->
							<form action="{{ route('sections.destroy', $section->id) }}" method="POST" 	style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this section?');">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
<!-- App js -->
<script src="{{ asset('build/js/app.js') }}"></script>
@endsection
