<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LogicException;
use App\Business\Service\RoleService;


class RoleController  extends Controller {
    protected $adminUser = null;
    
    public function __construct(){
        $this->adminUser = Auth::user();
    }
    
    public function index(Request $request)
    {
        $name = $request->input('name');
        $where = [];
        if(!empty($name)){
            $where[] = ['name','like','%'.$name.'%'];
        }
        $adminUser = Auth::user();
        $data = RoleService::getInstance()->pages($where);
        return $this->echoJson($data);
    }

    public function options()
    {
        $data = RoleService::getInstance()->options();
        return $this->echoJson($data);
    }

    /**
     * 添加用户
     */
    public function create(Request $request)
    {
        $rules = [
            'name'     => 'required|max:30',
        ];

        $input = $this->formValidate($request->all(), $rules);

        $id = RoleService::getInstance()->create($input);
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
            'permissionIds'=>'',
        ];
        $input = $this->formValidate($request->all(), $rules);

        // 未填写，则不修改密码

        if(count($input) < 1) {
            throw new LogicException('无任何修改');
        }
        $result = RoleService::getInstance()->update($input['id'],$input);
        if(! $result) {
            throw new LogicException('无任何修改');
        }
        return $this->echoMsg('更新成功');
    }


     /**
     * 切换用户状态
     */
    public function toggle(Request $request)
    {
        $rules = [
            'id'     => 'required|integer|min:1',
            'status' => 'required|in:1,2'
        ];
        $input = $this->formValidate($request->all(), $rules);
        $id = $input['id'];
        $status = $input['status'];
        $effect = RoleService::getInstance()->lock($id,$status);
        if(! $effect) {
            throw new LogicException('更新失败');
        }

        return $this->echoMsg('更新成功');
    }


}

?>