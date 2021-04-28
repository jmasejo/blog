<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Response;
use Carbon\Carbon;
use Validator;
use Exception;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];

        // get parents
        $parents = Comment::whereNull('parent_id')
            ->orderBy('created_at')
            ->get();

        foreach ($parents as $parent) {
            $data[] = $parent;

            // get child 1st level
            $firstChildren = Comment::where('parent_id', $parent->id)
                ->orderBy('created_at')
                ->get();

            foreach ($firstChildren as $child) {
                $data[] = $child;

                // get grandchildren
                $grandChildren = Comment::where('parent_id', $child->id)
                    ->orderBy('created_at')
                    ->get();

                foreach ($grandChildren as $child) {
                    $data[] = $child;
                }
            }
        }

        $collection = collect($data);

        return Response::json([
            'data' => $this->transform($collection)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = array('response' => '', 'success' => false);

        // validation
        $rules = [
            'id' => 'nullable',
            'name' => 'required|max:50',
            'comment' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {

            $depth = 0;

            //check parent id if not null
            if (!is_null($request->id)) {
                $parent = Comment::where('id', $request->id)
                    ->first();

                //check parent's depth
                if ($parent->depth < 2) {
                    $depth = $parent->depth + 1;
                } else {
                    return $response;
                }
            }

            $comment = Comment::Create([
                'parent_id' => $request->id,
                'name' => $request->name,
                'comment' => $request->comment,
                'depth' => $depth
            ]);

            if ($comment) {
                $response = array('response' => 'Successfully saved', 'success' => true);
            }
        }
        return $response;
    }

    /**
     * Transform for client for easy mapping.
     *
     * 
     */
    private function transform($comments)
    {
        return array_map(function ($comment) {
            return [
                'id' => $comment['id'],
                'comment' => $comment['comment'],
                'name' => $comment['name'],
                'parent' => $comment['parent_id'],
                'depth' => $comment['depth'],
                'created' => Carbon::parse($comment['created_at'])->diffForHumans()
            ];
        }, $comments->toArray());
    }
}
