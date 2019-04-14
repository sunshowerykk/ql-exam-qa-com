/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50519
Source Host           : localhost:3306
Source Database       : exam

Target Server Type    : MYSQL
Target Server Version : 50519
File Encoding         : 65001

Date: 2019-02-28 17:06:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_answer
-- ----------------------------
DROP TABLE IF EXISTS `sys_answer`;
CREATE TABLE `sys_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT NULL COMMENT '1图文，2语音',
  `cid` char(40) DEFAULT NULL,
  `subjectid` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `teachid` int(11) DEFAULT NULL,
  `teachname` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1未回答，2已回答,3老师待回答',
  `intime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`cid`,`subjectid`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_answer
-- ----------------------------
INSERT INTO `sys_answer` VALUES ('81', '2', '9A68ADF0-C893-2403-B9D9-0B9C91AEE5FE', '9', '', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-22 08:37:19');
INSERT INTO `sys_answer` VALUES ('82', '1', 'F64BA974-22C6-62C8-AECC-08CE1F7C1DC3', '9', 'asd', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 08:37:49');
INSERT INTO `sys_answer` VALUES ('83', '2', 'E6956F26-220F-6ADD-E2B7-288245B501D3', '11', '', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 08:38:03');
INSERT INTO `sys_answer` VALUES ('84', '1', '336BA2B2-010A-8440-680A-4C6EA858A7A5', '10', '高等数学怎么复习呀？', '84', 'zhangwenfeng', '55', '陈见柯', '2', '2019-02-22 09:49:45');
INSERT INTO `sys_answer` VALUES ('85', '1', 'BE6FD11C-C29D-1A7B-C4F8-6986B2F32202', '11', '英语单词记忆的常用方法有哪些？', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-22 09:54:25');
INSERT INTO `sys_answer` VALUES ('86', '2', 'DFC54DBF-9A15-617D-A48A-71D18E62FE32', '9', '', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-22 11:05:47');
INSERT INTO `sys_answer` VALUES ('87', '1', '5571EBAE-3B77-C685-44E6-B530F370FD2B', '13', '明年的专升本考试在什么时间？', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 11:06:51');
INSERT INTO `sys_answer` VALUES ('88', '1', 'E543721C-4B9D-78D3-AB72-8713CC87F9F8', '12', '计算机课程难吗', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-22 11:08:18');
INSERT INTO `sys_answer` VALUES ('89', '2', '8E841529-80CA-4190-E1A3-CBDFFBD4D086', '9', '', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 11:17:02');
INSERT INTO `sys_answer` VALUES ('90', '1', '1FDAC2A5-60A5-20F7-A68F-3CA768978420', '12', '域名服务器的作用是什么？', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 16:20:54');
INSERT INTO `sys_answer` VALUES ('91', '1', '0A8E5E68-7EE3-9308-EF73-3E35EF741575', '11', '英语语法是考试重点吗？', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 16:22:02');
INSERT INTO `sys_answer` VALUES ('92', '1', 'C8BC7E63-21FC-4E19-E6E9-54093AC83401', '9', '英语写作题材给一些吧', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-22 16:35:18');
INSERT INTO `sys_answer` VALUES ('93', '1', '52C463B0-1677-260B-541F-A6A681F3B80C', '9', '2019-2-23-test1', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-23 09:35:39');
INSERT INTO `sys_answer` VALUES ('94', '1', '24533F54-4E9E-111E-4FDC-8615D78276AE', '9', 'test2', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-23 09:36:45');
INSERT INTO `sys_answer` VALUES ('95', '2', '809E6F0A-5AB7-F107-BBB3-FA5A9F497027', '10', 'test3', '84', 'zhangwenfeng', '55', '陈见柯', '2', '2019-02-23 09:41:36');
INSERT INTO `sys_answer` VALUES ('96', '2', '5AA599D1-3095-6E3D-9056-697BB80D8921', '9', '能直接拍照上传吗', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-23 09:43:17');
INSERT INTO `sys_answer` VALUES ('97', '1', '9B31A3A3-E926-6CC1-92E8-8A2A937D7446', '9', 'test6', '84', 'zhangwenfeng', '59', '丁兴建', '2', '2019-02-23 09:49:45');
INSERT INTO `sys_answer` VALUES ('98', '2', '11C5385C-A58C-870F-AE71-4404C54FB342', '9', '', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-23 09:50:44');
INSERT INTO `sys_answer` VALUES ('99', '1', 'EB48E431-8A31-90E4-E84D-9893131DA77D', '9', '拉', '84', 'zhangwenfeng', '54', '刘玥', '3', '2019-02-25 17:13:56');
INSERT INTO `sys_answer` VALUES ('100', '1', '15027156-26C5-EA41-1A23-9ADF652988CC', '9', '测试\n', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-25 17:23:49');
INSERT INTO `sys_answer` VALUES ('101', '1', '5ADCDA24-EEB3-8FCA-0C6F-AB0F18D6B5B2', '9', '123123', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-26 12:00:06');
INSERT INTO `sys_answer` VALUES ('102', '1', '9EEEF797-2170-8005-954D-5B227561CEA5', '9', '测试测试', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-26 13:49:21');
INSERT INTO `sys_answer` VALUES ('103', '1', '6A9FA93F-FA22-A3C7-4877-68F8C9CFB238', '9', '阿萨德', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-26 13:58:10');
INSERT INTO `sys_answer` VALUES ('104', '1', '4539AFC5-B3F9-6079-1A55-F518E959DD3F', '9', '111', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-26 13:59:06');
INSERT INTO `sys_answer` VALUES ('105', '1', 'A3DEDAC4-A68D-D2E4-DB2C-2B8735C996EA', '9', '阿萨德', '84', 'zhangwenfeng', '57', 'test', '2', '2019-02-26 14:06:51');
INSERT INTO `sys_answer` VALUES ('106', '1', '78CFAECE-FD3F-F26C-AA32-D19590DB57AF', '9', '语文考试大纲', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-27 09:54:39');
INSERT INTO `sys_answer` VALUES ('107', '2', '9F60C876-3386-512A-4C71-D373BB419768', '10', '', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-27 09:56:10');
INSERT INTO `sys_answer` VALUES ('108', '2', 'DC863248-48CA-1C70-8293-6B437E17BE9B', '9', '', '84', 'zhangwenfeng', '58', '孟祥光', '3', '2019-02-27 10:24:25');
INSERT INTO `sys_answer` VALUES ('109', '1', '03D0A29E-C4BF-8EA4-426F-8C8BDB924ABC', '9', '春天要来了么', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-27 10:46:28');
INSERT INTO `sys_answer` VALUES ('110', '2', '8663B668-308C-9DAA-EE43-112D995D32D6', '12', '', '84', 'zhangwenfeng', '59', '丁兴建', '2', '2019-02-27 10:47:46');
INSERT INTO `sys_answer` VALUES ('111', '2', '871969CF-077A-D57D-D34A-CC2B13D1E391', '9', '', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-27 16:14:13');
INSERT INTO `sys_answer` VALUES ('112', '2', '18C7F084-696D-2B30-2F1E-375CBF21BD2A', '9', '', '84', 'zhangwenfeng', '58', '孟祥光', '3', '2019-02-27 16:15:11');
INSERT INTO `sys_answer` VALUES ('113', '2', '3A2C7AE3-29DF-E65A-5725-09B88FCF9391', '9', '', '84', 'zhangwenfeng', '58', '孟祥光', '3', '2019-02-27 16:16:11');
INSERT INTO `sys_answer` VALUES ('114', '2', 'A713FF32-FA0E-EC14-0807-B797A2580289', '9', '', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-27 16:17:44');
INSERT INTO `sys_answer` VALUES ('115', '2', '11AD4CC9-4235-0F2C-1FAB-0FB6564A913D', '9', '', '84', 'zhangwenfeng', '57', 'test', '3', '2019-02-27 16:21:43');
INSERT INTO `sys_answer` VALUES ('116', '1', '0E8B8EB5-C1C8-C8F9-43C9-318C9C780D6E', '9', '2019年2月28日第一个问题', '84', 'zhangwenfeng', '58', '孟祥光', '2', '2019-02-28 11:12:34');
INSERT INTO `sys_answer` VALUES ('117', '2', 'F2202E89-5375-A7BB-3AB8-D6ACC9ACF50B', '9', '', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 11:12:53');
INSERT INTO `sys_answer` VALUES ('118', '2', '83CE32C1-300A-54FC-A77A-B645E6C0776E', '9', '', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 11:14:19');
INSERT INTO `sys_answer` VALUES ('119', '1', '27E3871A-50D9-CA4F-2F9F-5C95C1D3EA53', '13', '今天天气不错', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 13:08:41');
INSERT INTO `sys_answer` VALUES ('120', '2', '08B47D1B-9B15-7D61-A2D3-248E6DF22E6D', '10', '', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 13:12:52');
INSERT INTO `sys_answer` VALUES ('121', '2', '9FB7B9C7-48B7-477C-68F6-A6BE7DA69B4C', '9', '', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 13:24:40');
INSERT INTO `sys_answer` VALUES ('122', '2', '0A122216-40CC-14C0-E6FD-709953240642', '9', '', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 13:55:39');
INSERT INTO `sys_answer` VALUES ('123', '2', 'DA472E42-3710-6640-C768-B6BB26608A81', '9', '', '84', 'zhangwenfeng', null, '', '1', '2019-02-28 13:57:05');
INSERT INTO `sys_answer` VALUES ('124', '2', '09F638ED-C132-59FF-9D6E-4F6016495B64', '11', '', '84', 'zhangwenfeng', null, null, '1', '2019-02-28 14:52:23');

-- ----------------------------
-- Table structure for sys_exam
-- ----------------------------
DROP TABLE IF EXISTS `sys_exam`;
CREATE TABLE `sys_exam` (
  `examid` int(11) NOT NULL AUTO_INCREMENT,
  `examsubid` int(11) DEFAULT NULL,
  `examsubname` varchar(255) DEFAULT NULL,
  `examcourseid` int(11) DEFAULT NULL,
  `examcoursename` varchar(255) DEFAULT NULL,
  `examcoursesectionid` int(11) DEFAULT NULL,
  `examcoursesectionname` varchar(255) DEFAULT NULL,
  `examname` varchar(255) DEFAULT NULL,
  `examscore` varchar(255) DEFAULT NULL,
  `examquestions` text,
  `examstatus` int(11) DEFAULT '1',
  `examtime` char(255) DEFAULT NULL,
  `examinuser` varchar(255) DEFAULT NULL,
  `examintime` datetime DEFAULT NULL,
  PRIMARY KEY (`examid`),
  KEY `examid` (`examid`,`examsubid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_exam
-- ----------------------------
INSERT INTO `sys_exam` VALUES ('2', '23', '高等数学', '99', '课程2020年山东专升本考试辅导高等数学II基础班', '8', '第一单元', '测试试卷', '100', null, '1', '60', 'admin', '2019-02-25 13:57:25');

-- ----------------------------
-- Table structure for sys_examhistory
-- ----------------------------
DROP TABLE IF EXISTS `sys_examhistory`;
CREATE TABLE `sys_examhistory` (
  `ehid` int(11) NOT NULL AUTO_INCREMENT,
  `ehexamid` int(11) DEFAULT NULL,
  `ehscorelist` text,
  `errorlist` text,
  `ehanswer` text,
  `ehtime` int(11) DEFAULT NULL,
  `ehscore` varchar(255) DEFAULT '0',
  `ehstarttime` varchar(50) DEFAULT NULL,
  `ehendtime` varchar(50) DEFAULT NULL,
  `ehgrade` int(11) DEFAULT '1' COMMENT '1自评分，2教师评分',
  `ehstatus` int(11) DEFAULT '0' COMMENT '1,已完成答题，2可以继续答题',
  `userid` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ehgardestatus` int(11) DEFAULT '1' COMMENT '1，未阅卷2，已阅卷,3临时保存',
  `ehcheckuser` int(11) DEFAULT NULL,
  `chcheckusername` varchar(255) DEFAULT NULL,
  `ehcomment` text,
  `ehgardetime` char(40) DEFAULT NULL,
  `ehgardeendtime` char(40) DEFAULT NULL,
  PRIMARY KEY (`ehid`),
  KEY `ehid` (`ehid`,`ehexamid`,`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_examhistory
-- ----------------------------
INSERT INTO `sys_examhistory` VALUES ('2', '2', 'a:1:{i:1;s:1:\"2\";}', 'a:1:{i:2;s:1:\"A\";}', 'a:2:{i:1;s:1:\"B\";i:2;a:1:{i:1;s:1:\"A\";}}', '19', '2', '1551330925', '1551330944', '1', '1', '84', 'zhangwenfeng', '2', '84', 'zhangwenfeng', 's:0:\"\";', null, null);

-- ----------------------------
-- Table structure for sys_file
-- ----------------------------
DROP TABLE IF EXISTS `sys_file`;
CREATE TABLE `sys_file` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) DEFAULT '1',
  `FileId` varchar(50) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `FileExtension` varchar(50) NOT NULL,
  `FileSize` int(20) NOT NULL,
  `InUser` varchar(20) NOT NULL,
  `InTime` datetime NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FileId` (`FileId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_file
-- ----------------------------
INSERT INTO `sys_file` VALUES ('144', '1', '24533F54-4E9E-111E-4FDC-8615D78276AE', 'pm4gmozbu.bkt.clouddn.com/1550885804', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550885804');
INSERT INTO `sys_file` VALUES ('143', '1', '52C463B0-1677-260B-541F-A6A681F3B80C', 'pm4gmozbu.bkt.clouddn.com/1550885738', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550885738');
INSERT INTO `sys_file` VALUES ('139', '1', '0A8E5E68-7EE3-9308-EF73-3E35EF741575', 'pm4gmozbu.bkt.clouddn.com/1550823721', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550823721');
INSERT INTO `sys_file` VALUES ('140', '1', '2F50A68B-0E3C-F5F6-94D2-ACCB69808BAA', 'pm4gmozbu.bkt.clouddn.com/1550823805', '', '0', '孟祥光', '2019-02-22 00:00:00', '1550823805');
INSERT INTO `sys_file` VALUES ('141', '1', '7625ABB0-C380-1E06-BDD2-D7B66AD55646', 'pm4gmozbu.bkt.clouddn.com/1550823842', '', '0', '孟祥光', '2019-02-22 00:00:00', '1550823842');
INSERT INTO `sys_file` VALUES ('142', '1', 'C8BC7E63-21FC-4E19-E6E9-54093AC83401', 'pm4gmozbu.bkt.clouddn.com/1550824518', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550824518');
INSERT INTO `sys_file` VALUES ('82', '1', '4C3ADCA9-17DD-2794-9186-78358207D858', 'Data/201902/18/095729fpsppvj7e7u7gmpv.png', 'png', '226', 'admin', '2019-02-18 00:00:00', null);
INSERT INTO `sys_file` VALUES ('83', '1', 'FF144E6A-2694-F72D-70E4-54630F86DC69', 'Data/201902/18/095754jan3awl7nlmkom3c.png', 'png', '270', 'admin', '2019-02-18 00:00:00', null);
INSERT INTO `sys_file` VALUES ('85', '1', 'B1733FA1-DCC6-812B-A02D-E872EE2661A8', 'Data/201902/18/100248gv74sypxswwzszws.jpg', 'jpg', '36', 'admin', '2019-02-18 00:00:00', null);
INSERT INTO `sys_file` VALUES ('132', '1', 'EDA3C34B-06AF-79C0-E4B2-CFAD107BC3C2', 'pm4gmozbu.bkt.clouddn.com/1550806395', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550806395');
INSERT INTO `sys_file` VALUES ('137', '1', 'AC954546-9E02-49EA-6DF8-4DB68BAF8AA7', 'pm4gmozbu.bkt.clouddn.com/1550807510', '', '0', '孟祥光', '2019-02-22 00:00:00', '1550807510');
INSERT INTO `sys_file` VALUES ('138', '1', '1FDAC2A5-60A5-20F7-A68F-3CA768978420', 'pm4gmozbu.bkt.clouddn.com/1550823653', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550823653');
INSERT INTO `sys_file` VALUES ('84', '1', '22ED302E-89B8-1E3E-A44E-E288D2275A07', 'Data/201902/18/095925alrxf2x1ddeaisxe.jpg', 'jpg', '78', 'admin', '2019-02-18 00:00:00', null);
INSERT INTO `sys_file` VALUES ('43', '1', '67B540DB-0087-1F04-4839-54B503931A8F', 'Data/201902/15/153039tyip2btzp9tp24y3.png', 'png', '1', 'admin', '2019-02-15 00:00:00', null);
INSERT INTO `sys_file` VALUES ('44', '1', '61C14409-90F9-218F-33A1-F79419F2090B', 'Data/201902/15/153600nplpppmfppmbfpee.png', 'png', '1', 'admin', '2019-02-15 00:00:00', null);
INSERT INTO `sys_file` VALUES ('119', '1', 'BE6FD11C-C29D-1A7B-C4F8-6986B2F32202', 'pm4gmozbu.bkt.clouddn.com/1550800464', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550800464');
INSERT INTO `sys_file` VALUES ('120', '2', 'DFC54DBF-9A15-617D-A48A-71D18E62FE32', 'pm4gmozbu.bkt.clouddn.com/1550804746', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550804746');
INSERT INTO `sys_file` VALUES ('121', '1', '5571EBAE-3B77-C685-44E6-B530F370FD2B', 'pm4gmozbu.bkt.clouddn.com/1550804811', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550804811');
INSERT INTO `sys_file` VALUES ('124', '2', 'DF5C3BAB-B6E6-AD4B-0D9D-AED095C06965', 'pm4gmozbu.bkt.clouddn.com/1550804895', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550804895');
INSERT INTO `sys_file` VALUES ('125', '1', 'E543721C-4B9D-78D3-AB72-8713CC87F9F8', 'pm4gmozbu.bkt.clouddn.com/1550804897', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550804897');
INSERT INTO `sys_file` VALUES ('118', '1', '336BA2B2-010A-8440-680A-4C6EA858A7A5', 'pm4gmozbu.bkt.clouddn.com/1550800184', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550800184');
INSERT INTO `sys_file` VALUES ('128', '1', 'D285FB32-0B34-49B4-2E34-F79AC747B916', 'pm4gmozbu.bkt.clouddn.com/1550805057', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550805057');
INSERT INTO `sys_file` VALUES ('129', '2', 'D285FB32-0B34-49B4-2E34-F79AC747B916', 'pm4gmozbu.bkt.clouddn.com/1550805063', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550805063');
INSERT INTO `sys_file` VALUES ('130', '2', '8E841529-80CA-4190-E1A3-CBDFFBD4D086', 'pm4gmozbu.bkt.clouddn.com/1550805420', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550805420');
INSERT INTO `sys_file` VALUES ('131', '1', '71A7C956-9F4F-9A78-2EF4-919D02412473', 'Data/201902/22/112347jrucoyo0hcylhojn.png', 'png', '270', 'admin', '2019-02-22 00:00:00', null);
INSERT INTO `sys_file` VALUES ('98', '1', '40EA43A2-5B0A-392E-3E28-068F4FE1932A', 'Data/201902/19/142154alv93b29d99zv9bl.png', 'png', '32', 'admin', '2019-02-19 00:00:00', null);
INSERT INTO `sys_file` VALUES ('110', '2', 'B06D2394-EF9E-6BCF-D819-43A0B7F9F666', 'pm4gmozbu.bkt.clouddn.com/1550760285', '', '0', 'zhangwenfeng', '2019-02-21 00:00:00', '1550760285');
INSERT INTO `sys_file` VALUES ('111', '2', '9A68ADF0-C893-2403-B9D9-0B9C91AEE5FE', 'pm4gmozbu.bkt.clouddn.com/1550795633', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550795633');
INSERT INTO `sys_file` VALUES ('112', '2', '9A68ADF0-C893-2403-B9D9-0B9C91AEE5FE', 'pm4gmozbu.bkt.clouddn.com/1550795839', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550795839');
INSERT INTO `sys_file` VALUES ('113', '1', 'F64BA974-22C6-62C8-AECC-08CE1F7C1DC3', 'pm4gmozbu.bkt.clouddn.com/1550795869', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550795869');
INSERT INTO `sys_file` VALUES ('114', '2', 'E6956F26-220F-6ADD-E2B7-288245B501D3', 'pm4gmozbu.bkt.clouddn.com/1550795882', '', '0', 'zhangwenfeng', '2019-02-22 00:00:00', '1550795882');
INSERT INTO `sys_file` VALUES ('115', '1', '7801F3C0-F0D9-1E1F-6EC2-88EAFFD6CD86', 'Data/201902/22/094715o0r8g1pv421gk2c0.jpg', 'jpg', '1', 'admin', '2019-02-22 00:00:00', null);
INSERT INTO `sys_file` VALUES ('116', '1', '74579318-81A0-BBB9-669C-D605E4ECE0FA', 'Data/201902/22/094728q8a43mt514zte2m1.png', 'png', '2', 'admin', '2019-02-22 00:00:00', null);
INSERT INTO `sys_file` VALUES ('117', '1', '6AD50832-1FF0-8D2C-7C06-E08F65914E2A', 'Data/201902/22/094739h2kabw6ccocc6kcj.png', 'png', '1', 'admin', '2019-02-22 00:00:00', null);
INSERT INTO `sys_file` VALUES ('145', '2', '809E6F0A-5AB7-F107-BBB3-FA5A9F497027', 'pm4gmozbu.bkt.clouddn.com/1550886095', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550886095');
INSERT INTO `sys_file` VALUES ('146', '1', '809E6F0A-5AB7-F107-BBB3-FA5A9F497027', 'pm4gmozbu.bkt.clouddn.com/1550886096', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550886096');
INSERT INTO `sys_file` VALUES ('147', '2', '5AA599D1-3095-6E3D-9056-697BB80D8921', 'pm4gmozbu.bkt.clouddn.com/1550886196', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550886196');
INSERT INTO `sys_file` VALUES ('148', '1', '5AA599D1-3095-6E3D-9056-697BB80D8921', 'pm4gmozbu.bkt.clouddn.com/1550886197', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550886197');
INSERT INTO `sys_file` VALUES ('149', '2', '11C5385C-A58C-870F-AE71-4404C54FB342', 'pm4gmozbu.bkt.clouddn.com/1550886644', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550886644');
INSERT INTO `sys_file` VALUES ('151', '1', '846470E9-9F96-BC5F-5101-9FC8DC5A63BB', 'pm4gmozbu.bkt.clouddn.com/1550888253', '', '0', '陈见柯', '2019-02-23 00:00:00', '1550888253');
INSERT INTO `sys_file` VALUES ('152', '2', '846470E9-9F96-BC5F-5101-9FC8DC5A63BB', 'pm4gmozbu.bkt.clouddn.com/1550888302', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550888302');
INSERT INTO `sys_file` VALUES ('153', '1', '1CEDDADF-98BE-68F3-B375-38A7D32C40C2', 'pm4gmozbu.bkt.clouddn.com/1550888848', '', '0', '孟祥光', '2019-02-23 00:00:00', '1550888848');
INSERT INTO `sys_file` VALUES ('155', '1', 'CCB01580-BC52-92ED-D028-98EFCDD1A4B3', 'pm4gmozbu.bkt.clouddn.com/1550888883', '', '0', '丁兴建', '2019-02-23 00:00:00', '1550888883');
INSERT INTO `sys_file` VALUES ('156', '2', '68967B1F-DEDE-5A6C-0CA3-C60A61E781A6', 'pm4gmozbu.bkt.clouddn.com/1550888885', '', '0', 'zhangwenfeng', '2019-02-23 00:00:00', '1550888885');
INSERT INTO `sys_file` VALUES ('157', '1', 'EB48E431-8A31-90E4-E84D-9893131DA77D', 'pm4gmozbu.bkt.clouddn.com/1551086035', '', '0', 'zhangwenfeng', '2019-02-25 00:00:00', '1551086035');
INSERT INTO `sys_file` VALUES ('158', '1', '15027156-26C5-EA41-1A23-9ADF652988CC', 'pm4gmozbu.bkt.clouddn.com/1551086629', '', '0', 'zhangwenfeng', '2019-02-25 00:00:00', '1551086629');
INSERT INTO `sys_file` VALUES ('159', '1', '5ADCDA24-EEB3-8FCA-0C6F-AB0F18D6B5B2', 'pm4gmozbu.bkt.clouddn.com/1551153605', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551153605');
INSERT INTO `sys_file` VALUES ('160', '1', '9EEEF797-2170-8005-954D-5B227561CEA5', 'pm4gmozbu.bkt.clouddn.com/1551160161', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551160161');
INSERT INTO `sys_file` VALUES ('161', '1', '6A9FA93F-FA22-A3C7-4877-68F8C9CFB238', 'pm4gmozbu.bkt.clouddn.com/1551160690', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551160690');
INSERT INTO `sys_file` VALUES ('162', '1', '4539AFC5-B3F9-6079-1A55-F518E959DD3F', 'pm4gmozbu.bkt.clouddn.com/1551160745', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551160745');
INSERT INTO `sys_file` VALUES ('163', '1', 'A3DEDAC4-A68D-D2E4-DB2C-2B8735C996EA', 'pm4gmozbu.bkt.clouddn.com/1551161211', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551161211');
INSERT INTO `sys_file` VALUES ('164', '2', 'CFC85719-1641-EE7E-8A09-529ED90C42B2', 'pm4gmozbu.bkt.clouddn.com/1551163165', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551163165');
INSERT INTO `sys_file` VALUES ('165', '2', 'CFC9DDA4-C566-4710-0474-B01CE5146DC3', 'pm4gmozbu.bkt.clouddn.com/1551163208', '', '0', 'zhangwenfeng', '2019-02-26 00:00:00', '1551163208');
INSERT INTO `sys_file` VALUES ('166', '1', '78CFAECE-FD3F-F26C-AA32-D19590DB57AF', 'pm4gmozbu.bkt.clouddn.com/1551232478', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551232478');
INSERT INTO `sys_file` VALUES ('167', '2', '9F60C876-3386-512A-4C71-D373BB419768', 'pm4gmozbu.bkt.clouddn.com/1551232569', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551232569');
INSERT INTO `sys_file` VALUES ('168', '2', 'DC863248-48CA-1C70-8293-6B437E17BE9B', 'pm4gmozbu.bkt.clouddn.com/1551234264', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551234264');
INSERT INTO `sys_file` VALUES ('169', '1', 'C16DDD59-AD39-3B22-B6A2-BA5E9ED29AA9', 'pm4gmozbu.bkt.clouddn.com/1551235558', '', '0', '孟祥光', '2019-02-27 00:00:00', '1551235558');
INSERT INTO `sys_file` VALUES ('170', '1', '03D0A29E-C4BF-8EA4-426F-8C8BDB924ABC', 'pm4gmozbu.bkt.clouddn.com/1551235588', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551235588');
INSERT INTO `sys_file` VALUES ('171', '2', '8663B668-308C-9DAA-EE43-112D995D32D6', 'pm4gmozbu.bkt.clouddn.com/1551235665', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551235665');
INSERT INTO `sys_file` VALUES ('172', '1', '7D318D3E-27DA-7C41-668D-769641D732A1', 'pm4gmozbu.bkt.clouddn.com/1551245964', '', '0', '丁兴建', '2019-02-27 00:00:00', '1551245964');
INSERT INTO `sys_file` VALUES ('173', '1', '6315794B-4847-24FD-17F4-E7652621C204', 'pm4gmozbu.bkt.clouddn.com/1551250164', '', '0', '孟祥光', '2019-02-27 00:00:00', '1551250164');
INSERT INTO `sys_file` VALUES ('174', '1', '551C6671-850A-E897-F5C8-02692D9E6A23', 'pm4gmozbu.bkt.clouddn.com/1551255356', '', '0', '孟祥光', '2019-02-27 00:00:00', '1551255356');
INSERT INTO `sys_file` VALUES ('175', '2', '11AD4CC9-4235-0F2C-1FAB-0FB6564A913D', 'pm4gmozbu.bkt.clouddn.com/LeBgjRO1QctOEgfOADIy-7B38CE=/FhBAfAoNJyAmPJC4wFVRdZi9mKDM', '', '0', '', '2019-02-27 00:00:00', 'LeBgjRO1QctOEgfOADIy-7B38CE=/FhBAfAoNJyAmPJC4wFVRdZi9mKDM');
INSERT INTO `sys_file` VALUES ('176', '1', '438810D1-8416-1410-F4B8-9CC650954757', 'pm4gmozbu.bkt.clouddn.com/1551260936', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551260936');
INSERT INTO `sys_file` VALUES ('177', '1', '438810D1-8416-1410-F4B8-9CC650954757', 'pm4gmozbu.bkt.clouddn.com/1551260938', '', '0', 'zhangwenfeng', '2019-02-27 00:00:00', '1551260938');
INSERT INTO `sys_file` VALUES ('178', '1', '773EC624-554A-8356-E6FC-1D4DA1394C33', 'pm4gmozbu.bkt.clouddn.com/1551261332', '', '0', 'test', '2019-02-27 00:00:00', '1551261332');
INSERT INTO `sys_file` VALUES ('179', '1', '773EC624-554A-8356-E6FC-1D4DA1394C33', 'pm4gmozbu.bkt.clouddn.com/1551261333', '', '0', 'test', '2019-02-27 00:00:00', '1551261333');
INSERT INTO `sys_file` VALUES ('180', '1', '59040A00-7071-2A03-C6FC-6C6FFBC5ED1B', 'pm4gmozbu.bkt.clouddn.com/1551322894', '', '0', 'test', '2019-02-28 00:00:00', '1551322894');
INSERT INTO `sys_file` VALUES ('181', '1', 'B981659E-00F4-DA5E-953A-114E615294A3', 'pm4gmozbu.bkt.clouddn.com/1551323097', '', '0', 'test', '2019-02-28 00:00:00', '1551323097');
INSERT INTO `sys_file` VALUES ('182', '2', 'B981659E-00F4-DA5E-953A-114E615294A3', 'pm4gmozbu.bkt.clouddn.com/1551323098', '', '0', 'zhangwenfeng', '2019-02-28 00:00:00', '1551323098');
INSERT INTO `sys_file` VALUES ('183', '1', '0E8B8EB5-C1C8-C8F9-43C9-318C9C780D6E', 'pm4gmozbu.bkt.clouddn.com/1551323554', '', '0', 'zhangwenfeng', '2019-02-28 00:00:00', '1551323554');
INSERT INTO `sys_file` VALUES ('184', '2', 'F2202E89-5375-A7BB-3AB8-D6ACC9ACF50B', 'pm4gmozbu.bkt.clouddn.com/1551323572', '', '0', 'zhangwenfeng', '2019-02-28 00:00:00', '1551323572');
INSERT INTO `sys_file` VALUES ('185', '2', '83CE32C1-300A-54FC-A77A-B645E6C0776E', 'pm4gmozbu.bkt.clouddn.com/1551323658', '', '0', 'zhangwenfeng', '2019-02-28 00:00:00', '1551323658');
INSERT INTO `sys_file` VALUES ('186', '1', '87DB1CA9-199E-098C-5893-F2E5C740E42E', 'pm4gmozbu.bkt.clouddn.com/1551323751', '', '0', '孟祥光', '2019-02-28 00:00:00', '1551323751');
INSERT INTO `sys_file` VALUES ('187', '1', '27E3871A-50D9-CA4F-2F9F-5C95C1D3EA53', 'pm4gmozbu.bkt.clouddn.com/1551330518', '', '0', 'zhangwenfeng', '2019-02-28 00:00:00', '1551330518');
INSERT INTO `sys_file` VALUES ('188', '2', '0A122216-40CC-14C0-E6FD-709953240642', 'pm4gmozbu.bkt.clouddn.com/LeBgjRO1QctOEgfOADIy-7B38CE=/FnBzW9Wc-KTi4XIOcegVVZeuYpd9', '', '0', '', '2019-02-28 00:00:00', 'LeBgjRO1QctOEgfOADIy-7B38CE=/FnBzW9Wc-KTi4XIOcegVVZeuYpd9');
INSERT INTO `sys_file` VALUES ('189', '2', 'DA472E42-3710-6640-C768-B6BB26608A81', 'pm4gmozbu.bkt.clouddn.com/LeBgjRO1QctOEgfOADIy-7B38CE=/FtIx6bCEJ0AzjjSSYWwa0dy98XOs', '', '0', '', '2019-02-28 00:00:00', 'LeBgjRO1QctOEgfOADIy-7B38CE=/FtIx6bCEJ0AzjjSSYWwa0dy98XOs');
INSERT INTO `sys_file` VALUES ('190', '2', '09F638ED-C132-59FF-9D6E-4F6016495B64', 'pm4gmozbu.bkt.clouddn.com/LeBgjRO1QctOEgfOADIy-7B38CE=/FoyOqy-Fyd7H1LPYeo6V2eaNfG4X', '', '0', '', '2019-02-28 00:00:00', 'LeBgjRO1QctOEgfOADIy-7B38CE=/FoyOqy-Fyd7H1LPYeo6V2eaNfG4X');

-- ----------------------------
-- Table structure for sys_question
-- ----------------------------
DROP TABLE IF EXISTS `sys_question`;
CREATE TABLE `sys_question` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `examid` int(11) DEFAULT NULL,
  `questiontype` int(11) DEFAULT NULL,
  `question` text COMMENT '题干',
  `questionselect` text COMMENT '选项',
  `questionselectnumber` int(11) DEFAULT NULL COMMENT '选选项数量',
  `questionanswer` text COMMENT '答案',
  `questiondescribe` text COMMENT '解析',
  `questionscore` text COMMENT '分值',
  `questionvideo` text,
  `questionstatus` int(11) DEFAULT '1',
  `questionparent` int(11) DEFAULT '0',
  `questioncreatetime` datetime DEFAULT NULL,
  `questionuser` varchar(255) DEFAULT NULL,
  `questioncap` int(11) DEFAULT '0',
  PRIMARY KEY (`questionid`),
  KEY `questionid` (`questionid`,`questiontype`,`questionstatus`,`examid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_question
-- ----------------------------
INSERT INTO `sys_question` VALUES ('1', '2', '3', '<p>测试题干（）</p>', '<p>A、选这个<br/>B、选这个<br/>C、选这个<br/>D、选中<br/></p>', '4', 'B', '<p>暂无解析</p>', '2', '', '1', '0', '2019-02-25 14:09:09', 'admin', '0');
INSERT INTO `sys_question` VALUES ('2', '2', '4', '<p>测试测试测试</p>', '<p>A 阿萨德<br/>B 洒水大所大<br/>C 萨达所大速度<br/>D 嗷嗷待食大所<br/></p>', '4', 'ABC', '<p>111</p>', '2', '', '1', '0', '2019-02-25 14:31:59', 'student', '0');

-- ----------------------------
-- Table structure for sys_subject
-- ----------------------------
DROP TABLE IF EXISTS `sys_subject`;
CREATE TABLE `sys_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CID` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `voice` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `voicecoin` decimal(10,0) DEFAULT NULL,
  `imagecoin` decimal(10,0) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `inuser` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_subject
-- ----------------------------
INSERT INTO `sys_subject` VALUES ('9', '67B540DB-0087-1F04-4839-54B503931A8F', '语文', '1', '1', '10', '10', '2019-02-15 15:35:38', 'admin');
INSERT INTO `sys_subject` VALUES ('10', '61C14409-90F9-218F-33A1-F79419F2090B', '高等数学', '1', '1', '10', '10', '2019-02-15 15:36:02', 'admin');
INSERT INTO `sys_subject` VALUES ('11', '6AD50832-1FF0-8D2C-7C06-E08F65914E2A', '英语', '1', '1', '20', '10', '2019-02-22 09:47:40', 'admin');
INSERT INTO `sys_subject` VALUES ('12', '74579318-81A0-BBB9-669C-D605E4ECE0FA', '计算机', '1', '1', '20', '10', '2019-02-22 09:47:30', 'admin');
INSERT INTO `sys_subject` VALUES ('13', '7801F3C0-F0D9-1E1F-6EC2-88EAFFD6CD86', '政策咨询', '1', '1', '10', '10', '2019-02-22 09:47:17', 'admin');

-- ----------------------------
-- Table structure for sys_teachanswerd
-- ----------------------------
DROP TABLE IF EXISTS `sys_teachanswerd`;
CREATE TABLE `sys_teachanswerd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answerid` int(11) DEFAULT NULL,
  `teachid` int(11) DEFAULT NULL,
  `cid` varchar(255) DEFAULT NULL,
  `teachcontent` varchar(255) DEFAULT NULL,
  `teachname` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `coin` decimal(10,0) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`answerid`,`teachid`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_teachanswerd
-- ----------------------------
INSERT INTO `sys_teachanswerd` VALUES ('19', '84', '55', 'EB87A9C9-E2C0-0AF3-EC39-DEF1FB7AA8CD', '提前准备，多做练习', '陈见柯', '5', '10', '2019-02-22 10:24:46');
INSERT INTO `sys_teachanswerd` VALUES ('20', '85', '57', 'DF5C3BAB-B6E6-AD4B-0D9D-AED095C06965', '1', 'test', '5', '10', '2019-02-22 11:08:14');
INSERT INTO `sys_teachanswerd` VALUES ('21', '88', '57', 'D285FB32-0B34-49B4-2E34-F79AC747B916', '阿打算', 'test', '5', '10', '2019-02-22 11:11:02');
INSERT INTO `sys_teachanswerd` VALUES ('22', '86', '57', 'CAB695F1-55C5-63B5-C5C6-3259289628E0', 'asdas', 'test', null, '10', '2019-02-22 11:14:45');
INSERT INTO `sys_teachanswerd` VALUES ('23', '87', '58', 'CE705CB7-D8D8-9E46-2C86-505D5E78CE7B', '一般在每年3月份下旬考试', '孟祥光', null, '10', '2019-02-22 11:29:05');
INSERT INTO `sys_teachanswerd` VALUES ('24', '83', '58', '07E2E786-CAA2-4E51-55E8-C7A60DBE5C71', '此问题无解', '孟祥光', null, '20', '2019-02-22 11:32:05');
INSERT INTO `sys_teachanswerd` VALUES ('25', '82', '58', 'FB615721-E6ED-7DCF-5AF7-C03B27BF0A15', '不好回答呀', '孟祥光', null, '10', '2019-02-22 11:33:02');
INSERT INTO `sys_teachanswerd` VALUES ('26', '89', '58', 'AC954546-9E02-49EA-6DF8-4DB68BAF8AA7', '这个问题好回答呀', '孟祥光', '5', '10', '2019-02-22 11:51:57');
INSERT INTO `sys_teachanswerd` VALUES ('27', '91', '58', '2F50A68B-0E3C-F5F6-94D2-ACCB69808BAA', '专升本考试重点在于词汇和阅读', '孟祥光', null, '10', '2019-02-22 16:23:31');
INSERT INTO `sys_teachanswerd` VALUES ('28', '90', '58', '7625ABB0-C380-1E06-BDD2-D7B66AD55646', '域名服务器的作用就是域名解析', '孟祥光', null, '10', '2019-02-22 16:24:12');
INSERT INTO `sys_teachanswerd` VALUES ('29', '95', '55', '846470E9-9F96-BC5F-5101-9FC8DC5A63BB', '回答见录音', '陈见柯', '3', '10', '2019-02-23 10:18:22');
INSERT INTO `sys_teachanswerd` VALUES ('30', '92', '58', '1CEDDADF-98BE-68F3-B375-38A7D32C40C2', '沙发沙发防辐射', '孟祥光', null, '10', '2019-02-23 10:27:47');
INSERT INTO `sys_teachanswerd` VALUES ('31', '92', '54', '68967B1F-DEDE-5A6C-0CA3-C60A61E781A6', '回答1', '刘玥', null, '10', '2019-02-23 10:28:05');
INSERT INTO `sys_teachanswerd` VALUES ('32', '92', '59', 'CCB01580-BC52-92ED-D028-98EFCDD1A4B3', '丁兴建的回答', '丁兴建', null, '10', '2019-02-23 10:28:15');
INSERT INTO `sys_teachanswerd` VALUES ('33', '97', '59', '16CC7426-2470-D7A0-8358-B165D577AEAE', '丁兴建的回答', '丁兴建', '3', '10', '2019-02-23 10:33:13');
INSERT INTO `sys_teachanswerd` VALUES ('34', '97', '54', 'E0D7399F-E666-2F68-BE8D-6090D2D038DF', '刘玥回答2', '刘玥', null, '10', '2019-02-23 10:34:00');
INSERT INTO `sys_teachanswerd` VALUES ('35', '110', '59', '7D318D3E-27DA-7C41-668D-769641D732A1', '丁兴建回答', '丁兴建', '5', '20', '2019-02-27 13:39:30');
INSERT INTO `sys_teachanswerd` VALUES ('36', '109', '58', '6315794B-4847-24FD-17F4-E7652621C204', ' meng xiang guang 回答', '孟祥光', '3', '10', '2019-02-27 14:49:30');
INSERT INTO `sys_teachanswerd` VALUES ('37', '105', '57', 'CA574E0B-889B-8657-52E3-1B85AFE43F7B', '111', 'test', null, '10', '2019-02-27 17:43:28');
INSERT INTO `sys_teachanswerd` VALUES ('38', '104', '57', '438810D1-8416-1410-F4B8-9CC650954757', '文本', 'test', null, '10', '2019-02-27 17:48:58');
INSERT INTO `sys_teachanswerd` VALUES ('39', '103', '57', '773EC624-554A-8356-E6FC-1D4DA1394C33', '回答啊', 'test', null, '10', '2019-02-27 17:55:34');
INSERT INTO `sys_teachanswerd` VALUES ('40', '81', '57', 'B981659E-00F4-DA5E-953A-114E615294A3', 'xjj', 'test', null, '10', '2019-02-28 11:04:57');
INSERT INTO `sys_teachanswerd` VALUES ('41', '116', '58', '87DB1CA9-199E-098C-5893-F2E5C740E42E', '孟祥光回答', '孟祥光', '4', '10', '2019-02-28 11:15:52');

-- ----------------------------
-- Table structure for sys_teachpay
-- ----------------------------
DROP TABLE IF EXISTS `sys_teachpay`;
CREATE TABLE `sys_teachpay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coin` int(11) DEFAULT NULL,
  `teachid` int(11) DEFAULT NULL,
  `teachname` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `indate` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT '1' COMMENT '1,未兑现，2银行卡转账',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_teachpay
-- ----------------------------
INSERT INTO `sys_teachpay` VALUES ('4', '20', '55', '陈见柯', '2019-02', '2019-02-22 10:24:46', '2');
INSERT INTO `sys_teachpay` VALUES ('5', '30', '57', 'test', '2019-02', '2019-02-22 11:08:14', '2');
INSERT INTO `sys_teachpay` VALUES ('6', '80', '58', '孟祥光', '2019-02', '2019-02-22 11:29:05', '2');
INSERT INTO `sys_teachpay` VALUES ('7', '20', '54', '刘玥', '2019-02', '2019-02-23 10:28:05', '2');
INSERT INTO `sys_teachpay` VALUES ('8', '20', '59', '丁兴建', '2019-02', '2019-02-23 10:28:15', '2');
INSERT INTO `sys_teachpay` VALUES ('9', '20', '59', '丁兴建', '2019-02', '2019-02-27 13:39:30', '1');
INSERT INTO `sys_teachpay` VALUES ('10', '20', '58', '孟祥光', '2019-02', '2019-02-27 14:49:30', '1');
INSERT INTO `sys_teachpay` VALUES ('11', '40', '57', 'test', '2019-02', '2019-02-27 17:43:28', '1');

-- ----------------------------
-- Table structure for sys_teachrole
-- ----------------------------
DROP TABLE IF EXISTS `sys_teachrole`;
CREATE TABLE `sys_teachrole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `sectionid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_teachrole
-- ----------------------------
INSERT INTO `sys_teachrole` VALUES ('1', '60', '8');
INSERT INTO `sys_teachrole` VALUES ('2', '60', '9');
INSERT INTO `sys_teachrole` VALUES ('3', '60', '10');

-- ----------------------------
-- Table structure for sys_type
-- ----------------------------
DROP TABLE IF EXISTS `sys_type`;
CREATE TABLE `sys_type` (
  `typeid` int(11) NOT NULL AUTO_INCREMENT,
  `examid` int(11) DEFAULT NULL,
  `typenum` varchar(255) DEFAULT NULL,
  `typename` varchar(255) DEFAULT NULL,
  `typeinfo` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1,单选，2多选，3填空，4文字',
  `inuser` varchar(255) DEFAULT NULL,
  `intime` datetime DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_type
-- ----------------------------
INSERT INTO `sys_type` VALUES ('1', null, null, null, null, null, null, null);
INSERT INTO `sys_type` VALUES ('2', '1', '1', '1', '1', '1', 'admin', '2019-01-15 17:24:55');
INSERT INTO `sys_type` VALUES ('3', '2', '一', '单选题', '每题两分', '1', 'admin', '2019-02-25 13:57:56');
INSERT INTO `sys_type` VALUES ('4', '2', '二', '多选题', '每题两分', '2', 'admin', '2019-02-25 13:58:14');

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) NOT NULL DEFAULT '',
  `UserFull` varchar(50) DEFAULT NULL,
  `UserPwd` varchar(100) DEFAULT NULL,
  `UserType` int(10) DEFAULT '3' COMMENT '1是学生,2教师,3其他',
  `RoleID` varchar(5) DEFAULT NULL,
  `UserEmail` varchar(50) DEFAULT NULL COMMENT '公司邮箱',
  `UserStatus` int(10) DEFAULT NULL,
  `LoginIp` varchar(200) DEFAULT NULL,
  `InTime` varchar(30) DEFAULT NULL COMMENT '新增時間',
  `InUserName` varchar(50) DEFAULT NULL,
  `Contact` varchar(30) DEFAULT '' COMMENT '管理教师工号或者学生工号',
  `AuthKey` varchar(255) DEFAULT NULL,
  `AccessToken` varchar(255) DEFAULT NULL,
  `Phone` char(20) DEFAULT NULL,
  `UserInfo` text,
  `CID` char(40) DEFAULT NULL,
  `AnswerSubject` varchar(255) DEFAULT NULL,
  `Bank` varchar(255) DEFAULT NULL,
  `BankNum` int(20) DEFAULT NULL,
  `Aliname` varchar(255) DEFAULT NULL,
  `Alinum` varchar(255) DEFAULT NULL,
  `SubId` varchar(255) DEFAULT NULL,
  `SubName` varchar(255) DEFAULT NULL,
  `CourseId` varchar(255) DEFAULT NULL,
  `CourseName` varchar(255) DEFAULT NULL,
  `SectionId` varchar(255) DEFAULT NULL,
  `SectionName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`UserName`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', 'admin', '管理员', '21232f297a57a5a743894a0e4a801fc3', '3', '1', '', '1', null, '2015-12-03', 'admin', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('2', 'student', '学生', '21232f297a57a5a743894a0e4a801fc3', '3', '3', null, '1', null, '2015-12-03', 'admin', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('53', '郑柳依', '郑柳依', '81dc9bdb52d04dc20036dbd8313ed055', '2', '4', null, '1', null, '2019-02-22 02:04:03', 'admin', '', null, null, '13108450233', '                                                                郑柳依,女，1986年出生，博士，国内知名大学外国语学院教师；\n教育经历：\n2008年，天津外国语大学本科毕业获文学学士学位；\n2010年，西班牙庞培发布拉大学毕业获翻译学硕士学位；\n2016年，西班牙康普顿斯大学毕业获文学博士学位；\n科研项目\n世界文化多样性与海外民族志，参与课题，2012年国家社科基金重点项目\n西译汉中的词汇归化异化”及其文化流失研究，主持人，2017年校级科研培育项目\n20世纪中叶侦探小说文学现象研究，主持人， 2018校级科研项目\n擅长：阅读、写作；\n山东省专升本入学考试大学英语命题研究组成员\n                                                               ', '22ED302E-89B8-1E3E-A44E-E288D2275A07', '12,11,10', '123', '123', 'test1', '123', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('54', '刘玥', '刘玥', 'e10adc3949ba59abbe56e057f20f883e', '2', '4', null, '1', null, '2019-02-18 10:08:29', 'admin', '', null, null, '13126815518', '刘玥老师介绍\n刘玥，1985年生,山东济南人，\n2014年在中国人民大学获博士文学学位；\n现为知名高校人文学院古代汉语教研室教师；\n主讲课程有《古代汉语》《汉语史》《中国语言学史》《汉语文字学》《汉语词汇学》等。\n参与多项国家社科重大项目课题研究，并发表论文若干。\n山东省专升本入学考试大学语文命题研究组成员', 'FF144E6A-2694-F72D-70E4-54630F86DC69', '13,9', '中国银行', '0', 'test2', '1231222222222', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('55', '陈见柯', '陈见柯', 'e10adc3949ba59abbe56e057f20f883e', '2', '4', null, '1', null, '2019-02-18 10:06:59', 'admin', '', null, null, '131268888888', '陈见柯，男，国内知名大学理工学院教师，博士后                                                                                ', '4C3ADCA9-17DD-2794-9186-78358207D858', '10', '北京银行', '333333333', 'test3', '444444444444', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('58', '孟祥光', '孟祥光', 'e10adc3949ba59abbe56e057f20f883e', '2', '4', null, '1', null, '2019-02-22 03:50:49', 'admin', '', null, null, '13120319662', '                                                        中国大学教师                                                                ', '71A7C956-9F4F-9A78-2EF4-919D02412473', '12,11,10,9', '北京银行', '2147483647', '田萱', '88888888888', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('57', 'test', 'test', '81dc9bdb52d04dc20036dbd8313ed055', '2', '4', null, '1', null, '2019-02-25 09:24:37', 'admin', '', null, null, '13108450233', '                                                                                                                                                                                                                                                                                                                                                                        ', '40EA43A2-5B0A-392E-3E28-068F4FE1932A', '13,12,11,10,9', 'test', '123123', 'test', 'test', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('56', '孙玲钰', '孙玲钰', 'e10adc3949ba59abbe56e057f20f883e', '2', '4', null, '1', null, '2019-02-18 10:07:48', 'admin', '', null, null, '13126815518', '孙凌钰老师，女，2014.06获得北京大学文学博士学位；\n主攻专业比较文学与世界文学；\n现任职于职某知名大学人文学院，任外国文学教研室讲师；\n主讲课程为本科生必修课“外国文学史”“西方文论概论”，选修课“西方文论经典导读”等；\n山东省专升本入学考试大学语文命题研究组组长', 'B1733FA1-DCC6-812B-A02D-E872EE2661A8', '12,9', '山东银行', '8888888', 'test4', '888888888888', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('59', '丁兴建', '丁兴建', 'e10adc3949ba59abbe56e057f20f883e', '2', '4', null, '1', null, '2019-02-23 10:25:01', 'admin', '', null, null, '11111111111111', '                                                            ', 'ACA0AADD-129F-4813-F3CC-327BFE583264', '13,12,11,10,9', '北京银行', '888888888', '丁', '666666666666', null, null, null, null, null, null);
INSERT INTO `sys_user` VALUES ('60', '测试老师', '测试老师', '81dc9bdb52d04dc20036dbd8313ed055', '2', '2', null, '1', null, '2019-02-25 01:59:16', 'admin', '', null, null, '13188888888', '                                                            ', '1DE2B181-894A-6CBE-F90D-003AD83E5A40', null, null, null, null, null, 'f23', '高等数学', 's99', '课程2020年山东专升本考试辅导高等数学II基础班', 't8,t9,t10', '第一单元,第二单元,第三单元');
