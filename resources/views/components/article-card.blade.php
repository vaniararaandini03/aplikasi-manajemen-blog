<div class="flex justify-between border-b py-6">
    <div class="pr-6">
        <p class="text-sm text-gray-500">
            {{ $article->user->name }} · {{ $article->created_at->diffForHumans() }}
        </p>

        <h2 class="text-xl font-bold mt-1">
            {{ $article->title }}
        </h2>

        <p class="text-gray-600 mt-2 line-clamp-2">
            {{ Str::limit(strip_tags($article->content), 120) }}
        </p>

        <div class="mt-3 flex items-center gap-4 text-sm text-gray-500">
            <span>#{{ $article->category->name }}</span>
            <span>⭐ {{ $article->views }} views</span>
        </div>
    </div>

    @if($article->thumbnail)
    <img src="{{ asset('storage/'.$article->thumbnail) }}"
         class="w-32 h-24 object-cover rounded">
    @endif
</div>
