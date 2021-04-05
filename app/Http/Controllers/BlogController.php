<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('blogs', ['blogs'=> Blog::all()]);
    }

    public function blogs()
    {

        return view('admin/blogs', ['blogs'=> Blog::all()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req) 
    {
        // $blog->create( $request->all() );
        // Create is in writers dashboard
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ]);
        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->title = $request->title;
        $blog->content = $request->content;

        if($request->hasFile('img')) {
            $file = $request->file('img')->store(auth()->user()->email);
            $blog->img = $file;
        }else {
            $blog->img = 'default/default.png';
        }
        $blog->save();

        return redirect()->route('blog.show', $blog)->with('msg' , 'blog added successfully');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog/show', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog = Blog::find($blog);
        
        $blog->update($request->all());

        return redirect()->route('dashboard.profile', $blog)->with('msg' , 'blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {       $blog->delete();

            $this->deleteImage($blog);

            return back()->with('msg', 'blog deleted successfully');
            // return redirect()->route('dashboards.writersdash', $blog)->with('msg' , 'blog deleted successfully');
    }

    private function deleteImage(Blog $blog) {
        // dd(public_path('\storage\\'.$blog->img));
        Storage::delete($blog->img);
    }
}
