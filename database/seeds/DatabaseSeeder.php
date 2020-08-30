<?php

use App\User;
use App\Business;
use App\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UsersTableSeeder::class);
        $this->call(BusinessTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(BusinessTagsTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('users')->delete();
        
        $business_owners = User::where("user_type", "=", "Business Owner")->get();
        $cs_index = 0;
        $customer_users = [
            ['name' => 'Ishida Customer', 'email' => 'ishida@customer.com', 'user_type' => 'Customer', 'password' => 'Password123', 'birthdate' => '1990-09-09'],
            ['name' => 'Chado Customer', 'email' => 'chado@customer.com', 'user_type' => 'Customer', 'password' => 'Password123', 'birthdate' => '1990-09-09'],
            ['name' => 'Abarai Customer', 'email' => 'abarai@customer.com', 'user_type' => 'Customer', 'password' => 'Password123', 'birthdate' => '1990-09-09'],
            ['name' => 'Kuchiki Customer', 'email' => 'kuchiki@customer.com', 'user_type' => 'Customer', 'password' => 'Password123', 'birthdate' => '1990-09-09'],
            ['name' => 'Zaraki Customer', 'email' => 'zaraki@customer.com', 'user_type' => 'Customer', 'password' => 'Password123', 'birthdate' => '1990-09-09'],
            ['name' => 'Unohana Customer', 'email' => 'unohana@customer.com', 'user_type' => 'Customer', 'password' => 'Password123', 'birthdate' => '1990-09-09'],
        ];

        if ( User::where('user_type', '=', 'Customer')->count() < 5 ) {
            foreach ($customer_users as $user) {
                if (User::where('email', '=', $user['email'])->first() == null) {
                    User::insert($user);
                } else {
                    User::where('email', '=', $user['email'])->first()->update($user);
                }
            } 
        }       
    }
}

class BusinessTableSeeder extends Seeder {

	public function run()
	{
        DB::table('businesses')->delete();
        
        $business_owners = User::where("user_type", "=", "Business Owner")->get();
        $cs_index = 0;
        $city_states = [
            ["Birmingham", "Alabama"],
            ["Anchorage", "Alaska"],
            ["Phoenix", "Arizona"],
            ["Little Rock   ", "Arkansas"],
            ["Los Angeles", "California"],
            ["Denver", "Colorado"],
        ];

        foreach($business_owners as $user) {
            if ($user->business()->first() == null) {
                Business::insert([
                    'name'      => $user->name." Business",
                    'industry'  => "Industry ".$user->name,
                    'city'      => $city_states[$cs_index][0],
                    'state'     => $city_states[$cs_index++][1],
                    'user_id'   => $user->id
                ]);

                if ($cs_index == count($city_states)) {
                    $cs_index = 0;
                }
            }
        }
	}
}

class CustomersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('customers')->delete();
        
        $business = Business::first();
        $user_customers_id = User::select('id')->offset(0)->limit(5)->where('user_type', '=', 'Customer')->get();
        
        if ($business != null) {
            $business_id = Business::first()->id;

            foreach($user_customers_id as $user) {
                $exist = Customer::where('business_id', '=', $business_id)->where('user_id', '=', $user->id)->first() != null;
                
                if ($exist == false) {
                    Customer::insert(['business_id' => $business_id, 'user_id' => $user->id]);
                }
            }
        }
    }
}

class BusinessTagsTableSeeder extends Seeder {

    public function run()
    {
        // DB::table('customers')->delete();
        
        $business = Business::first();
        $tags = ['bakery', 'wholesale', 'cakes', 'cookies', 'cupcakes'];

        if ($business != null) {
            $business_id = $business->id;

            if ($business->tags != "") {
                $business_tags = array_map('strtolower', explode(' ', $business->tags));
            } else {
                $business_tags = [];
            }

            foreach($tags as $tag) {                
                if ( in_array($tag, $business_tags) == false && count($business_tags) < 12 ) {
                    $business_tags[] = $tag;
                } else if ( count($business_tags) < 12 ) {
                    break;
                }
            }

            if ( count($business_tags) > 0 ) {
                $business->update( [ 'tags' => implode(' ', $business_tags) ] );
            }
        }
    }
}

