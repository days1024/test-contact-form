<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
         $faker = \Faker\Factory::create('ja_JP');
         $sentences = [
         'お問い合わせ内容です。',
         'テスト用のダミーテキストです。',
         'Lorem ipsum の代わりに日本語文章です。',
        ];
        return [
            //
             'first_name' =>$faker->firstName, 
             'last_name' => $faker->lastName,
             'gender' => $faker->numberBetween(1,3),
             'email' => $faker->safeEmail,
             'tel' => $faker->numerify('0##########'),
             'address' => $faker->address,
             'building' => $faker->secondaryAddress,
             'detail' => $faker->randomElement($sentences),
             'category_id' => Category::inRandomOrder()->first()->id,
             'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
             'updated_at' => now(),
             
        ];
    }
}
