<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LogicException;
use App\Business\Service\UserService;


class UserController extends Controller {
    protected $adminUser = null;
    
    public function __construct(){
        $this->adminUser = Auth::user();
    }

    /**
     * @Validator\ParamRules(
     *  int64={"type": "int64", "min": 1000, "max": 9999, "required": true},
     *  name={"type": "string", "min": 0, "max": 200},
     * )
     */
    public function index(Request $request){
        $name = $request->get('name');
        $where[] =$name ? ['name','like','%'.$name.'%'] : [];
        $data = UserService::getInstance()->pages($where);
        return $this->echoJson($data);
    }

    /**
     * 添加用户
     */
    public function create(Request $request)
    {
        $rules = [
            'name'     => 'required|max:30',
            'mail'     => 'required|email|max:50|unique:admin_user,mail',      
            'password' => 'password',
            'roleId'   => 'required'
        ];

        $input = $this->formValidate($request->all(), $rules);

        $input['password'] = md5($input['password']);
        
        $id = UserService::getInstance()->createUser($input);
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
            'password' => 'password',
            'role_id'=>'required',
        ];
        $input = $this->formValidate($request->all(), $rules);

        // 未填写，则不修改密码
        if(!empty($input['password']) ) {
            $input['password'] = md5($input['password']);
        }else {
            unset($input['password']);
        }

        if(count($input) < 1) {
            throw new LogicException('无任何修改');
        }
        $result = UserService::getInstance()->updateUser($input['id'],$input);
        if(empty($result)) {
            throw new LogicException('更新失败');
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
        $effect = UserService::getInstance()->updateStatus($id,$status);
        if(! $effect) {
            throw new LogicException('更新失败');
        }

        return $this->echoMsg('更新成功');
    }
    
    

}

?>