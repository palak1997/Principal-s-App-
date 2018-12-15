<div class="main_content" id="main_content">
    
    <div id="p2list">
        
        <div class="widgets">
            
            <div class="widget-list">
				
				<div class="formc" style="width: 90%;">
                    
                	<div class="form-header" style="font-weight: bold;">Edit Daily Report</div>
                    
                    <hr width="100%" color="#f1f1f1" style="margin-top:6px; margin-bottom:6px;"/>
                    
                    <div class="middle-inputtext">
                    <?php echo $this->Form->create('Dailyreport'); ?>
                        <label>DATE</label>
                        <?php  echo $this->Form->input('date', array('type'=>'text','class'=>'datepicker','label'=>false));?>
                        
                    </div>
                    
                    <?php echo $this->Form->end('Edit Daily Report'); ?>

                    <?php if(isset($report)):
                     echo $this->Form->create('Dailyreport',array('action' => 'uploadreport'));
                    ?>
                      
                        <?php echo $this->Form->input('date',array('type'=>'hidden','value'=>$report['Dailyreport']['date'])); ?>
                        <?php echo $this->Form->input('session',array('type'=>'hidden','value'=>$report['Dailyreport']['session'])); ?>

                    	<div class="middle-inputtext">
                    	<label>STUDENT ATTENDANCE </label><br>
                    	<?php echo $this->Form->input('sstrength',array('label' => 'Strength','default'=>$report['Dailyreport']['sstrength'], 'type' => 'number'));?>
                    	<?php echo $this->Form->input('spresent',array('label' => 'Present','default'=>$report['Dailyreport']['spresent'], 'type' => 'number'));?>
     					<?php echo $this->Form->input('sabsent',array('label' => 'Absent','default'=>$report['Dailyreport']['sabsent'], 'type' => 'number'));?> 
       					<?php echo $this->Form->input('sremarks',array('label' => 'Remarks','default'=>$report['Dailyreport']['sremarks'], 'type' => 'text'));?> 
                        
                    	</div>

                    	<div class="middle-inputtext">
                        <label>EMPLOYEE ATTENDANCE </label><br>
                        <?php echo $this->Form->input('estrength',array('label' => 'Strength','default'=>$report['Dailyreport']['estrength'], 'type' => 'number'));?>
     					<?php echo $this->Form->input('epresent',array('label' => 'Present','default'=>$report['Dailyreport']['epresent'], 'type' => 'number'));?>
     					<?php echo $this->Form->input('eabsent',array('label' => 'Absent','default'=>$report['Dailyreport']['eabsent'], 'type' => 'number'));?> 
       					<?php echo $this->Form->input('eremarks',array('label' => 'Remarks','default'=>$report['Dailyreport']['eremarks'], 'type' => 'text'));?> 
                        </div>
                    
                    	<div class="middle-inputtext">
                        <label>ADMISSION</label>
                        <?php echo $this->Form->input('total_enq',array('label' => 'Enquiry','default'=>$report['Dailyreport']['total_enq'], 'type' => 'number',));?>
     					<?php echo $this->Form->input('total_reg',array('label' => 'Registration','default'=>$report['Dailyreport']['total_reg'], 'type' => 'number'));?> 
                    	</div>
                                        
                        <div class="middle-inputtext">
                        <label>FEE</label>
                        <?php echo $this->Form->input('cheque',array('label' => 'Cheque','default'=>$report['Dailyreport']['cheque'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('cash',array('label' => 'Cash','default'=>$report['Dailyreport']['cash'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('card',array('label' => 'Card','default'=>$report['Dailyreport']['card'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('challan',array('label' => 'Challan','default'=>$report['Dailyreport']['challan'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('online',array('label' => 'Online','default'=>$report['Dailyreport']['online'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('draft',array('label' => 'Draft','default'=>$report['Dailyreport']['draft'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('fee_defaulters',array('label' => 'Fee Defaulters','default'=>$report['Dailyreport']['fee_defaulters'], 'type' => 'number',));?>
                        <?php echo $this->Form->input('fremarks',array('label' => 'Remarks','default'=>$report['Dailyreport']['fremarks'], 'type' => 'text',));?>
                        <?php echo $this->Form->end('Upload Daily Report'); ?>
                    	</div>
                    
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
                	
                
