<?

function getObjectUpdateUrl($object_id, $model)
{
    try
    {
        if (!is_numeric($object_id) || !method_exists($model, 'updateUrl'))
        {
            return;
        }

        $object = ActiveRecord::model($model)->findByPk($object_id);
        if (!$object)
        {
            return;
        }

        return CHtml::link('перейти', $object->updateUrl());
    } catch (Exception $e)
    {
        return 'Удален';
    }
}


function getFileLink($data)
{
    return Chtml::link($data->getThumb(), $data->getUrl());
}


$this->widget('AdminGridView', [
    'id'           => 'mediaFile-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => [
        [
            'value'  => 'getFileLink($data);',
            'type'   => 'raw',
            'filter' => false
        ],
        [
            'name'   => 'title',
        ],
        [
            'name'   => 'tag',
            'value'  => '$data->tag',
            'filter' => false
        ],
        [
            'filter' => false
        ],
        [
            'header' => 'Объект',
//            'value'  => 'getObjectUpdateUrl($data->object_id, $data->model_id)',
            'value'  => '',
            'type'   => 'raw',
            'filter' => false
        ],
//        [
//            'header' => 'Адрес',
//            'value'  => 'CHtml::textField("name", $data->url, array("style"=>"width:100%;"));',
//            'type'   => 'raw',
//            'filter' => false
//        ],
        [
            'class'    => 'CButtonColumn',
            'template' => '{delete}'
        ],
    ]
]);