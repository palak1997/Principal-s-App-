<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Controller', 'Callers');
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
   public $name = 'Users'; 

   public $components = array('Paginator');

    
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *  or MissingViewException in debug mode.
 */

        

        function generatePassword($length = 10) {
            $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ123456789';
            $count = mb_strlen($chars);
            for ($i = 0, $result = ''; $i < $length; $i++) {
                $index = rand(0, $count - 1);
                $result .= mb_substr($chars, $index, 1);
            }
            return $result;
        }
         function beforeFilter() {
            parent::beforeFilter();
                $this->layout = 'user';
                $this->Auth->allow('çhecklogin','register','forgotpassword','login','sendotp','confirmotp','resendotp','generateotp','savepassword');
        }

public function feedetails()
{
     $this->loadmodel('Dailyreport');
    $result= $this->Dailyreport->find('all');
    if($result)
    {
         $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['session'] = $result['Dailyreport']['session'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['cheque'] = $result['Dailyreport']['cheque'];
            $resultarray['result']['cash'] = $result['Dailyreport']['cash'];
            $resultarray['result']['card'] = $result['Dailyreport']['card'];
            $resultarray['result']['challan'] = $result['Dailyreport']['challan'];
            $resultarray['result']['online'] = $result['Dailyreport']['online'];
            $resultarray['result']['draft'] = $result['Dailyreport']['draft'];
            $resultarray['result']['fee_defaulters'] = $result['Dailyreport']['fee_defaulters'];
            $resultarray['result']['fremarks'] = $result['Dailyreport']['fremarks'];
             return json_encode($resultarray);
    }
    else {
              
              return json_encode(
                  array(
                    "success" => false,
                    "errormsg" => $this->geterrormsg(1)
                  )
                );            
          
          }
}        
public function admissiondetails()
{
     $this->loadmodel('Dailyreport');
    $result= $this->Dailyreport->find('all');
    if($result)
    {
         $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['session'] = $result['Dailyreport']['session'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['totalenquiry'] = $result['Dailyreport']['total_enq'];
            $resultarray['result']['totalreg'] = $result['Dailyreport']['total_reg'];
            
             return json_encode($resultarray);
    }
    else {
              
              return json_encode(
                  array(
                    "success" => false,
                    "errormsg" => $this->geterrormsg(1)
                  )
                );            
          
          }
}
public function attendancedetails()
{
     $this->loadmodel('Dailyreport');
    $result= $this->Dailyreport->find('all');
    if($result)
    {
         $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['session'] = $result['Dailyreport']['session'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['sstrength'] = $result['Dailyreport']['sstrength'];
            $resultarray['result']['spresent'] = $result['Dailyreport']['spresent'];
            $resultarray['result']['sabsent'] = $result['Dailyreport']['sabsent'];
            $resultarray['result']['sremarks'] = $result['Dailyreport']['sremarks'];
            $resultarray['result']['estrength'] = $result['Dailyreport']['estrength'];
            $resultarray['result']['epresent'] = $result['Dailyreport']['epresent'];
            $resultarray['result']['eabsent'] = $result['Dailyreport']['eabsent'];
            $resultarray['result']['eremarks'] = $result['Dailyreport']['eremarks'];
             return json_encode($resultarray);
    }
    else {
              
              return json_encode(
                  array(
                    "success" => false,
                    "errormsg" => $this->geterrormsg(1)
                  )
                );            
          
          }
}      
public function checklogin()
{
    if( isset($this->request->data['username']))
                {

                    $usern = $this->request->data['username'];
                    echo '$usern';
                    
                }
if( isset($this->request->data['password']))
                {

                    $passw = $this->request->data['password'];
                    
                }

 // $usern ='palakagarwal659@gmail.com';
//$passw ='r4NCeRxRCZ';
//$curdatetm = new Datetime($curdate);
$expiretm=3600;
    $this->loadmodel('User');
 $result = $this->User->find('first',array('conditions' => array('username' => $usern,  
 'password' => AuthComponent::password($passw))));
 
 if($result)
 {
    $uuidkey = $this->generatePassword(8);
    $ip=$this->request->clientIp();
    $temp = array();
    $this->Uhist->create();
    $temp['Uhist']['uuid'] = AuthComponent::password($uuidkey);
    $temp['Uhist']['username'] = $result['User']['username'];
    $temp['Uhist']['password'] = AuthComponent::password($result['User']['password']);
    $temp['Uhist']['logindate']=date('Y-m-d');
    $temp['Uhist']['expiretm']=$expiretm;
    $temp['Uhist']['state'] = 'Online';
    $temp['Uhist']['loginip'] = $ip;
    $temp['Uhist']['logintime'] = date('Y-m-d h:i:s');
    $temp['Uhist']['lastupdated'] = date('Y-m-d h:i:s');
    
           // $this->Uhist->save($temp);
            
 }
if($this->Uhist->save($temp)){
 $state = 'Offline';
            $this->Uhist->updateAll(
                    array('Uhist.state'=>"'$state'"),
                    array('Uhist.username'=>$Uhist['username'])
                );
             $resultarray=array();
            $resultarray['result']['uuid'] = $temp['Uhist']['uuid'];
            $resultarray['result']['username'] = $temp['Uhist']['username'];
             return json_encode($resultarray);
//$this->Session->setFlash('successfullogin.');
//return $this->redirect(array('action' => 'login'));
 }
else {
              
              return json_encode(
                  array(
                    "success" => false,
                    "errormsg" => $this->geterrormsg(1)
                  )
                );            
          
          }


}
}