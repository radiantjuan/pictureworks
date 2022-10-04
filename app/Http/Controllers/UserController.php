<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    /**
     * index page for backend processing
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) {
        $user = User::find($request->id);
        if (empty($user)) {
            //if user doesn't exist return 404 not found
            abort(404);
        }
        $user_comments = json_decode($user->comments, true);
        return view('users', compact(['user', 'user_comments']));
    }

    /**
     * index page for the ajax behavior page
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index_ajax(Request $request) {
        return view('users-ajax');
    }

    /**
     * Fetch the user info from the DB
     *
     * @return \App\Http\Resources\UserResource
     */
    public function get_user_info($id) {
        $user = User::find(!empty($id) ? $id : 1);
        return new UserResource($user);
    }
}
