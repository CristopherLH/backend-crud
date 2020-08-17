<?php
class UserController {
  private $UserModel;
  private $ResponseHelper;
  private $RequestHelper;

  function __construct()
  {
    $this->UserModel = new UserModel();
    $this->ResponseHelper = new ResponseHelper();
    $this->RequestHelper = new RequestHelper();
  }

  public function get_users() {
    echo $this->ResponseHelper->success('Listado correcto', $this->UserModel->get_users($this->RequestHelper->p_filter,$this->RequestHelper->p_state_user, !is_null($this->RequestHelper->p_state_user) ? 1 : 2));
  }

  private function getRequestUser() {
    $userEntity = new UserEntity();
    $userEntity->id_user = $this->RequestHelper->has(['id_user']) ? $this->RequestHelper->id_user : null;
    $userEntity->name_user = $this->RequestHelper->has(['name_user']) ? $this->RequestHelper->name_user : null;
    $userEntity->last_name_user = $this->RequestHelper->has(['last_name_user']) ? $this->RequestHelper->last_name_user : null;
    $userEntity->state_user = $this->RequestHelper->has(['state_user']) ? $this->RequestHelper->state_user : null;
    $userEntity->login_user = $this->RequestHelper->has(['login_user']) ? $this->RequestHelper->login_user : null;
    $userEntity->password_user = $this->RequestHelper->has(['password_user']) ? $this->RequestHelper->password_user : null;

    return $userEntity;
  }

  public function get_users_id() {
    $UserView = new UserView();
    $userEntity = new UserEntity();
    $get_user = $this->UserModel->get_users_id($this->getRequestUser());
    if ($get_user) {
      $userEntity->id_user = $get_user->id_user;
      $userEntity->name_user = $get_user->name_user;
      $userEntity->last_name_user = $get_user->last_name_user;
      $userEntity->login_user = $get_user->login_user;
      $userEntity->state_user = $get_user->state_user;
    }
    echo json_encode($UserView->insert_update($userEntity));
  }

  public function users_insert_update() {
    if (!$this->RequestHelper->has(['name_user', 'last_name_user', 'state_user', 'login_user'])) {
      echo $this->ResponseHelper->danger('Los parametros no están completos');
      return;
    }

    $res = $this->UserModel->users_insert_update($this->getRequestUser());

    if (!$res) {
      echo $this->ResponseHelper->danger('No se pudo guardar la información');
      return;
    }
    echo $this->ResponseHelper->response($res->response, $res->message, !empty($res->id) ? [
      'id' => $res->id
    ] : []);
  }

  public function user_delete() {
    echo $this->ResponseHelper->success($this->UserModel->user_delete($this->getRequestUser())->message);
  }

  public function user_active() {
    echo $this->ResponseHelper->success($this->UserModel->user_active($this->getRequestUser())->message);
  }
}