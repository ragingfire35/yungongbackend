<?php
include_once('35fax/cls_nusoap.php');
$soap = new nusoap_client("http://202.22.252.221/servlet/services/SmsService");
$soap->soap_defencoding = "GBK";
$soap->decode_utf8 = false;
echo 'eee';
$UserID='35001211';
$Password='0000010';
$str=getSendSmsXMLstr($UserID,$Password,'13918752992','�������ҵĲ��Զ���,�����ؽ��');  //���ҳ��ʱutf8����Ҫת����gbk�ַ�
$params=array('arg0'=>$str);
$soap->call("SendSmsToServer",$params,'http://axis2.fax.uniproud.com');
$responseData=$soap->responseData;
//print_r($soap); echo '<br>---------<br>';
//����ErrorFlag�Ľ��
$result=substr($responseData,strpos($responseData,'&lt;ErrorFlag>')+14,strpos($responseData,'&lt;/ErrorFlag>')-strpos($responseData,'&lt;ErrorFlag>')-14);
print_r($result);
exit;


//��ȡ���Ͷ�����Ϣ��
function getSendSmsXMLstr($UserID,$Password,$mobile,$message)
{
	$ss='';
	$ss .= "<?xml version=\"1.0\" encoding=\"gb2312\"?>";
	$ss .= "<SmsInfo>";
	$ss .= "<Login>";
	$ss .= "<UserID>$UserID</UserID>";//�û���
	$ss .= "<Password>$Password</Password>";//����
	$ss .= "</Login>";
	$ss .= "<SendTaskList>";
	$ss .= "<SendTask>";
	$ss .= "<ClientTaskID>1</ClientTaskID>";//int�ͣ���ѯ�嵥�ӿ��ж���ϵͳ�᷵�ش��ֶΣ�����ϵͳ��Ч��Ψһ��
	$ss .= "<SmsNumber>$mobile</SmsNumber>";//���ź���.
	$ss .= "</SendTask>";
	$ss .= "</SendTaskList>";
	$ss .= "<SmsOptions>";
	$ss .= "<Priority>1</Priority>";//Priority ���ȼ�.1-��,2-�� ���Ǳ����ϵͳĬ�� 1��
	$ss .= "<Content>$message</Content>";//��������
	$ss .= "</SmsOptions>";
	$ss .= "</SmsInfo>";

	return $ss;
}
?>