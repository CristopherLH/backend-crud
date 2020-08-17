<?php
class RequestHelper {
    
    function __construct() {
        foreach ($_REQUEST as $key => $r) {
            $this->$key = !empty($r) ? $r : null;
        }
    }

    public function has($keys = []) {
        $existsAll = true;
        foreach ($keys as $k) {
            if (empty($_REQUEST[$k])) {
                $existsAll = false;
                break;
            }
        }
        return $existsAll;
    }

}