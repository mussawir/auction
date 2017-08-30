<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Models\Practitioner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->user_id = Auth::user()->user_id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::select('*')->get();
        $meta = array('page_title'=>'Product Categories', 'cat_main_menu'=>'active', 'cat_sub_menu_list'=> 'active');
        return view('admin.category.index')->with('meta',$meta)->with('items',$categories);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Product Category', 'cat_main_menu'=>'active', 'cat_sub_menu_new'=> 'active');
        $parent = ProductCategory::select('*')->get();
        return view('admin.category.new')->with('meta', $meta)->with('item',$parent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validator = \Validator::make($request->toArray(), [
//            'name' => 'required|max:100'
//        ]);
//
//        if ($validator->fails()) {
//            return Redirect::back()->withErrors($validator)->withInput();
//        }

        $input = $request->all();
		/*$parent_id = '';
        if($request->parent_id == null){
            $parent_id = null;
        }else{
            foreach ($input['parent_id'] as $selectedOption)
            {
                $parent_id .= $selectedOption;
                $parent_id.=',';
                //echo $selectedOption."\n";
            }
            $parent_id = rtrim($parent_id, ",");
        }*/

        $filename = '';
        if($request->hasFile('cat_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('cat_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            $file->move(public_path().'/images/categories/', $filename);
        }
		//$input['parent_id'] = $parent_id;
        $input['cat_image'] = $filename;
        ProductCategory::create($input);

        Session::put('success','Product Category saved successfully!');

        return Redirect::Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 var $levelsCount = 0;
    public function edit($id)
    {
		$levelArr = array();
		$levelCheck = $id;
		for($i=0;$i<4;$i++){
			$levelCheck = $this->getLevels($levelCheck);
			if($levelCheck!='')
			{
				$levelArr[$this->levelsCount] = $levelCheck;
				$this->levelsCount++;
			}
		}
		//print_r($levelArr);
		//return;
        $category = ProductCategory::find($id);
        $list = ProductCategory::get();
        $selectedcategory = ProductCategory::select('parent_id')->where('cat_id',$id)->first();
        $meta = array('page_title'=>'Edit Category', 'cat_main_menu'=>'active');
        return view('admin.category.edit')->with('meta', $meta)
		->with('cat_level',$this->levelsCount)
		->with('levelArr',$levelArr)
		->with('category', $category)->with('list',$list)->with('selectedcategory',$selectedcategory);
    }
	public function getLevels($cat_id)
	{
		$selectedcategory = ProductCategory::select('parent_id')->where('cat_id',$cat_id)->first();
		if(isset($selectedcategory))
		{
			return $selectedcategory->parent_id;
			$this->levelsCount++;
		}
	}

   
    public function update(Request $request)
    {
        $manufacturer = ProductCategory::find($request->cat_id);

        $filename = '';
        if($request->hasFile('image')) {
 //           $file = InterventionImage::make($request->file('image'));
            $file = $request->file('image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($manufacturer->cat_image) && (!empty($manufacturer->cat_image))) {
                unlink(public_path() . '/images/categories/' . $manufacturer->cat_image);
            }

            $file->move(public_path().'/images/categories/', $filename);
        } else {
            $filename = $request->saved_image;
        }

        $manufacturer->cat_image = $filename;
        $manufacturer->cat_name = $request->cat_name; 
        $manufacturer->parent_id = $request->parent_id;
        $manufacturer->sortOrder = $request->sortOrder;
		$manufacturer->cat_desc = $request->cat_desc;
        $manufacturer->save();

        Session::put('success','Product Category updated successfully!');

        return Redirect::to('/admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        if(isset($category)){
            if (isset($category->image) && (!empty($category->image))) {
                if(file_exists(public_path() . '/dashboard/img/manufac-img/' . $category->image)) {
                    unlink(public_path() . '/dashboard/img/manufac-img/' . $category->image);
                }
            }
            $category->delete();

            Session::put('success','Category deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
	public function getChilds($id,$disable)
	{
		$childs = ProductCategory::select('*')->where('parent_id','=',$id)->get();
		$disableAtt='';
		if($disable==1)
		{
			$disableAtt = 'disabled="disabled"';
		}
		if($childs)
		{
			echo '<option value="" selected="selected">Please Select</option>';
			foreach($childs as $child)
			{
				echo '<option '.$disableAtt.' value="'.$child->cat_id.'">'.$child->cat_name.'</option>';
			}
		}
	}
}
