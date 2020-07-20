<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */

namespace skeeks\yii2\scheduleInputWidget;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
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
                \yii\helpers\Html::getInputName($this->model, $this->attribute)
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

    /**
     * @param array $work_time
     * @return array
     */
    static public function getWorkingData($work_time = [])
    {
        $daysLib = [
            1 => "Пн",
            2 => "Вт",
            3 => "Ср",
            4 => "Чт",
            5 => "Пт",
            6 => "Сб",
            7 => "Вс",
        ];
        $result = [];
        if ($work_time) {
            $result = $work_time;

            foreach ($work_time as $key => $row) {
                $daysString = [];
                $days = ArrayHelper::getValue($row, 'day');
                if ($days) {
                    foreach ($days as $dayKey => $day) {
                        $daysString[$day] = $daysLib[$day];
                    }
                }

                $result[$key]['daysStrings'] = $daysString;
            }
        }

        return $result;
    }
}