<?php
	class MessageUtil {
		const MESSAGE_TYPE_WARNING = 'alert_warning';
		const MESSAGE_TYPE_INFO = 'alert_info';
		const MESSAGE_TYPE_ERROR = 'alert_error';
		
		public static function setMessage($type, $message){
			jsSession::addParam("message", $message, "UIMessage");
			jsSession::addParam("type", $type,"UIMessage");
		}
		
		public static function getMessage(){
			if(jsSession::getSessionParamDefault("message", false, "UIMessage") != false){
				$type = jsSession::getSessionParamDefault("type", "", "UIMessage");
				$value = jsSession::getSessionParamDefault("message", "", "UIMessage");
				jsSession::removeParam("type","UIMessage");
				jsSession::removeParam("message","UIMessage");
				
				return '<h4 class="' . $type[0] . '">'.$value[0].'</h4>';
			}
		}
	}