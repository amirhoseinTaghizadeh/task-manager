@extends('layouts.admin')

@section('content')
    <h1>Cards</h1>

    <a href="{{ route('cards.create') }}" class="btn btn-primary">Create Card</a>

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
                        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display: inline">
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
