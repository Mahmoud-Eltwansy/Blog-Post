<x-layout>
    <x-setting heading="Manage Post">
        <table class="table-auto">
            <div class="bg-white">

                <div class="overflow-x-auto border-x border-t">
                    <table class="table-auto w-full">
                        <tbody>
                        <tr class="text-left text-xl">
                            <th class="p-5">Title</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4">
                                    <a href="/posts/{{$post->slug}}">
                                    {{$post->title}}
                                    </a>
                                </td>
                                <td class="p-4">
                                    <a href="/admin/posts/{{$post->id}}/edit" class="text-blue-600">Edit</a>
                                </td>
                                <td class="p-4">
                                   <form method="post" action="/admin/posts/{{$post->id}}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-xs text-gray-400">Delete</button>
                                   </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </table>
    </x-setting>
</x-layout>
