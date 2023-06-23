# 客户端 API

## 应用

- 应用信息 - chaty.app.info
- 更新应用信息 - chaty.app.update
- 更新应用名 - chaty.app.updateName
- 更新设备通知地址 - chaty.app.updateDeviceNotifyUrl
- 更新设备通知地址(钉钉渠道) - chaty.app.updateDeviceNotifyDingtalkAccessToken
- 更新机器人通知地址 - chaty.app.updateRobotNotifyUrl
- 更新机器人通知地址(钉钉渠道) - chaty.app.updateRobotNotifyDingtalkAccessToken

## 设备

- 应用下设备列表 - chaty.device.list
- 查询单个设备 - chaty.device.find
- 设备下发客户端原生消息 - chaty.device.sendMessage

## 第三方用户

- 查询单个用户 - chaty.profile.find

## 机器人

基础

- 应用下机器人列表 - chaty.robot.list
- 查询单个机器人 - chaty.robot.find
- 机器人下发客户端原生消息 - chaty.robot.sendMessage

身份验证

- 获取机器人登录二维码 - chaty.robot.auth.qrcode
- 机器人退出登录 - chaty.robot.auth.logout

联系人

- 机器人发送好友申请 - chaty.robot.contact.sendApplication
- 机器人对联系人发送文本消息 - chaty.robot.contact.sendTextMessage
- 机器人对联系人发送图片消息 - chaty.robot.contact.sendImageMessage
- 机器人对联系人发送链接消息 - chaty.robot.contact.sendLinkMessage
- 机器人对联系人发送视频消息 - chaty.robot.contact.sendVideoMessage

群

- 机器人建群 - chaty.robot.room.create
- 机器人更新群内昵称 - chaty.robot.room.updateNick
- 机器人更新群消息通知状态 - chaty.robot.room.updateNotificationStatus
- 机器人通过群二维码入群 - chaty.robot.room.joinByQrcode
- 机器人对群发送文本消息 - chaty.robot.room.sendTextMessage
- 机器人对群发送图片消息 - chaty.robot.room.sendImageMessage
- 机器人对群发送链接消息 - chaty.robot.room.sendLinkMessage
- 机器人对群发送视频消息 - chaty.robot.room.sendVideoMessage
- 机器人退群 - chaty.robot.room.delete

## 联系人

- 应用下联系人列表 - chaty.contact.list  
- 机器人所属人下的联系人列表 - chaty.contact.listByRobotProfile
- 查询单个联系人 - chaty.contact.find

## 群

- 应用下群列表 - chaty.room.list
- 机器人所属人下的群列表 - chaty.room.listByRobotProfile
- 查询单个群 - chaty.room.find

## 群联系人

- 应用下群联系人列表 - chaty.roomContact.list
- 所属群下的群联系人列表 - chaty.roomContact.listByRoom
- 查询单个群联系人 - chaty.roomContact.find

