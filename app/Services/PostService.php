<?php
namespace App\Services;

use App\Forms\IForm;
use App\Mail\NewPost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PostService implements IService
{
    /**
     * @var Post $model
     */
    public $model;

    /**
     * PostService constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @param IForm $form
     * @return mixed|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(IForm $form)
    {
        $form->validate();

        $post = new Post();
        $form->loadFromModel($post);
        //assign user and create slug
        $post->user_id = Auth::user()->id;
        $post->slug = Str::of($form->title)->slug('-');
        $post->save();
        //notify subscribers
        $this->notify($post->id);

        return $post;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        // TODO: Implement remove() method.
    }

    /**
     * notify subscribers about
     * the new post
     * @param $postId
     */
    public function notify($postId)
    {
        $post = $this->findById($postId);
        $subscribers = $post->website->subscribers;
        if (count($subscribers)){
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->queue(new NewPost($post));
            }
        }
    }
}
