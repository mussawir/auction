<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BlogPost;
use App\Models\Hours;
use App\Models\Pages;
use App\Models\Practitioner;
use App\Models\PracticeProfile;
use App\Models\Notification;
use App\Models\imageTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showPublicProfile($url = null)
    {
        $pra = Practitioner::where('url', '=', $url)->firstOrFail();
		
        $posts = BlogPost::where('pra_id', '=', $pra->pra_id)->orderBy('created_at', 'desc')->paginate(9);
        $op_hours = Hours::where('pra_id', '=', $pra->pra_id)->first();
		$pra_profile = PracticeProfile::where('pra_id', '=', $pra->pra_id)->first();
		
		
        return view('pra-public-profile')->with('pra', $pra)
            ->with('posts', $posts)->with('op_hours', $op_hours)
			->with('pra_profile', $pra_profile)
			->with('url', $url);
			
			
			
    }
	
	
	//send mail
	
	 public function sendphpemail(Request $request)

    {
		
		$prac = Session::get('practitioner_session');
		$pra_email = $prac['email'];
		
		
	     $name = $request->input('name');	
		 $email = $request->input('email');
         $pass = $request->input('password');
		 
		
          $to =  $pra_email ;
		  
          $subject = "Please Add Me! ";
          $mesg= "I am.$name. I wana subscribe you!
		  Thats my Email:.$email. Thanks ";
          $headers = $email ;
            

          if(mail($to,$subject,$mesg,$headers)) {
			 
             Session::put('success',' Submit successfully!');
			return Redirect::to('/practitioner');
			  
               
		  }
		  
		  else{
			  
			  echo ("Subscribing Failed Check Your Connection ");
		  }

		
		
		
		
		
		
			 
			
			
    }
	
	    public function showProfilePost($url = null)
    {
        $pra = Practitioner::where('url', '=', $url)->firstOrFail();
        $posts = BlogPost::where('pra_id', '=', $pra->pra_id)->orderBy('created_at', 'desc')->paginate(9);
        $op_hours = Hours::where('pra_id', '=', $pra->pra_id)->first();

        return view('pra-post-details')->with('pra', $pra)
            ->with('posts', $posts)->with('op_hours', $op_hours);
    }
	
	
	
    
	

	
	
	
	
	
	

    public function showPageBySlug($slug = null)
    {
        $table1 = Pages::where('slug', '=', $slug)->firstOrFail();

        return view('cms')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>(isset($table1) ? $table1->title: '')));
    }
	public function destroyImage($id)
	{
		$imagetable = imageTable::where('id','=',$id)->first();
		$pathToDelete = $imagetable->image_path;
		File::delete($pathToDelete);
		$imagetable->delete();
	}
	public function productDetail($id)
	{
		$isArray = false;
			$product = DB::table('products')
            ->select('products.*')->where('products_id',$id)->first();
			if (strpos($product->cat_id, ',') !== false) {
				$arr = explode(',',$product->cat_id);
				$isArray=true;
				}
				else
				{
					$arr = array($product->cat_id);
				}
			$categories = DB::table('categories')
			->select('categories.*')->whereIn('cat_id',$arr)->get();
        $images = imageTable::where('refId',$id)->where('table','=','products')->get();
		return view('product-detail-public')
            ->with('product',$product)
			->with('image',$images)
			//->with('categories',$categories)
            ->with('meta', array('page_title'=>'Product Detail'));
	}
}
