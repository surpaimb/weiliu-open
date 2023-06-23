# 服务端上报事件

## 设备事件上报

> 格式
> 
> event.type - 事件描述
>
> 事件上报字段描述

- qrcode.geted - 二维码-已获取

  ```json
  {
    "os": "os", // ipados/android
    "event": "qrcode",
    "type": "geted", 
    "device_id": "device.id", // 设备主键id
    "deviceid": "deviceid", // 设备外部id
    "uuid": "uuid", // 二维码事件 uuid
    "content": "content" // 二维码内容
  }
  ```

- qrcode.scaning - 二维码-扫描中
- qrcode.logining - 二维码-登录中
- qrcode.canceled - 二维码-已取消

  ```json
  {
    "os": "os", // ipados/android
    "event": "qrcode",
    "type": "scaning", // scaning 或 logining 或 canceled 
    "device_id": "device.id", // 设备主键id
    "deviceid": "deviceid", // 设备外部id
    "uuid": "uuid" // 二维码事件 uuid
  }
  ```

- qrcode.logined - 二维码-登录成功

  ```json
  {
    "os": "os", // ipados/android
    "event": "qrcode",
    "type": "logined", 
    "device_id": "device.id", // 设备主键id
    "deviceid": "deviceid", // 设备外部id
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "uuid": "uuid" // 二维码事件 uuid
  }
  ```

## 机器人事件上报

- status.online - 状态-上线

  ```json
  {
    "os": "os", // ipados/android
    "event": "status",
    "type": "online", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid" // 机器人外部id
  }
  ```

- status.offline - 状态-下线

  ```json
  {
    "os": "os", // ipados/android
    "event": "status",
    "type": "offline", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid" // 机器人外部id
  }
  ```
- contact.application - 联系人-对方发送来了好友申请
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "contact",
    "type": "application", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "profile_id": "profile.id", // 第三方用户主键id
    "profileid": "profile.unionid", // 第三方用户外部id
    "content": "你好" // 招呼
  }
  ```
  
- contact.passed - 联系人-对方通过了好友申请
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "contact",
    "type": "passed", 
    "oneway": true, // 单向通过好友时携带(即对方已存在你的好友)
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "contact_id": "contact.id", // 联系人主键id
    "contactid": "contact.profile.unionid" // 联系人外部id
  }
  ```
  
- contact.existed - 联系人-好友申请发送失败，好友已存在
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "contact",
    "type": "existed", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "contact_id": "contact.id", // 联系人主键id
    "contactid": "contact.profile.unionid" // 联系人外部id
  }
  ```
  
- room.created - 群-群数据创建
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "room",
    "type": "created", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "room_id": "room.id", // 群主键id
    "roomid": "room.roomid", // 群外部id
    "uuid": "uuid" // 存在此字段则为通过建群接口创建
  }
  ```
  
- room.joining_success - 群-加入成功
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "room",
    "type": "joining_success", 
    "uuid": "uuid", // 消息唯一id
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "room_id": "room.id", // 群主键id(扫码入群有传递才有)
    "roomid": "room.roomid", // 群外部id(扫码入群有传递才有)
    "qrcode": "qrcode" // 扫码入群则是二维码链接
  }
  ```
  
- room.joining_failed - 群-加入失败
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "room",
    "type": "joining_failed", 
    "uuid": "uuid", // 消息唯一id
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "room_id": "room.id", // 群主键id(扫码入群有传递才有)
    "roomid": "room.roomid", // 群外部id(扫码入群有传递才有)
    "failed_type": "expired/none_realname/existed/errored", // 失败类型，依次为 二维码过期/未实名/群存在/其他错误
    "qrcode": "qrcode" // 扫码入群则是二维码链接
  }
  ```
  
- room_contact.created - 群联系人-群联系人数据创建

  ```json
  {
    "os": "os", // ipados/android
    "event": "room_contact",
    "type": "created", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "room_id": "room.id", // 群主键id
    "roomid": "room.roomid", // 群外部id
    "room_contact_id": "room_contact.id", // 群联系人主键id
    "roomcontactid": "room_contact.profile.unionid" // 群联系人外部id
  }
  ```
  
- room_contact.deleted - 群联系人-群联系人数据删除

  ```json
  {
    "os": "os", // ipados/android
    "event": "room_contact",
    "type": "deleted", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "room_id": "room.id", // 群主键id
    "roomid": "room.roomid", // 群外部id
    "roomcontactid": "room_contact.profile.unionid" // 群联系人外部id
  }
  ```
  
- message.text - 消息-文本消息
  
  ```json
  {
    "os": "os", // ipados/android
    "event": "message",
    "type": "text", 
    "robot_id": "robot.id", // 机器人主键id
    "robotid": "robot.profile.unionid", // 机器人外部id
    "contact_id": "contact.id", // 联系人主键id
    "contactid": "contact.profile.unionid", // 联系人外部id
    "data": {
      "id": "id",
      "text": "text",
      "time": "time"
    }
  }
  ```
