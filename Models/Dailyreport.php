<?php
App::uses('AppModel', 'Model');
/**
 * Schooldetail Model
 *
 * @property Fileupload $Fileupload
 */
class Dailyreport extends AppModel {

	public function beforeSave($options = array()) {
        if (!empty($this->data['Dailyreport']['date']) )
         {

            $this->data['Dailyreport']['date'] = $this->dateFormatBeforeSave(
                $this->data['Dailyreport']['date']
            );
           
        }
        return true;
    }

    public function dateFormatBeforeSave($dateString) {
        return date('Y-m-d', strtotime($dateString));
    }

    
}
