# vmall

[![Dependency Status](https://david-dm.org/vicvinc/imall.svg)](https://david-dm.org/vicvinc/imall)
[![devDependency Status](https://david-dm.org/vicvinc/imall/dev-status.svg)](https://david-dm.org/vicvinc/imall#info=devDependencies)
[![Build Status](https://travis-ci.org/vicvinc/vomic.svg?branch=master)](https://travis-ci.org/vicvinc/imall)

基于 Laravel 和 Vue 的微信商城

## 📦 install

### Be install

```bash
composer install

composer artisan key:generate

composer artisan migrate

php artisan db:seed --class=DatabaseSeeder
```

### Fe install

```bash

yarn install

```

## 💻 dev

```bash

php artisan serve

yarn watch

```

## 🔨 build

```bash

yarn prod

```

## 🚀 deploy

```bash

tobe continue...

```

## 🌀 todo

- rebuild model.

- phone register.

## 💫 PS

重构自[iMall](https://github.com/PassionZale/iMall)

感谢原作者的第一版，节省了很多时间！！！👏👏👏

在原作者的基础上，做的更改：

- 升级 Vue 到 2.0
- 升级部分 Laravel 依赖包
- Fe api 更新
- Model 更新
- 重构 UI 的管理
- 调整了 Vue 的集成工具

## screen shot

![mall](./screen_shot.png)

### 注意，测试账号需要配置微信登陆回调地址，只能为 ip 或者域名，不能带端口
