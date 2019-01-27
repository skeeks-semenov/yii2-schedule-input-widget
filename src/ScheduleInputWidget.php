<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\scheduleInputWidget;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class ScheduleInputWidget extends InputWidget
{
    /**
     * @var string
     */
    public static $autoIdPrefix = 'ScheduleInputWidget';

    /**
     * @var array опции контейнера
     */
    public $options = [];
    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->options['id'] = $this->id."-widget";
        $this->options['class'] = "";
        $this->clientOptions['id'] = $this->id."-widget";
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $element = '';
        if ($this->hasModel()) {
            $this->clientOptions['inputName'] = Html::getInputName($this->model, $this->attribute);
            $this->clientOptions['value'] = $this->model->{$this->attribute};

            $hiddenInput = \yii\helpers\Html::hiddenInput(
                \yii\helpers\Html::getInputName($widget->model, $widget->attribute)
            );
        } else {
            $this->clientOptions['inputName'] = $this->name;
            $this->clientOptions['value'] = $this->value;

            $hiddenInput = \yii\helpers\Html::hiddenInput($this->name, $this->value);
        }
        return $this->render('schedule-input', [
            'element' => $element,
            'hiddenInput' => $hiddenInput,
        ]);
    }
}