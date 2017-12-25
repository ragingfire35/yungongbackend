<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $user = M("user");
        $res = $user->alias('u')->join(" advisre ad on u.id = ad.user_id ")->where("u.grade=1")->select();
        echo renderJson("","",$res);
    }
    public function consultants(){
        $adviser_role = M("adviser_role");
        $workingplace = M("workingplace");
        $page = I("page",0);
        $showNum = I("showNum",10);
        $adviser = M("adviser");
        $adviser_role_list = $adviser_role->where("pid=0")->select();
        $workingplace_list = $workingplace->where("pid=0")->select();
        $total = $adviser->alias('d')->join(" user u u.id=d.uid")->where("is_del=0")->count();
        $total = count($total);
        $pageary = pagination($total, $showNum, $page);
        $adviser_list = $adviser->alias('d')->join(" user u u.id=d.user_id")->limit($pageary['offset'],$showNum)->where("u.is_del=0 and d.is_del=0")->select();
        $data = [
            "adviser_role"=>$adviser_role_list,
            "workingplace"=>$workingplace_list,
            "adviser_list"=>$adviser_list
        ];
        echo renderJson($data,"",0);
    }
    public function jobs(){
        $adviser_role = M("adviser_role");
        $workingplace = M("workingplace");
        $page = I("page",0);
        $showNum = I("showNum",10);
        $demand = M("demand");
        $adviser_role_list = $adviser_role->where("pid=0")->select();
        $workingplace_list = $workingplace->where("pid=0")->select();
        $total = $demand->alias('d')->join(" user u u.id=d.uid")->where("is_del=0")->select();
        $total = count($total);
        $pageary = pagination($total, $showNum, $page);
        $demand_list = $demand->alias('d')->join(" user u u.id=d.user_id")->limit($pageary['offset'],$showNum)->where("is_del=0")->select();
        $data = [
            "adviser_role"=>$adviser_role_list,
            "workingplace"=>$workingplace_list,
            "demand_list"=>$demand_list
        ];
        echo renderJson($data,"",0);
    }
    public function services(){
        $classification = M("classification");
        $workingplace = M("workingplace");
        $param = I();
        $page = I("page",0);
        $showNum = I("showNum",10);
        $service = M("service");
        $classification_list = $classification->where("pid=0")->select();
        $workingplace_list = $workingplace->where("pid=0")->select();
        $total = $service->alias('d')->join(" user u u.id=d.uid")->where("is_del=0")->select();
        $total = count($total);
        $pageary = pagination($total, $showNum, $page);
        $service_list = $service->alias('d')->join(" user u u.id=d.user_id")->limit($pageary['offset'],$showNum)->where("is_del=0")->select();
        $data = [
            "classification_list"=>$classification_list,
            "workingplace"=>$workingplace_list,
            "service_list"=>$service_list
        ];
        echo renderJson($data,"",0);
    }
}