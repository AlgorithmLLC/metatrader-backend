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

    $product = Doctrine_Query::create()
      ->from("Product p")
      ->addWhere("p.metaname = ?", $this->product)
      ->limit(1)
      ->fetchOne()
    ;
    if (true == ($error = $this->errorUnless($product and $product->getId(), "No such product registered", "WRONG PRODUCT"))) return $error;

    $key = Doctrine_Query::create()
      ->from("Key k")
      ->addWhere("k.name = ?", $this->key)
      ->addWhere("k.product_id = ?", $product->getId())
      ->limit(1)
      ->fetchOne()
    ;

    if (true == ($error = $this->errorUnless($key and $key->getId(), "No such key for that product registered", "WRONG KEY"))) return $error;

    $machine = Doctrine_Query::create()
      ->from("Machine m")
      ->addWhere("m.name = ?", $this->machine)
      ->limit(1)
      ->fetchOne()
    ;

    if (!$machine or !$machine->getId()) {
      $machine = Machine::createFromArray([
        "name" => $this->machine,
      ]);
      $machine->save();
    }

    $result = Doctrine_Query::create()
      ->from("Key k")
      ->addWhere("k.id = ?", $key->getId())
      ->addWhere("k.product_id = ?", $product->getId())
      ->addWhere("k.machine_id = ?", $machine->getId())
      ->limit(1)
      ->fetchOne()
    ;
    if (true == ($error = $this->errorIf($result and $result->getId(), "This machine is already registered", "SUCCESS"))) return $error;

    $result = $key->setMachineId($machine->getId())->save();

    return $this->renderMessage($result ? [
      "status" => "SUCCESS",
      "message" => "This machine is registered now",
    ] : [
      "message" => "Error registering this machine",
    ]);
  }


  protected function checkRequest()
  {
    $request = $this->getRequest();

    $this->key = $request->getParameter("key");
    $this->product = $request->getParameter("product");
    $this->machine = $request->getParameter("machine");

    return $this->errorUnless($this->product and $this->machine, "Please provide key, product and machine");
  }

  protected function errorUnless($condition, $message, $status="FAIL")
  {
    return $condition ? false : $this->renderMessage([
      "status" => $status,
      "message" => $message
    ]);
  }

  protected function errorIf($condition, $message, $status="FAIL")
  {
    return $this->errorUnless(!$condition, $message, $status);
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
