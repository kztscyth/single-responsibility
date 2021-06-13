<?php

class Json{
    public static function from($data){
        return json_encode($data);
    }
}

class User{
    public $name;
    public $email;
    public $birth;

    public function __construct($data){
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->birth = $data['birth'];
    }
}

class UserRequest{
    protected static $rules = [
        'name' => 'string',
        'email' => 'string',
        'birth' => 'string'
    ];

    public static function validate($data){
        foreach (static::$rules as $property => $type){
            if (gettype($data[$property]) != $type){
                throw new \Exception("User property {$property} must be of type {$type}" );
            }
        }
    }
}

class Age{
    public static function now($data){
        $birth = new DateTime($data['birth']);
        $today = new Datetime(date('d.m.y'));
        return [
            'year' => $today->diff($birth)->y,
            'month' => $today->diff($birth)->m,
            'day' => $today->diff($birth)->d,
        ];
    }
}

$data = [
    'name' => 'MuhammadIkhsanNurFalah', 
    'email' => 'ikhsankirito07@gmail.com',
    'birth' => '07.11.2000'
];

UserRequest::validate($data);
$user = new User($data);
print_r(Json::from($user));
echo '<br>';
print_r(Age::now($data));

?>