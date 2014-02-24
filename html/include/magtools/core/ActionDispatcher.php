<?php
class ActionDispatcher {
    protected $dispatchInformation;

    public function  __construct() {
        $this->dispatchInformation['clearFilters'] = 'ClearFilters' ;
        $this->dispatchInformation['doEdit'] = 'osExecUpdate' ;
        $this->dispatchInformation['doCreate'] = 'osExecInsert' ;
    }

    /**
     * Dispatch the action from the handler stack
     * @todo exception handling if the action is not in the stack
     * @param string $action the name of the action
     * @return array
     */
    public function dispatch($action, $dataMapper){
        if( isset($this->dispatchInformation[$action])){
            
            $handler = $this->dispatchInformation[$action] . 'Action';
            $object = new $handler();
            if($dataMapper != null)
            $object->addDataMapper($dataMapper);
            try{
                $object->prepare();
                $ActionResult = $object->execute();
                $object->postExecute();

                if($ActionResult){
                    return $ActionResult;
                }
            }
            catch(ValidationException $exception){
//                Controller::redirect($_SERVER['HTTP_REFERER']);
            }
        }

        return true;
    }

    /**
     * Adds an element into the handler stack
     */
    public function setActionHandler($action, $handler){
        $this->dispatchInformation[$action] = $handler;
    }
}
?>
