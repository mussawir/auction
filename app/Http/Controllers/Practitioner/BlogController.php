<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\Practitioner;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;
use File;

class BlogController extends Controller
{	
    protected $baseUrl;
	var $destPath = null;
    public function __construct(UrlGenerator $url)
    {
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        $this->baseUrl = $url;
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
		
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    public function index()
    {
        $prac = Session::get('practitioner_session');
		//dd($prac);
		//return;
        //$table1 = BlogPost::select('*')->where('pra_id', $prac['pra_id'])->orderBy('created_at', 'desc')->get();
        $table1 = BlogPost::where('post_type', '=', 1)->get();
        return view('practitioner.blog.index')
            ->with('table1', $table1)
            ->with('practitioner_info',$this->practitioner_info)
			->with('meta', array('page_title'=>'Posts List',isset($table1)?count($table1):0)) 
            ->with('blogging','active')
            ->with('Social_media','active')
            ->with('directory', $prac['directory']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practitioner.blog.new')
            ->with('practitioner_info',$this->practitioner_info)
			->with('meta', array('page_title'=>'New Blog Post'))
            ->with('blogging','active')
            ->with('Social_media','active');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'category' => 'required|max:100'
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        /*$input = $request->all();
        $post_type = 1;
        $prac = Session::get('practitioner_session');
        $input['pra_id'] = $prac['pra_id'];
        dd($post_type);
        BlogPost::create($input);*/
        $post_type = 1 ;
        $BlogPost = new BlogPost();
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
        $pra_Id = $practitioner->pra_id;
        $BlogPost->pra_id = $pra_Id;
        $BlogPost->contents =$request->contents;
        $BlogPost->heading =$request->heading;
        $BlogPost->post_type = $post_type;
        $BlogPost->save();
        Session::put('success','New Post is published!');
        return Redirect::to('/practitioner/blog/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		
			
        $posts = BlogPost::find($id);
		
//dd($posts);
        return view('practitioner.blog.view')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table1 = BlogPost::find($id);
        $prac = Session::get('practitioner_session');
        return view('practitioner.blog.edit')
		    ->with('practitioner_info',$this->practitioner_info)
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Edit Blog Post'))
            ->with('blogging','active')
            ->with('Social_media','active')
            ->with('directory', $prac['directory']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'name' => 'required|max:100'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $prac = Session::get('practitioner_session');
        $table1 = BlogPost::find($request->post_id);
        $table1->heading = $request->heading;
        $table1->contents = $request->contents;
        $table1->save();
        Session::put('success','You post is updated successfully!');
        return Redirect::to('/practitioner/blog/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function socialedit($id)
     {
         $table1 = BlogPost::find($id);
         $prac = Session::get('practitioner_session');
         return view('practitioner.blog.socialedit')
             ->with('practitioner_info',$this->practitioner_info)
             ->with('table1', $table1)
             ->with('meta', array('page_title'=>'Edit Blog Post'))
             ->with('blogging','active')
             ->with('Social_media','active')
             ->with('directory', $prac['directory']);
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table1 = BlogPost::find($id);
        
		
		
		if(isset($table1)){

            $table1->delete();

            echo 'success';
        }else{
            echo 'error';
		}
    }
}
