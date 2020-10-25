<?php
// ------------------------------------------------------------------------- //
//                  Module xentCPanExt pour Xoops 2.0.7                    //
//                              Version:  1.0                                //
// ------------------------------------------------------------------------- //
// Author: M4d3L                                        				     //
// Purpose: WHM/Cpanel Extention                          				     //
// email: info@site3web.net		                                             //
// URLs:                      												 //
//---------------------------------------------------------------------------//
global $xoopsModuleConfig;
$modversion['name'] = _MI_CPE_NAME;
$modversion['version'] = '1.0';
$modversion['description'] = _MI_CPE_DESC;
$modversion['credits'] = '';
$modversion['author'] = 'Ecrit pour Xoops2<br>par Mathieu Delisle (M4d3L)';
$modversion['license'] = '';
$modversion['official'] = 0;
$modversion['image'] = 'images/xent_cpe_slogo.png';
$modversion['help'] = '';
$modversion['dirname'] = 'xentcpanext';

// MYSQL FILE
//$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file
//If you hack this modules, dont change the order of the table.
//All
//$modversion['tables'][0] = "xent_cm_cat";

//$modversion['onInstall'] = 'include/functions.php';
$modversion['templates'][1]['file'] = 'xentcpanext_index.html';
$modversion['templates'][1]['description'] = '';

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 1;
/*$modversion['sub'][1]['name'] = _MI_EV_SMNAME1;
$modversion['sub'][1]['url'] = "emplois.php";
$modversion['sub'][2]['name'] = _MI_EV_SMNAME2;
$modversion['sub'][2]['url'] = "temoignage.php"; */

// Blocks
/*$modversion['blocks'][1]['file'] = "user_rents.php";
$modversion['blocks'][1]['name'] = _MI_CM_BLOCKS_USERRES_TITLE;
$modversion['blocks'][1]['description'] = _MI_CM_BLOCKS_USERRES_DESC;
$modversion['blocks'][1]['show_func'] = "user_rents_show";
$modversion['blocks'][1]['template'] = "xentcdmanager_user_rents.html";*/

//CONFIG
$modversion['config'][1]['name'] = 'accesshash';
$modversion['config'][1]['title'] = '_MI_CPE_CONFIG_AHASH';
$modversion['config'][1]['description'] = '_MI_CPE_CONFIG_AHASH_DESC';
$modversion['config'][1]['formtype'] = 'textarea';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = '';

$modversion['config'][2]['name'] = 'serverhost';
$modversion['config'][2]['title'] = '_MI_CPE_CONFIG_HOST';
$modversion['config'][2]['description'] = '_MI_CPE_CONFIG_HOST_DESC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = '';
