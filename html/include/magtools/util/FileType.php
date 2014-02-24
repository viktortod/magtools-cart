<?php
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
