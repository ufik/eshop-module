<?php

namespace WebCMS\EshopModule\Doctrine;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as gedmo;
use Doctrine\orm\Mapping as orm;

/**
 * Description of Order
 * @orm\Entity
 * @orm\Table(name="Orders")
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class Order extends \AdminModule\Doctrine\Entity {
	/**
	 * @orm\Column
	 */
	private $firstname;
	
	/**
	 * @orm\Column
	 */
	private $lastname;
	
	/**
	 * @orm\Column
	 */
	private $email;
	
	/**
	 * @orm\Column
	 */
	private $phone;
	
	/**
	 * @orm\Column
	 */
	private $street;
	
	/**
	 * @orm\Column
	 */
	private $city;
	
	/**
	 * @orm\Column(type="integer")
	 */
	private $postcode;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $state;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoiceFirstname;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoiceLastname;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoiceEmail;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoicePhone;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoiceStreet;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoiceCity;
	
	/**
	 * @orm\Column(type="integer", nullable=true)
	 */
	private $invoicePostcode;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $invoiceState;
	
	/**
	 * @orm\Column(nullable=true)
	 */
	private $currency;
	
	/**
	 * @orm\OneToMany(targetEntity="OrderItem", mappedBy="order", cascade={"persist"})
	 */
	private $items;
	
	/**
	 * @orm\Column(type="decimal", precision=12, scale=4)
	 */
	private $priceTotal;
	
	public function __construct(){
		$this->items = new ArrayCollection();
	}
	
	public function addItem($item){
		$item->setOrder($this);
		$this->items->add($item);
	}
	
	public function removeItem($item){
		$this->items->removeElement($item);
	}
	
	public function getFirstname() {
		return $this->firstname;
	}

	public function getLastname() {
		return $this->lastname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function getStreet() {
		return $this->street;
	}

	public function getCity() {
		return $this->city;
	}

	public function getState() {
		return $this->state;
	}

	public function getCurrency() {
		return $this->currency;
	}

	public function getItems() {
		return $this->items;
	}

	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setPhone($phone) {
		$this->phone = $phone;
	}

	public function setStreet($street) {
		$this->street = $street;
	}

	public function setCity($city) {
		$this->city = $city;
	}

	public function setState($state) {
		$this->state = $state;
	}

	public function setCurrency($currency) {
		$this->currency = $currency;
	}

	public function setItems($items) {
		$this->items = $items;
	}
	
	public function getInvoiceFirstname() {
		return $this->invoiceFirstname;
	}

	public function getInvoiceLastname() {
		return $this->invoiceLastname;
	}

	public function getInvoiceEmail() {
		return $this->invoiceEmail;
	}

	public function getInvoicePhone() {
		return $this->invoicePhone;
	}

	public function getInvoiceStreet() {
		return $this->invoiceStreet;
	}

	public function getInvoiceCity() {
		return $this->invoiceCity;
	}

	public function getInvoiceState() {
		return $this->invoiceState;
	}

	public function setInvoiceFirstname($invoiceFirstname) {
		$this->invoiceFirstname = $invoiceFirstname;
	}

	public function setInvoiceLastname($invoiceLastname) {
		$this->invoiceLastname = $invoiceLastname;
	}

	public function setInvoiceEmail($invoiceEmail) {
		$this->invoiceEmail = $invoiceEmail;
	}

	public function setInvoicePhone($invoicePhone) {
		$this->invoicePhone = $invoicePhone;
	}

	public function setInvoiceStreet($invoiceStreet) {
		$this->invoiceStreet = $invoiceStreet;
	}

	public function setInvoiceCity($invoiceCity) {
		$this->invoiceCity = $invoiceCity;
	}

	public function setInvoiceState($invoiceState) {
		$this->invoiceState = $invoiceState;
	}
	
	public function getPostcode() {
		return $this->postcode;
	}

	public function getInvoicePostcode() {
		return $this->invoicePostcode;
	}

	public function setPostcode($postcode) {
		$this->postcode = $postcode;
	}

	public function setInvoicePostcode($invoicePostcode) {
		$this->invoicePostcode = $invoicePostcode;
	}
	
	/* Calculations */
	
	public function getQuantityTotal(){
		$items = $this->getItems();
		$total = 0;
		foreach($items as $item){
			$total += $item->getQuantity();
		}
		
		return $total;
	}
	
	public function getPriceTotal(){
		$items = $this->getItems();
		$this->priceTotal = 0;
		foreach($items as $item){
			$this->priceTotal += $item->getPrice() * $item->getQuantity();
		}
		
		return $this->priceTotal;
	}
}
