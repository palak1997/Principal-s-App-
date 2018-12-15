<?php

App::uses('AppController', 'Controller');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserhistoriesController extends AppController {
    
    var $name= 'Userhistories';
    var $uses= array();
    
    function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function overview() {
    
        $curdate = date('Y-m-d');
        $monstartdate = date('Y-m-01');
        $curmonth = date('M\'y');

        $this->set(compact('curdate','curmonth'));

        $this->loadModel('Schooldetail');
        $schooldetail = $this->Schooldetail->find('first',array('recursive'=>-1));

        $this->set(compact('schooldetail'));

        $this->loadModel('Userhistory');
        $userhistory = $this->Userhistory->find('all',array(
                'conditions'=>array('Userhistory.logindate'=>$curdate,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1,
                'order'=>array('Userhistory.id DESC')
            ));

        $this->loadModel('Student');
        $studentnames = $this->Student->find('list',array(
                'fields'=>array('Student.id','Student.full_name'),
                'recursive'=>-1
            ));

        $studentadmnos = $this->Student->find('list',array(
                'fields'=>array('Student.id','Student.admission_no'),
                'recursive'=>-1
            ));
        
        $studentstatus = $this->Student->find('list',array(
                'fields'=>array('Student.id','Student.status'),
                'recursive'=>-1
            ));

        $this->loadModel('Employee');
        $empoyeenames = $this->Employee->find('list',array(
                'fields'=>array('Employee.id','Employee.full_name'),
                'recursive'=>-1
            ));

        /* Stat Count Listing */

        $this->loadModel('User');
        $usercount = $this->User->find('count',array(
                'conditions'=>array('User.is_active'=>'Yes'),
                'recursive'=>-1
            ));

        $monimp = $this->Userhistory->find('count',array(
                'conditions'=>array('Userhistory.logindate >='=>$monstartdate,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1
            ));

        $todayimp = $this->Userhistory->find('count',array(
                'conditions'=>array('Userhistory.logindate'=>$curdate,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1
            ));


        $excel_data = array();

        $row = 0;

        $onlineusercount = $empusercount = $studusercount = 0;

        foreach ($userhistory as $userhis) {
            
            $temp = array();
            if (date('Y-m-d',strtotime($userhis['Userhistory']['logindate']))!='1970-01-01') {
                $temp['logindate'] = date('d-m-Y',strtotime($userhis['Userhistory']['logindate']));    
            } else {
                $temp['logindate'] = 'N.A.';    
            }
            
            $temp['fullname'] = $userhis['Userhistory']['fullname'];
            $temp['schoolname'] = $userhis['Userhistory']['clientid'];
            $temp['groupid'] = $userhis['Userhistory']['groupid'];
            $temp['customerid'] = $userhis['Userhistory']['customerid'];
            $temp['loginip'] = $userhis['Userhistory']['loginip'];
            $temp['logoutip'] = $userhis['Userhistory']['logoutip'];
            $temp['logintime'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['logintime']));
            if (date('Y-m-d',strtotime($userhis['Userhistory']['logouttime']))!='1970-01-01') {
                $temp['logouttime'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['logouttime']));
            } else {
                $temp['logouttime'] = NULL;
            }
            $temp['browser'] = $userhis['Userhistory']['browser'];
            $temp['phone'] = $userhis['Userhistory']['phone'];
            
            /* Calculating Date Diff */
            $curdate = date('Y-m-d h:i:s');
            $curdatetm = new Datetime($curdate);
            $lastupdtm = new Datetime($userhis['Userhistory']['lastupdated']);

            $diff = date_diff($lastupdtm, $curdatetm);
            
            $status = '';

            $timemsg='';
            if($diff->y > 0){
                $timemsg .= $diff->y .' year'. ($diff->y > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->m > 0){
                $timemsg .= $diff->m . ' month'. ($diff->m > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->d > 0){
                $timemsg .= $diff->d .' day'. ($diff->d > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->h > 0){
                $timemsg .= $diff->h .' hour'.($diff->h > 1 ? "'s ":' ');
                $status = 'Offline';
            }
            if($diff->i > 0){
                $timemsg .= $diff->i .' minute'. ($diff->i > 1?"'s ":' ');
                if ($status=='' && $diff->i < 10) {
                    $status = 'Online';
                } else if ($status=='' && $diff->i < 40) {
                    $status = 'Idle';
                } else if ($status=='') {
                    $status = 'Offline';
                }
            }
            if($diff->s >= 0){
                if ($status=='') {
                    $status = 'Online';
                }
                $timemsg .= $diff->s .' second'. ($diff->s > 1?"'s":'');
            }

            $timemsg = $timemsg.' ago';

            if ($userhis['Userhistory']['logouttime']) {
                $status = 'Offline';
            }

            $temp['lastupdated'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['lastupdated']));
            $temp['timemsg'] = $timemsg;
            $temp['status'] = $status;
            
            if ($userhis['Userhistory']['groupid']==6) {
                $temp['type'] = 'Student';
            } else {
                $temp['type'] = 'Employee';
            }

            /* Updating Stat Count */

            if ($status=='Online') {
                $onlineusercount++;
                if ($temp['type']=='Student') {
                    $studusercount++;
                } else if ($temp['type']=='Employee') {
                    $empusercount++;
                } 
            }
            

            $excel_data[$row] = $temp;
            $row++;
        }

        $this->set(compact('excel_data','usercount','onlineusercount','empusercount','studusercount','monimp','todayimp'));

    }

    public function history() {
        
        $usertype = array('' => 'Select User Type', 'Student' => 'Student', 'Employee' => 'Employee','Login Date'=>'Login Date');
        $this->set(compact('usertype'));

        $this->loadModel('Classlist');
        $this->loadModel('Empdesignation');
        $this->loadModel('Empdepartment');
        $this->loadModel('Employeegroup');
        $classlists = array('' => 'Select Class', $this->Classlist->find('list', array(
            'fields' => array('Classlist.id', 'Classlist.dropdown_name'),
            'order' => 'Classlist.sequence_no'
        )));
        $empgroups = array('' => 'Select Group', $this->Employeegroup->find('list', array('conditions' => array('Employeegroup.is_active' => 'Yes'))));
        $empdepts = array('' => 'Select Department', $this->Empdepartment->find('list', array('conditions' => array('Empdepartment.is_active' => 'Yes'))));
        $empdesignations = array('' => 'Select Designation', $this->Empdesignation->find('list', array('conditions' => array('Empdesignation.is_active' => 'Yes'))));
        $this->set(compact('empgroups', 'empdepts', 'empdesignations', 'classlists'));

        if (isset($this->request->params['named']['suc']))  {
            $this->set('success',$this->request->params['named']['suc']);
        } else {
            $this->set('success','0');
        }

    }

    public function show_history() {
        
        if (empty($this->request->data))
            return $this->redirect(array('action' => 'history','suc'=>'2'));

        $type = $this->request->data['Userhistory']['usertype'];
        if ($type == '')
            return $this->redirect(array('controller' => 'Exams', 'action' => 'incompletedataerror'));

        $this->loadModel('Empdesignation');
        $this->loadModel('Employee');
        $this->loadModel('Classlist');
        $this->loadModel('Group');
        $this->loadModel('Userhistory');
        $this->loadModel('Student');
        
        if ($type=='Login Date') {

            $fromdate = $this->request->data['Userhistory']['fromdate'];
            $todate = $this->request->data['Userhistory']['todate'];

            if ($fromdate=='' || $todate=='') {
                return $this->redirect(array('controller' => 'Exams', 'action' => 'incompletedataerror'));
            }

            $fromdate = date('Y-m-d',strtotime($fromdate));
            $todate = date('Y-m-d',strtotime($todate));
            
            $userhistory = $this->Userhistory->find('all',array(
                'conditions'=>array('Userhistory.logindate >='=>$fromdate,'Userhistory.logindate <='=>$todate,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1,
                'order'=>array('Userhistory.id DESC')
            ));

        } else {

            $parameter = $this->request->data[$type]['searchparam'];

            if ($parameter == '')
                return $this->redirect(array('controller' => 'Exams', 'action' => 'incompletedataerror'));
            if ($parameter == 'Student ID') {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Student->find('list', array(
                    'conditions' => array('Student.id LIKE'=> $name.'%'),
                    'fields' => array('Student.id')
                ));
            } else if ($parameter == 'Admission No')    {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Student->find('list',  array(
                    'conditions' => array('Student.admission_no LIKE' => trim($name).'%'),
                    'fields' => array('Student.id')
                ));
            } else if ($parameter == 'Student Name')    {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Student->find('list',  array(
                    'conditions'=>array(
                        'OR'=>array(
                            'Student.first_name LIKE'=> $name.'%',
                            'Student.middle_name LIKE'=> $name.'%',
                            'Student.last_name LIKE'=> $name.'%',
                            'CONCAT_WS(" ",first_name,last_name) LIKE'=>trim($name).'%',
                            'CONCAT_WS(" ",first_name,middle_name,last_name) LIKE'=>trim($name).'%'
                        )
                    ),
                ));
            } else if ($parameter == 'Father Name')   {
                $this->loadModel('Guardian');
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Guardian->find('list',  array(
                    'conditions'=>array(
                        'OR'=>array(
                            'Guardian.first_name LIKE'=> $name.'%',
                            'Guardian.middle_name LIKE'=> $name.'%',
                            'Guardian.last_name LIKE'=> $name.'%',
                            'CONCAT_WS(" ",first_name,last_name) LIKE'=>trim($name).'%',
                            'CONCAT_WS(" ",first_name,middle_name,last_name) LIKE'=>trim($name).'%'
                        )
                    ),
                    'fields' => array('Guardian.student_id'),
                    'recursive' => -1
                ));
            } else if ($parameter == 'Class')   {
                $name = $this->request->data['Userhistory']['classlistid'];
                $listmemberids = $this->Student->find('list',  array(
                    'conditions' => array('Student.classlist_id' => $name),
                    'fields' => array('Student.id')
                ));
            } else if ($parameter == 'Employee ID')   {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Employee->find('list', array(
                    'conditions' => array('Employee.id LIKE'=> $name.'%'),
                    'fields' => array('Employee.id')
                ));
            } else if ($parameter == 'Employee Name')   {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions' => array(
                        'OR' => array(
                            'Employee.first_name LIKE' => $name.'%',
                            'Employee.middle_name LIKE' => $name.'%',
                            'Employee.last_name LIKE' => $name.'%',
                            'CONCAT_WS(" ",first_name,last_name) LIKE' => trim($name).'%',
                            'CONCAT_WS(" ",first_name,middle_name,last_name) LIKE' => trim($name).'%'
                        )
                    ),
                    'fields' => array('Employee.id')
                ));
            } else if ($parameter == 'Department')   {
                $this->loadModel('Empdepartment');
                $name = $this->request->data['Userhistory']['deptid'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions'=>array('Employee.empdepartment_id' => $name),
                    'recursive' => -1
                ));
            } else if ($parameter == 'Designation')   {
                $name = $this->request->data['Userhistory']['designationid'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions'=>array('Employee.empdesignation_id' => $name),
                    'recursive' => -1
                ));
            } else if ($parameter == 'Group')   {
                $this->loadModel('Employeegroup');
                $name = $this->request->data['Userhistory']['groupid'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions'=>array('Employee.employeegroup_id' => $name),
                    'fields' => array('Employee.id')
                ));
            }

            $userhistory = $this->Userhistory->find('all',array(
                'conditions'=>array('Userhistory.customerid'=>$listmemberids,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1,
                'order'=>array('Userhistory.id DESC')
            ));

        }
        

        $excel_data = array();

        $row = 0;

        $onlineusercount = $empusercount = $studusercount = 0;

        foreach ($userhistory as $userhis) {
            
            $temp = array();
            if (date('Y-m-d',strtotime($userhis['Userhistory']['logindate']))!='1970-01-01') {
                $temp['logindate'] = date('d-m-Y',strtotime($userhis['Userhistory']['logindate']));    
            } else {
                $temp['logindate'] = 'N.A.';    
            }
            $temp['username'] = $userhis['Userhistory']['name'];
            $temp['fullname'] = $userhis['Userhistory']['fullname'];
            $temp['schoolname'] = $userhis['Userhistory']['clientid'];
            $temp['groupid'] = $userhis['Userhistory']['groupid'];
            $temp['customerid'] = $userhis['Userhistory']['customerid'];
            $temp['loginip'] = $userhis['Userhistory']['loginip'];
            $temp['logoutip'] = $userhis['Userhistory']['logoutip'];
            $temp['logintime'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['logintime']));
            if (date('Y-m-d',strtotime($userhis['Userhistory']['logouttime']))!='1970-01-01') {
                $temp['logouttime'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['logouttime']));
            } else {
                $temp['logouttime'] = NULL;
            }
            $temp['browser'] = $userhis['Userhistory']['browser'];
            $temp['phone'] = $userhis['Userhistory']['phone'];
            
            /* Calculating Date Diff */
            $curdate = date('Y-m-d h:i:s');
            $curdatetm = new Datetime($curdate);
            $lastupdtm = new Datetime($userhis['Userhistory']['lastupdated']);

            $diff = date_diff($lastupdtm, $curdatetm);
            
            $status = '';

            $timemsg='';
            if($diff->y > 0){
                $timemsg .= $diff->y .' year'. ($diff->y > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->m > 0){
                $timemsg .= $diff->m . ' month'. ($diff->m > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->d > 0){
                $timemsg .= $diff->d .' day'. ($diff->d > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->h > 0){
                $timemsg .= $diff->h .' hour'.($diff->h > 1 ? "'s ":' ');
                $status = 'Offline';
            }
            if($diff->i > 0){
                $timemsg .= $diff->i .' minute'. ($diff->i > 1?"'s ":' ');
                if ($status=='' && $diff->i < 10) {
                    $status = 'Online';
                } else if ($status=='' && $diff->i < 40) {
                    $status = 'Idle';
                } else if ($status=='') {
                    $status = 'Offline';
                }
            }
            if($diff->s >= 0){
                if ($status=='') {
                    $status = 'Online';
                }
                $timemsg .= $diff->s .' second'. ($diff->s > 1?"'s":'');
            }

            $timemsg = $timemsg.' ago';

            if ($userhis['Userhistory']['logouttime']) {
                $status = 'Offline';
            }

            $temp['lastupdated'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['lastupdated']));
            $temp['timemsg'] = $timemsg;
            $temp['status'] = $status;
            
            if ($userhis['Userhistory']['groupid']==6) {
                $temp['type'] = 'Student';
            } else {
                $temp['type'] = 'Employee';
            }

            /* Updating Stat Count */

            if ($status=='Online') {
                $onlineusercount++;
                if ($temp['type']=='Student') {
                    $studusercount++;
                } else if ($temp['type']=='Employee') {
                    $empusercount++;
                } 
            }
            

            $excel_data[$row] = $temp;
            $row++;
        }

        $this->set(compact('excel_data'));
        
        //$this->autoRender = false;
        //debug($excel_data);

    }

    public function excel_history() {
        
        if (empty($this->request->data))
            return $this->redirect(array('action' => 'history','suc'=>'2'));

        $type = $this->request->data['Userhistory']['usertype'];
        if ($type == '')
            return $this->redirect(array('action' => 'history','suc'=>'2'));

        $this->loadModel('Empdesignation');
        $this->loadModel('Employee');
        $this->loadModel('Classlist');
        $this->loadModel('Group');
        $this->loadModel('Userhistory');
        $this->loadModel('Student');
        
        if ($type=='Login Date') {

            $fromdate = $this->request->data['Userhistory']['fromdate'];
            $todate = $this->request->data['Userhistory']['todate'];

            if ($fromdate=='' || $todate=='') {
                return $this->redirect(array('action' => 'history','suc'=>'2'));
            }

            $fromdate = date('Y-m-d',strtotime($fromdate));
            $todate = date('Y-m-d',strtotime($todate));
            
            $userhistory = $this->Userhistory->find('all',array(
                'conditions'=>array('Userhistory.logindate >='=>$fromdate,'Userhistory.logindate <='=>$todate,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1,
                'order'=>array('Userhistory.id DESC')
            ));

        } else {

            $parameter = $this->request->data[$type]['searchparam'];

            if ($parameter == '')
                return $this->redirect(array('action' => 'history','suc'=>'2'));
            if ($parameter == 'Student ID') {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Student->find('list', array(
                    'conditions' => array('Student.id LIKE'=> $name.'%'),
                    'fields' => array('Student.id')
                ));
            } else if ($parameter == 'Admission No')    {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Student->find('list',  array(
                    'conditions' => array('Student.admission_no LIKE' => trim($name).'%'),
                    'fields' => array('Student.id')
                ));
            } else if ($parameter == 'Student Name')    {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Student->find('list',  array(
                    'conditions'=>array(
                        'OR'=>array(
                            'Student.first_name LIKE'=> $name.'%',
                            'Student.middle_name LIKE'=> $name.'%',
                            'Student.last_name LIKE'=> $name.'%',
                            'CONCAT_WS(" ",first_name,last_name) LIKE'=>trim($name).'%',
                            'CONCAT_WS(" ",first_name,middle_name,last_name) LIKE'=>trim($name).'%'
                        )
                    ),
                ));
            } else if ($parameter == 'Father Name')   {
                $this->loadModel('Guardian');
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Guardian->find('list',  array(
                    'conditions'=>array(
                        'OR'=>array(
                            'Guardian.first_name LIKE'=> $name.'%',
                            'Guardian.middle_name LIKE'=> $name.'%',
                            'Guardian.last_name LIKE'=> $name.'%',
                            'CONCAT_WS(" ",first_name,last_name) LIKE'=>trim($name).'%',
                            'CONCAT_WS(" ",first_name,middle_name,last_name) LIKE'=>trim($name).'%'
                        )
                    ),
                    'fields' => array('Guardian.student_id'),
                    'recursive' => -1
                ));
            } else if ($parameter == 'Class')   {
                $name = $this->request->data['Userhistory']['classlistid'];
                $listmemberids = $this->Student->find('list',  array(
                    'conditions' => array('Student.classlist_id' => $name),
                    'fields' => array('Student.id')
                ));
            } else if ($parameter == 'Employee ID')   {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Employee->find('list', array(
                    'conditions' => array('Employee.id LIKE'=> $name.'%'),
                    'fields' => array('Employee.id')
                ));
            } else if ($parameter == 'Employee Name')   {
                $name = $this->request->data['Userhistory']['searchtext'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions' => array(
                        'OR' => array(
                            'Employee.first_name LIKE' => $name.'%',
                            'Employee.middle_name LIKE' => $name.'%',
                            'Employee.last_name LIKE' => $name.'%',
                            'CONCAT_WS(" ",first_name,last_name) LIKE' => trim($name).'%',
                            'CONCAT_WS(" ",first_name,middle_name,last_name) LIKE' => trim($name).'%'
                        )
                    ),
                    'fields' => array('Employee.id')
                ));
            } else if ($parameter == 'Department')   {
                $this->loadModel('Empdepartment');
                $name = $this->request->data['Userhistory']['deptid'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions'=>array('Employee.empdepartment_id' => $name),
                    'recursive' => -1
                ));
            } else if ($parameter == 'Designation')   {
                $name = $this->request->data['Userhistory']['designationid'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions'=>array('Employee.empdesignation_id' => $name),
                    'recursive' => -1
                ));
            } else if ($parameter == 'Group')   {
                $this->loadModel('Employeegroup');
                $name = $this->request->data['Userhistory']['groupid'];
                $listmemberids = $this->Employee->find('list',  array(
                    'conditions'=>array('Employee.employeegroup_id' => $name),
                    'fields' => array('Employee.id')
                ));
            }

            $userhistory = $this->Userhistory->find('all',array(
                'conditions'=>array('Userhistory.customerid'=>$listmemberids,'NOT'=>array('Userhistory.groupid'=>4)),
                'recursive'=>-1,
                'order'=>array('Userhistory.id DESC')
            ));

        }
        

        $excel_data = array();

        $this->loadModel('Schooldetail');
        $schooldetail = $this->Schooldetail->find('first',array('recursive'=>-1));

        /* Extracting Generated By */

        $this->loadModel('Employee');
        $employees = $this->Employee->find('list',array(
                        'fields'=>array('Employee.id','Employee.full_name')
                    ));

        $userid = $this->Auth->user('userid');

        if (isset($employees[$userid])) {
            $genby = $employees[$userid];
        } else {
            $genby = 'N.A.';
        }


        $excel_data = array();

        $row = 0;
        $excel_data[$row++][] = 'Account Acivity Report  ('.$schooldetail['Schooldetail']['name'].')';
        $excel_data[$row++][] = 'Generated By : '.$genby.' | Generated On : '.date('d-m-Y h:i:s');
        $excel_data[$row++][] = 'Total No. of Records : '.count($userhistory);
        $excel_data[$row++][] = NULL;
        $excel_data[$row++][] = NULL;

        $onlineusercount = $empusercount = $studusercount = 0;

        $excel_data[$row][] = 'SNo,';
        $excel_data[$row][] = 'Date';
        $excel_data[$row][] = 'RLX Id';
        $excel_data[$row][] = 'Group Id';
        $excel_data[$row][] = 'Name';
        $excel_data[$row][] = 'Contact Number';
        $excel_data[$row][] = 'Browser';
        $excel_data[$row][] = 'Login Time';
        $excel_data[$row][] = 'Login IP';
        $excel_data[$row][] = 'Logout Time';
        $excel_data[$row][] = 'Logout IP';
        $excel_data[$row][] = 'Status';
        $excel_data[$row][] = 'Last Seen';
        $row++;
        
        $sno = 1;
        foreach ($userhistory as $userhis) {
            
            $temp = array();
            if (date('Y-m-d',strtotime($userhis['Userhistory']['logindate']))!='1970-01-01') {
                $temp['logindate'] = date('d-m-Y',strtotime($userhis['Userhistory']['logindate']));    
            } else {
                $temp['logindate'] = 'N.A.';    
            }
            $temp['username'] = $userhis['Userhistory']['name'];
            $temp['fullname'] = $userhis['Userhistory']['fullname'];
            $temp['schoolname'] = $userhis['Userhistory']['clientid'];
            $temp['groupid'] = $userhis['Userhistory']['groupid'];
            $temp['customerid'] = $userhis['Userhistory']['customerid'];
            $temp['loginip'] = $userhis['Userhistory']['loginip'];
            $temp['logoutip'] = $userhis['Userhistory']['logoutip'];
            $temp['logintime'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['logintime']));
            if (date('Y-m-d',strtotime($userhis['Userhistory']['logouttime']))!='1970-01-01') {
                $temp['logouttime'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['logouttime']));
            } else {
                $temp['logouttime'] = NULL;
            }
            $temp['browser'] = $userhis['Userhistory']['browser'];
            $temp['phone'] = $userhis['Userhistory']['phone'];
            
            /* Calculating Date Diff */
            $curdate = date('Y-m-d h:i:s');
            $curdatetm = new Datetime($curdate);
            $lastupdtm = new Datetime($userhis['Userhistory']['lastupdated']);

            $diff = date_diff($lastupdtm, $curdatetm);
            
            $status = '';

            $timemsg='';
            if($diff->y > 0){
                $timemsg .= $diff->y .' year'. ($diff->y > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->m > 0){
                $timemsg .= $diff->m . ' month'. ($diff->m > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->d > 0){
                $timemsg .= $diff->d .' day'. ($diff->d > 1?"'s ":' ');
                $status = 'Offline';
            }
            if($diff->h > 0){
                $timemsg .= $diff->h .' hour'.($diff->h > 1 ? "'s ":' ');
                $status = 'Offline';
            }
            if($diff->i > 0){
                $timemsg .= $diff->i .' minute'. ($diff->i > 1?"'s ":' ');
                if ($status=='' && $diff->i < 10) {
                    $status = 'Online';
                } else if ($status=='' && $diff->i < 40) {
                    $status = 'Idle';
                } else if ($status=='') {
                    $status = 'Offline';
                }
            }
            if($diff->s >= 0){
                if ($status=='') {
                    $status = 'Online';
                }
                $timemsg .= $diff->s .' second'. ($diff->s > 1?"'s":'');
            }

            $timemsg = $timemsg.' ago';

            if ($userhis['Userhistory']['logouttime']) {
                $status = 'Offline';
            }

            $temp['lastupdated'] = date('d-m-Y h:i:s',strtotime($userhis['Userhistory']['lastupdated']));
            $temp['timemsg'] = $timemsg;
            $temp['status'] = $status;
            
            if ($userhis['Userhistory']['groupid']==6) {
                $temp['type'] = 'Student';
            } else {
                $temp['type'] = 'Employee';
            }

            /* Updating Stat Count */

            if ($status=='Online') {
                $onlineusercount++;
                if ($temp['type']=='Student') {
                    $studusercount++;
                } else if ($temp['type']=='Employee') {
                    $empusercount++;
                } 
            }
            
            $excel_data[$row][] = $sno++;
            $excel_data[$row][] = $temp['logindate'];
            $excel_data[$row][] = $temp['customerid'];
            $excel_data[$row][] = $temp['groupid'];
            $excel_data[$row][] = $temp['fullname'];
            $excel_data[$row][] = $temp['phone'];
            $excel_data[$row][] = $temp['browser'];
            $excel_data[$row][] = $temp['logintime'];
            $excel_data[$row][] = $temp['loginip'];
            $excel_data[$row][] = $temp['logouttime'];
            $excel_data[$row][] = $temp['logoutip'];
            $excel_data[$row][] = $temp['status'];
            $excel_data[$row][] = $temp['timemsg'].' ('.$temp['lastupdated'].')';
            
            $row++;
        }

        $this->set(compact('excel_data'));

    }
}
    