<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create all categories without parent.
        Category::factory()->count(13)->create();

        // Set ( or not ) parent for all categories.
        /*foreach( Category::all() as $category ){

            $parent = Category::all()->random();

            if( !$this->isDescendent($category,$parent) ){
                echo $parent->id;
                $parent->children()->save($category);
            }

        }*/

    }

    /**
     * Function to verify if a category is descendent of given test category,
     * to prevent circular categories.
     */
    public function isDescendent($category,$test){

        $current = $test;
        while( !is_null($current->parent) ){
            if( $category === $current ){
                return true;
            }
            $current = $current->parent;
        }

        return false;

    }

}
