<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class SliderModel extends AdminModel
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table        = "slider";
        $this->folderUpdate = "img/slider";
        $this->fieldSearchAccepted        = [ 'id','name','description','link'];
        $this->crudNotAccepted            = [ '_token','thumb_current'];
    }

    public function listItems($params, $options)
    {
        $result = null;
        if ($options['name'] === 'admin-list-items') {
            $query = DB::table($this->table)
                ->select('name', 'id', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status')
                ->get();
            $result = $query;
        }
        return $result;
    }

    public function getItem($params, $options){
        $result = null;
        if($options['name'] === 'get-items') {
            $result = DB::table($this->table)
                ->select('name', 'id', 'description', 'link', 'thumb', 'status')
                ->where('id',$params['id'])->first();
        }

        return $result;
    }

    public function saveItems($params = null ,$options = null){
        if($options['task'] == 'edit-item'){
            $userInfo  =  session ('userInfo');
            $name      = (!empty($userInfo))?$userInfo['username']:'';
            if(!empty($params['thumb'])){ //nếu mà tồn tại thumb thì biết là đang upload hình mới lên
                //khi edit upload hình mới lên thì phải xóa hình cũ đi
                $this->deleteThumb($params['thumb_current']);
                //update tấm hình mới lên
                $params['thumb'] = $this->uploadThumb ($params['thumb']);
            }

            $params['modified_by']  = $name;
            $params['modified']     = date ('y-m-d');
            //xóa các key ko cần thiết
            $params = $this->prepareParams ($params);
            self::where('id',$params['id'])->update($params);
        }
    }

}
