<?php
class TemplateParser {
    private $variables;
    private $conditions;
    private $iterations;

    private $template;

    protected $plugins;

    public function  __construct($template) {
        if(!file_exists($template)){
            return '';
        }
        
        ob_start();
        require_once $template;
        $this->template = ob_get_clean();
        $this->conditions = array();
        $this->iterations = array();
        $this->plugins = array(
            'translate' => 'translate'
        );
    }

    public function assignVariable($templateVar, $value){
        $this->variables[$templateVar] = $value;
    }

    public function assignVariableArray($vars){
        foreach($vars as $var => $value)
        $this->variables[$var] = $value;
    }


    public function setTempalateVariables($vars){
        $this->variables =  $vars;
    }

    public function setCondition(TemplateParserCondition $condition){
        $this->conditions[] = $condition;
    }

    public function setIteration(TemplateParserIteration $iteration){
        $this->iterations[] = $iteration;
    }

    public function parseTemplate(){
        
        $this->parseIterations($this->template);
        $this->parseVariables($this->template);
        $this->parseConditions($this->template);
        $this->parsePlugins($this->template);
        
//        echo $this->template;
    }

    public function getContent(){
        return $this->template;
    }

    public function setContent($content){
        $this->template = $content;
    }

    public function showTemplate(){
        $template = preg_replace('/<%(.*)%>/', '', $this->template);
        echo $template;
    }

    protected function parsePlugins($content){
        if( count($this->plugins) > 0){
            foreach($this->plugins as $pluginName => $pluginVariables){
                $pluginFunction = "TemplateParser".ucfirst($pluginName);

                if( function_exists($pluginFunction) ){
                    $content = $pluginFunction($content, $pluginVariables);
                }
                elseif(class_exists($pluginFunction)){
                    $pluginObj = new $pluginFunction($content);

                    $content = $pluginObj->parse();
                }
            }
        }

        $this->template = $content;
    }


    private function parseVariables($content){
        if(count($this->variables) > 0){
            foreach($this->variables as $variable => $value){
                $toReplace = '<%' . $variable . '%>';
                $content = str_replace($toReplace, $value, $content);
            }
        }

        $this->template =  $content;
    }

    private function parseIterations($content){
        if(count($this->iterations) >0){
            
            foreach($this->iterations as $iteration){
                $iterationStart = '<:iteration name="'. $iteration->getName() .'">';
                $iterationEnds  = '<:enditeration name="' . $iteration->getName() . '">';

                $data = $iteration->getData();

                $regExpression = "/$iterationStart(.*)$iterationEnds/";
                $content = preg_replace('/\s\s+/', ' ', $content);

                $output = "";
                if( count($data) > 0){
                    preg_match_all($regExpression, $content, $iterationBody);
                    if(isset($iterationBody[0][0])){
                        $iterationExpression = $iterationBody[0][0];

                        foreach($data as $dataItem){
                             $parsedIteration = $iterationExpression;

                             
                             if(is_array($dataItem) && count($dataItem) > 0){
                                 if($iteration->getIterationType() == TemplateParserIteration::PARSER_ITERATION_TYPE_ASSOC){
                                     foreach($dataItem as $variableName=>$variableValue){
                                         $toReplace = "<:".$variableName.":>";
                                         $parsedIteration = str_replace($toReplace, $variableValue, $parsedIteration);
                                     }
                                 }
                                 else{
                                     foreach($dataItem as $variableValue){
                                         $toReplace = "<:element:>";
                                         $parsedIteration = str_replace($toReplace, $variableValue, $parsedIteration);
                                     }
                                 }

                                 $output .= $parsedIteration;
                             }
                             else{
                                  $toReplace = "<:element:>";
                                  $parsedIteration = str_replace($toReplace, $dataItem, $parsedIteration);
                             }
                        }

                        $content = str_replace($iterationExpression, $output, $content);

                        $content = str_replace($iterationStart, "", $content);
                        $content = str_replace($iterationEnds, "", $content);
                    }
                    
                }
                else{
                    $iterationExpression = $regExpression;
                    $content = preg_replace($iterationExpression, '<tr><td>No records<td></tr>', $content);
                }
            }

            
//            exit();
            $content = str_replace($iterationStart, "", $content);
            $content = str_replace($iterationEnds, "", $content);

            $this->template = $content;
        }
        
    }

    private function parseConditions($content){
        if(count($this->conditions) >0){
            foreach($this->conditions as $condition){
                $conditionStart = '<:condition name="' . $condition->getName() . '":>';
                $conditionEnd   = '<:endcondition name="' . $condition->getName() . '":>';

                $conditionElse = '<:else condition="' . $condition->getName() . '":>';
                
                if( !$condition->isConditionTrue() ){


                    $regExpression = "/$conditionStart(.*)$conditionElse/";
                    $content = preg_replace('/\s\s+/', ' ', $content);

                    preg_match_all($regExpression, $content, $conditionBody);


                    foreach($conditionBody as $conditionInner){
                        $content = str_replace($conditionInner, "", $content);
                    }
                }
                else{
                    $regExpression = "/$conditionElse(.*)$conditionEnd/";
                    $content = preg_replace('/\s\s+/', ' ', $content);

                    preg_match_all($regExpression, $content, $conditionBody);

                    
                    foreach($conditionBody as $conditionInner){
                        $content = str_replace($conditionInner, "", $content);
                    }
                }
                
                $content = str_replace($conditionStart, "", $content);
                $content = str_replace($conditionEnd, "", $content);
                $content = str_replace($conditionElse, "", $content);
            }

            $this->template =  $content;
        }
    }
}
?>
