<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $user_id=Auth::user()->id;

        $validateUser = Validator::make($request->all(), 
        [
            'title' => 'required|unique:posts',
            'description' => 'required'
           
        ]);

        

        //store the data
        $results=Posts::create([
            'user_id'=>$user_id,
            'title'=>$request->title,
            'description'=>$request->description
        ]);



        if($results){
            return response()->json(['success'=>'Post created'],201);
        }else{
            return response()->json(['errpr'=>'Post not created'],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //get the post

        $post=Posts::where('id',$request->id)->first();

        if($post){
            //means the post was found so check for the auther

            $author=$post->user_id;

            if($author==Auth::user()->id){
                //then proceed to update the post
                if($request->has('title')){
                    //update title

                    $post->update(['title'=>$request->title]);

                    if($post){
                        return response()->json(['success'=>'Title updated']);
                    }
                }else if($request->has('description')){
                    $post->update(['description'=>$request->description]);

                    if($post){
                        return response()->json(['success'=>'description updated']);
                    }    
                }else{
                    return response()->json(['error'=>'nothing updated']);
                }

                
            }else{
                return response()->json(['error'=>'an error occured']);
            }

        
        }else{
            //post not found
            return response()->json(['error'=>'The post was not found']);
        }

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
