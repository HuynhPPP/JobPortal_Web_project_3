<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
  public function index()
  {
    $careers = Career::orderBy('created_at', 'DESC')->paginate(5);
    return view('admin.career.list', compact('careers'));
  }
  public function postCreateCareer(Request $request)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required|max:200|unique:careers,name',
        'status' => 'required'
      ],
      [
        'name.required' => 'Không được để trống.',
        'name.max' => 'Tên không quá 200 ký tự.',
        'name.unique' => 'Tên bạn nhập đã tồn tại.',
        'status.required' => 'Bạn chưa chọn trạng thái.'
      ]
    );
    if ($validator->passes()) {
      $careers = new Career();
      $careers->name = $request->name;
      $careers->status = $request->status;
      $careers->save();
      toastr()->success('Bạn đã thêm thành công.', ' ');
      return redirect()->back();
    } else {
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }
  public function deleteCareer($id)
  {
    $career = Career::find($id);
    if ($career == null) {
      toastr()->error("Tên ngành nghề không tồn tại.", " ");
      return redirect()->back();
    }
    $career->delete();
    toastr()->success("Xóa thành công", " ");
    return redirect()->route('admin.career');
  }
  public function getEmployer()
  {
    return view('admin.employer.list');
  }
  public function getEditCareer($id)
  {
    $careers = Career::orderBy('created_at', 'DESC')->paginate(5);
    $career = Career::findOrFail($id);
    return view('admin.career.edit', compact('careers', 'career'));
  }
  public function postEditCareer(Request $request, $id)
  {
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required|max:200|unique:careers,name,' . $id,
        'status' => 'required',
      ],
      [
        'name.required' => 'Không được để trống.',
        'name.max' => 'Tên không quá 200 ký tự.',
        'name.unique' => 'Tên bạn nhập đã tồn tại.',
        'status.required' => 'Bạn chưa chọn trạng thái.'
      ]
    );
    if ($validator->passes()) {
      $career =  Career::find($id);
      $career->name = $request->name;
      $career->status = $request->status;
      $career->save();
      toastr()->success("Cập nhật thành công.", ' ');
      return redirect()->back();
    } else {
      return redirect()->back()->withErrors($validator)->withInput();
    }
  }
}
