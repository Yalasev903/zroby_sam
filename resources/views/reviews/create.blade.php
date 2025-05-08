@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Залишити відгук про виконавця</h2>
    <form action="{{ route('reviews.store', $order) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Оцінка (1-5)</label>
            <select name="rating" id="rating" class="form-control">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Коментар</label>
            <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Залишити відгук</button>
    </form>
</div>
@endsection
