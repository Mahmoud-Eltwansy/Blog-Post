@auth()
    <x-panel>
        <form method="POST" action="/posts/{{$post->slug}}/comments">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/40?u={{auth()->id()}}" alt="" width="40" height="40"
                     class="rounded-full">
                <h2 class="pl-4">Want to participate?</h2>
            </header>
            <x-form.field>
                <x-form.textarea name="body" placeholder="Think of something to write!"/>
                <x-form.error name="body"/>
            </x-form.field>

            <div class="flex-justify-end mt-6 pt-6 border-t border-gray-300 ">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> Or
        <a href="/login" class="hover:underline">Login</a>
        to leave a comment.
    </p>
@endauth
