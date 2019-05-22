<?php
class AdminModel {

    public function TestLogin($user, $pass){
        $data = DB::connection()
            ->table('employees')
            ->where('employee_user = ? and employee_pass = ?')
            ->setParams([$user,md5($pass)])
            ->executeReader();

        if(count($data) > 0)
            return $data[0]['employee_id'];

        return -1;
    }

    public function GetByID($id){
        return DB::connection()
            ->table('employees')
            ->where('employee_id = ?')
            ->setParams([$id])
            ->executeReader()[0];
    }


     


}

?>