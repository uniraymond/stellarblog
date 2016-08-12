<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Blog;
use App\User;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('published_at','<=',date('now'))
            ->where('active', 1)

            // not sure wheater need to add the deleted_at condition
//            ->where('deleted_at','=', '0000-00-00 00:00:00' )
            
            ->paginate(5);

        return view('blog/index', ['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body'  => 'required',
            'published_at' => 'required|date',

        ]);

        $authuser = $request->user();

        $title = $request['title'];
        $body = trim($request['body']);
        $publishedAt = date('Y-m-d H:i:s', strtotime($request['published_at'] ? $request['published_at'] : 'now'));
        $active = $request['active'] ? 1 : 0;
        $userId = $authuser->id;

        $blog = new Blog();
        $blog->title = $title;
        $blog->body = $body;
        $blog->published_at = $publishedAt;
        $blog->user_id = $userId;
        $blog->active = $active;
        $blog->save();

        $request->session()->flash('status', 'Blog: '. $title .' has been added.');
        return redirect('blog');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog/show', ['blog'=>$blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findorFail($id);

        return view('blog/edit', ['blog'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $authuser = $request->user();
        $this->validate($request, [
            'title' => 'required|max:255',
            'body'  => 'required',
            'published_at' => 'required|date',
        ]);
        
        $title = $request['title'];
        $body = trim($request['body']);
        $publishedAt = date('Y-m-d H:i:s', strtotime($request['published_at']));
        $active = $request['active'] ? 1 : 0;
        $userId = $request['user_id'];
        
        if ($authuser->id != $userId) {
            $request->session()->flash('warning', 'You do not have authority to edit this blog.');
            return redirect('blog/'.$id.'/edit');
        }
        
        $blog = Blog::find($id);
        $blog->title = $title;
        $blog->body = $body;
        $blog->published_at = $publishedAt;
        $blog->user_id = $authuser->id;
        $blog->active = $active;
        $blog->save();

        $request->session()->flash('status', 'Blog: '. $title .' has been updated.');
        return redirect('blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request, int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $authuser = $request->user();

        $blog = Blog::find($id);

        if ($authuser->id != $blog->user_id) {
            $request->session()->flash('warning', 'You do not have authority to delete this blog.');
            return redirect('blog/'.$id);
        }
        $title = $blog->title;
        $blog->delete();

        $request->session()->flash('status', 'Blog: '. $title .' has been deleted.');
        return redirect('blog');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request, int  $id
     * @return \Illuminate\Http\Response
     */
    public function markdeleteblog(Request $request, $id)
    {
        $authuser = $request->user();

        $blog = Blog::find($id);

        if ($authuser->id != $blog->user_id) {
            $request->session()->flash('warning', 'You do not have authority to delete this blog.');
            return redirect('blog/'.$id);
        }
        $title = $blog->title;
        $blog->deleted_at = date("Y-m-d H:i:s");
        $blog->save();

        $request->session()->flash('status', 'Blog: '. $title .' has been marked as deleted.');
        return redirect('blog');
    }

}
