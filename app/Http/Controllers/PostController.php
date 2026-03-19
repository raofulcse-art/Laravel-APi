<?php

namespace App\Http\Controllers;
use App\Models\Post;


use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

use Illuminate\Http\Resource;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::with('user')->paginate());
        //return PostResource::collection(Post::with('user')->get());
        //return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        $inputvalues = $request->validated();
        $inputvalues['title'] = strip_tags($inputvalues['title']);
        $inputvalues['body'] = strip_tags($inputvalues['body']);
        $inputvalues['user_id'] = 1;

        $post = Post::create($inputvalues);

        //return response()->json($post,201);
        return (new PostResource($post))
        ->response()
        ->setStatusCode(201);
        //return $request->only('title');
        //return $request->all();
        /*
        return response()->json([
            'id' => 1,
            'name' => 'Dipto',
            'age' => 20
        ],201);
        */
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        /*
        return response()->json([
            'id' => 1,
            'name' => 'Dipto',
            'age' => 20
        ])
        ->header('Test','Zura');
        ;*/
        //$post = Post::findorFail($id);

        //return response()->json($post);
        return (new PostResource($post))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $inputvalues = $request->validate([
            'title' => ['required' , 'min:5'],
            'body' => ['required']
        ]);

        $post->update($inputvalues);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response()->noContent();
    }
}
