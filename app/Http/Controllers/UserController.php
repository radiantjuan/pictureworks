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
     * Add comment to the queried user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add_comment(Request $request) {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
            'password' => ['required', 'min:5'],
            'comment' => ['required', 'min:15']
        ]);

        $user = User::find($request->id);
        $hasher = app('hash');

        if (!empty($user)) {
            if ($hasher->check($request->password, $user->password)) {
                // Success
                $comments = json_decode($user->comments);
                array_push($comments, $data['comment']);
                $user->comments = json_encode($comments);
                $user->update();
                return redirect('/users/' . $user->id);
            } else {
                return redirect('/users/' . $user->id)->withErrors(['password' => 'the password you entered is incorrect']);
            }
        } else {
            return redirect('/users/1')->withErrors(['id' => 'ID does not exist']);
        }
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

    /**
     * Comment via AJAX request
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function add_comment_ajax(Request $request) {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
            'password' => ['required', 'min:5'],
            'comment' => ['required', 'min:15']
        ]);

        $user = User::find($request->id);
        $hasher = app('hash');

        if (!empty($user)) {
            if ($hasher->check($request->password, $user->password)) {
                // Success
                $comments = json_decode($user->comments);
                array_push($comments, $data['comment']);
                $user->comments = json_encode($comments);
                $user->update();
                return new UserResource($user);
            } else {
                return response([
                    'errors' => [
                        'password' => 'the password you entered is incorrect'
                    ]
                ], 422);
            }
        } else {
            return response([
                'errors' => [
                    'id' => 'ID does not exists in the DB'
                ]
            ], 422);
        }
    }
}
