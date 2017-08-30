<?php

namespace App\Http\Controllers\Admin;

use App\Models\adminBlog;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index()
    {
        $adminBlog = adminBlog::select('*')
		->where('created_by',Auth::user()->user_id)
		->orderBy('id', 'desc')->get();
        $meta = array('page_title'=>'Post List', 'blog_main_menu'=>'active', 'blog_sub_menu_list'=> 'active');

        return view('admin.blog.index')->with('adminBlog', $adminBlog)->with('meta', $meta);
    }
    public function create()
    {
        $meta = array('page_title'=>'Add New Post', 'blog_main_menu'=>'active', 'blog_sub_menu_new'=> 'active');

        return view('admin.blog.new')->with('meta', $meta);
    }
    public function store(Request $request)
    {
        $input = $request->all();
		//IMAGE START
		$filename = '';
		$filePath = '';
        if($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();
			$filePath = '/public/images/admin/'. $filename;
            $file->move(public_path().'/public/images/admin/', $filename);
        }

        $input['image_path'] = $filePath;
		//END
        $input['created_by'] = Auth::user()->user_id;
        adminBlog::create($input);
        Session::put('success','Post is saved successfully!');
        return Redirect::Back();
    }
    public function edit($id)
    {
        $exercises = adminBlog::find($id);
        $meta = array('page_title'=>'Edit Post', 'blog_main_menu'=>'active');

        return view('admin.blog.edit')->with('meta', $meta)->with('exercises', $exercises);
    }
    public function update(Request $request)
    {
		$filePath='';
		$filename='';
        $adminBlog = adminBlog::find($request->id);
		$imagePath =  '';
		if($request->image_name!=""){
			 $imagePath = 'not null';
		}
		else {
			$imagePath = 'null';
		}
		if($request->hasFile('image_path')) {
			if($imagePath!="null"){
				if (isset($adminBlog->image_path) && (!empty($adminBlog->image_path))) {
					if(file_exists(public_path().'/public/images/admin/' .$adminBlog->image_path)) {
						unlink(public_path().'/public/images/admin/'.$adminBlog->image_path);
					}
				}
				$file = $request->file('image_path');
				$rand_num = rand(11111, 99999);
				$filename = $rand_num. '_' .$file->getClientOriginalName();
				$filePath = '/public/images/admin/'. $filename;
				$file->move(public_path().'/public/images/admin/', $filename);
				$adminBlog->image_path=$filePath;
			}
		}
        $adminBlog->blog_text = $request->blog_text;
		$adminBlog->blog_title = $request->blog_title;
		$adminBlog->post_link = $request->post_link;
		$adminBlog->type = $request->type;
		$adminBlog->created_by=Auth::user()->user_id;
        $adminBlog->save();

        Session::put('success','Post Updated successfully!');

        return Redirect::to('/admin/adminBlog');
    }
    public function destroy($id)
    {
        $adminBlog = adminBlog::find($id);
		if(isset($adminBlog)){
            if (isset($adminBlog->image_path) && (!empty($adminBlog->image_path))) {
                    if(file_exists(base_path().$adminBlog->image_path)) {
                        unlink(base_path().$adminBlog->image_path);
                    }
            }
			$adminBlog->delete();
		}
    }
}
