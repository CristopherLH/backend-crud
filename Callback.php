<?php
header('Content-type:application/json;charset=utf-8');

require './models/ConnecDB.php';
require './models/UserModel.php';
require './models/StateModel.php';
require './controllers/UserController.php';
require './controllers/StateController.php';
require './views/UserView.php';
require './views/StateView.php';
require './helpers/ResponseHelper.php';
require './entity/UserEntity.php';
require './helpers/RequestHelper.php';

$_REQUEST['action'] = !empty($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch($_REQUEST['action']) {
  case 'get_users':
    $UserController = new UserController();
    $UserController->get_users();
  break;

  case 'get_users_id':
    $UserController = new UserController();
    $UserController->get_users_id();
  break;

  case 'users_insert_update' :
    $UserController = new UserController();
    $UserController->users_insert_update();
  break;

  case 'user_delete' :
    $UserController = new UserController();
    $UserController->user_delete();
  break;

  case 'user_active' :
    $UserController = new UserController();
    $UserController->user_active();
  break;

  case 'get_states' :
    $StateController = new StateController();
    $StateController->get_states_cbo();
  break;

  default: 
    echo 'no hay petición';
    break;
}