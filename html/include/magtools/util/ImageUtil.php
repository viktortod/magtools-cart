<?php
class ImageUtil {
    const IMAGEUTIL_RESAMPLE_DESTINATION_X = 0;
    const IMAGEUTIL_RESAMPLE_DESTINATION_Y = 0;
    const IMAGEUTIL_RESAMPLE_SOURCE_X = 0;
    const IMAGEUTIL_RESAMPLE_SOURCE_Y = 0;
    const IMAGEUTIL_PORTRAIT_MARGIN_WIDTH = 50;

    protected static function getImageType($imageDestination) {
        $imageType = explode(".", $imageDestination);
        return $imageType[count($imageType)-1];
    }

    protected static function getImageFileName($imageDestination) {
        return basename(str_replace('.'.self::getImageType($imageDestination), '', $imageDestination));
    }

    public static function getImage($imageDestination) {
        $imageType = self::getImageType($imageDestination);
        switch(strtolower($imageType)) {
            case 'gif':
                $image = imagecreatefromgif($imageDestination);
                break;
            case 'jpg':
                $image = imagecreatefromjpeg($imageDestination);
                break;
            case 'png':
                $image = imagecreatefrompng($imageDestination);
                break;
        }

        return $image;
    }

    protected static function getImageSize($image) {
        $size = getimagesize($image);
        $imageWidth = $size[0];    //Images width
        $imageHeight = $size[1];    //Images height

        return array(
            'width' => $imageWidth,
            'height' => $imageHeight
        );
    }

    public static function processThumbnailing($imageSource, $destinationSource, $destinationImageSize=array(), $thumbPath = '') {
        $image = self::getImage($imageSource);
        $size = self::getImageSize($imageSource);
        $destinationImage = imagecreatetruecolor($destinationImageSize['width'], $destinationImageSize['height']);

        imagecopyresized($destinationImage, $image, self::IMAGEUTIL_RESAMPLE_DESTINATION_X,
                            self::IMAGEUTIL_RESAMPLE_DESTINATION_Y, self::IMAGEUTIL_RESAMPLE_SOURCE_X,
                            self::IMAGEUTIL_RESAMPLE_SOURCE_Y,$destinationImageSize['width'],
                            $destinationImageSize['height'], $size['width'], $size['height']);
        $imageEndDestination = UploadUtil::getUploadDir().$thumbPath. self::getImageFileName($imageSource).'.jpg';
        imagejpeg($destinationImage, $imageEndDestination);
        imagedestroy($image);
        return self::getImageFileName($imageSource).'.jpg';
    }

    public static function isLandscapeImage($imageSize) {
        return ($imageSize['width'] > $imageSize['height']);
    }
}
?>
