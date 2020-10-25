<?php

include 'header.php';
require XOOPS_ROOT_PATH . '/header.php';
//require_once __DIR__ . '/include/functions.php';
require_once XOOPS_ROOT_PATH . '/class/module.errorhandler.php';
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    require __DIR__ . '//usr/local/cpanel/Cpanel/Accounting.php.inc';
$host = 'localhost';
$user = 'odesia';
$accesshash = 'd82938326652bec7ec56d8205a31f44a
89e4864adaa518845d0d77f27c38bc24
326cff4982c1286848a1790acdcd8d67
cfafef99b5d96f9d665cd693e1aa0292
c39d2c42d808248db407c233bf1777dd
a1d9f7e0252bc6757eb30dd3fc691cbe
320b512dad5c59763931c8cae128b763
7e383816373e335ea12d8ebbc7f85da6
c1746d43e85c477d30dd3e8fd4ff90fc
aae81a67e22311ab7e02805f071591ba
77a1debe1b1119560a01928e8bfa70c0
c9e0ef21d66f1a79b8e5a685651ed20f
e6029621f27e5b2c655c449ca549e369
b90592edda863d61e0a8d902cecda19b
5ad1097490f986dd6614a5e4ed7581d0
0f64614241b6107c824a6556adf3ae4f
e4140a1549f52154e33b6a808006c3bb
98d02492ff316d9324a279fad63c222d
8db68b860ff183f2840e6427c3e45174
cea1ce3da08d42d7432b1a85daf451a5
07712406f1378196fb114fc832a71d45
4fc3f1e443de5c29c99fb2da67d3e414
0e2a91a6f12bd9ea8daa03f5ce483696
21904d0676dd1ce11384d3f8e6debc82
f954e5657d622e84394195e4618836c8
481bcca73cfcfb50cc1385792c22b4f2
3988bfc5d9e13a955842efd330cf6f42
2223e62bf39749a601f8fcacff0cfbfa
2834ac6665a123fc0612ac7f9cca23e8
';

$accts = listaccts($host, $user, $accesshash, 0);

print_r($accts);
$pkgs = listpkgs($host, $user, $accesshash, 0);
$pkgs2 = $pkgs['Ftp account'];
echo '<br>';
echo '<br>test';
print_r($pkgs2);
echo '<br>test';
echo '<br>';
print_r($pkgs);
echo '<br>';
$GLOBALS['xoopsOption']['template_main'] = 'xentcpanext_index.html';

    /*global $xoopsDB, $xoopsTpl, $xoopsModule, $xoopsModuleConfig;


    $postuler = new XoopsThemeForm(_MI_XENT_CR_FORMAPPLY, "postuler", "jobapply.php");
    $postuler->setExtra( "enctype='multipart/form-data'" ); //de xoops-doc
    $postuler->addElement(new XoopsFormHidden("job_id", $job_id));
    $postuler->addElement(new XoopsFormHidden("op", "sendapply"));

    $postuler->addElement(new XoopsFormHidden("titres", $titres));

    $postuler->addElement(new xoopsFormHidden("job_id", $job_id));
    $postuler->addElement(new xoopsFormText ("* "._MI_XENT_CR_POSTPRENOM ,"prenom", 40, 255, $prenom), true);
    $postuler->addElement(new xoopsFormText ("* "._MI_XENT_CR_POSTNOM ,"nom", 40, 255, $nom), true);
    $postuler->addElement(new xoopsFormText ("* "._MI_XENT_CR_EMAIL ,"email", 40, 255, $email), true);
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_ADDRESS ,"address", 40, 255, $address));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_VILLE ,"ville", 40, 255, $ville));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_PROVINCE ,"province", 40, 255, "Quebec"));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_PAYS ,"pays", 40, 255, "Canada"));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_ZIPCODE ,"zipcode", 10, 7, $zipcode));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_TELHOME ,"telhome", 16, 21, $telhome));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_TELCELL ,"telcell", 16, 21, $telcell));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_TELAUTRE ,"telautre", 16, 21, $telautre));

    $postuler->addElement(new xoopsFormLabel ("<br><hr><br>","<br><hr><br>"));

    $cv_box = new XoopsFormFile("* "._MI_XENT_CR_CVFULL, "cv", 50000);
    $postuler->addElement($cv_box, true);

    $postuler->addElement(new xoopsFormLabel ("<br>","<br>"));

    $rec_box = new XoopsFormFile(_MI_XENT_CR_RECFULL, "rec", 50000);
    $postuler->addElement($rec_box, false);

    $postuler->addElement(new xoopsFormLabel ("<br><hr><br>","<br><hr><br>"));

    $thearray = GetTopic("xent_cr_reference", "reference_job", "id");
    $object = new xoopsFormSelect(_MI_XENT_CR_WHEREODESIA,"heardodesia",$heardodesia,1,false);
    $object->addOptionArray($thearray);
    $postuler->addElement($object);

    $postuler->addElement(new xoopsFormLabel ("<br><hr>","<br><hr>"));
    $postuler->addElement( new xoopsFormLabel("",_MI_XENT_CR_RECOMMANDFULL) );
    $postuler->addElement( new xoopsFormLabel("<br>","<br>"));

    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_POSTNOMPRENOM ,"nomress", 40, 255, $nomress));
    $postuler->addElement(new xoopsFormText (_MI_XENT_CR_EMAIL ,"emailress", 40, 255, $emailress));

    $button_tray = new XoopsFormElementTray('' ,'');
    $button_tray->addElement(new XoopsFormButton('', 'submit', _MI_XENT_CR_POSTULER, 'submit'));
    $postuler->addElement($button_tray);
    $postuler->assign($xoopsTpl);
    */
    include 'footer.php';
