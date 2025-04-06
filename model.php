<?php
class User{
    public int $id;
    public string $name;
    public string $photo = "none.jpg";
    public int $sub;
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
    public int $id;
    public Post | null $father;
    public array $children;
    public int $like;
    public bool $liked;
    public int $comment;
    public string | null $text;
    public string | null $photo;
    public int $date;
    public User $user;
    public function __construct(array $data, bool $get_father = false, int $list_children = 0){
        $this->id = $data["id"];
        $this->comment = $data["comment"];
        $this->text = $data["text"];
        $this->photo = $data["photo"];
        $this->date = $data["date"];
        $this->like = $data["like"];
        $this->liked = isset($data["liker"]);

        $this->user = new User();
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
