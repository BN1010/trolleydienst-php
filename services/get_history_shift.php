<?php return function (\PDO $connection): array {

    $histroy_types = array(
        App\Tables\History::SHIFT_PROMOTE_SUCCESS,
        App\Tables\History::SHIFT_PROMOTE_ERROR,
        App\Tables\History::SHIFT_WITHDRAWN_SUCCESS,
        App\Tables\History::SHIFT_WITHDRAWN_ERROR
    );

    $shift_history_list = App\Tables\History::select_all($connection, $histroy_types);
    $sort_shift_history_list = array();

    foreach ($shift_history_list as $shift_history) {
        if(strpos($shift_history['type'], 'error') === false)
            $type = 'success';
        else
            $type = 'error';

        $sort_shift_history_list[$type][] = array(
            'created' => $shift_history['created'],
            'name' => $shift_history['name'],
            'message' => $shift_history['message']
        );
    }
    return $sort_shift_history_list;
};