<form action="{{ route('reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="3" required>{{ old('content', $review->content) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control" id="rating" name="rating" value="{{ old('rating', $review->rating) }}" min="1" max="5" step="0.1" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
