<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;
use App\Http\Requests\SliderRequest as MainRequest;

class SliderController extends Controller
{
    private $controllerName = "slider";
    private $model;
    private $params = [];
    private $path_view;


    public function __construct()
    {
        $this->model = new MainModel();
        view()->share('controllerName', $this->controllerName);
        $this->path_view = config('utils.pages.admin').$this->controllerName;
    }

    public function index(){
       $items = $this->model->listItems($this->params,['name' => 'admin-list-items']);
       return view($this->path_view.'.index', ['items' => $items]);
    }

    public function form(Request $request){
        $item = null;
        if($request->id != null){
            $this->params['id'] = $request->id;
            $item = $this->model->getItem($this->params,['name' => 'get-items']);
        }
        return view($this->path_view.'.form', ['item' => $item]);
    }

    public function save(MainRequest $request){
        if($request->method ()=='POST'){ //nếu method là post
            $params = $request->all(); // lấy tất cả param dc post qua
            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";
            if($params['id']!=null){    //id tồn tại là trường hợp edit
                $task   = "edit-item";
                $notify = "Cập nhập phần tử thành công !";

            }
            $this->model->saveItems ($params,['task'=>$task]);
            return redirect ()->route ($this->controllerName)->with ('zvn_notify',$notify);
        }

    }

    public function delete(){
        return 'delete';
    }

}
