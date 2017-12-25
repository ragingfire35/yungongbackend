<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8");
class ApplyController extends Controller {
    //申请技术顾问
    public function add_adviser(){
        $param = I("");
        $adviser = M("adviser");
        $time = time();
        $data = [
            "now_status"=>$param['now_status'],
            "job_time"=>$param['job_time'],
            "working_time"=>$param['working_time'],
            "compay_position"=>$param['compay_position'],
            "city_id"=>$param['city_id'],
            "c_city_id"=>$param['c_city_id'],
            "address"=>$param['address'],
            "daily_wage"=>$param['daily_wage'],
            "adviser_role"=>$param['adviser_role'],
            "best_skill"=>$param['best_skill'],
            "skill_exp"=>$param['skill_exp'],
            "project_exp"=>$param['project_exp'],
            "ctime"=>$time,
            "utime"=>$time
        ];
        $res= $adviser->add($data);
        if( $res ){
            echo renderJson("","",0);
        }else{
            echo renderJson("","",1);
        }
    }
    //发布用人需求
    public function add_demand(){
        $param = I("");
        $demand = M("demand");
        $time = time();
        $user_id = session("user_id");
        $data = [
            "need_hands_type"=>$param['need_hands_type'],
            "project_type"=>$param['project_type'],
            "project_name"=>$param['project_name'],
            "project_describe"=>$param['project_describe'],
            "need_skill"=>$param['need_skill'],
            "payment_type"=>$param['payment_type'],
            "work_type"=>$param['work_type'],
            "expect_work_time"=>$param['expect_work_time'],
            "company_name"=>$param['company_name'],
            "user_id"=>$user_id,
            "ctime"=>$time,
            "utime"=>$time
        ];
        $res= $demand->add($data);
        if( $res ){
            echo renderJson("","",0);
        }else{
            echo renderJson("","",1);
        }
    }
    //入住小团队
    public function add_team(){
        $param = I("");
        $team = M("team");
        $time = time();
        $user_id = session("user_id");
        $data = [
            "team_name"=>$param['team_name'],
            "team_introduce"=>$param['team_introduce'],
            "file_information"=>$param['file_information'],
            "is_register_company"=>$param['is_register_company'],
            "user_id"=>$user_id,
            "ctime"=>$time,
            "utime"=>$time
        ];
        $res= $team->add($data);
        if( $res ){
            echo renderJson("","",0);
        }else{
            echo renderJson("","",1);
        }
    }
    //添加团队成员
    public function add_team_person(){
        $param = I("");
        $time = time();
        $team_person = M("team_person");
        $team = M("team");
        $team_id = $team->where("user_id = ".$team)->getField('id');
        $user_id = session("user_id");
        $data = [
            "homepage_url"=>$param['homepage_url'],
            "head_img"=>$param['head_img'],
            "name"=>$param['name'],
            "company"=>$param['company'],
            "position"=>$param['position'],
            "work_year"=>$param['work_year'],
            "skill_tag"=>$param['skill_tag'],
            "member_introduction"=>$param['member_introduction'],
            "phone"=>$param['phone'],
            "idcard"=>$param['idcard'],
            "team_id"=>$team_id,
            "user_id"=>$user_id,
            "ctime"=>$time,
            "utime"=>$time
        ];
        $res= $team_person->add($data);
        if( $res ){
            echo renderJson("","",0);
        }else{
            echo renderJson("","",1);
        }
    }
    //添加成功案例
    public function add_success_case(){
        $param = I("");
        $time = time();
        $success_case = M("success_case");
        $team = M("team");
        $team_id = $team->where("user_id = ".$team)->getField('id');
        $user_id = session("user_id");
        $data = [
            "homepage_url"=>$param['homepage_url'],
            "head_img"=>$param['head_img'],
            "name"=>$param['name'],
            "company"=>$param['company'],
            "position"=>$param['position'],
            "work_year"=>$param['work_year'],
            "skill_tag"=>$param['skill_tag'],
            "member_introduction"=>$param['member_introduction'],
            "phone"=>$param['phone'],
            "idcard"=>$param['idcard'],
            "team_id"=>$team_id,
            "user_id"=>$user_id,
            "ctime"=>$time,
            "utime"=>$time
        ];
        $res= $success_case->add($data);
        if( $res ){
            echo renderJson("","",0);
        }else{
            echo renderJson("","",1);
        }
    }
}