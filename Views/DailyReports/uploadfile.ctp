<?php echo $this->Form->create('Dailyreport',array('type' => 'file')); ?>

<div class="main_content" id="main_content">
    
    <div id="p2list">
        <div class="widgets">
            
            <div class="widget-list">
                <div class="formc" style="width: 90%;">
                    
                    <div class="form-header" style="font-weight: bold;">Create Daily Report</div>

                    <hr width="100%" color="#f1f1f1" style="margin-top:6px; margin-bottom:6px;"/>

                    <div class="middle-inputtext">
                        <label>SESSION</label>
                       <?php $sizes = array('2017-18' => '2017-18', '2018-19' => '2018-19', '2019-20' => '2020-21', '4' => '2020-21', '2021-22' => '2021-22');
                            echo $this->Form->input('session',array('options' => $sizes, 'default' => '1','label'=>false));?>
                        
                    </div>

                    <div class="middle-inputtext">
                        <label>DATE</label>
                        <?php  echo $this->Form->input('date', array('type'=>'text','class'=>'datepicker','label'=>false,'div'=>false

));?>
                        
                    </div>

                    <div class="middle-inputtext">
                        <label>STUDENT ATTENDANCE </label>
                        <?php echo $this->Form->input('sstrength',array('label' => 'Strength','placeholder' => 'Strength', 'type' => 'number'));?>
     <?php echo $this->Form->input('spresent',array('label' => 'Present','placeholder' => 'Present', 'type' => 'number'));?>
     <?php echo $this->Form->input('sabsent',array('label' => 'Absent','placeholder' => 'Absent', 'type' => 'number'));?> 
       <?php echo $this->Form->input('sremarks',array('label' => 'Remarks','placeholder' => 'Remarks', 'type' => 'text'));?> 
                        
                    </div>
  <div class="middle-inputtext">
                        <label>EMPLOYEE ATTENDANCE </label><br>
                        <?php echo $this->Form->input('estrength',array('label' => 'Strength','placeholder' => 'Strength', 'type' => 'number'));?>
     <?php echo $this->Form->input('epresent',array('label' => 'Present','placeholder' => 'Present', 'type' => 'number'));?>
     <?php echo $this->Form->input('eabsent',array('label' => 'Absent','placeholder' => 'Absent', 'type' => 'number'));?> 
       <?php echo $this->Form->input('eremarks',array('label' => 'Remarks','placeholder' => 'Remarks', 'type' => 'text'));?> 
                        
                    </div>
                    <div class="middle-inputtext">
                        <label>ADMISSION</label>
                        <?php echo $this->Form->input('total_enq',array('label' => 'Enquiry','placeholder' => 'Enquiry', 'type' => 'number',));?>
     <?php echo $this->Form->input('total_reg',array('label' => 'Registration','placeholder' => 'Registration', 'type' => 'number'));?> 
                    </div>
                                        <div class="middle-inputtext">
                        <label>FEE</label>
                        <?php echo $this->Form->input('cheque',array('label' => 'Cheque','placeholder' => 'Cheque', 'type' => 'number',));?>
                        <?php echo $this->Form->input('cash',array('label' => 'Cash','placeholder' => 'Cash', 'type' => 'number',));?>
                        <?php echo $this->Form->input('card',array('label' => 'Card','placeholder' => 'Card', 'type' => 'number',));?>
                        <?php echo $this->Form->input('challan',array('label' => 'Challan','placeholder' => 'Challan', 'type' => 'number',));?>
                        <?php echo $this->Form->input('online',array('label' => 'Online','placeholder' => 'Online', 'type' => 'number',));?>
                        <?php echo $this->Form->input('draft',array('label' => 'Draft','placeholder' => 'Draft', 'type' => 'number',));?>
                        <?php echo $this->Form->input('fee_defaulters',array('label' => 'Fee Defaulters','placeholder' => 'Fee Defaulters', 'type' => 'number',));?>
                        <?php echo $this->Form->input('fremarks',array('label' => 'Remarks','placeholder' => 'Remarks', 'type' => 'text',));?>
                        <?php echo $this->Form->end('Upload Daily Report'); ?>
                    </div>

                    
                </div>
               <!-- <div class="formc">
                
                    <div class="form-header" style="text-align: center; font-size: 16px;"><b>CBSE SENIOR SECONDARY SCHOOL EXAMINATION ANALYSIS</b> </div>
                    
                    <hr width="100%" color="#f1f1f1" style="margin-top:6px; margin-bottom:6px;"/>
            
                    <div class='large-inputtext' >
                        <label style="text-align: center; font-weight: bold; width: 100%; font-size: 15px;">Upload Information</label>
                    </div>
                    <div class="large-inputtext" style="text-align: center;">
                        
                        <?php $sizes = array('1' => '2017-18', '2' => '2018-19', '3' => '2019-20', '4' => '2020-21', '5' => '2021-22');
                            echo $this->Form->input('session',array('options' => $sizes, 'default' => '1'));?>
                        
                            <?php  echo $this->Form->input('date', array('type'=>'text','class'=>'datepicker'

));?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center>STUDENT ATTENDANCE:</center>
<?php echo $this->Form->input('sstrength',array('label' => 'Strength'));?>
     <?php echo $this->Form->input('spresent',array('label' => 'Present'));?>
     <?php echo $this->Form->input('sabsent',array('label' => 'Absent'));?> 
       <?php echo $this->Form->input('sremarks',array('label' => 'Remarks'));?>  
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center>EMPLOYEE ATTENDANCE:</center>
<?php echo $this->Form->input('estrength',array('label' => 'Strength'));?>
     <?php echo $this->Form->input('epresent',array('label' => 'Present'));?>
     <?php echo $this->Form->input('eabsent',array('label' => 'Absent'));?>  
     <?php echo $this->Form->input('eremarks',array('label' => 'Remarks'));?> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center>ADMISSION:</center>
<?php echo $this->Form->input('total_enq',array('label' => 'Enquiry'));?>
     <?php echo $this->Form->input('total_reg',array('label' => 'Registration'));?> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center>FEE COLLECTION:</center>
<?php echo $this->Form->input('total_col',array('label' => 'Collection'));?>
     <?php echo $this->Form->input('total_reg',array('label' => 'Fee Methods'));?> 
     <?php echo $this->Form->input('fee_defaulters',array('label' => 'Fee Defaulters'));?>
     <?php echo $this->Form->input('fremarks',array('label' => 'Remarks'));?>              
                    </div>
                    <br/>
                    <div class="large-inputtext" style="text-align: center;">
                        
                        <?php echo $this->Form->input('Proceed',array('label'=>false,'div'=>false,'type'=>'button')); ?>
                        
                    </div>

                </div>
                
            </div>
            
        </div>
    </div>-->

    <?php echo $this->Form->end(); ?>
                                
</div>
</div>
</div>
</div>

            