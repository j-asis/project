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
        $params = array(
            'message'    => 'Successfully Posted!',
            'back_title' => 'User\'s Page',
            'back_url'   => route('profile', $input['user_id'])
        );
        return View::make('success', $params);
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
        $params = array(
            'message'    => 'Successfully updated post!',
            'back_title' => 'User\'s profile',
            'back_url'   => route('profile', $post->user_id)
        );
        return View::make('success', $params);
    }

    public function delete(Post $post)
    {
        $current_user = User::find(Session::get('user_id'));
        $params = array(
            'message'    => 'Successfully Deleted Post!',
            'back_title' => 'User\'s Profile',
            'back_url'   => route('profile', $post->user_id)
        );
        if ($current_user->id != $post->creator) {
            $params['message'] = 'Cannot Delete other users post!';
            return View::make('success', $params);
        }
        $post->delete();
        return View::make('success', $params);
    }







}