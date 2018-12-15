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
class ChecksController extends AppController {

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

        
/* FUNCTION TO GENERATE THE HASH PASSWORD  */
function generatePassword($length = 10) 
{
   $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ123456789';
   $count = mb_strlen($chars);
   for ($i = 0, $result = ''; $i < $length; $i++)
    {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }
    return $result;
}
function beforeFilter()
{
    parent::beforeFilter();
    $this->layout = 'empty';
    $this->autoRender = false;
    $this->Auth->allow('çhecklogin','çheckuuid','findmonthlyattendance','findmonthlyadmission','findmonthlyfee','feedetails','admissiondetails','studentattendancedetails','employeeattendancedetails','register','forgotpassword','login','sendotp','confirmotp','resendotp','generateotp','savepassword');
}
 /* UUID Check Machine */
function checkuuid($reqdata)
{
    $username = $reqdata['username'];
    $uuid = $reqdata['uuid'];
    $userid = $reqdata['userid'];
    $this->loadModel('Uhist');
    $mal = $this->Uhist->find('first',array(
        'conditions'=>array('Uhist.userid'=>$userid,'Uhist.uuid'=>$uuid,'Uhist.state'=>'Online'),
                'recursive'=>-1
            ));

    if ($mal) 
    {
      return 1;
    } 
    else
    {
      return json_encode(
              array(
                "success" => "0",
                "errormsg" => $this->geterrormsg(0)
              )
            );
    }
}

/*FUNCTION TO SHOW DAILY FEE DETAILS OF THE SCHOOL*/
public function feedetails()
{
    $this->loadmodel('Dailyreport');
    $date=date('Y-m-d');
/*fetching username and userid from app*/
    if( isset($this->request->data['username']))
    {

      $usern = $this->request->data['username'];
                    
    }
    if( isset($this->request->data['userid']))
    {

       $userid = $this->request->data['userid'];
                    
    }

    if( $this->checkuuid($this->request->data)==1)
    {
     $result= $this->Dailyreport->find('first',array('conditions' => array('userid'=>$userid,'date'=>$date)));
     if($result)
     {
            $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['cheque'] = $result['Dailyreport']['cheque'];
            $resultarray['result']['cash'] = $result['Dailyreport']['cash'];
            $resultarray['result']['card'] = $result['Dailyreport']['card'];
            $resultarray['result']['challan'] = $result['Dailyreport']['challan'];
            $resultarray['result']['online'] = $result['Dailyreport']['online'];
            $resultarray['result']['draft'] = $result['Dailyreport']['draft'];
            $resultarray['result']['fee_defaulters'] = $result['Dailyreport']['fee_defaulters'];
            $resultarray['result']['fremarks'] = $result['Dailyreport']['fremarks'];
            $resultarray['result']['success']="1";
            return json_encode($resultarray);
     }
     else 
     {
              
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(4)
                  )
                );            
          
     }
    }
    else
    {
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(4)
                  )
                );
    }
}  
/*FUNCTION TO SHOW DAILY ADMISSION DETAILS OF THE SCHOOL*/      
public function admissiondetails()
{
    $this->loadmodel('Dailyreport');
    $date=date('Y-m-d');

    if( isset($this->request->data['username']))
    {
      $usern = $this->request->data['username'];
    }
    if( isset($this->request->data['userid']))
    {
      $userid = $this->request->data['userid'];
    }
    if( $this->checkuuid($this->request->data)==1)
    {
      $result= $this->Dailyreport->find('first',array('conditions' => array('userid'=>$userid,'date'=>$date)));
     
      if($result)
      {
            $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['totalenquiry'] = $result['Dailyreport']['total_enq'];
            $resultarray['result']['totalreg'] = $result['Dailyreport']['total_reg'];
            $resultarray['result']['success']="1";
            return json_encode($resultarray);
      }
      else
      {
              
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(3)
                  )
                );            
          
      }
    }
    else 
    {
              
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(3)
                  )
                );            
          
    }
}

/*FUNCTION TO SHOW DAILY EMPLOYEE ATTENDANCE DETAILS OF THE SCHOOL*/
public function employeeattendancedetails()
{
    $this->loadmodel('Dailyreport');$this->loadModel('User');
    $date=date('Y-m-d');

    if( isset($this->request->data['username']))
    {
      $usern = $this->request->data['username'];
                    
    }
    if( isset($this->request->data['userid']))
    {
      $userid = $this->request->data['userid'];
                    
    }
    if( $this->checkuuid($this->request->data)==1)
    {
      $result= $this->Dailyreport->find('first',array('conditions' => array('userid'=>$userid,'date'=>$date)));
     
      if($result)
      {
            $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['estrength'] = $result['Dailyreport']['estrength'];
            $resultarray['result']['epresent'] = $result['Dailyreport']['epresent'];
            $resultarray['result']['eabsent'] = $result['Dailyreport']['eabsent'];
            $resultarray['result']['eremarks'] = $result['Dailyreport']['eremarks'];
            $resultarray['result']['success']="1";
            return json_encode($resultarray);
      }
      else
      {
              
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(2)
                  )
                );            
          
      }
    }
    else
    {
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(2)
                  )
                );            
          
    }
} 
/*FUNCTION TO SHOW DAILY ATTENDANCE DETAILS OF THE STUDENTS*/
public function studentattendancedetails()
{
    $this->loadmodel('Dailyreport');$this->loadModel('User');
    $date=date('Y-m-d');

    if( isset($this->request->data['username']))
    {
      $usern = $this->request->data['username'];
    }
    if( isset($this->request->data['userid']))
    {
      $userid = $this->request->data['userid'];
    }
    if( $this->checkuuid($this->request->data)==1)
    {
      $result= $this->Dailyreport->find('first',array('conditions' => array('userid'=>$userid,'date'=>$date)));
     
      if($result)
      {
            $resultarray=array();
            $resultarray['result']['userid'] = $result['Dailyreport']['userid'];
            $resultarray['result']['date'] = $result['Dailyreport']['date'];
            $resultarray['result']['sstrength'] = $result['Dailyreport']['sstrength'];
            $resultarray['result']['spresent'] = $result['Dailyreport']['spresent'];
            $resultarray['result']['sabsent'] = $result['Dailyreport']['sabsent'];
            $resultarray['result']['sremarks'] = $result['Dailyreport']['sremarks'];
            $resultarray['result']['success']="1";
            return json_encode($resultarray);
      }
      else
      {
              
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(2)
                  )
                );            
          
        }
    }
    else
    {
            return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(2)
                  )
                );            
          
    }
}    
/* Checking User Login & UUID Generation */  
public function checklogin()
{
   if( isset($this->request->data['username']))
   {
     $usern = $this->request->data['username'];
   }
   if( isset($this->request->data['password']))
   {
     $passw = $this->request->data['password'];
   }

    //$usern ='palakagarwal659@gmail.com';
    //$passw ='r4NCeRxRCZ';
   $expiretime=3600;
   $this->loadmodel('User');
   $result = $this->User->find('first',array('conditions' => array('username' => $usern,  
            'password' => AuthComponent::password($passw))));
   $this->loadModel('Schooldetail');
   $schooldetail = $this->Schooldetail->find('first',array('conditions' => array('email' => $usern)));
   if($result)
   {
      $uuidkey = $this->generatePassword(8);
      $ip=$this->request->clientIp();
      $temp = array();
      $this->loadmodel('Uhist');
      $this->Uhist->create();
      $temp['Uhist']['uuid'] = AuthComponent::password($uuidkey);
      $temp['Uhist']['username'] = $result['User']['username'];
      $temp['Uhist']['password'] = AuthComponent::password($result['User']['password']);
      $temp['Uhist']['logindate']=date('Y-m-d');
      $temp['Uhist']['expiretm']=$expiretime;
      $temp['Uhist']['state'] = 'Online';
      $temp['Uhist']['loginip'] = $ip;
      $temp['Uhist']['logintime'] = date('Y-m-d h:i:s');
      $temp['Uhist']['lastupdated'] = date('Y-m-d h:i:s');
      $temp['Uhist']['userid']=$schooldetail['Schooldetail']['id'];
           
      $state = 'Offline';
      $this->Uhist->updateAll(
                    array('Uhist.state'=>"'$state'"),
                    array('Uhist.username'=>$temp['Uhist']['username'])
                );
            
    }
    else 
    {
              
              return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(1)
                  )
                );            
          
    }
    if($this->Uhist->save($temp))
    {

        $resultarray=array();
        $resultarray['result']['uuid'] = $temp['Uhist']['uuid'];
        $resultarray['result']['username'] = $temp['Uhist']['username'];
        $resultarray['result']['success']=1;
        $resultarray['result']['schoolname']=$schooldetail['Schooldetail']['name'];
        $resultarray['result']['userid']=$schooldetail['Schooldetail']['id'];
        return json_encode($resultarray);

    }
    else 
    {
              
        return json_encode(
                  array(
                    "success" => "0",
                    "errormsg" => $this->geterrormsg(1)
                  )
                );            
          
    }


}



/* MONTHLY ANALYSIS OF ATTENDANCE */
public function findmonthlyattendance()
{
    $this->loadmodel('Dailyreport');
     
    $cur_date=date('Y-m-d');
    $date_start = date('Y-m-01', strtotime($cur_date));
    $date_end = date('Y-m-d');

    $conditions = array(
        'conditions' => array(
        'date'>=($date_start), 
        'date'<=($date_end)
        ));
    $result= $this->Dailyreport->find('all',$conditions);
    $total=0;$totalpr=0;$totalab=0;$etotal=0;$totalepr=0;$totaleab=0;
     
    foreach ($result as $row)
    {
      $res=(int)$row['Dailyreport']['sstrength'];
      $total=$total+$res;
      $totalpr=$totalpr+$row['Dailyreport']['spresent'];
      $totalab=$totalab+$row['Dailyreport']['sabsent'];
      $etotal=$etotal+$row['Dailyreport']['estrength'];
      $totalepr=$totalepr+$row['Dailyreport']['epresent'];
      $totaleab=$totaleab+$row['Dailyreport']['eabsent'];
  
    }
    
    $present=($totalpr/$total)*100;
    $absent=($totalab/$total)*100;
    $epresent=($totalepr/$etotal)*100;
    $eabsent=($totaleab/$etotal)*100;
    $resultarray=array();
    
    $resultarray['result']['cur_date'] = $date_start;
    $resultarray['result']['date_end'] = $date_end;
    $resultarray['result']['present'] = $present;
    $resultarray['result']['absent'] = $absent;
    $resultarray['result']['total'] = $total;
    $resultarray['result']['epresent'] = $epresent;
    $resultarray['result']['eabsent'] = $eabsent;
    $resultarray['result']['etotal'] = $etotal;
    $resultarray['result']['success']="1";
    return json_encode($resultarray);

    if(!$result)
    {
              
     return json_encode(
          array(
                  "success" => false,
                  "errormsg" => $this->geterrormsg(2)
               )
            );            
          
    }
}
/* MONTHLY ANALYSIS ADMISSION */
public function findmonthlyadmission()
{
    $this->loadmodel('Dailyreport');
    $cur_date=date('Y-m-d');
    $date_start = date('Y-m-01', strtotime($cur_date));
    $date_end = date('Y-m-d');
    $conditions = array(
        'conditions' => array(
        'date'>=($date_start), 
        'date'<=($date_end)
        ));

    $result= $this->Dailyreport->find('all',$conditions);
    $totalenq=0;$totalreg=0;
    foreach ($result as $row)
    {
      $totalenq=$totalenq+$row['Dailyreport']['total_enq'];
      $totalreg=$totalreg+$row['Dailyreport']['total_reg'];
      
    }
    
    $resultarray=array();
    
    $resultarray['result']['cur_date'] = $date_start;
    $resultarray['result']['date_end_month'] = $date_end;
    $resultarray['result']['totalenq'] = $totalenq;
    $resultarray['result']['totalreg'] = $totalreg;
    $resultarray['result']['success']="1";
    return json_encode($resultarray);

    if(!$result)
    {
              
      return json_encode(
                  array(
                    "success" => false,
                    "errormsg" => $this->geterrormsg(3)
                  )
                );            
          
    }
}
/* MONTHLY ANALYSIS OF FEE */
public function findmonthlyfee()
{
    $this->loadmodel('Dailyreport');
    $cur_date=date('Y-m-d');
    $date_start = date('Y-m-01', strtotime($cur_date));
    $date_end = date('Y-m-d');
    $conditions = array(
        'conditions' => array(
        'date'>=($date_start), 
        'date'<=($date_end)
        ));
    
    $result= $this->Dailyreport->find('all',$conditions);
    $totalcash=0;$totalcheque=0;$totalcard=0;$totalchallan=0;$totalonline=0;$totaldraft=0;
    $totaldefaulters=0;
    foreach ($result as $row)
    {
      $totalcash=$totalcash+$row['Dailyreport']['cash'];
      $totalcheque=$totalcheque+$row['Dailyreport']['cheque'];
      $totalcard=$totalcard+$row['Dailyreport']['card'];
      $totalchallan=$totalchallan+$row['Dailyreport']['challan'];
      $totalonline=$totalonline+$row['Dailyreport']['online'];
      $totaldraft=$totaldraft+$row['Dailyreport']['draft'];
      $totaldefaulters=$totaldefaulters+$row['Dailyreport']['fee_defaulters'];
    }
    
    $resultarray=array();
    
    $resultarray['result']['cur_date'] = $date_start;
    $resultarray['result']['date_end_month'] = $date_end;
    $resultarray['result']['totalcash'] = $totalcash;
    $resultarray['result']['totalcheque'] = $totalcheque;
    $resultarray['result']['totalcard'] = $totalcard;
    $resultarray['result']['totalchallan'] = $totalchallan;
    $resultarray['result']['totalonline'] = $totalonline;
    $resultarray['result']['totaldraft'] = $totaldraft;
    $resultarray['result']['totaldefaulters'] = $totaldefaulters;
    $resultarray['result']['success']="1";
    return json_encode($resultarray);

    if(!$result)
    {
              
        return json_encode(
                  array(
                    "success" => false,
                    "errormsg" => $this->geterrormsg(4)
                  )
                );            
          
    }
}

/* FUNCTION TO GENERATE ERROR MESSAGE  */
function geterrormsg($errorcode) 
{
  if ($errorcode==0) 
  {
    return 'Invalid Token Received.';
  } 
  else if ($errorcode==1)
  {
    return 'Login Failed ! Incorrect Username or Password.';
  }
  else if ($errorcode==2)
  {
    return 'Sorry,Try Again to Find Attendance Details';
  }
  else if ($errorcode==3)
  {
    return 'Sorry,Try Again to Find Admission Details';
  }
  else if ($errorcode==4)
  {
    return 'Sorry,Try Again to Find Fee Details';
  }
}

}