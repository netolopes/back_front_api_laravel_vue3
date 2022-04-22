<?php
namespace App\Repositories\user;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;


class UserRepository  implements IUserRepository
{

    protected $user;
    protected $imlearnServ;

    public function __construct
    (
       User $user
    ) {
       $this->user = $user;
    }

    public function list()
    {
        return $this->user::all();
    }

    public function add(string $name, string $msisdn, ?string $password, string $access_level,string $external_id, string $email)
    {
        $result = $this->user::create([
            'name' => $name,
            'msisdn' => $msisdn,
            'password' => $password,
            'access_level' => $access_level,
            'external_id' => $external_id,
            'email' => $email
        ]);

        $data = [
            'name' => $name,
            'msisdn' => $msisdn,
            'password' => $password,
            'access_level' => $access_level,
            'external_id' => $external_id,
            'email' => $email
        ];


       return $result;
    }

    public function listBy(int $id)
    {
        $data =  $this->user::findOrFail($id);
        return $data;
    }

    public function edit(int $id,string $name, string $msisdn, ?string $password, string $access_level,string $external_id, string $email)
    {

           $obj =  $this->user::findOrFail($id);
           $obj->name = $name;
           $obj->msisdn = $msisdn;
           $obj->password = $password;
           $obj->access_level =  $access_level;
           $obj->external_id = $external_id;
           $obj->email = $email;

           if( $obj->save() ){
            return  $obj;
          }
    }

    public function delete(int $id){

        $obj =  $this->user::findOrFail($id);

          if( $obj->delete() ){
           return  $obj;
         }
   }

}
