@props(['comment'])

<x-panel class="bg-gray-50">
    <article class="flex  space-x-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/150?u={{$comment->user_id}}" width="60" height="60" class="rounded-xl">
        </div>

        <div>
            <header>
                <h3 class="font-bold">{{$comment->author->username}}</h3>
                <p class="text-xs">
                    Posted
                    <time>{{$comment->created_at->format('F j, Y, g:i a')}}</time>
                </p>
            </header>

            <p class="mt-4">
                {{$comment->body}}
            </p>
        </div>

    </article>
</x-panel>
