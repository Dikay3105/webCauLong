<?php 
class Transaction {
    public $transactionID;
    public $userID;
    public $total;
    public $note;
    public $time;
    public $address;
    public $name_receiver;
    public $phone_receiver;
    public $transport;
    public $status;
    public $check;
    public function __construct($transactionID, $userID, $total, $note, $time, $address, $check,$transport,  $status, $name_receiver, $phone_receiver) {
        $this->transactionID = $transactionID;
        $this->userID = $userID;
        $this->total = $total;
        $this->note = $note;
        $this->time = $time;
        $this->address = $address;
        $this->name_receiver = $name_receiver;
        $this->phone_receiver = $phone_receiver;
        $this->transport = $transport;
        $this->status = $status;
        $this->check = $check;
    }

    // Getter và setter cho transactionID
    public function getTransactionID() {
        return $this->transactionID;
    }

    public function setTransactionID($transactionID) {
        $this->transactionID = $transactionID;
    }

    // Getter và setter cho userID
    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    // Getter và setter cho total
    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    // Getter và setter cho note
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    // Getter và setter cho time
    public function getTime() {
        return $this->time;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    // Getter và setter cho address
    public function getAddress() {
        return $this->address;
    }
    // Getter và setter cho name_receiver
    public function getNameReceiver() {
        return $this->name_receiver;
    }

    public function setNameReceiver($name_receiver) {
        $this->name_receiver = $name_receiver;
    }

    // Getter và setter cho phone_receiver
    public function getPhoneReceiver() {
        return $this->phone_receiver;
    }

    public function setPhoneReceiver($phone_receiver) {
        $this->phone_receiver = $phone_receiver;
    }

    // Getter và setter cho transport
    public function getTransport() {
        return $this->transport;
    }

    public function setTransport($transport) {
        $this->transport = $transport;
    }

    // Getter và setter cho status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getCheck() {
        return $this->check;
    }

    public function setCheck($check) {
        $this->check = $check;
    }
}

?>