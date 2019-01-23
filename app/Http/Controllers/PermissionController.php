<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LogicException;
use App\Business\Service\PermissionService;


class PermissionController  extends Controller {
    protected $adminUser = null;
    
    public function __construct(){
        $this->adminUser = Auth::user();
    }
    
    public function index(Request $request){
        $name = $request->input('name');
        $permission_menu_id = $request->input('permission_menu_id',0);
        $where = [];
        if(!empty($name)){
            $where[] = ['name','like','%'.$name.'%'];
        }

        if(!empty($permission_menu_id)){
            $where[] = ['permission_menu_id','=',$permission_menu_id];
        }
        $data = PermissionService::getInstance()->pages($where);
        return $this->echoJson($data);
    }

    public function group()
    {
         $data = PermissionService::getInstance()->group();
        return $this->echoJson($data);
    }

    /**
     * 添加用户
     */
    public function create(Request $request)
    {
        $rules = [
            'name'     => 'required|max:30',
            'permission_menu_id'=>'required',
            'action_url'=>'required',
        ];

        $input = $this->formValidate($request->all(), $rules);

        
        $id = PermissionService::getInstance()->create($input);
        if(! $id) {
            throw new LogicException('添加失败');
        }
        
        $input['id'] = $id;
        return $this->echoJson($input);
    }

    
    public function update(Request $request){
        $rules = [
            'id'       => 'required|integer|min:1',
            'name'     => 'max:30',
            'action_url'=>'required',
            'permission_menu_id'=>'required',
        ];
        $input = $this->formValidate($request->all(), $rules);

        // 未填写，则不修改密码

        if(count($input) < 1) {
            throw new LogicException('无任何修改');
        }
       
        $result = PermissionService::getInstance()->update($input['id'],$input);
        if(! $result) {
            throw new LogicException('无任何修改');
        }
        return $this->echoMsg('更新成功');
    }


     /**
     * 删除权限
     */
    public function delete(Request $request)
    {
        $rules = [
            'id'     => 'required|integer|min:1',
        ];
        $input = $this->formValidate($request->all(), $rules);
        $id = $input['id'];
        $effect = PermissionService::getInstance()->delete($id);
        if(! $effect) {
            throw new LogicException('删除失败');
        }

        return $this->echoMsg('成功');
    }


}

?>