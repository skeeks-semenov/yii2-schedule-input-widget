<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 02.03.2016
 */
/* @var $this yii\web\View */
/* @var $widget \common\widgets\WorkTimeInputWidget */
$widget = $this->context;
$this->registerCss(<<<CSS
.sx-widget-work-time label
{
    display: initial;
    margin-right: 10px;
}
CSS
);

$options = $widget->options;
\yii\helpers\Html::addCssClass($options, 'sx-widget-work-time')
?>

<?= \yii\helpers\Html::beginTag('div', $options); ?>
        <div>
            <? echo \yii\helpers\Html::hiddenInput(
                \yii\helpers\Html::getInputName($widget->model, $widget->attribute)
            ); ?>
            <?= $element; ?>
        </div>

        <div class="sx-elements-wrapper">
        </div>
        <a class="btn btn-default btn-sm sx-btn-add-row"><i class="glyphicon glyphicon-plus"></i> <?= \Yii::t('skeeks/cms', 'Add')?></a>

<?
\yii\jui\Sortable::widget();
$jsOptions = \yii\helpers\Json::encode($widget->clientOptions);
$this->registerCss(<<<CSS
.sx-elements-wrapper .row
{
    margin-top: 0px;
    margin-bottom: 10px;
    cursor: move;
}
CSS
);
$this->registerJs(<<<JS
(function(sx, $, _)
{
    sx.classes.WorkTime = sx.classes.Component.extend({
        _init: function()
        {
            var self = this;
        },
        _onDomReady: function()
        {
            this.counter = 0;
            var self = this;
            self.jWrapper = $('#' + this.get('id'));
            self.jElementsWrapper = $('.sx-elements-wrapper', self.jWrapper);
            self.jValuesWrapper = $('.sx-values-wrapper', self.jWrapper);
            self.jAddRow = $('.sx-btn-add-row', self.jWrapper);
            self.jElementsWrapper.sortable(
                {
                    /*cursor: "move",
                    handle: ".sx-btn-move",*/
                    forceHelperSize: true,
                    forcePlaceholderSize: true,
                    opacity: 0.5,
                    placeholder: "ui-state-highlight",
                }
            );
            self.jAddRow.on('click', function()
            {
                self.createRow();
                return false;
            });
            if (this.get('value'))
            {
                _.each(this.get('value'), function(value, key)
                {
                    self.createRow(value);
                });
            }
        },
        createRow: function(data)
        {
            var self = this;
            var day    = '';
            if (data && data.day)
            {
                day = data.day;
            }

            if (!day && this.counter == 0)
            {
                day = ['1', '2', '3', '4', '5'];
            }



            var Days = {
                '1' : 'Пн',
                '2' : 'Вт',
                '3' : 'Ср',
                '4' : 'Чт',
                '5' : 'Пт',
                '6' : 'Сб',
                '7' : 'Вс'
            };

            var Minutes = {
                '00' : '00',
                '15' : '15',
                '30' : '30',
                '45' : '45',
            };

            var Hours = {
                '00' : '00',
                '01' : '01',
                '02' : '02',
                '03' : '03',
                '04' : '04',
                '05' : '05',
                '06' : '06',
                '07' : '07',
                '08' : '08',
                '09' : '09',
                '10' : '10',
                '11' : '11',
                '12' : '12',
                '13' : '13',
                '14' : '14',
                '15' : '15',
                '16' : '16',
                '17' : '17',
                '18' : '18',
                '19' : '19',
                '20' : '20',
                '21' : '21',
                '22' : '22',
                '23' : '23',
            };

            var Hours = [
                '00',
                '01',
                '02',
                '03',
                '04',
                '05',
                '06',
                '07',
                '08',
                '09',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
            ];


            //Выбор дня недели
            var jDays = $("<div>");
            _.each(Days, function(label, value)
            {
                var isChecked = false;
                if (_.indexOf(day, value) != -1)
                {
                    isChecked = "checked";
                }
                var jInputDay = $("<input>", {
                    'type': 'checkbox',
                    'value': value,
                    'name': self.get('inputName') + '[' + self.counter + '][day][]',
                    'checked': isChecked
                });

                jDays.append($("<label>").append(jInputDay).append(label));
            });

            var startHour = $("<select>", {
                //'class': 'form-control',
                'name': self.get('inputName') + '[' + this.counter + '][startHour]',
            });
            var endHour = $("<select>", {
                //'class': 'form-control',
                'name': self.get('inputName') + '[' + this.counter + '][endHour]',
            });

            var startMinutes = $("<select>", {
                //'class': 'form-control',
                'name': self.get('inputName') + '[' + this.counter + '][startMinutes]',
            });
            var endMinutes = $("<select>", {
                //'class': 'form-control',
                'name': self.get('inputName') + '[' + this.counter + '][endMinutes]',
            });

            _.each(Hours, function(label, value)
            {
                startHour.append($('<option>', {'value':label}).append(label));
                endHour.append($('<option>', {'value':label}).append(label));
            });
            _.each(Minutes, function(label, value)
            {
                startMinutes.append($('<option>', {'value':value}).append(value));
                endMinutes.append($('<option>', {'value':value}).append(value));
            });

            if (data && data.startHour)
            {
                startHour.val(data.startHour);
            } else
            {
                startHour.val('09');
            }
            if (data && data.endHour)
            {
                endHour.val(data.endHour);
            } else
            {
                endHour.val('18');
            }
            if (data && data.startMinutes)
            {
                startMinutes.val(data.startMinutes);
            } else
            {
                startMinutes.val('00');
            }

            if (data && data.endMinutes)
            {
                endMinutes.val(data.endMinutes);
            } else
            {
                endMinutes.val('00');
            }



            var jRemoveBtn = $("<a>", {
                'href': '#',
                'class': 'btn btn-sm btn-default',
            }).append('<i class="glyphicon glyphicon-remove"></i>');
            var jRow = $("<div>", {'class': 'row'});
            jRow
                .append($("<div>", {"class": "col-md-5", "style": "margin-top: 10px;"}).append(jDays))
                .append($("<div>", {"class": "col-md-5"}).append(startHour).append(":").append(startMinutes).append(" — ").append(endHour).append(":").append(endMinutes))
                .append($("<div>", {"class": "col-md-1"}).append(""))
                //.append($("<div>", {"class": "col-md-3"}).append(endHour).append(":").append(endMinutes))
                .append($("<div>", {"class": "col-md-1"}).append(jRemoveBtn));
            jRemoveBtn.on('click', function()
            {
                jRow.remove();
                return false;
            });
            /*jInputKey.on('change', function()
            {
                jOption.val($(this).val());
                self.jElement.change();
                return false;
            });
            jInputVal.on('change', function()
            {
                jOption.empty().append($(this).val());
                self.jElement.change();
                return false;
            });*/
            jRow.appendTo(self.jElementsWrapper);
            this.counter = this.counter + 1;
        }
    });
    new sx.classes.WorkTime({$jsOptions});
})(sx, sx.$, sx._);
JS
); ?>
<?= \yii\helpers\Html::endTag('div'); ?>