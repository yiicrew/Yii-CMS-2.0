<?php
Yii::import('media.portlets.BaseFileListView');
class
ImageGallery extends BaseFileListView
{
    public $emptyText = '';
    public $template = "{items}<div style='clear:both'></div>{pager}";
    public $fancyboxOptions = [];
    public $defaultFancyboxOptions = [
        'openEffect'  => 'fade',
        'closeEffect' => 'fade',
        'closeSpeed'  => 0,
        'prevEffect'  => 'fade',
        'nextEffect'  => 'fade',
        'minWidth'    => '800px',
        'autoCenter'  => false,
        'mouseWheel'  => false,
        'helpers'     => [
            'title'   => [
                'type' => 'over'
            ],
            'overlay' => [
                'closeClick' => true,
                'speedOut'   => 200,
                'showEarly'  => true
            ],
            'media'   => [],
            'vkstyle' => [],
            'thumbs'  => [
                'width'    => 100,
//                'height' => 50,
                'position' => 'top'
            ]
        ],
    ];

    public $itemView = 'media.portlets.views.imageGalleryItem';
    public $itemsTagName = 'div';
//    public $enablePagination = false;


    public $sortableEnable = true;
    public $sortableOptions = [
        'class'   => 'application.components.zii.behaviors.SortableBehavior',
        'saveUrl' => '/media/mediaFileAdmin/savePriority'
    ];

    public $size = [
        'width'  => 112,
        'height' => 50
    ];

    public $htmlOptions = [
        'class' => 'image-gallery'
    ];


    public function init()
    {
        if ($this->sortableEnable)
        {
            $this->attachBehavior('sortable', $this->sortableOptions);
        }
        parent::init();
    }


    public function registerScripts($comment_widget_id = null)
    {

        $id     = $this->htmlOptions['id'];
        $assets = $this->assets . '/plugins/';

        if ($this->fancyboxOptions !== false)
        {
            $this->fancyboxOptions['helpers']['vkstyle']['comment_widget_id'] = $comment_widget_id;
            $options = CJavaScript::encode(CMap::mergeArray($this->defaultFancyboxOptions,
                $this->fancyboxOptions));
            Yii::app()->clientScript->registerScriptFile($assets . 'fancybox/jquery.fancybox.js')
                ->registerCssFile($assets . 'fancybox/jquery.fancybox.css')->registerScriptFile(
                $assets . 'fancybox/helpers/jquery.fancybox-thumbs.js')->registerCssFile(
                $assets . 'fancybox/helpers/jquery.fancybox-thumbs.css')->registerScriptFile(
                $assets . 'fancybox/helpers/jquery.fancybox-media.js')->registerCssFile(
                $assets . 'fancybox/helpers/jquery.fancybox-vkstyle.css')->registerScriptFile(
                $assets . 'fancybox/helpers/jquery.fancybox-vkstyle.js')
                ->registerScript($id, "$('#$id a').fancybox($options);");
        }
    }

    public function run()
    {

        $widget = $this->widget('comments.portlets.CommentsPortlet', array(
            'model' => false,
            'is_hidden' => true
        ));

        $this->registerScripts($widget->getId());
        parent::run();
    }

}