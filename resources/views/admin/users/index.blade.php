@extends('layouts.admin')

@section('title', 'Data User')

@section('content')
<div class="container py-4">
    <h1>Users Data</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>email_verified_at</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at ? $user->email_verified_at->format('d M Y') : 'Not verified' }}</td>
                <td>
                    {{DELETE USER}}
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" 
                          onsubmit="return confirm('DELETE USER?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">DELETE</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">User not found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
