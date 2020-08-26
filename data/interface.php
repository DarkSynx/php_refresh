<?php

/*******************************************************************************

WINBINDER - form editor PHP file (generated automatically)

*******************************************************************************/

// Control identifiers

if(!defined('IDC_LISTBOX1001')) define('IDC_LISTBOX1001', 1001);
if(!defined('IDC_PUSHBUTTON1002')) define('IDC_PUSHBUTTON1002', 1002);
if(!defined('IDC_PUSHBUTTON1003')) define('IDC_PUSHBUTTON1003', 1003);
if(!defined('IDC_EDITBOX1004')) define('IDC_EDITBOX1004', 1004);

// Create window

$winmain = wb_create_window(null, AppWindow, '', WBC_CENTER, WBC_CENTER, 199, 297, 0x00000000, 0);

// Insert controls

$list = wb_create_control($winmain, ListBox, 'Item1,Item2,Item3', 10, 30, 165, 180, IDC_LISTBOX1001, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, 'Start', 10, 220, 55, 25, IDC_PUSHBUTTON1002, 0x00000000, 0, 0);
wb_create_control($winmain, PushButton, 'Stop', 120, 220, 55, 25, IDC_PUSHBUTTON1003, 0x00000000, 0, 0);
$edbx = wb_create_control($winmain, EditBox, '.\test', 10, 5, 165, 20, IDC_EDITBOX1004, 0x00000000, 0, 0);

// End controls

?>