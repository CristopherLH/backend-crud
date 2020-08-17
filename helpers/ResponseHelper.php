<?php
class ResponseHelper  {
    public function response($response, $message, $data = []) {
        return json_encode([
            'response' => $response,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function success($message, $data = []) {
        return $this->response('success', $message, $data);
    }

    public function danger($message, $data = []) {
        return $this->response('danger', $message, $data);
    }

    public function warning($message, $data = []) {
        return $this->response('warning', $message, $data);
    }
}