# IotMan物联平台后台Api说明

## 用户登陆
### 地址:/User/Login/
### 请求方式:POST
### 详情:
### POST参数名:UserName和PassWord
<!--POST参数名:PostData-->
<!--POST参数值:JSON结构。-->
<!--JSON节点名:UserName和PassWord-->
### 例子：
```
curl "http://iotman.cnxel.cn/User/Login" -H "Host: iotman.cnxel.cn" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8" --data "Username=test&Password=Password&Captcha=ezzw"
```

## 获取登录验证码
### 地址:/User/LoginAuthCode
### 请求方式:GET/POST
### 详情:
### GET/POST参数:无
### 例子：
```
curl /User/LoginAuthCode -G -o LoginAuthCode.png
```

## 获取登录当前登录状态
### 地址:/User/Login_status
### 请求方式:GET/POST
### 详情:
### GET/POST参数:无
### 例子：
```
curl "http://iotman.cnxel.cn/User/Login_status" -H "Host: iotman.cnxel.cn" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data ""
```

### 返回登录状态，用户名和qq

## 增加设备
### 地址:/UserSAddDevice/Add
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:DeviceId，DeviceUserName和DevicePasswd
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDevice/Add" -H "Host: iotman.cnxel.cn" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"  -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data "PostData={"DeviceId":"test","DeviceUsername":"test","DevicePassword":"test"}"
```
### 返回增加设备状态

## 编辑设备
### 维护中

## 删除设备
### 地址:/UserSAddDevice/Delete
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:UserName，DeviceId，DeviceUserName和DevicePasswd
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDevice/Delete" -H "Host: iotman.cnxel.cn"  -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data "PostData={"UserName":"test","DeviceId":"TestDevice","DeviceUserName":"TestDevice","DevicePasswd":"TestDevice"}"
```
### 返回删除设备的状态

## 添加主题
### 地址:/UserSDeviceTopic/AddTopicName
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:TopicName
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDeviceTopic/AddTopicName" -H "Host: iotman.cnxel.cn" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data "PostData={"TopicName":"TestTopic"}"
```
### 返回添加主题的状态

## 开启设备的订阅主题权限
### 地址:/UserSDeviceTopic/SaveDeviceToSubTopicControl
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:TopicName，DeviceId和Control（1，开启，2，关闭）
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDeviceTopic/SaveDeviceToSubTopicControl" -H "Host: iotman.cnxel.cn"  -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"  -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data "PostData={"TopicName":"TestTopic","DeviceId":"TestDevice","Control":"1"}"
```
### 返回开启设备的订阅主题权限的状态

## 设置设备的订阅主题QOS
### 地址:/UserSDeviceTopic/SaveDeviceToSubTopicControlQosLevel
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:TopicName，DeviceId和Qos（QOS值）
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDeviceTopic/SaveDeviceToSubTopicControlQosLevel" -H "Host: iotman.cnxel.cn" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"  -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2"  --data "PostData={"TopicName":"TestTopic","DeviceId":"TestDevice","Qos":"0"}"
```
### 返回设置设备的订阅主题权限的状态

## 设置设备的订阅主题QOS
### 地址:/UserSDeviceTopic/SaveDeviceToSubTopicControlQosLevel
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:TopicName，DeviceId和Control（1，开启，2，关闭）
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDeviceTopic/SaveDeviceToPubTopicControl" -H "Host: iotman.cnxel.cn" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"  -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2"  --data "PostData={"TopicName":"TestTopic","DeviceId":"TestDevice","Control":"1"}"
```

### 返回设置设备的订阅主题QOS的状态

## 获取当前用户主题列表
### 地址:/UserSDeviceTopic/SelectTopicName
### 请求方式:GET/POST
### 详情:
### GET/POST参数名:无
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDeviceTopic/SelectTopicName" -H "Host: iotman.cnxel.cn" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data ""
```

### 返回当前用户主题列表

## 获取当前用户设备列表
### 地址:/UserSDevice/Select
### 请求方式:GET/POST
### 详情:
### GET/POST参数名:无
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDevice/Select" -H "Host: iotman.cnxel.cn" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data ""
```

### 返回当前用户设备列表

## 获取当前用户设备状态列表
### 地址:/UserSDeviceStatus/Select
### 请求方式:GET/POST
### 详情:
### GET/POST参数名:无
### 例子：
```
curl "http://iotman.cnxel.cn/UserSDeviceStatus/Select" -H "Host: iotman.cnxel.cn" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data ""
```
### 返回当前用户设备状态列表