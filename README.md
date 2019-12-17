# 学生选课系统——CourseSelectSystem
##PHP——MVC框架期末课题设计
一、系统功能
---
1、系统使用
+ 管理员账号：`admin`
+ 管理员密码：`123456`
+ 用户账号密码可以在数据库内查看，数据库文件为：`SSC.sql`

2、 项目结构
```
SSC
├─index.php       入口文件
├─SSC.sql         数据库文件
├─README.md       README文件
├─application     应用目录
│  ├─admin        	后台目录
│  │  ├─Controller   	应用控制器目录
│  │  ├─Model        	应用模型目录
│  │  └─View        	应用视图目录
│  ├─config      	应用配置文件目录
│  └─home        	 前台目录
│     ├─Controller   	 应用控制器目录
│     ├─Model       	 应用模型目录
│     └─View        	 应用视图目录
├─framework       基础类文件目录
│  └─smarty		  	   smarty目录
└─Public          资源文件目录
   ├─course_material  课程资料上传存放目录
   ├─css          	css样式文件目录
   │  └─slef	                  自定义样式文件目录
   ├─img          	引用图片目录
   ├─js           	js文件目录
   ├─student_work 	学生作业上传存放目录     
   └─teacher_work 	教师作业发布存放目录
```