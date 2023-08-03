@extends('layouts.app')

@section('content')
    <h1>Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge badge-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('users.assignRole', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            <div class="form-group">
                                <select name="role_id" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Assign Role</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>Cards</h1>
    <h2>Assign Cards to Users</h2>
    <form action="{{ route('admin.assign_card') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="card_id">Select Card:</label>
            <select name="card_id" id="card_id" class="form-control">
                @foreach($cards as $card)
                    <option value="{{ $card->id }}">{{ $card->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Card</button>
    </form>

    <h2>Manage Cards</h2>
    <a href="{{ route('admin.create_card') }}" class="btn btn-primary">Create Card</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cards as $card)
                <tr>
                    <td>{{ $card->id }}</td>
                    <td>{{ $card->title }}</td>
                    <td>{{ $card->description }}</td>
                    <td>
                        <a href="{{ route('admin.edit_card', $card->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.delete_card', $card->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
