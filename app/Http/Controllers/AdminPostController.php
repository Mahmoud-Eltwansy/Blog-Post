<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }


    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('admin.posts.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|Application
    {
        $post = new Post();
        $attributes = $this->validatePost($post);
        $path = request()->file('thumbnail')->store('/thumbnails');
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = $path;

        // Copy the file to the public directory
        Storage::disk('public')->put('thumbnails/' . basename($path), Storage::disk('local')->get($path));
        Storage::disk('local')->delete($path);

        Post::create($attributes);

        return redirect('/');
    }

    public function update(Post $post): \Illuminate\Http\RedirectResponse
    {
        $attributes = $this->validatePost($post);

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('/thumbnails');
        }

        $post->update($attributes);
        return back()->with('success', 'Post Updated Successfully!');
    }

    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->delete();

        return back()->with('success', 'Post Deleted Successfully!');
    }

    protected function validatePost(Post $post): array
    {
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique("posts", "slug")->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
