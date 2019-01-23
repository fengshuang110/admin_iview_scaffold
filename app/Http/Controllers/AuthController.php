<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Business\Model\Admin\AdminUser;
use App\Business\Constant\ErrorCode;
use App\Business\Service\PermissionMenuService;
use App\Business\Service\AuthService;
use LogicException;

class AuthController extends Controller{
    
    public function __construct(){
    }

    
    public function login(Request $request){
        $rules = [
            'name'     => 'required|max:100',
            'password' => 'required|min:1|max:24'
        ];
        $input = $this->formValidate($request->all(), $rules);
        
        $user = AdminUser::getUserByName($input['name']);
        if(! $user) {
            throw new LogicException('帐号不存在，请联系管理员');
        }
        if($user['password'] != md5($input['password'])) {
            throw new LogicException('密码错误');
        }
        if($user['id'] != 1 && $user['status'] != AdminUser::$statusMap['active']) {
            throw new LogicException('用户状态不可用，请联系管理员');
        }
        
       $user = AuthService::login($user);
        
        return $this->echoJson($user);
        
    }
    /**
        
     */
    public function getUser(Request $request){
        $user = Auth::user();
        return $this->echoJson($user);
    }
    /**
     * 获取左侧菜单
     */
    public function groupMenus(Request $request){
        
        $user = Auth::user();
        $menus = PermissionMenuService::getInstance()->getRoleMenu($user['role_id']);
        $permissionKeys = array_column($menus, 'permission_key');
        $groups = config("menus.menus");
        if($user['id'] == 1){
             return $this->echoJson([
                'menus' => $groups,
            ]);
        }
        foreach ($groups as $key => &$item) {
            if(!in_array($item['permissionKey'], $permissionKeys) && 
               (env('APP_ENV') == 'prod' || env('APP_ENV') == 'beta')
            ){
                unset($groups[$key]);
            }else{
                foreach ($item['menus'] as $index => $one) {
                    if(!in_array($one['permissionKey'], $permissionKeys) && 
                        ( env('APP_ENV') == 'prod' || env('APP_ENV') == 'beta')
                    ){
                        unset($groups[$key]['menus'][$index]);
                    }
                }
            }
        }
        return $this->echoJson([
            'menus' => $groups,
        ]);
    }

    /**
     * 登出
     */
    public function logout()
    {
        if(isset($_COOKIE['api_token'])) {
            setcookie("api_token", '', time() - 1, '/');
        }
        return $this->echoJson();
    }
    
}
?>