<?php
class User {
    protected $userId;
    protected $password;
    protected $name;
    protected $email;
    protected $role;
    
    public function __construct($userId, $password, $name, $email, $role) {
        $this->userId = $userId;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }
    
}

class Customer extends User {
    protected $address;
    protected $phone;
    protected $creditcard;
    protected $status;
    
    public function __construct($userId, $password, $name, $email, $role, $address, $phone, $creditcard, $status) {
        parent::__construct($userId, $password, $name, $email, $role);
        $this->address = $address;
        $this->phone = $phone;
        $this->creditcard = $creditcard;
        $this->status = $status;
    }
    
}

class Admin extends User {
    public function __construct($userId, $password, $name, $email, $role) {
        parent::__construct($userId, $password, $name, $email, $role);
    }
    
}
class Cart {
    public $cartId;
    public $productId;
    public $quantity;
  
    function __construct($cartId, $productId, $quantity) {
      $this->cartId = $cartId;
      $this->productId = $productId;
      $this->quantity = $quantity;
    }
  }
  class Order {
    private $date;
    private $id;
    private $status;
    private $shippingId;
  
    public function __construct($date, $id, $status, $shippingId) {
      $this->date = $date;
      $this->id = $id;
      $this->status = $status;
      $this->shippingId = $shippingId;
    }
  
    public function getDate() {
      return $this->date;
    }
  
    public function getID() {
      return $this->id;
    }
  
    public function getStatus() {
      return $this->status;
    }
  
    public function getShippingID() {
      return $this->shippingId;
    }
  
    public function setDate($date) {
      $this->date = $date;
    }
  
    public function setID($id) {
      $this->id = $id;
    }
  
    public function setStatus($status) {
      $this->status = $status;
    }
  
    public function setShippingID($shippingId) {
      $this->shippingId = $shippingId;
    }
  }
    



?>