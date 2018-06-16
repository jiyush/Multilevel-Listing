<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class categoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {        
        $data = Category::all();
        return view('home')->with('data',$data);
    }

    public function addCategory(){

    	$cat = Category::all();
    	return view('add')->with('cat',$cat);
    }

    public function insertCategory(Request $req){

        $this->validate($req,array(

            'category' => 'required|unique:categories,category'
        ));
    	

        $category = new Category;
    	$category->category = $req->category;
    	$parentId = $req->parentId;
    	if ($parentId != null) {
    		
    		$category->parentId = $parentId;
    		$level = Category::where('id','=',$parentId)->first();
    	    $category->level = $level->level + 1;

    	}else{
    		
    		$category->parentId = 0;
    		$category->level = $category->parentId + 1;
    	}

    	$category->save();
    
    
    	return redirect('/home');

    }
    public function editCategory(Request $req){

    	$data = Category::all();
    	$cat = Category::where('id','=',$req->id)->first();
    	return view('edit')->with('cat',$cat)->with('data',$data);
    }
    public function updateCategory(Request $req){
        $id = $req->id;
        $this->validate($req,array(

            'category' => "required|unique:categories,category,$id"
        ));
    	$category = Category::where('id','=',$req->id)->first();
    	$category->category = $req->category;
    	$parentId = $req->parentId;
    	if ($parentId != null) {
    		
    		$category->parentId = $parentId;
    		$level = Category::where('id','=',$parentId)->first();
    	    $category->level = $level->level + 1;

    	}else{
    		
    		$category->parentId = 0;
    		$category->level = $category->parentId + 1;
    	}

    	$category->update();
    
    
    	return redirect('/home');


    }
    public function deleteCategory(Request $req){

    	$category = Category::where('id','=',$req->id)->first();
    	$category->delete();
    	return redirect('/home');

    }
    public function showTree(){

    	return view('tree');
    }
    public function getTree(){
    	$catCollection =  Category::all();

    	$responseData = array();
    	foreach ($catCollection as $obj) {
    		$subAr = array();
    		$subAr[0] = $obj->category;
    		$parentToFind = $obj->parentId;

    		if( $parentToFind != 0 ){
	    		$filteredOp = $catCollection->filter(function( $o ) use ($parentToFind){
	    				return $o->id == $parentToFind;
	    		})->first();
	    		$subAr[1] = $filteredOp->category;
			}
			else{
				$subAr[1] = "root";
			}
			
			$subAr[2] = strval($obj->id);
    		array_push( $responseData, $subAr);
    	}
    	return response()->json( $responseData );

    }
}
