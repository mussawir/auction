<?php
namespace App\Http\Controllers\Practitioner;
use App\Models\BlogPost;
use App\Models\Practitioner;
use App\Models\settings;
use App\Models\SuggestionsSearch;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\twitterLib\src\TwitterOAuth;

class MarketingController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //use Abraham\TwitterOAuth\TwitterOAuth;
    public function twittercallback()
    {
        require_once base_path().'/TwitterInc/autoload.php';
        require_once base_path().'/TwitterInc/src/TwitterOAuth.php';
        require_once base_path().'/app/Models/TWITTERCONFIG.php';
        session_start();
        if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']) {
            $request_token = [];
            $request_token['oauth_token'] = $_SESSION['oauth_token'];
            $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
            $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
            $_SESSION['access_token'] = $access_token;
            return Redirect::to('practitioner/social-post');
        }
    }
    public function twitterlogin()
    {
        require_once base_path().'/TwitterInc/autoload.php';
        require_once base_path().'/TwitterInc/src/TwitterOAuth.php';
        require_once base_path().'/app/Models/TWITTERCONFIG.php';
        session_start();
        if (!isset($_SESSION['access_token'])) {
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
            $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
			//echo $url; return;
            return Redirect::to($url);
        }
        else
        {
            return Redirect::to('practitioner/social-post');
        }

    }
    public static function twitterpost($msg,$link,$picpath)
    {
        require_once base_path().'/TwitterInc/autoload.php';
        require_once base_path().'/TwitterInc/src/TwitterOAuth.php';
        require_once base_path().'/app/Models/TWITTERCONFIG.php';
        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        if($link==""&&$msg!=""&&$picpath=="") {
            $post = $connection->post('statuses/update', array('status' => $msg));
        }
        else if($link!=""&& $msg!=""&&$picpath=="")
        {
            $post = $connection->post('statuses/update', array('status' => $link .'  ' . $msg));
            MarketingController::insertBlog($link .' ' . $msg ,'2');
        }
        else if($link!=""&& $msg=="")
        {
            $post = $connection->post('statuses/update', array('status' => $link));
            MarketingController::insertBlog($link,'2');
        }
        else if($picpath!="")
        {
            $tweetWM = $connection->upload('media/upload', ['media' => $picpath]);
            if($msg!="")
            {
                $tweet = $connection->post('statuses/update', ['media_ids' => $tweetWM->media_id, 'status' => $msg]);
            }
            else
            {
                $tweet = $connection->post('statuses/update', ['media_ids' => $tweetWM->media_id, 'status' => $link]);
            }
        }
    }
	
    public function formsubmit()
    {
            $myerr='';
            $link='';
            $imagePath='';
            $success = FALSE;
            $error = FALSE;
            if(isset($_POST["link"]))
            {
                $link = $_POST["link"];
            }
            if(isset($_POST["imagePath"]))
            {
                $imagePath = $_POST["imagePath"];
            }
            if($_POST['checkFb']=='true') {
                MarketingController::insertBlog($_POST["msg"] . ' ' . $link, '1'); 
            }
            if($_POST['checkTwitter']=='true') {
                if (isset($_POST["msg"]) && $_POST["msg"] != "") {
					session_start();
                    if (isset($_SESSION['access_token'])) {
                        //$this-twitterpost();
                        MarketingController::twitterpost($_POST["msg"], $link, $imagePath);
                    }
                }
            }
            if($_POST['checkLinked']=='true') {
                MarketingController::insertBlog($_POST["msg"].' ' .$link , '3');
            }
            if($_POST['checkBlog']=='true') {
                MarketingController::insertBlog($_POST["msg"].' ' .$link , '0');
            }
			echo 'posted';
	}
    public function twitterlogout()
    {
        session_start();
        unset($_SESSION['access_token']);
        return Redirect::back();
    }
    public function index()
    {
        $suggestion = SuggestionsSearch::where('sug_type', '=', 1)
            ->where("pra_id", "=", $this->practitioner_info->pra_id)->where('created_at', date('Y-m-d'))
            ->orderBy('created_at', 'desc')->get();
        $list_nut = SuggestionsSearch::where('sug_type', '=', 2)
            ->where("pra_id", "=", $this->practitioner_info->pra_id)->where('created_at', date('Y-m-d'))
            ->orderBy('created_at', 'desc')->get();
        return view('practitioner.marketing.index')->with('suggestion',$suggestion)->with('list_nut',$list_nut);
    }

    public function SocialPost()
    {
		
		$query = "SELECT * FROM settings where settings.key IN ('FB_api','TWIT_api','LIN_api') AND settings.user_id = ".Auth::user()->user_id;
		$select = DB::select($query);
        return view('practitioner.marketing.social')
		->with('practitioner_info',$this->practitioner_info)
            ->with('meta', array('page_title'=>'New Social Post'))		
			->with('select' , $select)
            ->with('Social_media','active')
            ->with('social_marketing','active')
            ->with('new_social_post','active');
    }
	
    public function SocialPostsList()
    {
       $spdata = BlogPost::where('post_type', '=', 2)->get();
       
       
        return view('practitioner.marketing.posts-list')
            ->with('meta', array('page_title'=>'Social Posts List')) 
            ->with('socialdata',$spdata)
			->with('practitioner_info',$this->practitioner_info)
            ->with('Social_media','active') 
            ->with('social_marketing','active')
            ->with('social_posts_list','active');
    }
    public static function insertBlog($contents,$typeId)
    {
        $post_type = 2 ;
        $BlogPost = new BlogPost();
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
        $pra_Id = $practitioner->pra_id;
        $BlogPost->pra_id = $pra_Id;
        $BlogPost->contents = $contents;
        $BlogPost->typeId = $typeId;
        $BlogPost->post_type = $post_type;
        $BlogPost->save();
    }
    function uploadImage()
    {
        $target_dir = public_path() . '/dashboard/img/marketing-img/';
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir .uniqid(). basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo $this->uploadImageOnImgur($target_file);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    function uploadImageOnImgur($filePath)
		{
			$client_id = "804a8060b5e2255";
			$image = file_get_contents($filePath);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
			curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => base64_encode($image)));

			$reply = curl_exec($ch);
			if ($error = curl_error($ch)) {
				die('cURL error:'.$error);
			}
			curl_close($ch);

			$reply = json_decode($reply);
			return $reply->data->link;
		}

		
		function setting(){
			$query = "SELECT * FROM settings where settings.key IN ('FB_api','TWIT_api','LIN_api') AND settings.user_id = ".Auth::user()->user_id;
		$select = DB::select($query);
		//dd($select);
			return view('practitioner.blog.setting')
			->with('practitioner_info',$this->practitioner_info)->with('social_marketing','active')->with('Social_media', 'active')->with('social_setting' , 'active')->with('cg_list',$select);
		}
		
		
		function socialmediasetting(Request $request){ 
		$cond = "settings.key='".$request->social_media."' and user_id = '".Auth::user()->user_id."'";
		$id = $this->ExecuteScalarOneCol('settings','id',$cond,'id');
		if($id!=''){
			DB::Delete('DELETE FROM settings WHERE id = '.$id);
		}
		
			
			$value = $request->social_media;
				$setting = new settings();
				$user_Id = Auth::user()->user_id;
				$setting->user_id = $user_Id;
				$setting->value = $request->api;
				$setting->key = $value;
				$setting->save();
			if($value=='TWIT_api'){
				$condT = "settings.key='TWIT_SECRET' and user_id = '".Auth::user()->user_id."'";
				$idT = $this->ExecuteScalarOneCol('settings','id',$condT,'id');
				if($idT!=''){
					DB::Delete('DELETE FROM settings WHERE id = '.$idT);
				}
				$setting1 = new settings();
				$setting1->user_id = $user_Id;
				$setting1->value = $request->CONSUMER_SECRET;
				$setting1->key = 'TWIT_SECRET';
				$setting1->save();
			}
				Session::put('success',' Your API has been saved successfully!');
			 return Redirect::back();
		}
		
}