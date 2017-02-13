<?php
return [
   'mapAk' =>env('BAIDUAK',''),
   'nav'=>[
      ['name'=>'店铺','children'=>[['name'=>'店铺列表','url'=>'/store/list']],'url'=>'/store'],
      ['name'=>'入库','children'=>[],'url'=>'/stock/create'],
      ['name'=>'库存','children'=>[],'url'=>'/stock'],
      ['name'=>'出存','children'=>[],'url'=>''],
      ['name'=>'流水','children'=>[],'url'=>''],
   ]

];