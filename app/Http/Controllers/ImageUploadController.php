<?php
namespace App\Http\Controllers;

use App\Helpers\UploadHelper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageUploadController extends Controller
{

  public function store(Request $request)
  {

    UploadHelper::uploadImage($request->user_file,1);


  // $fileName = time().'.'.$request->user_file->getClientOriginalExtension();

  // $request->user_file->move(public_path('uploads'), $fileName);

  }
}