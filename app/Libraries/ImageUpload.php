<?php
namespace App\Libraries;

class ImageUpload
{

    public static function mkUploadDir()
    {
        $uploadTime = time();
        $public_path = public_path();
        //设置路径//创建图片存储文件夹
        $uploadSrc = '/upload/img/';
        $dir = $uploadSrc . date('Ymd',$uploadTime);
        $allDir = $public_path.$dir;
        if (!file_exists($allDir)) {
            mkdir($allDir, 0777, true);
        }
        return $dir;
    }


    private static function getMimeType($mimeType)
    {
        $mime = [
            'image/gif'=>'gif',
            'image/jpeg'=>'jpge',
            'image/png'=>'png',
        ];
        return $mime[$mimeType];
    }

    /**
     * 文件上传
     * @param  $tmpSrc   临时文件
     * @param array $size  要裁减的尺寸，可以多个尺寸[['width'=>100,'height'=>100],['width'=>200,'height'=>200]]
     * @return array
     */
    public static function upload ($file,$size = []) {
        $mimeType = self::getMimeType($file->getMimeType());
        $img_name = md5(uniqid().'_'.date('His',time())).'.'.$mimeType;     //图片名称
        // $old_src = $allDir . $img_name.'.'.$img_info['type']; //原始图片
        $dbDir = self::mkUploadDir();
        $imageDir = public_path().'/'.$dbDir;
        $result = $file->move($imageDir,$img_name);
        if (! is_object($result)) {
            return ['state'=>6000,'message'=>'上传失败！',];
        } else {
            if ($size) {
                $thumb =  self::makeThumb($imageDir.'/'.$img_name,$imageDir,$size,$mimeType,$img_name);
                return ['state'=>0000,'message'=>'上传成功！','data'=>['imageName'=>$dbDir.'/'.$img_name,'thumb'=>$dbDir.'/'.$thumb]];
            }
            return ['state'=>0000,'message'=>'上传成功！','data'=>['imageName'=>$img_name]];
        }


    }
    public static function makeThumb($src,$path,$size,$mimeType,$thumb_name)
    {
        //判断原图是否存在
        if (!file_exists($src)) {
           return ['code'=>2000,'error'=>'参数错误'];
        }

        list($thumb_width,$thumb_height) = $size;
        //打开原图资源
        //获取能够使用的后缀
        $ext = $mimeType; //gif
        //拼凑函数名
        $open = 'imagecreatefrom' . $ext;    //imagecreatefromgif
        $save = 'image' . $ext;          //imagegif
        //如果不清楚；echo $open,$save;exit;
        //可变函数打开原图资源
        $src_img = $open($src); //利用可变函数打开图片资源
        //imagecreatefromgif($src)
        //缩略图资源
        $dst_img = imagecreatetruecolor($thumb_width,$thumb_height);
        //背景色填充白色
        $dst_bg_color = imagecolorallocate($dst_img,255,255,255);
        imagefill($dst_img,0,0,$dst_bg_color);
        //宽高比确定宽高
        $dst_size = $thumb_width / $thumb_height;
        //获取原图数据
        $file_info = getimagesize($src);
        $src_size = $file_info[0]/$file_info[1];
        //求出缩略图宽和高
        if ($src_size > $dst_size) {
            //原图宽高比大于缩略图
            $width = $thumb_width;
            $height = round($width / $src_size);
        } else {
            $height = $thumb_height;
            $width = round($height * $src_size);
        }
        //求出缩略图起始位置
        $dst_x = round($thumb_width - $width)/2;
        $dst_y = round($thumb_height - $height)/2;
        //制作缩略图
        if (imagecopyresampled($dst_img,$src_img,$dst_x,$dst_y,0,0,$width,$height,$file_info[0],$file_info[1])) {
            //采样成功：保存，将文件保存到对应的路径下
            $thumb_name = $thumb_name ? basename($thumb_name,'.'.$ext).'_'.$width.'_'.$height.'.'.$ext :'thumb_' . basename($src);
            $save($dst_img,$path . '/' . $thumb_name);
            //保存成功
            return $thumb_name;
        } else {
            //采样失败
            return ['code'=>3000,'error'=>'缩略图采样失败！'];
        }
    }


}