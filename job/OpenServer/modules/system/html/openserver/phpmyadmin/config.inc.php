<?php
#
# ВНИМАНИЕ! Это временный файл, его редактирование бессмысленно!
#
?>
<?php
$cfg['Servers'][1]['verbose'] = '';
$cfg['Servers'][1]['host'] = '127.0.0.1';
$cfg['Servers'][1]['port'] = 3306;
$cfg['Servers'][1]['socket'] = '';
$cfg['Servers'][1]['connect_type'] = 'tcp';
$cfg['Servers'][1]['compress'] = false;
$cfg['Servers'][1]['extension'] = 'mysqli';
//$cfg['Servers'][1]['auth_type'] = 'cookie';
$cfg['Servers'][1]['auth_type'] = 'config';
$cfg['Servers'][1]['user'] = 'root';
$cfg['Servers'][1]['password'] = '%mysqlrootpass%';
$cfg['Servers'][1]['AllowRoot'] = true;
$cfg['Servers'][1]['nopassword'] = true;
$cfg['Servers'][1]['AllowNoPassword'] = true;
$cfg['ActionLinksMode'] = 'icons';
$cfg['AjaxEnable'] = true;
$cfg['blowfish_secret'] = 'r3a30e4ed1cfbfdds22379';
$cfg['MaxRows'] = 50;
$cfg['ServerDefault'] = 1;
$cfg['ServerLibraryDifference_DisableWarning'] = true;
$cfg['ShowAll'] = true;
$cfg['SaveDir'] = 'd:/job/openserver/userdata/temp';
$cfg['TempDir'] = 'd:/job/openserver/userdata/temp';
$cfg['UploadDir'] = 'd:/job/openserver/userdata/temp';
$cfg['VersionCheck'] = false;
$cfg['TabsMode'] = 'both';
$cfg['TableNavigationLinksMode'] = 'icons';
$cfg['ThemeDefault']= 'original';
#$cfg['ThemeManager'] = false;
/**
* disallow editing of binary fields
* valid values are:
*   false    allow editing
*   'blob'   allow editing except for BLOB fields
*   'noblob' disallow editing except for BLOB fields
*   'all'    disallow editing
* default = blob
*/
//$cfg['ProtectBinary'] = 'false';
$cfg['DefaultLang'] = 'ru';
/**
* default display direction (horizontal|vertical|horizontalflipped)
*/
$cfg['DefaultDisplay']      = 'horizontal';
/**
* How many columns should be used for table display of a database?
* (a value larger than 1 results in some information being hidden)
* default = 1
*/
//$cfg['PropertiesNumColumns'] = 2;
$cfg['PmaNoRelation_DisableWarning'] = true;
?>
