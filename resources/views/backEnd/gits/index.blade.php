@extends('backEnd.layouts.master')

@section('title')
    Get in Touch Messages
@endsection

@section('content')
    <div class="container">
        <h1 class="my-4">Get in Touch Messages</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->message }}</td>
                        <td>
                            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}&body=Hello {{ $message->name }},%0D%0A%0D%0A[Your response here]" class="btn btn-primary">Reply</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $messages->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('build/js/app.js') }}"></script>
@endsection