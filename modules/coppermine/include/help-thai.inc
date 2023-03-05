<?php 
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.2.0 phpnuke RC4                               //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002,2003  Gr้gory DEMAR <gdemar@wanadoo.fr>               //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                        //
// (http://coppermine.sf.net/team/)                                          //
// see /docs/credits.html for details                                        //
// ------------------------------------------------------------------------- //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
// Thai translation By: CenturY  (century_100@hotmail.com )              //'
// http://mem9.dochost.net  , http://members.lycos.co.uk/century001   //                         
//---------------------------------------------------------------------------//
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
define("GTDOC_ADMIN_SUMMARY", '<blockquote>เอกสารประกอบนี้ มีเพื่อช่วยเหลือคุณในการใช้งานชุดคำสั่งของ <i> Coppermine </i>   คุณจะเห็นข้อความในหน้าจอนี้แตกต่างกัน  ขึ้นอยู่กับว่า คุณเข้าสู่ระบบในฐานะผู้ดูแล สมาชิก หรือผู้ไม่ประสงค์ออกนาม  ถ้าหากคุณมีคำถามไม่พบคำตอบในเอกสารนี้  กรุณาตรวจสอบเพิ่มเติมจากไฟล์ FAQ ที่ติดมากับแพกเกจนี้ และกระดานข่าวที่ <a  href="http://coppermine.sourceforge.net/board/search.php">coppermine.sourceforge.net</a><br> ในการที่จะให้การแสดงผลของเอกสารนี้ เป็นไปตามที่คุณต้องการ คุณสามารถแก้ไขไฟล์ css ซึ่งอยู่ใน modules/copperermine/docs/styles.css .</blockquote>');
define("GTDOC_USER_SUMMARY", '<blockquote>โปรแกรมที่ใช้แสดงภาพที่เวบไซต์นี้คือ  <i> Coppermine </i> เอกสารประกอบนี้ มีเพื่อช่วยเหลือคุณในการใช้งานชุดคำสั่งในการจัดการภาพของเวบไซต์นี้ </blockquote>');
define("GTDOC_ANON_SUMMARY", '<blockquote>โปรแกรมที่ใช้แสดงภาพที่เวบไซต์นี้คือ <i> Coppermine </i> เอกสารประกอบนี้ มีเพื่อช่วยเหลือคุณในการใช้งานชุดคำสั่งในการจัดการภาพของเวบไซต์นี้  กรุณา <a href="modules.php?name=Your_Account"> เข้าสู่ระบบ </a> หรือ <a href="modules.php?name=Your_Account&op=new_user"> สมัครสมาชิก </a> เพื่อสามารถดูรายละเอียดได้มากกว่านี้</blockquote>');
define("GTDOC_OVERVIEW_TITLE", 'หมวดหมู่ อัลบั้ม และรูปภาพ');
define("GTDOC_SITEADM_OVERVIEW_DESC", 'ชุดคำสั่งจะทำงานในกรณี :<br /><ul><li> ภาพถูกเก็บอยู่ในอัลบั้ม </li><li> อัลบั้มอาจจะถูกจัดอยู่ในหมวดหมู่ </li><li> สามารถสร้างหมวดหมู่ย่อยได้ </li></ul><p> ถ้าหากคุณมีอัลบั้มไม่มาก  ก็ไม่จำเป็นต้องสร้างหมวดหมู่  กรณีที่คุณไม่ได้สร้างหมวดหมู่ อัลบั้มทั้งหมดจะปรากฏให้เห็นในหน้าจอหลัก <br /> จะมีหมวดหมู่พิเศษที่เรียกว่า "<strong>อัลบั้มผู้ใช้</strong>" ซึ่งจะไม่สามารถลบหมวดหมู่นี้ได้  ถ้าหากผู้ใช้เป็นสมาชิกของกลุ่มที่ "สามารถมีแกลอรีส่วนตัว" เขามีสิทธิ์ที่จะสร้างอัลบั้มของเขาเอง  และแกลอรีของเขาจะอยู่ภายใต้หมวดหมู่ย่อย  "อัลบั้มผู้ใช้" <br /> ผู้ดูแลระบบสามารถสร้างอัลบั้มในหมวดหมู่ใดก็ได้ คุณจะต้องเข้าสู่ระบบในนามผู้ใช้เพื่อที่จะทำการส่งรูปได้ ผู้ใช้ปกติสามารถสร้างอัลบั้มใน  "อัลบั้มผู้ใช้/ชื่อผู้ใช้" เท่านั้น <br />');
define("GTDOC_ADM_OVERVIEW_DESC", '<p>ชุดคำสั่งจะทำงานในกรณี :<br /><ul><li> ภาพถูกเก็บอยู่ในอัลบั้ม </li><li> อัลบั้มอาจจะถูกจัดอยู่ในหมวดหมู่ </li><li>  สามารถสร้างหมวดหมู่ย่อยได้  </li></ul><p> ถ้าหากคุณมีอัลบั้มไม่มาก  ก็ไม่จำเป็นต้องสร้างหมวดหมู่  กรณีที่คุณไม่ได้สร้างหมวดหมู่ อัลบั้มทั้งหมดจะปรากฏให้เห็นในหน้าจอหลัก  <br /> จะมีหมวดหมู่พิเศษที่เรียกว่า "<strong>อัลบั้มผู้ใช้</strong>" ซึ่งจะไม่สามารถลบหมวดหมู่นี้ได้  ถ้าหากผู้ใช้เป็นสมาชิกของกลุ่มที่ "สามารถมีแกลอรีส่วนตัว" เขามีสิทธิ์ที่จะสร้างอัลบั้มของเขาเอง  และแกลอรีของเขาจะอยู่ภายใต้หมวดหมู่ย่อย  "อัลบั้มผู้ใช้" <br />  ผู้ดูแลระบบสามารถสร้างอัลบั้มในหมวดหมู่ใดก็ได้ คุณจะต้องเข้าสู่ระบบในนามผู้ใช้เพื่อที่จะทำการส่งรูปได้ ผู้ใช้ปกติสามารถสร้างอัลบั้มใน  "อัลบั้มผู้ใช้/ชื่อผู้ใช้" เท่านั้น <br />');
define("GTDOC_CANUP_USER_OVERVIEW_DESC", 'ส่วนของการแสดงภาพที่เวบไซต์นี้  จะแสดงในกรณี :<br /><ul><li> ภาพถูกเก็บอยู่ในอัลบั้ม </li><li> อัลบั้มอาจจะถูกจัดอยู่ในหมวดหมู่ </li><li>  สามารถสร้างหมวดหมู่ย่อยได้  </li></ul> จะมีหมวดหมู่พิเศษที่เรียกว่า "<strong>อัลบั้มผู้ใช้</strong>" หากคุณเป็นสมาชิกของกลุ่ม  "สามารถมีแกลอรีส่วนตัว" คุณมีสิทธิ์ที่จะสร้างอัลบั้มของคุณเอง  และแกลอรีของคุณจะอยู่ภายใต้หมวดหมู่ย่อย  "อัลบั้มผู้ใช้" <br />คุณอาจจะสามารถสร้างอัลบั้มภายใต้ "อัลบั้มผู้ใช้/' . $username . '"<br /> คุณสามารถ uploadไปยังแกลอรีไหนก็ได้ ขึ้นอยู่กับผู้ดูแลระบบ');
define("GTDOC_USER_OVERVIEW_DESC", '<p>ส่วนของการแสดงภาพที่เวบไซต์นี้  จะแสดงในกรณี :<br /><ul><li>ภาพถูกเก็บอยู่ในอัลบั้ม </li><li> อัลบั้มอาจจะถูกจัดอยู่ในหมวดหมู่ </li><li> สามารถสร้างหมวดหมู่ย่อยได้   </li></ul>ในฐานะสมาชิก คุณสามารถ upload ไปยังแกลอรีไหนก็ได้ ขึ้นอยู่กับผู้ดูแลระบบ');
define("GTDOC_ALBLIST_TITLE", 'รายการอัลบั้ม'); //$lang_main_menu['alb_list_title']
define("GTDOC_ALBLIST_DESC", 'ส่วนนี้จะลิงค์ไปยังหน้าจอที่จะแสดงรายการอัลบั้มทั้งหมด ซึ่งเป็นหน้าจอหลักของแกลอรี');
define("GTDOC_MY_GAL_LNK_TITLE", 'แกลอรีส่วนตัว');
define("GTDOC_MY_GAL_LNK_DESC", 'ดูแกลอรีผู้ใช้');
define("GTDOC_ADMINMODE_TITLE", 'สถานะผู้ดูแล &amp; สถานะผู้ใช้งาน');
define("GTDOC_SITEADM_ADMINMODE_DESC", 'เมื่อคุณเข้าสู่ระบบในฐานะผู้ดูแล จะมีคำสั่งให้ใช้ 2 อย่างคือ: สถานะผู้ดูแล  &amp; และ สถานะผู้ใช้ คุณสามารถสลับระหว่าง สถานะผู้ดูแล &amp; กับสถานะผู้ใช้  โดยการคลิกที่ลิงค์นั้นๆ ในส่วนบนของเมนูหลัก <br /> เมื่อคุณอยู่ในสถานะผู้ดูแล  คุณสามารถจัดการแกลอรี และใช้งานเมนูต่างๆที่ปรากฏขึ้นมา :<br />' . theme_admin_mode_menu() . '<br /> เมื่อคุณอยู่ในสถานะผู้ใช้ คุณจะเป็นเพียงผู้ใช้งานธรรมดา และไม่มีสิทธิ์เข้าหน้าจอผู้ดูแล<br />');
define("GTDOC_ADM_ADMINMODE_DESC", '<p>เมื่อคุณเข้าสู่ระบบ จะมีคำสั่งให้ใช้ 2 อย่างคือ: สถานะผู้ดูแล  &amp; และ สถานะผู้ใช้ คุณสามารถสลับระหว่าง สถานะผู้ดูแล &amp; กับสถานะผู้ใช้  โดยการคลิกที่ลิงค์นั้นๆ ในส่วนบนของเมนูหลัก <br /> เมื่อคุณอยู่ในสถานะผู้ดูแล  คุณสามารถจัดการแกลอรี และใช้งานเมนูต่างๆที่ปรากฏขึ้นมา :<br />' . theme_admin_mode_menu() . '<br /> เมื่อคุณอยู่ในสถานะผู้ใช้ คุณจะเป็นเพียงผู้ใช้งานธรรมดา และไม่มีสิทธิ์เข้าหน้าจอผู้ดูแล <br /> นอกจากนี้ คุณไม่สามารถใช้งานลิงค์การตั้งค่าเหมือนผู้ดูแลระบบ ');
define("GTDOC_USER_ADMINMODE_DESC", '<p>เมื่อคุณเข้าสู่ระบบ จะมีคำสั่งให้ใช้ 2 อย่างคือ: สถานะผู้ดูแล  &amp; และ สถานะผู้ใช้ คุณสามารถสลับระหว่าง สถานะผู้ดูแล &amp; กับสถานะผู้ใช้  โดยการคลิกที่ลิงค์นั้นๆ ในส่วนบนของเมนูหลัก <br />  เมื่อคุณอยู่ในสถานะผู้ดูแล  คุณสามารถจัดการแกลอรีส่วนตัวได้เท่านั้น <br> เมื่อคุณอยู่ในสถานะผู้ใช้ คุณจะเป็นเพียงผู้ใช้งานธรรมดา และไม่สามารถเข้าไปยังหน้าจอการจัดการแกลอรีส่วนตัว<br />');
define("GTDOC_USERUPLOAD_TITLE", 'ส่งภาพของคุณ'); // file upload.php
define("GTDOC_SITEADM_USERUPLOAD_DESC", 'ผู้ใช้หรือสมาชิกของคุณ สามารถส่งภาพไปยังกลุ่มที่เขาเป็นสมาชิกอยู่  หรือแกลอรีส่วนตัวก็ได้ ในการใช้งานความสามารถนี้ คุณจะต้องไม่เข้าสู่ระบบในฐานะผู้ดูแล แต่ให้เข้าสู่ระบบในนามของสมาชิกที่คุณสร้างขึ้นมาในขั้นตอนการติดตั้ง  phpnuke ใช้การส่งภาพต่อเนื่องในการส่งภาพหลายๆภาพ และคุณสามารถแก้ไขรายละเอียดของภาพแต่ละภาพ ที่จะปรากฏในหน้าจอการแสดงภาพ');
define("GTDOC_ADM_USERUPLOAD_DESC",  'ผู้ใช้หรือสมาชิกของคุณ สามารถ upload ภาพไปยังกลุ่มที่เขาเป็นสมาชิกอยู่  หรือแกลอรีส่วนตัวก็ได้ ในฐานะผู้ดูแล coppermine คุณสามารถส่งภาพไปยังโฟลเดอร์ไหนก็ได้  หลังจากกดลิงคส่งภาพให้เลือกแกลอรีจากรายการ กดที่ปุ่ม Browse เพื่อเลือกภาพที่คุณต้องการจะส่งจากคอมพิวเตอร์ของคุณ');
define("GTDOC_CANUG_USER_USERUPLOAD_DESC", 'ในฐานะผู้ใช้ที่ลงทะเบียนหรือสมาชิก คุณสามารถส่ง ภาพไปยังอัลบั้มที่ผู้ดูแลอนุญาต และอัลบั้มส่วนตัวได้ โดยกดที่ลิงค์ส่งภาพหลังจากที่เข้าสู่ระบบแล้ว หลังจากกดลิงค์ส่งภาพแล้ว  ให้เลือกรายการอัลบั้ม จากนั้นกดปุ่ม Browse เพื่อเลือกภาพที่คุณต้องการจากคอมพิวเตอร์ของคุณ เติมรายละเอียดที่ต้องการ แล้วกดปุ่ม "ส่งภาพ" ');
define("GTDOC_USER_USERUPLOAD_DESC",'ในฐานะผู้ใช้ที่ลงทะเบียนหรือสมาชิก คุณสามารถส่ง ภาพไปยังอัลบั้มที่ผู้ดูแลอนุญาต โดยกดที่ลิงค์ส่งภาพหลังจากที่เข้าสู่ระบบแล้ว หลังจากกดลิงค์ส่งภาพแล้ว  ให้เลือกรายการอัลบั้ม จากนั้นกดปุ่ม Browse เพื่อเลือกภาพที่คุณต้องการจากคอมพิวเตอร์ของคุณ เติมรายละเอียดที่ต้องการ แล้วกดปุ่ม "ส่งภาพ" ');
define("GTDOC_LOGIN_LNK_TITLE", 'เข้าสู่ระบบ'); // // module Your_Account
define("GTDOC_LOGIN_LNK_DESC", 'เข้าสู่ระบบเพื่อสามารถใช้งานความสามารถต่างๆในฐานะสมาชิกที่ลงทะเบียนเช่น การส่งภาพ และการส่ง ecards');
define("GTDOC_LOGOUT_LNK_TITLE", 'ออกจากระบบ'); // module Your_Account
define("GTDOC_LOGOUT_LNK_DESC", 'ออกจากระบบ เมื่อต้องการเลิกใช้งาน');
define("GTDOC_META_LNK_TITLE", 'ส่งภาพล่าสุด  วิจารณ์ล่าสุด  เข้าชมมากสุด  อันดับสูงสุด'); // album=*metaname*
define("GTDOC_META_LNK_DESC", 'ลิงค์นี้จะเชื่อมไปยัง "meta albums" ส่งภาพล่าสุด - วิจารณ์ล่าสุด - เข้าชมมากสุด-  อันดับสูงสุด อัลบั้มนี้ประกอบด้วยภาพ จากหมวดหมู่/อัลบั้มต่างๆ ณ ขณะที่คุณคลิกดูภาพ  หากไม่อยู่ในหมวดหมู่/อัลบั้ม ภาพที่แสดงจะมาจากหมวดหมู่/อัลบั้มที่มีอยู่ทั้งหมด');
define("GTDOC_SEARCH_LNK_TITLE", 'ค้นหาแกลอรี'); //file search.php
define("GTDOC_SEARCH_LNK_DESC", 'คุณสามารถค้นหาภาพโดยคลิกที่ลิงค์สำหรับการค้นหา');
define("GTDOC_FAV_LNK_TITLE", 'ภาพโปรดปราน'); //album favpics
define("GTDOC_FAV_LNK_DESC", 'เป็นอัลบั้มชั่วคราวตราบเท่าที่คุณยังเปิดรับ cookie จากเวบ โดยใช้ลิงค์ที่อยู่ใต้ภาพในการเพิ่มภาพเข้าสู่อัลบั้ม');
define("GTDOC_UPLOAD_APP_TITLE", 'ตรวจสอบการส่งภาพ'); //album favpics
define("GTDOC_UPLOAD_APP_DESC", 'คุณสามารถตรวจสอบภาพที่ส่งเข้ามาก่อนที่จะส่งเข้าไปยังอัลบั้ม');
define("GTDOC_BATCH_AD_TITLE", 'Batch add pictures'); // file searchnew.php
define("GTDOC_BATCH_AD_DESC", 'กดลิงค์นี้ เพื่อเพิ่มภาพที่คุณส่งขึ้นมาแล้วทาง ftp ไปยังอัลบั้มที่ต้องการ');
define("GTDOC_REVEIW_COM_TITLE", 'ทบทวนคำวิจารณ์'); // file reviewcom.php
define("GTDOC_REVEIW_COM_DESC", 'อ่าน แก้ไข และลบคำวิจารณ์ของภาพต่างๆ ');
define("GTDOC_BANUSERS_TITLE", 'ห้ามผู้ใช้');
define("GTDOC_BANUSERS_DESC", 'คุณสามารถห้ามการใช้งานของผู้ใช้ได้ ลิงค์นี้ จะใช้ความสามารถของ phpBB อ่านวิธีการใช้งานได้ที่นั่น');
define("GTDOC_GROUPCP_TITLE", 'ระบบจัดการกลุ่ม');
define("GTDOC_GROUPCP_DESC", 'ที่นี่คุณสามารถกำหนดได้ว่า สมาชิกในแต่ละกลุ่มสามารถ หรือไม่สามารถทำอะไรได้บ้าง <br /> การกำหนดพื้นที่ส่วนตัวจะมีผลเฉพาะกลุ่มที่  "สามารถมีแกลอรีส่วนตัว" เท่านั้น เฉพาะภาพที่ถูกส่งมามายังแกลอรีส่วนตัวเท่านั้น ที่จะถูกนับรวมในพื้นที่โควต้า  <br /> ใช้กลุ่ม  <strong>ผู้ไม่ประสงค์ออกนาม</strong> สำหรับกำหนดให้สมาชิกที่ไม่ลงทะเบียน สามารถ/ไม่สามารถ ทำอะไรได้บ้าง  โควต้าและ "สามารถมีแกลอรีส่วนตัว" จะไม่มีความหมายสำหรับผู้ไม่ประสงค์ออกนาม <br /> พึงระลึกว่า ถ้าผู้ใช้เป็นสมาชิกของกลุ่มที่  "สามารถจัดอันดับภาพ", "สามารถวิจารณ์" หรือ "สามารถส่งภาพได้" เขามีสิทธิ์ที่จะกระทำการได้ในอัลบั้มที่ได้รับอนุญาตเท่านั้น เช่น การส่งภาพ สามารถกระทำได้ในอัลบั้มที่  "ผู้มาเยือนสามารถส่งภาพได้"  <br /> ถ้าหากกำหนด "สามารถมีแกลอรีส่วนตัว"สมาชิกในกลุ่มนั้น จะสามารถมีแกลอรีของตัวเองภายใต้หมวดหมู่   "แกลอรีผู้ใช้" ซึ่งเป็นที่ที่พวกเขาสามารถสร้างอัลบั้มส่วนตัวได้<br />หากไม่มีการกำหนด "ตรวจสอบการส่งภาพส่วนตัว" ภาพที่ส่งโดยสมาชิกไปยังอัลบั้มส่วนตัว ไม่จำเป็นต้องได้รับการตรวจสอบโดยผู้ดูแล ผู้ใช้สามารถเป็นสมาชิกได้เพียงกลุ่มเดียวเท่านั้น<br />');
define("GTDOC_USER_MGR_TITLE", 'ผู้ใช้');
define("GTDOC_USER_MGR_DESC", 'ที่นี่คุณสามารถเปลี่ยนกลุ่มของผู้ใช้  ดูข้อมูลการใช้พื้นที่ของผู้ใช้ที่คุณต้องการ');
define("GTDOC_CREATE_ORDER_ALBUM_TITLE", 'จัดการอัลบั้ม'); // admin link file albmgr.php
define("GTDOC_CREATE_ORDER_ALBUM_DESC", 'ที่นี่คุณสามารถสร้าง ลบ หรือเปลี่ยนลำดับของอัลบั้ม ถ้าหากคุณต้องการมีอัลบั้มส่วนตัว  กดที่ปุ่มสร้างใหม่ได้เลย');
define("GTDOC_USER_CREATE_ORDER_ALBUM_TITLE", 'สร้างอัลบั้มส่วนตัว'); // user file albmgr.php
define("GTDOC_USER_CREATE_ORDER_ALBUM_DESC", 'หากคุณต้องการมีอัลบั้มส่วนตัว ให้กดที่ลิงค์ สร้างอัลบั้ม แล้วกดที่ปุ่ม \'ใหม่ \' จากนั้นพิมพ์ชื่ออัลบั้มที่ต้องการ แล้วกดบันทึกการเปลี่ยนแปลง คุณสามารถมีอัลบั้มส่วนตัวหลายอัลบั้ม แต่จะจำกัดด้วยพื้นที่ที่ผู้ดูแลกำหนดให้  ซึ่งจากตรงนี้ คุณสามารถลบอัลบั้ม โดยกดที่ชื่ออัลบั้มที่ต้องการ แล้วกด ลบ ในการจัดเรียงลำดับของอัลบั้มนั้น  ให้เลือกชื่ออัลบั้มที่ต้องการจะย้ายจากน1้นให้กดที่ปุ่มลูกศรขึ้นลง ในการเปลี่ยนชื่ออัลบั้ม ให้กดที่ชื่ออัลบั้ม แล้วกดแก้ไข แล้วกดบันทึกการเปลี่ยนแปลง');
define("GTDOC_MY_PROFILE_TITLE", 'ข้อมูลส่วนตัว'); // admin link file albmgr.php
define("GTDOC_MY_PROFILE_DESC", 'คุณสามารถดูข้อมูลกลุ่มของคุณ รวมทั้งพื้นที่ที่ใช้ไป/ได้รับ'); // user file name=coppermine&file=profile&op=edit_profile
define("GTDOC_MODALBUM_TITLE", 'ปรับปรุงอัลบั้ม/ภาพ'); //file modifyalb.php
define("GTDOC_MODALBUM_DESC", '<br> <strong>ลบ</strong> ยอมให้คุณลบอัลบั้ม และภาพทั้งหมดในอัลบั้มนั้น<br /><strong>ตั้งค่าตัวเลือก</strong> ยอมให้คุณแก้ไขชื่อ รายละเอียด และสิทธิ์ต่างๆของอัลบั้มนั้น<br /><strong>แก้ไขภาพ</strong>ยอมให้คุณแก้ไขหัวเรื่อง หัวข้อและคำสำคัญ เป็นต้น... ของภาพในอัลบั้ม');
define("GTDOC_ALBUMPROPS_TITLE", 'ตั้งค่าอัลบั้ม');
define("GTDOC_USER_ALBUMPROPS_TITLE", 'แก้ไขอัลบั้มส่วนตัว');
define("GTDOC_ALBUMPROPS_DESC", '<br />คุณสามารถเคลื่อนย้ายรายการอัลบั้มซึ่งอยู่ทางขวาบนได้   รายการ "หมวดหมู่อัลบั้ม" นั้น ยอมให้คุณเคลื่อนย้ายอัลบั้มระหว่างแกลอรีได้ ถ้าหากกำหนดเป็น "* ไม่มีหมวดหมู่ *" อัลบั้มของคุณจะไปแสดงอยู่ในหน้าจอหลัก<br />  ช่อง "รายละเอียดอัลบั้ม" จะอยู่ถัดมาจากภาพขนาดย่อของอัลบั้ม  คุณสามารถใช้ bbCodes ใน Coppermineได้ (เช่นเดียวกับที่ใช้ใน phpBB) ทั้งในส่วนของรูปภาพและรายละเอียดอัลบั้ม <br /><ul><li>[b]<strong>bold</strong>[/b]</li><li>[i]<i>italic</i>[/i]</li><li>[url=http://url]URL text</a>[/url]</li><li>[email]<a href="javascript:;">user@domain.tld</a>[/email] </li></ul> ภาพขนาดย่อ จะเป็นรูปภาพที่สื่อถึงอัลบั้มในรายการของอัลบั้ม <br /><strong>สิทธิ์สำหรับอัลบั้ม</strong> ถ้ากำหนดเป็น "ผู้ใช้สามารถมีอัลบั้มส่วนตัว"ในหน้าจอการตั้งค่า คุณสามารถกำหนดว่า ใครที่จะสามารถชมภาพในอัลบั้มนี้ได้บ้าง <br /> หากกำหนด  "ผู้มาเยือนสามารถส่งภาพ" ผู้มาเยือน ก็จะสามารถส่งภาพเข้าอัลบั้มนี้ได้เช่นกัน    <strong>พึงระลึกว่า ผู้มาเยือน มีสิทธิ์ที่จะส่งภาพไปกยังอัลบั้มที่ยอมให้ผู้มาเยือนสามารถส่งภาพได้  ยกเว้นเขาเป็นสมาชิกของกลุ่ม   "สามารถส่งภาพได้"  </strong>ผู้ใช้ที่ไม่ได้ลงทะเบียน จะเป็นสมาชิกของกลุ่ม  "ผู้ไม่ประสงค์ออกนาม"  <br />กฏเกณฑ์ที่กล่าวมาข้างต้น สามารถใช้กับ  "ผู้มาเยือนสามารถวิจารณ์" และ "ผู้มาเยือนสามารถจัดอันดับภาพ" ');
define("GTDOC_USER_ALBUMPROPS_DESC", '<br />รายการ "หมวดหมู่อัลบั้ม" นั้น ยอมให้คุณเคลื่อนย้ายอัลบั้มระหว่างแกลอรีได้ ถ้าหากกำหนดเป็น "* ไม่มีหมวดหมู่ *" อัลบั้มของคุณจะไปแสดงอยู่ในหน้าจอหลัก<br />  ช่อง "รายละเอียดอัลบั้ม" จะอยู่ถัดมาจากภาพขนาดย่อของอัลบั้ม  คุณสามารถใช้ bbCodes ใน Coppermineได้ (เช่นเดียวกับที่ใช้ใน phpBB) ทั้งในส่วนของรูปภาพและรายละเอียดอัลบั้ม <br /> <ul><li>[b]<strong>bold</strong>[/b]</li><li>[i]<i>italic</i>[/i]</li><li>[url=http://url]URL text</a>[/url]</li><li>[email]<a href="javascript:;">user@domain.tld</a>[/email] </li></ul> ภาพขนาดย่อ จะเป็นรูปภาพที่สื่อถึงอัลบั้มในรายการของอัลบั้ม <br /><strong>สิทธิ์สำหรับอัลบั้ม</strong> ถ้ากำหนดเป็น "ผู้ใช้สามารถมีอัลบั้มส่วนตัว"ในหน้าจอการตั้งค่า คุณสามารถกำหนดว่า ใครที่จะสามารถชมภาพในอัลบั้มนี้ได้แก่ ทุกคน ตัวเองเท่านั้น  และสมาชิกที่ลงทะเบียน <br /> ผู้ใช้ที่ไม่ได้ลงทะเบียน จะเป็นสมาชิกของกลุ่ม  "ผู้ไม่ประสงค์ออกนาม"  <br />กฏเกณฑ์ที่กล่าวมาข้างต้น สามารถใช้กับ  "ผู้มาเยือนสามารถวิจารณ์" และ "ผู้มาเยือนสามารถจัดอันดับภาพ" ');
define("GTDOC_CONFIG_TITLE", 'หน้าการตั้งค่า <a id="config" name="config"></a><br> คุณสามารถกำหนดค่าของ  coppermine ตามที่คุณต้องการ และเป็นที่กำหนดให้ค่าให้ความสามารถต่างๆทำงานได้หรือไม่  คุณสามารถใช้ phpmyadmin หรือ ระบบจัดการ mysql อื่นๆ ช่วย </span>&nbsp;&nbsp;<span class="sqlname"><strong>config name</strong></span>  ');
define("GTDOC_CONFIG_DESC", ' <br> คุณสามารถกำหนดค่าของ  coppermine ตามที่คุณต้องการ และเป็นที่กำหนดให้ค่าให้ความสามารถต่างๆทำงานได้หรือไม่  คุณสามารถใช้ phpmyadmin หรือ ระบบจัดการ mysql อื่นๆ ช่วย </span>&nbsp;&nbsp;<span class="sqlname"><strong>config name</strong></span>  ก็ได้');
define("GTDOC_USER_CONFIG_TITLE", 'การกำหนดค่านี้ สงวนไว้สำหรับ site administrator เท่านั้น กรุณาติดต่อผู้ดูแลระบบ');
define("GTDOC_GENSET_TITLE", 'ตั้งค่าทั่วไป');
define("GTDOC_GAL_NAME_TITLE", 'ชื่อแกลอรี <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["gallery_name"] . '</span>&nbsp;&nbsp;<span class="sqlname">gallery_name</span>');
define("GTDOC_GAL_NAME_DESC", 'นี่ก็ชื่อแกลอรีของคุณ ซึ่งจะปรากฏบนส่วนหัวของเวบเพจ (แก้ไขการแสดงผลได้ใน template.html) และในบาง  templates.');
define("GTDOC_GAL_DESC_TITLE", 'คำจำกัดความแกลอรี <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["gallery_description"] . '</span>&nbsp;&nbsp;<span class="sqlname">gallery_description</span>'); // $CONFIG["gallery_description']
define("GTDOC_GAL_DESC_DESC", '<p>เป็นคำจำกัดความอย่างสั้นของแกลอรีของคุณ จะปรากฏในส่วนบนของหน้าจอภายใต้ชื่อแกลอรี  (แก้ไขการแสดงผลได้ใน template.html)');
define("GTDOC_GAL_EMAIL_TITLE", 'email ของผู้ดูแล <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["gallery_admin_email"] . '</span>&nbsp;&nbsp;<span class="sqlname">gallery_admin_email</span>'); // $CONFIG["gallery_admin_email']
define("GTDOC_GAL_EMAIL_DESC", ' e-mail address ของคุณ  emails ทั้งหมดที่ส่งในนามแกลอรีจะใช้  emailนี้ในการส่ง');
define("GTDOC_HOME_LINK_TITLE", ' ที่อยู่โฟลเดอร์ของ PHP-Nuke <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["ecards_more_pic_target"] . '</span>&nbsp;&nbsp;<span class="sqlname">ecards_more_pic_target</span>');
define("GTDOC_HOME_LINK_DESC", ' เป็น URL ที่ PHP-Nuke ติดตั้งอยู่  ใช้สำหรับลิงค์ของ e-card สำหรับ &quot; ดูภาพเพิ่มเติม&quot; และลิงค์ของ bookmark เช่น  http://www.mysite.com/html/ ');
define("GTDOC_LANG_TITLE", 'ภาษา<br><span class="cur_name">ค่าปัจจุบัน: ' . $CONFIG["lang"] . '</span>&nbsp;&nbsp;<span class="sqlname">lang</span>');
define("GTDOC_LANG_DESC", 'เป็นภาษาที่แกลอรีของคุณใช้งาน ภาษาทั้งหมดจะอยู่ใน directory <strong>lang</strong>  <br>   ');
define("GTDOC_THEME_TITLE", 'ธีม <br><span class="cur_name">ค่าปัจจุบัน : ' . $CONFIG["album_list_cols"] . '</span>&nbsp;&nbsp;<span class="sqlname">theme</span>'); //$CONFIG["theme']
define("GTDOC_THEME_DESC", 'ใช้สำหรับเลือกธีมให้กับแกลอรี ซึ่งอยู่ภายใต้ directories <strong>themes</strong>  เฉพาะธีมที่ออกแบบมาสำหรับ version นี้เท่านั้น จึงจะสามารถทำงานได้  วิธีที่ดีที่สุดที่จะแก้ไขธีมคือ  copy จาก default theme ไปเป็นชื่อธีมที่คุณชอบ (อยู่ภายใต้โฟลเดอร์ theme ), แล้วทำการแก้ไขไฟล์ css และไฟล์ template ตามที่ต้องการ หลังจากที่คุณส่งไฟล์ขึ้นไปยัง server ชื่อธีม จะปรากฏที่ส่วนนี้');
define("GTDOC_NICE_TITLES_TITLE", 'หน้าที่ระบุแทน &gt;Coppermine<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["nice_titles"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">nice_titles</span>'); // $CONFIG["nice_titles']
define("GTDOC_NICE_TITLES_DESC", 'ใช้เพื่อระบุหัวเรื่องที่ต้องการในไตเติลบาร์ของบราวเซอร์ ');
define("GTDOC_ALBUM_LIST_TITLE", 'มุมมองรายการอัลบั้ม');
define("GTDOC_MAIN_TITLE_WIDTH_TITLE", 'ความกว้างของตารางหลัก (pixels หรือ %)<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["main_table_width"] . '</span>&nbsp;&nbsp;<span class="sqlname">main_table_width</span>');
define("GTDOC_MAIN_TITLE_WIDTH_DESC", 'เป็นขนาดของตารางในหน้าจอหลัก หรือเมื่อคุณดูภาพขนาดย่อ คุณสามารถระบุเป็น pixels หรือ เปอร์เซ็นต์ ค่าโดยปริยายคือ 100% ซึ่งเป็นค่าที่เรียกใช้โดยฟังก์ชัน starttable(); ถ้าหากไม่มีการระบุค่า (สำคัญสำหรับผู้ที่จะออกแบบธีม)');
define("GTDOC_SUBCAT_LEVEL_TITLE", 'จำนวนระดับของหมวดหมู่ที่จะแสดง <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["subcat_level"] . '</span>&nbsp;&nbsp;<span class="sqlname">subcat_level</span>');
define("GTDOC_SUBCAT_LEVEL_DESC", 'ค่าโดยปริยายคือ  2  ด้วยค่านี้ ชุดคำสั่งจะแสดง หมวดหมู่ปัจจุบัน บวกกับอีก 1 ระดับของแกลอรีย่อย ');
define("GTDOC_ALBUMS_PER_PAGE_TITLE", 'จำนวนอัลบั้มที่แสดง <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["albums_per_page"] . '</span>&nbsp;&nbsp;<span class="sqlname">albums_per_page</span>');
define("GTDOC_ALBUMS_PER_PAGE_DESC", 'จำนวนของอัลบั้มที่จะแสดงในหน้าจอ หากหมวดหมู่ในปัจจุบันมีหลายอัลบั้ม รายการอัลบั้ม จะแสดงผลแบบหลายหน้า');
define("GTDOC_ALB_LIST_COLS_TITLE", 'จำนวนคอลัมน์สำหรับรายการอัลบั้ม <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["album_list_cols"] . '</span>&nbsp;&nbsp;<span class="sqlname">album_list_cols</span>');
define("GTDOC_ALB_LIST_COLS_DESC", 'ค่าโดยปริยายคือ 2 หากธีมของ PHP-Nuke ไม่กว้างเกินไป หรือคุณใช้ coppermine เป็นหน้าจอหลักของเวบไซต์ คุณควรจะตั้งค่าเป็น 1');
define("GTDOC_ALBLIST_THUMB_SIZE_TITLE", 'ขนาดของภาพขนาดย่อ ในหน่วย pixels<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["alb_list_thumb_size"] . '</span>&nbsp;&nbsp;<span class="sqlname">alb_list_thumb_size</span>');
define("GTDOC_ALBLIST_THUMB_SIZE_DESC", 'เป็นขนาดของภาพขนาดย่อ ที่จะแสดงในแต่ละอัลบั้ม  50 หมายถึงภาพขนาดย่อ จะมีขนาด   50x50 pixels.
<br>If the size you specify there is larger than "ตั้งค่าภาพและภาพขนาดย่อ /ความกว้างและความสูงมากสุดของภาพขนาดย่อ ", the thumbnail will be stretched.');
define("GTDOC_MAIN_CONT_TITLE", 'เนื้อหาในหน้าหลัก<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["main_table_width"] . '</span>&nbsp;&nbsp;<span class="sqlname">main_table_width</span>');
define("GTDOC_MAIN_CONT_DESC", 'ตัวเลือกนี้ จะยอมให้คุณเปลี่ยนเนื้อหาในหน้าจอหลักที่จะแสดงโดยชุดคำสั่ง <br>ค่าโดยปริยายคือ  "breadcrumb/catlist/alblist/lastup,1/lastcom,1/topn,1/toprated,1/random,1/anycontent"<br>คุณสามารถใช้  "codes"<ul><li>"<strong>breadcrumb</strong>": Home Category Name Album Name (the navigation links)</li><li>"<strong>catlist</strong>": รายการหมวดหมู่</li><li>"<strong>alblist</strong>": รายการอัลบั้ม</li><li>"<strong>lastup</strong>": ส่งภาพล่าสุด</li><li>"<strong>lastcom</strong>": วิจารณ์ล่าสุด </li><li>"<strong>topn</strong>": เข้าชมมากสุด</li><li>"<strong>toprated</strong>": อันดับสูงสุด</li><li>"<strong>random</strong>": ภาพแบบสุ่ม</li><li>"<strong>anycontent</strong>": บล็อค anycontent (คุณสามารถเขียนข้อความอะไรก็ได้ที่คุณต้องการ)</li></ul><br> ซึ่งจะเขียนเรียงลำดับอย่างไรก็ได้ และเป็นทางเลือกเพิ่มเติม (ยกเว้น catlist และ alblist ซึ่งมีความจำเป็นในการแสดงผล)<br>หากตั้งค่า <strong>,2</strong>หมายถึง  2 แถวของ thumbnails.breadcrumb/catlist/alblist/lastup,1/lastcom,1/topn,1/toprated,1/random,1/anycontent');
define("GTDOC_FIRST_LEVEL_TITLE", ' แสดงภาพขนาดย่อระดับแรกในหมวดหมู่ <br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["first_level"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">first_level</span>');
define("GTDOC_FIRST_LEVEL_DESC", 'จะแสดงรายการอัลบั้มทั้งหมดของคุณ ภายใต้หมวดหมู่ของมุมมองภาพขนาดย่อของ coppermine ');
define("GTDOC_THUMBCOLS_TITLE", 'จำนวนคอลัมน์ของภาพขนาดย่อ<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["thumbcols"] . '</span>&nbsp;&nbsp;<span class="sqlname">thumbcols</span>');
define("GTDOC_THUMBCOLS_DESC", 'ค่าโดยปริยายคือ  4 หมายถึงแต่ละแถวจะแสดงภาพขนาดย่อ 4 ภาพ');
define("GTDOC_THUMBROWS_TITLE", 'จำนวนแถวของภาพขนาดย่อ <br><span class="cur_name"> Current  Value: ' . $CONFIG["thumbrows"] . '</span>&nbsp;&nbsp;<span class="sqlname">thumbrows</span>');
define("GTDOC_THUMBROWS_DESC", 'ค่าโดยปริยายคือ  3 หมายถึงในแต่ละคอลัมน์ จะแสดงภาพขนาดย่อ 3 ภาพ');
define("GTDOC_MAX_TABS_TITLE", ' จำนวนมากสุดของตารางที่จะแสดง <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["max_tabs"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_tabs</span>');
define("GTDOC_MAX_TABS_DESC", 'เมื่อภาพขนาดย่อมีจำนวนหลายหน้า จะมีการแสดงหน้า ที่ด้านล่างของตาราง ซึ่งจะบอกว่า มีจำนวนหน้าทั้งหมดเท่าไหร่');
define("GTDOC_CAPTION_THUMBVIEW_TITLE", 'แสดงหัวข้อเรื่อง (เพิ่มจากหัวเรื่อง) ภายใต้ภาพขนาดย่อ<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["caption_in_thumbview"] . '</span>&nbsp;&nbsp;<span class="sqlname">caption_in_thumbview</span>');
define("GTDOC_CAPTION_THUMBVIEW_DESC", 'แสดงหัวข้อเรื่องของภาพ ภายใต้ภาพขนาดย่อ');
define("GTDOC_NUM_COMMENT SHOW_TITLE", 'แสดงจำนวนของคำวิจารณ์ภายใต้ภาพขนาดย่อ -- <span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["display_comment_count"] . '</span>&nbsp;&nbsp;<span class="sqlname">display_comment_count</span>');
define("GTDOC_NUM_COMMENT SHOW_DESC", 'แสดงจำนวนของคำวิจารณ์ภายใต้ภาพขนาดย่อ ไม่ว่าจะมีหรือไม่ก็ตาม');
define("GTDOC_SORT_ORDER_TITLE", 'การเรียงลำดับภาพโดยปริยาย <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["default_sort_order"] . '</span>&nbsp;&nbsp;<span class="sqlname">default_sort_order</span>');
define("GTDOC_SORT_ORDER_DESC", 'ใช้เรียงลำดับภาพขนาดย่อ เมื่อผู้ใช้กดที่ เครื่องหมายบวกหรือ ลบ ค่าก็จะเปลี่ยนไปตามนั้น จนกว่าจะเคลียร์  cookies ');
define("GTDOC_MIN_VOTES_TITLE", 'จำนวนต่ำสุดของการโหวตสำหรับภาพที่จะปรากฏใน \'อันดับสูงสุด\' list<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["min_votes_for_rating"] . '</span>&nbsp;&nbsp;<span class="sqlname">min_votes_for_rating</span>');
define("GTDOC_MIN_VOTES_DESC", 'หากภาพได้รับค่าน้อยกว่าค่าที่กำหนด ก็จะไม่ปรากฏอยู่ในหน้าจอ "อันดับสูงสุด" ');
define("GTDOC_SEO_ALTS_TITLE", ' แสดงหัวเรื่องและคำสำคัญ แทนรายละเอียดของภาพขนาดย่อ<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["seo_alts"] . '</span>&nbsp;&nbsp;<span class="sqlname">seo_alts</span>');
define("GTDOC_SEO_ALTS_DESC", 'ใช้เพื่อเปลี่ยนรายละเอียดของ หัวเรื่องภาพและคำสำคัญ หากไม่มีการกำหนดอย่างอื่น ก็จะเป็นการแสดงชื่อของภาพ ซึ่งจะแสดงเมื่อผู้ใช้เคลื่อนเมาส์อยู่เหนือรูป และขณะทำการดาวน์โหลด (สำหรับการเชื่อมต่อที่ช้ากว่า...)');
define("GTDOC_PIC_TABLE_WIDTH_TITLE", 'ความกว้างของตารางสำหรับการแสดงภาพ (pixels หรือ %)<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["picture_table_width"] . '</span>&nbsp;&nbsp;<span class="sqlname">picture_table_width</span>');
define("GTDOC_PIC_TABLE_WIDTH_DESC", 'ความกว้างของตารางที่ใช้ในการแสดงภาพระหว่างทาง');
define("GTDOC_DISP_PICINFO_TITLE", 'แสดงรายละเอียดของภาพโดยปริยาย <br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["display_pic_info"] . '</span>&nbsp;&nbsp;<span class="sqlname">display_pic_info</span>');
define("GTDOC_DISP_PICINFO_DESC", 'ควรจะเห็นโดยปริยายา ไม่ว่าจะมีหรือไม่มีรายละเอียดของภาพ (ปรากฏเมื่อกดที่ปุ่ม (i) บนภาพขนาดเต็ม) ถ้าหากรายละเอียดนี้ มีความสำคัญสำหรับแกลอรีของคุณ คุณอาจจะต้องการใช้งานความสามารถนี้ แม้กับบราวเซอร์ที่ไม่ได้รองรับ/ปิดจาวาสคริปต์  ');
define("GTDOC_BADWORDS_TITLE", 'กรองคำพูดในคำวิจารณ์ <br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["filter_bad_words"] . '</span>&nbsp;&nbsp;<span class="sqlname">filter_bad_words</span>');
define("GTDOC_BADWORDS_DESC", 'ลบ "คำที่ไม่สุภาพ" ออกจากคำวิจารณ์ ซึ่ง "คำที่ไม่สุภาพนี้" จะอยู่ในไฟล์ภาษา');
define("GTDOC_SMILIES_TITLE", 'อนุญาตให้ใช้รูปยิ้มในคำวิจารณ์  </span>&nbsp;&nbsp;<span class="sqlname">enable_smilies</span>');
define("GTDOC_SMILIES_DESC", 'อนุญาตให้มีการใช้รูปยิ้มในคำวิจารณ์ ได้  ');
define("GTDOC_NO_FLOOD_COM_TITLE", 'ไม่ใช้งานการป้องกันการส่งซ้ำๆ </span>&nbsp;&nbsp;<span class="sqlname">user disable_flood_protection</span>');
define("GTDOC_NO_FLOOD_COM_DESC", 'ไม่ใช้งานการป้องกันการส่งคำวิจารณ์แบบติดๆกัน ในภาพเดียวกัน โดยผู้ใช้คนเดียวกัน');
define("GTDOC_COM_EMAIL_TITLE", 'Email ไปยังผู้ดูแล เมื่อมีการเพิ่มคำวิจารณ์</span>&nbsp;&nbsp;<span class="sqlname">comment_email_notification </span>');
define("GTDOC_COM_EMAIL_DESC", 'เปลี่ยนค่าเป็นใช่ จะมีการส่งเมลทุกครั้งที่มีการเพิ่มคำวิจารณ์   "gallery_admin_email" ');
define("GTDOC_MAX_DESC_TITLE", 'ความยาวมากสุดของรายละเอียดของภาพ<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["max_img_desc_length"] . '</span>&nbsp;&nbsp;<span class="sqlname">&nbsp;max_img_desc_length</span>');
define("GTDOC_MAX_DESC_DESC", 'จำนวนอักขระมากสุด ที่ใช้ในการบอกรายละเอียดของภาพ  ');
define("GTDOC_MAX_COM_WLENGTH_TITLE", 'จำนวนมากสุดของอักขระในข้อความ<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["max_com_wlength"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_com_wlength</span>');
define("GTDOC_MAX_COM_WLENGTH_DESC", 'ใช้เพื่อป้องกันผู้ใช้บางคน ที่อาจจะทำให้รูปแบบของแกลอรีเสียไป โดยการพิมพ์คำวิจารณ์ยาวๆ โดยไม่มีช่องว่างเลย  โดยค่าปริยาย จะตรวจสอบข้อความที่ยาวกว่า 38 ตัวอักษร');
define("GTDOC_MAX_COM_LINES_TITLE", 'จำนวนบรรทัดมากสุดในคำวิจารณ์ <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["max_com_lines"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_com_lines</span>');
define("GTDOC__DESC", 'ป้องกันการวิจารณ์ที่ประกอบด้วยจำนวนบรรทัดเยอะๆ');
define("GTDOC_MAX_COM_CHARS_TITLE", 'ความยาวมากสุดของคำวิจารณ์ <br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["max_com_size"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_com_size</span>');
define("GTDOC_MAX_COM_CHARS_DESC", 'จำนวนอักขระมากสุดที่ใช้ในการวิจารณ์');
define("GTDOC_FILM_STRIP_TITLE", 'แสดงแถบฟิล์ม <span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["display_film_strip"]? 'Enabled':'Not Enabled') . '</span>&nbsp;&nbsp;<span class="sqlname">display_film_strip</span>');
define("GTDOC_FILM_STRIP_DESC", 'แสดงแถบฟิล์มภายใต้ภาพ ');
define("GTDOC_FILM_FRAMES_TITLE", 'จำนวนภาพของภาพแถบฟิล์ม <br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["max_film_strip_items"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_film_strip_items</span>');
define("GTDOC_FILM_FRAMES_DESC", 'จำนวนเฟรมในภาพแถบฟิล์ม');
define("GTDOC_ANON_FULL_TITLE", 'อนุญาตให้ผู้ไม่ประสงค์ออกนามดูภาพขนาดเต็ม  <br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["allow_anon_fullsize"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">allow_anon_fullsize</span>');
define("GTDOC_ANON_FULL_DESC", 'เป็นค่าโดยปริยายอยู่แล้ว');
define("GTDOC_PIC_THUMB_TITLE", 'ตั้งค่าภาพและภาพขนาดย่อ');
define("GTDOC_JPEG_TITLE", 'คุณภาพของไฟล์ JPEG <br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["jpeg_qual"] . '</span>&nbsp;&nbsp;<span class="sqlname">jpeg_qual</span>');
define("GTDOC_JPEG_DESC", 'คุณภาพของการบีบอัดไฟล์ JPEG เมื่อชุดคำสั่งทำการปรับขนาดภาพ ค่านี้ สามารถเป็นไปได้ตั้งแต่ 0 (ห่วยสุด) ถึง 100 (ดีที่สุด) สามารถตั้งค่าที่ 75 เมื่อใช้งาน ImageMagick.');
define("GTDOC_THUMBW_TITLE", 'ขนาดภาพมากสุดของภาพขนาดย่อ<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["thumb_width"] . '</span>&nbsp;&nbsp;<span class="sqlname">thumb_width</span>');
define("GTDOC_THUMBW_DESC", 'ขนาดภาพมากสุดของภาพขนาดย่อ (ห้ามเปลี่ยนค่านี้ หลังจากที่คุณมีภาพแล้ว)');
define("GTDOC_THUMBU_TITLE", 'ความกว้างหรือความสูงมากสุดของภาพขนาดย่อ <br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["thumb_use"] . '</span>&nbsp;&nbsp;<span class="sqlname">thumb_use</span>');
define("GTDOC_THUMBU_DESC", 'ความกว้างโดยปริยายของภาพขนาดย่อ ที่ลงตัวพอดีในพื้นที่ขนาด 100x100 pixels.(ห้ามเปลี่ยนค่านี้ หลังจากที่คุณมีภาพแล้ว )');
define("GTDOC_INTERM_TITLE", 'สร้างภาพระหว่างทาง<br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["make_intermediate"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">make_intermediate</span>');
define("GTDOC_INTERM_DESC", 'ค่าโดยปริยาย เมื่อคุณทำการส่งภาพ ชุดคำสั่งจะทำการสร้างภาพขนาดย่อ (ชื่อภาพที่มี thumb_ prefix) รวมกับภาพระหว่างทาง (ชื่อภาพที่มี normal_ prefix) หากคุณเลือก \'ไม่\' จะไม่มีการสร้างภาพระหว่างทาง');
define("GTDOC_PWIDTH_TITLE", 'ความกว้างหรือความสูงมากสุดของภาพระหว่างทาง<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["picture_width"] . '</span>&nbsp;&nbsp;<span class="sqlname">picture_width</span>');
define("GTDOC_PWIDTH_DESC", 'ภาพระหว่างทางที่ปรากฏเมื่อคุณคลิกที่ภาพขนาดย่อ ห้ามเปลี่ยนค่านี้เมื่อคุณมีภาพล้ว  ค่าโดยปริยายคือ 400  ซึ่งหมายถึงว่า ภาพระหว่างทางจะลงตัวพอดีในพื้นที่ขนาด 400x400 pixelsซึ่งเหมาะกับจอคอมพิวเตอร์ขนาด 15นิ้ว ที่ความละเอียด 1024 x 768 ของเกือบทุกรูปแบบที่ใช้');
define("GTDOC_MAXUPSIZE_TITLE", 'ขนาดมากสุดของภาพที่ส่ง (กิโลไบต์)<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["max_upl_size"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_upl_size</span>');
define("GTDOC_MAXUPSIZE_DESC", 'ภาพที่มีขนาดใหญ่กว่าค่าที่กำหนดนี้ จะไม่สามารถส่งได้ คุณควรจะตั้งค่านี้ให้มีค่าน้อยกว่าขนาดที่ตั้งไว้ของ PHP');
define("GTDOC_MAXUPW_TITLE", 'ความกว้างหรือความสูงมากสุดสำหรับภาพที่ส่ง (pixels)<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["max_upl_width_height"] . '</span>&nbsp;&nbsp;<span class="sqlname">max_upl_width_height</span>');
define("GTDOC_MAXUPW_DESC", 'จำกัดขนาดของภาพที่ส่ง เนื่องจากการปรับขนาดของบภาพขนาดใหญ่ จะใช้หน่วยความจำและทรัพยากรของเครื่องมาก');
define("GTDOC_USEREG_TITLE", 'อนุญาตให้มีการลงทะเบียนผู้ใช้ใหม่');
define("GTDOC_USEREG_DESC", '<strong>ไม่มีการใช้งานความสามารถนี้ ใน version นี้ของ coppermine</strong>');
define("GTDOC_USEREGM_TITLE", 'การลงทะเบียนต้องการ email ที่ใช้งานได้จริง');
define("GTDOC_USEREGM_DESC", '<strong>ไม่มีการใช้งานความสามารถนี้ ใน version นี้ของ coppermine</strong>');
define("GTDOC_USEML_TITLE", 'ยอมให้ผู้ใช้สองคนใช้ email address เดียวกัน');
define("GTDOC_USEML_DESC", '<strong>ไม่มีการใช้งานความสามารถนี้ ใน version นี้ของ coppermine</strong>');
define("GTDOC_PRVALB_TITLE", 'ผู้ใช้สามารถมีอัลบั้มส่วนตัว<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["allow_private_albums"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">allow_private_albums</span>');
define("GTDOC_PRVALB_DESC", 'หากตั้งค่าเป็น ใช่ แกลอรีของคุณจะมีอัลบั้ม ที่สามารถดูได้โดยผู้ใช้ที่เป็นสมาชิกในกลุ่มนั้น  <br>ถ้าผู้ใช้เป็นสมาชิกของกลุ่มที่สามารถมีแกลอรีส่วนตัว และมีการกำหนดค่านี้ไว้ ผู้ใช้ จะมีสิทธิ์ที่จะซ่อนบางส่วนของอัลบั้มจากผู้ใช้คนอื่น ');
define("GTDOC_USRFLDS_TITLE", 'ฟิลด์ที่ตั้งเองสำหรับรายละเอียดของภาพ (ปล่อยว่าง หากไม่ต้องการใช้)');
define("GTDOC_USRFLDS_DESC", 'ฟิลด์เหล่านี้ จะแสดงรวมอยู่ใน  "รายละเอียดของภาพ"  จะปรากฏเฉพาะเมื่อคุณมีการกำหนดชื่อฟิลด์เท่านั้น สามารถใช้ได้ทั้ง 4 ฟิลด์ ');
define("GTDOC_PIC_THUMB_ADV_TITLE", 'การตั้งค่าแบบก้าวหน้าสำหรับภาพและภาพขนาดย่อ');
define("GTDOC_PRIVICON_TITLE", 'แสดงสัญญลักษณ์อัลบั้มส่วนตัวสำหรับผู้ใช้ที่ไม่ได้เข้าสู่ระบบ<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["show_private"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">show_private</span>');
define("GTDOC_PRIVICON_DESC", 'ค่าโดยปริยายของ coppermine จะแสดงสัญญลักษณ์อัลบั้มส่วนตัวและรายละเอียดของอัลบั้มส่วนตัว หากตั้งค่าเป็น \' ใช่\' จะไม่มีการแสดงภาพหรือรายละเอียด');
define("GTDOC_FCHAR_TITLE", 'อักขระต้องห้ามในชื่อไฟล์<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["forbiden_fname_char"] . '</span>&nbsp;&nbsp;<span class="sqlname">forbiden_fname_char</span>');
define("GTDOC_FCHAR_DESC", 'หากชื่อของไฟล์ของภาพที่ส่ง  มีอักขระเหล่านี้ประกอบอยู่ จะถูกแทนที่ด้วย underscore.<br>กรุณาอย่าเปลี่ยนค่านี้ ยกเว้น คุณรู้ดีว่า คุณกำลังทำอะไร ');
define("GTDOC_FEX_TITLE", 'ชนิดของไฟล์ที่ยอมให้ส่ง<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["allowed_file_extensions"] . '</span>&nbsp;&nbsp;<span class="sqlname">allowed_file_extensions</span>');
define("GTDOC_FEX_DESC", 'ชนิดของไฟล์ที่ไม่ได้อยู่ในรายการที่กำหนด จะถูกปฏิเสธโดยชุดคำสั่ง เพื่อป้องกันผู้ใช้จากการส่งไฟล์ที่ไม่ใช่รูปภาพ <br>ชุดคำสั่งสามารถจัดการได้เฉพาะไฟล์รูปภาพเท่านั้น ดังนั้นอย่าเพิ่มชนิดของไฟล์อื่น เช่น ไฟล์ video  .AVI  <br> GD library รองรับเฉพาะ JPEGและ PNG ดังนั้นไฟล์ชนิดอื่นๆจะถูกปฏิเสธ แม้ว่า ชนิดของไฟล์จะถูกต้องก็ตาม');
define("GTDOC_TMBM_TITLE", 'วิธีการปรับขนาดภาพ<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["thumb_method"] . '</span>&nbsp;&nbsp;<span class="sqlname">thumb_method</span>');
define("GTDOC_TMBM_DESC", 'หากคุณใช้ GD 1.x แล้วสีของภาพขนาดย่อหรือภาพระหว่างทางไม่ถูกต้อง ให้เปลี่ยนไปใช้  GD 2.x. แทน');
define("GTDOC_IPATH_TITLE", 'ที่อยู่ของ ImageMagick \'convert\' utility (เช่น /usr/bin/X11/)<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["impath"] . '</span>&nbsp;&nbsp;<span class="sqlname">impath</span>');
define("GTDOC_IPATH_DESC", 'หากคุณใช้ ImageMagick convert utility ในการปรับขนาดภาพ คุณจะต้องระบุ directory ที่มี convert program อยู่ อย่าลืมเติม "/"  ปิดท้ายด้วย <br> หาก server ของคุณทำงานภายใต้ Windows ให้ใช้  / และไม่ใช้  \ ในการระบุเส้นทางของ components (เช่น ใช้ C:/ImageMagick/ ไม่ใช้ C:\ImageMagick\). เส้นทางนี้ จะต้องไม่มีช่องว่าง  ดังนั้นภายใต้ Windows ห้ามใส่ ImageMagick ไว้ใน  "Program files" <br><strong>ImageMagick จะทำงานหนัก ถ้าหาก PHP บน server ของคุณทำงานใน  SAFE mode ให้พิจารณาใช้ GD ในกรณีนี้  และไม่ต้องไปเสียเวลาถามในกระดานข่าว มีหลายอย่างที่สามารถป้องกัน ImageMagick ในการที่จะทำงานอย่างถูกต้อง และปราศจากการเข้าถึง server ทำให้คาดเดาได้ยากว่า เกิดความผิดพลาดที่ไหน</strong>');
define("GTDOC_FEX_TITLE", 'ชนิดของไฟล์ที่อนุญาต (สำหรับ ImageMagick เท่านั้น)<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["allowed_img_types"] . '</span>&nbsp;&nbsp;<span class="sqlname">allowed_img_types</span>');
define("GTDOC_FEX_DESC", 'เป็นรายการของชนิดของไฟล์ ที่ชุดคำสั่งยอมรับเมื่อใช้ ImageMagick ชนิดของไฟล์จะถูกตรวจสอบโดยอ่านข้อมูลในส่วนหัวของไฟล์ และไม่ได้สนใจที่นามสกุลของไฟล์');
define("GTDOC_IMOPT_TITLE", 'คำสั่งเพิ่มเติมสำหรับ ImageMagick<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["im_options"] . '</span>&nbsp;&nbsp;<span class="sqlname">im_options</span>');
define("GTDOC_IMOPT_DESC", 'คุณสามารถเพิ่มคำสั่งเพิ่มเติมเข้าไปในการทำงานของ ImageMagick กรุณาอ่านเพิ่มเติมใน ImageMagick Convert manual ');
define("GTDOC_EXIF_TITLE", 'อ่านข้อมูล EXIF ในไฟล์ JPEG <br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["read_exif_data"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">read_exif_data</span>');
define("GTDOC_EXIF_DESC", 'ถ้าเปิดใช้งาน ชุดคำสั่งจะอ่านข้อมูล EXIF ที่เก็บโดย digicams ในไฟล์ JPEG files ความสามารถใหม่นี้ ยังไม่ได้ทดสอบอย่างสมบูรณ์ ');
define("GTDOC_IPTC_TITLE", 'อ่านข้อมูล IPTC ในไฟล์ JPEG <br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["read_iptc_data"] ? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">read_iptc_data</span>');
define("GTDOC_IPTC_DESC", 'อ่านข้อมูล IPTC ในไฟล์ JPEG ความสามารถใหม่นี้ ยังไม่ได้ทดสอบอย่างสมบูรณ์ '); //;($CONFIG["read_iptc_data"]
define("GTDOC_FPATH_TITLE", ' directory ของอัลบั้ม <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["fullpath"] . '</span>&nbsp;&nbsp;<span class="sqlname">fullpath</span>');
define("GTDOC_FPATH_DESC", 'เป็น directory สำหรับ  "ที่เก็บภาพ" ที่อยู่นี้จะสัมพันธ์กับ directory หลักของชุดคำสั่ง <br>คุณสามารถใช้ ../ ในการระบุเส้นทาง เพื่อขยับขึ้นไปอีก 1 ระดับในระบบของ directory <br>คุณไม่สามารถใช้เส้นทางจริง เช่น ("/var/my_images/" จะใช้งานไม่ได้) และ directory ของอัลบั้ม จะต้องมองเห็นได้โดย web server ไม่รองรับการระบุเส้นทางใน server อื่น');
define("GTDOC_UPICS_TITLE", ' directory สำหรับภาพของผู้ใช้ <br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["userpics"] . '</span>&nbsp;&nbsp;<span class="sqlname">userpics</span>');
define("GTDOC_UPICS_DESC", 'เป็น directory สำหรับเก็บภาพ ที่ส่งขึ้นมาผ่านทางหน้าจอเวบ  directory ซึ่งจะเป็น directory ย่อยของ directory ของอัลบั้ม <br>ใช้วิธีระบุเส้นทางได้เหมือนกับตัวแปรข้างบน<br> หากส่งภาพผ่านทาง FTPให้เก็บใน directory ย่อยของ "album directory" และไม่อยู่ภายใน "directory สำหรับภาพของผู้ใช้".');
define("GTDOC_DDIR_TITLE", ' mode โดยปริยายของ directories<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["default_dir_mode"] . '</span>&nbsp;&nbsp;<span class="sqlname">default_dir_mode</span>');
define("GTDOC_DDIR_DESC", 'ถ้าหากระหว่างการติดตั้ง ตัวติดตั้งได้แจ้งว่า ตั้งสิทธิ์ directory  ไม่ถูกต้อง ให้ตั้งเป็น  <strong>0777</strong> ไม่งั้น คุณจะไม่สามารถลบ directories ที่สร้างโดยชุดคำสั่ง ด้วยโปรแกรม   FTP เมื่อคุณต้องการจะถอนการติดตั้ง');
define("GTDOC_CHMOD_TITLE", 'mode โดยปริยายสำหรับภาพ<br><span class="cur_name"> ค่าปัจจุบัน : ' . $CONFIG["default_file_mode"] . '</span>&nbsp;&nbsp;<span class="sqlname">default_file_mode</span>');
define("GTDOC_CHMOD_DESC", 'ไม่จำเป็นต้องตั้งอะไร นอกจาก 644');
define("GTDOC_PFNAME_TITLE", 'แสดงชื่อไฟล์ในรายละเอียด<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["picinfo_display_filename"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_filename</span>');
define("GTDOC_PFNAME_DESC", 'แสดงชื่อไฟล์ ในส่วนรายละเอียดของภาพ ?');
define("GTDOC_PANAME_TITLE", 'แสดงชื่ออัลบั้มในรายละเอียด<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["picinfo_display_album_name"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_album_name</span>');
define("GTDOC_PANAME_DESC", 'แสดงชื่ออัลบั้มที่มาของภาพนั้นในส่วนรายละเอียดของภาพ ?');
define("GTDOC_PFSIZE_TITLE", 'แสดงขนาดไฟล์ในรายละเอียด<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["picinfo_display_file_size"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_file_size</span>');
define("GTDOC_PFSIZE_DESC", 'แสดงขนาดของไฟล์ (50 กิโลไบต์) ในส่วนรายละเอียดของภาพ?');
define("GTDOC_PDIM_TITLE", 'แสดงขนาดภาพในรายละเอียด<br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["picinfo_display_dimensions"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_dimensions</span>');
define("GTDOC_PDIM_DESC", 'แสดงขนาดของภาพ เช่น (640x480)ในส่วนรายละเอียดของภาพ?');
define("GTDOC_PCNT_TITLE", ' แสดงจำนวนครั้งการเข้าชมในรายละเอียด<br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["picinfo_display_count_displayed"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_count_displayed</span>');
define("GTDOC_PCNT_DESC", 'แสดงจำนวนครั้งของการเข้าชมภาพ ในส่วนรายละเอียดของภาพ?');
define("GTDOC_PURL_TITLE", 'แสดง URL ในรายละเอียด<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["picinfo_display_URL"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_URL</span>');
define("GTDOC_PURL_DESC", 'แสดง URL แบบสั้น ในส่วนรายละเอียดของภาพ ? หากคุณเลือกใช้ "แสดง URL แบบสั้นของภาพในแบบ bookmark link" ก็จะเป็นการแสดงผลของตัวเลือกนี้  คุณไม่จำเป็นต้องตั้งเลือกใช้ค่านี้ เพื่อที่จะให้  bookmark link ทำงานได้');
define("GTDOC_PBKMK_TITLE", 'แสดง URL เป็นแบบ bookmark link<br><span class="cur_name"> ค่าปัจจุบัน: ' . sprintf('%s', $CONFIG["picinfo_display_URL_bookmark"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_URL_bookmark</span>');
define("GTDOC_PBKMK_DESC", 'แสดง URL แบบสั้นของภาพในแบบ bookmark link (สำหรับ Internet Explorer เท่านั้น) ในส่วนรายละเอียดของภาพ ?');
define("GTDOC_PFAV_TITLE", 'แสดงลิงค์อัลบั้มโปรดปราน<br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["picinfo_display_favorites"]? 'ใช้งานได้':'ใช้งานไม่ได้') . ' </span>&nbsp;&nbsp;<span class="sqlname">picinfo_display_favorites</span>');
define("GTDOC_PFAV_DESC", 'แสดงการเพิ่มไปยังอัลบั้มที่โปรดปราน ในส่วนรายละเอียดของภาพ ? ความสามารถใหม่นี้ จะอนุญาตให้ผู้ใช้ สามารถมีอัลบั้มโปรดปรานส่วนตัว  ตราบเท่าที่ยังเปิดใช้งานคุกกี้');
define("GTDOC_COOKIE_TITLE", 'ตั้งค่าคุกกี้ & อักขระ');
define("GTDOC_CNAME_TITLE", 'ชื่อของคุกกี้ ที่ใช้งานโดยชุดคำสั่ง<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["cookie_name"] . '</span>&nbsp;&nbsp;<span class="sqlname">cookie_name</span>');
define("GTDOC_CNAME_DESC", 'ค่าโดยปริยายคือ "cpgnuke" ใช้คุกกี้อื่น สำหรับแต่ละตัว ถ้าหากคุณติดตั้ง coppermine มากกว่า 1 ตัว!');
define("GTDOC_CPATH_TITLE", 'ที่อยู่ของคุกกี้ที่ใช้งานโดยชุดคำสั่ง<br><span class="cur_name">ค่าปัจจุบัน : ' . $CONFIG["cookie_path"] . '</span>&nbsp;&nbsp;<span class="sqlname">cookie_path</span>');
define("GTDOC_CPATH_DESC", 'ค่าโดยปริยายคือ  "/" ให้เปลี่ยนค่านี้ไปเป็นค่าตามการติดตั้ง nuke ของคุณ  /html/ ');
define("GTDOC_CHARSET_TITLE", 'การถอดรหัสอักขระ<br><span class="cur_name"> ค่าปัจจุบัน: ' . $CONFIG["charset"] . '</span>&nbsp;&nbsp;<span class="sqlname">charset</span>');
define("GTDOC_CHARSET_DESC", 'ควรจะตั้งเป็น "Default (language file)" ');
define("GTDOC_DEBUG_TITLE", 'เปิดการใช้งาน debug mode<br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["debug_mode"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">debug_mode </span>');
define("GTDOC_DEBUG_DESC", 'หากคุณมีปัญหา ให้เปิดใช้ความสามารถนี้ เพื่อประกอบการแก้ปัญหาที่เกิดขึ้น (ไม่ต้องกังวล ค่าเหล่านี้ จะแสดงให้เห็นเฉพาะผู้ดูแลเท่านั้น ไม่ได้แสดงให้ผู้ใช้ทั่วไปเห็น)');
define("GTDOC_ADEBUG_TITLE", 'เปิดการใช้งาน debug mode แบบก้าวหน้า<br><span class="cur_name"> ค่าปัจจุบัน : ' . sprintf('%s', $CONFIG["advanced_debug_mode"]? 'ใช้งานได้':'ใช้งานไม่ได้') . '</span>&nbsp;&nbsp;<span class="sqlname">advanced_debug_mode</span>');
define("GTDOC_ADEBUG_DESC", 'หากคุณมีปัญหา ให้เปิดความสามารถนี้  และเปิดใช้ debug mode เพื่อเป็นข้อมูลเพิ่มเติม (ไม่ต้องกังวล ค่าเหล่านี้ จะแสดงให้เห็นเฉพาะผู้ดูแลเท่านั้น ไม่ได้แสดงให้ผู้ใช้ทั่วไปเห็น)');
?>
