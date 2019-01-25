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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class UserRep
 * @package App\Repositories
 */
class UserRep
{
    /**
     * @param string $alias
     * @return User|null
     */
    public function findByAliasOrNull(string $alias): ?User
    {
        return User::where('alias', $alias)->get()->first();
    }

    /**
     * @param string $alias
     * @return User
     */
    public function findByAliasOrFail(string $alias): User
    {
        $user = User::where('alias', $alias)->get()->first();
        if ($user) {
            return $user;
        }
        throw (new ModelNotFoundException)->setModel($alias);
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findByIdOrNull(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param int $id
     * @return User
     */
    public function findByIdOrFail(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @param int $id
     * @return User
     */
    public function findByPostId(int $id): User
    {
        return Post::find($id)->user;
    }

    /**
     * @param int $id
     * @param array $fields
     */
    public function editPersonal(int $id, array $fields): void
    {
        User::find($id)->update($fields);
    }

    /**
     * @param string $oldPassword
     * @return bool
     */
    public function checkPassword(string $oldPassword): bool
    {
        if (Hash::check($oldPassword, Auth::user()->getAuthPassword())) {
            return true;
        }
        return false;
    }

    /**
     * @param string $newPassword
     */
    public function editPassword(string $newPassword): void
    {
        User::find(auth()->user()->id)->update(['password' => Hash::make($newPassword)]);
    }
}