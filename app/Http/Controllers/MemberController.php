<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LogicException;
use App\Business\Service\MemberService;


class MemberController  extends Controller {
	protected $adminUser = null;
	
	public function __construct(){
		$this->adminUser = Auth::user();
	}


    public function index(Request $request){
        $where = [];
        $result = MemberService::getInstance()->pages($where);
        return $this->echoJson($result);
    }

    /**
     * 切换用户状态
     */
    public function toggle(Request $request)
    {
        $rules = [
            'user_id'     => 'required|integer|min:1',
            'status' => 'required|in:1,2'
        ];
        $input = $this->formValidate($request->all(), $rules);
        $user_id = $input['user_id'];
        $status = $input['status'];
        $effect = MemberService::getInstance()->updateStatus($user_id,$status);
        if(! $effect) {
            throw new LogicException('更新失败');
        }

        return $this->echoMsg('更新成功');
    }

    public function recharge(Request $request){
        $userId = $request->input('user_id');
        $rechargeStatus = $request->input('recharge_status','');
        $where = [];
        if(!empty($userId)){
            $where[] = ['user_id','=',$userId];
        }
        if(!empty($rechargeStatus)){
            $where[] = ['recharge_status','=',$rechargeStatus];
        }
        $result = MemberService::getInstance()->recharge($where);
        return $this->echoJson($result);
    }



	

}

?>