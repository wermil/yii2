<?php

namespace frontend\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Breadcrumbs
 */
class Breadcrumbs extends \yii\bootstrap4\Breadcrumbs
{
    /**
     * Renders the widget.
     * @throws InvalidConfigException
     */
    public function run()
    {
        $this->registerPlugin('breadcrumb');

        if (empty($this->links)) {
            return '';
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('dashboard', 'Dashboard'),
                'url' => Url::to('/dashboard/main'),
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        return Html::tag($this->tag, implode('', $links), $this->options);
    }

}
