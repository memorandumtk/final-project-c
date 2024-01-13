<?php
    class BookClass{
        public $book_id;
        public $title;
        public $description;
        public $authors;
        public $registered_at;
        public $image_url;

        public function __construct($book_id, $title, $description, $authors, $registered_at, $image_url){
            $this->book_id = $book_id;
            $this->title = $title;
            $this->description = $description;
            $this->authors = $authors;
            $this->registered_at = $registered_at;
            $this->image_url = $image_url;
        }

        
    }


?>