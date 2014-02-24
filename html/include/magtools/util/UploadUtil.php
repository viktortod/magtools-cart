<?php
class UploadUtil {
    public static function uploadFile($fileType, $file, $file_prefix='', $deep = ''){
            if(!empty($file['type'])){
                $mimeType = $file['type'];

                if(in_array($mimeType, FileType::$fileTypeFormats[$fileType])){
                    $fileDestination = dirname(dirname(dirname(dirname(__FILE__))));
                    $fileDestination .= Settings::getSetting(Settings::SETTINGS_SITE_MAIN_UPLOAD_DIR);

                    if(!empty ($deep)){
                        $fileDestination .= $deep;

                        if(!is_dir($fileDestination)){
                            mkdir($fileDestination);
                        }
                    }

                    $fileDestination .= $file_prefix . $file['name'];
                    if(move_uploaded_file($file['tmp_name'], $fileDestination)){
                        return $fileDestination;
                    }
                    else{
                        throw new FileNotUploadedException('Upload failed');
                    }
                }
                else{
                    throw new UploadValidationException('Not allowed file type for '.$file['name']);
                }
            }
    }
    
    public static function isUploadedFile($filename){
    	return is_uploaded_file($filename);
    }

    public static function getUploadDir() {
        $fileDestination = dirname(dirname(dirname(dirname(__FILE__))));
        $fileDestination .= Settings::getSetting(Settings::SETTINGS_SITE_MAIN_UPLOAD_DIR);

        return $fileDestination;
    }

    public static function prepareFilesStack($_files, $top = true){
        $files = array();
        
        foreach($_files as $name=>$file){
            if($top) $sub_name = $file['name'];
            else    $sub_name = $name;

            if(is_array($sub_name)){
                foreach(array_keys($sub_name) as $key){
                    $files[$name][$key] = array(
                        'name'     => $file['name'][$key],
                        'type'     => $file['type'][$key],
                        'tmp_name' => $file['tmp_name'][$key],
                        'error'    => $file['error'][$key],
                        'size'     => $file['size'][$key],
                    );
                    $files[$name] = self::prepareFilesStack($files[$name], FALSE);
                }
            }else{
                $files[$name] = $file;
            }
        }
        return $files;
    }
}

class FileType{
    const FILE_TYPE_IMAGE = 0;
    const FILE_TYPE_DOCUMENT = 1;
    const FILE_TYPE_CSV = 2;

    public static $fileTypeFormats = array(
        self::FILE_TYPE_IMAGE => array(
            'image/png',
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/pjpeg',
            'image/tiff'
        ),
        self::FILE_TYPE_DOCUMENT => array(
            'application/msword',
            'application/pdf',
            'application/mspowerpoint',
            'application/powerpoint',
            'application/excel'
        ),
        self::FILE_TYPE_CSV => array(
            'text/csv',
            'text/comma-separated-values'
        ),
    );
}


class FileNotUploadedException extends Exception {}

class UploadValidationException extends Exception {}
?>
