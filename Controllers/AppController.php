<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect'=>array('controller'=>'Dailyreports','action'=>'uploadfile'),
            'logoutRedirect'=>array('controller'=>'users','action'=>'login'),
            'authError'=>'You cant access that page',
            'authorize'=>array('Controller'),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'username','password' => 'password')
                )
            )
        ),
        'RequestHandler',
        'Access'
    );

    public $helpers = array('Html', 'Form','Js');

    public function isAuthorized($user) {
        return true;
    }
    
    public function beforeRender() {
	   $this->response->disableCache();
    }
    
    public function beforeFilter() {
        parent::beforeFilter();

        ini_set('memory_limit', '-1');

        /************** Setting Horizontal Menu List from Module Table ***************/
        $this->loadModel('Group');
        $this->loadModel('Module');
        
        
        $this->Auth->allow('createdemouser');

        $this->Auth->allow('removedemouser');
        $this->Auth->allow('checklogin');
        $this->Auth->allow('feedetails');
        $this->Auth->allow('admissiondetails');
        $this->Auth->allow('studentattendancedetails');
        $this->Auth->allow('employeeattendancedetails');
        $this->Auth->allow('findmonthlyattendance');
        $this->Auth->allow('findmonthlyfee');
        $this->Auth->allow('findmonthlyadmission');
        $this->Auth->allow('checkuuid');
         $this->Auth->allow('dashboard');
        /* Setting Server Current Date */

        $this->set('currentdate',date('d-m-Y'));

        $user = $this->Auth->user();
        
        
        $current_controller = $this->params['controller'];
        $current_action = $this->action;

        $cuurent_path = $current_controller.'/'.$current_action;


        /* Controller exempted completly */

        $exemptedcontrollers = array(
                );

        /* Actions to be exempted */

        $exemptedpaths = array(
                0=>'Users/login',
                1=>'users/login',
                2=>'Useraccounts/createdemouser',
                3=>'useraccounts/createdemouser',
                4=>'Useraccounts/removedemouser',
                5=>'useraccounts/removedemouser',
                6=>'Users/register',
                7=>'users/register',
                8=>'checks/checklogin',
                9=>'Checks/checklogin',
                10=>'checks/feedetails',
                11=>'Checks/feedetails',
                12=>'checks/admissiondetails',
                13=>'Checks/admissiondetails',
                14=>'checks/studentattendancedetails',
                15=>'Checks/studentattendancedetails',
                16=>'Checks/checkuuid',
                17=>'checks/checkuuid',
                18=>'Checks/findmonthlyattendance',
                19=>'checks/findmonthlyattendance',
                20=>'Checks/findmonthlyadmission',
                21=>'checks/findmonthlyadmission',
                22=>'Checks/employeeattendancedetails',
                23=>'checks/employeeattendancedetails',
                24=>'Checks/findmonthlyfee',
                25=>'checks/findmonthlyfee',
                26=>'checks/dashboard',
                27=>'Checks/dashboard'
            );

        if (in_array($cuurent_path, $exemptedpaths) || in_array($current_controller, $exemptedcontrollers)) {

        } else {
            if (!$user) {
            
                return $this->redirect(array('controller'=>'users','action'=>'login'));
            
            }

        }

        $modules_data = array();
        $userdn = '';
        
        if ($user) {

            /* Creating Module Data Arra */

            $modules_data = array();

            $mid = 1;

            $mtemp = array();
            $mtemp['Module']['id'] = $mid++;
            $mtemp['Module']['name'] = 'Home';
            $mtemp['Module']['dest_controller'] = 'Dailyreports';
            $mtemp['Module']['dest_action'] = 'uploadfile';
            $mtemp['Module']['is_active'] = 'Yes';

            $modules_data[] = $mtemp;

            $mtemp = array();
            $mtemp['Module']['id'] = $mid++;
            $mtemp['Module']['name'] = 'Create Daily Report';
            $mtemp['Module']['dest_controller'] = 'Dailyreports';
            $mtemp['Module']['dest_action'] = 'uploadfile';
            $mtemp['Module']['is_active'] = 'Yes';

            $modules_data[] = $mtemp;

            $mtemp = array();
            $mtemp['Module']['id'] = $mid++;
            $mtemp['Module']['name'] = 'List Daily Report';
            $mtemp['Module']['dest_controller'] = 'Dailyreports';
            $mtemp['Module']['dest_action'] = 'editlist';
            $mtemp['Module']['is_active'] = 'Yes';

            //$modules_data[] = $mtemp;

           /* $mtemp = array();
            $mtemp['Module']['id'] = $mid++;
            $mtemp['Module']['name'] = 'Topper List';
            $mtemp['Module']['dest_controller'] = 'Schooldetails';
            $mtemp['Module']['dest_action'] = 'topperlist';
            $mtemp['Module']['is_active'] = 'Yes';

            $modules_data[] = $mtemp;

            $mtemp = array();
            $mtemp['Module']['id'] = $mid++;
            $mtemp['Module']['name'] = 'Reports';
            $mtemp['Module']['dest_controller'] = 'Studentresults';
            $mtemp['Module']['dest_action'] = 'reportoverview';
            $mtemp['Module']['is_active'] = 'Yes';

            $modules_data[] = $mtemp;

            $mtemp = array();
            $mtemp['Module']['id'] = $mid++;
            $mtemp['Module']['name'] = 'Stream Allocation';
            $mtemp['Module']['dest_controller'] = 'Schooldetails';
            $mtemp['Module']['dest_action'] = 'allotstream';
            $mtemp['Module']['is_active'] = 'Yes';*/

            $modules_data[] = $mtemp;

            /* Extracting active module */

            $active_module = -1;
            foreach ($modules_data as $mtemp) {
                if ($mtemp['Module']['dest_action']==$current_action && $mtemp['Module']['dest_controller']==$current_controller) {
                    $active_module = $mtemp['Module']['id'];
                    break;
                }
            }

            $this->set(compact('active_module'));
            
            $agent=$this->ExactBrowserName();
            $ip=$this->request->clientIp();
            
            $this->pingtoserver($ip, $agent);

            $this->set('logged_in',$this->Auth->loggedIn());
            $this->set('current_user',$user);

            $personname = array();

            if (isset($user['userid']) && $user['userid']) {

                $this->loadModel('Schooldetail');
                $personname = $this->Schooldetail->find('first',array(
                            'conditions'=>array('Schooldetail.id'=>$user['userid']),
                            'recursive'=>-1,
                            'fields'=>array('Schooldetail.id','Schooldetail.name')
                        ));

                $personname = $personname['Schooldetail']['name'];

                
            }

            if ($personname) {
                $userdn = $personname;
            } else {

                return $this->redirect($this->Auth->logout());
                
                $userdn = 'Unknown';
            }

            $notif = 0;

            $this->set('count', count($notif));
            
            /* End Code block */
        }

        $this->set(compact('userdn'));

        $this->set(compact('modules_data'));

    }


    function ExactBrowserName() {

            $ExactBrowserNameUA=$_SERVER['HTTP_USER_AGENT'];

            if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
                // OPERA
                $ExactBrowserNameBR="Opera";
            } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
                // CHROME
                $ExactBrowserNameBR="Chrome";
            } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
                // INTERNET EXPLORER
                $ExactBrowserNameBR="Internet Explorer";
            } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
                // FIREFOX
                $ExactBrowserNameBR="Firefox";
            } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {
                // SAFARI
                $ExactBrowserNameBR="Safari";
            } else {
                // OUT OF DATA
                $ExactBrowserNameBR="OUT OF DATA";
            };

            return $ExactBrowserNameBR;
    }

    public function pingtoserver($ip, $agent) {
        
        $this->loadModel('Userhistory');
        
        $user = $this->Session->read("Auth.User");
        
        $userid = $user['userid'];
        $status = 'Online';
        $lastupdated = date('Y-m-d h:i:s');

        $this->Userhistory->updateAll(array('Userhistory.state'=>"'$status'",'Userhistory.lastupdated'=>"'$lastupdated'"),array('Userhistory.customerid'=>$userid,'Userhistory.session'=>$this->Session->id()));

    }
    
}
