<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     *
     */
    public function index()
    {
        return view('user.index', [
            'users' => User::paginate(15),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()
                ->route('users');
        }

        return view('user.edit', [
            'user' => $user,
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->delete()) {
                return response()->json([
                    'error' => false,
                    'message' => 'User deleted',
                ]);
            }
        }

        return response()->json([
            'error' => true,
            'message' => 'User cannot be deleted',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('users.edit', ['id' => 0])
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return redirect()
                ->route('users');
        }

        return redirect()
            ->route('users.edit', ['id' => 0])
            ->withInput();
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('users.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect()
                ->route('users');
        }

        return redirect()
            ->route('users.edit', ['id' => $id])
            ->withInput();
    }
}
