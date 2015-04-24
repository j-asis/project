<?php
// app/controllers/PostController.php

class PostController extends BaseController
{
    public function post(User $user)
    {
        return View::make('post.create', compact('user'));
    }
    public function savePost()
    {
        $input = Input::all();
        $rules = ['content' => 'required'];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('post_create', $input['user_id'])->withErrors($validator)->withInput();
        }
        $post = new Post;
        $post->user_id = $input['user_id'];
        $post->creator = $input['creator'];
        $post->content = htmlspecialchars($input['content']);
        $post->save();
        return Redirect::route('success')
            ->with('message', 'Successfully Posted!')
            ->with('back_title', 'User\'s Page')
            ->with('back_url', route('profile', $input['user_id']));
    }

    public function edit(Post $post)
    {
        return View::make('post.edit', compact('post'));
    }
    public function saveEdit()
    {
        $input = Input::all();
        $rules = ['content' => 'required'];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('post_edit', $input['post_id'])->withErrors($validator)->withInput();
        }
        $post = Post::findOrFail($input['post_id']);
        $post->content = $input['content'];
        $post->save();

        return Redirect::route('success')
            ->with('message', 'Successfully updated post!')
            ->with('back_title', 'User\'s Profile')
            ->with('back_url', route('profile', $post->user_id));
    }

    public function delete(Post $post)
    {
        $current_user = User::find(Auth::id());

        if ($current_user->id != $post->creator) {
            return Redirect::route('success', $post->user_id);
        }
        $post->delete();
        return Redirect::route('success')
            ->with('message', 'Successfully Deleted Post!')
            ->with('back_title', 'User\'s Profile')
            ->with('back_url', route('profile', $post->user_id));
    }







}