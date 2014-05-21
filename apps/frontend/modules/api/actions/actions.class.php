<?php

/**
 * api actions.
 *
 * @package    metatrader-backend
 * @subpackage api
 * @author     Anatoly Pashin
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class apiActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    return $this->renderMessage([
      "status" => "SUCCESS",
      "message" => "Hello from API",
    ]);
  }

  public function executeCheckMachine(sfWebRequest $request)
  {
    if (true == ($error = $this->checkRequest())) return $error;

    $result = Doctrine_Query::create()
      ->from("Product p")
      ->innerJoin("p.Keys k")
      ->innerJoin("k.Machine m")
      ->addWhere("p.metaname = ?", $this->product)
      ->addWhere("m.name = ?", $this->machine)
      ->limit(1)
      ->fetchOne()
    ;

    return $this->renderMessage($result && $result->getId() ? [
      "status" => "SUCCESS",
      "message" => "This machine is already registered",
    ] : [
      "message" => "This machine is not registered yet",
    ]);
  }

  public function executeInsertMachine(sfWebRequest $request)
  {
    if (true == ($error = $this->checkRequest())) return $error;

    $key = Doctrine_Query::create()
      ->from("Key k")
      ->addWhere("k.name = ?", $this->key)
      ->addWhere("k.product = ?", $this->product)
      ->limit(1)
      ->fetchOne()
    ;

    if (true == ($error = $this->errorUnless($key and $key->getId(), "No such key for that product registered"))) return $error;

    $machine = Doctrine_Core::getTable("Machine")->findOneByName($this->machine);
    if (true == ($error = $this->errorIf($machine and $machine->getKeyId() === $key->getId(), "This machine is already registered"))) return $error;

    $machine = Machine::createFromArray([
      "name" => $this->machine,
      "key_id" => $key->getId(),
    ]);
    $machine->save();

    return $this->renderMessage($machine && $machine->getId() ? [
      "status" => "SUCCESS",
      "message" => "This machine is registered now",
    ] : [
      "message" => "Error registering this machine",
    ]);
  }


  protected function checkRequest()
  {
    $request = $this->getRequest();

    $this->product = $request->getParameter("product");
    $this->machine = $request->getParameter("machine");

    return $this->errorUnless($this->product and $this->machine, "Please provide key, product and machine");
  }

  protected function errorUnless($condition, $message)
  {
    return $condition ? false : $this->renderMessage([
      "status" => "FAIL",
      "message" => $message
    ]);
  }

  protected function errorIf($condition, $message)
  {
    return $this->errorUnless(!$condition, $message);
  }
  protected function renderMessage(array $message)
  {
    $this->getResponse()->setStatusCode(isset($message["status"]) && $message["status"] === "SUCCESS" ? 200 : 400);

    /*$this->renderText(json_encode(array_merge([
      "status" => "FAIL",
      "message" => "Not implemented",
    ], $message), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    return sfView::NONE;*/

    die(array_merge([
      "status" => "FAIL",
      "message" => "Not implemented",
    ], $message)["status"]);
  }
}
