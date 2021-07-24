dday
{{
    uio('formText', [
        'name'=>'dday_at',
        'type'=>'date',
        'value'=>(is_array($item) && array_key_exists('dday_at', $item) ? $item['dday_at'] : '2038-01-19'
    )])
}}
