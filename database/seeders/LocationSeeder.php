<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Požeška 85, Beograd 11000, Serbia",
                "reviews_rating" => 3.6,
                "total_reviews" => 1134,
                "last_month_reviews" => 457
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija-MK",
                "address" => "44 GANDIJEVA, 11070, Beograd (Novi Beograd), Grad Beograd, 11070, Serbia",
                "reviews_rating" => 3,
                "total_reviews" => 3,
                "last_month_reviews" => 0
            ],
            [
                "organization_id" => 1,
                "title" => "Magacin Tehnomanija Tosin Bunar BB",
                "address" => "Belgrade, Serbia",
                "reviews_rating" => 3.8,
                "total_reviews" => 10,
                "last_month_reviews" => 5
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija doo",
                "address" => "Tošin bunar 179G, Beograd 11070, Serbia",
                "reviews_rating" => 2.9,
                "total_reviews" => 94,
                "last_month_reviews" => 23
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija OUTLET",
                "address" => "Tošin bunar br. 172, Beograd 11070, Serbia",
                "reviews_rating" => 3.6,
                "total_reviews" => 215,
                "last_month_reviews" => 100
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Pilota Mihaila Petrovića br. 72, Beograd 11090, Serbia",
                "reviews_rating" => 3.8,
                "total_reviews" => 299,
                "last_month_reviews" => 78
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Zrenjaninski put bb, Borča 11211, Serbia",
                "reviews_rating" => 4,
                "total_reviews" => 523,
                "last_month_reviews" => 201
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Hercegovačka 19, lok BOL 19, Beograd 11000, Serbia",
                "reviews_rating" => 4.3,
                "total_reviews" => 6,
                "last_month_reviews" => 1
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "TC Stadion, Zaplanjska 32, Beograd 11000, Serbia",
                "reviews_rating" => 3.3,
                "total_reviews" => 63,
                "last_month_reviews" => 24
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Bulevar Vilsona Vudroa 12 - TC Galerija Beograd, 11000, Serbia",
                "reviews_rating" => 2.8,
                "total_reviews" => 30,
                "last_month_reviews" => 0
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija Aviv Park Konjarnik",
                "address" => "Živka Davidovića 86, Beograd 11050, Serbia",
                "reviews_rating" => 3.6,
                "total_reviews" => 83,
                "last_month_reviews" => 12
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "WEST 65 Mall, Omladinskih brigada 86, Beograd 11000, Serbia",
                "reviews_rating" => 3.8,
                "total_reviews" => 202,
                "last_month_reviews" => 4
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija OUTLET",
                "address" => "Belo Vrelo 2, Beograd, Serbia",
                "reviews_rating" => 3.8,
                "total_reviews" => 690,
                "last_month_reviews" => 123
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Vukasovićeva 50a, Beograd 11000, Serbia",
                "reviews_rating" => 3.7,
                "total_reviews" => 684,
                "last_month_reviews" => 451
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "MEGA MAXI, Obrenovački drum 3, Beograd 11000, Serbia",
                "reviews_rating" => 3.6,
                "total_reviews" => 99,
                "last_month_reviews" => 80
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "TC Ušće, Bulevar Mihajla Pupina 4, Beograd 11070, Serbia",
                "reviews_rating" => 3.8,
                "total_reviews" => 674,
                "last_month_reviews" => 33
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Višnjička bb, Beograd 11000, Serbia",
                "reviews_rating" => 3.9,
                "total_reviews" => 951,
                "last_month_reviews" => 500
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Autoput 18 - TC, Zmaj Jovina, Beograd 11080, Serbia",
                "reviews_rating" => 3.9,
                "total_reviews" => 1884,
                "last_month_reviews" => 987
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Ustanička 69, Beograd 11000, Serbia",
                "reviews_rating" => 3.9,
                "total_reviews" => 1606,
                "last_month_reviews" => 722
            ],
            [
                "organization_id" => 1,
                "title" => "Tehnomanija",
                "address" => "Dr Agostina Neta 3, Beograd 11000, Serbia",
                "reviews_rating" => 3.7,
                "total_reviews" => 468,
                "last_month_reviews" => 88
            ]
        ]);
    }
}
