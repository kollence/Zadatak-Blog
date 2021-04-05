<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    
   public function index()
   {                    
       $users = User::all();
        
       return view('admin/profile', ['users'=> $users]);
   }

   public function blogs()
   {
       # code...
   }


   public function create(Request $request) 
   {



       // $blog->create( $request->all() );
       
   }

   
   public function store(Request $request)
   {

   }


   public function show(User $user)
   {
    //    return view('blog/show', ['blog' => $blog]);
   }

   public function edit(User $user)
   {
    //    return view('blog.edit', ['blog' => $blog]);
   }

   public function update(Request $request, User $user)
   {
     
   }

   public function destroy(User $user)
   {       $user->delete();

           return back()->with('msg', 'user has been deleted successfully');
           // return redirect()->route('dashboards.writersdash', $blog)->with('msg' , 'blog deleted successfully');
   }
}
