<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BidController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function store(Request $request) {
        Validator::make($request->all(), [
            'amount' => ['required', 'numeric'],
            'post_id' => ['required'],
        ])->validate();

        $post = Post::find($request->post_id);

        $bid = Bid::create([
            'amount' => $request->amount,
            'user_id' => 1,
            'post_id' => $request->post_id,
        ]);
    }

    public function destroy($id) {
        $bid = Bid::find($id);

        $bid->destroy();
    }

}
