/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_videos

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-20 17:04:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_group_care
-- ----------------------------
DROP TABLE IF EXISTS `admin_group_care`;
CREATE TABLE `admin_group_care` (
  `agc_id` int(11) NOT NULL AUTO_INCREMENT,
  `agc_name` varchar(255) NOT NULL,
  `agc_city` int(11) NOT NULL,
  `agc_phone` varchar(15) DEFAULT NULL,
  `agc_admin_id` int(11) NOT NULL,
  `agc_admin_name` varchar(255) NOT NULL,
  `agc_date` int(11) NOT NULL,
  `agc_status` tinyint(4) NOT NULL DEFAULT '1',
  `agc_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`agc_id`),
  KEY `agc_admin_id` (`agc_admin_id`),
  KEY `agc_city` (`agc_city`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_group_care
-- ----------------------------
INSERT INTO `admin_group_care` VALUES ('1', 'Nhóm Giang', '5', '0912340089', '90', 'Nguyễn Thùy Giang 2', '1340768246', '1', '1');
INSERT INTO `admin_group_care` VALUES ('2', 'Nhóm Lan', '5', '123', '52', 'Phương Lan', '0', '1', '1');
INSERT INTO `admin_group_care` VALUES ('3', 'KD - Huê', '5', '0979 015 225', '72', 'Hoàng Thị Ngọc Huê', '1370941559', '1', '2');
INSERT INTO `admin_group_care` VALUES ('4', 'KD - Nam', '5', '0977 046 096', '9', 'Đoàn Ngọc Nam', '1369144265', '1', '2');
INSERT INTO `admin_group_care` VALUES ('5', 'KD - Cường', '5', '0985820246', '134', 'Nguyễn Ngọc Cường', '1378120089', '1', '2');
INSERT INTO `admin_group_care` VALUES ('6', 'Mk - Phú', '5', '123', '29', 'luunguyenphu', '1331288876', '1', '3');
INSERT INTO `admin_group_care` VALUES ('7', 'KD - Hậu', '5', '123', '140', 'Nguyễn Thị Hải Hậu', '1373367195', '1', '2');
INSERT INTO `admin_group_care` VALUES ('8', 'KD-Nhanhvn', '5', '123', '145', 'Nhanh.vn', '1341021648', '1', '2');
INSERT INTO `admin_group_care` VALUES ('9', 'KD-Thành', '5', '0986460903', '42', 'Đoàn Đức Thành', '1341906418', '1', '2');
INSERT INTO `admin_group_care` VALUES ('10', 'KD-Huy', '5', '0979591918', '91', 'Nguyễn Văn Huy - KD', '1369217656', '1', '2');
INSERT INTO `admin_group_care` VALUES ('11', 'KD - Ánh', '5', '01659995359', '229', 'Đặng Thị Ánh', '1366111800', '1', '2');
INSERT INTO `admin_group_care` VALUES ('12', 'Marketting_HCM', '7', '0123456', '193', 'Kiểm', '1364867039', '1', '3');
INSERT INTO `admin_group_care` VALUES ('13', 'Mar_HongVinh', '5', '123', '32', 'Phạm Hồng Vinh', '1362127233', '1', '3');
INSERT INTO `admin_group_care` VALUES ('14', 'nhanh.vn', '5', '0936499920', '332', 'Hoàng Thị Minh Thanh', '1363151728', '1', '2');
INSERT INTO `admin_group_care` VALUES ('17', 'KD - Công', '5', '', '251', 'Đỗ Thành Công', '1369214089', '1', '2');

-- ----------------------------
-- Table structure for admin_menu_order
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu_order`;
CREATE TABLE `admin_menu_order` (
  `amo_admin` int(11) NOT NULL DEFAULT '0',
  `amo_module` int(11) NOT NULL DEFAULT '0',
  `amo_order` int(11) DEFAULT '0',
  PRIMARY KEY (`amo_admin`,`amo_module`),
  KEY `amo_order` (`amo_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_menu_order
-- ----------------------------
INSERT INTO `admin_menu_order` VALUES ('1', '14', '10');
INSERT INTO `admin_menu_order` VALUES ('1', '23', '5');
INSERT INTO `admin_menu_order` VALUES ('1', '87', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '35', '1');
INSERT INTO `admin_menu_order` VALUES ('1', '11', '11');
INSERT INTO `admin_menu_order` VALUES ('1', '18', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '46', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '10', '2');
INSERT INTO `admin_menu_order` VALUES ('1', '26', '6');
INSERT INTO `admin_menu_order` VALUES ('1', '19', '2');
INSERT INTO `admin_menu_order` VALUES ('1', '72', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '67', '7');
INSERT INTO `admin_menu_order` VALUES ('1', '24', '9');
INSERT INTO `admin_menu_order` VALUES ('439', '35', '0');
INSERT INTO `admin_menu_order` VALUES ('439', '26', '0');
INSERT INTO `admin_menu_order` VALUES ('439', '67', '0');
INSERT INTO `admin_menu_order` VALUES ('439', '24', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '88', '5');
INSERT INTO `admin_menu_order` VALUES ('1', '89', '6');
INSERT INTO `admin_menu_order` VALUES ('438', '19', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '91', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '92', '4');
INSERT INTO `admin_menu_order` VALUES ('1', '93', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '94', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '95', '3');
INSERT INTO `admin_menu_order` VALUES ('440', '23', '0');
INSERT INTO `admin_menu_order` VALUES ('440', '91', '0');
INSERT INTO `admin_menu_order` VALUES ('440', '19', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '96', '8');
INSERT INTO `admin_menu_order` VALUES ('441', '96', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '19', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '91', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '23', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '11', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '35', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '67', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '89', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '88', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '26', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '14', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '95', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '92', '0');
INSERT INTO `admin_menu_order` VALUES ('441', '24', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '23', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '96', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '11', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '35', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '26', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '14', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '19', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '24', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '95', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '92', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '91', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '97', '0');
INSERT INTO `admin_menu_order` VALUES ('443', '92', '0');
INSERT INTO `admin_menu_order` VALUES ('443', '96', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '67', '0');
INSERT INTO `admin_menu_order` VALUES ('442', '97', '0');
INSERT INTO `admin_menu_order` VALUES ('443', '35', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '98', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '99', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '100', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '23', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '96', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '11', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '35', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '98', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '67', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '100', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '26', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '19', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '99', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '24', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '97', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '95', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '92', '0');
INSERT INTO `admin_menu_order` VALUES ('444', '91', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '113', '0');
INSERT INTO `admin_menu_order` VALUES ('1', '114', '0');

-- ----------------------------
-- Table structure for admin_translate
-- ----------------------------
DROP TABLE IF EXISTS `admin_translate`;
CREATE TABLE `admin_translate` (
  `tra_keyword` varchar(255) NOT NULL,
  `tra_text` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `tra_source` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tra_keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_translate
-- ----------------------------
INSERT INTO `admin_translate` VALUES ('0323de4f66a1700e2173e9bcdce02715', 'Logout', '1', 'Logout');
INSERT INTO `admin_translate` VALUES ('b61541208db7fa7dba42c85224405911', 'Menu', '1', 'Menu');
INSERT INTO `admin_translate` VALUES ('e050b402c1f5326f8d350c61694e0513', 'Show list menu', '1', 'Show list menu');
INSERT INTO `admin_translate` VALUES ('6bc362dbf494c61ea117fe3c71ca48a5', 'Move', '1', 'Move');
INSERT INTO `admin_translate` VALUES ('d6705b26e977120f7fff7f6541aa3680', 'Menu listing', '1', 'Menu listing');
INSERT INTO `admin_translate` VALUES ('3e4f6b98dd47b06bb7d7b452338d8f13', 'Thứ tự', '1', 'Thứ tự');
INSERT INTO `admin_translate` VALUES ('ada8b28aaf732f572121bdaf7b734e05', 'Tên menu', '1', 'Tên menu');
INSERT INTO `admin_translate` VALUES ('9d73d841b7a35ee09471fbc8382063d1', 'Liên kết', '1', 'Liên kết');
INSERT INTO `admin_translate` VALUES ('69ea36f3046522e3b87d0ca79a1d721e', 'Vị trí', '1', 'Vị trí');
INSERT INTO `admin_translate` VALUES ('bb2562bfee18c26343fc91d08e28a625', 'No selected', '1', 'No selected');
INSERT INTO `admin_translate` VALUES ('c9cc8cce247e49bae79f15173ce97354', 'Save', '1', 'Save');
INSERT INTO `admin_translate` VALUES ('3744738d8abab2f3bfbc43742096ccc6', 'Mở ra cửa sổ', '1', 'Mở ra cửa sổ');
INSERT INTO `admin_translate` VALUES ('4d3d769b812b6faa6b76e1a8abaece2d', 'Active', '1', 'Active');
INSERT INTO `admin_translate` VALUES ('5fb63579fc981698f97d55bfecb213ea', 'Copy', '1', 'Copy');
INSERT INTO `admin_translate` VALUES ('7dce122004969d56ae2e0245cb754d35', 'Edit', '1', 'Edit');
INSERT INTO `admin_translate` VALUES ('f2a6c498fb90ee345d997f888fce3b18', 'Delete', '1', 'Delete');
INSERT INTO `admin_translate` VALUES ('dfaa01f3617bd390d1cb2bab9cf0520f', 'Click to edit...', '1', 'Click to edit...');
INSERT INTO `admin_translate` VALUES ('8929ef313c0fd6e43446cc0aa86b70cd', 'Tìm kiếm', '1', 'Tìm kiếm');
INSERT INTO `admin_translate` VALUES ('f1851d5600eae616ee802a31ac74701b', 'Enter', '1', 'Enter');
INSERT INTO `admin_translate` VALUES ('063c5bad4cb4e38270a8064282d8cf26', 'Sort A->Z or Z->A', '1', 'Sort A->Z or Z->A');
INSERT INTO `admin_translate` VALUES ('d879cb7ec352716ee940adac5c505340', 'Do you want to delete the product you\'ve selected ?', '1', 'Do you want to delete the product you\'ve selected ?');
INSERT INTO `admin_translate` VALUES ('24c0b84c19d8cdde90951ac6762f0706', 'Delete all selected', '1', 'Delete all selected');
INSERT INTO `admin_translate` VALUES ('17ae5cc83fa7a949d2008d5d2a556fe2', 'Total record', '1', 'Total record');
INSERT INTO `admin_translate` VALUES ('8d6e39135454a7027fc058ab43383aa8', 'Trang tĩnh', '1', 'Trang tĩnh');
INSERT INTO `admin_translate` VALUES ('1cd2c2f7a203be1d0a7cc942037d51ad', 'Tin tức', '1', 'Tin tức');
INSERT INTO `admin_translate` VALUES ('1d1aa192b5f3b65f18a833224b52a22d', 'Sản phẩm', '1', 'Sản phẩm');
INSERT INTO `admin_translate` VALUES ('33f0741f9e26310fbe1a9511048e4996', 'Giới thiệu', '1', 'Giới thiệu');
INSERT INTO `admin_translate` VALUES ('8881984856eea95a37c6b2f116da5da0', 'Phụ kiện', '1', 'Phụ kiện');
INSERT INTO `admin_translate` VALUES ('bb0ca7b10e0403c6cf6d0856a303c80b', 'Giải pháp', '1', 'Giải pháp');
INSERT INTO `admin_translate` VALUES ('399474704c5d235108c1df6dc63e8417', 'Hỏi đáp', '1', 'Hỏi đáp');
INSERT INTO `admin_translate` VALUES ('f01435acd94ced9d198b163136a6ceb1', 'Chọn danh mục', '1', 'Chọn danh mục');
INSERT INTO `admin_translate` VALUES ('88cca1554d60a722c9329867fe6726de', 'Tên danh mục', '1', 'Tên danh mục');
INSERT INTO `admin_translate` VALUES ('7e1f42134de6654908c29d8416edc842', 'Thêm mới danh mục', '1', 'Thêm mới danh mục');
INSERT INTO `admin_translate` VALUES ('6925a750d9e84cdbab22e95eadc99906', 'Loại danh mục', '1', 'Loại danh mục');
INSERT INTO `admin_translate` VALUES ('6cd9e20b34570fd85452d6841057d2c2', 'Chọn loại danh mục', '1', 'Chọn loại danh mục');
INSERT INTO `admin_translate` VALUES ('29deb7955c1d18575d56aaae47bf1a5e', 'Sắp xếp', '1', 'Sắp xếp');
INSERT INTO `admin_translate` VALUES ('3c6f336189cf75e45b09039066ab2cc4', 'Ảnh', '1', 'Ảnh');
INSERT INTO `admin_translate` VALUES ('3d94238c027cc777954c8c3e10ddb258', 'Danh mục cha', '1', 'Danh mục cha');
INSERT INTO `admin_translate` VALUES ('cf210dbf1670fa82368c0a1e7f4e56c4', 'Chọn danh mục con', '1', 'Chọn danh mục con');
INSERT INTO `admin_translate` VALUES ('bc214b2709bc9d5700f8e0b32cbc4d79', 'Tiếp tục thêm', '1', 'Tiếp tục thêm');
INSERT INTO `admin_translate` VALUES ('77f6903f0ac02331b5a7001a05519ae8', 'Thêm mới', '1', 'Thêm mới');
INSERT INTO `admin_translate` VALUES ('8e9d61188f4cad473a2f12626dabb1e4', 'Danh sách ảnh', '1', 'Danh sách ảnh');
INSERT INTO `admin_translate` VALUES ('af1b98adf7f686b84cd0b443e022b7a0', 'Categories', '1', 'Categories');
INSERT INTO `admin_translate` VALUES ('53d8de583ea7608b24d2aaf0edd90f0b', 'Danh mục', '1', 'Danh mục');
INSERT INTO `admin_translate` VALUES ('cd48206067ac5f62cc664794150bd319', 'Category listing', '1', 'Category listing');
INSERT INTO `admin_translate` VALUES ('498f79c4c5bbde77f1bceb6c86fd0f6d', 'Show', '1', 'Show');
INSERT INTO `admin_translate` VALUES ('a28c6d1503fde7e355cda9ce2b7ba5d0', 'Are you want duplicate record', '1', 'Are you want duplicate record');
INSERT INTO `admin_translate` VALUES ('573d643cf1e507e3939566ee8cb85bfe', 'Please enter tintuc name', '1', 'Please enter tintuc name');
INSERT INTO `admin_translate` VALUES ('40a3f6e61efa652c8a06e67a33ada355', 'Sửa danh mục', '1', 'Sửa danh mục');
INSERT INTO `admin_translate` VALUES ('06e0e9ebf644616fd56c521f74611b00', 'Danh mục con', '1', 'Danh mục con');
INSERT INTO `admin_translate` VALUES ('5254652803211a21b0aafdc1b278cd09', 'Lưu lại', '1', 'Lưu lại');
INSERT INTO `admin_translate` VALUES ('4bf239867967133d56e22c691b990730', 'Làm lại', '1', 'Làm lại');
INSERT INTO `admin_translate` VALUES ('46c397226dd34c77dcc8c64859c9e520', 'Banner Listing', '1', 'Banner Listing');
INSERT INTO `admin_translate` VALUES ('664e2136bf45dca2ea4eed276d90ae19', 'Banner name', '1', 'Banner name');
INSERT INTO `admin_translate` VALUES ('88a126c7b39a4e035444d5ed8323fa72', 'Link banner', '1', 'Link banner');
INSERT INTO `admin_translate` VALUES ('0b366e999e00a10cbbef9819cfff1023', 'Loại Banner', '1', 'Loại Banner');
INSERT INTO `admin_translate` VALUES ('bafd7322c6e97d25b6299b5d6fe8920b', 'No', '1', 'No');
INSERT INTO `admin_translate` VALUES ('1c124c3750c7d7a139a12f66cd64af28', 'Login Name', '1', 'Login Name');
INSERT INTO `admin_translate` VALUES ('f11b368cddfe37c47af9b9d91c6ba4f0', 'Full name', '1', 'Full name');
INSERT INTO `admin_translate` VALUES ('ce8ae9da5b7cd6c3df2929543a9af92d', 'Email', '1', 'Email');
INSERT INTO `admin_translate` VALUES ('94a064527b49d1806c785017cb4de5e2', 'Username GN', '1', 'Username GN');
INSERT INTO `admin_translate` VALUES ('fc8c9c23f2469829de2243f7f8d72444', 'Right module', '1', 'Right module');
INSERT INTO `admin_translate` VALUES ('57d056ed0984166336b7879c2af3657f', 'City', '1', 'City');
INSERT INTO `admin_translate` VALUES ('572fdff36c9419a3204e0a27c851150b', 'Fake Login', '1', 'Fake Login');
INSERT INTO `admin_translate` VALUES ('99dea78007133396a7b8ed70578ac6ae', 'Login', '1', 'Login');
INSERT INTO `admin_translate` VALUES ('9d5b888617863d159ab820e180d623ef', 'Are you sure to delete', '1', 'Are you sure to delete');
INSERT INTO `admin_translate` VALUES ('27163bae262de21ce154cfbdfd477c2b', 'Management website version 1.0', '1', 'Management website version 1.0');
INSERT INTO `admin_translate` VALUES ('09f0c5159c5e34504e453eff3fc70324', 'Account Management', '1', 'Account Management');
INSERT INTO `admin_translate` VALUES ('08bd40c7543007ad06e4fce31618f6ec', 'Account', '1', 'Account');
INSERT INTO `admin_translate` VALUES ('dc647eb65e6711e155375218212b3964', 'Password', '1', 'Password');
INSERT INTO `admin_translate` VALUES ('a58f11905c6e4e604025da091fd21392', 'City/District Listing', '1', 'City/District Listing');
INSERT INTO `admin_translate` VALUES ('8833c8e8224a14b07aa3e6e75adff5c8', 'Click vào để sửa đổi sau đó enter để lưu lại', '1', 'Click vào để sửa đổi sau đó enter để lưu lại');
INSERT INTO `admin_translate` VALUES ('e74687ce22a0dd5b084b221e0245d9c1', 'Nhân bản thêm một bản ghi mới', '1', 'Nhân bản thêm một bản ghi mới');
INSERT INTO `admin_translate` VALUES ('103e26ede1d9a1ef79d9a695ad38f076', 'Bạn muốn sửa đổi bản ghi', '1', 'Bạn muốn sửa đổi bản ghi');
INSERT INTO `admin_translate` VALUES ('56ee3495a32081ccb6d2376eab391bfa', 'Listing', '1', 'Listing');
INSERT INTO `admin_translate` VALUES ('a261e9c2d70b7377da04817678ffe28b', 'Thêm menu mới', '1', 'Thêm menu mới');
INSERT INTO `admin_translate` VALUES ('40782f943cb26695685719d494a86558', 'Click sửa đổi sau đó chọn save', '1', 'Click sửa đổi sau đó chọn save');
INSERT INTO `admin_translate` VALUES ('a5915972963fbe301b98cba71fec357b', 'Bạn muốn xóa bản ghi?', '1', 'Bạn muốn xóa bản ghi?');
INSERT INTO `admin_translate` VALUES ('4631c1fd35806f277b34ba3c70069489', 'You have successfully deleted', '1', 'You have successfully deleted');
INSERT INTO `admin_translate` VALUES ('327431af0359c7ac54080e8671c1fc80', 'You have successfully duplicated', '1', 'You have successfully duplicated');
INSERT INTO `admin_translate` VALUES ('ae4b89f870785ea13dba02f1dcd0a20a', 'Tiêu đề', '1', 'Tiêu đề');
INSERT INTO `admin_translate` VALUES ('990cc9a866a8c9f700e8b18da651ca66', 'Statics Listing', '1', 'Statics Listing');
INSERT INTO `admin_translate` VALUES ('a915353abb7e8032f213f403c089865a', 'Chọn danh mục cha', '1', 'Chọn danh mục cha');
INSERT INTO `admin_translate` VALUES ('af871bda571ca25c95d085fbd134daa1', 'Giá phải lớn hơn 0 !', '1', 'Giá phải lớn hơn 0 !');
INSERT INTO `admin_translate` VALUES ('fba94834af2988e51fdaf118bed1a949', 'Giá nhập về phải lớn hơn 0 !', '1', 'Giá nhập về phải lớn hơn 0 !');
INSERT INTO `admin_translate` VALUES ('d9b718cad121430960a45708020bd80a', 'Add new record', '1', 'Add new record');
INSERT INTO `admin_translate` VALUES ('78c02d516a42555f271f43eb874ac677', 'Sửa menu', '1', 'Sửa menu');
INSERT INTO `admin_translate` VALUES ('2374b44bec1b6a80cc13c07d0d19f91c', 'Admin User listing', '1', 'Admin User listing');
INSERT INTO `admin_translate` VALUES ('8b14cccf460524cc522b671cb73c4a60', 'Username is not empty and> 3 characters', '1', 'Username is not empty and> 3 characters');
INSERT INTO `admin_translate` VALUES ('4a2625fe1771a1890227ec50ee1f86ea', 'Administrator account already exists', '1', 'Administrator account already exists');
INSERT INTO `admin_translate` VALUES ('df10cc9b682c4dbf276339eb45b2a65b', 'Password must be greater than 4 characters', '1', 'Password must be greater than 4 characters');
INSERT INTO `admin_translate` VALUES ('16648260e58b4cf9d458e1a197ef43f1', 'Email is invalid', '1', 'Email is invalid');
INSERT INTO `admin_translate` VALUES ('7ccf75fa7498152efe4e152833455c67', 'Login name', '1', 'Login name');
INSERT INTO `admin_translate` VALUES ('bcc254b55c4a1babdf1dcb82c207506b', 'Phone', '1', 'Phone');
INSERT INTO `admin_translate` VALUES ('4c231e0da3eaaa6a9752174f7f9cfb31', 'Confirm password', '1', 'Confirm password');
INSERT INTO `admin_translate` VALUES ('7b15160cb91a523014f1606660fd1851', 'Username trên Giao nhận', '1', 'Username trên Giao nhận');
INSERT INTO `admin_translate` VALUES ('99938282f04071859941e18f16efcf42', 'select', '1', 'select');
INSERT INTO `admin_translate` VALUES ('22884db148f0ffb0d830ba431102b0b5', 'module', '1', 'module');
INSERT INTO `admin_translate` VALUES ('34ec78fcc91ffb1e54cd85e4a0924332', 'add', '1', 'add');
INSERT INTO `admin_translate` VALUES ('de95b43bceeb4b998aed4aed5cef1ae7', 'edit', '1', 'edit');
INSERT INTO `admin_translate` VALUES ('099af53f601532dbd31e0ea99ffdeb64', 'delete', '1', 'delete');
INSERT INTO `admin_translate` VALUES ('84a8921b25f505d0d2077aeb5db4bc16', 'Static', '1', 'Static');
INSERT INTO `admin_translate` VALUES ('06145a21dcec7395085b033e6e169b61', 'Menus', '1', 'Menus');
INSERT INTO `admin_translate` VALUES ('f9aae5fda8d810a29f12d1e61b4ab25f', 'Users', '1', 'Users');
INSERT INTO `admin_translate` VALUES ('a54f98b0e23e6925c855760cdabd7168', 'Banners', '1', 'Banners');
INSERT INTO `admin_translate` VALUES ('edd7ae75c3a820d7fb5b331a020c4626', 'Admin User - Management', '1', 'Admin User - Management');
INSERT INTO `admin_translate` VALUES ('eb631b70ae7c721773f91b506c815082', 'Configurations', '1', 'Configurations');
INSERT INTO `admin_translate` VALUES ('e2f06abaff2623821632a05249f4c5f6', 'List City - District', '1', 'List City - District');
INSERT INTO `admin_translate` VALUES ('f3d873c4bc4d8c1dea06311d3226b919', 'Admin city', '1', 'Admin city');
INSERT INTO `admin_translate` VALUES ('c9cb3dbd637672e65c8138311808f73b', 'all_category', '1', 'all_category');
INSERT INTO `admin_translate` VALUES ('03368e3c1eb4d2a9048775874301b19f', 'Select tintuc', '1', 'Select tintuc');
INSERT INTO `admin_translate` VALUES ('97efa0b62a66b41fd988ec7fc2e694bb', 'save_change', '1', 'save_change');
INSERT INTO `admin_translate` VALUES ('7a6e7491825990107cbfa71abe947112', 'All_category', '1', 'All_category');
INSERT INTO `admin_translate` VALUES ('efd07a93bff07c8dd52624d900172d83', 'Thêm mới Admin User', '1', 'Thêm mới Admin User');
INSERT INTO `admin_translate` VALUES ('e0626222614bdee31951d84c64e5e9ff', 'Select', '1', 'Select');
INSERT INTO `admin_translate` VALUES ('e55f75a29310d7b60f7ac1d390c8ae42', 'Module', '1', 'Module');
INSERT INTO `admin_translate` VALUES ('ec211f7c20af43e742bf2570c3cb84f9', 'Add', '1', 'Add');
INSERT INTO `admin_translate` VALUES ('6bcecfe8349eb783b735d815c8e08c28', 'Edit member profile', '1', 'Edit member profile');
INSERT INTO `admin_translate` VALUES ('b36aa562ba43e1963c42cdec3c8b5b77', 'Change password member', '1', 'Change password member');
INSERT INTO `admin_translate` VALUES ('3544848f820b9d94a3f3871a382cf138', 'New password', '1', 'New password');
INSERT INTO `admin_translate` VALUES ('0b39c5aca15b84b1ad53a94d6b3feb78', 'Change password', '1', 'Change password');
INSERT INTO `admin_translate` VALUES ('8547034108ba0285d5339f5e149d9b32', 'Please enter new password', '1', 'Please enter new password');
INSERT INTO `admin_translate` VALUES ('2516af6cb654137bb71e9d2fd6c577d2', 'New password and confirm password is not correct', '1', 'New password and confirm password is not correct');
INSERT INTO `admin_translate` VALUES ('3b7db4b6d510cc3156e3acf4365e7a74', 'Cập nhật', '1', 'Cập nhật');
INSERT INTO `admin_translate` VALUES ('57fbf1acc87fb60f9ea8ebdbbb873302', 'Your_new_password_has_been_updated', '1', 'Your_new_password_has_been_updated');
INSERT INTO `admin_translate` VALUES ('ad31a6749699923d66d1fb1afa1a78c5', 'Management website', '1', 'Management website');
INSERT INTO `admin_translate` VALUES ('c1c079acfea640c60e08f76c4eae4dab', 'SẢN PHẨM MỚI', '1', 'SẢN PHẨM MỚI');
INSERT INTO `admin_translate` VALUES ('dfb3f308150a65be9f2b3776879b4cdc', 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên', '1', 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên');
INSERT INTO `admin_translate` VALUES ('54c5e0cb2f195f47de74243385314e49', 'Nội dung chi tiết :', '1', 'Nội dung chi tiết :');
INSERT INTO `admin_translate` VALUES ('65d7b8f0308d6bed4b30d91af0d9acd9', 'Color name', '1', 'Color name');
INSERT INTO `admin_translate` VALUES ('ffa1c67d17bb3b3ccca2e626c7fa44a5', 'Mã code', '1', 'Mã code');
INSERT INTO `admin_translate` VALUES ('b718adec73e04ce3ec720dd11a06a308', 'ID', '1', 'ID');
INSERT INTO `admin_translate` VALUES ('fb1d215c46b16d004d71483d247eb176', 'Color Listing', '1', 'Color Listing');
INSERT INTO `admin_translate` VALUES ('3e6a625faef0050601371de85af0630d', 'Size name', '1', 'Size name');
INSERT INTO `admin_translate` VALUES ('aca0dd65318fb8532af8ae91b91fc1d6', 'Product Size', '1', 'Product Size');
INSERT INTO `admin_translate` VALUES ('6af2109688acf1234730ddc15f6a59c7', 'Product Color', '1', 'Product Color');
INSERT INTO `admin_translate` VALUES ('afe41e484cf5d42d74d1efce223871c2', 'You_have_successfully_deleted', '1', 'You_have_successfully_deleted');
INSERT INTO `admin_translate` VALUES ('793739f171c8356a3d8aa366bf455b5a', 'Chưa xem', '1', 'Chưa xem');
INSERT INTO `admin_translate` VALUES ('eb5e7b5ef24ecf4d42c4b74cb295dec5', 'Đã xem', '1', 'Đã xem');
INSERT INTO `admin_translate` VALUES ('b76918aa83cd0685b8e969ff61eff798', 'Đang chờ thanh toán', '1', 'Đang chờ thanh toán');
INSERT INTO `admin_translate` VALUES ('0c9c7bc3568d7fc304a41332711f57de', 'Đã thanh toán', '1', 'Đã thanh toán');
INSERT INTO `admin_translate` VALUES ('a2b57e36de565a06d07625fd9a0437aa', 'Hủy đơn hàng', '1', 'Hủy đơn hàng');
INSERT INTO `admin_translate` VALUES ('7153dddbbb8537dac3d3a1b2c6c51511', 'Show trang chủ', '1', 'Show trang chủ');
INSERT INTO `admin_translate` VALUES ('3fd6ae6527e079f8aacb1c5f58c585f0', 'News Listing', '1', 'News Listing');
INSERT INTO `admin_translate` VALUES ('b78a3223503896721cca1303f776159b', 'Title', '1', 'Title');
INSERT INTO `admin_translate` VALUES ('d96bc4fb209368557926632abc71b9e1', 'Từ khóa', '1', 'Từ khóa');
INSERT INTO `admin_translate` VALUES ('a240fa27925a635b08dc28c9e4f9216d', 'Order', '1', 'Order');
INSERT INTO `admin_translate` VALUES ('8ec67083eb05fd0b30175aa5b5a485f8', 'Thêm tin mới', '1', 'Thêm tin mới');
INSERT INTO `admin_translate` VALUES ('f98d981cdc7da27407fa8f66b9bca872', 'Link từ khóa', '1', 'Link từ khóa');
INSERT INTO `admin_translate` VALUES ('8514dc4860c43710f9e778b6b8ad740c', 'Tên hãng sản xuất', '1', 'Tên hãng sản xuất');
INSERT INTO `admin_translate` VALUES ('905e1df471ccc43c7e88dffdabf54f14', 'Thêm mới hỗ trợ', '1', 'Thêm mới hỗ trợ');
INSERT INTO `admin_translate` VALUES ('6329f6e769e5b65184ed00b305c74fc9', 'Tên thương hiệu', '1', 'Tên thương hiệu');
INSERT INTO `admin_translate` VALUES ('27cb367e4039f33f15e891503f2e43c1', 'Ảnh minh họa', '1', 'Ảnh minh họa');
INSERT INTO `admin_translate` VALUES ('4594b97fc007a53b3e727dff76015a92', 'Please_enter_Old_password', '1', 'Please_enter_Old_password');
INSERT INTO `admin_translate` VALUES ('a7c31c1d5e83cb69a35bb36a907abb44', 'Please_enter_New_password', '1', 'Please_enter_New_password');
INSERT INTO `admin_translate` VALUES ('5fad91acf14ca6920bb84cb7bd72c9c0', 'New_password_must_be_at_least_6_characters', '1', 'New_password_must_be_at_least_6_characters');
INSERT INTO `admin_translate` VALUES ('ff3806e80cd949908764c0b76cf0af83', 'Please_enter_confirm_password', '1', 'Please_enter_confirm_password');
INSERT INTO `admin_translate` VALUES ('afb12635ac15e867c3968bc1459532c1', 'New_password_and_confirm_password_is_not_correct', '1', 'New_password_and_confirm_password_is_not_correct');
INSERT INTO `admin_translate` VALUES ('01c643fcdc6979fe16e0aa1a492192e8', 'edit_the_information_management', '1', 'edit_the_information_management');
INSERT INTO `admin_translate` VALUES ('3bd27d5b87038caa242f4f4020245af6', 'Change_your_Email', '1', 'Change_your_Email');
INSERT INTO `admin_translate` VALUES ('3359f0cd1bbefac69fac3f4a2e7edd42', 'Change_your_password', '1', 'Change_your_password');
INSERT INTO `admin_translate` VALUES ('e1f42c3f43ff8b2826b3162969b9f459', 'User login', '1', 'User login');
INSERT INTO `admin_translate` VALUES ('01557660faa28f8ec65992d1ddbb7b79', 'Your Email', '1', 'Your Email');
INSERT INTO `admin_translate` VALUES ('c93ce0c5bad27f3f26a54a17d9e42657', 'Change email', '1', 'Change email');
INSERT INTO `admin_translate` VALUES ('09a5a307de671894b4276b0ea8577671', 'Reset all', '1', 'Reset all');
INSERT INTO `admin_translate` VALUES ('062d2b8bc2cfac7772c75ae8090fb9d1', 'Old password', '1', 'Old password');
INSERT INTO `admin_translate` VALUES ('6ab96a5df54aa6aae2bab9ea75ab76c9', 'Confirm new password', '1', 'Confirm new password');
INSERT INTO `admin_translate` VALUES ('353dabf6d46427c82546b9a493614ad0', 'Please_enter_new_password', '1', 'Please_enter_new_password');
INSERT INTO `admin_translate` VALUES ('161416d9bb2f251dab12b009051c85ac', 'Thương hiệu', '1', 'Thương hiệu');
INSERT INTO `admin_translate` VALUES ('adb21d16073a2d324a01b6ef0607efde', 'Đơn hàng', '1', 'Đơn hàng');
INSERT INTO `admin_translate` VALUES ('e995a5932fc16e06c02e2ec7e0985170', 'Kích thước', '1', 'Kích thước');
INSERT INTO `admin_translate` VALUES ('b4aca97983db90a346429bacf1a6b816', 'Màu sắc', '1', 'Màu sắc');
INSERT INTO `admin_translate` VALUES ('2135c7c4a14b20cd2651f2297e005bf5', 'Hướng dẫn - Thông tin', '1', 'Hướng dẫn - Thông tin');
INSERT INTO `admin_translate` VALUES ('d7a00df7478eb7c92d3fc2671f3566b3', 'Quản trị admin', '1', 'Quản trị admin');
INSERT INTO `admin_translate` VALUES ('6412d9f6e554ab2497733cbd65b32a91', 'Bình luận', '1', 'Bình luận');
INSERT INTO `admin_translate` VALUES ('ff7fa908ac437f52a7c25d0c557a1239', 'Show trang chủ mobile', '1', 'Show trang chủ mobile');
INSERT INTO `admin_translate` VALUES ('9b6bfbfb3454fe7d92450ee865a378ea', 'Thành viên', '1', 'Thành viên');
INSERT INTO `admin_translate` VALUES ('bc7539d31558061af4cda711ad4c3019', 'Quản lý TK admin', '1', 'Quản lý TK admin');
INSERT INTO `admin_translate` VALUES ('1c1bbfea26052dee2c2f36ad3a932a57', 'Cấu hình chung', '1', 'Cấu hình chung');
INSERT INTO `admin_translate` VALUES ('9424025c1f3cf8a94a26299bbd6b84a3', 'Danh sách thuộc tính', '1', 'Danh sách thuộc tính');
INSERT INTO `admin_translate` VALUES ('c65c66b68d2029f77c4b8fe396d3c625', 'Tên thuộc tính', '1', 'Tên thuộc tính');
INSERT INTO `admin_translate` VALUES ('8097576392e1ec1b0eddeec9d395ba11', 'Sửa thuộc tính', '1', 'Sửa thuộc tính');
INSERT INTO `admin_translate` VALUES ('33d1d25eb9e66e6489b7d8f7ec654555', 'You must delete all the levels of this tintuc', '1', 'You must delete all the levels of this tintuc');
INSERT INTO `admin_translate` VALUES ('e3a655782ad91656d7efc08fdc87bf2d', 'Thuộc tính', '1', 'Thuộc tính');
INSERT INTO `admin_translate` VALUES ('f7d5343e33c330dcecd1d398d20c8e92', 'Bạn đã nhân bản bản ghi thành công', '1', 'Bạn đã nhân bản bản ghi thành công');
INSERT INTO `admin_translate` VALUES ('9d84bb9ccb65219e6c192288551acc80', 'Gallery Listing', '1', 'Gallery Listing');
INSERT INTO `admin_translate` VALUES ('20fb4909f79587b6ff18d289d1beaec1', 'Link Youtube', '1', 'Link Youtube');
INSERT INTO `admin_translate` VALUES ('9781e777bdcb35ed5d2ac6404311c262', 'Gallery name', '1', 'Gallery name');
INSERT INTO `admin_translate` VALUES ('a900e8858b6816c6d5b63ea14bb2736a', 'Danh sách liên hệ', '1', 'Danh sách liên hệ');
INSERT INTO `admin_translate` VALUES ('4ed187a8456cf1175c69723437cf5cfd', 'Xóa', '1', 'Xóa');
INSERT INTO `admin_translate` VALUES ('9276b119c32c88c7647ef4d0d943ed0a', 'Liên hệ', '1', 'Liên hệ');
INSERT INTO `admin_translate` VALUES ('189f63f277cd73395561651753563065', 'Tags', '1', 'Tags');
INSERT INTO `admin_translate` VALUES ('5c93310dd0291e121181e830cdda892e', 'Gallery', '1', 'Gallery');
INSERT INTO `admin_translate` VALUES ('2f60a325dc1c491414e0e282d4166d12', 'Video Category', '1', 'Video Category');
INSERT INTO `admin_translate` VALUES ('b068931cc450442b63f5b3d276ea4297', 'name', '1', 'name');
INSERT INTO `admin_translate` VALUES ('d46870f1424e5824f8c82989bfbf228b', 'Video Listing', '1', 'Video Listing');
INSERT INTO `admin_translate` VALUES ('6782e6535f5bf83c04c3ecf5361965c8', 'Video name', '1', 'Video name');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_loginname` varchar(100) DEFAULT NULL,
  `adm_password` varchar(100) DEFAULT NULL,
  `adm_name` varchar(255) DEFAULT NULL,
  `adm_email` varchar(255) DEFAULT NULL,
  `adm_address` varchar(255) DEFAULT NULL,
  `adm_phone` varchar(255) DEFAULT NULL,
  `adm_mobile` varchar(255) DEFAULT NULL,
  `adm_cskh` tinyint(2) DEFAULT '0',
  `adm_job` tinyint(4) NOT NULL DEFAULT '0',
  `adm_access_module` varchar(255) DEFAULT NULL,
  `adm_access_category` text,
  `adm_date` int(11) DEFAULT '0',
  `adm_isadmin` tinyint(1) DEFAULT '0',
  `adm_active` tinyint(1) DEFAULT '1',
  `lang_id` tinyint(1) DEFAULT '1',
  `adm_delete` int(11) DEFAULT '0',
  `adm_all_category` int(1) DEFAULT NULL,
  `adm_edit_all` int(1) DEFAULT '0',
  `admin_id` int(1) DEFAULT '0',
  PRIMARY KEY (`adm_id`),
  KEY `adm_date` (`adm_date`),
  KEY `admin_id` (`admin_id`),
  KEY `lang_id` (`lang_id`),
  KEY `adm_isadmin` (`adm_isadmin`),
  KEY `adm_active` (`adm_active`),
  KEY `adm_cskh` (`adm_cskh`)
) ENGINE=MyISAM AUTO_INCREMENT=450 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Chí', 'diepcd@gmail.com', '300 Đường Láng - Đống Đa - HN', '(84-04) 784 7135 - (84-04) 219 2996', '095 330 8125', '0', '0', null, null, '0', '1', '1', '1', '0', null, '0', '0');
INSERT INTO `admin_user` VALUES ('442', 'chidd', 'c51d1bbc6a98a5f148a48764594ff883', '', '', null, '', null, '0', '0', null, '[2][3][9][10][11][12][13][14][15][17][21][123][39][40][54][111][124][133][148][149][4][18][19][20][23][74][112][121][122][150][5][16][125][6][8][22][24][25][26][33][126][127][128][152][155][151]', '0', '0', '1', '1', '1', '1', '0', '1');
INSERT INTO `admin_user` VALUES ('443', 'duyen', 'ed2b1f468c5f915f3f1cf75d7068baae', 'Duyen Nguyen', '', null, '', null, '0', '0', null, '[2][3][9][10][11][12][13][14][15][17][21][123][39][40][54][111][124][133][148][149][4][18][19][20][23][74][112][121][122][150][5][16][125][6][8][22][24][25][26][33][126][127][128][152][155][151]', '0', '0', '1', '1', '1', '0', '0', '442');
INSERT INTO `admin_user` VALUES ('444', 'xeototai', '80411776cebc2ac2585fa80f4b930f63', 'xeototai', 'xeototai@gmail.com', null, '0988999888', null, '0', '0', null, '[176][177][178][179][169][170][171][174][172][175][180][181][182][183][184][185][151][165][166][167][168]', '0', '0', '1', '1', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for admin_user_category
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_category`;
CREATE TABLE `admin_user_category` (
  `auc_admin_id` int(11) NOT NULL DEFAULT '0',
  `auc_category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_category
-- ----------------------------

-- ----------------------------
-- Table structure for admin_user_city
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_city`;
CREATE TABLE `admin_user_city` (
  `auct_admin_id` int(11) NOT NULL DEFAULT '0',
  `auct_city_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`auct_admin_id`,`auct_city_id`),
  KEY `auct_city_id` (`auct_city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_city
-- ----------------------------

-- ----------------------------
-- Table structure for admin_user_language
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_language`;
CREATE TABLE `admin_user_language` (
  `aul_admin_id` int(11) NOT NULL DEFAULT '0',
  `aul_lang_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aul_admin_id`,`aul_lang_id`),
  KEY `aul_lang_id` (`aul_lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_language
-- ----------------------------
INSERT INTO `admin_user_language` VALUES ('4', '1');
INSERT INTO `admin_user_language` VALUES ('5', '1');
INSERT INTO `admin_user_language` VALUES ('5', '2');
INSERT INTO `admin_user_language` VALUES ('6', '1');
INSERT INTO `admin_user_language` VALUES ('7', '1');
INSERT INTO `admin_user_language` VALUES ('8', '1');
INSERT INTO `admin_user_language` VALUES ('8', '2');
INSERT INTO `admin_user_language` VALUES ('9', '1');
INSERT INTO `admin_user_language` VALUES ('10', '1');
INSERT INTO `admin_user_language` VALUES ('11', '1');
INSERT INTO `admin_user_language` VALUES ('12', '1');
INSERT INTO `admin_user_language` VALUES ('13', '1');
INSERT INTO `admin_user_language` VALUES ('14', '1');
INSERT INTO `admin_user_language` VALUES ('15', '1');
INSERT INTO `admin_user_language` VALUES ('16', '1');
INSERT INTO `admin_user_language` VALUES ('17', '1');
INSERT INTO `admin_user_language` VALUES ('18', '1');
INSERT INTO `admin_user_language` VALUES ('19', '1');
INSERT INTO `admin_user_language` VALUES ('20', '1');
INSERT INTO `admin_user_language` VALUES ('21', '1');
INSERT INTO `admin_user_language` VALUES ('22', '1');
INSERT INTO `admin_user_language` VALUES ('23', '1');
INSERT INTO `admin_user_language` VALUES ('24', '1');
INSERT INTO `admin_user_language` VALUES ('25', '1');
INSERT INTO `admin_user_language` VALUES ('26', '1');
INSERT INTO `admin_user_language` VALUES ('27', '1');
INSERT INTO `admin_user_language` VALUES ('28', '1');
INSERT INTO `admin_user_language` VALUES ('29', '1');
INSERT INTO `admin_user_language` VALUES ('30', '1');
INSERT INTO `admin_user_language` VALUES ('31', '1');
INSERT INTO `admin_user_language` VALUES ('32', '1');
INSERT INTO `admin_user_language` VALUES ('33', '1');
INSERT INTO `admin_user_language` VALUES ('33', '2');
INSERT INTO `admin_user_language` VALUES ('35', '1');
INSERT INTO `admin_user_language` VALUES ('36', '1');
INSERT INTO `admin_user_language` VALUES ('36', '2');
INSERT INTO `admin_user_language` VALUES ('37', '1');
INSERT INTO `admin_user_language` VALUES ('39', '1');
INSERT INTO `admin_user_language` VALUES ('40', '1');
INSERT INTO `admin_user_language` VALUES ('41', '1');
INSERT INTO `admin_user_language` VALUES ('42', '1');
INSERT INTO `admin_user_language` VALUES ('43', '1');
INSERT INTO `admin_user_language` VALUES ('44', '1');
INSERT INTO `admin_user_language` VALUES ('46', '1');
INSERT INTO `admin_user_language` VALUES ('48', '1');
INSERT INTO `admin_user_language` VALUES ('49', '1');
INSERT INTO `admin_user_language` VALUES ('49', '2');
INSERT INTO `admin_user_language` VALUES ('50', '1');
INSERT INTO `admin_user_language` VALUES ('51', '1');
INSERT INTO `admin_user_language` VALUES ('52', '1');
INSERT INTO `admin_user_language` VALUES ('53', '1');
INSERT INTO `admin_user_language` VALUES ('55', '1');
INSERT INTO `admin_user_language` VALUES ('55', '2');
INSERT INTO `admin_user_language` VALUES ('56', '1');
INSERT INTO `admin_user_language` VALUES ('57', '1');
INSERT INTO `admin_user_language` VALUES ('57', '2');
INSERT INTO `admin_user_language` VALUES ('58', '1');
INSERT INTO `admin_user_language` VALUES ('58', '2');
INSERT INTO `admin_user_language` VALUES ('59', '1');
INSERT INTO `admin_user_language` VALUES ('60', '1');
INSERT INTO `admin_user_language` VALUES ('61', '1');
INSERT INTO `admin_user_language` VALUES ('62', '1');
INSERT INTO `admin_user_language` VALUES ('65', '1');
INSERT INTO `admin_user_language` VALUES ('65', '2');
INSERT INTO `admin_user_language` VALUES ('66', '1');
INSERT INTO `admin_user_language` VALUES ('66', '2');
INSERT INTO `admin_user_language` VALUES ('67', '1');
INSERT INTO `admin_user_language` VALUES ('68', '1');
INSERT INTO `admin_user_language` VALUES ('69', '1');
INSERT INTO `admin_user_language` VALUES ('70', '1');
INSERT INTO `admin_user_language` VALUES ('72', '1');
INSERT INTO `admin_user_language` VALUES ('73', '1');
INSERT INTO `admin_user_language` VALUES ('74', '1');
INSERT INTO `admin_user_language` VALUES ('75', '1');
INSERT INTO `admin_user_language` VALUES ('76', '1');
INSERT INTO `admin_user_language` VALUES ('77', '1');
INSERT INTO `admin_user_language` VALUES ('78', '1');
INSERT INTO `admin_user_language` VALUES ('79', '1');
INSERT INTO `admin_user_language` VALUES ('80', '1');
INSERT INTO `admin_user_language` VALUES ('81', '1');
INSERT INTO `admin_user_language` VALUES ('82', '1');
INSERT INTO `admin_user_language` VALUES ('83', '1');
INSERT INTO `admin_user_language` VALUES ('85', '1');
INSERT INTO `admin_user_language` VALUES ('86', '1');
INSERT INTO `admin_user_language` VALUES ('87', '1');
INSERT INTO `admin_user_language` VALUES ('88', '1');
INSERT INTO `admin_user_language` VALUES ('89', '1');
INSERT INTO `admin_user_language` VALUES ('90', '1');
INSERT INTO `admin_user_language` VALUES ('91', '1');
INSERT INTO `admin_user_language` VALUES ('92', '1');
INSERT INTO `admin_user_language` VALUES ('93', '1');
INSERT INTO `admin_user_language` VALUES ('94', '1');
INSERT INTO `admin_user_language` VALUES ('95', '1');
INSERT INTO `admin_user_language` VALUES ('96', '1');
INSERT INTO `admin_user_language` VALUES ('97', '1');
INSERT INTO `admin_user_language` VALUES ('98', '1');
INSERT INTO `admin_user_language` VALUES ('99', '1');
INSERT INTO `admin_user_language` VALUES ('100', '1');
INSERT INTO `admin_user_language` VALUES ('101', '1');
INSERT INTO `admin_user_language` VALUES ('102', '1');
INSERT INTO `admin_user_language` VALUES ('103', '1');
INSERT INTO `admin_user_language` VALUES ('104', '1');
INSERT INTO `admin_user_language` VALUES ('105', '1');
INSERT INTO `admin_user_language` VALUES ('106', '1');
INSERT INTO `admin_user_language` VALUES ('107', '1');
INSERT INTO `admin_user_language` VALUES ('108', '1');
INSERT INTO `admin_user_language` VALUES ('109', '1');
INSERT INTO `admin_user_language` VALUES ('110', '1');
INSERT INTO `admin_user_language` VALUES ('111', '1');
INSERT INTO `admin_user_language` VALUES ('112', '1');
INSERT INTO `admin_user_language` VALUES ('113', '1');
INSERT INTO `admin_user_language` VALUES ('114', '1');
INSERT INTO `admin_user_language` VALUES ('115', '1');
INSERT INTO `admin_user_language` VALUES ('116', '1');
INSERT INTO `admin_user_language` VALUES ('117', '1');
INSERT INTO `admin_user_language` VALUES ('118', '1');
INSERT INTO `admin_user_language` VALUES ('119', '1');
INSERT INTO `admin_user_language` VALUES ('120', '1');
INSERT INTO `admin_user_language` VALUES ('121', '1');
INSERT INTO `admin_user_language` VALUES ('122', '1');
INSERT INTO `admin_user_language` VALUES ('123', '1');
INSERT INTO `admin_user_language` VALUES ('124', '1');
INSERT INTO `admin_user_language` VALUES ('125', '1');
INSERT INTO `admin_user_language` VALUES ('126', '1');
INSERT INTO `admin_user_language` VALUES ('127', '1');
INSERT INTO `admin_user_language` VALUES ('128', '1');
INSERT INTO `admin_user_language` VALUES ('129', '1');
INSERT INTO `admin_user_language` VALUES ('130', '1');
INSERT INTO `admin_user_language` VALUES ('131', '1');
INSERT INTO `admin_user_language` VALUES ('132', '1');
INSERT INTO `admin_user_language` VALUES ('133', '1');
INSERT INTO `admin_user_language` VALUES ('134', '1');
INSERT INTO `admin_user_language` VALUES ('135', '1');
INSERT INTO `admin_user_language` VALUES ('136', '1');
INSERT INTO `admin_user_language` VALUES ('137', '1');
INSERT INTO `admin_user_language` VALUES ('138', '1');
INSERT INTO `admin_user_language` VALUES ('139', '1');
INSERT INTO `admin_user_language` VALUES ('140', '1');
INSERT INTO `admin_user_language` VALUES ('141', '1');
INSERT INTO `admin_user_language` VALUES ('142', '1');
INSERT INTO `admin_user_language` VALUES ('143', '1');
INSERT INTO `admin_user_language` VALUES ('144', '1');
INSERT INTO `admin_user_language` VALUES ('145', '1');
INSERT INTO `admin_user_language` VALUES ('146', '1');
INSERT INTO `admin_user_language` VALUES ('147', '1');
INSERT INTO `admin_user_language` VALUES ('148', '1');
INSERT INTO `admin_user_language` VALUES ('149', '1');
INSERT INTO `admin_user_language` VALUES ('150', '1');
INSERT INTO `admin_user_language` VALUES ('151', '1');
INSERT INTO `admin_user_language` VALUES ('152', '1');
INSERT INTO `admin_user_language` VALUES ('153', '1');
INSERT INTO `admin_user_language` VALUES ('154', '1');
INSERT INTO `admin_user_language` VALUES ('155', '1');
INSERT INTO `admin_user_language` VALUES ('156', '1');
INSERT INTO `admin_user_language` VALUES ('157', '1');
INSERT INTO `admin_user_language` VALUES ('158', '1');
INSERT INTO `admin_user_language` VALUES ('159', '1');
INSERT INTO `admin_user_language` VALUES ('160', '1');
INSERT INTO `admin_user_language` VALUES ('161', '1');
INSERT INTO `admin_user_language` VALUES ('162', '1');
INSERT INTO `admin_user_language` VALUES ('163', '1');
INSERT INTO `admin_user_language` VALUES ('164', '1');
INSERT INTO `admin_user_language` VALUES ('165', '1');
INSERT INTO `admin_user_language` VALUES ('166', '1');
INSERT INTO `admin_user_language` VALUES ('167', '1');
INSERT INTO `admin_user_language` VALUES ('168', '1');
INSERT INTO `admin_user_language` VALUES ('169', '1');
INSERT INTO `admin_user_language` VALUES ('170', '1');
INSERT INTO `admin_user_language` VALUES ('171', '1');
INSERT INTO `admin_user_language` VALUES ('172', '1');
INSERT INTO `admin_user_language` VALUES ('173', '1');
INSERT INTO `admin_user_language` VALUES ('174', '1');
INSERT INTO `admin_user_language` VALUES ('175', '1');
INSERT INTO `admin_user_language` VALUES ('176', '1');
INSERT INTO `admin_user_language` VALUES ('177', '1');
INSERT INTO `admin_user_language` VALUES ('178', '1');
INSERT INTO `admin_user_language` VALUES ('179', '1');
INSERT INTO `admin_user_language` VALUES ('180', '1');
INSERT INTO `admin_user_language` VALUES ('181', '1');
INSERT INTO `admin_user_language` VALUES ('182', '1');
INSERT INTO `admin_user_language` VALUES ('183', '1');
INSERT INTO `admin_user_language` VALUES ('184', '1');
INSERT INTO `admin_user_language` VALUES ('185', '1');
INSERT INTO `admin_user_language` VALUES ('186', '1');
INSERT INTO `admin_user_language` VALUES ('187', '1');
INSERT INTO `admin_user_language` VALUES ('188', '1');
INSERT INTO `admin_user_language` VALUES ('189', '1');
INSERT INTO `admin_user_language` VALUES ('190', '1');
INSERT INTO `admin_user_language` VALUES ('191', '1');
INSERT INTO `admin_user_language` VALUES ('192', '1');
INSERT INTO `admin_user_language` VALUES ('193', '1');
INSERT INTO `admin_user_language` VALUES ('194', '1');
INSERT INTO `admin_user_language` VALUES ('195', '1');
INSERT INTO `admin_user_language` VALUES ('196', '1');
INSERT INTO `admin_user_language` VALUES ('197', '1');
INSERT INTO `admin_user_language` VALUES ('198', '1');
INSERT INTO `admin_user_language` VALUES ('199', '1');
INSERT INTO `admin_user_language` VALUES ('200', '1');
INSERT INTO `admin_user_language` VALUES ('201', '1');
INSERT INTO `admin_user_language` VALUES ('202', '1');
INSERT INTO `admin_user_language` VALUES ('203', '1');
INSERT INTO `admin_user_language` VALUES ('204', '1');
INSERT INTO `admin_user_language` VALUES ('205', '1');
INSERT INTO `admin_user_language` VALUES ('206', '1');
INSERT INTO `admin_user_language` VALUES ('207', '1');
INSERT INTO `admin_user_language` VALUES ('208', '1');
INSERT INTO `admin_user_language` VALUES ('209', '1');
INSERT INTO `admin_user_language` VALUES ('210', '1');
INSERT INTO `admin_user_language` VALUES ('211', '1');
INSERT INTO `admin_user_language` VALUES ('212', '1');
INSERT INTO `admin_user_language` VALUES ('213', '1');
INSERT INTO `admin_user_language` VALUES ('214', '1');
INSERT INTO `admin_user_language` VALUES ('215', '1');
INSERT INTO `admin_user_language` VALUES ('216', '1');
INSERT INTO `admin_user_language` VALUES ('217', '1');
INSERT INTO `admin_user_language` VALUES ('218', '1');
INSERT INTO `admin_user_language` VALUES ('219', '1');
INSERT INTO `admin_user_language` VALUES ('220', '1');
INSERT INTO `admin_user_language` VALUES ('221', '1');
INSERT INTO `admin_user_language` VALUES ('222', '1');
INSERT INTO `admin_user_language` VALUES ('223', '1');
INSERT INTO `admin_user_language` VALUES ('224', '1');
INSERT INTO `admin_user_language` VALUES ('225', '1');
INSERT INTO `admin_user_language` VALUES ('226', '1');
INSERT INTO `admin_user_language` VALUES ('227', '1');
INSERT INTO `admin_user_language` VALUES ('228', '1');
INSERT INTO `admin_user_language` VALUES ('229', '1');
INSERT INTO `admin_user_language` VALUES ('230', '1');
INSERT INTO `admin_user_language` VALUES ('231', '1');
INSERT INTO `admin_user_language` VALUES ('232', '1');
INSERT INTO `admin_user_language` VALUES ('233', '1');
INSERT INTO `admin_user_language` VALUES ('234', '1');
INSERT INTO `admin_user_language` VALUES ('235', '1');
INSERT INTO `admin_user_language` VALUES ('236', '1');
INSERT INTO `admin_user_language` VALUES ('237', '1');
INSERT INTO `admin_user_language` VALUES ('238', '1');
INSERT INTO `admin_user_language` VALUES ('239', '1');
INSERT INTO `admin_user_language` VALUES ('240', '1');
INSERT INTO `admin_user_language` VALUES ('241', '1');
INSERT INTO `admin_user_language` VALUES ('242', '1');
INSERT INTO `admin_user_language` VALUES ('243', '1');
INSERT INTO `admin_user_language` VALUES ('244', '1');
INSERT INTO `admin_user_language` VALUES ('245', '1');
INSERT INTO `admin_user_language` VALUES ('246', '1');
INSERT INTO `admin_user_language` VALUES ('247', '1');
INSERT INTO `admin_user_language` VALUES ('248', '1');
INSERT INTO `admin_user_language` VALUES ('249', '1');
INSERT INTO `admin_user_language` VALUES ('250', '1');
INSERT INTO `admin_user_language` VALUES ('251', '1');
INSERT INTO `admin_user_language` VALUES ('252', '1');
INSERT INTO `admin_user_language` VALUES ('253', '1');
INSERT INTO `admin_user_language` VALUES ('254', '1');
INSERT INTO `admin_user_language` VALUES ('255', '1');
INSERT INTO `admin_user_language` VALUES ('256', '1');
INSERT INTO `admin_user_language` VALUES ('257', '1');
INSERT INTO `admin_user_language` VALUES ('258', '1');
INSERT INTO `admin_user_language` VALUES ('259', '1');
INSERT INTO `admin_user_language` VALUES ('260', '1');
INSERT INTO `admin_user_language` VALUES ('261', '1');
INSERT INTO `admin_user_language` VALUES ('262', '1');
INSERT INTO `admin_user_language` VALUES ('263', '1');
INSERT INTO `admin_user_language` VALUES ('264', '1');
INSERT INTO `admin_user_language` VALUES ('265', '1');
INSERT INTO `admin_user_language` VALUES ('266', '1');
INSERT INTO `admin_user_language` VALUES ('267', '1');
INSERT INTO `admin_user_language` VALUES ('268', '1');
INSERT INTO `admin_user_language` VALUES ('269', '1');
INSERT INTO `admin_user_language` VALUES ('270', '1');
INSERT INTO `admin_user_language` VALUES ('271', '1');
INSERT INTO `admin_user_language` VALUES ('272', '1');
INSERT INTO `admin_user_language` VALUES ('273', '1');
INSERT INTO `admin_user_language` VALUES ('274', '1');
INSERT INTO `admin_user_language` VALUES ('275', '1');
INSERT INTO `admin_user_language` VALUES ('276', '1');
INSERT INTO `admin_user_language` VALUES ('277', '1');
INSERT INTO `admin_user_language` VALUES ('278', '1');
INSERT INTO `admin_user_language` VALUES ('279', '1');
INSERT INTO `admin_user_language` VALUES ('280', '1');
INSERT INTO `admin_user_language` VALUES ('281', '1');
INSERT INTO `admin_user_language` VALUES ('282', '1');
INSERT INTO `admin_user_language` VALUES ('283', '1');
INSERT INTO `admin_user_language` VALUES ('284', '1');
INSERT INTO `admin_user_language` VALUES ('285', '1');
INSERT INTO `admin_user_language` VALUES ('286', '1');
INSERT INTO `admin_user_language` VALUES ('287', '1');
INSERT INTO `admin_user_language` VALUES ('288', '1');
INSERT INTO `admin_user_language` VALUES ('289', '1');
INSERT INTO `admin_user_language` VALUES ('290', '1');
INSERT INTO `admin_user_language` VALUES ('291', '1');
INSERT INTO `admin_user_language` VALUES ('292', '1');
INSERT INTO `admin_user_language` VALUES ('293', '1');
INSERT INTO `admin_user_language` VALUES ('294', '1');
INSERT INTO `admin_user_language` VALUES ('295', '1');
INSERT INTO `admin_user_language` VALUES ('296', '1');
INSERT INTO `admin_user_language` VALUES ('297', '1');
INSERT INTO `admin_user_language` VALUES ('298', '1');
INSERT INTO `admin_user_language` VALUES ('299', '1');
INSERT INTO `admin_user_language` VALUES ('300', '1');
INSERT INTO `admin_user_language` VALUES ('301', '1');
INSERT INTO `admin_user_language` VALUES ('302', '1');
INSERT INTO `admin_user_language` VALUES ('303', '1');
INSERT INTO `admin_user_language` VALUES ('304', '1');
INSERT INTO `admin_user_language` VALUES ('305', '1');
INSERT INTO `admin_user_language` VALUES ('306', '1');
INSERT INTO `admin_user_language` VALUES ('307', '1');
INSERT INTO `admin_user_language` VALUES ('308', '1');
INSERT INTO `admin_user_language` VALUES ('309', '1');
INSERT INTO `admin_user_language` VALUES ('310', '1');
INSERT INTO `admin_user_language` VALUES ('311', '1');
INSERT INTO `admin_user_language` VALUES ('312', '1');
INSERT INTO `admin_user_language` VALUES ('313', '1');
INSERT INTO `admin_user_language` VALUES ('314', '1');
INSERT INTO `admin_user_language` VALUES ('315', '1');
INSERT INTO `admin_user_language` VALUES ('316', '1');
INSERT INTO `admin_user_language` VALUES ('317', '1');
INSERT INTO `admin_user_language` VALUES ('318', '1');
INSERT INTO `admin_user_language` VALUES ('319', '1');
INSERT INTO `admin_user_language` VALUES ('320', '1');
INSERT INTO `admin_user_language` VALUES ('321', '1');
INSERT INTO `admin_user_language` VALUES ('322', '1');
INSERT INTO `admin_user_language` VALUES ('323', '1');
INSERT INTO `admin_user_language` VALUES ('324', '1');
INSERT INTO `admin_user_language` VALUES ('325', '1');
INSERT INTO `admin_user_language` VALUES ('326', '1');
INSERT INTO `admin_user_language` VALUES ('327', '1');
INSERT INTO `admin_user_language` VALUES ('328', '1');
INSERT INTO `admin_user_language` VALUES ('329', '1');
INSERT INTO `admin_user_language` VALUES ('330', '1');
INSERT INTO `admin_user_language` VALUES ('331', '1');
INSERT INTO `admin_user_language` VALUES ('332', '1');
INSERT INTO `admin_user_language` VALUES ('333', '1');
INSERT INTO `admin_user_language` VALUES ('334', '1');
INSERT INTO `admin_user_language` VALUES ('335', '1');
INSERT INTO `admin_user_language` VALUES ('336', '1');
INSERT INTO `admin_user_language` VALUES ('337', '1');
INSERT INTO `admin_user_language` VALUES ('338', '1');
INSERT INTO `admin_user_language` VALUES ('339', '1');
INSERT INTO `admin_user_language` VALUES ('340', '1');
INSERT INTO `admin_user_language` VALUES ('341', '1');
INSERT INTO `admin_user_language` VALUES ('342', '1');
INSERT INTO `admin_user_language` VALUES ('343', '1');
INSERT INTO `admin_user_language` VALUES ('344', '1');
INSERT INTO `admin_user_language` VALUES ('345', '1');
INSERT INTO `admin_user_language` VALUES ('346', '1');
INSERT INTO `admin_user_language` VALUES ('347', '1');
INSERT INTO `admin_user_language` VALUES ('348', '1');
INSERT INTO `admin_user_language` VALUES ('349', '1');
INSERT INTO `admin_user_language` VALUES ('350', '1');
INSERT INTO `admin_user_language` VALUES ('351', '1');
INSERT INTO `admin_user_language` VALUES ('352', '1');
INSERT INTO `admin_user_language` VALUES ('353', '1');
INSERT INTO `admin_user_language` VALUES ('354', '1');
INSERT INTO `admin_user_language` VALUES ('355', '1');
INSERT INTO `admin_user_language` VALUES ('356', '1');
INSERT INTO `admin_user_language` VALUES ('357', '1');
INSERT INTO `admin_user_language` VALUES ('358', '1');
INSERT INTO `admin_user_language` VALUES ('359', '1');
INSERT INTO `admin_user_language` VALUES ('360', '1');
INSERT INTO `admin_user_language` VALUES ('361', '1');
INSERT INTO `admin_user_language` VALUES ('362', '1');
INSERT INTO `admin_user_language` VALUES ('363', '1');
INSERT INTO `admin_user_language` VALUES ('364', '1');
INSERT INTO `admin_user_language` VALUES ('365', '1');
INSERT INTO `admin_user_language` VALUES ('366', '1');
INSERT INTO `admin_user_language` VALUES ('367', '1');
INSERT INTO `admin_user_language` VALUES ('368', '1');
INSERT INTO `admin_user_language` VALUES ('369', '1');
INSERT INTO `admin_user_language` VALUES ('370', '1');
INSERT INTO `admin_user_language` VALUES ('371', '1');
INSERT INTO `admin_user_language` VALUES ('372', '1');
INSERT INTO `admin_user_language` VALUES ('373', '1');
INSERT INTO `admin_user_language` VALUES ('374', '1');
INSERT INTO `admin_user_language` VALUES ('375', '1');
INSERT INTO `admin_user_language` VALUES ('376', '1');
INSERT INTO `admin_user_language` VALUES ('377', '1');
INSERT INTO `admin_user_language` VALUES ('378', '1');
INSERT INTO `admin_user_language` VALUES ('379', '1');
INSERT INTO `admin_user_language` VALUES ('380', '1');
INSERT INTO `admin_user_language` VALUES ('381', '1');
INSERT INTO `admin_user_language` VALUES ('382', '1');
INSERT INTO `admin_user_language` VALUES ('383', '1');
INSERT INTO `admin_user_language` VALUES ('384', '1');
INSERT INTO `admin_user_language` VALUES ('385', '1');
INSERT INTO `admin_user_language` VALUES ('386', '1');
INSERT INTO `admin_user_language` VALUES ('387', '1');
INSERT INTO `admin_user_language` VALUES ('388', '1');
INSERT INTO `admin_user_language` VALUES ('389', '1');
INSERT INTO `admin_user_language` VALUES ('390', '1');
INSERT INTO `admin_user_language` VALUES ('391', '1');
INSERT INTO `admin_user_language` VALUES ('392', '1');
INSERT INTO `admin_user_language` VALUES ('393', '1');
INSERT INTO `admin_user_language` VALUES ('394', '1');
INSERT INTO `admin_user_language` VALUES ('395', '1');
INSERT INTO `admin_user_language` VALUES ('396', '1');
INSERT INTO `admin_user_language` VALUES ('397', '1');
INSERT INTO `admin_user_language` VALUES ('398', '1');
INSERT INTO `admin_user_language` VALUES ('399', '1');
INSERT INTO `admin_user_language` VALUES ('400', '1');
INSERT INTO `admin_user_language` VALUES ('401', '1');
INSERT INTO `admin_user_language` VALUES ('402', '1');
INSERT INTO `admin_user_language` VALUES ('403', '1');
INSERT INTO `admin_user_language` VALUES ('404', '1');
INSERT INTO `admin_user_language` VALUES ('405', '1');
INSERT INTO `admin_user_language` VALUES ('406', '1');
INSERT INTO `admin_user_language` VALUES ('407', '1');
INSERT INTO `admin_user_language` VALUES ('408', '1');
INSERT INTO `admin_user_language` VALUES ('409', '1');
INSERT INTO `admin_user_language` VALUES ('410', '1');
INSERT INTO `admin_user_language` VALUES ('411', '1');
INSERT INTO `admin_user_language` VALUES ('412', '1');
INSERT INTO `admin_user_language` VALUES ('413', '1');
INSERT INTO `admin_user_language` VALUES ('414', '1');
INSERT INTO `admin_user_language` VALUES ('415', '1');
INSERT INTO `admin_user_language` VALUES ('416', '1');
INSERT INTO `admin_user_language` VALUES ('417', '1');
INSERT INTO `admin_user_language` VALUES ('418', '1');
INSERT INTO `admin_user_language` VALUES ('419', '1');
INSERT INTO `admin_user_language` VALUES ('420', '1');
INSERT INTO `admin_user_language` VALUES ('421', '1');
INSERT INTO `admin_user_language` VALUES ('422', '1');
INSERT INTO `admin_user_language` VALUES ('423', '1');
INSERT INTO `admin_user_language` VALUES ('424', '1');
INSERT INTO `admin_user_language` VALUES ('425', '1');
INSERT INTO `admin_user_language` VALUES ('426', '1');
INSERT INTO `admin_user_language` VALUES ('427', '1');
INSERT INTO `admin_user_language` VALUES ('428', '1');
INSERT INTO `admin_user_language` VALUES ('429', '1');
INSERT INTO `admin_user_language` VALUES ('430', '1');
INSERT INTO `admin_user_language` VALUES ('431', '1');
INSERT INTO `admin_user_language` VALUES ('432', '1');
INSERT INTO `admin_user_language` VALUES ('433', '1');
INSERT INTO `admin_user_language` VALUES ('434', '1');
INSERT INTO `admin_user_language` VALUES ('435', '1');
INSERT INTO `admin_user_language` VALUES ('436', '1');
INSERT INTO `admin_user_language` VALUES ('437', '1');
INSERT INTO `admin_user_language` VALUES ('438', '1');
INSERT INTO `admin_user_language` VALUES ('439', '1');
INSERT INTO `admin_user_language` VALUES ('440', '1');
INSERT INTO `admin_user_language` VALUES ('441', '1');
INSERT INTO `admin_user_language` VALUES ('442', '1');
INSERT INTO `admin_user_language` VALUES ('443', '1');
INSERT INTO `admin_user_language` VALUES ('444', '1');

-- ----------------------------
-- Table structure for admin_user_right
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_right`;
CREATE TABLE `admin_user_right` (
  `adu_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `adu_admin_module_id` int(11) NOT NULL DEFAULT '0',
  `adu_add` int(1) DEFAULT '0',
  `adu_edit` int(1) DEFAULT '0',
  `adu_delete` int(1) DEFAULT '0',
  PRIMARY KEY (`adu_admin_id`,`adu_admin_module_id`)
) ENGINE=MyISAM AUTO_INCREMENT=450 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_right
-- ----------------------------
INSERT INTO `admin_user_right` VALUES ('438', '19', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('439', '67', '1', '0', '0');
INSERT INTO `admin_user_right` VALUES ('439', '35', '1', '0', '0');
INSERT INTO `admin_user_right` VALUES ('439', '26', '1', '0', '0');
INSERT INTO `admin_user_right` VALUES ('439', '24', '0', '0', '0');
INSERT INTO `admin_user_right` VALUES ('440', '91', '1', '1', '0');
INSERT INTO `admin_user_right` VALUES ('440', '23', '1', '1', '0');
INSERT INTO `admin_user_right` VALUES ('440', '19', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '96', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '95', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '92', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '91', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '89', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '88', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '67', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '35', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '26', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '24', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '23', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '19', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '14', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('441', '11', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '11', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '14', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '19', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '23', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '24', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '26', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '35', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '67', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '91', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '92', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '95', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '96', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('443', '92', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('442', '97', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '11', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '19', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '23', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '24', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '26', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '35', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '67', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '91', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '92', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '95', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '96', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '97', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '98', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '99', '1', '1', '1');
INSERT INTO `admin_user_right` VALUES ('444', '100', '1', '1', '1');

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `ban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ban_name` varchar(255) DEFAULT NULL,
  `ban_picture` varchar(255) DEFAULT NULL,
  `ban_link` text,
  `ban_description` text,
  `ban_target` varchar(255) DEFAULT '_blank',
  `ban_type` int(11) DEFAULT '0',
  `ban_position` tinyint(2) DEFAULT '0',
  `ban_date` int(11) DEFAULT '0',
  `ban_active` tinyint(4) NOT NULL DEFAULT '0',
  `ban_order` int(11) NOT NULL DEFAULT '0',
  `ban_end_time` int(11) DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `lang_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ban_id`),
  KEY `ban_order` (`ban_order`),
  KEY `ban_active` (`ban_active`),
  KEY `ban_position` (`ban_position`),
  KEY `ban_type` (`ban_type`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES ('55', 'Ô tô Giải Phóng', 'pth1482534751.jpg', 'http://xeototai.vn/tintuc/xe-gan-cau-id167', '', '_blank', '1', '1', '1482534751', '1', '0', '0', '444', '1');
INSERT INTO `banners` VALUES ('46', 'Ô tô Giải Phóng', 'yjq1482058804.jpg', 'http://xeototai.vn/tintuc/xe-tai-co-trung-id178', '', '_blank', '1', '1', '1482058804', '1', '0', '0', '1', '1');
INSERT INTO `banners` VALUES ('47', 'Ô tô Giải Phóng', 'jif1482058823.jpg', 'http://xeototai.vn/tintuc/xe-tai-co-trung-id178', '', '_blank', '1', '1', '1482058823', '0', '0', '0', '1', '1');
INSERT INTO `banners` VALUES ('48', 'Ô tô Giải Phóng', 'dyx1482058866.jpg', 'http://xeototai.vn/tintuc/xe-tai-hang-nang-id179', '', '_blank', '1', '1', '1482058866', '1', '0', '0', '1', '1');
INSERT INTO `banners` VALUES ('49', 'Ô tô Giải Phóng', 'tnn1482058876.jpg', 'http://xeototai.vn/tintuc/xe-tai-hang-nang-id179', '', '_blank', '1', '1', '1482058876', '0', '0', '0', '1', '1');
INSERT INTO `banners` VALUES ('50', 'Ô tô Giải Phóng', 'euz1482059720.jpg', 'http://xeototai.vn/tintuc/xe-tai-nho-id177', '', '_blank', '1', '9', '1482059720', '1', '0', '0', '444', '1');
INSERT INTO `banners` VALUES ('51', 'Ô tô Giải Phóng', 'obn1482059798.jpg', 'http://xeototai.vn/tintuc/xe-tai-co-trung-id178', '', '_blank', '1', '9', '1482059798', '1', '0', '0', '444', '1');
INSERT INTO `banners` VALUES ('52', 'Ô tô Giải Phóng', 'epy1482059813.jpg', 'http://xeototai.vn/tintuc/xe-tai-co-trung-id178', '', '_blank', '1', '9', '1482059813', '0', '0', '0', '444', '1');
INSERT INTO `banners` VALUES ('53', 'Ô tô Giải Phóng', 'utm1482059852.jpg', 'http://xeototai.vn/tintuc/xe-tai-hang-nang-id179', '', '_blank', '1', '9', '1482059852', '1', '0', '0', '444', '1');
INSERT INTO `banners` VALUES ('54', 'Ô tô Giải Phóng', 'wgr1482059862.jpg', 'http://xeototai.vn/tintuc/xe-tai-hang-nang-id179', '', '_blank', '1', '9', '1482059862', '0', '0', '0', '444', '1');
INSERT INTO `banners` VALUES ('45', 'Ô tô Giải Phóng - Xe tải nhỏ', 'bdc1481868532.jpg', 'http://xeototai.vn/tintuc/xe-tai-nho-id177', 'Công ty CP XNK Ô tô Giải Phóng, Chuyên kinh doanh các dòng xe tải nhỏ đủ kích cỡ đến từ nhiều hãng sản xuất và lắp ráp như Hyundai Đồng Vàng, Veam Motor, Hyundai Đô Thành như Hyundai HD72 Nhập khẩu, Hyundai HD78 Nhập khẩu, Hyundai HD65 Nhập khẩu, Hyundai Porter H100... Đến với công ty chúng tôi, quý khách hàng sẽ được hưởng những dịch vụ hậu mãi tốt nhất, giá cả tốt nhất thị trường', '_blank', '1', '1', '1481868532', '1', '0', '0', '1', '1');
INSERT INTO `banners` VALUES ('56', 'Xe chuyên dụng, xe nâng đầu, xe bồn', 'aig1482958655.jpg', 'http://xeototai.vn/tintuc/xe-dau-keo-id188', '', '_blank', '1', '1', '1482958655', '1', '0', '0', '1', '1');
INSERT INTO `banners` VALUES ('57', 'Xe chuyên dụng, xe nâng đầu, xe bồn', 'ems1482958668.jpg', 'http://xeototai.vn/tintuc/xe-dau-keo-id188', '', '_blank', '1', '1', '1482958668', '1', '0', '0', '1', '1');

-- ----------------------------
-- Table structure for categories_multi
-- ----------------------------
DROP TABLE IF EXISTS `categories_multi`;
CREATE TABLE `categories_multi` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_rewrite` varchar(266) DEFAULT NULL,
  `cat_order` int(5) DEFAULT NULL,
  `cat_picture` varchar(255) DEFAULT NULL,
  `cat_background` varchar(255) DEFAULT NULL,
  `cat_title` text,
  `cat_description` text,
  `cat_seo_keyword` text,
  `cat_seo_title` text,
  `cat_seo_description` text,
  `cat_active` int(1) DEFAULT '1',
  `lang_id` int(1) DEFAULT '1',
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_has_child` int(11) NOT NULL DEFAULT '1',
  `cat_all_child` varchar(255) DEFAULT NULL,
  `cat_type` varchar(100) DEFAULT NULL,
  `cat_hot` tinyint(4) DEFAULT '0',
  `admin_id` int(11) DEFAULT '0',
  `cat_show_mob` tinyint(1) DEFAULT '0',
  `cat_show` int(1) DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `cat_parent_id` (`cat_parent_id`),
  KEY `cat_order` (`cat_order`)
) ENGINE=MyISAM AUTO_INCREMENT=193 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories_multi
-- ----------------------------
INSERT INTO `categories_multi` VALUES ('176', 'Xe tải', null, '1', null, null, null, null, 'Xe tải', 'Xe tải', 'Xe tải', '1', '1', '0', '1', '176,177,178,179', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('174', 'Mua bán xe', null, '1', 'cpy1482927871.jpg', null, null, null, 'Tư vấn mua ô tô', 'Tư vấn mua ô tô', 'Tư vấn mua ô tô', '1', '1', '171', '1', '174', 'news', '0', '1', '0', '1');
INSERT INTO `categories_multi` VALUES ('175', 'Báo giá ô tô du lịch', null, '2', 'igv1481927807.jpg', null, null, null, '', 'báo giá ô tô', '', '1', '1', '172', '1', '175', 'news', '0', '1', '0', '1');
INSERT INTO `categories_multi` VALUES ('169', 'Xe con Du lịch', null, '1', null, null, null, null, 'Xe con Du lịch', 'Xe con Du lịch', '', '1', '1', '0', '1', '169,170', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('170', 'Xe con Huyndai', null, '1', null, null, null, null, 'Xe con Huyndai', 'Xe con Huyndai', 'Xe con Huyndai', '1', '1', '169', '0', '170', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('171', 'Tư vấn', null, '1', null, null, null, null, 'Tư vấn', 'Tư vấn', 'Tư vấn', '1', '1', '0', '1', '171', 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('172', 'Báo giá ô tô', null, '2', 'fqw1481924026.jpg', null, null, null, 'Báo giá ô tô', 'Báo giá ô tô', 'Báo giá ô tô', '1', '1', '0', '1', '172', 'news', '0', '1', '0', '1');
INSERT INTO `categories_multi` VALUES ('177', 'Xe tải nhỏ', null, '1', null, null, null, null, 'Xe tải nhỏ', 'Xe tải nhỏ', 'Xe tải nhỏ', '1', '1', '176', '0', '177', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('178', 'Xe tải cỡ trung', null, '1', null, null, null, null, 'Xe tải cỡ trung', 'Xe tải cỡ trung', 'Xe tải cỡ trung', '1', '1', '176', '0', '178', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('179', 'Xe tải hạng nặng', null, '1', null, null, null, null, 'Xe tải hạng nặng', 'Xe tải hạng nặng', 'Xe tải hạng nặng', '1', '1', '176', '0', '179', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('180', 'Tin tức', null, '1', null, null, null, null, 'Tin tức', 'Tin tức', 'Tin tức', '1', '1', '0', '1', null, 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('181', 'Tin trong nước', null, '1', null, null, null, null, 'Tin trong nước', 'Tin trong nước', 'Tin trong nước', '1', '1', '180', '1', null, 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('182', 'Tin nước ngoài', null, '1', null, null, null, null, 'Tin nước ngoài', 'Tin nước ngoài', 'Tin nước ngoài', '1', '1', '180', '1', null, 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('183', 'Tin công nghệ', null, '1', null, null, null, null, 'Tin công nghệ', 'Tin công nghệ', 'Tin công nghệ', '1', '1', '180', '1', null, 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('184', 'Mua xe trả góp', null, '1', null, null, null, null, 'Mua xe trả góp', 'Mua xe trả góp', 'Mua xe trả góp', '1', '1', '0', '1', null, 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('185', 'Dành cho cá nhân', null, '1', null, null, null, null, 'Mua xe trả góp dành cho cá nhân', 'Mua xe trả góp dành cho cá nhân', 'Mua xe trả góp dành cho cá nhân', '1', '1', '184', '1', null, 'news', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('151', 'Chính sách ', null, '1', null, null, null, null, '', '', '', '1', '1', '0', '1', null, 'static', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('165', 'Giới thiệu', null, '1', null, null, null, null, 'gioi thieu', 'Giới thiệu oto Giải phóng', '', '1', '1', '0', '1', null, 'static', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('166', 'Xe chuyên dụng', null, '1', null, null, null, null, 'xe chuyên dụng', 'Xe chuyên dụng', 'xe chuyên dụng', '1', '1', '0', '1', '166,167,168,187,188,189,190,191', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('167', 'Xe tải gắn cẩu', null, '1', null, null, null, null, 'Xe gắn cẩu, xe tải gắn cẩu, xe tai gan cau, xe tải hyundai', 'Xe tải gắn cẩu | Xeototai.vn', 'Xe tải gắn cẩu - Chuyên cung cấp dòng xe tải gắn cẩu tự hành Hyundai Hàn Quốc. Đa chủng loại, đa tải trọng, tư vấn miễn phí thủ tục mua bán xe trả góp', '1', '1', '166', '0', '167', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('168', 'Xe ben tự đổ', null, '1', null, null, null, null, 'Xe ben tự đổ', 'Xe ben tự đổ', 'xe ben tự đổ', '1', '1', '166', '0', '168', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('186', 'Báo giá xe tải', null, '2', 'avm1481927981.jpg', null, null, null, '', '', '', '1', '1', '172', '1', null, 'news', '0', '1', '0', '1');
INSERT INTO `categories_multi` VALUES ('187', 'Xe tải đông lạnh', null, '3', null, null, null, null, 'xe tai dong lanh, xe tải đông lạnh, xe dong lanh, xe đông lạnh', 'Xe tải đông lạnh | Xeototai.vn', 'Xe tải đông lạnh chính hãng nhập khẩu từ Hàn Quốc. Cung cấp thùng xe tải đông lạnh tốt, bảo hành dài hạn. Tư vấn miễn phí thủ tục mua bán xe, mua xe trả góp', '1', '1', '166', '0', '187', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('188', 'Xe đầu kéo', null, '4', null, null, null, null, 'xe dau keo, xe container, xe đầu kéo', 'Xe đầu kéo | Xeototai.vn', 'Xe đầu kéo - Chuyên cung cấp xe đầu kéo Hyundai Hàn Quốc hiện đại công suất mạnh, tải trọng lớn. Hỗ trợ tư vấn mua xe trả góp, bảo hành uy tín, giá tốt nhất', '1', '1', '166', '0', '188', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('189', 'Xe bồn - Xe trộn bê tông', null, '5', null, null, null, null, 'xe bồn, xe bon, xe bồn trộn bê tông, xe trộn bê tông, xe tron be tong', 'Xe bồn - Xe bồn trộn bê tông', 'Xe bồn - xe bồn chở xăng dầu, xe bồn trộn bê tông, xe bồn tải trọng lớn, bảo hành dài hạn. Tư vấn miễn phí thủ tục mua bán xe, hỗ trợ mua xe trả góp ưu đãi', '1', '1', '166', '0', '189', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('190', 'Xe Somi Romooc', null, '6', null, null, null, null, 'Xe Somi Romooc', 'Xe Somi Romooc | Xeototai.vn', 'Xe Somi Romooc - Xe Somi Romooc chuyên chở các loại hàng hóa cồng kềnh, khối lượng lớn. Chúng tôi cung cấp loại xe Somi Romooc tốt nhất, tải trọng lớn nhất', '1', '1', '166', '0', '190', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('191', 'Xe cuốn ép rác', null, '7', null, null, null, null, 'xe ep rac, xe cuốn ép rác, xe ép rác, xe rác, xe tải chở rác', 'Xe cuốn ép rác | Xeototai.vn', 'Xe cuốn ép rác - xe thu gom rác thải với mục đích bảo vệ môi trường xanh sạch đẹp. Chúng tôi chuyên cung cấp những dòng xe cuốn ép rác tốt nhất, giá cả hợp lý', '1', '1', '166', '0', '191', 'product', '0', '1', '0', '0');
INSERT INTO `categories_multi` VALUES ('192', 'Tư vấn địa điểm, garace sửa chữa ô tô', null, '2', 'cmp1482925434.jpg', null, null, null, 'Tư vấn mua ô tô', 'Tư vấn mua ô tô', 'Tư vấn mua ô tô', '1', '1', '171', '1', null, 'news', '0', '1', '0', '1');

-- ----------------------------
-- Table structure for configuration
-- ----------------------------
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_page_size` varchar(10) DEFAULT NULL,
  `con_left_size` varchar(10) DEFAULT NULL,
  `con_right_size` varchar(10) DEFAULT NULL,
  `con_admin_email` varchar(255) DEFAULT NULL,
  `con_site_title` varchar(255) DEFAULT NULL,
  `con_meta_description` text,
  `con_meta_keywords` text,
  `con_currency` varchar(20) DEFAULT NULL,
  `con_mod_rewrite` tinyint(1) DEFAULT '0',
  `con_lang_id` int(11) DEFAULT '1',
  `con_extenstion` varchar(20) DEFAULT 'html',
  `lang_id` int(11) DEFAULT '1',
  `con_contact` int(11) DEFAULT '0',
  `con_product_page` int(5) DEFAULT '30',
  `con_hotline` varchar(255) DEFAULT NULL,
  `con_hotline_banhang` varchar(255) DEFAULT NULL,
  `con_hotline_hotro_kythuat` varchar(255) DEFAULT NULL,
  `con_background_img` varchar(255) DEFAULT NULL,
  `con_background_color` varchar(50) DEFAULT NULL,
  `con_address` text,
  `con_image_path` varchar(255) DEFAULT NULL,
  `con_picture_path` varchar(255) DEFAULT NULL,
  `con_background_homepage` varchar(255) DEFAULT NULL,
  `con_tangkem` text,
  `con_thongtinthanhtoan` text,
  `con_static_cucre_server` varchar(255) DEFAULT NULL,
  `con_facebook_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of configuration
-- ----------------------------
INSERT INTO `configuration` VALUES ('1', '1133', '215', '230', 'daotuan.auto@gmail.com', 'CÔNG TY CP XNK Ô TÔ GIẢI PHÓNG', 'Chuyên cung cấp xe tải nhập khẩu chính hãng. Đại lý mua bán xe ô tô tải giá ưu đãi. Bảng báo giá xe tải Hyundai, xe tải TMT. Tư vấn mua xe trả góp uy tín ', 'xe ô tô tải, xe tải, mua xe tải, bán xe tải, xe tai, xe tải hyundai, xe tải TMT, bảng báo giá xe tải, xe tai hyundai, mua xe tải trả góp, bán xe tải trả góp', 'VND', '1', '1', 'html', '1', '0', '20', '0904823889', '0904823889', '', '', '#f6ebcf', 'Km13, QL1A, Tứ Hiệp, Thanh Trì, Hà Nội', '', '', '', '<p>\r\n	<a href=\"http://xeototai.vn/search.php?search_text=c%E1%BA%A7n%20c%E1%BA%A9u%20b%C3%A1nh%20l%E1%BB%91p&amp;iTag=53&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">cần cẩu b&aacute;nh lốp</a><a href=\"http://xeototai.vn/search.php?search_text=c%E1%BA%A7n%20mua%20xe%20t%E1%BA%A3i%20c%C5%A9&amp;iTag=52&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">cần mua xe tải cũ</a><a href=\"http://xeototai.vn/search.php?search_text=mua%20xe%20t%E1%BA%A3i%20c%C5%A9%20%E1%BB%9F%20%C4%91%C3%A2u&amp;iTag=51&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">mua xe tải cũ ở đ&acirc;u</a><a href=\"http://xeototai.vn/search.php?search_text=t%C6%B0%20v%E1%BA%A5n%20mua%20xe%20t%E1%BA%A3i%20c%C5%A9&amp;iTag=50&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">tư vấn mua xe tải cũ</a><a href=\"http://xeototai.vn/search.php?search_text=mua%20xe%20t%E1%BA%A3i%20c%C5%A9&amp;iTag=49&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">mua xe tải cũ</a><a href=\"http://xeototai.vn/search.php?search_text=c%E1%BA%A9u%20b%C3%A1nh%20l%E1%BB%91p%20sany&amp;iTag=48&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">cẩu b&aacute;nh lốp sany</a><a href=\"http://xeototai.vn/search.php?search_text=c%E1%BA%A9u%20n%C3%A2ng%2030%20t%E1%BA%A5n&amp;iTag=47&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">cẩu n&acirc;ng 30 tấn</a><a href=\"http://xeototai.vn/search.php?search_text=c%E1%BA%A9u%20b%C3%A1nh%20l%E1%BB%91p&amp;iTag=46&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">cẩu b&aacute;nh lốp</a><a href=\"http://xeototai.vn/search.php?search_text=xe%20t%E1%BA%A3i%20c%E1%BA%A9u&amp;iTag=45&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">xe tải cẩu</a><a href=\"http://xeototai.vn/search.php?search_text=xe%20t%E1%BA%A3i%20hyundai&amp;iTag=44&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">xe tải hyundai</a><a href=\"http://xeototai.vn/search.php?search_text=xe%20t%E1%BA%A3i%20nh%E1%BA%ADp%20kh%E1%BA%A9u&amp;iTag=43&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">xe tải nhập khẩu</a><a href=\"http://xeototai.vn/search.php?search_text=hyundai%20hd120%20g%E1%BA%AFn%20c%E1%BA%A9u&amp;iTag=42&amp;bytag=1\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">hyundai hd120 gắn cẩu</a><a href=\"http://xeototai.vn/search.php?search_text=hyundai+hd800\" style=\"font-family: Arial; text-decoration: none; outline: none; margin: 5px 5px 5px 0px; padding: 6px; font-size: 13px; border: 1px solid rgb(204, 204, 204); display: inline-block; background: rgb(244, 244, 244); color: rgb(28, 28, 28);\">hyundai hd800</a></p>\r\n', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', '684989201670426');

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `lang_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_path` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'home',
  `lang_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'Tiếng việt', 'vn', null, null);
INSERT INTO `languages` VALUES ('2', 'English', 'en', null, null);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `mnu_id` int(11) NOT NULL AUTO_INCREMENT,
  `mnu_name` varchar(255) DEFAULT NULL,
  `mnu_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mnu_link` text,
  `mnu_target` varchar(10) DEFAULT '_self',
  `mnu_type` tinyint(3) DEFAULT '1',
  `mnu_position` int(11) NOT NULL DEFAULT '0',
  `mnu_order` double DEFAULT '0',
  `mnu_parent_id` int(11) DEFAULT '0',
  `mnu_has_child` int(1) DEFAULT '0',
  `mnu_defined` varchar(255) DEFAULT NULL,
  `mnu_active` tinyint(1) DEFAULT '1',
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mnu_id`),
  KEY `mnu_order` (`mnu_order`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('99', 'Xe gắn cẩu', null, '/tintuc/xe-gan-cau-id167', '_self', '1', '5', '0', '98', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('98', 'Xe Chuyên Dụng', null, '/', '_self', '1', '5', '0', '0', '1', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('90', 'Giới thiệu', null, '/detail/static/gioi-thieu-id5', '_self', '1', '4', '5', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('91', 'Liên Hệ', null, '/lien-he', '_self', '1', '4', '6', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('92', 'Video', null, '/video', '_self', '1', '4', '7', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('93', 'Gallery', null, '/gallery', '_self', '1', '4', '8', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('94', 'Xe theo tải trọng', null, '/', '_self', '1', '5', '0', '0', '1', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('95', 'Xe tải nhỏ ', null, '/tintuc/xe-tai-nho-id177', '_self', '1', '5', '0', '94', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('96', 'Xe tải hạng trung', null, '/tintuc/xe-tai-co-trung-id178', '_self', '1', '5', '2', '94', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('97', 'Xe tải hạng nặng', null, '/tintuc/xe-tai-hang-nang-id179', '_self', '1', '5', '3', '94', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('89', 'Mua xe trả góp', null, '/news/cat/mua-xe-tra-gop/184', '_self', '1', '4', '4', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('88', 'Báo giá ô tô', null, '/news/cat/bao-gia-o-to/172', '_self', '1', '4', '3', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('87', 'Tin tức', null, '/news/', '_self', '1', '4', '1', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('86', 'Tư vấn', null, '/news/cat/tu-van/171', '_self', '1', '4', '2', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('77', 'Trang chủ', null, '/home/', '_self', '1', '4', '0', '0', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('100', 'Xe ben tự đổ', null, '/tintuc/xe-ben-tu-do-id168', '_self', '1', '5', '0', '98', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('101', 'Xe con du lịch', null, '/', '_self', '1', '5', '0', '0', '1', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('102', 'Xe Huyndai', null, '/tintuc/xe-con-huyndai-id170', '_self', '1', '5', '0', '101', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('103', 'Xe tải đông lạnh', null, '/tintuc/xe-tai-dong-lanh-id187', '_self', '1', '5', '3', '98', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('104', 'Xe đầu kéo', null, '/tintuc/xe-dau-keo-id188', '_self', '1', '5', '4', '98', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('105', 'Xe bồn - Xe trộn bê tông', null, '/tintuc/xe-bon-xe-tron-be-tong-id189', '_self', '1', '5', '5', '98', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('107', 'Xe Somi Romooc', null, '/tintuc/xe-somi-romooc-id190', '_self', '1', '5', '7', '98', '0', null, '1', '1', '1');
INSERT INTO `menus` VALUES ('108', 'Xe cuốn ép rác', null, '/tintuc/xe-cuon-ep-rac-id191', '_self', '1', '5', '8', '98', '0', null, '1', '1', '1');

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_path` varchar(255) DEFAULT NULL,
  `mod_listname` varchar(100) DEFAULT NULL,
  `mod_listfile` varchar(100) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `mod_help` mediumtext,
  `lang_id` int(11) DEFAULT '1',
  `mod_checkloca` int(11) DEFAULT '0',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('11', 'Cấu hình chung', 'configuration', 'Cấu hình cho site', 'configuration.php', '0', null, '1', '0');
INSERT INTO `modules` VALUES ('14', 'Quản lý TK admin', 'admin_user', 'Thêm mới|Danh sách', 'add.php|listing.php', '0', null, '1', '0');
INSERT INTO `modules` VALUES ('113', 'Videos - Categories', 'video', 'Thêm mới|Danh sách', 'add.php|listing.php', '0', null, '1', '0');
INSERT INTO `modules` VALUES ('114', 'Videos', 'videoproduct', 'Thêm mới|Danh sách', 'add.php|listing.php', '0', null, '1', '0');
INSERT INTO `modules` VALUES ('26', 'Menus', 'menus', 'Thêm mới|Danh sách', 'add.php|listing.php', '0', null, '1', '0');

-- ----------------------------
-- Table structure for statics
-- ----------------------------
DROP TABLE IF EXISTS `statics`;
CREATE TABLE `statics` (
  `sta_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sta_category_id` int(11) DEFAULT '0',
  `sta_title` varchar(255) DEFAULT NULL,
  `sta_order` double DEFAULT '0',
  `sta_description` text,
  `sta_date` int(11) DEFAULT '0',
  `lang_id` tinyint(1) DEFAULT '1',
  `sta_new` tinyint(1) NOT NULL DEFAULT '0',
  `sta_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`sta_id`),
  KEY `sta_category_id` (`sta_category_id`),
  KEY `sta_order` (`sta_order`),
  KEY `sta_date` (`sta_date`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of statics
-- ----------------------------
INSERT INTO `statics` VALUES ('5', '165', 'Giới thiệu', '0', '<p>\r\n	<span _fck_bookmark=\"1\" style=\"display: none\">&nbsp;</span></p>\r\n<h3>\r\n	&nbsp;</h3>\r\n<h3>\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">Giới thiệu c&ocirc;ng ty Cổ phần Xuất Nhập Khẩu &Ocirc; t&ocirc; Giải Ph&oacute;ng</span></span></h3>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">C&ocirc;ng ty Cổ phần Xuất Nhập Khẩu &Ocirc; t&ocirc; Giải Ph&oacute;ng được th&agrave;nh lập với mong muốn cung cấp c&aacute;c phương tiện vận tải đến c&aacute;c doanh nghiệp, c&aacute; nh&acirc;n, tổ chức c&oacute; c&aacute;c nhu cầu vận tải h&agrave;ng h&oacute;a. L&agrave; đơn vị nhập khẩu c&aacute;c loại xe tải, xe chuy&ecirc;n dụng cung cấp đến tận tay kh&aacute;ch h&agrave;ng với mong muốn mang đến cho kh&aacute;ch h&agrave;ng c&aacute;c sản phẩm chất lượng, gi&aacute; cả tốt nhất đi c&ugrave;ng với dịch vụ chăm s&oacute;c kh&aacute;ch h&agrave;ng tận t&acirc;m c&ugrave;ng với dịch vụ bảo h&agrave;nh chuy&ecirc;n nghiệp, thay thế phụ t&ugrave;ng ch&iacute;nh h&atilde;ng&hellip;.Tất cả với mục đ&iacute;ch mang đến cho kh&aacute;ch h&agrave;ng sự h&agrave;i l&ograve;ng v&agrave; giải ph&aacute;p vận tải tốt nhất.</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">C&aacute;c sản phẩm chủ lực của C&ocirc;ng ty Cổ phần Xuất Nhập Khẩu &Ocirc; t&ocirc; Giải Ph&oacute;ng:</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">C&aacute;c sản phẩm của c&ocirc;ng ty ch&uacute;ng t&ocirc;i rất đa dạng về mẫu m&atilde;, tải trọng, nhưng chủ yếu c&ocirc;ng ty ch&uacute;ng t&ocirc;i tập trung v&agrave;o c&aacute;c d&ograve;ng&nbsp;xe tải,&nbsp;xe tải Hyundai&nbsp;nhập khẩu v&agrave; lắp r&aacute;p tại nh&agrave; m&aacute;y Hyundai Đ&ocirc; Th&agrave;nh.</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">Ngo&agrave;i ra C&ocirc;ng ty ch&uacute;ng t&ocirc;i cũng chuy&ecirc;n cung cấp&nbsp;xe tải hạng nhẹ&nbsp;, hạng trung v&agrave;&nbsp;xe tải hạng nặng&nbsp;từ c&aacute;c h&atilde;ng sản xuất kh&aacute;c như C&amp;C, TMT cửu long, HINO-SINOTRUCK&hellip;nhằm đem lại sự lựa chọn đa dạng về mẫu m&atilde; cũng như trọng tải để kh&aacute;ch h&agrave;ng lựa chọn.</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">Với phương ch&acirc;m hoạt động kinh doanh : Kh&aacute;ch h&agrave;ng l&agrave; số 1, mang lại sự h&agrave;i l&ograve;ng cho kh&aacute;ch h&agrave;ng, C&ocirc;ng ty ch&uacute;ng t&ocirc;i với đội ngũ kinh doanh uy t&iacute;n, nhiệt t&igrave;nh, tận t&acirc;m, th&acirc;n thiện, sẽ nỗ lực mang lại cho kh&aacute;ch h&agrave;ng những th&ocirc;ng tin tư vấn, sản phẩm tốt nhất để ph&ugrave; hợp với mong muốn của kh&aacute;ch h&agrave;ng.</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:20px;\"><strong><u><span style=\"font-family:arial,helvetica,sans-serif;\">Khi đến với C&ocirc;ng ty XNK &Ocirc; t&ocirc; giải ph&oacute;ng, Qu&yacute; kh&aacute;ch sẽ h&agrave;i l&ograve;ng với :</span></u></strong></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gi&aacute; cả hợp l&yacute; &ndash; Chất lượng đảm bảo &ndash; Thủ tục nhanh v&agrave; đơn giản.</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phong c&aacute;ch phục vụ chuy&ecirc;n nghiệp của đội ngũ CB &ndash; CNV tr&igrave;nh độ tay nghề cao, nhiệt t&igrave;nh lu&ocirc;n s&atilde;n s&agrave;ng v&igrave; lợi &iacute;ch của kh&aacute;ch h&agrave;ng .</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thủ tục vay vốn đơn giản, nhanh gọn với l&atilde;i suất ưu đ&atilde;i thất (Vay tới 70% &ndash; 80% trị gi&aacute; xe)</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dịch vụ bảo h&agrave;nh bảo dưỡng chuy&ecirc;n nghiệp</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phụ t&ugrave;ng ch&iacute;nh h&atilde;ng .</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dịch vụ đăng k&yacute;, đăng kiểm, cải tạo đ&oacute;ng th&ugrave;ng &hellip;.</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<span style=\"font-size:14px;\"><span style=\"font-family:arial,helvetica,sans-serif;\">H&atilde;y li&ecirc;n hệ với ch&uacute;ng t&ocirc;i để được gi&aacute; cả tốt nhất v&agrave; những khuyễn m&atilde;i mới nhất tới kh&aacute;ch h&agrave;ng</span></span></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#ff0000;\">C&Ocirc;NG TY XUẤT NHẬP KHẨU &Ocirc; T&Ocirc; GIẢI PH&Oacute;NG</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#ff0000;\">VĂN PH&Ograve;NG GIAO DỊCH</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#000000;\">CƠ SỞ 1</span><span style=\"color:#ff0000;\">: TẦNG 2 T&Ograve;A NH&Agrave; CT5X2&nbsp;BẮC LINH Đ&Agrave;M, HO&Agrave;NG LIỆT , HO&Agrave;NG MAI, H&Agrave; NỘI</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#000000;\">CƠ SỞ 2</span><span style=\"color:#ff0000;\">: KM14, QUỐC LỘ 1A, TỨ HIỆP, THANH TR&Igrave;, H&Agrave; NỘI</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#ff0000;\">HOTLINE &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#ff0000;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"color:#000000;\"> HOTLINE 1 </span><span style=\"color:#ff0000;\">:&nbsp;0904823889</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#ff0000;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=\"color:#000000;\">&nbsp;&nbsp;&nbsp; HOTLINE 2</span><span style=\"color:#ff0000;\">:&nbsp;0987191666</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#ff0000;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"color:#000000;\">HOTLINE 3</span><span style=\"color:#ff0000;\">:&nbsp;0961123533</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#000000;\">EMAIL</span><span style=\"color:#ff0000;\">&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;otogiaiphong.hn@gmail.com</span></span></span></strong></p>\r\n<p style=\"text-align: left;\">\r\n	&nbsp;</p>\r\n<p style=\"text-align: left;\">\r\n	<strong><span style=\"font-size:20px;\"><span style=\"font-family:arial,helvetica,sans-serif;\"><span style=\"color:#000000;\">WEBSITE</span><span style=\"color:#ff0000;\">&nbsp;: xeototai.vn - otogiaiphong.com - ototai.net</span></span></span></strong></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '1483700177', '1', '0', '1');

-- ----------------------------
-- Table structure for user_translate
-- ----------------------------
DROP TABLE IF EXISTS `user_translate`;
CREATE TABLE `user_translate` (
  `ust_keyword` varchar(255) NOT NULL,
  `ust_text` varchar(255) DEFAULT NULL,
  `lang_id` int(11) NOT NULL DEFAULT '1',
  `ust_source` varchar(255) DEFAULT NULL,
  `ust_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ust_keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_translate
-- ----------------------------
INSERT INTO `user_translate` VALUES ('54033c7f2585c112047c3361fce9f57f', 'Đang tải dữ liệu...', '1', 'Đang tải dữ liệu...', '0');
INSERT INTO `user_translate` VALUES ('a71d5922bb90fa3f8472c8569d1b5021', 'Nhập tên, mã sản phẩm...', '1', 'Nhập tên, mã sản phẩm...', '0');
INSERT INTO `user_translate` VALUES ('8929ef313c0fd6e43446cc0aa86b70cd', 'Tìm kiếm', '1', 'Tìm kiếm', '0');
INSERT INTO `user_translate` VALUES ('ee7ab74040f73a1d9f6944feaa11f27f', 'Bạn chưa nhập từ khóa tìm kiếm !', '1', 'Bạn chưa nhập từ khóa tìm kiếm !', '0');
INSERT INTO `user_translate` VALUES ('b86e54b0e2665a8bc29785eacbc5d2cd', 'Nhập email để nhận nhiều ưu đãi từ Cristiano.vn...', '1', 'Nhập email để nhận nhiều ưu đãi từ Cristiano.vn...', '0');
INSERT INTO `user_translate` VALUES ('5e6dadb6ca494c70f4b1859038794b0b', 'TÀI KHOẢN', '1', 'TÀI KHOẢN', '0');
INSERT INTO `user_translate` VALUES ('9a1927258e7c87e602898ad82c130cdd', 'Đăng nhập', '1', 'Đăng nhập', '0');
INSERT INTO `user_translate` VALUES ('0bb0951dd6fc2f6f404e3672b427cc09', 'Đăng ký', '1', 'Đăng ký', '0');
INSERT INTO `user_translate` VALUES ('be8df1f28c0abc85a0ed0c6860e5d832', 'Blog', '1', 'Blog', '0');
INSERT INTO `user_translate` VALUES ('74e20f078a01c51c08c0fb721bdfb927', 'THÔNG TIN LIÊN HỆ', '1', 'THÔNG TIN LIÊN HỆ', '0');
INSERT INTO `user_translate` VALUES ('bcc254b55c4a1babdf1dcb82c207506b', 'Phone', '1', 'Phone', '0');
INSERT INTO `user_translate` VALUES ('ce8ae9da5b7cd6c3df2929543a9af92d', 'Email', '1', 'Email', '0');
INSERT INTO `user_translate` VALUES ('436ce5e25441f372249d815fd8ddf4ee', 'Thích', '1', 'Thích', '0');
INSERT INTO `user_translate` VALUES ('d841d3ecad797b3fcd2872fc46f83aec', 'Tình trạng', '1', 'Tình trạng', '0');
INSERT INTO `user_translate` VALUES ('127ae1b3bc18952bf93139f522d9e743', 'Còn hàng', '1', 'Còn hàng', '0');
INSERT INTO `user_translate` VALUES ('072c1a4bd8ab9f7f7272ba93d4e54625', 'Giá', '1', 'Giá', '0');
INSERT INTO `user_translate` VALUES ('0b5a4d3c62d716231f932f4fa811b1c0', 'Đặt mua', '1', 'Đặt mua', '0');
INSERT INTO `user_translate` VALUES ('287b5825b7b7f56b43241ab248ba0316', 'Bạn chưa nhập họ tên người đặt', '1', 'Bạn chưa nhập họ tên người đặt', '0');
INSERT INTO `user_translate` VALUES ('26cff175e4ffd2602a8e62d33b725081', 'Bạn chưa nhập địa chỉ người đặt', '1', 'Bạn chưa nhập địa chỉ người đặt', '0');
INSERT INTO `user_translate` VALUES ('a471c8e1ef7ee2c9f201bea2acf768a5', 'Bạn chưa nhập số điện thoại người đặt', '1', 'Bạn chưa nhập số điện thoại người đặt', '0');
INSERT INTO `user_translate` VALUES ('1d1aa192b5f3b65f18a833224b52a22d', 'Sản phẩm', '1', 'Sản phẩm', '0');
INSERT INTO `user_translate` VALUES ('6430156f93760c2cfccb27557e815062', 'Giá bán', '1', 'Giá bán', '0');
INSERT INTO `user_translate` VALUES ('61012ba96209a02808fe05005e1e94c7', 'Số lượng', '1', 'Số lượng', '0');
INSERT INTO `user_translate` VALUES ('af40c066e87b5d73c3df11d89b24815d', 'Tạo liên kết', '1', 'Tạo liên kết', '0');

-- ----------------------------
-- Table structure for video_category
-- ----------------------------
DROP TABLE IF EXISTS `video_category`;
CREATE TABLE `video_category` (
  `vid_id` int(11) NOT NULL AUTO_INCREMENT,
  `vid_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vid_active` int(11) NOT NULL,
  `vid_images` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vid_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`vid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of video_category
-- ----------------------------
INSERT INTO `video_category` VALUES ('1', 'Âm nhạc', '0', 'yli1497187206.png', '');
INSERT INTO `video_category` VALUES ('2', 'Tin Tức', '0', 'rpx1497187438.png', '');
INSERT INTO `video_category` VALUES ('3', 'Hài hước', '1', 'ukq1497187593.png', '');
INSERT INTO `video_category` VALUES ('4', 'Trailer Phim', '1', 'azq1497187711.png', '');
INSERT INTO `video_category` VALUES ('11', 'Game Video', '1', 'yex1497189626.png', 'vidoe hay lúm');

-- ----------------------------
-- Table structure for video_product
-- ----------------------------
DROP TABLE IF EXISTS `video_product`;
CREATE TABLE `video_product` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_cate` int(11) NOT NULL,
  `video_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_date` int(11) NOT NULL,
  `video_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_youtobe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_active` int(11) NOT NULL,
  `video_decription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of video_product
-- ----------------------------
INSERT INTO `video_product` VALUES ('12', 'Buổi 2/12: Quy trình xây dựng ứng dụng iOS & các UI quan trọng phải biết', '11', 'đặng thế cường', '1497516118', 'osd1497219381.jpg', 'https://www.youtube.com/watch?v=ydabqm3Hx6w', '0', '');
INSERT INTO `video_product` VALUES ('13', 'DAY 11 - REACT NATIVE - APP BÁN HÀNG (PHẦN 5): Thiết kế Giao diện ứng dụng', '1', 'dang cuong php', '1497516074', 'tzd1497219436.jpg', 'https://www.youtube.com/watch?v=sXWORtpditc&t=311s', '0', '');
INSERT INTO `video_product` VALUES ('14', 'XÂY DỰNG APP BÁN HÀNG TỪ A-Z VỚI REACT NATIVE', '11', 'khoapham training', '1497515970', 'zfx1497254826.jpg', 'https://www.youtube.com/watch?v=L8cZyXl37BU', '0', '');
INSERT INTO `video_product` VALUES ('15', 'DAY 2 - XÂY DỰNG APP BÁN HÀNG TỪ A-Z VỚI REACT NATIVE', '11', 'khoapham training', '1497515953', 'hzk1497254811.jpg', 'https://www.youtube.com/watch?v=L8cZyXl37BU', '1', '');
INSERT INTO `video_product` VALUES ('16', 'DAY 3 - MENU DRAWER (SIDE MENU), GET/POST DATA VỚI PHP&MYSQL', '11', 'thecuongphp', '1497515813', 'zeu1497255001.jpg', 'https://www.youtube.com/watch?v=lRG2ITeBC6o', '1', '');
INSERT INTO `video_product` VALUES ('17', 'DAY 6 - REACT NATIVE - APP BÁN HÀNG (PHẦN 1)', '1', 'dang cuong', '1497517495', 'nec1497460228.jpg', 'https://www.youtube.com/watch?v=m-Chn7i1_MU', '0', '');
INSERT INTO `video_product` VALUES ('18', 'Cười Xuyên Việt 2017', '3', 'the cuong php', '1497515886', 'urz1497460212.jpg', 'https://www.youtube.com/watch?v=m-Chn7i1_MU', '1', '');
INSERT INTO `video_product` VALUES ('19', 'DAY 3', '3', 'Hà Nội', '1497515822', 'wto1497460270.jpg', 'https://www.youtube.com/watch?v=lRG2ITeBC6o', '1', '');
INSERT INTO `video_product` VALUES ('20', 'Tự học React Native-1-Giới thiệu React Native và tạo dự án đầu tiên', '4', 'nguyen duc hoang', '1497517405', 'qkq1497514206.jpg', 'https://www.youtube.com/watch?v=ydabqm3Hx6w', '1', '');
INSERT INTO `video_product` VALUES ('21', 'React Native tutorial-1-Introduction and create a basic project', '11', 'dang the cuongphp', '1497527064', 'dnw1497514523.jpg', 'https://www.youtube.com/watch?v=ydabqm3Hx6w', '1', '');
INSERT INTO `video_product` VALUES ('22', 'Những điểm mới trong Xcode 9 beta', '11', 'dang the cuong', '1497515719', 'kpa1497515719.jpg', 'https://www.youtube.com/watch?v=c9VqlTY3ZYE', '1', '');
INSERT INTO `video_product` VALUES ('23', 'Tự học Swift 4-1-Giới thiệu ngôn ngữ Swift và các khái niệm cơ bản', '4', 'nguyễn đức Hoàng', '1497515704', 'bxd1497515704.jpg', 'https://www.youtube.com/watch?v=s2dz31WnsiE', '1', '');
