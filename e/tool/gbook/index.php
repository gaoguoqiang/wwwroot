<?php
require("../../class/connect.php");
if(!defined('InEmpireCMS'))
{
	exit();
}
require("../../class/db_sql.php");
require("../../class/q_functions.php");
require "../".LoadLang("pub/fun.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//����id
$bid=(int)$_GET['bid'];
$gbr=$empire->fetch1("select bid,bname,groupid from {$dbtbpre}enewsgbookclass where bid='$bid'");
if(empty($gbr['bid']))
{
	printerror("EmptyGbook","",1);
}
//Ȩ��
if($gbr['groupid'])
{
	include("../../member/class/user.php");
	$user=islogin();
	include("../../data/dbcache/MemberLevel.php");
	if($level_r[$gbr[groupid]][level]>$level_r[$user[groupid]][level])
	{
		echo"<script>alert('���Ļ�Ա������(".$level_r[$gbr[groupid]][groupname].")��û��Ȩ���ύ��Ϣ!');history.go(-1);</script>";
		exit();
	}
}
esetcookie("gbookbid",$bid,0);
$bname=$gbr['bname'];
$search="&bid=$bid";
$page=(int)$_GET['page'];
$page=RepPIntvar($page);
$start=0;
$line=$public_r['gb_num'];//ÿҳ��ʾ����
$page_line=10;//ÿҳ��ʾ������
$offset=$start+$page*$line;//��ƫ����
$totalnum=(int)$_GET['totalnum'];
if($totalnum>0)
{
	$num=$totalnum;
}
else
{
	$totalquery="select count(*) as total from {$dbtbpre}enewsgbook where bid='$bid' and checked=0";
	$num=$empire->gettotal($totalquery);//ȡ��������
}
$search.="&totalnum=$num";
$query="select lyid,name,email,`mycall`,lytime,lytext,retext from {$dbtbpre}enewsgbook where bid='$bid' and checked=0";
$query=$query." order by lyid desc limit $offset,$line";
$sql=$empire->query($query);
$listpage=page1($num,$line,$page_line,$start,$page,$search);
$url="<a href='".ReturnSiteIndexUrl()."'>".$fun_r['index']."</a>&nbsp;>&nbsp;".$fun_r['saygbook'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>���԰� - Powered by EmpireCMS</title>
<meta name="keywords" content="<?=$bname?>" />
<meta name="description" content="<?=$bname?>" />
<link href="/skin/default/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/skin/default/js/tabs.js"></script>
</head>
<body class="listpage">
<!-- ҳͷ -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="top">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="63%">
<!-- ��¼ -->
<script>
document.write('<script src="/e/member/login/loginjs.php?t='+Math.random()+'"><'+'/script>');
</script>
</td>
<td align="right">
<a onclick="window.external.addFavorite(location.href,document.title)" href="#ecms">�����ղ�</a> | <a onclick="this.style.behavior='url(#default#homepage)';this.setHomePage('/')" href="#ecms">��Ϊ��ҳ</a> | <a href="/e/member/cp/">��Ա����</a> | <a href="/e/DoInfo/">��ҪͶ��</a> | <a href="/e/web/?type=rss2" target="_blank">RSS<img src="/skin/default/images/rss.gif" border="0" hspace="2" /></a>
</td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="10">
<tr valign="middle">
<td width="240" align="center"><a href="/"><img src="/skin/default/images/logo.gif" width="200" height="65" border="0" /></a></td>
<td align="center"><a href="http://www.phome.net/OpenSource/" target="_blank"><img src="/skin/default/images/opensource.gif" width="100%" height="70" border="0" /></a></td>
</tr>
</table>
<!-- ����tabѡ� -->
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="nav">
  <tr> 
    <td class="nav_global"><ul>
        <li class="curr" id="tabnav_btn_0" onmouseover="tabit(this)"><a href="/">��ҳ</a></li>
        <li id="tabnav_btn_1" onmouseover="tabit(this)"><a href="/news/">��������</a></li>
        <li id="tabnav_btn_2" onmouseover="tabit(this)"><a href="/download/">��������</a></li>
        <li id="tabnav_btn_3" onmouseover="tabit(this)"><a href="/movie/">Ӱ��Ƶ��</a></li>
        <li id="tabnav_btn_4" onmouseover="tabit(this)"><a href="/shop/">�����̳�</a></li>
        <li id="tabnav_btn_5" onmouseover="tabit(this)"><a href="/flash/">FLASHƵ��</a></li>
        <li id="tabnav_btn_6" onmouseover="tabit(this)"><a href="/photo/">ͼƬƵ��</a></li>
        <li id="tabnav_btn_7" onmouseover="tabit(this)"><a href="/article/">��������</a></li>
        <li id="tabnav_btn_8" onmouseover="tabit(this)"><a href="/info/">������Ϣ</a></li>
      </ul></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="10" cellpadding="0">
<tr valign="top">
<td class="list_content"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="position">
<tr>
<td>���ڵ�λ�ã�<a href=../../../>��ҳ</a>&nbsp;>&nbsp;<?=$bname?>
</td>
</tr>
</table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="box">
	<tr>
		<td><table width="100%" border="0" cellpadding="3" cellspacing="2">
			<tr>
				<td align="center" bgcolor="#E1EFFB"><strong><?=$bname?></strong></td>
			</tr>
			<tr>
				<td align="left" valign="top"><table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF">
						<tr>
							<td height="100%" valign="top" bgcolor="#FFFFFF"> 
<?
while($r=$empire->fetch($sql))
{
	$r['retext']=nl2br($r[retext]);
	$r['lytext']=nl2br($r[lytext]);
?>

								<table width="92%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#F4F9FD" class="tableborder">
										<tr class="header">
											<td width="55%" height="23">������: <?=$r[name]?> </td>
											<td width="45%">����ʱ��: <?=$r[lytime]?> </td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td height="23" colspan="2"><table border="0" width="100%" cellspacing="1" cellpadding="8" bgcolor='#cccccc'>
													<tr>
														<td width='100%' bgcolor='#FFFFFF' style='word-break:break-all'> <?=$r[lytext]?> </td>
													</tr>
												</table>
												
<?
if($r[retext])
{
?>

												<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
													<tr>
														<td><img src="../../data/images/regb.gif" width="18" height="18" /><strong><font color="#FF0000">�ظ�:</font></strong> <?=$r[retext]?> </td>
													</tr>
												</table>
												
<?
}
?> </td>
										</tr>
									</table>
								<br />
								
<?
}
?>

								<table width="92%" border="0" align="center" cellpadding="4" cellspacing="1">
									<tr>
										<td>��ҳ: <?=$listpage?></td>
									</tr>
								</table>
								<form action="../../enews/index.php" method="post" name="form1" id="form1">
									<table width="92%" border="0" align="center" cellpadding="4" cellspacing="1"class="tableborder">
										<tr class="header">
											<td colspan="2" bgcolor="#F4F9FD"><strong>��������:</strong></td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td width="20%">����:</td>
											<td width="722" height="23"><input name="name" type="text" id="name" />
												*</td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td>��ϵ����:</td>
											<td height="23"><input name="email" type="text" id="email" />
												*</td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td>��ϵ�绰:</td>
											<td height="23"><input name="mycall" type="text" id="mycall" /></td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td>��������(*):</td>
											<td height="23"><textarea name="lytext" cols="60" rows="12" id="lytext"></textarea></td>
										</tr>
										<tr bgcolor="#FFFFFF">
											<td height="23">&nbsp;</td>
											<td height="23"><input type="submit" name="Submit3" value="�ύ" />
											<input type="reset" name="Submit22" value="����" />
											<input name="enews" type="hidden" id="enews" value="AddGbook" /></td>
										</tr>
									</table>
								</form></td>
						</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
</table></td>
</tr>
</table>
<div id="pagelet-company">
				  <div class="company" id="toutiaoCompanyWrapper">
					<span class="J-company-name">&#169; 2016 <?=$public_r['add_sitetitle']?> <?=$public_r['add_siteurl']?></span>
					<a href="http://www.12377.cn/" target="_blank" ga_event="click_about">�й��������ٱ�����</a>
					<a href="http://www.miibeian.gov.cn/" target="_blank" ga_event="click_about"><?=$public_r['add_beian']?></a>
					<a href="/license/" class="icp" target="_blank">�����Ļ���Ӫ����֤</a>
					<a href="/chengnuoshu/" target="_blank">�����������ɹ�����ŵ�� </a>
					<span>Υ���Ͳ�����Ϣ�ٱ���<?=$public_r['add_jubao']?></span>
					<span style="display:none"><?=$public_r['add_tj']?> </span>
					
				  </div>

				  
				</div>
<link type="text/css" rel="stylesheet" href="/style/loginbox.css">
<div id="bgDiv" style="display:none;"></div> 

<script type="text/javascript">
var IsMousedown,LEFT,TOP,lggood;
	document.getElementById("Mdown").onmousedown=function(e){

	lggood = document.getElementById("lggoodBox");
	IsMousedown = true;
	e = e||event;
	LEFT = e.clientX - parseInt(lggood.style.left);
	TOP = e.clientY - parseInt(lggood.style.top);
	document.onmousemove = function(e){
		e = e||event;
		if (IsMousedown){
			lggood.style.left = e.clientX - LEFT + "px";
			lggood.style.top = e.clientY - TOP + "px";
		}

	}
	document.onmouseup=function(){
		IsMousedown=false;
	}

}
$(function(){
  $('#loginboxbtn').click(function(){
        $('#bgDiv,#lggoodBox').show();
   });
   
})
</SCRIPT>

</body>
</html>
<?php
db_close();
$empire=null;
?>