<?php

namespace App\Api\Controllers;

use App\Api\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;


class CommentController extends Controller
{

	/**
     * Fraud Case model instance
     *
     * @var FraudCase
     */
    private $fraudCase;


     /**
     * Class constructor
     *
     * @param User $user
     * @param FraudCase $fraudCase
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
    //
    public function flagFraud(Request $request)
    {
    	$data = $request->except('_token');
    	$this->model->fill($data);
    	$this->model->save();
    	return response()->json([
    		'message' => 'Comment Saved Successfully',
    		'comment' => $this->model
    		]);
    }
}
