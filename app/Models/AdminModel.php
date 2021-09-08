<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;
    protected $folderUpdate = "";
    protected $table = '';
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected  $fieldSearchAccepted =[ //những field dc phép search
        'id',
        'name',
    ];

    protected $crudNotAccepted =[ //những crud dc phép save
        '_token',
        'thumb_current',

    ];


    public function uploadThumb($thumbObj){
        //có thể sử dụng pthuc move để upload hình lên cũng dc
        //update tấm hình mới lên
        $thumbName    = Str::random(10).'.'.$thumbObj->clientExtension();//tên tấm hình
        //zvn_storage_image : cấu hình điều chính src img trong file config/filesystem
        $thumbObj->storeAs($this->folderUpdate, $thumbName,'zvn_storage_image');


        return $thumbName;
    }
    public function deleteThumb($thumbName){
        Storage::disk('zvn_storage_image')->delete($this->folderUpdate.'/'.$thumbName);
    }

    public function prepareParams($params){
        return array_diff_key ($params,array_flip ($this->crudNotAccepted));
    }
}
