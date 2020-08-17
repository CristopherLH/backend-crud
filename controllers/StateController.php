<?php 

class StateController {
  private $stateModel;
  private $stateView;
  private $responseHelper;

  function __construct()
  {
    $this->stateModel = new StateModel();
    $this->stateView = new StateView();
    $this->responseHelper = new ResponseHelper();
  }

  public function get_states() {
    return $this->stateModel->get_states();
  }

  public function get_states_cbo() {
    echo $this->responseHelper->success('Listado de estados', $this->stateView->cbo());
  }
}