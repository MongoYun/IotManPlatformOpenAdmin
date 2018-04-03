# IotMan物联平台后台Api说明

## 用户登陆
### 地址:/User/Login/
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:UserName和PassWord
### 例子：curl /User/Login/ --data 

## 获取登录验证码
### 地址:/User/LoginAuthCode
### 请求方式:GET/POST
### 详情:
### GET/POST参数:无
### 例子：curl /User/LoginAuthCode -G -o LoginAuthCode.png

## 获取登录当前登录状态
### 地址:/User/Login_status
### 请求方式:GET/POST
### 详情:
### GET/POST参数:无
### 例子：curl "http://iotman.cnxel.cn/User/Login_status" -H "Host: iotman.cnxel.cn" -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data ""
### 返回登录状态，用户名和qq

## 添加设备
### 地址:/UserSAddDevice/Add
### 请求方式:POST
### 详情:
### POST参数名:PostData
### POST参数值:JSON结构。
### JSON节点名:DeviceId，DeviceUserName和DevicePasswd
### 例子：curl "http://iotman.cnxel.cn/UserSDevice/Add" -H "Host: iotman.cnxel.cn" -H "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"  -H "Cookie: PHPSESSID=6md56mr8fog0iuor067g44aek2" --data "PostData={"DeviceId":"test","DeviceUsername":"test","DevicePassword":"test"}"
### 返回增加状态

