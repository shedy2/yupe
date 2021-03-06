<?php

class CatalogModule extends YWebModule
{
    public $editor = 'application.modules.yupe.widgets.editors.imperaviRedactor.EImperaviRedactorWidget';
    public $uploadPath = 'catalog';

    public function getUploadPath()
    {
        return  Yii::getPathOfAlias('webroot') . '/' .
                Yii::app()->getModule('yupe')->uploadPath . '/' .
                $this->uploadPath . '/';
    }

    public function checkSelf()
    {
        $uploadPath = Yii::getPathOfAlias('webroot') . '/' . Yii::app()->getModule('yupe')->uploadPath . '/' . $this->uploadPath;

        if (!is_writable($uploadPath))
            return array(
                'type'    => YWebModule::CHECK_ERROR,
                'message' => Yii::t('catalog', 'Директория "{dir}" не доступна для записи! {link}', array(
                    '{dir}'  => $uploadPath,
                    '{link}' => CHtml::link(Yii::t('catalog', 'Изменить настройки'), array(
                        '/yupe/backend/modulesettings/',
                        'module' => 'catalog',
                    )),
                )),
            );
    }

    public function getEditableParams()
    {
        return array(
            'uploadPath',
            'adminMenuOrder',
        );
    }

    public function getParamsLabels()
    {
        return array(
            'adminMenuOrder' => Yii::t('category', 'Порядок следования в меню'),
            'uploadPath'     => Yii::t('yupe', 'Каталог для загрузки файлов (относительно Yii::app()->getModule("yupe")->uploadPath)'),
        );
    }

    public function getNavigation()
    {
        return array(
            array('icon' => 'plus-sign', 'label' => Yii::t('catalog', 'Добавить товар'), 'url' => array('/catalog/default/create/')),
            array('icon' => 'th-list', 'label' => Yii::t('catalog', 'Список товаров'), 'url' => array('/catalog/default/index/')),
        );
    }

    public function getAdminPageLink()
    {
        return '/catalog/default/';
    }
    
    public function getVersion()
    {
        return '0.1 (dev)';
    }

    public function getCategory()
    {
        return Yii::t('catalog', 'Контент');
    }

    public function getName()
    {
        return Yii::t('catalog', 'Каталог товаров');
    }

    public function getDescription()
    {
        return Yii::t('catalog', 'Модуль для создания простого каталога товаров');
    }

    public function getAuthor()
    {
        return Yii::t('catalog', 'yupe team');
    }

    public function getAuthorEmail()
    {
        return Yii::t('catalog', 'team@yupe.ru');
    }

    public function getUrl()
    {
        return Yii::t('catalog', 'http://yupe.ru');
    }

    public function getIcon()
    {
        return 'shopping-cart';
    }

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'catalog.models.*',
            'catalog.components.*',
            'category.models.*',
        ));
    }

}
