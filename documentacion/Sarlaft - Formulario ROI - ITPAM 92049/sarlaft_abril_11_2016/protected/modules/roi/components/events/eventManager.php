<?php
/**
 * Subdireccion Aplicaciones Corporativas
* @author Joan Harriman Navarro M - jnavarrm@asesor.une.com.co
* @copyright UNE TELECOMUNICACIONES
*/

class eventManager extends CApplicationComponent {
       
     /**
	 * Registra las transacciones
	 */
	public function registerLog($code_response='0',$process,$content='')
	{
		$blackList                             = array('r');
		$request                               = array();
		
		foreach($_REQUEST as $key =>$value)
		{
                    if(!in_array($key,$blackList))
                    {
                        if(is_array($value))
                        {
                                foreach($value as $index =>$val)
                                {
                                        $request[]      = "{".$index."=".$val."}";
                                }
                        }
                        else
                        {
                                $request[]              = "{".$key."=".$value."}";
                        }
                    }
		}
		
		$event					= new ImportDataLog();		
		$event->id				= '0';
		$event->module_id			= '';
		$event->cod_response			= $code_response;
		$event->process                         = $process;
		$event->import_date			= date('Y-m-d h:i:s');
		$event->user                            = Yii::app()->user->name;
                if(!empty($content))
                {
                    $event->content			= htmlentities(addslashes($content));
                }		
		$event->Save();		
		 
	}
	
	 /**
	 * Registra error de la aplicación
	 */
	public function registerException($eventname='',$content='')
	{
		$event					= new EventLog();
		
		$event->id				= '0';
		$event->eventname		= $eventname;
		$event->user_exe		= Yii::app()->user->name;
		$event->content			= addslashes($content);
		$event->ctr				= Yii::app()->getController()->getId();
		$event->acc				= Yii::app()->controller->action->id;
		$event->dateevent		= date('Y-m-d h:i:s');
		$event->ipaddress		= $_SERVER['REMOTE_ADDR'];
		
		$event->Save();		
		 
	}
	
}