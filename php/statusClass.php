<?php
class StatusClass
{
    public $status_id;
    public $book_id;
    public $user_id;
    public $borrowed_at;
    public $due_back;

    public function __construct($status_id,$book_id, $user_id, $borrowed_at, $due_back)
    {
        $this->status_id = $status_id;
        $this->book_id = $book_id;
        $this->user_id = $user_id;
        $this->borrowed_at = $borrowed_at;
        $this->due_back =  $due_back;

    }



}


?>