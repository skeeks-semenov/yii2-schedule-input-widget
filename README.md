Work schedule widget for yii2
=====================

A small element for the form of the yii2 framework. Allows you to select working days and time for working on them. Ability to select multiple ranges for one day.

[![Latest Stable Version](https://poser.pugx.org/skeeks/yii2-schedule-input-widget/v/stable.png)](https://packagist.org/packages/skeeks/yii2-schedule-input-widget)
[![Total Downloads](https://poser.pugx.org/skeeks/yii2-schedule-input-widget/downloads.png)](https://packagist.org/packages/skeeks/yii2-schedule-input-widget)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist skeeks/yii2-schedule-input-widget "*"
```

or add

```
"skeeks/yii2-schedule-input-widget": "*"
```


How to use without model
----------

```php

\skeeks\yii2\scheduleInputWidget\ScheduleInputWidget::widget([
    'name' => 'schedule'
]);

```

How to use with model
----------

```php

$form = new \yii\widgets\ActiveForm();

$form->field($model, 'schedule')->widget(
    \skeeks\yii2\scheduleInputWidget\ScheduleInputWidget::class
);

```


Screenshot
------------

[![Work schedule widget for yii2](https://cms.skeeks.com/uploads/all/fc/56/8c/fc568ca078ab03db47b4e87e432d5ce3.png)](https://cms.skeeks.com/uploads/all/fc/56/8c/fc568ca078ab03db47b4e87e432d5ce3.png)

[![Work schedule widget for yii2](https://cms.skeeks.com/uploads/all/06/59/13/065913f9bf27e59f1ad3b7ad092faf44.png)](https://cms.skeeks.com/uploads/all/06/59/13/065913f9bf27e59f1ad3b7ad092faf44.png)


Video
------------

[![Work schedule widget for yii2](https://img.youtube.com/vi/mSZi8ukgngA/maxresdefault.jpg)](https://www.youtube.com/watch?v=mSZi8ukgngA)



Links
----------
* [Github](https://github.com/skeeks-semenov/yii2-schedule-input-widget)
* [Changelog](https://github.com/skeeks-semenov/yii2-schedule-input-widget/blob/master/CHANGELOG.md)
* [Issues](https://github.com/skeeks-semenov/yii2-schedule-input-widget/issues)
* [Packagist](https://packagist.org/packages/skeeks/yii2-schedule-input-widget)

___

> [![skeeks!](https://skeeks.com/img/logo/logo-no-title-80px.png)](https://skeeks.com)  
<i>SkeekS CMS (Yii2) — fast, simple, effective!</i>  
[skeeks.com](https://skeeks.com) | [cms.skeeks.com](https://cms.skeeks.com)

