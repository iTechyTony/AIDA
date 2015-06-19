<?php
class Item {
	
	// Item attributes are all private:
	private $id;
	private $name;
	private $artist;
	private $album;
	private $genre;
	private $rating;
	private $song;
	private $image;
	private $price;
	private $description;

	
	
	
	// Constructor populates the attributes:
	public function __construct($id, $name, $price, $description) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->description = $description;
	}
	// Setters
	public function setId($id) {
		$this->id = $id;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setArtist($artist) {
		$this->artist = $artist;
	}
	
	public function setAlbum($album) {
		$this->album = $album;
	}
	
	public function setGenre($genre) {
		$this->genre = $genre;
	}
	
	public function setRating($rating) {
		$this->rating = $rating;
	}
	
	public function setSong($song) {
		$this->song = $song;
	}
	
	public function setImage($image) {
		$this->image = $image;
	}
		
	public function setPrice($price) {
		$this->price = $price;
	}
	
	// Getters
	public function getId() {
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getArtist(){
		return $this->artist;
	}
	
	public function getAlbum(){
		return $this->album;
	}
	
	public function getGenre(){
		return $this->genre;
	}
	
	public function getImage() {
		return $this->image;
	}
	public function getPrice() {
		return $this->price;
	}
	
	public function getDescription() {
		return $this->description;
	}

	public function __toString() {
		return "_toString = " . $this->id . " " . $this->name . " " . $this->artist . " " . $this->album." ".$this->genre." ".$this->rating." ".$this->song." ".$this->image." ".$this->price;
	}
}
