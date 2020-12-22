<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        return view('users.show', [
            'user' => $user,
        ]);
    }
    public function follow(Request $request, string $name) #このURLに組み込まれて渡ってきた引数の$nameは受動側　requestを送ってくるのは当然能動
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->followings()->detach($user); #$request->user()ではrequestを行なったuserのuserモデルが返る　followings()なのでリレーションメソッド。動的プロパティではない
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }
        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }


}
