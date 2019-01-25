<?php
/**
 * Created by PhpStorm.
 * User: Suhich
 * Date: 18.01.2019
 * Time: 17:47
 */

namespace App\Repositories;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class PostRep
 * @package App\Repositories
 */
class PostRep
{

    /**
     * @param int $id
     * @return Post
     */
    public function findOrFail(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * @param int $id
     * @return Post []
     */
    public function findByUserIdOrFail(int $id): array
    {
         return User::findOrFail($id)->posts->all();
    }

    /**
     * @param array $fields
     */
    public function create(array $fields): void
    {
        Post::create($fields);
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        Post::find($id)->delete();
    }

    /**
     * @param int $id
     * @param array $fields
     */
    public function edit(int $id, array $fields): void
    {
        Post::find($id)->update($fields);
    }

}