<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\PostRep;
use App\Repositories\UserRep;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @var PostRep
     */
    public $postRep;
    /**
     * @var UserRep
     */
    public $userRep;

    /**
     * PostController constructor.
     */
    public function __construct()
    {

        $this->postRep = new PostRep();
        $this->userRep = new UserRep();
    }

    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postsByUserAliasForm(string $alias)
    {
        $user = $this->userRep->findByAliasOrFail($alias);
        $posts = $this->postRep->findByUserIdOrFail($user->getId());
        return view('posts.userPosts', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postsByUserIdForm(int $id)
    {
        $posts = $this->postRep->findByUserIdOrFail($id);
        $user = $this->userRep->findByIdOrFail($id);
        return view('posts.userPosts', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPost(int $id)
    {
        $post = $this->postRep->findOrFail($id);
        $user = $this->userRep->findByPostId($id);
        return view('posts.post', [
            'post' => $post,
            'userName' => $user->getName(),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPostForm(int $id)
    {
        $post = $this->postRep->findOrFail($id);
        if ($post->getUserId() === auth()->user()->id) {
            return view('posts.editPostForm', [
                'post' => $post
            ]);
        }
        return abort(404);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editPost(Request $request, int $id)
    {
        $rules = (new \App\Post)->getPostRules();
        $this->validate($request, $rules);
        $fields = [
            'caption' => $request->post('caption'),
            'body' => $request->post('body'),
        ];
        $this->postRep->edit($id, $fields);
        return redirect(route('posts.editPostForm', $request->post('id')));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPostForm()
    {
        return view('posts.createPostForm');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createPost(Request $request)
    {
        $rules = (new \App\Post)->getPostRules();
        $this->validate($request, $rules);
        $fields = [
            'user_id' => auth()->user()->id,
            'caption' => $request->post('caption'),
            'body' => $request->post('body'),
        ];
        $this->postRep->create($fields);
        return redirect(route('posts.myPosts'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deletePost(int $id)
    {
        $this->postRep->delete($id);
        return redirect(route('posts.myPosts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myPosts()
    {
        $posts = $this->postRep->findByUserIdOrFail(auth()->user()->id);
        return view('posts.myPosts', [
            'posts' => $posts
        ]);
    }
}
