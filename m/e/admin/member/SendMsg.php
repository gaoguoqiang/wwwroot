<?php
define('EmpireCMSAdmin','1');
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../class/functions.php");
require("../../member/class/user.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;
//��֤�û�
$lur=is_login();
$logininid=$lur['userid'];
$loginin=$lur['username'];
$loginrnd=$lur['rnd'];
$loginlevel=$lur['groupid'];
$loginadminstyleid=$lur['adminstyleid'];
//ehash
$ecms_hashur=hReturnEcmsHashStrAll();
//��֤Ȩ��
CheckLevel($logininid,$loginin,$classid,"msg");
$enews=$_POST['enews'];
if($enews)
{
	hCheckEcmsRHash();
}
if($enews=="SendMsg")
{
	include("../../class/com_functions.php");
	include "../".LoadLang("pub/fun.php");
	DoSendMsg($_POST,0,$logininid,$loginin);
}
$groupid=(int)$_GET['groupid'];
//----------��Ա��
$sql=$empire->query("select groupid,groupname from {$dbtbpre}enewsmembergroup order by level");
while($level_r=$empire->fetch($sql))
{
	if($groupid==$level_r[groupid])
	{$select=" selected";}
	else
	{$select="";}
	$membergroup.="<option value=".$level_r[groupid].$select.">".$level_r[groupname]."</option>";
}
db_close();
$empire=null;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����վ�ڶ���Ϣ</title>
<link href="../adminstyle/<?=$loginadminstyleid?>/adminstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td>λ��: <a href="SendMsg.php<?=$ecms_hashur['whehref']?>">����վ�ڶ���Ϣ</a></td>
  </tr>
</table>
<form name="sendform" method="post" action="SendMsg.php" onsubmit="return confirm('ȷ��Ҫ����?');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="tableborder">
  <?=$ecms_hashur['form']?>
    <tr class="header"> 
      <td height="25" colspan="2"><div align="center">����վ�ڶ���Ϣ 
          <input name="enews" type="hidden" id="enews" value="SendMsg">
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ջ�Ա��</td>
      <td bgcolor="#FFFFFF"> <select name="groupid[]" size="5" multiple id="groupid[]">
          <?=$membergroup?>
        </select> <font color="#666666">(ȫѡ��&quot;CTRL+A&quot;,ѡ������CTRL/SHIFT+���ѡ��)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">���ջ�Ա�û���</td>
      <td bgcolor="#FFFFFF"><input name="username" type="text" id="username" size="60">
        <font color="#666666">(����û�����|������)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">ÿ�鷢�͸���</td>
      <td bgcolor="#FFFFFF"><input name="line" type="text" id="line" value="300" size="8"> 
      </td>
    </tr>
    <tr> 
      <td width="23%" height="25" bgcolor="#FFFFFF">����</td>
      <td width="77%" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="60"></td>
    </tr>
    <tr> 
      <td height="25" valign="top" bgcolor="#FFFFFF"> <div align="left">����<br>
          (֧��html����)</div></td>
      <td bgcolor="#FFFFFF"><textarea name="msgtext" cols="60" rows="16" id="msgtext"></textarea></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="left"></div></td>
      <td bgcolor="#FFFFFF"><input type="submit" name="Submit" value="����"> <input type="reset" name="Submit2" value="����"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF">�����ڱ�����������ʹ�ã�[!--username--]�����û���</td>
    </tr>
  </table>
</form>
</body>
</html>