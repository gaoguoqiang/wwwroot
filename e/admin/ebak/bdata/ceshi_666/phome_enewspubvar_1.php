<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewspubvar`;");
E_C("CREATE TABLE `phome_enewspubvar` (
  `varid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `myvar` varchar(60) NOT NULL DEFAULT '',
  `varname` varchar(20) NOT NULL DEFAULT '',
  `varvalue` text NOT NULL,
  `varsay` varchar(255) NOT NULL DEFAULT '',
  `myorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `classid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tocache` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`varid`),
  UNIQUE KEY `varname` (`varname`),
  KEY `classid` (`classid`),
  KEY `tocache` (`tocache`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewspubvar` values('1','sitetitle','��վ���','����ͷ��','��վ���','0','0','1');");
E_D("replace into `phome_enewspubvar` values('2','siteurl','��ַ��ַ','http://ceshi.codes99.com/','��http:// , ��ߴ�б�� /','0','0','1');");
E_D("replace into `phome_enewspubvar` values('3','beian','������','���������� 11010802020116��','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('4','jubao','�ٱ�����','xxx@xxx.com','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('5','tj','ͳ�ƴ���','ͳ�ƴ��������','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('6','wapurl','�ֻ����ַ','http://m.ceshi.codes99.com','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('7','ftitle','������','����ĵģ�����ͷ����','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('8','shorturl','����http://�Ķ�����','ceshi.codes99.com','ǰ�߲���http://����߲���б��','0','0','1');");
E_D("replace into `phome_enewspubvar` values('11','changyanid','����conf ID','prod_8d01521f822b32f1a30f058371f6eeef','','0','0','1');");
E_D("replace into `phome_enewspubvar` values('12','changyan_client_id','����client_id','cys3T11v7','','0','0','1');");

@include("../../inc/footer.php");
?>