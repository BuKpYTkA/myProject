<?php

namespace App\Http\Controllers;

use App\Repositories\PostRep;
use App\Repositories\UserRep;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserRep
     */
    public $userRep;
    /**
     * @var PostRep
     */
    public $postRep;

    public function __construct()
    {
        $this->userRep = new UserRep();
        $this->postRep = new PostRep();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPersonalForm()
    {
        return view('cabinet.mainCabinet', [
            'user' => auth()->user()
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function returnHome()
    {
        return redirect(route('posts.postsByAlias', auth()->user()->alias));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editPersonal(Request $request)
    {
        $rules = (new \App\User)->getUserInfoRules();
        $this->validate($request, $rules);
        $fields = [
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'alias' => $request->post('alias'),
        ];
        $this->userRep->editPersonal(auth()->user()->id, $fields);
        return redirect(route('cabinet.mainCabinet'))->withErrors(array('success' => 'информация успешно изменена'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPasswordForm()
    {
        return view('cabinet.editPassword');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editPassword(Request $request)
    {
        if (!$this->userRep->checkPassword($request->post('oldPass'))) {
            return redirect(route('cabinet.editPasswordForm'))->withErrors(array('oldPass' => 'incorrect password'));
        }
        $rules = (new \App\User)->getPasswordRules();
        $this->validate($request, $rules);
        $this->userRep->editPassword($request->post('newPass'));
        return redirect(route('cabinet.editPasswordForm'))->withErrors(array('success' => 'пароль успешно изменен'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function searchUser(Request $request)
    {
        $rules = ['searchRequest' => 'string|min:1'];
        $this->validate($request, $rules);
        $searchRequest = $request->post('searchRequest');
        if (is_numeric($searchRequest)) {
            $userById = $this->userRep->findByIdOrNull(intval($searchRequest));
            $userByAlias = $this->userRep->findByAliasOrNull($searchRequest);
            if (($userByAlias) && ($userById)) {
                return view('searchResult', [
                    'result' => $searchRequest,
                ]);
            }
            if ($userById) {
                return redirect(route('posts.postsById', $userById['id']));
            }
        }
        if ($this->userRep->findByAliasOrNull($searchRequest)) {

            return redirect(route('posts.postsByAlias', $searchRequest));
        }
        $searchRequest = null;
        return view('searchResult', [
            'result' => $searchRequest,
        ]);

    }
}
