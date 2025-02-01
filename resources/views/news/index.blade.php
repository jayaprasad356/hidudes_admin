@extends('layouts.admin')

@section('title', 'News Management')
@section('content-header', 'News Management')
@section('content-actions')
   
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Telegram</th>
                        <th>WhatsApp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsList as $news)
                    <tr>
                        <td>{{ $news->id }}</td>
                        <td>{{ $news->telegram }}</td>
                        <td>{{ $news->whatsapp }}</td>
                        <td>
                            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
