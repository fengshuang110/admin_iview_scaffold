<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    public function wechat_notify(Request $request){
        $postStr = file_get_contents("php://input");
        Log::warn($postStr);
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if(true){
            $values  = [
                'return_code'=>'SUCCESS',
                'return_msg'=>'OK'
            ];
            $xml = "<xml>";
            foreach ($values as $key=>$val)
            {
                if (is_numeric($val)){
                    $xml.="<".$key.">".$val."</".$key.">";
                }else{
                    $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
                }
            }
            $xml.="</xml>";
            echo $xml; die;exit;
        }else{
            echo 'fail';exit;
        }
    }
  
    

}