<?php
@include("../../inc/header.php");

/*
		SoftName : EmpireBak
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

E_D("DROP TABLE IF EXISTS `phome_enewsuserloginck`;");
E_C("CREATE TABLE `phome_enewsuserloginck` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `andauth` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `phome_enewsuserloginck` values('1','25b84689cc451b4c479be1720f6ff367');");

@include("../../inc/footer.php");
?>