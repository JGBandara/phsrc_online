/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Janaka
 * Created: 22 Jun 2019
 */

alter table `dms_file_permission` 
   add column `dfp_location_id` smallint default '1' null after `dfp_is_deleted`;
update `sys_menus`
set 
  `sym_parent_id` = '4',
  `sym_name` = 'User Locations',
  `sym_url` = 'presentation/system/masterData/userLocation/userLocation.php',
  `sym_status` = '1',
  `sym_order_by` = '4',
  `sym_show_menu` = '1',
  `sym_view` = '1',
  `sym_list` = '0',
  `sym_add` = '0',
  `sym_edit` = '1',
  `sym_delete` = '0',
  `sym_send_to_approval` = '0',
  `sym_print` = '0',
  `sym_reject` = '0',
  `sym_revise` = '0',
  `sym_admin_right` = '0',
  `sym_copy_to_clipboard` = '0',
  `sym_export_to_excel` = '0',
  `sym_export_to_pdf` = '0',
  `sym_without_permission` = '0',
  `sym_behaviour` = 'master',
  `sym_awesome_icon` = 'sym_awesome_icon',
  `sym_module` = 'system'
where `sym_id` = '8';

create table `sys_user_location` (
  `syo_id` int(11) not null auto_increment,
  `syo_location_id` smallint(6) not null,
  `syo_user_id` int(11) unsigned not null,
  `syo_remarks` varchar(256) default null,
  `syo_status` smallint(6) not null default '1',
  `syo_is_deleted` tinyint(4) default '0' comment '0-Not Deleted, 1-Deleted',
  `syo_company_id` smallint(11) not null,
  `syo_created_by` smallint(11) default null,
  `syo_created_on` int(11) default null,
  `syo_last_modified_by` smallint(11) default null,
  `syo_last_modified_on` int(11) default null,
  `syo_deleted_by` smallint(11) default null,
  `syo_deleted_on` int(11) default null,
  primary key (`syo_id`),
  key `syo_location_id` (`syo_location_id`),
  key `syo_user_id` (`syo_user_id`),
  key `syo_company_id` (`syo_company_id`)
) engine=innodb default charset=latin1;

alter table `sys_permission` 
   add column `syp_location_id` smallint default '1' null after `syp_export_to_pdf`, 
   add column `syp_company_id` smallint default '1' null after `syp_location_id`;
   
alter table `sys_permission` 
   change `syp_location_id` `syp_location_id` smallint(6) default '1' not null, 
   change `syp_company_id` `syp_company_id` smallint(6) default '1' not null,
   drop primary key, 
   add primary key(`syp_menu_id`, `syp_user_id`, `syp_location_id`, `syp_company_id`);

   






