<?php
class User{
    public int $id = 0;
    public string $name = "";
    public string $photo = "none.jpg";
    public int $sub = 0;
    public function __construct(array | null $data = null){
        if(isset($data)){
            $this->id = $data["id"];
            $this->name = $data["name"];
            if(isset($data["photo"])){
                $this->photo = $data["photo"];
            }
            $this->sub = $data["sub"];
        }
    }
}
class Post{
    public int $id = 0;
    public Post | null $father = null;
    public array $children = [];

    public int $comment = 0;
    public string | null $text = null;
    public string | null $photo = null;
    public int $date = 0;
    public User $user = new User();
    public function __construct(array $data, bool $get_father = false, int $list_children = 0){
        $this->id = $data["id"];
        $this->comment = $data["comment"];
        $this->text = $data["text"];
        $this->photo = $data["photo"];
        $this->date = $data["date"];

        $this->user->id = $data["user_id"];
        $this->user->name = $data["user_name"];
        if(isset($data["user_photo"])){
            $this->user->photo = $data["user_photo"];
        }
        $this->user->sub = $data["user_sub"];

        if($get_father){
            $this->father = getPostFather($data["answer"]);
        }
        $this->children = getPostChild($this->id, $list_children);
    }
}
?>
